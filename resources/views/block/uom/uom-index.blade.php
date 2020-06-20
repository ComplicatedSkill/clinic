@extends('master')
@section('title','Measure')
@section('page-title','MEASOURC INFO')
@section('page-subtitle','Dashboard')
@section('subtitle', 'Measure')
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

                        {{--<select class="custom-select" name="branch_id">--}}
                            {{--@foreach ($branchs as $branch)--}}
                                {{--<option value="{{$branch->branch_id}}">{{$branch->branch_name}}</option>--}}
                            {{--@endforeach--}}
                        {{--</select>--}}
                    </div >
                    <!-- /input-group -->
                    <div class="mb-1 float-right" style="padding: 0px">
                        <button type="button" class="btn btn-primary btn-md" onclick="window.location='{{ url('/uom')}}'">
                            <i class="fa fa-file-excel"></i> Exports
                        </button>
                        <a class="btn btn-success" href="{{ route('uom.create') }}"><i class="fa fa-plus"></i> Create</a>
                    </div>
                </div>
                <div class="card-body" style="padding-top:10px">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                        <div class="table-responsive">
                            <table id="tablePatientList" class="table table-condensed table-hover" style="width: 100%;">
                                <thead>
                                <tr style="background-color: #3C8DBC">
                                    <th nowrap style="width: 80px">#</th>
                                    <th nowrap>Uom ID</th>
                                    <th nowrap>Uom Code</th>
                                    <th nowrap>Uom Name</th>
                                    <th nowrap>Fix</th>
                                    <th nowrap>Description1</th>
                                    <th nowrap>Description2</th>
                                    <th nowrap>Status</th>
                                    <th nowrap style="width: 100px">Option</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php $no=1; ?>
                                @foreach ($measures as $measure)
                                    <tr role="row" class="odd">
                                        <td>{{$no++}}</td>
                                        <td class="sorting_1">{{$measure -> uom_id}}</td>
                                        <td>{{$measure -> uom_code}}</td>
                                        <td>{{$measure -> uom_name}}</td>
                                        <td>{{$measure -> uom_fix}}</td>
                                        <td>{{$measure -> uom_des1}}</td>
                                        <td>{{$measure -> uom_des2}}</td>
                                        @if($measure -> uom_stat == '1')
                                            <td><span class="badge bg-success">Active</span></td>
                                        @elseif($measure -> uom_stat == '2')
                                            <td><span class="badge bg-success">Deactive</span></td>
                                        @else
                                            <td><span class="badge bg-danger">{{$measure -> uom_stat}}</span></td>
                                        @endif

                                        <td>
                                            <a class="btn btn-primary btn-sm" href="{{ route('uom.edit',$measure->uom_id)}}"><i class="fa fa-edit"></i></a>
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="delete_measure({{$measure-> uom_id}})">
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
                        function delete_measure(id) {
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
                                        url: "{{url('uom')}}/" + id,
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
                                                            window.location.href = "{{url('uom')}}";
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
