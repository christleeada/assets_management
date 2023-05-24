<x-app-layout>
    <div class="col-md-12 col-sm-12">
        @include('layouts.flash.flash')
        <div class="x_panel">
            <div class="x_content">

                <!-- Add New Button -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewModal">
                    <i class="fa fa-plus"></i>
                    <span class="vr"></span>
                    Add New
                </button>

                <!-- Add New Modal -->
                <div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addNewModalLabel">Add New</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('unit_type.store') }}" class="form-horizontal">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="unit_type" class="col-sm-2 col-form-label">Unit Type</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="unit_type" class="form-control" id="unit_type">
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

                <!-- Existing Table Code -->
                <div class="table-responsive">
                    <table id="unittypeTable" class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr class="headings">
                                <th class="column-title">Unit Type</th>
                                <th class="column-title"><span class="nobr">Action</span></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($data as $value)
                            <tr class="even pointer">
                                <td class="">{{$value->unit_type}}</td>
                                <td class="">
                                    <div class="btn-group">
                                        <!-- Edit Button (Modal Trigger) -->
                                        <button type="button" class="btn btn-info m-1 btn-sm rounded" data-toggle="modal" data-target="#editModal{{$value->id}}" title="Edit">
                                            <i class="fa fa-edit" small></i>
                                        </button>

                                        <!-- Delete Button (Form Submission) -->
                                        <form action="{{ route('unit_type.destroy', $value->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger delete-header m-1 btn-sm rounded" title="Delete">
                                                <i class="fa fa-trash" small></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
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
                                            <form method="post" action="{{ route('unit_type.update', $value->id) }}" class="form-horizontal">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group row">
                                                    <label for="unit_type{{$value->id}}" class="col-sm-2 col-form-label">Unit Type</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="unit_type" class="form-control" id="unit_type{{$value->id}}" value="{{$value->unit_type}}">
                                                    </div>
                                                </div>
                                                <!-- Add any additional fields here -->

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@include('layouts.scripts.unittype-script')
@include('layouts.scripts.messages-script')
