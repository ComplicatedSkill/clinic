@extends('master')
@section('title', 'Chart Account')
@section('page-title', 'Chart Account')
@section('page-subtitle') <a href=" {{url('/home')}}">Dashboard</a>@endsection
@section('subtitle', 'Chart Account')
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
                                    onclick="window.location='{{ url('/ChartAccount')}}'">
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
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Create Exchange RateS</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" id="createform"
                                              action="{{action('ChartAccountController@store')}}"
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
                                                    <label for="name_kh">Name Khmer</label>
                                                    <input type="text" name="name_kh" class="form-control"
                                                           id="name_kh" placeholder="Name Khmer" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name_eng">Name English</label>
                                                    <input type="text" name="name_eng" class="form-control"
                                                           id="name_eng" placeholder="Name English" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="account_type_id">Account Type</label>
                                                    <select class="custom-select" name="account_type_id">
                                                        @foreach ($accountType as $accountTypes)
                                                            <option
                                                                value="{{$accountTypes->account_type_id}}">{{$accountTypes->account_type_name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
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
                                    <th>Name Khmer</th>
                                    <th>Name English</th>
                                    <th>Account Type</th>
                                    <th>Description</th>
                                    <th style="width: 100px">OPTION</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $no = 1; ?>
                                @foreach ($chartaccounts as $chartAccount)
                                    <tr role="row" class="odd">
                                        <td>{{$no++}}</td>
                                        <td>{{$chartAccount -> branchs -> branch_name}}</td>
                                        <td>{{$chartAccount -> chart_account_name_kh}}</td>
                                        <td>{{$chartAccount -> chart_account_name_eng}}</td>
                                        <td>{{$chartAccount -> accountTypes -> account_type_name}}</td>
                                        <td>{{$chartAccount -> description}}</td>
                                        <td>
                                            <a href="{{ route('ChartAccount.edit',$chartAccount->chart_account_id) }}"
                                               class="btn btn-primary btn-sm"> <i
                                                    class="fa fa-edit"></i></a>
                                            <button type="button" class="btn btn-danger btn-sm btn_delete"
                                                    name="btnDelete"
                                                    onclick="delete_ChartAccount({{$chartAccount->chart_account_id}})">
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
            function delete_ChartAccount(id) {
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
                            url: "{{url('ChartAccount')}}/" + id,
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
                                                window.location.href = "{{url('ChartAccount')}}";
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

