@extends('master')
@section('title','Uom')
@section('page-title','UOM INFO')
@section('page-subtitle','Dashboard')
@section('subtitle', 'Uom')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header" style="padding-bottom: 0px">
                    <div class="input-group mb-1 w-50 float-left" >
                        <div class="row">
                            <div class="col-lg-12 float-sm-right">
                                <div class="pull-right">
                                    <a class="btn btn-primary" href="{{ route('uom.index') }}"><i class="fas fa-step-backward"></i> Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body" >
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
                    <form action="{{ isset($measures)?route('uom.update',$measures->uom_id):route('uom.store')  }}"  id="frm-measure" method="post" accept-charset="utf-8" class="needs-validation" novalidate>
                        @csrf
                        @if (isset($measures))
                            @method('PUT')
                        @endif
                        <div class="form-group row">
                            <label for="BranchId" class="col-sm-2 control-label">Branch</label>
                            <div class="col-sm-10">
                                <select class="custom-select" name="branch_id">
                                    @foreach ($branchs as $branch)
                                        <option value="{{$branch->branch_id}}">{{$branch->branch_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="UomCode" class="col-sm-2 control-label" >UOM Code</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{isset($measures)?$measures->uom_code:''}}" class="form-control" id="uom_code" placeholder="uom code" name="uom_code">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="UomName" class="col-sm-2 control-label" >UOM Name</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{isset($measures)?$measures->uom_name:''}}" class="form-control" id="uom_name" placeholder="UOM Name" name="uom_name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Uomfix" class="col-sm-2 control-label" >Uom fix</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{isset($measures)?$measures->uom_fix:''}}" class="form-control" id="UOM fix" placeholder="UOM fix" name="uom_fix">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="uomdesc1" class="col-sm-2 control-label" >description</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{isset($measures)?$measures->uom_des1:''}}" class="form-control" id="uom_des1" placeholder="Description" name="uom_des1">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="uomdesc2" class="col-sm-2 control-label" >Noted</label>
                            <div class="col-sm-10">
                                <input type="text" value="{{isset($measures)?$measures->uom_des2:''}}" class="form-control" id="uom_des2" placeholder="Noted" name="uom_des2">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="uomStat" class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-10">
                                <select class="custom-select" name="uom_stat">
                                    <option value="1" {{isset($measures) && $measures->uom_stat==1?'selected':''}}>Active</option>
                                    <option value="2" {{isset($measures) && $measures->uom_stat==2?'selected':''}}>Deactive</option>
                                </select>
                            </div>
                        </div>

                        <!-- /.box-body -->
                        <div class="box-footer float-sm-right">
                            <input  type="submit" name="Submit" class="btn btn-info pull-right" value="submit"/>
                        </div>

                        {{--<!-- /.box-footer -->--}}
                    </form>
                </div>
            </div>
        </div>

    </div>
    <script>

        $(document).ready(function () {
            $("#frm-measure").validate({
                rules: {
                    uom_code:{required:true},
                    uom_name:{required:true},
                    uom_fix:{required:true},

                },
                messages: {
                    uom_code:{
                        required:"The uom code  field is required."
                    },
                    uom_name:{
                        required:"The uom name field is required."
                    },
                    uom_fix:{
                        required:"The uom fix field is required."
                    },
                }
            });

        });
    </script>
@endsection