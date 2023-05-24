<?php

namespace App\Http\Controllers;


use App\Models\InventoryType;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ItemCategory;
use App\Models\Status;
use App\Models\UnitType;
use Exception;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Helpers\LogHelper;
use App\Models\Log;


use SimpleSoftwareIO\QrCode\Facades\QrCode;



class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Item::with('status', 'itemCategory', 'unitType', 'inventoryType')->withoutTrashed()->get();
        $categories = ItemCategory::all();
        $unit_types = UnitType::all();
        $inventory_types = InventoryType::all();
        $statuses = Status::all();
    
        return view('layouts.items.index', compact('data', 'categories', 'unit_types', 'inventory_types', 'statuses'));
    }
    


   
    
    


    public function pdf()
    {
        $data = Item::all();

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('layouts.items.pdf', compact('data')));
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream('layouts.items.pdf');

        
    }
    public function print()
{
    $data = Item::all();

    $pdf = app('dompdf.wrapper');
    $pdf->loadView('layouts.items.print', compact('data'));
    $pdf->setPaper('A4', 'portrait');
    $pdf->stream('layouts.items.pdf', ['Attachment' => false]);


    // Set the HTTP headers to display the PDF directly in the browser
    return $pdf->stream('items.pdf');
}


public function printqr()
{
    $data = Item::all();

    $pdf = app('dompdf.wrapper');
    $pdf->loadView('layouts.items.printqr', compact('data'));
    $pdf->setPaper('A4', 'portrait');
    $pdf->stream('layouts.items.printqr', ['Attachment' => false]);


    // Set the HTTP headers to display the PDF directly in the browser
    return $pdf->stream('items.printqr');
}


    public function exportCSV()
    {
        $data = Item::all();

        $filename = "items.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('QR Code', 'Name', 'Price', 'Category', 'Quantity', 'Unit Type', 'Date Purchased', 'Date Added', 'Last Checked', 'Status'));

        foreach ($data as $value) {
            fputcsv($handle, array(
                $value->qrcode_image,
                $value->item_name,
                $value->price,
                $value->itemCategory->item_category,
                $value->quantity,
                $value->unitType->unit_type,
                $value->date_purchased,
                $value->created_at,
                $value->maintenanced_date,
                $value->status->status,
                
            ));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filename, 'items.csv', $headers);
    }




    public function create()
    {

       
      
           
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    
    $validatedData = $request->validate([
        'item_name' => 'required',
        'brand' => 'required',
        'description' => 'required',
        'post_status_id' => 'required',
        'price' => 'required',
        'item_category' => 'required',
        'unit_type' => 'required',
        'quantity' => 'required',
        'date_purchased' => 'required|date',
        'remarks' => 'nullable',
        'image' => 'required|image',
        'purchased_as' => 'required',
    ]);
    if (!$request->filled('post_status_id')) {
        $validatedData['post_status_id'] = 1;
    }
    // Save the item to the database
    $item = Item::create($validatedData);

    // Save the item image
    if ($request->hasfile('image')) {
        $file = $request->file('image');
        $extenstion = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extenstion;
        $file->move('uploads/image/', $filename);
        $item->image = $filename;
        
    }

   
    
    // Generate the QR code link
    $itemLink = route('item.showDetails', $item->id);

    // Generate the QR code as a binary string
    $qrCode = QrCode::format('png')
                    ->size(400)
                    ->errorCorrection('H')
                    ->generate($itemLink);

    // Get the item name without any spaces
    $itemName = str_replace(' ', '_', $item->item_name);

    // Save the QR code as a PNG file with the item name in the filename
    $qrCodePath = 'images/qrcode_images/' . $itemName . '_qrcode.png';
    file_put_contents($qrCodePath, $qrCode);
    
    // Get the item name without any spaces
    $itemName = str_replace(' ', ' ', $item->item_name);
    
    // Save the QR code as a PNG file with the item name in the filename
    $qrCodePath = 'images/qrcode_images/' . $itemName . '_qrcode.png';
    file_put_contents($qrCodePath, $qrCode);
    
    // Save the base64-encoded QR code in the database
    $base64QrCode = base64_encode($qrCode);
    $item->qrcode_image = $base64QrCode;
    $item->save();

   
    


    LogHelper::createLog('User added '. $itemName . ' to assets');

    return redirect()->route('item.index')->with('success', 'Item created successfully.');
}


