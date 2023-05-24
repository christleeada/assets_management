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
                                <form method="post" action="{{ route('item_category.store') }}" class="form-horizontal">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="item_category" class="col-sm-12 col-form-label">Asset Category</label>
                                        <div class="col-sm-12">
                                            <input type="text" name="item_category" class="form-control" id="item_category">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="estimated_lifespan" class="col-sm-12 col-form-label">Estimated Lifespan</label>
                                        <div class="col-sm-12">
                                        <input type="text" name="estimated_lifespan" value="{{ old('estimated_lifespan', isset($itemCategory->estimated_lifespan) ? $itemCategory->estimated_lifespan : '') }}" class="form-control" id="estimated_lifespan">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="message" class="col-sm-12 col-form-label">Advice</label>
                                        <div class="col-sm-12">
                                            <input type="text" name="message" value="{{old('message', isset($itemCategory->message) ? $itemCategory->message : '')}}" class="form-control" id="message">
                                        </div>
                                    </div>

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
                    <table id="itemcategoryTable" class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr class="headings">
                                <th class="column-title">Asset Category</th>
                                <th class="column-title">Estimated Lifespan </th>
                                <th class="column-title">Advice if lifespan is reached</th>
                                <th class="column-title"><span class="nobr">Action</span></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($data as $value)
                            <tr class="even pointer">
                                <td class=" ">{{$value->item_category}}</td>
                                <td class=" ">{{$value->estimated_lifespan}}</td>
                                <td class=" ">{{$value->message}}</td>
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
                                            <form method="post" action="{{ route('item_category.update', $value->id) }}" class="form-horizontal">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group row">
                                                    <label for="item_category{{$value->id}}" class="col-sm-12 col-form-label">Asset Category</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="item_category" class="form-control" id="item_category{{$value->id}}" value="{{$value->item_category}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="item_category{{$value->id}}" class="col-sm-12 col-form-label">Estimated Lifespan</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="estimated_lifespan" class="form-control" id="item_category{{$value->id}}" value="{{$value->estimated_lifespan}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="item_category{{$value->id}}" class="col-sm-12 col-form-label">Advice if Lifespan is Reached</label>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="message" class="form-control" id="item_category{{$value->id}}" value="{{$value->message}}">
                                                    </div>
                                                </div>
                                                <!-- Add any additional fields here -->

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                        <form action="{{ route('item_category.destroy', $value->id) }}" method="POST">

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
@include('layouts.scripts.itemcategory-script')
@include('layouts.scripts.messages-script')