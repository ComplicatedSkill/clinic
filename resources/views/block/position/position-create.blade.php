@extends('master')
@section('title','Position')
@section('page-title','POSITION INFO')
@section('page-subtitle')<a href="{{url('position')}}">Dashboard</a>@endsection
@section('subtitle', 'Position')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header" style="padding-bottom: 0px">
                    <div class="input-group mb-1 w-50 float-left" >
                        <div class="row">
                            <div class="col-lg-12 float-sm-right">
                                <div class="pull-right">
                                    <a class="btn btn-primary" href="{{ route('position.index') }}"><i class="fas fa-step-backward"></i> Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ isset($positions)?route('position.update',$positions->posit_id):route('position.store')  }}" class="form-horizontal" id="frm-position" method="post" accept-charset="utf-8" novalidate="novalidate">
                        @csrf
                        @if (isset($positions))
                            @method('PUT')
                        @endif
                        <div class="form-group row">
                            <label for="PositionType" class="col-sm-2 control-label">Position Type</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{isset($positions)?$positions->posit_type:''}}" class="form-control" id="posit_type" placeholder="Position type" name="posit_type">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="PositionDesc" class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="posit_desc" placeholder="Description" name="posit_desc">{{isset($positions)?$positions->posit_desc:''}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="PositionType" class="col-sm-2 control-label">Position Type</label>
                            <div class="col-sm-10">
                                <select class="custom-select" name="posit_status">
                                    <option value="Active" {{isset($positions) && $positions->posit_status=='Active'?'selected':''}}>Active</option>
                                    <option value="Deactive" {{isset($positions) && $positions->posit_status=='Deactive'?'selected':''}}>Deactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="box-footer float-sm-right">
                            <input  type="submit" class="btn btn-info pull-right" value="submit"/>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#frm-position").validate({
                rules: {
                    posit_type:{required:true},
                    posit_desc:{required:true}
                },
                messages: {
                    posit_type:{
                        required:"The position field is required."
                    },
                    posit_desc:{
                        required:"The description in khmer field is required."
                    },
                }
            });
        });
    </script>
@endsection
