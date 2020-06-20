@extends('master')
@section('title', 'Amubulance')
@section('page-title', 'EDIT AMBULANCE')
@section('page-subtitle')<a href=" {{url('ambulance')}}">Ambulance</a>@endsection
@section('subtitle', 'Amubulance')
@section('content')
    <div class="card">
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
        <div class="card-body">

            <form role="form" action="{{action('AmbulanceController@update',$ambulances->ambulance_id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label>Branch</label>
                        <select class="custom-select" name="branch_id">
                            @foreach ($branchs as $branch)
                                <option
                                    value="{{$branch->branch_id}}" {{$branch->branch_id==$ambulances->branch_id?'selected':''}}>{{$branch->branch_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ambulance_id">Ambulance ID</label>
                        <input type="text" name="ambulance_id" class="form-control" id="ambulance_id"
                               value="{{$ambulances->ambulance_id}}" disabled
                               placeholder="Enter id">
                    </div>
                    <div class="form-group">
                        <label for="ambulance_name">Ambulance Name</label>
                        <input type="text" name="ambulance_name" class="form-control" id="ambulance_name"
                               value="{{isset($ambulances)?$ambulances->ambulance_name:''}}"
                               placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="license_plate">License Plate</label>
                        <input type="text" name="license_plate" class="form-control" id="license_plate"
                               value="{{isset($ambulances)?$ambulances->license_plate:''}}"
                               placeholder="Enter license plate">
                    </div>
                    <div class="form-group">
                        <label for="staff_id">Driver</label>
                        <select class="custom-select" name="staff_id">
                            @foreach ($staff as $staff)
                                <option
                                    value="{{$staff->staff_id}}" {{$staff->staff_id==$ambulances->staff_id?'selected':''}}>{{$staff->staff_name_kh}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="status" name="status"
                                   @if($ambulances->status == '1')
                                   checked
                                    @endif
                            >
                            <label class="custom-control-label" for="status">User Status (Blue = Active)</label>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary float-right">Save changes</button>
                </div>

            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
