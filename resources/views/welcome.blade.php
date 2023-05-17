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
        <a href="{{ route('item.csv') }}" class="btn btn-success m-1 btn-sm rounded">CSV</a>
        <span style="padding-left: 10px;" ></span>
        <a  href="{{ route('item.pdf') }}" class="btn btn-info m-1 btn-sm rounded">PDF</a>
        <span style="padding-left: 10px;" ></span>
        <a href="{{ route('item.print') }}" class="btn btn-primary m-1 btn-sm rounded">Print</a>
    </form>
    
                    
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
                                
                                
                                
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($data as $value)
                            <tr class="even pointer" onclick="window.location='{{ route('item.showDetails', $value->id) }}'" data-item-id="{{ $value->id }}">
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
                                
                                

                                </td>      
                                
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
@include('layouts.scripts.items-script')
@include('layouts.scripts.messages-script')


