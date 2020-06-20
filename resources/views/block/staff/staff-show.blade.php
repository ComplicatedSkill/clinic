@extends('master')
@section('title', 'Staff')
@section('page-title', 'STAFF VIEW')
@section('page-subtitle')<a href="{{url('staff')}}">Dashboard</a>@endsection
@section('subtitle', 'View-Staff')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="padding-bottom: 0px">
                    <div class="input-group mb-1 w-50 float-left" >
                        <div class="row">
                            <div class="col-lg-12 float-sm-right">
                                <div class="pull-right">
                                    <a class="btn btn-primary" href="{{ route('staff.index') }}"><i class="fas fa-step-backward"></i> Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="form-group row">
                        <label for="ImageStore" class="col-sm-2 control-label">Image</label>
                        <div class="col-sm-10">
                            <div id="plupload">
                                <div class="plupload_block">
                                    <div class="pl fleft">
                                        <span class="drop_file_hear"></span>
                                        <div id="multi-upload" style="position: relative;">
                                            <div id="console"></div>
                                            <ul class="list-image list-unstyled">
                                                <li>
                                                    <div id="item-1" class="item">
                                                        <a href="javascript:;" class="btn-browse" id="browse-1" style="z-index: 1;">Add Image</a>
                                                        <div id="html5_1e80ktv3o5851762jiu1igmpjg3_container" class="moxie-shim moxie-shim-html5" style="position: absolute; top: 0px; left: 0px; width: 268px; height: 100px; overflow: hidden; z-index: 0;"><input id="html5_1e80ktv3o5851762jiu1igmpjg3" type="file" style="font-size: 999px; opacity: 0; position: absolute; top: 0px; left: 0px; width: 100%; height: 100%;" accept="image/jpeg,.jpg,image/gif,.gif,image/png,.png,.jpeg"></div>
                                                    </div>
                                                </li>

                                            </ul>
                                            <div class="drop_box" id="drop-image">
                                                <span class="image_placeholder"></span>
                                                <p>Drop your photo hear.</p>
                                            </div>
                                            <div class="total_status"> <span class="current_uploads" id="current_uploads">0</span> of <span class="total">1</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-body"></div>
            </div>
        </div>
    </div>
@endsection