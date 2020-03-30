<?php

namespace App\Http\Controllers;

use App\Ambulances;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AmbulanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ambulances = DB::table('tbl_ambulance')
        ->join('tbl_staff','tbl_staff.staff_id', '=', 'tbl_ambulance.staff_id')
        ->select('tbl_ambulance.ambulance_id','tbl_ambulance.ambulance_name','tbl_ambulance.license_plate','tbl_staff.staff_name_kh','tbl_ambulance.status')
        ->get();

        $staffs = DB::table('tbl_staff')->get();

        $branchs = DB::table('tbl_branch')->get();
        // dd($ambulances);
        return view('block.ambulance.ambulance-page', ['ambulances' => $ambulances, 'staffs' => $staffs , 'branchs' => $branchs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $ambulances = $request->only(['branch_id','ambulance_id','ambulance_name','license_plate','staff_id','status','user_create','date_create','user_update','date_update']);
        // dd($ambulances);
        // $success = DB::table('tbl_ambulance')->insert($ambulances);
        // if($success){
        //     return redirect('ambulance');
        // }
        // return \back();

        $brn_id = $request->branch_id;
        $amb_id = $request->ambulance_id;
        $amb_name = $request->ambulance_name;
        $amb_plat = $request->license_plate;
        $staff_id= $request->staff_id;
        $amb_status = $request->status;
        $user_create = 'ADMIN';
        $date_create = date('Y-m-d');
        $user_update = 'ADMIN';
        $date_update = date('Y-m-d');
        $success = DB::table('tbl_ambulance')->insert([
            'branch_id' => $brn_id,
            'ambulance_id' => $amb_id,
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Ambulances  $ambulances
     * @return \Illuminate\Http\Response
     */
    public function show(Ambulances $ambulances)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ambulances  $ambulances
     * @return \Illuminate\Http\Response
     */
    public function edit(Ambulances $ambulance_id)
    {
        $ambulance=DB::table('tbl_ambulance')->find($ambulance_id);
        $staffs=DB::table('tbl_staff')->get();
        $branchs=DB::table('tbl_branch')->get();
        return view('block.ambulance.ambulance-edit', compact('ambulance','staffs','branchs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ambulances  $ambulances
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ambulances $ambulances)
    {
        $brn_id = $request->branch_id;
        $amb_id = $request->ambulance_id;
        $amb_name = $request->ambulance_name;
        $amb_plat = $request->license_plate;
        $staff_id= $request->staff_id;
        $amb_status = $request->status;
        $user_create = 'ADMIN';
        $date_create = date('Y-m-d');
        $user_update = 'ADMIN';
        $date_update = date('Y-m-d');
        $rows = DB::table('tbl_ambulance')->where('ambulance_id',$ambulances)->update([
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
        if($rows>0)
        return redirect('ambulance');
        else
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ambulances  $ambulances
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ambulances $ambulances)
    {
        //
    }
}
