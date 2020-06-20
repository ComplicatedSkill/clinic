<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\branch;
use App\department;
use App\Http\Controllers\Controller;
use App\Patient;
use App\Staff;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    function index(){
        $branch = branch::get();
        $department = department::get();
        $patient = Patient::get();
        $staff = Staff::get();
        $appointment = Appointment::with('branchs','staffs','departments','patients')->get();
        return view('block.Appointment.view-appointment')->withappointments($appointment)->withbranchs($branch)->withdepartments($department)->withpatients($patient)->withstaffs($staff);
    }

    function show(){
        $branch = branch::get();
        $department = department::get();
        $patient = Patient::get();
        $staff = Staff::get();
        $appointment = Appointment::with('branchs','staffs','departments','patients')->get();
        return view('block.Appointment.make-appointment')->withappointments($appointment)->withbranchs($branch)->withdepartments($department)->withpatients($patient)->withstaffs($staff);
    }

    function store(Request $request){
        $request->validate([
            'branch_id'=>'required',
            'appointment_tittle'=>'required',
            'color' => 'required ',
            'patient_id' => 'required|numeric',
            'department_id' => 'required|numeric',
            'staff_id'=> 'required|numeric',
            'date' => 'required',
            'time'=> 'required',
        ]);
        $appointment = new Appointment();
        $appointment->branch_id = $request->branch_id;
        $appointment->appointment_title = $request->appointment_tittle;
        $appointment->color = $request->color;
        $appointment->patient_id = $request->patient_id;
        $appointment->department_id = $request->department_id;
        $appointment->staff_id =   $request->staff_id;
        $appointment->date = $request->date;
        $appointment->time =   $request->time;
        $appointment->note = $request->note;
        $appointment->user_update = 'Admin';
        $appointment->date_update = date('Y-m-d');
        $appointment->Save();
        $request->session()->flash('message','Insert Successfully');
        return redirect()->back();
    }

    function change(Request $request){
        $id = $request->appointment_id;
        $branch = branch::get();
        $department = department::get();
        $patient = Patient::get();
        $staff = Staff::get();
        $appointment = Appointment::with('branchs','staffs','departments','patients')->where('appointment_id',$id)->first();
        return view('block.Appointment.edit-appointment', ['appointments' => $appointment])->withbranchs($branch)->withdepartments($department)->withpatients($patient)->withstaffs($staff);
    }

    function update(Request $request, $id){
        $request->validate([
            'branch_id'=>'required',
            'appointment_tittle'=>'required',
            'color' => 'required ',
            'patient_id' => 'required|numeric',
            'department_id' => 'required|numeric',
            'staff_id'=> 'required|numeric',
            'date' => 'required',
            'time'=> 'required',
        ]);
        $appointment = Appointment::where('appointment_id', $id)->first();
        $appointment->branch_id = $request->branch_id;
        $appointment->appointment_title = $request->appointment_tittle;
        $appointment->color = $request->color;
        $appointment->patient_id = $request->patient_id;
        $appointment->department_id = $request->department_id;
        $appointment->staff_id =   $request->staff_id;
        $appointment->date = $request->date;
        $appointment->time =   $request->time;
        $appointment->note = $request->note;
        $appointment->user_update = 'Admin';
        $appointment->date_update = date('Y-m-d');
        $appointment->Save();
        $request->session()->flash('message','Update Successfully');
        return redirect()->back();
    }

    public function destroy($id){
        if(Appointment::where('appointment_id', $id)->delete($id)){
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
