<?php

namespace App\Http\Controllers;

use App\branch;
use App\Country;
use App\position;
use App\Schedule;
use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Department;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::with('branchs', 'departments', 'positions','countries')->get();
        $branchs = branch::get();
        $positions = position::get();
        $country = Country::get();
        return view('block.staff.staff-index', ['staffs' => $staffs, 'branchs' => $branchs,'countries' => $country])->withpositions($positions);
    }


    public function store(Request $request)
    {
        $request->validate([
            'branch_id' => 'required|numeric',
            'card_id' => 'required ',
            'staff_name_kh' => 'required',
            'staff_name_eng' => 'required',
            'gender' => 'required',
            'dob' => 'required|date',
            'tel' => 'required',
            'email' => 'required|email',
            'salary' => 'required|numeric',
            'position_id' => 'required|numeric',
            'department_id' => 'required|numeric',
            'country_id' => 'required',
        ]);
        $create = new Staff();
        $create->branch_id = $request->branch_id;
        $create->card_id = $request->card_id;
        $create->staff_name_kh = $request->staff_name_kh;
        $create->staff_name_eng = $request->staff_name_eng;
        $create->gender = $request->gender;
        $create->dob = $request->dob;
        $create->tel = $request->tel;
        $create->email = $request->email;
        $create->address = $request->address;
        $create->salary = $request->salary;
        $create->position_id = $request->position_id;
        $create->department_id = $request->department_id;
        $create->country_id = $request->country_id;
        $create->status = '1';
        $create->user_update = 'Admin';
        $create->date_update = date('Y-m-d');
        $create->Save();
        $request->session()->flash('message', 'Insert Successfully');
        return redirect()->back();
    }

    public function create()
    {
        $positions = position::get();
        $departments = department::get();
        $branchs = branch::get();
        $countries = Country::get();
        return view('block.staff.staff_create', ['branchs' => $branchs, 'departments' => $departments, 'positions' => $positions])->withcountries($countries);
    }

    public function show($id)
    {
        $staffs = DB::table('tbl_staff')->where('staff_id', $id)->first();
        return view('block.staff.staff-show', ['staffs' => $staffs]);
    }

    public function edit($id)
    {
        $positions = position::get();
        $departments = department::get();
        $branchs = branch::get();
        $countries = Country::get();
        $staffs = Staff::where('staff_id',$id)->first();
        return view('block.staff.staff_create', ['branchs' => $branchs, 'departments' => $departments, 'positions' => $positions])->withcountries($countries)->withstaffs($staffs);

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'branch_id' => 'required|numeric',
            'card_id' => 'required ',
            'staff_name_kh' => 'required',
            'staff_name_eng' => 'required',
            'gender' => 'required',
            'dob' => 'required|date',
            'tel' => 'required',
            'email' => 'required|email',
            'salary' => 'required|numeric',
            'position_id' => 'required|numeric',
            'department_id' => 'required|numeric',
            'country_id' => 'required',
        ]);
        $update = Staff::where('staff_id',$id)->first();
        $update->branch_id = $request->branch_id;
        $update->card_id = $request->card_id;
        $update->staff_name_kh = $request->staff_name_kh;
        $update->staff_name_eng = $request->staff_name_eng;
        $update->gender = $request->gender;
        $update->dob = $request->dob;
        $update->tel = $request->tel;
        $update->email = $request->email;
        $update->address = $request->address;
        $update->salary = $request->salary;
        $update->position_id = $request->position_id;
        $update->department_id = $request->department_id;
        $update->country_id = $request->country_id;
        $update->description = $request->description;
        $update->status = '1';
        $update->user_update = 'Admin';
        $update->date_update = date('Y-m-d');
        $update->Save();
        $request->session()->flash('message', 'Update Successfully');
        return redirect()->back();
    }

    public function destroy($id)
    {
        if (Staff::where('staff_id', $id)->delete($id)) {
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
