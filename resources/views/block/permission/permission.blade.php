@extends('master')
@section('title', 'User')
@section('page-title', isset($users)?'Edit User':'Create User')
@section('page-subtitle') <a href=" {{url('User')}}">User</a>@endsection
@section('subtitle',isset($users)?'Edit User':'Create User')
@section('content')
    @if(session('message'))
        @if(session('message') == 'Current password is incorrect')
            <div class="alert alert-danger">
                {{session('message')}}
            </div>
        @else
            <div class="alert alert-success">
                {{session('message')}}
            </div>
        @endif
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
                <h3 class="card-title">Set Permission</h3>
            </div>
            <!-- /.card-header -->
            @if(isset($users))
            @endif
            <div class="card-body">
                <form role="form"  method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @if(isset($users))
                        @method('PUT')
                    @else
                        @method('POST')
                    @endif
                    <div class="col-2" style="float: right">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            @if(isset($users))
                                Update
                            @else
                                Create
                            @endif
                        </button>
                    </div>
                    <div class="col-2">
                        <label for="image" class="btn btn-outline-dark btn-block btn-flat">Choose Profile Picture</label>
                        <input type="file"  id="image" name="image" style="display: none"/>
                    </div>

                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="{{asset('asset/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('asset/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(function() {
            $('input[name="dob"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format('YYYY'),10)
            }, function(start, end, label) {
                var years = moment().diff(start, 'years');
                alert("You are " + years + " years old!");
            });
        });
    </script>
@endsection
