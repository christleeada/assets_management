<x-app-layout>
    <div class="row">

        <div class=" col-sm-12 ">
            <div class="x_panel">
                <div class="x_title text-center">
                    <h2>Assets Form</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    @if(isset($inventory))
                    <form method="post" action="{{ route('inventory.update', ['inventory' => $inventory->id]) }}" enctype='multipart/form-data' class="form-horizontal">
                        @method('put')
                        @else
                        <form method="post" action="{{ route('inventory.store') }}" enctype="multipart/form-data" class="form-horizontal">
                            @endif
                            @csrf
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group row">
                                        <label for="date" class="col-sm-2 col-form-label">Date</label>
                                        <div class="col-sm-10">
                                            <input type="date" name="date" value="{{ old('date', isset($inventory->date) ? $inventory->date : '') }}" class="form-control" id="date">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inventory_type" class="col-sm-2 col-form-label">Inventory Type</label>
                                        <div class="col-sm-10">
                                            <select name="inventory_type" class="form-control" id="inventory_type">
                                                <option>Select Inventory Type</option>
                                                @foreach ($inventory_types as $inventory_type)
                                                <option value="{{ $inventory_type->id }}" {{ old('inventory_type', isset($inventory_type->inventory_type) ? $inventory_type->inventory_type : '') == $inventory_type->id ? 'selected' : '' }}>{{ $inventory_type->inventory_type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="location_name" class="col-sm-2 col-form-label">Location</label>
                                        <div class="col-sm-10">
                                            <select name="location_name" class="form-control" id="location">
                                                <option>Select Location</option>
                                                @foreach ($locations as $location)
                                                <option value="{{ $location->id }}" {{ old('location_name', isset($location->location_name) ? $location->location_name : '') == $location->id ? 'selected' : '' }}>{{ $location->location_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="remarks" class="col-sm-2 col-form-label">Remarks</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="remarks" value="{{ old('remarks', isset($inventory->remarks) ? $inventory->remarks : '') }}" class="form-control" id="remarks">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <a id="add-item" class="btn btn-secondary float-right">Add Item</a>
                            </div>

                            <div class="row">
                                <div class="table-responsive">
                                    <table id="table-item" class="table table-striped jambo_table bulk_action">
                                        <thead>
                                            <tr class="headings">
                                                <th class="column-title">Item Name</th>
                                    
                                                <th class="column-title"><span class="nobr">Action</span></th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                            <button class="btn btn-primary float-right">Add</button>
                                        <a href="{{route('inventory.index')}}" class="btn btn-warning float-left">Cancel</a>
                            </div>

                        </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    $(document).ready(function() {
        $('#add-item').click(function() {
            $('#table-item').append(`@include('layouts.dropdownItems.dropdown')`);
        });

        
    });
</script>
@include('layouts.scripts.messages-script')
