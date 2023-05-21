<x-app-layout>
    <div class="col-md-12 col-sm-12">
        @include('layouts.flash.flash')
        <div class="x_panel">
            <div class="x_content">
                <div class="table-responsive">
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
                    
                    <table id="userlogsTable" class="table table-striped jambo_table bulk_action">
                   
                        <thead>
                            <link href="{{ asset('asset/vendors/nprogress/support/style.css') }}" rel="stylesheet">
                            <tr class="headings">
                                <th class="column-title">User ID</th>
                                <th class="column-title">Role</th>
                                <th class="column-title">User Name</th>
                                <th class="column-title">Events</th>
                                <th class="column-title">Data and time</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $log)
                                <tr>
                                    <td>{{ $log->user->id }}</td>
                                    <td>{{ $log->user->role }}</td>
                                    <td>{{ $log->user->first_name }}</td>
                                    <td>{{ $log->event }}</td>
                                    <td>{{ $log->created_at }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@include('layouts.scripts.user-logs-script')
@include('layouts.scripts.messages-script')
