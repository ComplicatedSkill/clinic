@extends('master')
@section('title', 'Department')
@section('page-title', 'Edit Chart Account')
@section('page-subtitle') <a href=" {{url('ChartAccount')}}">Chart Account</a>@endsection
@section('subtitle', 'Edit Chart Account')
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
                <h3 class="card-title">Chart Account Information</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form role="form" action="{{action('ChartAccountController@update',$chartAccount->chart_account_id)}}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name_kh">Name Khmer</label>
                                <input type="text" value="{{$chartAccount->chart_account_name_kh}}" class="form-control" placeholder="Name Khmer" name="name_kh" id="name_kh">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group" >
                                <label for="name_eng">Name English</label>
                                <input type="text" value="{{$chartAccount->chart_account_name_eng}}" class="form-control" placeholder="Name English" name="name_eng" id="name_eng">
                            </div>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" rows="5" placeholder="Description"
                                              id="description"
                                              name="description">{{$chartAccount->description}}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="account_type_id">Account Type</label>
                                    <select class="custom-select" name="account_type_id" id="account_type_id">
                                        @foreach ($accountType as $accountType)
                                            <option value="{{$accountType->account_type_id}}" {{$accountType->account_type_id==$chartAccount->account_type_id?'selected':''}}>{{$accountType->account_type_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="branch_id">Branch</label>
                                    <select class="custom-select" name="branch_id" id="branch_id">
                                        @foreach ($branchs as $branch)
                                            <option value="{{$branch->branch_id}}" {{$branch->branch_id==$chartAccount->branch_id?'selected':''}}>{{$branch->branch_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    <div class="col-2" style="float: right">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Update</button>
                    </div>

                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
