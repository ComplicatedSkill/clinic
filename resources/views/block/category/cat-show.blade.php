@extends('master')
@section('title', 'category')
@section('page-title', 'VIEW CATEGORY')
@section('page-subtitle') <a href="{{url('category')}}">Dashboard</a>@endsection
@section('subtitle', 'View-Category')
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

                </div>
                <div class="card-footer" style="padding-top: 0px"></div>
            </div>
        </div>
    </div>
@endsection