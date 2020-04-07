@extends('master')
@section('title', 'Departments')
@section('page-title', 'Departments')
@section('page-subtitle', 'Dashboard')
@section('subtitle', 'Departments')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                @endif
                <!-- /input-group -->
                    <div class="input-group mb-3 w-50 float-left">
                        <input type="text" class="form-control rounded-0" placeholder="Search" aria-label="Search">
                        <span class="input-group-append">
                        <button type="button" class="btn btn-info btn-flat mr-3"><i class="fas fa-search"></i></button>
                    </span>
                        <select class="custom-select" name="branch_id">
                            @foreach ($branchs as $branch)
                                <option value="{{$branch->branch_id}}">{{$branch->branch_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 float-right">
                        <button type="button" class="btn btn-primary btn-md"
                                onclick="window.location='{{ url('/Department')}}'">
                            <i class="fa fa-sync-alt"></i> Refresh
                        </button>
                        <button type="button" class="btn btn-primary btn-md"  data-toggle="modal" data-target="#modal-default" > <i class="fa fa-plus"></i> Create New</button>
                            <!-- general form elements disabled -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                {{-- Modal Create Form --}}
                                <div class="modal fade" id="modal-default">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Create Department</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form role="form" id="createform" action="{{action('DepartmentController@store')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('POST')
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <!-- text input -->
                                                                <div class="form-group">
                                                                    <label for="department_name">Department Name</label>
                                                                    <input type="text" class="form-control" placeholder="Department Name" id="department_name" name="department_name">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <!-- text input -->
                                                                <div class="form-group">
                                                                    <label for="department_description">Description</label>
                                                                    <input type="text" class="form-control" placeholder="Description" id="department_description" name="department_description">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <!-- text input -->
                                                                <div class="form-group">
                                                                    <label for="department_description">Branch</label>
                                                                    <select class="custom-select" name="branch_id" id="branch_id">
                                                                        @foreach ($branchs as $branch)
                                                                            <option value="{{$branch->branch_id}}"
                                                                            >{{$branch->branch_name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- /.card-body -->
                                                        <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close</button>
                                                        <button type="submit" id="cmd_submit"
                                                                class="btn btn-primary float-right">Create New
                                                        </button>
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
                    </div>
                </div>
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="width: 80px">Nº</th>
                            <th>Department Name</th>
                            <th>Description</th>
                            <th>Branch</th>
                            <th style="width: 100px">OPTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; ?>
                        @foreach ($departments as $department)
                            <tr role="row" class="odd">
                                <td>{{$no++}}</td>
                                <td>{{$department -> department_name}}</td>
                                <td>{{$department->department_description}}</td>
                                <td>{{$department -> branchs -> branch_name}}</td>
                                <td>
                                    <a href="{{ route('Department.edit',$department->department_id) }}" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i></a>
                                    <button type="button" class="btn btn-danger btn-sm btn_delete"  name="btnDelete" onclick="delete_user({{$department->department_id}})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </scr>
    <script>
        function  delete_user(id) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: "{{url('Department')}}/"+id,
                            type: 'DELETE',
                            data: {
                                "_token": $('@csrf').val(),
                            },
                            success: function(result) {
                                if(result.status==200){
                                    window.location.href = "{{url('Department')}}";
                                }
                            }
                        });
                    }
                });
        }
    </script>
@endsection

