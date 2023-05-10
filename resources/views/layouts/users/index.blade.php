<x-app-layout>
    <div class="col-md-12 col-sm-12  ">
        @include('layouts.flash.flash')
        <div class="x_panel">
            <div class="x_content">

                <a href="{{route('user.create')}}" class="btn btn-primary">
                    <i class="fa fa-plus"></i>
                    <span class="vr"></span>
                    Add New
                </a>

                <div class="table-responsive">
                    <table id="itemTable" class="table table-striped jambo_table bulk_action">
                    
        @csrf
    </form>
 
                        <thead>
                        <link href="{{ asset('asset/vendors/nprogress/support/style.css') }}" rel="stylesheet">
                            <tr class="headings">
                                
                                <th class="column-title">First name</th>
                                <th class="column-title">Last name</th>
                                <th class="column-title">Middle name</th>
                                <th class="column-title">Address</th>
                                <th class="column-title">Contact Number </th>
                                <th class="column-title">Email</th>
                                <th class="column-title">Date created</th>
                                <th class="column-title"><span class="nobr">Action</span></th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($data as $value)
                            <tr class="even pointer">
                            
                                <td class=" ">{{$value->first_name}}</td>
                                <td class=" ">{{$value->last_name}}</td>
                                <td class=" ">{{$value->middle_name}}</td>
                                <td class=" ">{{$value->address}}</td>
                                <td class=" ">{{$value->contact_no}}</td>
                                <td class=" ">{{$value->email}}</td>
                                <td class=" ">{{$value->created_at}}</td>      
                                <td class=" ">
                                    <div class="btn-group">
                                        <a href="{{ route('user.edit', $value->id) }}" class="btn btn-info m-1 btn-sm rounded" title="Edit"><i class="fa fa-edit" small>&nbsp Edit</i></a>

                                        <form action="{{ route('user.destroy', $value->id) }}" method="POST">

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
@include('layouts.scripts.messages-script')