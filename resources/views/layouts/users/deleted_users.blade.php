<x-app-layout>
    <div class="col-md-12 col-sm-12  ">
        @include('layouts.flash.flash')
        <div class="x_panel">
            <div class="x_content">

                
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
                                <th class="column-title">Role</th>
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
                                <td class=" ">{{$value->role}}</td>      
                                <td class=" ">
                                    <div class="btn-group">
                                        
                                        
                                    <form action="{{ route('user.restore', $value->id) }}" method="POST" style="display: inline;">
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