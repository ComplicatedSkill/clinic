<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use App\Usesr;
class RegisterController extends Controller
{
    public function index(){
        $branchs = DB::table('tbl_branch')->get();
        $positions = DB::table('tbl_position')->get();
        $departments = DB::table('tbl_department')->get();
        // dd($ambulances);
        return view('block.usesr.register', ['branchs' => $branchs, 'positions' => $positions, 'departments'=>$departments]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request ){

        $request->validate([
            'username' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'tel' => 'required',
            'user_password' => 'required',
        ]);
        $password = $request->get('user_password'); // password is form field
        $hashed = Hash::make($password);

        $register = new User();
        $register-> branch_id = $request->branch_id;
        $register-> position_id = $request->position_id;
        $register-> department_id = $request->department_id;
        $register-> username = $request->username;
        $register-> user_password = $hashed;
        $register-> first_name = $request->first_name;
        $register-> last_name = $request->last_name;
        $register-> gender = $request->gender;
         $register-> dob = $request->dob;
        $register-> tel = $request->tel;
        $register-> email = $request->email;
        $register->status = '0';
        $register->register_date = date('Y-m-d');
        $register->Save();
        $request->session()->flash('message','Admin need to approve first');
        return back();
    }

    public function update(Request $request,$id){
        $update = User::where('user_id',$id)->first();
        $request->validate([
            'username' => 'required',
            'user_password' =>  'required'
        ]);
        $new_password = $request->input('user_password');
        $old_password = $request->input('old');
        if (Hash::check($old_password, $update->user_password)) {
            $request->session()->flash('message','Your password has been changed');
            return redirect()->back();
        }
        else{
            $request->session()->flash('message','Current password is incorrect');
            return redirect()->back();
        }
    }

    public function show(){}

}
