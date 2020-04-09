<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function edit($id){
        $id = 1;
        $schedule = Schedule::with('User')->where('staff_id',$id)->first();
        return view('block.staff.schedule',['schedule'=>$schedule]);
    }
}
