@extends('master')
@section('title', 'Cash Withdrawal')
@section('page-title', 'Edit Cash Withdrawal')
@section('page-subtitle') <a href=" {{url('CashWithdrawal')}}">Cash Withdrawal</a>@endsection
@section('subtitle', 'Edit Cash Withdrawal')
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
                <h3 class="card-title">Cash Withdrawal Information</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form role="form" action="{{action('WithdrawalController@update',$cashWithdrawals->cash_withdrawal_id)}}"
                      method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="branch_id">Branch</label>
                                <select class="custom-select" name="branch_id" id="branch_id">
                                    @foreach ($branchs as $branch)
                                        <option
                                            value="{{$branch->branch_id}}" {{$branch->branch_id==$cashWithdrawals->branch_id?'selected':''}}>{{$branch->branch_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <!-- text input -->
                            <div class="form-group">
                                <label for="chart_account_id">Cash Withdrawal Description</label>
                                <select class="custom-select" name="chart_account_id">
                                    @foreach ($chartAccounts as $chartAccount)
                                        <option
                                            value="{{$chartAccount->chart_account_id}}" {{$chartAccount->chart_account_id==$cashWithdrawals->chart_account_id?'selected':''}}>{{$chartAccount->chart_account_name_kh}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="date">Cash Withdrawal Date</label>
                                <input class="form-control" id="date" name="date" placeholder="Date"
                                       value="{{$cashWithdrawals->date}}" type="text" required/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name_eng">Currency</label>
                                <select class="custom-select" name="currency">
                                    <option @if($cashWithdrawals ->currency == 'Dollar')
                                            selected
                                        @endif>Dollar
                                    </option>
                                    <option @if($cashWithdrawals ->currency == 'Riel')
                                            selected
                                        @endif>Riel
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="amount">Withdrawal Amount</label>
                                <input class="form-control" id="amount" name="amount" placeholder="Income Amount"
                                       value="{{$cashWithdrawals->amount}}" type="text" required/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" rows="5" placeholder="Description" id="description"
                                          name="description">{{$cashWithdrawals->description}}</textarea>
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

    <!-- Include Date Range Picker -->


    <script type="text/javascript">
        $(document).ready(function () {
            var date_input = $('input[name="date"]'); //our date input has the name "date"
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
