<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function edit($id){
        $id = 1;
        $schedule = Schedule::with('Staff')->where('staff_id',$id)->first();
        return view('block.staff.schedule',['schedule'=>$schedule]);
    }

    public function update(Request $request, $id){
        $id =1;
        if( $request->status == false) {
            $status = '0';
        } else {
            $status = '1';
        }
        $update = Schedule::where('staff_id',$id)->first();
        $update-> schedule_name = $request->schedule_name;
        $update-> description = $request->description;
        $update-> mo = $request->mo;
        $update-> tu = $request->tu;
        $update-> we = $request->we;
        $update-> th = $request->th;
        $update-> fr = $request->fr;
        $update-> sa = $request->sa;
        $update-> su = $request->su;
        $update-> morning_time_in = $request->morning_time_in;
        $update-> morning_time_out = $request->morning_time_out;
        $update-> everning_time_in = $request->everning_time_in;
        $update-> everning_time_out = $request->everning_time_out;
        $update-> date_update = date('Y-m-d');
        $update->status = $status;
        $update->save();
        $request->session()->flash('message','Schedule has been changed');
        return redirect()->back();
    }
}
