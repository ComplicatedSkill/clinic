@extends('master')
@section('title', 'User')
@section('page-title', isset($users)?'Edit User':'Create User')
@section('page-subtitle') <a href=" {{url('User')}}">User</a>@endsection
@section('subtitle',isset($users)?'Edit User':'Create User')
@section('content')
    @if(session('message'))
        @if(session('message') == 'Current password is incorrect')
            <div class="alert alert-danger">
                {{session('message')}}
            </div>
        @else
        <div class="alert alert-success">
            {{session('message')}}
        </div>
        @endif
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="col-md-12">
        @if(isset($users))
            <a href="{{ route('permission.edit',$users->user_id) }}" class="btn btn-warning btn-flat" style="margin-bottom: -30px">Set Permission</a>
            <a href="{{ route('schedule.edit',$users->user_id) }}" class="btn btn-warning btn-flat" style="margin-bottom: -30px">Set Schedule</a>
            <button type="button" class="btn btn-warning btn-flat"  data-toggle="modal" data-target="#modal-default" style="margin-bottom: -30px" ></i>Change Password</button>

        <!-- general form elements disabled -->
        @endif
        <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    {{-- Modal Create Form --}}
                    <div class="modal fade" id="modal-default">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Change Password</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form role="form" id="createform"  method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label for="currentpassword">Current Password</label>
                                                        <input type="password" class="form-control" placeholder="Current Password" id="old" name="old">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="newpassword">New Password</label>
                                                        <input type="password" class="form-control" placeholder="New Password" id="user_password" name="user_password">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                            <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Close</button>
                                            <button type="submit" id="cmd_submit"
                                                    class="btn btn-primary float-right">Save
                                                changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                </table>
            </div>
        <div class="card card-blue">
            <div class="card-header">
                <h3 class="card-title">User Information</h3>
            </div>
            <!-- /.card-header -->
            @if(isset($users))
                @endif
            <div class="card-body">
                <form role="form" action="{{ isset($users)?action('UserController@update',$users->user_id):action('UserController@store')  }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @if(isset($users))
                        @method('PUT')
                    @else
                        @method('POST')
                    @endif
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="status" name="status"
                                   @if(isset($users))
                                    @if($users->status == '1')
                                    checked
                                    @endif
                                @else
                                   checked
                                @endif
                            >
                            <label class="custom-control-label" for="status">User Status (Blue = Enable)</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                @if(isset($users))
                                    <label for="user_id">User ID</label>
                                    <input type="text" value="{{$users->user_id}}" class="form-control" placeholder="user_id" id="user_id" name="user_id"disabled>
                                @else
                                    <label for="username">User Name</label>
                                    <input type="text" autocomplete="off" class="form-control" placeholder="Username" id="username" name="username">
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                @if(isset($users))
                                    <label for="user_name">User Name</label>
                                    <input type="text" value="{{$users->username}}" class="form-control" placeholder="Username" name="username" id="username">
                                @else
                                    <label for="user_password">Password</label>
                                    <input type="password"  autocomplete="off" class="form-control" placeholder="Password" name="user_password" id="user_password">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" value="{{isset($users)?$users->first_name:''}}" class="form-control" placeholder="First Name" id="first_name" name="first_name">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text"  value="{{isset($users)?$users->last_name:''}}" class="form-control" placeholder="First Name" id="last_name" name="last_name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email"  value="{{isset($users)?$users->email:''}}" class="form-control" placeholder="Email" id="email" name="email">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label for="tel">Phone Number</label>
                                <input type="text" class="form-control"  value="{{isset($users)?$users->tel:''}}" placeholder="Phone Number" id="tel" name="tel">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select id="inputState" class="form-control" name = "gender" >
                                    <option
                                        @if(isset($users))
                                            @if($users ->gender == 'Male')
                                                selected
                                            @endif
                                        @endif
                                    >Male</option>
                                    <option
                                        @if(isset($users))
                                        @if($users ->gender == 'Female')
                                        selected
                                        @endif
                                        @endif>Female</option>
                                    <option
                                        @if(isset($users))
                                        @if($users ->gender == 'Others')
                                        selected
                                        @endif
                                        @endif>Others</option>
                                    <option
                                        @if(isset($users))
                                        @if($users ->gender == 'Rather not to tell')
                                        selected
                                        @endif
                                        @endif>Rather not to tell</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label for="dob">Date of birth</label>
                                <input type="text" name="dob"  value="{{isset($users)?$users->dob:''}}" class="form-control" id="dob" />
                            </div>
                        </div>
                    </div>
                    <div class="row">

                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" rows="5" placeholder="Description" id="description" name="description">{{isset($users)?$users->description:''}}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label for="position">Position</label>
                                <select class="custom-select" name="position_id" >
                                    @foreach ($positions as $position)
                                        <option value="{{$position -> position_id}}"
                                                @if(isset($users))
                                                @if($users -> positions -> position_id == $position -> position_id)
                                                selected
                                            @endif
                                            @endif
                                        >{{$position->position_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="department">Department</label>
                                <select class="custom-select" name="department_id" id="department">
                                    @foreach ($departments as $department)
                                        <option value="{{$department->department_id}}"
                                                @if(isset($users))
                                                @if($users -> departments -> department_id == $department->department_id)
                                                selected
                                            @endif
                                            @endif
                                        >{{$department->department_name}}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="branch_id">Branch</label>
                                <select class="custom-select" name="branch_id" id="branch_id">
                                    @foreach ($branchs as $branch)
                                        <option value="{{$branch->branch_id}}"
                                                @if(isset($users))
                                                @if($users -> branchs -> branch_id == $branch -> branch_id)
                                                selected
                                            @endif
                                            @endif
                                        >{{$branch->branch_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        </div>
                    <div class="col-2" style="float: right">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            @if(isset($users))
                                Update
                            @else
                                Create
                            @endif
                        </button>
                    </div>
                    <div class="col-2">
                        <label for="image" class="btn btn-outline-dark btn-block btn-flat">Choose Profile Picture</label>
                        <input type="file"  id="image" name="image" style="display: none"/>
                    </div>

                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="{{asset('asset/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('asset/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(function() {
            $('input[name="dob"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format('YYYY'),10)
            }, function(start, end, label) {
                var years = moment().diff(start, 'years');
                alert("You are " + years + " years old!");
            });
        });
    </script>
@endsection
