<x-app-layout>
    <div class="col-md-12 col-sm-12">
        @include('layouts.flash.flash')
        <div class="x_panel">
            <div class="x_content">

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewModal">
                    <i class="fa fa-plus"></i>
                    <span class="vr"></span>
                    Add New
                </button>
                <!-- Add New Modal -->
                <div class="modal fade" id="addNewModal" tabindex="-1" role="dialog" aria-labelledby="addNewModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addNewModalLabel">Add New User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="offset-md-2 col-md-12 col-sm-12">

                                    <div class="x_content">
                                        <br>


                                        <form method="post" action="{{ route('user.store') }}" enctype="multipart/form-data" class="form-horizontal">

                                            @csrf
                                            <div class="form-group row">
                                                <label for="profilepic" class="col-sm-5 col-form-label">Profile Picture</label>
                                                <div class="col-sm-9">
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
                                                <label for="first_name" class="col-sm-5 col-form-label">First Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="first_name" value="{{ old('first_name', isset($user->first_name) ? $user->first_name : '') }}" id="first_name" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="last_name" class="col-sm-5 col-form-label">Last Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="last_name" value="{{ old('last_name', isset($user->last_name) ? $user->last_name : '') }}" id="last_name" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="middle_name" class="col-sm-5 col-form-label">Middle Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="middle_name" value="{{ old('middle_name', isset($user->middle_name) ? $user->middle_name : '') }}" id="middle_name" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="address" class="col-sm-5 col-form-label">Address</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="address" value="{{ old('address', isset($user->address) ? $user->address : '') }}" class="form-control" id="address">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="contact_no" class="col-sm-5 col-form-label">Contact Number</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="contact_no" value="{{ old('contact_no', isset($user->contact_no) ? $user->contact_no : '') }}" class="form-control" id="contact_no">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="email" class="col-sm-5 col-form-label">Email</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="email" value="{{ old('email', isset($user->email) ? $user->email : '') }}" class="form-control" id="email" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="password" class="col-sm-5 col-form-label">Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" name="password" class="form-control" id="password" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="role" class="col-sm-5 col-form-label">User Role</label>
                                                <div class="col-sm-9">
                                                    <select name="role" class="form-control" id="role" required>
                                                        <option value="Staff" {{ (old('role', isset($user->role) ? $user->role : '') == 'Staff') ? 'selected' : '' }}>Staff</option>
                                                        <option value="Admin" {{ (old('role', isset($user->role) ? $user->role : '') == 'Admin') ? 'selected' : '' }}>Admin</option>
                                                        <option value="Admin Officer" {{ (old('role', isset($user->role) ? $user->role : '') == 'Admin Officer') ? 'selected' : '' }}>Admin Officer</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Add</button>
                                            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table id="itemTable" class="table table-striped jambo_table bulk_action">
                    <thead>
                        <link href="{{ asset('asset/vendors/nprogress/support/style.css') }}" rel="stylesheet">
                        <tr class="headings">
                            <th class="column-title"></th>
                            <th class="column-title">First name</th>
                            <th class="column-title">Last name</th>
                            <th class="column-title">Middle name</th>
                            <th class="column-title">Address</th>
                            <th class="column-title">Contact Number</th>
                            <th class="column-title">Email</th>
                            <th class="column-title">Date created</th>
                            <th class="column-title">Role</th>
                            <th class="column-title"><span class="nobr">Action</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $value)
                        <tr class="even pointer">
                            <td>
                                <img src="{{ asset('uploads/profilepic/' . $value->profilepic) ?? 'userprof.png'}}" alt="User image" class="rounded-circle mx-auto d-block" style="width: 80px; height: 80px;">
                            </td>
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
                                    <button type="button" class="btn btn-info m-1 btn-sm rounded" data-toggle="modal" data-target="#edituserModal{{$value->id}}" title="Edit">
                                        <i class="fa fa-edit" small></i>
                                    </button>

                                    <form action="{{ route('user.destroy', $value->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger delete-header m-1 btn-sm rounded" title="Delete"><i class="fa fa-trash" small></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>


                        <!-- Update Modal -->
                        <div class="modal fade" id="edituserModal{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="edituserModalLabel{{$value->id}}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="edituserModalLabel{{$value->id}}">Update User</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="offset-md-2 col-md-12 col-sm-12">
                                            <div class="x_content">
                                                <br>

                                                <form method="post" action="{{ route('user.update', ['user' => $value->id]) }}" enctype="multipart/form-data" class="form-horizontal">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="form-group row">
                                                <label for="profilepic" class="col-sm-5 col-form-label">Profile Picture</label>
                                                <div class="col-sm-9">
                                                    <label for="user{{$value->id}}" class="profilepic-label">
                                                        <input type="file" name="profilepic" class="form-control" accept="image/" id="user{{$value->id}}" style="display: none;" value="{{$value->profilepic}}">
                                                        <div class="profilepic-container">
                                                            <div class="profilepic-wrapper">
                                                                <img src="{{ asset('uploads/profilepic/' . (isset($value->profilepic) ? $value->profilepic : 'userprof.png')) }}" alt="User Profile Picture" class="profilepic-img">
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
                                                        <label for="user{{$value->id}}" class="col-sm-2 col-form-label">First Name</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" name="first_name" class="form-control" id="user{{$value->id}}" value="{{$value->first_name}}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="user{{$value->id}}" class="col-sm-2 col-form-label">Last Name</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" name="last_name" class="form-control" id="user{{$value->id}}" value="{{$value->last_name}}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="user{{$value->id}}" class="col-sm-2 col-form-label">Middle Name</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" name="middle_name" class="form-control" id="user{{$value->id}}" value="{{$value->middle_name}}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="user{{$value->id}}" class="col-sm-2 col-form-label">Address</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" name="address" class="form-control" id="user{{$value->id}}" value="{{$value->address}}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="user{{$value->id}}" class="col-sm-2 col-form-label">Contact Number</label>
                                                        <div class="col-sm-6">
                                                            <input type="number" name="contact_no" class="form-control" id="user{{$value->id}}" value="{{$value->contact_no}}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="user{{$value->id}}" class="col-sm-2 col-form-label">Email</label>
                                                        <div class="col-sm-6">
                                                            <input type="email" name="email" class="form-control" id="user{{$value->id}}" value="{{$value->email}}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="user{{$value->id}}" class="col-sm-2 col-form-label">Password</label>
                                                        <div class="col-sm-6">
                                                            <input type="password" name="password" class="form-control" id="user{{$value->id}}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="role" class="col-sm-5 col-form-label">User Role</label>
                                                        <div class="col-sm-9">
                                                            <select name="role" class="form-control" id="user{{$value->id}}"  value="{{$value->role}}">
                                                                <option>Select User Role</option>
                                                                <option value="Admin" {{ (old('role', $value->role) == 'Admin') ? 'selected' : '' }}>Admin</option>
                                                                <option value="Admin Officer" {{ (old('role', $value->role) == 'Admin Officer') ? 'selected' : '' }}>Admin Officer</option>
                                                                <option value="Staff" {{ (old('role', $value->role) == 'Staff') ? 'selected' : '' }}>Staff</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>

                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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