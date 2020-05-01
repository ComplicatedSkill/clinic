@extends('master')
@section('title', 'User')
@section('page-title', 'Set Permission')
@section('page-subtitle') <a href="#">Staff</a>@endsection
@section('subtitle','Set Schedule')
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
                <h3 class="card-title">{{$schedule -> staff -> staff_name_kh}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form role="form" action="{{action('ScheduleController@update',$schedule->staff_id)}}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline" >
                                    <input type="checkbox" id="mo" name="mo"
                                        @if($schedule->mo == 'on')
                                            checked
                                        @endif
                                           >
                                    <label for="mo">Monday</label>
                                </div><br><br>
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="tu" name="tu"
                                           @if($schedule->tu == 'on')
                                           checked
                                        @endif
                                    >
                                    <label for="tu">Tuesday</label>
                                </div><br><br>
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="we" name="we"
                                           @if($schedule->we == 'on')
                                            checked
                                        @endif
                                    >
                                    <label for="we">Wednesday</label>
                                </div><br><br>
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="th" name="th"
                                           @if($schedule->th == 'on')
                                           checked
                                        @endif
                                    >
                                    <label for="th">Thursday</label>
                                </div><br><br>
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="fr" name="fr"
                                           @if($schedule->fr == 'on')
                                           checked
                                        @endif
                                    >
                                    <label for="fr">Friday</label>
                                </div><br><br>
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="sa" name="sa"
                                           @if($schedule->sa == 'on')
                                           checked
                                        @endif
                                    >
                                    <label for="sa">Saturday</label>
                                </div><br><br>
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="su" name="su"
                                           @if($schedule->su == 'on')
                                           checked
                                        @endif
                                    >
                                    <label for="su">Sunday</label>
                                </div><br><br>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="schedule's_Name">Schedule's Name</label>
                                <input type="text" class="form-control" placeholder="Schedule's Name" id="schedule's_Name" name="schedule_name" value="{{$schedule->schedule_name}}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" placeholder="Description" id="description" name="description" value="{{$schedule->description}}">
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="bootstrap-timepicker">
                                        <div class="form-group">
                                            <label>Morning Time In</label>
                                            <div class="input-group date" id="timepicker" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" name="morning_time_in" value="{{$schedule->morning_time_in}}" />
                                                <div class="input-group-append" data-target="#timepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="bootstrap-timepicker">
                                        <div class="form-group">
                                            <label>Morning Time Out</label>
                                            <div class="input-group date" id="timepicker" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" name="morning_time_out" value="{{$schedule->morning_time_out}}"/>
                                                <div class="input-group-append" data-target="#timepicker" >
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="bootstrap-timepicker">
                                        <div class="form-group">
                                            <label>Evening Time In</label>
                                            <div class="input-group date" id="timepicker" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" name="everning_time_in" value="{{$schedule->everning_time_in}}" />
                                                <div class="input-group-append" data-target="#timepicker" >
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="bootstrap-timepicker">
                                        <div class="form-group">
                                            <label>Evening Time Out</label>
                                            <div class="input-group date" id="timepicker" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" name="everning_time_out" value="{{$schedule->everning_time_out}}"/>
                                                <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="far fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-2" style="float: right">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Save</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link type="text/css" href="css/bootstrap.min.css" />
    <link type="text/css" href="css/bootstrap-timepicker.min.css" />
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-timepicker.min.js"></script>
    <script type="text/javascript">
    </script>

@endsection
