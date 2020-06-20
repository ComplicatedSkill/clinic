@extends('master')
@section('title', 'Department')
@section('page-title', 'Edit Department')
@section('page-subtitle') <a href=" {{url('exchangeRate')}}">Exchange Rate</a>@endsection
@section('subtitle', 'Edit Exchange Rate')
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
                <h3 class="card-title">Department Information</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form role="form" action="{{action('ExchangeRateController@update',$exchangeRate->exchange_rate_id)}}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="branch_id">Branch</label>
                                <select class="custom-select" name="branch_id" id="branch_id">
                                    @foreach ($branchs as $branch)
                                        <option value="{{$branch->branch_id}}" @if($exchangeRate -> branchs -> branch_id == $branch -> branch_id)
                                                selected @endif
                                        >{{$branch->branch_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label for="ex_id">Exchange Rate ID</label>
                                <input type="text" value="{{$exchangeRate->exchange_rate_id}}" class="form-control" placeholder="Excahnge Rate ID" name="ex_id" id="ex_id" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="ask_amount">Ask Amount</label>
                                <input type="number" value="{{$exchangeRate->amount}}" class="form-control" placeholder="Ask Amount" name="ask_amount" id="ask_amount">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" rows="5" placeholder="Description"
                                          id="description"
                                          name="description">{{$exchangeRate->description}}</textarea>
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
