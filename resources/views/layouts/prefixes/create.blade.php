<x-app-layout>
    <div class="row">

        <div class="offset-2 col-md-8 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title text-center">
                    <h2>Prefix Form</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    @if(isset($prefix))
                    <form method="post" action="{{ route('prefix.update', ['prefix' => $prefix->id]) }}" enctype='multipart/form-data' class="form-horizontal">
                        @method('put')
                        @else
                        <form method="post" action="{{ route('prefix.store') }}" enctype="multipart/form-data" class="form-horizontal">
                            @endif

                            @csrf
                            <div class="form-group row">
                                <label for="prefix" class="col-sm-2 col-form-label">Prefix</label>
                                <div class="col-sm-10">
                                    <input type="text" name="prefix" value="{{old('prefix', isset($prefix->prefix) ? $prefix->prefix : '')}}" class="form-control" id="prefix">
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
@include('layouts.scripts.messages-script')