public static function generateAdviceForAllItems()
{
    $items = Item::all();

    foreach ($items as $item) {
        // Calculate the age of the device
        $dateBought = Carbon::createFromFormat('Y-m-d', $item->date_purchased);
        $ageInYears = $dateBought->diffInYears(Carbon::now());

        // Fetch the estimated lifespan from the associated item category
        $estimatedLifespan = $item->itemCategory->estimated_lifespan;

        // Adjust the estimated lifespan based on the purchased_as value
        if ($item->purchased_as === 'Used') {
            $estimatedLifespan -= 2;
        }

        // Fetch the message from the item category
        $message = $item->itemCategory->message;

        // Set the advice as the message
        $advice = $message;

        if ($ageInYears >= $estimatedLifespan) {
            $item->post_status_id = 4;
        }

        // Save the advice and message to the database
    }
}

public function getMessages()
{
    $messages = Item::select('id', 'item_name', 'advice')->where('advice', '!=', '"Device in optimal condition."')->get();

    $itemsWithLink = $messages->map(function ($item) {
        $itemLink = URL::route('item.showDetails', ['id' => $item->id]);
        $item->link = $itemLink;
        return $item;
    });

    return response()->json(['messages' => $itemsWithLink]);
}

public function guestPage()
{
    // Retrieve the data you want to display in the table
    $data = Item::all(); // Replace `Item` with your actual model name or query logic
    
    return view('welcome', ['data' => $data]);
}
















    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = Item::findOrFail($id);
        
    
        return view('layouts.items.show', compact('item'));
    }
    public function showDetails($id)
{
    $item = Item::findOrFail($id);
    return view('layouts.items.details', compact('item'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
       
        
            
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $statuses  = Status::all();
        $categories  = ItemCategory::all();
        $unit_types = UnitType::all();
        $inventory_types = InventoryType::all();


        $validatedData = $request->validate([
            
            'item_name' => 'nullable',
            'brand' => 'nullable',
            'post_status_id' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:20148',
            'price' => 'nullable',
            'unit_type' => 'nullable',
            'item_category' => 'nullable',
            'description' => 'nullable',
            'quantity' => 'nullable',
            'remarks' => 'nullable',
            'date_purchased' => 'nullable|date',
            'purchased_as' => 'nullable',
            
        ]);

        

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/image/', $filename);
            $validatedData['image'] = $filename;
        }
        // dd($validatedData);
        
        $item->update($validatedData);
        

        $itemName = str_replace(' ', ' ', $item->item_name);
        LogHelper::createLog('updated '. $itemName . ' in assets');
        return redirect()->route('item.index')
            ->with('info', 'Item has been updated successfully')
            ->with('categories', $categories)
            ->with('unit_types', $unit_types)
            ->with('statuses', $statuses)
            ->with('inventory_types', $inventory_types)
            ->with('item', $item);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();
        $itemName = str_replace(' ', ' ', $item->item_name);
        LogHelper::createLog('destroyed '. $itemName . ' in assets');

        return redirect()->route('item.index')
            ->with('danger', 'Item has been deleted successfully');
    }
    public function markAsDeleted(Item $item, $id)
{
    $item = Item::find($id);
    
    if ($item->trashed()) {
        return redirect()->route('item.index')
            ->with('warning', 'Item is already marked as deleted.');
    }
    
    $item->delete();

    $itemName = str_replace(' ', ' ', $item->item_name);

    LogHelper::createLog('deleted '. $itemName . ' in assets');

    return redirect()->route('item.index')
            ->with('danger', 'Item has been marked as deleted successfully.');
           
}



public function restore(Item $item, $id)
{
    $item = Item::withTrashed()->find($id);

    if ($item->trashed()) {
        $item->restore();
        $itemName = str_replace(' ', ' ', $item->item_name);
        LogHelper::createLog('restored '. $itemName . ' from deleted assets');
        return redirect()->route('item.deletedAssets')
            ->with('success', 'Item has been restored successfully.');
    }

    return redirect()->route('item.deletedAssets')
        ->with('warning', 'Item is not deleted.');
        
        
}
public function fix(Item $item, $id) {
    $item = Item::find($id);
    if ($item) {
        $item->post_status_id = 1;
        $item->save();

        $itemName = str_replace(' ', ' ', $item->item_name);
        LogHelper::createLog('fixed '. $itemName . ' in assets');

        return redirect()->route('item.index')
        ->with('success', 'Item has been fixed.');
    }
}







public function deletedAssets()
{
    $data = Item::onlyTrashed()
        ->with('status', 'itemCategory', 'unitType', 'inventoryType')
        ->get();

        $statuses = Status::all(); // Retrieve the statuses
    
        return view('layouts.items.deleted_assets', compact('data', 'statuses'));
}



    

    public function fetchAdvices()
    {
        $advices = Item::pluck('advice')->toArray();

        return response()->json($advices);
    }
    
}
