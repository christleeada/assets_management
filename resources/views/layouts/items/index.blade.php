<x-app-layout>
  <div class="col-md-12 col-sm-12  ">
    @include('layouts.flash.flash')
    <div class="x_panel">
      <div class="x_content">

      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewModal" id="addNewButton">
    <i class="fa fa-plus"></i>
    <span class="vr"></span>
    Add New
</button>

<!-- Add Asset Modal content -->

<div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="addNewModalLabel">Assets Form</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="offset-2 col-md-8 col-sm-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <br>
                                @if(isset($item))
                                <form method="post" action="{{ route('item.update', ['item' => $item->id]) }}" enctype="multipart/form-data" class="form-horizontal">
                                @method('PUT')
                                @else
                                <form method="post" action="{{ route('item.store') }}" enctype="multipart/form-data" class="form-horizontal">
                                @endif
                                @csrf
                                <div class="form-group row">
                                    <label for="post_status_id" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select name="post_status_id" class="form-control" id="post_status_id">
                                            <option>Select Status</option>
                                            @foreach ($statuses as $status)
                                            <option value="{{ $status->id }}" {{ old('post_status_id', isset($item->post_status_id) ? $item->post_status_id : '') == $status->id ? 'selected' : '' }}>
                                                {{ $status->status }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="item_name" class="col-sm-2 col-form-label"> Asset Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="item_name" value="{{ old('item_name', isset($item->item_name) ? $item->item_name : '') }}" class="form-control" id="item_name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="brand" class="col-sm-2 col-form-label">Brand</label>
                                    <div class="col-sm-10">
                                        <select name="brand" class="form-control" id="brand">
                                            <option>Select Brand</option>
                                            <option value="Apple" {{ (old('brand', isset($item->brand) ? $item->brand : '') == 'Apple') ? 'selected' : '' }}>Apple</option>
                                            <option value="Samsung" {{ (old('brand', isset($item->brand) ? $item->brand : '') == 'Samsung') ? 'selected' : '' }}>Samsung</option>
                                            <option value="Dell" {{ (old('brand', isset($item->brand) ? $item->brand : '') == 'Dell') ? 'selected' : '' }}>Dell</option>
                                            <option value="Lenovo" {{ (old('brand', isset($item->brand) ? $item->brand : '') == 'Lenovo') ? 'selected' : '' }}>Lenovo</option>
                                            <option value="Asus" {{ (old('brand', isset($item->brand) ? $item->brand : '') == 'Asus') ? 'selected' : '' }}>Asus</option>
                                            <option value="HP" {{ (old('brand', isset($item->brand) ? $item->brand : '') == 'HP') ? 'selected' : '' }}>HP</option>
                                            <option value="Razer" {{ (old('brand', isset($item->brand) ? $item->brand : '') == 'Razer') ? 'selected' : '' }}>Razer</option>
                                            <option value="Toshiba" {{ (old('brand', isset($item->brand) ? $item->brand : '') == 'Toshiba') ? 'selected' : '' }}>Toshiba</option>
                                            <option value="Acer" {{ (old('brand', isset($item->brand) ? $item->brand : '') == 'Acer') ? 'selected' : '' }}>Acer</option>
                                            <option value="Microsoft" {{ (old('brand', isset($item->brand) ? $item->brand : '') == 'Microsoft') ? 'selected' : '' }}>Microsoft</option>
                                            <option value="Fujitsu" {{ (old('brand', isset($item->brand) ? $item->brand : '') == 'Fujitsu') ? 'selected' : '' }}>Fujitsu</option>
                                            <option value="VAIO" {{ (old('brand', isset($item->brand) ? $item->brand : '') == 'VAIO') ? 'selected' : '' }}>VAIO</option>
                                            <option value="Alienware" {{ (old('brand', isset($item->brand) ? $item->brand : '') == 'Alienware') ? 'selected' : '' }}>Alienware</option>
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
                                            <option value="{{ $category->id }}" {{ old('category', isset($item->item_category->id) ? $item->item_category->id : '') == $category->id ? 'selected' : '' }}>

                                                {{ $category->item_category }}
                                            </option>
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
                                            <option value="{{ $unit_type->id }}" {{ old('unit_type', isset($item->unit_type) ? $item->unit_type : '') == $unit_type->id ? 'selected' : '' }}>
                                                {{ $unit_type->unit_type }}
                                            </option>
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
                                    <label for="purchased_as" class="col-sm-2 col-form-label">Condition</label>
                                    <div class="col-sm-10">
                                        <select name="purchased_as" class="form-control" id="purchased_as">
                                            <option>Select</option>
                                            <option value="New" {{ (old('purchased_as', isset($item->purchased_as) ? $item->purchased_as : '') == 'New') ? 'selected' : '' }}>New</option>
                                            <option value="Used" {{ (old('purchased_as', isset($item->purchased_as) ? $item->purchased_as : '') == 'Used') ? 'selected' : '' }}>Used</option>
                                        </select>
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
                                        <button class="btn btn-primary float-right">Add</button>
                                        <a href="{{ route('item.index') }}" class="btn btn-warning float-left">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>









        <div class="table-responsive">

          <div class="magnifier-container">
            <div class="magnifier"></div>
          </div>
          <style>
            .custom-dropdown {
              padding: 5px 10px;
              border: 1px solid #ccc;
              border-radius: 4px;
              background-color: #f9f9f9;
              color: #0B2447;
              font-size: 14px;
              width: 200px;
            }

            .custom-dropdown:hover {
              background-color: #e0e0e0;
            }

            .custom-dropdown:focus {
              outline: none;
              box-shadow: 0 0 4px #bbb;
            }
          </style>
          
          <select id="filterDropdown" class="custom-dropdown">
            <option value="">All</option>
            @foreach ($categories as $category)
            <option value="{{ $category->item_category }}">{{ $category->item_category }}</option>
            @endforeach
          </select>


          <table id="itemTable" class="table table-striped jambo_table bulk_action">
            <!-- Button to open the filter modal -->
            <button type="button" class="btn btn-success m-1 btn-sm rounded" data-toggle="modal" data-target="#filterModal">
              Date Filter
            </button>

            <!-- Filter Modal -->
            <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Date Filter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="startDate">Start Date</label>
                      <input type="date" class="form-control" id="startDate">
                    </div>
                    <div class="form-group">
                      <label for="startTime">Start Time</label>
                      <input type="time" class="form-control" id="startTime">
                    </div>
                    <div class="form-group">
                      <label for="endDate">End Date</label>
                      <input type="date" class="form-control" id="endDate">
                    </div>
                    <div class="form-group">
                      <label for="endTime">End Time</label>
                      <input type="time" class="form-control" id="endTime">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="applyFilter">Apply Filter</button>
                  </div>
                </div>
              </div>
            </div>

            @csrf

            <thead>


              <link href="{{ asset('asset/vendors/nprogress/support/style.css') }}" rel="stylesheet">
              <tr class="headings">
                <th class="column-title">QR Code</th>
                <th class="column-title">Name</th>
                <th class="column-title">Price</th>
                <th class="column-title">Category</th>
                <th class="column-title">Quantity </th>
                <th class="column-title">Unit Type</th>
                <th class="column-title">Date Purchased</th>
                <th class="column-title">Date Added</th>

                <th class="column-title">Status</th>
                <th class="column-title"><span class="nobr"></span></th>
              </tr>
            </thead>

            <tbody>
              @foreach($data as $value)
              
                <td><img class="qr-code" src="data:image/png;base64,{{ $value->qrcode_image }}" alt="QR Code"></td>
                <td class=" ">
                  <a href="{{ route('item.show', $value->id) }}" title="{{ $value->item_name }}">{{ $value->item_name }}</a>
                </td>

                <td class=" ">₱{{$value->price}}</td>
                <td class=" ">{{$value->itemCategory->item_category}}</td>
                <td class=" ">{{$value->quantity}}</td>
                <td class=" ">{{$value->unitType->unit_type}}</td>
                <td class=" ">{{$value->date_purchased}}</td>
                <td class=" ">{{$value->created_at}}</td>
                <td class="">
                  @if($value->post_status_id === 5)
                  <span class="badge badge-warning">{{ $statuses->find($value->post_status_id)->status }}</span>
                  @elseif($value->post_status_id === 4)
                  <span class="badge badge-warning">{{ $statuses->find($value->post_status_id)->status }}</span>
                  @elseif($value->post_status_id === 3)
                  <span class="badge badge-primary">{{ $statuses->find($value->post_status_id)->status }}</span>
                  @elseif($value->post_status_id === 2)
                  <span class="badge badge-dark">{{ $statuses->find($value->post_status_id)->status }}</span>
                  @elseif($value->post_status_id === 1)
                  <span class="badge badge-success">{{ $statuses->find($value->post_status_id)->status }}</span>

                  @endif

                </td>
                <td class=" ">
                  <div class="btn-group">
                    @if($value->post_status_id === 4)

                    <form action="{{ route('item.fix', $value->id) }}" method="POST" style="display: inline;">
                      @csrf
                      <button type="submit" class="btn btn-success delete-header m-1 btn-sm rounded" title="Fixed">
                        <i class="fa fa-wrench sm"></i>
                      </button>
                    </form>
                    @endif
                    <button class="btn btn-info m-1 btn-sm rounded" title="Edit" data-toggle="modal" data-target="#editModal{{ isset($value) ? $value->id : '' }}">
                        <i class="fa fa-edit sm"></i>
                    </button>


                    <form action="{{ route('item.markAsDeleted', $value->id) }}" method="POST" style="display: inline;">
                      @method('PUT')
                      @csrf
                      <button class="btn btn-danger delete-header m-1 btn-sm rounded" title="Delete">
                        <i class="fa fa-trash sm"></i>
                      </button>
                    </form>
                    </div>
                </td>
                </td>
              </tr>

              @endforeach
            </tbody>

          </table>

        </div>


      </div>
    </div>
  </div>
</x-app-layout>
@include('layouts.scripts.items-script')
@include('layouts.scripts.messages-script')

<!-- Modal -->
<div class="modal fade" id="editModal{{ isset($value) ? $value->id : '' }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="editModalLabel">Edit Asset</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                  <!-- Place your form code here -->
                                  <form method="post" action="{{ isset($value) ? route('item.update', ['item' => $value->id]) : '' }}" enctype="multipart/form-data" class="form-horizontal">
                                                    @csrf
                                                    @method('PUT')
                                     
                                      <!-- Add your form fields here -->
                                      <!-- For example: -->
                                      
                                      <div class="form-group row">
                                    <label for="post_status_id" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                    <select name="post_status_id" class="form-control" id="item{{ isset($value) ? $value->post_status_id : '' }}" value="{{ isset($value) ? $value->post_status_id : '' }}">
                                            <option>Select Status</option>
                                            @foreach ($statuses as $status)
                                            <option value="{{ $status->id }}" {{ old('post_status_id', isset($value->post_status_id) ? $value->post_status_id : '') == $status->id ? 'selected' : '' }}>
                                                {{ $status->status }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="item_name" class="col-sm-2 col-form-label"> Asset Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="item_name" class="form-control" id="item{{ isset($value) ? $value->item_name : '' }}" value="{{ isset($value) ? $value->item_name : '' }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="brand" class="col-sm-2 col-form-label">Brand</label>
                                    <div class="col-sm-10">
                                        <select name="brand" class="form-control" id="brand">
                                            <option>Select Brand</option>
                                            <option value="Apple" {{ (old('brand', isset($value->brand) ? $value->brand : '') == 'Apple') ? 'selected' : '' }}>Apple</option>
                                            <option value="Samsung" {{ (old('brand', isset($value->brand) ? $value->brand : '') == 'Samsung') ? 'selected' : '' }}>Samsung</option>
                                            <option value="Dell" {{ (old('brand', isset($value->brand) ? $value->brand : '') == 'Dell') ? 'selected' : '' }}>Dell</option>
                                            <option value="Lenovo" {{ (old('brand', isset($value->brand) ? $value->brand : '') == 'Lenovo') ? 'selected' : '' }}>Lenovo</option>
                                            <option value="Asus" {{ (old('brand', isset($value->brand) ? $value->brand : '') == 'Asus') ? 'selected' : '' }}>Asus</option>
                                            <option value="HP" {{ (old('brand', isset($value->brand) ? $value->brand : '') == 'HP') ? 'selected' : '' }}>HP</option>
                                            <option value="Razer" {{ (old('brand', isset($value->brand) ? $value->brand : '') == 'Razer') ? 'selected' : '' }}>Razer</option>
                                            <option value="Toshiba" {{ (old('brand', isset($value->brand) ? $value->brand : '') == 'Toshiba') ? 'selected' : '' }}>Toshiba</option>
                                            <option value="Acer" {{ (old('brand', isset($value->brand) ? $value->brand : '') == 'Acer') ? 'selected' : '' }}>Acer</option>
                                            <option value="Microsoft" {{ (old('brand', isset($value->brand) ? $value->brand : '') == 'Microsoft') ? 'selected' : '' }}>Microsoft</option>
                                            <option value="Fujitsu" {{ (old('brand', isset($value->brand) ? $value->brand : '') == 'Fujitsu') ? 'selected' : '' }}>Fujitsu</option>
                                            <option value="VAIO" {{ (old('brand', isset($value->brand) ? $value->brand : '') == 'VAIO') ? 'selected' : '' }}>VAIO</option>
                                            <option value="Alienware" {{ (old('brand', isset($value->brand) ? $value->brand : '') == 'Alienware') ? 'selected' : '' }}>Alienware</option>
                                            <option value="Others" {{ (old('brand', isset($value->brand) ? $value->brand : '') == 'Others') ? 'selected' : '' }}>Others</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="description" id="item{{ isset($value) ? $value->description : '' }}" value="{{ isset($value) ? $value->description : '' }}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="price" class="col-sm-2 col-form-label">Price</label>
                                    <div class="col-sm-10">
                                     <input type="text" name="price" id="item{{ isset($value) ? $value->price : '' }}" value="{{ isset($value) ? $value->price : '' }}" class="form-control">
                                    </div>
                                </div>
                             <div class="form-group row">
                            <label for="item_category" class="col-sm-2 col-form-label">Item Category</label>
                            <div class="col-sm-10">
                                <select name="item_category" id="item{{ isset($value) ? $value->item_category : '' }}" value="{{ isset($value) ? $value->item_category : '' }}" class="form-control" >
                                    <option>Select Category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('item_category', isset($value->item_category) ? $value->item_category : '') == $category->id ? 'selected' : '' }}>
                                            {{ $category->item_category }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                                <div class="form-group row">
                              <label for="unit_type" class="col-sm-2 col-form-label">Unit Type</label>
                              <div class="col-sm-10">
                                  <select name="unit_type" class="form-control"id="item{{ isset($value) ? $value->unit_type : '' }}" value="{{ isset($value) ? $value->unit_type : '' }}">
                                      <option>Select Unit Type</option>
                                      @foreach ($unit_types as $unit_type)
                                          <option value="{{ $unit_type->id }}" {{ (old('unit_type', isset($value->unit_type) ? $value->unit_type : '') == $unit_type->id) ? 'selected' : '' }}>
                                              {{ $unit_type->unit_type }}
                                          </option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>

                                <div class="form-group row">
                                    <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                                    <div class="col-sm-10">
                                    <input type="number" name="price" id="item{{ isset($value) ? $value->quantity : '' }}" value="{{ isset($value) ? $value->quantity : '' }}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date_purchased" class="col-sm-2 col-form-label">Purchase Date</label>
                                    <div class="col-sm-10">
                                    <input type="date" name="date_purchased" id="item{{ isset($value) ? $value->date_purchased : '' }}" value="{{ isset($value) ? $value->date_purchased : '' }}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                  <label for="purchased_as" class="col-sm-2 col-form-label">Condition</label>
                                  <div class="col-sm-10">
                                      <select name="purchased_as" class="form-control" id="item{{ isset($value) ? $value->purchased_as : '' }}" value="{{ isset($value) ? $value->purchased_as : '' }}">
                                          <option>Select</option>
                                          <option value="New" {{ (old('purchased_as', isset($value) && $value->purchased_as == 'New') ? 'selected' : '') }}>New</option>
                                          <option value="Used" {{ (old('purchased_as', isset($value) && $value->purchased_as == 'Used') ? 'selected' : '') }}>Used</option>

                                          
                                      </select>
                                  </div>
                              </div>
                                <div class="form-group row">
                                    <label for="remarks" class="col-sm-2 col-form-label">Remarks</label>
                                    <div class="col-sm-10">
                                    <input type="text" name="remarks" id="item{{ isset($value) ? $value->remarks : '' }}" value="{{ isset($value) ? $value->remarks : '' }}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="image" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="image" id="item{{ isset($value) ? $value->image : '' }}" value="{{ isset($value) ? $value->image : '' }}" class="form-control" accept="image/">
                                    </div>
                                </div>
                                      <div>
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Save</button>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>                    