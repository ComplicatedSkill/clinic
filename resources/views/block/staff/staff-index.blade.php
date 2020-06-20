@extends('master')
@section('title', 'Employee Information')
@section('page-title', 'Employee Information')
@section('page-subtitle') <a href=" {{url('home')}}">Dashboard</a>@endsection
@section('subtitle','Employee Information')
@section('content')
    <div class="row">
        <div class="col-12">
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
                <div class="card-header" style="padding-bottom:0px">
                    <!-- /input-group -->
                    <div class="input-group mb-1 w-50 float-left" style="padding: 0px">
                        <input type="text" class="form-control rounded-0" placeholder="Search" aria-label="Search">
                        <span class="input-group-append">
                            <button type="button" class="btn btn-info btn-flat mr-3"><i class="fas fa-search"></i>
                            </button>
                        </span>

                        <select class="custom-select" name="branch_id">
                            @foreach ($branchs as $branch)
                                <option value="{{$branch->branch_id}}">{{$branch->branch_name}}</option>
                            @endforeach
                        </select>
                    </div >
                    <!-- /input-group -->
                    <div class="mb-1 float-right" style="padding: 0px">
                        <button type="button" class="btn btn-primary btn-md" onclick="window.location='{{ url('/staff')}}'">
                            <i class="fa fa-file-excel"></i> Refresh
                        </button>
                        <a class="btn btn-success" href="{{ route('staff.create') }}"><i class="fa fa-plus"></i> Create</a>
                    </div>
                </div>
                <div class="card-body" style="padding-top:10px">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="tablePatientList" class="table table-condensed table-hover" style="width: 100%;">
                            <thead>
                            <tr style="background-color: #3C8DBC">
                                <th nowrap style="width: 80px">#</th>
                                <th nowrap>Branch Name</th>
                                <th nowrap>Name Khmer</th>
                                <th nowrap>Name English</th>
                                <th nowrap>ID Card</th>
                                <th nowrap>Gender</th>
                                <th nowrap>Date of birth</th>
                                <th nowrap>tel</th>
                                <th nowrap>Position</th>
                                <th nowrap>Country</th>
                                <th nowrap>Phone Number</th>
                                <th nowrap>Department</th>
                                <th nowrap style="width: 130px">Option</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $no=1; ?>
                            @foreach ($staffs as $staff)
                                <tr role="row" class="odd">
                                    <td>{{$no++}}</td>
                                    <td class="sorting_1">{{$staff -> branchs->branch_name}}</td>
                                    <td>{{$staff -> staff_name_kh}}</td>
                                    <td>{{$staff -> staff_name_eng}}</td>
                                    <td>{{$staff -> card_id}}</td>
                                    <td>{{$staff -> gender}}</td>
                                    <td>{{$staff -> dob}}</td>
                                    <td>{{$staff -> tel}}</td>
                                    <td>{{$staff -> positons->position_name}}</td>
                                    <td>{{$staff -> countries -> name}}</td>
                                    <td>{{$staff -> tel}}</td>
                                    <td>{{$staff -> departments ->department_name}}</td>

                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ route('staff.edit',$staff->staff_id)}}"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-primary btn-sm" href="{{ route('staff.show',$staff->staff_id)}}"><i class="fas fa-eye"></i></a>
                                        <button type="button" class="btn btn-danger btn-sm btn_delete"  name="btnDelete" onclick="delete_staff({{$staff-> staff_id}})">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{--{!! $staff->links() !!}--}}
                        <script>
                            function delete_staff(id) {
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
                                            url: "{{url('staff')}}/" + id,
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
                                                                window.location.href = "{{url('staff')}}";
                                                            }
                                                        }
                                                    })
                                            }
                                        });
                                    }
                                })
                            }
                        </script>
                </div>
            </div>
        </div>
    </div>
@endsection
