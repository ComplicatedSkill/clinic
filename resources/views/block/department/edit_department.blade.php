@extends('master')
@section('title', 'Department')
@section('page-title', 'Edit Department')
@section('page-subtitle', 'Dashboard')
@section('subtitle', 'Edit Department')
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
                <form role="form" action="{{action('DepartmentController@update',$department->department_id)}}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                    <label for="department_id">Department ID</label>
                                    <input type="text" value="{{$department->department_id}}" class="form-control"  id="department_id" name="department_id"disabled>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                    <label for="department_name">Department Name</label>
                                <input type="text" value="{{$department->department_name}}" class="form-control" placeholder="Department_name" name="department_name" id="department_name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label for="department_description">Description</label>
                                <textarea class="form-control" rows="5" id="department_description" name="department_description">{{$department -> department_description}}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="branch_id">Branch</label>
                                <select class="custom-select" name="branch_id" id="branch_id">
                                    @foreach ($branchs as $branch)
                                        <option value="{{$branch->branch_id}}"
                                                @if($department -> branchs -> branch_id == $branch -> branch_id)
                                                selected
                                            @endif
                                        >{{$branch->branch_name}}</option>
                                    @endforeach
                                </select>
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
