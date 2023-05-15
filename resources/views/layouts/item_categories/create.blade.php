<x-app-layout>
    <div class="row">

        <div class="offset-2 col-md-8 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title text-center">
                    <h2>Asset Category Form</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    @if(isset($itemCategory))
                    <form method="post" action="{{ route('item_category.update', ['item_category' => $itemCategory->id]) }}" enctype='multipart/form-data' class="form-horizontal">
                        @method('put')
                        @else
                        <form method="post" action="{{ route('item_category.store') }}" enctype="multipart/form-data" class="form-horizontal">
                            @endif

                            @csrf
                            <div class="form-group row">
                                <label for="item_category" class="col-sm-2 col-form-label">Item Category</label>
                                <div class="col-sm-10">
                                    <input type="text" name="item_category" value="{{old('item_category', isset($itemCategory->item_category) ? $itemCategory->item_category : '')}}" class="form-control" id="item_category">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="estimated_lifespan" class="col-sm-2 col-form-label">Estimated Lifespan</label>
                                <div class="col-sm-10">
                                <input type="text" name="estimated_lifespan" value="{{ old('estimated_lifespan', isset($itemCategory->estimated_lifespan) ? $itemCategory->estimated_lifespan : '') }}" class="form-control" id="estimated_lifespan">
                                </div>
                            </div>
                            <button  type="" class="btn btn-primary float-sm-right">Add</button>
                            <a href="{{route('item_category.index')}}" class="btn btn-warning float-sm-left">Cancel</a>
                        </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@include('layouts.scripts.messages-script')