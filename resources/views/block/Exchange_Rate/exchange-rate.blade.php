@extends('master')
@section('title', 'Exchange Rate')
@section('page-title', 'Exchange Rate')
@section('page-subtitle') <a href=" {{url('/home')}}">Dashboard</a>@endsection
@section('subtitle', 'Exchange Rate')
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
                                    onclick="window.location='{{ url('/exchangeRate')}}'">
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
                        {{-- Modal Create Form --}}
                        <div class="modal fade" id="modal-default">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Create Exchange RateS</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" id="createform"
                                              action="{{action('ExchangeRateController@store')}}"
                                              method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
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
                                                    <label for="amount">Amount</label>
                                                    <input type="number" name="amount" class="form-control"
                                                           id="amount" placeholder="Ask Amount" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <textarea class="form-control" rows="5" placeholder="Description"
                                                              id="description"
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
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="width: 80px">Nº</th>
                                    <th>Branch Name</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th style="width: 100px">OPTION</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $no = 1; ?>
                                @foreach ($exchangeRate as $exchangeRates)
                                    <tr role="row" class="odd">
                                        <td>{{$no++}}</td>
                                        <td>{{$exchangeRates -> branchs -> branch_name}}</td>
                                        <td>{{$exchangeRates -> amount}}</td>
                                        <td>{{$exchangeRates -> description}}</td>
                                        <td>
                                            <a href="{{ route('exchangeRate.edit',$exchangeRates->exchange_rate_id) }}"
                                               class="btn btn-primary btn-sm"> <i
                                                    class="fa fa-edit"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm btn_delete"
                                                    name="btnDelete"
                                                    onclick="delete_exchangeRate({{$exchangeRates->exchange_rate_id}})">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </table>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function delete_exchangeRate(id) {
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
                            url: "{{url('exchangeRate')}}/" + id,
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
                                                window.location.href = "{{url('exchangeRate')}}";
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

