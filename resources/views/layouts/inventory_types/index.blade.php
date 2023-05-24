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
                <!-- Add New Modal -->
             <div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addNewModalLabel">New Department</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('inventory_type.store') }}" class="form-horizontal">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="inventory_type" class="col-sm-2 col-form-label">Inventory Type</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="inventory_type" class="form-control" id="inventory_type">
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
                    <table id="inventorytypeTable" class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr class="headings">
                                <th class="column-title">Inventory Types </th>
                               
                                <th class="column-title"><span class="nobr">Action</span></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($data as $value)
                            <tr class="even pointer">
                                <td class=" ">{{$value->inventory_type}}</td>
                              
                                <td class=" ">
                                    <div class="btn-group">
                                    <button type="button" class="btn btn-info m-1 btn-sm rounded" data-toggle="modal" data-target="#editModal{{$value->id}}" title="Edit">
                                            <i class="fa fa-edit" small></i>
                                        </button>
                            
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
                                            <form method="post" action="{{ route('inventory_type.update', $value->id) }}" class="form-horizontal">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group row">
                                                    <label for="inventory_type{{$value->id}}" class="col-sm-12 col-form-label">Inventory Type</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="inventory_type" class="form-control" id="inventory_type{{$value->id}}" value="{{$value->inventory_type}}">
                                                    </div>
                                                </div>
                                                <!-- Add any additional fields here -->

                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary float-right">Save</button>
                                                <button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Cancel</button>
                                            </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                        <form action="{{ route('inventory_type.destroy', $value->id) }}" method="POST">

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
@include('layouts.scripts.inventorytype-script')
@include('layouts.scripts.messages-script')