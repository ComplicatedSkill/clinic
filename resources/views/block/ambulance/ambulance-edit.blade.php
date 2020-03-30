@extends('master')
@section('title', 'Amubulance')
@section('page-title', 'EDIT AMBULANCE')
@section('page-subtitle', 'Dashboard')
@section('subtitle', 'Amubulance')
@section('content')
<div class="card">
    <div class="card-body">
        <form role="form" action="{{url('ambulance/update')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label>Branch</label>
                    <select class="custom-select" name="branch_id">
                        @foreach ($branchs as $branch)
                        <option value="{{$branch->branch_id}}" {{$branch->branch_id==$ambulance->branch_id?'selected':''}}>{{$branch->branch_name}}</option>
                        @endforeach
                    </select>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Ambulance ID</label>
                    <input type="text" name="ambulance_id" class="form-control" id="exampleInputEmail1"
                        placeholder="Enter id">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Ambulance Name</label>
                    <input type="text" name="ambulance_name" class="form-control" id="exampleInputEmail1"
                        placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">License Plate</label>
                    <input type="text" name="license_plate" class="form-control" id="exampleInputEmail1"
                        placeholder="Enter license plate">
                </div>
                <div class="form-group">
                    <label>Driver</label>
                    <select class="custom-select" name="staff_id">
                        @foreach ($staffs as $staff)
                        <option value="{{$staff->staff_id}}" {{$staff->staff_id==$ambulance->staff_id?'selected':''}}>{{$staff->staff_name_kh}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                        <input type="hidden" name="status" value="Deactive">
                        <input type="checkbox" name="status" class="custom-control-input" id="customSwitch3" checked=""
                            value="Active">
                        <label class="custom-control-label" for="customSwitch3">Status (Green =
                            Active, Red = Deactive)</label>
                    </div>
                </div>
                <!-- /.card-body -->
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary float-right">Save changes</button>
        </form>>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
        <ul class="pagination pagination-sm m-0 float-right">
            <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
        </ul>
    </div>
</div>
<!-- /.card -->
@endsection
