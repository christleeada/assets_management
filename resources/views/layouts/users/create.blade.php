<x-app-layout>
    <div class="row">

        <div class="offset-2 col-md-8 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title text-center">
                    <h2>User Form</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    @if(isset($user))
                    <form method="post" action="{{ route('user.update', ['user' => $user->id]) }}" enctype='multipart/form-data' class="form-horizontal">
                        @method('put')
                        @else
                        <form method="post" action="{{ route('user.store') }}" enctype="multipart/form-data" class="form-horizontal">
                            @endif

                            @csrf
                            <div class="form-group row">
    <label for="profilepic" class="col-sm-2 col-form-label">Profile Picture</label>
    <div class="col-sm-10">
        <label for="profilepic" class="profilepic-label">
            <input type="file" name="profilepic" class="form-control" accept="image/" id="profilepic" style="display: none;">
            <div class="profilepic-container">
                <div class="profilepic-wrapper">
                    <img src="{{ asset('uploads/profilepic/' . (isset($user->profilepic) ? $user->profilepic : 'userprof.png')) }}" alt="User Profile Picture" class="profilepic-img">
                </div>
                
            </div>
        </label>
    </div>
</div>

<style>
.profilepic-label {
    position: relative;
    display: inline-block;
    cursor: pointer;
}

.profilepic-container {
    position: relative;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    overflow: hidden;
}

.profilepic-wrapper {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.profilepic-img {
    max-width: 100%;
    max-height: 100%;
    width: auto;
    height: auto;
    border-radius: 50%;
    object-fit: cover;
}


</style>

                                


                            <div class="form-group row">
                                <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="first_name" value="{{ old('first_name', isset($user->first_name) ? $user->first_name : '') }}" class="form-control" id="first_name">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="last_name" value="{{ old('last_name', isset($user->last_name) ? $user->last_name : '') }}" class="form-control" id="last_name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="middle_name" class="col-sm-2 col-form-label">Middle Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="middle_name" value="{{old('middle_name', isset($user->middle_name) ? $user->middle_name : '')}}" class="form-control" id="middle_name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <input type="text" name="address" value="{{old('address', isset($user->address) ? $user->address : '')}}" class="form-control" id="address">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="contact_no" class="col-sm-2 col-form-label">Contact Number</label>
                                <div class="col-sm-10">
                                    <input type="text" name="contact_no" value="{{old('contact_no', isset($user->contact_no) ? $user->contact_no : '')}}" class="form-control" id="contact_no">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" name="email" value="{{old('email', isset($user->email) ? $user->email : '')}}" class="form-control" id="email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" class="form-control" id="password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="role" class="col-sm-2 col-form-label">User Role</label>
                                <div class="col-sm-10">
                                <select name="role" class="form-control" id="role">
                                <option>Select User Role</option>
                                <option value="Admin" {{ (old('role', isset($user->role) ? $user->role : '') == 'Admin') ? 'selected' : '' }}>Admin</option>
                                <option value="Admin Officer" {{ (old('role', isset($user->role) ? $user->role : '') == 'Admin Officer') ? 'selected' : '' }}>Admin Officer</option>
                                <option value="Staff" {{ (old('role', isset($user->role) ? $user->role : '') == 'Staff') ? 'selected' : '' }}>Staff</option>
                                
                                </select>
                                </div>
                            </div>
                            <button  type="" class="btn btn-primary float-sm-right">Add</button>
                            <a  href="{{route('user.index')}}"class="btn btn-warning float-sm-left">Cancel</a>
                        </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@include('layouts.scripts.messages-script')