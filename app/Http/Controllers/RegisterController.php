<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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
            'email' => 'required',
            'tel' => 'required',
            'user_password' => 'required',
        ]);

        $register = new User();
        $register-> branch_id = $request->branch_id;
        $register-> position_id = $request->position_id;
        $register-> department_id = $request->department_id;
        $register-> username = $request->username;
        $register-> user_password = bcrypt( $request->user_password);
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
//        $branch_id = $request->branch_id;
//        $position_id = $request-> position_id;
//        $department_id = $request -> department_id;
//        $username = $request -> username;
//        $user_password = $request -> user_password;
//        $first_name = $request -> first_name;
//        $last_name = $request -> last_name;
//        $gender = $request -> gender;
//        $dob = $request -> dob;
//        $tel = $request -> tel;
//        $email = $request -> email;
//        $status = '1';
//        $register_date = $request = date('Y-m-d');
//        $success = DB::table('tbl_user')->insert([
//            'branch_id' => $branch_id,
//            'position_id' => $position_id,
//            'department_id' => $department_id,
//            'username' => $username,
//            'user_password' => $user_password,
//            'first_name' => $first_name,
//            'last_name' => $last_name,
//            'gender' => $gender,
//            'dob' => $dob,
//            'tel' => $tel,
//            'status' => $status,
//            'register_date' => $register_date,
//            'email' => $email
//
//        ]);
//        if($success){
//            return redirect('login');
//        }
//
    }

    public function update(Request $request,$id){
        $update = User::where('user_id',$id)->first();
        echo (Hash::make($request-> old . '              '));
        echo ($update->user_password. '             ');
        if(bcrypt($request-> old) == $update->user_password){
//            $update-> user_password =bcrypt($request->user_password);
//            $update->save();
//            $request->session()->flash('message','Password has been changed Successfully');
//            return redirect()->back();
            echo 'True';
        }
        else{
//            $request->session()->flash('message','Current password is incorrect');
//            return redirect()->back();
            echo ('False');
        }
    }
}
