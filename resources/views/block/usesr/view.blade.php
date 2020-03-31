{{--@extends('master')--}}
{{--@section('title', 'User')--}}
{{--@section('page-title', 'USER')--}}
{{--@section('page-subtitle', 'Dashboard')--}}
{{--@section('subtitle', 'USER')--}}
{{--@section('content')--}}
{{--    <div class="row">--}}
{{--        <div class="col-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                    <!-- /input-group -->--}}
{{--                    <div class="input-group mb-3 w-50 float-left">--}}
{{--                        <input type="text" class="form-control rounded-0" placeholder="Search" aria-label="Search">--}}
{{--                        <span class="input-group-append">--}}
{{--                        <button type="button" class="btn btn-info btn-flat mr-3"><i class="fas fa-search"></i></button>--}}
{{--                    </span>--}}
{{--                        <select class="custom-select" name="branch_id">--}}
{{--                            @foreach ($branchs as $branch)--}}
{{--                                <option value="{{$branch->branch_id}}">{{$branch->branch_name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <!-- /input-group -->--}}
{{--                    <div class="mb-3 float-right">--}}
{{--                        <button type="button" class="btn btn-primary btn-md"--}}
{{--                                onclick="window.location='{{ url('/ambulance')}}'">--}}
{{--                            <i class="fa fa-sync-alt"></i> Refresh--}}
{{--                        </button>--}}
{{--                        <button type="button" class="btn btn-success btn-md" data-toggle="modal"--}}
{{--                                data-target="#modal-default">--}}
{{--                            <i class="fa fa-plus"></i> Create--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <table id="example2" class="table table-bordered table-hover">--}}
{{--                        --}}{{-- Modal Create Form --}}
{{--                        <div class="modal fade" id="modal-default">--}}
{{--                            <div class="modal-dialog">--}}
{{--                                <div class="modal-content">--}}
{{--                                    <div class="modal-header">--}}
{{--                                        <h4 class="modal-title">Create Ambulance</h4>--}}
{{--                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                            <span aria-hidden="true">&times;</span>--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                    <div class="modal-body">--}}
{{--                                        <form role="form" id="createform" action="{{action('AmbulanceController@store')}}"--}}
{{--                                              method="POST" enctype="multipart/form-data">--}}
{{--                                            @csrf--}}
{{--                                            @method('POST')--}}
{{--                                            <div class="card-body">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label>Branch</label>--}}
{{--                                                    <select class="custom-select" name="branch_id">--}}
{{--                                                        @foreach ($branchs as $branch)--}}
{{--                                                            <option value="{{$branch->branch_id}}">{{$branch->branch_name}}--}}
{{--                                                            </option>--}}
{{--                                                        @endforeach--}}
{{--                                                    </select>--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="exampleInputEmail1">Ambulance ID</label>--}}
{{--                                                    <input type="text" name="ambulance_id" class="form-control" id="amb_id"--}}
{{--                                                           placeholder="Enter id" required>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="exampleInputEmail1">Ambulance Name</label>--}}
{{--                                                    <input type="text" name="ambulance_name" class="form-control"--}}
{{--                                                           id="amb_name" placeholder="Enter name" required>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label for="exampleInputEmail1">License Plate</label>--}}
{{--                                                    <input type="text" name="license_plate" class="form-control"--}}
{{--                                                           id="amb_lic" placeholder="Enter license plate" required>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label>Driver</label>--}}
{{--                                                    <select class="custom-select" name="staff_id">--}}
{{--                                                        @foreach ($staffs ?? '' as $staff)--}}
{{--                                                            <option value="{{$staff->staff_id}}">{{$staff->staff_name_kh}}--}}
{{--                                                            </option>--}}
{{--                                                        @endforeach--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <div--}}
{{--                                                        class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">--}}
{{--                                                        <input type="hidden" name="status" value="Deactive">--}}
{{--                                                        <input type="checkbox" name="status" class="custom-control-input"--}}
{{--                                                               id="customSwitch3" checked="" value="Active">--}}
{{--                                                        <label class="custom-control-label" for="customSwitch3">Status--}}
{{--                                                            (Green =--}}
{{--                                                            Active, Red = Deactive)</label>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <!-- /.card-body -->--}}
{{--                                                <button type="button" class="btn btn-default"--}}
{{--                                                        data-dismiss="modal">Close</button>--}}
{{--                                                <button type="submit" id="cmd_submit"--}}
{{--                                                        class="btn btn-primary float-right">Save--}}
{{--                                                    changes</button>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <!-- /.modal-content -->--}}
{{--                            </div>--}}
{{--                            <!-- /.modal-dialog -->--}}
{{--                        </div>--}}
{{--                        <!-- /.modal -->--}}
{{--                        --}}{{-- End Modal --}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th style="width: 80px">#</th>--}}
{{--                            <th>ID</th>--}}
{{--                            <th>NAME</th>--}}
{{--                            <th>PLATE</th>--}}
{{--                            <th>DRIVER</th>--}}
{{--                            <th>STATUS</th>--}}
{{--                            <th style="width: 100px">OPTION</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        <?php $no=1; ?>--}}
{{--                        @foreach ($ambulances as $ambulance)--}}
{{--                            <tr role="row" class="odd">--}}
{{--                                <td>{{$no++}}</td>--}}
{{--                                <td class="sorting_1">{{$ambulance -> ambulance_id}}</td>--}}
{{--                                <td>{{$ambulance -> ambulance_name}}</td>--}}
{{--                                <td>{{$ambulance -> license_plate}}</td>--}}
{{--                                <td>{{$ambulance -> staff_name_kh}}</td>--}}
{{--                                --}}{{-- <td><span class="badge bg-success">{{$ambulance -> status}}</span></td> --}}
{{--                                @if($ambulance -> status == 'Active')--}}
{{--                                    <td><span class="badge bg-success">{{$ambulance -> status}}</span></td>--}}
{{--                                @elseif($ambulance -> status == 'Busy')--}}
{{--                                    <td><span class="badge bg-warning">{{$ambulance -> status}}</span></td>--}}
{{--                                @else--}}
{{--                                    <td><span class="badge bg-danger">{{$ambulance -> status}}</span></td>--}}
{{--                                @endif--}}
{{--                                <td>--}}
{{--                                    <button type="button" class="btn btn-primary btn-sm"--}}
{{--                                            onclick="window.location='{{ url('ambulance/edit',$ambulance -> ambulance_id)}}'">--}}
{{--                                        <i class="fa fa-edit"></i>--}}
{{--                                    </button> <button type="button" class="btn btn-danger btn-sm">--}}
{{--                                        <i class="fa fa-trash"></i>--}}
{{--                                    </button>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--                <!-- /.card-body -->--}}
{{--            </div>--}}
{{--            <!-- /.card -->--}}
{{--        </div>--}}
{{--    </div>--}}

{{--@endsection--}}
