<?php

namespace App\Http\Controllers;

use App\branch;
use App\department;
use App\Http\Controllers\Controller;
use App\position;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function show(){}


    public function update(Request $request,$id){
        $request->validate([
            'current_password' => 'required',
        ]);
        $update = User::where('user_id',$id)->first();
        $old_password = $request->input('current_password');
        $password = $request->get('new_password'); // password is form field
        $hashed = Hash::make($password);
        if($update){
            $request->validate([
                'new_password' => 'required',
            ]);
            if (Hash::check($old_password, $update->user_password)) {
            $update = User::where('user_id', $id)->first();
            $update-> user_password = $hashed;
            $update->update();
                $request->session()->flash('message','Your password has been changed');
                return redirect()->back();
            }
            else{
                $request->session()->flash('message','Current password is incorrect');
                return redirect()->back();
            }
        }
    }
}
