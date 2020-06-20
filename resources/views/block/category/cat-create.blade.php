@extends('master')
@section('title', 'category')
@section('page-title', 'ADD CATEGORY')
@section('page-subtitle') <a href="{{url('category')}}">Dashboard</a>@endsection
@section('subtitle', 'Add-Category')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-footer" style="padding-bottom: 0px"></div>
                <div class="card-header" style="padding-bottom: 0px">
                    <div class="input-group mb-1 w-50 float-left" >
                        <div class="row">
                            <div class="col-lg-12 float-sm-right">
                                <div class="pull-right">
                                    <a class="btn btn-primary" href="{{ route('category.index') }}"><i class="fas fa-step-backward"></i> Back</a>
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

                        <form action="{{isset($categories)?route('category.update',$categories->cat_id):route('category.store')}}" class="form-horizontal" id="frm-category" method="post" accept-charset="utf-8" novalidate="novalidate">
                            @csrf
                            @if (isset($categories))
                                @method('PUT')
                            @endif
                            <div class="form-group row">
                                <label for="BranchId" class="col-sm-2 control-label">Branch</label>
                                <div class="col-sm-10">
                                    <select class="custom-select" name="branch_id">
                                        @foreach ($branchs as $branch)
                                            <option value="{{$branch->branch_id}}"​​​ {{isset($categories) && $categories->branch_id==$branch->branch_id?'selected':''}}>{{$branch->branch_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="CatId" class="col-sm-2 control-label" >ID</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{isset($categories)?$categories->cat_id:''}}" class="form-control" id="cat_id" placeholder="Category Id" name="cat_id">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="CatNameKh" class="col-sm-2 control-label" >Name khmer</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{isset($categories)?$categories->cat_name_kh:''}}" class="form-control" id="cat_name_kh" placeholder="Name Khmer" name="cat_name_kh">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="CatNameEng" class="col-sm-2 control-label" >Name English</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{isset($categories)?$categories->cat_name_eng:''}}" class="form-control" id="cat_name_eng" placeholder="Name English" name="cat_name_eng">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="CatType" class="col-sm-2 control-label" >Type</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{isset($categories)?$categories->cat_type:''}}" class="form-control" id="cat_type" placeholder="Type" name="cat_type">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="CatDesc" class="col-sm-2 control-label" >Description</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{isset($categories)?$categories->cat_desc:''}}" class="form-control" id="cat_desc" placeholder="Description" name="cat_desc">
                                </div>
                            </div>
                            <div class="from-group row">
                                <label for="CatStatus" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-10">
                                    <select class="custom-select" name="cat_stat">
                                        <option value="Active" {{isset($categories) && $categories->cat_stat=='Active'?'selected':''}}>Active</option>
                                        <option value="Deactive" {{isset($categories) && $categories->cat_stat=='Deactive'?'selected':''}}>Deactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="CatImage" class="col-sm-2 control-label">Image</label>
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

                            <!-- /.box-body -->
                            <div class="box-footer float-sm-right" style="padding-top:15px">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            <!-- /.box-footer -->
                        </form>
                </div>
                <div class="card-footer" style="padding-top: 0px"></div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("#frm-category").validate({
                rules: {
                    cat_id:{required:true},
                    cat_name_kh:{required:true},
                    cat_name_eng:{required:true},
                    cat_type:{required:true},

                },
                messages: {
                    cat_id:{
                        required:"The category id  field is required."
                    },
                    cat_name_kh:{
                        required:"The name in khmer field is required."
                    },
                    cat_name_eng:{
                        required:"The name in english field is required."
                    },
                    cat_type:{
                        required:"The type field is required."
                    },
                }
            });

        });
    </script>
@endsection