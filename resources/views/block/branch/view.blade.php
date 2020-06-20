@extends('master')
@section('title', 'Branch')
@section('page-title', 'Branch')
@section('page-subtitle') <a href=" {{url('/home')}}">Dashboard</a>@endsection
@section('subtitle', 'Branch')
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
                    </div>
                    <div class="mb-3 float-right">
                        <button type="button" class="btn btn-primary btn-md"
                                onclick="window.location='{{ url('/Branch')}}'">
                            <i class="fa fa-sync-alt"></i> Refresh
                        </button>
                        <button type="button" class="btn btn-primary btn-md"  data-toggle="modal" data-target="#modal-default" > <i class="fa fa-plus"></i> Create New</button>
                        <!-- general form elements disabled -->
                        <div class="card-body"  style="margin-top: -50px">
                            <table id="example2" class="table table-bordered table-hover">
                                {{-- Modal Create Form --}}
                                <div class="modal fade" id="modal-default">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Create Branch</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form role="form" id="createform" action="{{action('BranchController@store')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('POST')
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <!-- text input -->
                                                                <div class="form-group">
                                                                    <label for="branch_name">Branch Name</label>
                                                                    <input type="text" class="form-control" placeholder="Branch Name" id="branch_name" name="branch_name">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <!-- text input -->
                                                                <div class="form-group">
                                                                    <label for="">Address</label>
                                                                    <input type="text" class="form-control" placeholder="Address" id="address" name="address">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <!-- text input -->
                                                                <div class="form-group">
                                                                    <label for="tel">Phone Number</label>
                                                                    <input type="text" class="form-control" placeholder="Phone Number" id="tel" name="tel">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <!-- text input -->
                                                                <div class="form-group">
                                                                    <label for="wifi_password">Wifi Password</label>
                                                                    <input type="text" class="form-control" placeholder="Description" id="wifi_password" name="wifi_password">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- /.card-body -->
                                                            <label for="image" class="btn btn-outline-dark btn-block btn-flat">Choose Branch Logo</label>
                                                            <input type="file"  id="image" name="image" style="display: none"/>
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
                            <th>Branch Name</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Wifi Password</th>
                            <th style="width: 100px">OPTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; ?>
                        @foreach ($branchs as $branch)
                            <tr role="row" class="odd">
                                <td>{{$no++}}</td>
                                <td>{{$branch -> branch_name}}</td>
                                <td>{{$branch->address}}</td>
                                <td>{{$branch -> tel}}</td>
                                <td>{{$branch -> wifi_password}}</td>
                                <td>
                                    <a href="{{ route('Branch.edit',$branch->branch_id) }}" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i></a>
                                    <button type="button" class="btn btn-danger btn-sm btn_delete"  name="btnDelete" onclick="delete_user({{$branch->branch_id}})">
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

    <!-- page script -->
    <script>
        function  delete_user(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{url('Branch')}}/" + id,
                        type: 'DELETE',
                        data: {
                            "_token": $('@csrf').val(),
                        },
                        success: function (result) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                                .then((willDelete) => {
                                    if (willDelete) {
                                        if (result.status == 200) {
                                            window.location.href = "{{url('Branch')}}";
                                        }
                                    }
                                })
                        }
                    });
                }
            });
            $(function () {
                $("#example1").DataTable();
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                });
            });
        }
    </script>

@endsection

