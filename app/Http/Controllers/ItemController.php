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

use SimpleSoftwareIO\QrCode\Facades\QrCode;



class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $data = Item::with('status', 'itemCategory', 'unitType', 'inventoryType')->get();
        

        
        
        return view('layouts.items.index', compact('data'));
        


        
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
    $pdf->stream('items.pdf', ['Attachment' => false]);


    // Set the HTTP headers to display the PDF directly in the browser
    return $pdf->stream('items.pdf');
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

        $categories = ItemCategory::all();
        $unit_types = UnitType::all();
        $inventory_types = InventoryType::all();
        return view('layouts.items.create')
            ->with('categories', $categories)
            ->with('unit_types', $unit_types)
            ->with('inventory_types', $inventory_types);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    if (!$request->filled('post_status_id')) {
        $request->merge(['post_status_id' => 1]);
    }

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

    // Save the item to the database
    $item = Item::create($validatedData);

    // Save the item image
    if ($request->hasfile('image')) {
        $file = $request->file('image');
        $extenstion = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extenstion;
        $file->move('uploads/image/', $filename);
        $item->image = $filename;
        $item->save();
    }

   
    
    // Generate the QR code
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
    $itemName = str_replace(' ', '_', $item->item_name);
    
    // Save the QR code as a PNG file with the item name in the filename
    $qrCodePath = 'images/qrcode_images/' . $itemName . '_qrcode.png';
    file_put_contents($qrCodePath, $qrCode);
    
    // Save the base64-encoded QR code in the database
    $base64QrCode = base64_encode($qrCode);
    $item->qrcode_image = $base64QrCode;
    $item->save();

   
    


    

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

        // Generate advice based on the age of the device and estimated lifespan
        $advice = [];

        if ($ageInYears >= $estimatedLifespan) {
            $advice = 'Device has almost reached its lifespan.';

            // Add specific advice based on the item category
            switch ($item->itemCategory->item_category) {
                case 'Desktop Computer':
                    $advice .= ' Check internals for dust and clean if they are dirty or upgrade device.';
                    break;
                case 'Laptop':
                    $advice .= ' Consider upgrading your storage to SSD if HDD is still in use or upgrade device.';
                    break;
                case 'Smartphone':
                    $advice .= ' Consider getting a new battery if your current one is not holding a charge or upgrade device.';
                    break;
                case 'Tablet':
                    $advice .= ' Consider getting a new tablet case if you want to protect your device from drops and scratches or upgrade device.';
                    break;
                default:
                    break;
            }
        } else {
            $advice = 'Device in optimal condition.';
        }

        // Save the advice to the database
        $item->update([
            'advice' => json_encode($advice),
        ]);
    }
}

public function getMessages()
{
    $messages = Item::select('item_name', 'advice')
                    ->where('advice', '!=', '"Device in optimal condition."')
                    ->get();

    return response()->json(['messages' => $messages]);
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
        $post_status_id  = Status::all();
        $categories  = ItemCategory::all();
        $unit_types = UnitType::all();
        $inventory_types = InventoryType::all();
        return view('layouts.items.create')
            ->with('categories', $categories)
            ->with('unit_types', $unit_types)
            ->with('post_status_id', $post_status_id)
            ->with('inventory_types', $inventory_types)
            ->with('item', $item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {


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
        
        $item->update($validatedData);
        

    
       
        return redirect()->route('item.index')
            ->with('info', 'Item has been updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('item.index')
            ->with('danger', 'Item has been deleted successfully');
    }
    public function fetchAdvices()
    {
        $advices = Item::pluck('advice')->toArray();

        return response()->json($advices);
    }
    
}
