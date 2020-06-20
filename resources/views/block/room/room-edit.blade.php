@extends('master')
@section('title', 'Room Information')
@section('page-title', 'Edit Room')
@section('page-subtitle') <a href=" {{url('room')}}">Room</a>@endsection
@section('subtitle', 'Edit Room')
@section('content')
    @if(session('message'))
        <div class="alert alert-success">
            {{session('message')}}
        </div>
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
        <div class="card card-blue">
            <div class="card-header">
                <h3 class="card-title">Room Information</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form role="form" action="{{action('RoomController@update',$rooms->room_id)}}"
                      method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="branch_id">Branch</label>
                                <select class="custom-select" name="branch_id" id="branch_id">
                                    @foreach ($branchs as $branch)
                                        <option
                                            value="{{$branch->branch_id}}" {{$branch->branch_id==$rooms->branch_id?'selected':''}}>{{$branch->branch_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label for="room_name">Room Name</label>
                                <input type="text" name="room_name" class="form-control"
                                       id="room_name" placeholder="Room Name" value="{{$rooms->room_name}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="room_type_id">Room Type</label>
                                <select class="custom-select" name="room_type_id">
                                    @foreach ($roomtypes as $roomtype)
                                        <option
                                            value="{{$roomtype->room_type_id}}"{{$roomtype->room_type_id==$rooms->room_type_id?'selected':''}}>{{$roomtype->room_type_name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="building">Building</label>
                                <input type="text" name="building" class="form-control"
                                       id="building" placeholder="Building" value="{{$rooms->building}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="department_id">Department</label>
                                <select class="custom-select" name="department_id">
                                    @foreach ($departments as $department)
                                        <option
                                            value="{{$department->department_id}}" {{$department->department_id==$rooms->department_id?'selected':''}}>{{$department->department_name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="floor_id">Floor</label>
                                <select class="custom-select" name="floor_id">
                                    @foreach ($floors as $floor)
                                        <option
                                            value="{{$floor->floor_id}}" {{$floor->floor_id==$rooms->floor_id?'selected':''}}>{{$floor->floor_name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" rows="5" placeholder="Description" id="description"
                                          name="description">{{$rooms->description}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="status" name="status"
                                        @if(isset($rooms))
                                            @if($rooms->status == '1')
                                                checked
                                            @endif
                                        @else
                                            checked
                                        @endif
                                >
                                <label class="custom-control-label" for="status">User Status (Blue = Enable)</label>
                            </div>
                        </div>
                    </div>
                        <div class="col-2" style="float: right">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Update</button>
                        </div>

                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
