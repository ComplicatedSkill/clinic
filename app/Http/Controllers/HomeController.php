<?php

namespace App\Http\Controllers;

use App\Ambulances;
use App\Appointment;
use App\Bed;
use App\department;
use App\Patient;
use App\Room;
use App\Staff;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $count_department = department::count();
        $count_user = User::count();
        $appointments = Appointment::get();
        $count_appointment = count($appointments);
        $patients = Patient::count();
        $staffs = Staff::count();
        $rooms = Room::count();
        $beds = Bed::count();
        $ambulances = Ambulances::count();
        return view('block.home.home-page')->withdepartments($count_department)->withdepartments($count_department)
            ->withusers($count_user)->withappointments($appointments)->withpatients($patients)->withstaffs($staffs)
            ->withappoinentcount($count_appointment)->withroom($rooms)
            ->withbed($beds)->withambulances($ambulances);
    }
}
