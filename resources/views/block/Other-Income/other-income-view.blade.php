@extends('master')
@section('title', 'Other Income')
@section('page-title', 'Other Income')
@section('page-subtitle') <a href=" {{url('/home')}}">Dashboard</a>@endsection
@section('subtitle', 'Other Income')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
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
                <!-- /input-group -->

                    <form action="/search_user" method="get">
                        <div class="input-group mb-3 w-50 float-left">

                            <input type="text" class="form-control rounded-0" name="search" id="search"
                                   placeholder="Search"
                                   aria-label="search">
                            <span class="input-group-append">
                        <button type="submit" class="btn btn-info btn-flat mr-3"><i class="fas fa-search"></i></button>
                    </span>
                        </div>
                        <div class="mb-3 float-right">
                            <button type="button" class="btn btn-primary btn-md"
                                    onclick="window.location='{{ url('/OtherIncome')}}'">
                                <i class="fa fa-sync-alt"></i> Refresh
                            </button>
                            <button type="button" class="btn btn-success btn-md" data-toggle="modal"
                                    data-target="#modal-default">
                                <i class="fa fa-plus"></i> Create
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-body">

                    <table id="example2" class="table table-bordered table-hover">
                        <div class="modal fade" id="modal-default">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Note Other Income</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" id="createform"
                                              action="{{action('OtherIncomeController@store')}}"
                                              method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            @foreach($exchangeRates as $exchangeRate)
                                                <input type="hidden" name="exchange" class="form-control"
                                                       value="{{$exchangeRate->amount}}"
                                                       id="exchange" placeholder="Exchange">
                                            @endforeach
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="branch_id">Branch</label>
                                                    <select class="custom-select" name="branch_id">
                                                        @foreach ($branchs as $branch)
                                                            <option
                                                                value="{{$branch->branch_id}}">{{$branch->branch_name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="chart_account_id">Other Income</label>
                                                    <select class="custom-select" name="chart_account_id">
                                                        @foreach ($chartaccounts as $chartAccount)
                                                            <option
                                                                value="{{$chartAccount->chart_account_id}}">{{$chartAccount->chart_account_name_kh}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="date">Date</label>
                                                    <input class="form-control" id="date" name="date" placeholder="Date"
                                                           type="text" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name_eng">Currency</label>
                                                    <select class="custom-select" name="currency">
                                                        <option>Dollar</option>
                                                        <option>Riel</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="amount">Amount</label>
                                                    <input type="number" name="amount" class="form-control"
                                                           id="amount" placeholder="Amount" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exchange">Exchange Rate</label>
                                                    @foreach($exchangeRates as $exchangeRate)
                                                        <input type="number" name="rate" class="form-control"
                                                               value="{{$exchangeRate->amount}}"
                                                               id="rate" placeholder="Exchange" disabled>
                                                    @endforeach

                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <textarea class="form-control" rows="5" placeholder="Description" id="description"
                                                              name="description"></textarea>
                                                </div>
                                                <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Close
                                                </button>
                                                <button type="submit" id="cmd_submit"
                                                        class="btn btn-primary float-right">Save
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-sm">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th style="width: 80px">Nº</th>
                                        <th>Branch Name</th>
                                        <th>Other Income Description</th>
                                        <th>Income Date</th>
                                        <th>Currency</th>
                                        <th>Other Income Amount</th>
                                        <th>Exchange Rate</th>
                                        <th>Description</th>
                                        <th style="width: 100px">OPTION</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($ontherIncomes as $otherIncome)
                                        <tr role="row" class="odd">
                                            <td>{{$no++}}</td>
                                            <td>{{$otherIncome -> branchs -> branch_name}}</td>
                                            <td>{{$otherIncome -> chartAccounts -> chart_account_name_kh}}</td>
                                            <td>{{$otherIncome -> date}}</td>
                                            <td>{{$otherIncome -> currency}}</td>
                                            <td>{{$otherIncome -> amount}}</td>
                                            <td>{{$otherIncome -> exchange_rate}}</td>
                                            <td>{{$otherIncome -> description}}</td>
                                            <td>
                                                <a href="{{ route('OtherIncome.edit',$otherIncome->other_income_id) }}"
                                                   class="btn btn-primary btn-sm"> <i
                                                        class="fa fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger btn-sm btn_delete"
                                                        name="btnDelete"
                                                        onclick="delete_OtherIncome({{$otherIncome->other_income_id}})">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </table>
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
                var date_input = $('input[name="date"]'); //our date input has the name "date"
                var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
                date_input.datepicker({
                    format: 'yyyy/mm/dd',
                    container: container,
                    todayHighlight: true,
                    autoclose: true,
                })
            });

            function delete_OtherIncome(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{url('OtherIncome')}}/" + id,
                            type: 'DELETE',
                            data: {
                                "_token": $('@csrf').val(),
                            },
                            success: function (result) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )
                                    .then((willDelete) => {
                                        if (willDelete) {
                                            if (result.status == 200) {
                                                window.location.href = "{{url('OtherIncome')}}";
                                            }
                                        }
                                    })
                            }
                        });
                    }
                })
            }

        </script>

@endsection

