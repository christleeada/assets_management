<x-app-layout>
  <div class="col-md-12 col-sm-12  ">
    @include('layouts.flash.flash')
    <div class="x_panel">
      <div class="x_content">

        <a href="{{route('item.create')}}" class="btn btn-primary">
          <i class="fa fa-plus"></i>
          <span class="vr"></span>
          Add New
        </a>

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
            <option value="{{$category}}">{{ $category }}</option>
            @endforeach
          </select>




          <a href="{{ route('item.csv') }}" class="btn btn-success m-1 btn-sm rounded">CSV</a>
          <span style="padding-left: 5px;"></span>
          <a href="{{ route('item.pdf') }}" class="btn btn-info m-1 btn-sm rounded">PDF</a>
          <span style="padding-left: 5px;"></span>
          <a href="{{ route('item.print') }}" class="btn btn-primary m-1 btn-sm rounded">Print</a>
          <span style="padding-left: 5px;"></span>
          <a href="{{ route('item.printqr') }}" class="btn btn-primary m-1 btn-sm rounded">Print QR Codes</a>
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
                    <a href="{{ route('item.edit', $value->id) }}" class="btn btn-info m-1 btn-sm rounded" title="Edit">
                      <i class="fa fa-edit sm"></i>
                    </a>
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