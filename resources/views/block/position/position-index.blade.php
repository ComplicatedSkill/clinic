@extends('master')
@section('title','Position')
@section('page-title','POSITION INFO')
@section('page-subtitle','Dashboard')
@section('subtitle', 'Position')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header" style="margin-bottom: 0px">
                    <div class="input-group mb-1 w-50 float-left" style="padding: 0px">
                        <input type="text" class="form-control rounded-0" placeholder="Search" aria-label="Search">
                        <span class="input-group-append">
                                <button type="button" class="btn btn-info btn-flat mr-3"><i class="fas fa-search"></i>
                                </button>
                        </span>
                    </div >
                    <!-- /input-group -->
                    <div class="mb-1 float-right" style="padding: 0px">
                        <button type="button" class="btn btn-primary btn-md" onclick="window.location='{{ url('/position')}}'">
                            <i class="fa fa-file-excel"></i> Exports
                        </button>
                        <a class="btn btn-success" href="{{ route('position.create') }}"><i class="fa fa-plus"></i> Create</a>
                    </div>
                </div>
                <div class="card-body" style="padding-top:10px">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="table-responsive">

                        <table id="tablePosition" class="table table-condensed table-hover" style="width: 100%;">
                            <thead>
                            <tr style="background-color: #3C8DBC">
                                <th nowrap style="width: 80px">#</th>
                                <th nowrap>id</th>
                                <th nowrap>Id</th>
                                <th nowrap>Position</th>
                                <th nowrap>Description</th>
                                <th nowrap style="width: 100px">Option</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $no=1; ?>
                            @foreach ($positions as $position)
                                <tr role="row" class="odd">
                                    <td>{{$no++}}</td>
                                    <td class="sorting_1">{{$position -> posit_id}}</td>
                                    <td>{{$position -> posit_type}}</td>
                                    <td>{{$position -> posit_desc}}</td>
                                    <td>{{$position -> posit_status}}</td>

                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ route('position.edit',$position->posit_id)}}"><i class="fa fa-edit"></i></a>
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="delete_position({{$position-> posit_id}})">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{--{!! $patient->links() !!}--}}
                    <script>
                        function delete_position(id) {
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
                                        url: "{{url('position')}}/" + id,
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
                                                            window.location.href = "{{url('position')}}";
                                                        }
                                                    }
                                                })
                                        }
                                    });
                                }
                            })
                        }
                    </script>

                </div>
            </div>
        </div>
    </div>
@endsection
