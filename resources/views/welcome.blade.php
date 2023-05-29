<x-app-layout>
    <div class="col-md-12 col-sm-12  ">
        @include('layouts.flash.flash')
        <div class="x_panel">
            <div class="x_content">
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
         
          <button type="button" class="btn btn-success m-1 btn-sm rounded" data-toggle="modal" data-target="#filterModal">
              Date Filter
            </button>

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

                

                <div class="table-responsive">

                
                    <table id="itemTable" class="table table-striped jambo_table bulk_action">
                    
        @csrf
        
    </form>
    
                    
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
                                
                                
                                
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($data as $value)
                            <tr class="even pointer" onclick="window.location='{{ route('item.showDetails', $value->id) }}'" data-item-id="{{ $value->id }}">
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
                                
                                

                                </td>      
                                
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        new Magnifier({
            magnifier: ".magnifier",
            container: ".magnifier-container",
            cursor: "crosshair",
            zoom: 3,
            zoomable: true
        });
    });
</script>
@include('layouts.scripts.items-script')



