<x-app-layout>
    <div class="row">

        <div class="offset-2 col-md-8 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title text-center">
                    <h2>Assets Form</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    @if(isset($item))
                    <form method="post" action="{{ route('item.update', ['item' => $item->id]) }}" enctype='multipart/form-data' class="form-horizontal">
                    @method('PUT')
                    @else
                    <form method="post" action="{{ route('item.store') }}" enctype="multipart/form-data" class="form-horizontal">
                    @endif
                    @csrf
                           
                    <div class="form-group row">
                                <label for="item_name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="item_name" value="{{ old('item_name', isset($item->item_name) ? $item->item_name : '') }}" class="form-control" id="item_name"> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="brand" class="col-sm-2 col-form-label">Brand</label>
                                <div class="col-sm-10">
                                <select name="brand" class="form-control" id="brand">
                                <option value="Apple" {{ (old('brand', isset($item->brand) ? $item->brand : '') == 'Apple') ? 'selected' : '' }}>Apple</option>
                                <option value="Samsung" {{ (old('brand', isset($item->brand) ? $item->brand : '') == 'Samsung') ? 'selected' : '' }}>Samsung</option>
                                <option value="Dell" {{ (old('brand', isset($item->brand) ? $item->brand : '') == 'Dell') ? 'selected' : '' }}>Dell</option>
                                <option value="Lenovo" {{ (old('brand', isset($item->brand) ? $item->brand : '') == 'Lenovo') ? 'selected' : '' }}>Lenovo</option>
                                <option value="Asus" {{ (old('brand', isset($item->brand) ? $item->brand : '') == 'Asus') ? 'selected' : '' }}>Asus</option>
                                <option value="HP" {{ (old('brand', isset($item->brand) ? $item->brand : '') == 'HP') ? 'selected' : '' }}>HP</option>
                                <option value="Razer" {{ (old('brand', isset($item->brand) ? $item->brand : '') == 'Razer') ? 'selected' : '' }}>Razer</option>
                                <option value="Others" {{ (old('brand', isset($item->brand) ? $item->brand : '') == 'Others') ? 'selected' : '' }}>Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <input type="text" name="description" value="{{ old('description', isset($item->description) ? $item->description : '') }}" class="form-control" id="description">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="sku_no" class="col-sm-2 col-form-label">SKU No</label>
                                <div class="col-sm-10">
                                    <input type="text" name="sku_no" value="{{ old('sku_no', isset($item->sku_no) ? $item->sku_no : '') }}" class="form-control" id="sku_no">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="upc_no" class="col-sm-2 col-form-label">UPC No</label>
                                <div class="col-sm-10">
                                    <input type="text" name="upc_no" value="{{ old('upc_no', isset($item->upc_no) ? $item->upc_no : '') }}" class="form-control" id="upc_no">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="price" class="col-sm-2 col-form-label">Price</label>
                                <div class="col-sm-10">
                                    <input type="text" name="price" value="{{ old('price', isset($item->price) ? $item->price : '') }}" class="form-control" id="price">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="item_category" class="col-sm-2 col-form-label">Item Category</label>
                                <div class="col-sm-10">
                                    <select name="item_category" class="form-control" id="item_category">
                                        <option>Select Category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category', isset($item->item_category) ? $item->item_category : '') == $category->id ? 'selected' : '' }}>{{ $category->item_category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="unit_type" class="col-sm-2 col-form-label">Unit Type</label>
                                <div class="col-sm-10">
                                    <select name="unit_type" class="form-control" id="unit_type">
                                    <option>Select Unit Type</option>
                                        @foreach ($unit_types as $unit_type)
                                        <option value="{{ $unit_type->id }}" {{ old('unit_type', isset($item->unit_type) ? $item->unit_type : '') == $unit_type->id ? 'selected' : '' }}>{{ $unit_type->unit_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                                <div class="col-sm-10">
                                    <input type="text" name="quantity" value="{{ old('quantity', isset($item->quantity) ? $item->quantity : '') }}" class="form-control" id="quantity">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="date_purchased" class="col-sm-2 col-form-label">Purchase Date</label>
                                <div class="col-sm-10">
                                    <input type="date" name="date_purchased" value="{{ old('date_purchased', isset($item->date_purchased) ? $item->date_purchased : '') }}" class="form-control" id="date_purchased">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="remarks" class="col-sm-2 col-form-label">Remarks</label>
                                <div class="col-sm-10">
                                    <input type="text" name="remarks" value="{{ old('remarks', isset($item->remarks) ? $item->remarks : '') }}" class="form-control" id="remarks">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <input type="file" name="image" value="{{ old('image', isset($item->image) ? $item->image : '') }}" class="form-control" accept="image/" id="image">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10 offset-sm-2">
                                    <button  class="btn btn-primary float-right">Add</button>
                                    <a href="{{route('item.index')}}" class="btn btn-warning float-left">Cancel</a>
                                </div>
                            </div>
                    </form>
                 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>