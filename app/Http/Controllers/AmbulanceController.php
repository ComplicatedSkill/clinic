<?php

namespace App\Http\Controllers;

use App\Ambulances;
use App\branch;
use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AmbulanceController extends Controller
{
    public function index()
    {
        $staffs= Staff::get();
        $branchs= branch::get();
        $ambulance = Ambulances::with('staffs', 'branchs')->get();
        return view('block.ambulance.ambulance-page', ['ambulances' => $ambulance])->withstaff($staffs)->withbranchs($branchs);

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required ',
            'ambulance_name' => 'required ',
            'license_plate' => 'required ',
            'staff_id' => 'required|numeric'
        ]);
        if ($request->status == false) {
            $status = '0';
        } else {
            $status = '1';
        }

        $brn_id = $request->branch_id;
        $amb_name = $request->ambulance_name;
        $amb_plat = $request->license_plate;
        $staff_id= $request->staff_id;
        $amb_status = $status;
        $user_create = 'ADMIN';
        $date_create = date('Y-m-d');
        $user_update = 'ADMIN';
        $date_update = date('Y-m-d');
        $success = DB::table('tbl_ambulance')->insert([
            'branch_id' => $brn_id,
            'ambulance_name' => $amb_name,
            'license_plate' => $amb_plat,
            'staff_id' => $staff_id,
            'status' => $amb_status,
            'user_create' => $user_create,
            'date_create' => $date_create,
            'user_update' => $user_update,
            'date_update' => $date_update
        ]);
        if($success){
            return redirect('ambulance');
        }
        return back();
    }

    public function show(Ambulances $ambulances)
    {

    }

    public function edit($id)
    {
        $staffs= Staff::get();
        $branchs= branch::get();
        $ambulance = Ambulances::with('staffs','branchs')->where('ambulance_id', $id)->first();
        return view('block.ambulance.ambulance-edit', ['ambulances' => $ambulance])->withstaff($staffs)->withbranchs($branchs);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'branch_id' => 'required ',
            'ambulance_name' => 'required ',
            'license_plate' => 'required ',
            'staff_id' => 'required|numeric'
        ]);
        if ($request->status == false) {
            $status = '0';
        } else {
            $status = '1';
        }
        $request->validate([
            'branch_id' => 'required',
            'ambulance_name' => 'required',
            'license_plate' => 'required',
            'staff_id' => 'required',
        ]);
        $update = Ambulances::where('ambulance_id', $id)->first();
        $update->branch_id = $request->branch_id;
        $update->ambulance_name = $request->ambulance_name;
        $update->license_plate = $request->license_plate;
        $update->staff_id = $request->staff_id;
        $update->status = $status;
        $update->user_update = 'Admin';
        $update->date_update = date('Y-m-d');
        $update->save();
        $request->session()->flash('message', 'Update Successfully');
        return redirect()->back();
    }

    public function destroy($id)
    {
        if (Ambulances::where('ambulance_id', $id)->delete($id)) {
            return response()->json([
                'status' => 200,
                'message' => 'Record deleted successfully!'
            ]);
        } else {
            return response()->json([
                'status' => 201,
                'message' => 'Record deleted failed!'
            ]);
        }
    }
}
