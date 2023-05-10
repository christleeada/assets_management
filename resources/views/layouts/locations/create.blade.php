<x-app-layout>
    <div class="row">

        <div class="offset-2 col-md-8 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title text-center">
                    <h2>Room Name Form</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    @if(isset($location))
                    <form method="post" action="{{ route('location.update', ['location' => $location->id]) }}" enctype='multipart/form-data' class="form-horizontal">
                        @method('put')
                        @else
                        <form method="post" action="{{ route('location.store') }}" enctype="multipart/form-data" class="form-horizontal">
                            @endif

                            @csrf
                            <div class="form-group row">
                                <label for="dept_id" class="col-sm-2 col-form-label">Department</label>
                                <div class="col-sm-10">
                                    <select name="dept_id" class="form-control" id="department">
                                        <option>Select Department</option>
                                        @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" {{ old('dept_id', isset($location->dept_id) ? $location->dept_id : '') == $department->id ? 'selected' : '' }}>{{ $department->department }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="location_name" class="col-sm-2 col-form-label">Location name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="location_name" value="{{old('location_name', isset($location->location_name) ? $location->location_name : '')}}" class="form-control" id="location_name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="location_address" class="col-sm-2 col-form-label">Location Address</label>
                                <div class="col-sm-10">
                                    <input type="text" name="location_address" value="{{old('location_address', isset($location->location_address) ? $location->location_address : '')}}" class="form-control" id="location_address">
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