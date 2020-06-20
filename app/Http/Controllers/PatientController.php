<?php

namespace App\Http\Controllers;

use App\branch;
use App\Country;
use App\department;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    public function index()
    {
        $patients=Patient::with('branchs','departments','countries')->get();
        $branchs = branch::get();
        $departments = department::get();
        $country = Country::get();
        return view('block.patient.patient-index',['patients'=>$patients,'branchs'=>$branchs,])->withdepartments($departments)->withcountries($country);
    }

    public function create()
    {
        $branchs = branch::get();
        $departments = department::get();
        $country = Country::get();
        return view('block.patient.patient-create')->withcountries($country)->withbranchs($branchs)->withdepartments($departments);
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
        $create = new Patient();
        $create->branch_id = $request->branch_id;
        $create->patient_name_kh = $request->patient_name_kh;
        $create->patient_name_eng = $request->patient_name_eng;
        $create->gender = $request->gender;
        $create->dob = $request->dob;
        $create->tel = $request->tel;
        $create->email = $request->email;
        $create->address = $request->address;
        $create->department_id = $request->department_id;
        $create->country_id = $request->country_id;
        $create->user_update = 'Admin';
        $create->status = '1';
        $create->date_update = date('Y-m-d');
        $create->Save();
        $request->session()->flash('message', 'Insert Successfully');
        return redirect()->back();
    }
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $branchs = branch::get();
        $departments = department::get();
        $country = Country::get();
        $patients= Patient::where('patient_id', $id)->first();
        return view('block.patient.patient-create',['patients'=>$patients ,'branchs'=>$branchs,'departments',$departments,'countries',$country]);
    }


    public function update(Request $request, $id){
        $request->validate([
            'branch_id' => 'required|numeric',
            'patient_name_kh' => 'required',
            'patient_name_eng' => 'required',
            'gender' => 'required',
            'dob' => 'required|date',
            'tel' => 'required',
            'email' => 'required|email',
            'department_id' => 'required|numeric',
            'country_id' => 'required',
        ]);
        $create = Patient::where('patient_id',$id)->first();
        $create->branch_id = $request->branch_id;
        $create->patient_name_kh = $request->patient_name_kh;
        $create->patient_name_eng = $request->patient_name_eng;
        $create->gender = $request->gender;
        $create->dob = $request->dob;
        $create->tel = $request->tel;
        $create->email = $request->email;
        $create->address = $request->address;
        $create->department_id = $request->department_id;
        $create->country_id = $request->country_id;
        $create->user_update = 'Admin';
        $create->status = '1';
        $create->date_update = date('Y-m-d');
        $create->Save();
        $request->session()->flash('message', 'Insert Successfully');
        return redirect()->back();
    }
    public function destroy($id)
    {
        if(Patient::where('patient_id', $id)->delete($id)){
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
