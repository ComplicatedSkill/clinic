@extends('master')
@section('title', 'Department')
@section('page-title', 'Edit Branch')
@section('page-subtitle') <a href=" {{url('Branch')}}">Branch</a>@endsection
@section('subtitle', 'Edit Branch')
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
                <h3 class="card-title">Department Information</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form role="form" action="{{action('BranchController@update',$branch->branch_id)}}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label for="branch_id">Branch ID</label>
                                <input type="text" value="{{$branch->branch_id}}" class="form-control"  id="branch_id" name="branch_id"disabled>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label for="branch_name">Branch Name</label>
                                <input type="text" value="{{$branch->branch_name}}" class="form-control" placeholder="Branch Name" name="branch_name" id="branch_name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control" rows="5" id="address" name="address">{{$branch -> address}}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label for="tel">Phone Number</label>
                                <input type="text" value="{{$branch->tel}}" class="form-control" placeholder="Phone Number" name="tel" id="tel">
                                <br>
                                <label for="wifi_password">Wifi Password</label>
                                <input type="text" value="{{$branch->wifi_password}}" class="form-control" placeholder="Wifi Password" name="wifi_password" id="wifi_password">
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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="{{asset('asset/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('asset/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection
