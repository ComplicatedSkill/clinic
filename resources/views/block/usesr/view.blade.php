@extends('master')
@section('title', 'User')
@section('page-title', 'USER')
@section('page-subtitle') <a href=" {{url('/home')}}">Dashboard</a>@endsection
@section('subtitle', 'User')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
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
                                onclick="window.location='{{ url('/User')}}'">
                            <i class="fa fa-sync-alt"></i> Refresh
                        </button>
                        <a href="{{ route('User.create') }}" class="btn btn-primary btn-md" ><i class="fa fa-edit">Create User</i></a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="width: 80px">Nº</th>
                            <th>UserName</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Gender</th>
                            <th>Date of birth</th>
                            <th>Email</th>
                            <th>Tel</th>
                            <th>Position</th>
                            <th>Department</th>
                            <th>Branch</th>
                            <th>Status</th>
                            <th style="width: 100px">OPTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; ?>
                        @foreach ($users as $user)
                            <tr role="row" class="odd">
                                <td>{{$no++}}</td>
                                <td>{{$user -> username}}</td>
                                <td>{{$user -> first_name}}</td>
                                <td>{{$user -> last_name}}</td>
                                <td>{{$user -> gender}}</td>
                                <td>{{$user -> dob}}</td>
                                <td>{{$user -> email}}</td>
                                <td>{{$user -> tel}}</td>
                                <td>{{$user -> positions -> position_name}}</td>
                                <td>{{$user -> departments -> department_name }}</td>
                                <td>{{$user -> branchs -> branch_name}}</td>
                                @if($user -> status == '1')
                                    <td><span class="badge bg-success">Enable</span></td>
                                @else
                                    <td><span class="badge bg-danger">Disable</span></td>
                                @endif
                                <td>
                                    <a href="{{ route('User.edit',$user->user_id) }}" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i></a>
                                    <button type="button" class="btn btn-danger btn-sm btn_delete"  name="btnDelete" onclick="delete_user({{$user->user_id}})">
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
                            url: "{{url('User')}}/"+id,
                            type: 'DELETE',
                            data: {
                                "_token": $('@csrf').val(),
                            },
                            success: function(result) {
                                if(result.status==200){
                                    window.location.href = "{{url('User')}}";
                                }
                            }
                        });
                    }
                });
        }
        function  edit_user(id) {
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
                            url: "{{url('User')}}/"+id,
                            type: 'EDIT',
                            data: {
                                "_token": $('@csrf').val(),
                            },
                            success: function(result) {
                                if(result.status==200){
                                    window.location.href = "{{url('User')}}";
                                }
                            }
                        });
                    }
                });
        }
    </script>
@endsection

