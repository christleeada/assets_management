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
        fputcsv($handle, array('QR Code', 'Name', 'SKU No', 'UPC No', 'Price', 'Category', 'Quantity', 'Unit Type', 'Date Purchased', 'Date Added', 'Last Checked', 'Status'));

        foreach ($data as $value) {
            fputcsv($handle, array(
                $value->qrcode_image,
                $value->item_name,
                $value->sku_no,
                $value->upc_no,
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
        'sku_no' => 'required',
        'upc_no' => 'required',
        'price' => 'required',
        'item_category' => 'required',
        'unit_type' => 'required',
        'quantity' => 'required',
        'date_purchased' => 'required|date',
        'remarks' => 'required',
        'image' => 'required|image',
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
    $date_purchased = Carbon::parse($item->date_purchased);
    $text = "Item Name: " . $item->item_name . "\n" .
            "Brand: " . $item->brand . "\n" .
            "Price: " . $item->price . "\n" .
            "Date Purchased: " . $date_purchased->format('Y-m-d') . "\n";
    
    // Generate the QR code as a binary string
    $qrCode = QrCode::format('png')
                     ->size(400)
                     ->errorCorrection('H')
                     ->generate($text);
    
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
public static function generateForItem($id)
{
    $item = Item::findOrFail($id);

    // Calculate the age of the device
    $dateBought = Carbon::createFromFormat('Y-m-d', $item->date_purchased);
    $ageInYears = $dateBought->diffInYears(Carbon::now());

    // Generate advice based on the age of the device
    $advice = [];

    if ($item->item_category === 'Desktop Computer' && $ageInYears >= 5) {
        $advice[] = [
            'title' => 'Device lifespan',
            'message' => 'Device has almost reached its lifespan. Check internals for dust and clean if are dirty or upgrade device.',
        ];
    }

    if ($item->item_category === 'Laptop' && $ageInYears >= 3) {
        $advice[] = [
            'title' => 'Device lifespan',
            'message' => 'Device has almost reached its lifespan. Consider upgrading your storage to SSD if HDD is still in use or upgrade device.',
        ];
    }

    if ($item->item_category === 'Smartphone' && $ageInYears >= 2) {
        $advice[] = [
            'title' => 'Device lifespan',
            'message' => 'Device has almost reached its lifespan. Consider getting a new battery if your current one is not holding a charge or upgrade device.',
        ];
    }

    if ($item->item_category === 'Tablet' && $ageInYears >= 3) {
        $advice[] = [
            'title' => 'Device lifespan',
            'message' => 'Device has almost reached its lifespan. Consider getting a new tablet case if you want to protect your device from drops and scratches or upgrade device.',
        ];
    }

    if (empty($advice)) {
        $advice[] = [
            'title' => 'No advice',
            'message' => 'No advice',
        ];
    }

    // Save the advice to the database
    $item->update([
        'advice' => json_encode($advice),
    ]);

    return $advice;
}








    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
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
            'sku_no' => 'nullable',
            'upc_no' => 'nullable',
            'remarks' => 'nullable',
            'date_purchased' => 'nullable|date',
            
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
