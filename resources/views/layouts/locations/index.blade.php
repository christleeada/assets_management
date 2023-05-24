<x-app-layout>
    <div class="col-md-12 col-sm-12  ">
        @include('layouts.flash.flash')
        <div class="x_panel">
            <div class="x_content">

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewModal">
                    <i class="fa fa-plus"></i>
                    <span class="vr"></span>
                    Add New
                </button>

                <div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addNewModalLabel">New Location</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('location.store') }}" class="form-horizontal">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="dept_id" class="col-sm-2 col-form-label">Department</label>
                                        <div class="col-sm-10">
                                            <select name="dept_id" class="form-control" id="department">
                                                <option>Select Department</option>
                                                @foreach ($departments as $department)
                                                <option value="{{ $department->id }}" {{ old('dept_id', isset($location->dept_id) ? $location->dept_id : '') == $department->id ? 'selected' : '' }}>{{ $department->department }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="location_name" class="col-sm-2 col-form-label">Location name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="location_name" value="{{old('location_name', isset($location->location_name) ? $location->location_name : '')}}" class="form-control" id="location_name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="location_address" class="col-sm-2 col-form-label">Location Address</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="location_address" value="{{old('location_address', isset($location->location_address) ? $location->location_address : '')}}" class="form-control" id="location_address">
                                        </div>
                                    </div>
                                    <!-- Add any additional fields here -->

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="table-responsive">
                    <table id="locationTable" class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr class="headings">
                                <th class="column-title">Department</th>
                                <th class="column-title">Location Name</th>
                                <th class="column-title">Location Address</th>
                                <th class="column-title">Status </th>
                                <th class="column-title"><span class="nobr">Action</span></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($data as $value)
                            <tr class="even pointer">
                                <td class=" ">{{$value->department->department}}</td>
                                <td class=" ">{{$value->location_name}}</td>
                                <td class=" ">{{$value->location_address}}</td>
                                <td class=" "> <span class="badge badge-secondary">{{$value->status->status ?? ''}}</span></td>
                                <td class=" ">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info m-1 btn-sm rounded" data-toggle="modal" data-target="#editModal{{$value->id}}" title="Edit">
                                            <i class="fa fa-edit" small></i>
                                        </button>


                                    </div>
                                    <div class="modal fade" id="editModal{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{$value->id}}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{$value->id}}">Edit</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <form method="post" action="{{ route('location.update', $value->id) }}" class="form-horizontal">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="col-sm-8">
                                                            <select name="dept_id" class="form-control" id="location{{$value->id}}" value="{{$value->dept_id}}">
                                                                <option>Select Department</option>
                                                                @foreach ($departments as $department)
                                                                <option value="{{ $department->id }}" {{ old('dept_id', isset($value->dept_id) ? $value->dept_id : '') == $department->id ? 'selected' : '' }}>
                                                                    {{ $department->department }}
                                                                    @endforeach
                                                            </select>
                                                        </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="location_name" class="col-sm-4 col-form-label">Location name</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="location_name" class="form-control" id="location{{$value->id}}" value="{{$value->location_name}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="location_address" class="col-sm-4 col-form-label">Location Address</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" name="location_address" class="form-control" id="location{{$value->id}}" value="{{$value->location_address}}">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                    <form action="{{ route('location.destroy', $value->id) }}" method="POST">

                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger delete-header m-1 btn-sm rounded" title="Delete"><i class="fa fa-trash" small></i></button>
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
@include('layouts.scripts.location-script')
@include('layouts.scripts.messages-script')