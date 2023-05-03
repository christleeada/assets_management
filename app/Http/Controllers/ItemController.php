<?php
namespace App\Http\Controllers;


use App\Models\InventoryType;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\ItemCategory;
use App\Models\Status;
use App\Models\UnitType;
use Carbon\Carbon;




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

    
    public function create()
    {
        $statuses = Status::all();
        $categories = ItemCategory::all();
        $unit_types = UnitType::all();
        $inventory_types = InventoryType::all();
        return view('layouts.items.create')
            ->with('categories',$categories)
            ->with('unit_types',$unit_types)
            ->with('inventory_types',$inventory_types)
            ->with('statuses',$statuses);

    
    ;}

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'item_name' => 'required',
        'brand' => 'required',
        'description' => 'required',
        'sku_no' => 'required',
        'upc_no' => 'required',
        'price' => 'required',
        'item_category' => 'required',
        'post_status_id' => 'required',
        'unit_type' => 'required',
        'quantity' => 'required',
        'remarks' => 'required',
        'image' => 'required|image',
    ]);

    $item_image = Item::create($validatedData);

    if($request->hasfile('image'))
    {
        $file = $request->file('image');
        $extenstion = $file->getClientOriginalExtension();
        $filename = time().'.'.$extenstion;
        $file->move('uploads/image/', $filename);
        $item_image->image = $filename;
        $item_image->save();
    }

    
    return redirect()->route('item.index')->with('success', 'Item created successfully.');
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
            ->with('categories',$categories)
            ->with('unit_types',$unit_types)
            ->with('post_status_id',$post_status_id)
            ->with('inventory_types',$inventory_types)
            ->with('item',$item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        
       
        $validatedData = $request->validate([
            'inventory_type' => 'required',
            'item_name' => 'required',
            'brand' => 'required',
            'post_status_id' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:20148',
            'price' => 'required',
            'unit_type' => 'required',
            'item_category' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'sku_no' => 'required',
            'upc_no' => 'required',
            'remarks' => 'nullable',
            'recommendations' => 'nullable',
        ]);
    
       $item->update($validatedData);
    
        return redirect()->route('item.index')
            ->with('info', 'Item category has been updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();
    
        return redirect()->route('item.index')
            ->with('danger', 'item has been deleted successfully');
    }
    public function updateRecommendations($itemId)
    {
        $item = Item::findOrFail($itemId);

        // Calculate the age of the device
        $itemCategory = $item['item_category'];
        
        $dateBought = Carbon::createFromFormat('Y-m-d', $item->purchase_date);
        $ageInYears = $dateBought->diffInYears(Carbon::now());

        // Generate recommendations based on the age of the device
        

        $recommendations = '';

        if ($itemCategory === 'Desktop Computer' && $ageInYears >= 5) {
            // add additional random recommendations
    $random_recommendations = array(
        'Check internals for dust and clean if are dirty.',
        'Repaste cpu and gpu',
        'Consider upgrading your storage to SSD if HDD is slow.'
    );
    $rand_key = array_rand($random_recommendations);
    $recommendations .= ', '.$random_recommendations[$rand_key];
    $recommendations .= 'Upgrade device';}
    else if ($itemCategory === 'Laptop' && $ageInYears >= 3) {
        $random_recommendations = array(
            'Check internals for dust and clean if are dirty. Dust build up could block airflow and may cause overheat.',
            'Repaste cpu and gpu',
            'Consider upgrading your storage to SSD if HDD is slow.'
        );
        $rand_key = array_rand($random_recommendations);
        $recommendations .= ', '.$random_recommendations[$rand_key];
        $recommendations .= 'Upgrade device';
    }
    if ($itemCategory === 'Smart TV' && $ageInYears >= 10) {
        $recommendations .= 'Consider upgrading to a newer smart TV model with advanced features such as HDR and Dolby Vision';
    
        // add additional random recommendations
        $random_recommendations = array(
            'Choose a TV with a larger screen size for better immersion',
            'Look for a smart TV with built-in voice assistants such as Google Assistant or Amazon Alexa',
            'Consider investing in a soundbar or a home theater system to enhance your TV\'s audio quality',
            'Check for the latest smart TV operating systems such as Android TV or Roku TV'
        );
        $rand_key = array_rand($random_recommendations);
        $recommendations .= ', '.$random_recommendations[$rand_key];
    } else {
        $recommendations .= 'No recommendations';
    }
    
    
    
   

           

    

        // Update the recommendations column in the items table
        $item->recommendations = $recommendations;
        $item->save();

        return response()->json(['message' => 'Recommendations updated']);
    }
}
