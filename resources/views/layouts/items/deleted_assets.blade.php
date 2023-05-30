<x-app-layout>
    <div class="col-md-12 col-sm-12  ">
        @include('layouts.flash.flash')
        <div class="x_panel">
            <div class="x_content">

                

                <div class="table-responsive">

                <div class="magnifier-container">
                <div class="magnifier"></div>
                </div>
                    <table id="itemTable" class="table table-striped jambo_table bulk_action">
                    
        @csrf
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
    </form>
    
                    
                        <thead>
                        
                        <link href="{{ asset('asset/vendors/nprogress/support/style.css') }}" rel="stylesheet">
                            <tr class="headings">
                                <th class="column-title">QR-Code</th>
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
                            <tr class="even pointer" onclick="window.location='{{ route('item.show', $value->id) }}'" data-item-id="{{ $value->id }}">
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
                                <td class=" ">  @if($value->post_status_id === 4)
                                    <span class="badge badge-warning">{{ $statuses->find($value->post_status_id)->status }}</span>
                                @elseif($value->post_status_id === 3)
                                    <span class="badge badge-primary">{{ $statuses->find($value->post_status_id)->status }}</span>
                                @elseif($value->post_status_id === 2)
                                    <span class="badge badge-secondary">{{ $statuses->find($value->post_status_id)->status }}</span>
                                @elseif($value->post_status_id === 1)
                                    <span class="badge badge-success">{{ $statuses->find($value->post_status_id)->status }}</span>
                                
                                @endif        
                                <td class=" ">
                                    <div class="btn-group">
                                        <a href="{{ route('item.edit', $value->id) }}" class="btn btn-info m-1 btn-sm rounded" title="Edit">
                                            <i class="fa fa-edit sm" ></i>
                                        </a>
                                        
                                    <form action="{{ route('item.restore', $value->id) }}" method="POST" style="display: inline;">
                                        @method('PUT')
                                        @csrf
                                        <button class="btn btn-success m-1 btn-sm rounded" title="Restore">
                                            <i class="fa fa-undo sm" ></i>
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



