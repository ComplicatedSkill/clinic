@extends('master')
@section('title', 'Employee')
@section('page-title', isset($staffs)?'Edit Staff':'Create Employee')
@section('page-subtitle') <a href=" {{url('staff')}}">Employee</a>@endsection
@section('subtitle',isset($staffs)?'Edit Staff':'Create Employee')
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
    <div class="col-12">
        @if(isset($staffs))
            <a href="{{ route('schedule.edit',$staffs->staff_id) }}" class="btn btn-warning btn-flat"
               style="margin-bottom: -30px">Set Schedule</a>
            <!-- general form elements disabled -->
        @endif
        <div class="card card-blue" style="margin-top: 40px">
            <div class="card-header">
                <h3 class="card-title">Employee Information</h3>
            </div>
            <div class="card-body">
                <form role="from"
                    action="{{ isset($staffs)?route('staff.update',$staffs->staff_id):route('staff.store')  }}"
                    class="form-horizontal" id="frm-staff" method="post" accept-charset="utf-8"
                    novalidate="novalidate">
                    @csrf
                    @if (isset($staffs))
                        @method('PUT')
                    @endif
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="BranchId">Branch</label>
                                <select class="custom-select" name="branch_id" required>
                                    @foreach ($branchs as $branch)
                                        <option value="{{$branch->branch_id}}"
                                                ​​​ {{isset($staffs) && $staffs->branch_id==$branch->branch_id?'selected':''}}>{{$branch->branch_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="card_id" class="col-sm-2 control-label">ID Card</label>
                                <input type="text" value="{{isset($staffs)?$staffs->card_id:''}}"
                                       class="form-control"
                                       id="card_id" placeholder="ID Card" name="card_id" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="staff_name_kh" class="col-sm-2 control-label">Name Khmer</label>
                                <input type="text" value="{{isset($staffs)?$staffs->staff_name_kh:''}}"
                                       class="form-control"
                                       id="staff_name_kh" placeholder="Staff Name Khmer"
                                       name="staff_name_kh" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="staff_name_eng" class="col-sm-2 control-label">Name
                                    English</label>
                                <input type="text" value="{{isset($staffs)?$staffs->staff_name_eng:''}}"
                                       class="form-control" id="staff_name_eng"
                                       placeholder="Staff Name English"
                                       name="staff_name_eng" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="gender" class="col-sm-2 control-label">Gender</label>
                                <select class="custom-select" name="gender" required>
                                    <option
                                        value="Male" {{isset($staffs) && $staffs->gender=='Male'?'selected':''}}>
                                        Male
                                    </option>
                                    <option
                                        value="Female" {{isset($staffs) && $staffs->gender=='Female'?'selected':''}}>
                                        Female
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="dob" class="col-sm-2 control-label">Date of Birth</label>
                                <input class="form-control" id="dob" name="dob" placeholder="Date of birth"
                                       value="{{isset($staffs)?$staffs->dob:''}}" type="text" required/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="tel" class="col-sm-2 control-label">Phone Number</label>
                                <input type="text" value="{{isset($staffs)?$staffs->tel:''}}"
                                       class="form-control"
                                       id="tel" placeholder="Phone Number" name="tel" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email " class="col-sm-2 control-label">E-mail</label>
                                <input type="text" value="{{isset($staffs)?$staffs->email:''}}"
                                       class="form-control"
                                       id="email" placeholder="E-mail" name="email" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="salary" class="col-sm-2 control-label">Salary</label>
                                <input type="number" value="{{isset($staffs)?$staffs->salary:''}}"
                                       class="form-control"
                                       id="salary" placeholder="Salary" name="salary" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="department_id" class="col-sm-2 control-label">Department
                                    Id</label>
                                <select class="custom-select" name="department_id" required>
                                    @foreach ($departments as $department)
                                        <option value="{{$department->department_id}}"
                                                ​​​ {{isset($staffs) && $staffs->department_id==$department->department_id?'selected':''}}>{{$department->department_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="country_id" class="col-sm-2 control-label">Country</label>
                                <select class="custom-select" name="country_id" required>
                                    @foreach ($countries as $country)
                                        <option value="{{$country->country_id}}"
                                                ​​​ {{isset($staffs) && $staffs->country_id==$country->country_id?'selected':''}}>{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="position_id" class="col-sm-2 control-label">Position</label>
                                <select class="custom-select" name="position_id" required>
                                    @foreach ($positions as $position)
                                        <option value="{{$position->position_id}}"
                                                ​​​ {{isset($staffs) && $staffs->position_id==$position->position_id?'selected':''}}>{{$position->position_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="address" class="col-sm-2 control-label">Address</label>
                                <textarea class="form-control" rows="5" placeholder="Description"
                                          id="description"
                                          name="address">{{isset($staffs)?$staffs->address:''}}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="description" class="col-sm-2 control-label">Description</label>
                                <textarea class="form-control" rows="5" placeholder="Description"
                                          id="description"
                                          name="description">{{isset($staffs)?$staffs->description:''}}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- /.box-body -->
                    <div class="box-footer float-sm-right">
                        <input type="submit" name="Submit" class="btn btn-info pull-right" value="submit"/>
                    </div>

                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- Include Date Range Picker -->
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    <script type="text/javascript">
        $(document).ready(function () {
            var date_input = $('input[name="dob"]'); //our date input has the name "date"
            var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
            date_input.datepicker({
                format: 'yyyy/mm/dd',
                container: container,
                todayHighlight: true,
                autoclose: true,
            })
        });
    </script>

@endsection
