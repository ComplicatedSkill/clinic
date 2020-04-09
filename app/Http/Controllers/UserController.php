<?php

namespace App\Http\Controllers;

use App\branch;
use App\department;
use App\position;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){
        $branchs  = branch::get();
        $positions = position::get();
        $users = User::with('departments','positions')->get();
        return view('block.usesr.view')->withbranchs($branchs)->withusers($users)->withpositions($positions);
    }
    public function create(){
        $departments = department::get();
        $positions = position::get();
        $branchs = branch::get();
        return view('block.usesr.edit_user')->withdepartments($departments)->withpositions($positions)->withbranchs($branchs);
    }

    public function store(Request $request){
        $request->validate([
            'username' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'tel' => 'required',
            'user_password' => 'required',
        ]);
        $profile="";
        if(isset($request->image)) {
            $error = array();
            $name = $request->file('image')->getClientOriginalName();
            $extension = $request->file('image')->extension();
            $extensions = array("jpeg", "jpg", "png");
            if (in_array($extension, $extensions) === false) {
                $error[] = "Extention not allow!";
            }
            $newName = time() . "profile." . $extension;
            if (empty($errors) == true) {
                $request->image->move(public_path('public/assert/image/'), $newName);
                $profile = "public/assert/image/" . $newName;
            }
        }
        if( $request->status == false) {
            $status = '0';
        } else {
            $status = '1';
        }
        $error = 'Insert Successfully';
        $user = new User();
        $user->branch_id = $request->branch_id;
        $user-> position_id = $request->position_id;
        $user-> department_id = $request->department_id;
        $user-> username = $request->username;
        $user-> first_name = $request->first_name;
        $user-> last_name = $request->last_name;
        $user-> gender = $request->gender;
        $user-> dob = $request->dob;
        $user-> tel = $request->tel;
        $user-> email = $request->email;
        $user-> description = $request-> description;
        $user-> photo = $profile;
        $user->status = $status;
        $user->user_password = $request -> user_password;
        $user->register_date = date('Y-m-d');
        $user->Save();
        $request->session()->flash('message',$error);
        return redirect()->back();
    }

    public function destroy($id){
        if(User::where('user_id', $id)->delete($id)){
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
        $departments = department::get();
        $positions = position::get();
        $branchs = branch::get();
        $user = User::with('departments','positions','branchs')->where('user_id',$id)->first();
        return view('block.usesr.edit_user',['users'=>$user])->withdepartments($departments)->withpositions($positions)->withbranchs($branchs);
    }

    public function update(Request $request, $id){
        $profile="";
        if(isset($request->image)) {
            $error = array();
            $name = $request->file('image')->getClientOriginalName();
            $extension = $request->file('image')->extension();

            $extensions = array("jpeg", "jpg", "png");

            if (in_array($extension, $extensions) === false) {
                $error[] = "Extention not allow!";
            }

            $newName = time() . "profile." . $extension;
            if (empty($errors) == true) {
                $request->image->move(public_path('public/assert/image/'), $newName);
                $profile = "public/assert/image/" . $newName;
            }
        }
        if( $request->status == false) {
            $status = '0';
        } else {
            $status = '1';
        }
        $error = 'Update Successfully';
        $update = User::where('user_id',$id)->first();
        $update-> position_id = $request->position_id;
        $update-> branch_id = $request->branch_id;
        $update-> department_id = $request->department_id;
        $update-> username = $request->username;
        $update-> first_name = $request->first_name;
        $update-> last_name = $request->last_name;
        $update-> gender = $request->gender;
        $update-> dob = $request->dob;
        $update-> tel = $request->tel;
        $update-> email = $request->email;
        $update-> description = $request-> description;
        $update-> photo = $profile;
        $update->status = $status;
        $update->save();
        $request->session()->flash('message',$error);
        return redirect()->back();
    }
}
