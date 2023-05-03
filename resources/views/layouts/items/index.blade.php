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
                    <table id="itemTable" class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr class="headings">
                                
                                <th class="column-title">Name</th>
                                <th class="column-title">SKU No</th>
                                <th class="column-title">UPC No</th>
                                <th class="column-title">Price</th>
                                <th class="column-title">Category</th>
                                <th class="column-title">Quantity </th>
                                <th class="column-title">Unit Type</th>
                                <th class="column-title">Date Purchased</th>
                                <th class="column-title">Date Added</th>
                                <th class="column-title">Last checked</th>
                                <th class="column-title">Status</th>
                                <th class="column-title"><span class="nobr">Action</span></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($data as $value)
                            <tr class="even pointer">
                                
                                <td class=" ">{{$value->item_name}}</td>
                                <td class=" ">{{$value->sku_no}}</td>
                                <td class=" ">{{$value->upc_no}}</td>
                                <td class=" ">{{$value->price}}</td>
                                <td class=" ">{{$value->itemCategory->item_category}}</td>
                                <td class=" ">{{$value->quantity}}</td>
                                <td class=" ">{{$value->unitType->unit_type}}</td>
                                <td class=" ">{{$value->purchase_date}}</td>
                                <td class=" ">{{$value->created_at}}</td>
                                <td class=" ">{{$value->maintenanced_date}}</td>
                                <td class=" "> <span class="badge badge-secondary">{{$value->status->status}}</span></td>
                                <td class=" ">
                                    <div class="btn-group">
                                        <a href="{{ route('item.edit', $value->id) }}" class="btn btn-info m-1 btn-sm rounded" title="Edit"><i class="fa fa-edit" small>&nbsp Edit</i></a>

                                        <form action="{{ route('item.destroy', $value->id) }}" method="POST">

                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger delete-header m-1 btn-sm rounded" title="Delete"><i class="fa fa-trash" small>&nbsp Delete</i></button>
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