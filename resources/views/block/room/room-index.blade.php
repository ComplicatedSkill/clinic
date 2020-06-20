@extends('master')
@section('title','Room')
@section('page-title','Room Information')
@section('page-subtitle','Dashboard')
@section('subtitle', 'Room')
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
                        <button type="button" class="btn btn-primary btn-md" onclick="window.location='{{ url('/room')}}'">
                            <i class="fa fa-file-excel"></i> Exports
                        </button>
                        <button type="button" class="btn btn-success btn-md" data-toggle="modal"
                                data-target="#modal-default">
                            <i class="fa fa-plus"></i> Create
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <div class="modal fade" id="modal-default">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Create Room</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form role="form" id="createform"
                                              action="{{action('RoomController@store')}}"
                                              method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('POST')
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="branch_id">Branch Name</label>
                                                    <select class="custom-select" name="branch_id">
                                                        @foreach ($branchs as $branch)
                                                            <option
                                                                value="{{$branch->branch_id}}">{{$branch->branch_name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="room_name">Room Name</label>
                                                    <input type="text" name="room_name" class="form-control"
                                                           id="room_name" placeholder="Room Name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="room_type_id">Room Type</label>
                                                    <select class="custom-select" name="room_type_id">
                                                        @foreach ($roomtypes as $roomtype)
                                                            <option
                                                                value="{{$roomtype->room_type_id}}">{{$roomtype->room_type_name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="building">Building</label>
                                                    <input type="text" name="building" class="form-control"
                                                           id="building" placeholder="Building" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="department_id">Department</label>
                                                    <select class="custom-select" name="department_id">
                                                        @foreach ($departments as $department)
                                                            <option
                                                                value="{{$department->department_id}}">{{$department->department_name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="floor_id">Floor</label>
                                                    <select class="custom-select" name="floor_id">
                                                        @foreach ($floors as $floor)
                                                            <option
                                                                value="{{$floor->floor_id}}">{{$floor->floor_name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
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
                    </table>
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
                                <th nowrap style="width: 80px">Nº</th>
                                <th nowrap>Branch Name</th>
                                <th nowrap>Name</th>
                                <th nowrap>Building</th>
                                <th nowrap>Floor</th>
                                <th nowrap>Type</th>
                                <th nowrap>Department</th>
                                <th nowrap>Description</th>
                                <th nowrap>Status</th>
                                <th nowrap style="width: 100px">Option</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $no=1; ?>
                            @foreach ($rooms as $room)
                                <tr role="row" class="odd">
                                    <td>{{$no++}}</td>
                                    <td class="sorting_1">{{$room -> branchs->branch_name}}</td>
                                    <td>{{$room -> room_name}}</td>
                                    <td>{{$room -> building}}</td>
                                    <td>{{$room -> floors->floor_name}}</td>
                                    <td>{{$room -> roomtypes->room_type_name}}</td>
                                    <td>{{$room -> departments->department_name}}</td>
                                    <td>{{$room -> description}}</td>
                                    @if($room -> status == '1')
                                        <td><span class="badge bg-success">Enable</span></td>
                                    @else
                                        <td><span class="badge bg-danger">Disable</span></td>
                                    @endif

                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{route('room.edit',$room->room_id)}}"><i class="fa fa-edit"></i></a>
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="delete_room({{$room-> room_id}})">
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
                        function delete_room(id) {
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
                                        url: "{{url('room')}}/" + id,
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
                                                            window.location.href = "{{url('room')}}";
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

