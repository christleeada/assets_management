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
        
    
    
                    
                        <thead>
                        
                        <link href="{{ asset('asset/vendors/nprogress/support/style.css') }}" rel="stylesheet">
                            <tr class="headings">
                                
                                <th class="column-title">User</th>
                                <th class="column-title">Events</th>
                                
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($logs as $log)
                            
                                
                            </td>
                                
                                <td class=" ">₱{{$value->user->name}}</td>
                                <td class=" ">{{$value->action}}</td>
                      
                            
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



