<?php

namespace App\Http\Controllers;

use App\branch;
use App\department;
use App\Http\Controllers\Controller;
use App\position;
use App\User;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(){
        $branchs = branch::get();
        $departments  = department::get();
        return view('block.department.view')->withdepartments($departments)->withbranchs($branchs);
    }

    public function create(){
        $departments = department::get();
        $branchs = branch::get();
        return view('block.department.edit_user')->withdepartments($departments)->withbranchs($branchs);
    }

    public function store(Request $request){
        $request->validate([
            'department_name' => 'required',
        ]);
        $department = new department();
        $department->department_name = $request->department_name;
        $department-> department_description = $request->department_description;
        $department->branch_id = $request->branch_id;
        $department->Save();
        $request->session()->flash('message','Insert Successfully');
        return redirect()->back();
    }

    public function destroy($id){
        if(department::where('department_id', $id)->delete($id)){
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

    public function edit($id){
        $branchs = branch::get();
        $departments = department::with('branchs')->where('department_id',$id)->first();
        return view('block.department.edit_department',['department'=>$departments])->withbranchs($branchs);
    }

    public function update(Request $request, $id){
        $request->validate([
            'department_name' => 'required',
        ]);
        $department = department::where('department_id',$id)->first();
        $department->department_name = $request->department_name;
        $department-> department_description = $request->department_description;
        $department->branch_id = $request->branch_id;
        $department->Save();
        $request->session()->flash('message','Update Successfully');
        return redirect()->back();
    }
}
