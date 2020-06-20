@extends('master')
@section('title', 'Crate Appointment')
@section('page-title', 'Create Appointment')
@section('page-subtitle') <a href=" {{url('Appointment')}}">View Appointment</a>@endsection
@section('subtitle', 'Create Appointment')
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
                <h3 class="card-title">Appointment Information</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form role="form" action="{{action('AppointmentController@store')}}"
                      method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @if(isset($users))
                        @method('PUT')
                    @else
                        @method('POST')
                    @endif
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="appointment_tittle">Appointment Tittle</label>
                                <input class="form-control" id="appointment_tittle" name="appointment_tittle"
                                       placeholder="Appointment Tittle"
                                       type="text" required/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label for="color">Appointment Color</label>
                                <div class="input-group my-colorpicker2">
                                    <input type="text" class="form-control" name="color" placeholder="Appointment Color" value="#007BFF" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-square"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="patient_id">Patient Name</label>
                                <select class="form-control select2" name="patient_id" required>
                                    @foreach ($patients as $patient)
                                        <option
                                            value="{{$patient->patient_id}}">{{$patient->patient_name_kh}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="staff_id">Staff Name</label>
                                <select class="form-control select2" name="staff_id" required>
                                    @foreach ($staffs as $staff)
                                        <option
                                            value="{{$staff->staff_id}}">{{$staff->staff_name_kh}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="branch_id">Branch</label>
                                <select class="custom-select" name="branch_id" id="branch_id" required >
                                    @foreach ($branchs as $branch)
                                        <option
                                            value="{{$branch->branch_id}}">{{$branch->branch_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label for="department_id">Department Name</label>
                                <select class="custom-select" name="department_id" required>
                                    @foreach ($departments as $department)
                                        <option
                                            value="{{$department->department_id}}">{{$department->department_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="date">Appointment Date</label>
                                <input data-format="dd/MM/yyyy hh:mm:ss" class="form-control" id="date"
                                       name="date" placeholder="Appointment Date"
                                       type="text" required/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="time">Appointment Time</label>
                                <div class="input-group date" id="timepicker" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                           data-target="#timepicker" data-toggle="datetimepicker" placeholder="Appointment Time" name="time" required />
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="note">Appointment Note</label>
                            <textarea class="form-control" rows="5" placeholder="note" id="note"
                                      name="note"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">

                        </div>
                    </div>
                    <div class="col-2" style="float: right">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Create Appointment</button>
                    </div>

                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            var date_input = $('input[name="date"]'); //our date input has the name "date"
            var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
            date_input.datepicker({
                format: 'yyyy,mm,dd',
                container: container,
                todayHighlight: true,
                autoclose: true,
            })
        });
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2({
                theme: 'bootstrap4'
            })
            $('.my-colorpicker2').colorpicker();

            $('.my-colorpicker2').on('colorpickerChange', function (event) {
                $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
            });
            $('#timepicker').datetimepicker({
                use24hours: true,
                format: 'HH,mm'
            })

        });

    </script>
@endsection
