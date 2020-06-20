<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 4/22/2020
 * Time: 8:48 AM
 */

namespace App\Http\Controllers;

use App\branch;
use App\floor;
use App\Room;
use App\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Department;

class RoomController extends Controller
{
    public function index()
    {
        $rooms=Room::with('branchs','floors','roomtypes','departments')->get();
        $branchs = branch::get();
        $roomtypes = RoomType::get();
        $floor = floor::get();
        $departments = department::get();
        return view('block.room.room-index',['rooms'=>$rooms,'branchs'=>$branchs])->withroomtypes($roomtypes)->withfloors($floor)->withdepartments($departments);
    }


    public function store(Request $request)
    {
        $request->validate([
            'branch_id'=>'required|numeric',
            'room_name'=>'required',
            'room_type_id' => 'required|numeric ',
            'building' => 'required ',
            'department_id' => 'required|numeric',
            'floor_id'=> 'required|numeric'
        ]);
        $rooms = new Room();
        $rooms->branch_id = $request->branch_id;
        $rooms->room_name = $request->room_name;
        $rooms->room_type_id = $request->room_type_id;
        $rooms->building = $request->building;
        $rooms->department_id = $request->department_id;
        $rooms->floor_id =   $request->floor_id;
        $rooms->description = $request->description;
        $rooms->user_create = 'Admin';
        $rooms->date_create = date('Y-m-d');
        $rooms->status = '1';
        $rooms->Save();
        $request->session()->flash('message','Insert Successfully');
        return redirect()->back();
    }

    public function edit($id)
    {
        $rooms=Room::where('room_id',$id)->first();
        $branchs = branch::get();
        $roomtypes = RoomType::get();
        $floor = floor::get();
        $departments = department::get();
        return view('block.room.room-edit',['rooms'=>$rooms,'branchs'=>$branchs])->withroomtypes($roomtypes)->withfloors($floor)->withdepartments($departments);
    }

    public function update(Request $request, $id){
        $request->validate([
            'branch_id'=>'required|numeric',
            'room_name'=>'required',
            'room_type_id' => 'required|numeric ',
            'building' => 'required ',
            'department_id' => 'required|numeric',
            'floor_id'=> 'required|numeric'
        ]);
        if ($request->status == false) {
            $status = '0';
        } else {
            $status = '1';
        }
        $rooms =  Room::where('room_id',$id)->first();
        $rooms->branch_id = $request->branch_id;
        $rooms->room_name = $request->room_name;
        $rooms->room_type_id = $request->room_type_id;
        $rooms->building = $request->building;
        $rooms->department_id = $request->department_id;
        $rooms->floor_id =   $request->floor_id;
        $rooms->description = $request->description;
        $rooms->status = $status;
        $rooms->user_update = 'Admin';
        $rooms->date_update = date('Y-m-d');
        $rooms->Save();
        $request->session()->flash('message','Update Successfully');
        return redirect()->back();
    }

    public function destroy($id)
    {
        if(Room::where('room_id', $id)->delete($id)){
            return response()->json([
                'status'=>200,
                'message' => 'Record deleted successfully!'
            ]);
        }else{
            return response()->json([
                'status'=>201,
                'message' => 'Record deleted failed!'
            ]);
        }

    }
}
