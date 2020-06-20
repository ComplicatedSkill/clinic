@extends('master')
@section('title','Patient')
@section('page-title','PATIENT INFO')
@section('page-subtitle','Dashboard')
@section('subtitle', 'Patient')
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
                    </div>
                    <!-- /input-group -->
                    <div class="mb-1 float-right" style="padding: 0px">
                        <button type="button" class="btn btn-primary btn-md"
                                onclick="window.location='{{ url('/patient')}}'">
                            <i class="fa fa-file-excel"></i> Exports
                        </button>
                        <a class="btn btn-success" href="{{ route('patient.create') }}"><i class="fa fa-plus"></i> Create</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-body" style="padding-top:10px">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <div class="table-responsive">

                            <table id="tablePatientList" class="table table-condensed table-hover"
                                   style="width: 100%;">
                                <thead>
                                <tr style="background-color: #3C8DBC">
                                    <th nowrap style="width: 80px">#</th>
                                    <th nowrap>Branch Name</th>
                                    <th nowrap>Name</th>
                                    <th nowrap>Gender</th>
                                    <th nowrap>Date of birth</th>
                                    <th nowrap>Contact</th>
                                    <th nowrap>Email</th>
                                    <th nowrap>Country</th>
                                    <th nowrap>Department Name</th>
                                    <th nowrap style="width: 100px">Option</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php $no = 1; ?>
                                @foreach ($patients as $patient)
                                    <tr role="row" class="odd">
                                        <td>{{$no++}}</td>
                                        <td>{{$patient -> branchs ->branch_name}}</td>
                                        <td>{{$patient -> patient_name_kh}}</td>
                                        <td>{{$patient -> gender}}</td>
                                        <td>{{$patient -> dob}}</td>
                                        <td>{{$patient -> contact}}</td>
                                        <td>{{$patient -> email}}</td>
                                        <td>{{$patient -> countries->name}}</td>
                                        <td>{{$patient -> departments -> department_name}}</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm"
                                               href="{{ route('patient.edit',$patient->patient_id)}}"><i
                                                    class="fa fa-edit"></i></a>
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="delete_patient({{$patient-> patient_id}})">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{--{!! $patient->links() !!}--}}
                        <script>
                            function delete_patient(id) {
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
                                            url: "{{url('patient')}}/" + id,
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
                                                                window.location.href = "{{url('patient')}}";
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
