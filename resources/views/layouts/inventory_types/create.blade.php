<x-app-layout>
    <div class="row">

        <div class="offset-2 col-md-8 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title text-center">
                    <h2>Inventory Type Form</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    @if(isset($inventoryType))
                    <form method="post" action="{{ route('inventory_type.update', ['inventory_type' => $inventoryType->id]) }}" enctype='multipart/form-data' class="form-horizontal">
                        @method('put')
                        @else
                        <form method="post" action="{{ route('inventory_type.store') }}" enctype="multipart/form-data" class="form-horizontal">
                            @endif

                            @csrf
                            <div class="form-group row">
                                <label for="inventory_type" class="col-sm-2 col-form-label">Inventory Type</label>
                                <div class="col-sm-10">
                                    <input type="text" name="inventory_type" value="{{old('inventory_type', isset($inventoryType->inventory_type) ? $inventoryType->inventory_type : '')}}" class="form-control" id="inventory_type">
                                </div>
                            </div>
                            <button  type="" class="btn btn-primary float-sm-right">Add</button>
                            <a  class="btn btn-warning float-sm-left">Cancel</a>
                        </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>