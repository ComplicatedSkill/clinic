@extends('master')
@section('title', 'category')
@section('page-title', 'CATEGORY INFO')
@section('page-subtitle', 'Dashboard')
@section('subtitle', 'Category-Info')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="padding-bottom:0px">
                    <!-- /input-group -->
                    <div class="input-group mb-1 w-50 float-left" style="padding: 0px">
                        <input type="text" class="form-control rounded-0" placeholder="Search" aria-label="Search">
                        <span class="input-group-append">
                            <button type="button" class="btn btn-info btn-flat mr-3"><i class="fas fa-search"></i>
                            </button>
                        </span>

                        <select class="custom-select" name="branch_id">
                            @foreach ($branchs as $branch)
                                <option value="{{$branch->branch_id}}">{{$branch->branch_name}}</option>
                            @endforeach
                        </select>
                    </div >
                    <!-- /input-group -->
                    <div class="mb-1 float-right" style="padding: 0px">
                        <button type="button" class="btn btn-primary btn-md" onclick="window.location='{{ url('/category')}}'">
                            <i class="fa fa-file-excel"></i> Exports
                        </button>
                        <a class="btn btn-success" href="{{ route('category.create') }}"><i class="fa fa-plus"></i> Create</a>
                    </div>
                </div>
                <div class="card-body" style="padding-top:10px">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="tableCagegory" class="table table-condensed table-hover" style="width: 100%;">
                            <thead>
                            <tr style="background-color: #3C8DBC">
                                <th nowrap style="width: 80px">#</th>
                                <th nowrap>id</th>
                                <th nowrap>Name Khmer</th>
                                <th nowrap>Name English</th>
                                <th nowrap>Description</th>
                                <th nowrap>Type</th>
                                <th nowrap>Status</th>
                                <th nowrap style="width: 130px">Option</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $no=1; ?>
                            @foreach ($categories as $category)
                                <tr role="row" class="odd">
                                    <td>{{$no++}}</td>
                                    <td class="sorting_1">{{$category -> cat_id}}</td>
                                    <td>{{$category -> cat_name_kh}}</td>
                                    <td>{{$category -> cat_name_eng}}</td>
                                    <td>{{$category -> cat_desc}}</td>
                                    <td>{{$category -> cat_type}}</td>
                                    <td>{{$category -> cat_stat}}</td>

                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ route('category.edit',$category->cat_id)}}"><i class="fa fa-edit"></i></a>
                                        <a class="btn btn-primary btn-sm" href="{{ route('category.show',$category->cat_id)}}"><i class="fas fa-eye"></i></a>
                                        <button type="button" class="btn btn-danger btn-sm btn_delete"  name="btnDelete" onclick="delete_category({{$category-> cat_id}})">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{--{!! $staff->links() !!}--}}
                    <script>
                        function delete_category(id) {
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
                                        url: "{{url('category')}}/" + id,
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
                                                            window.location.href = "{{url('category')}}";
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
