<?php

namespace App\Http\Controllers;

use App\branch;
use App\department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index(){
        $branchs = branch::get();
        return view('block.branch.view')->withbranchs($branchs);
    }

    public function create(){
        $branchs = branch::get();
        return view('block.branch.edit_user')->withbranchs($branchs);
    }

    public function store(Request $request){
        $request->validate([
            'branch_name' => 'required',
            'address' => 'required',
            'tel' => 'required',
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
        $branch = new branch();
        $branch->branch_name = $request->branch_name;
        $branch-> address = $request->address;
        $branch->tel = $request->tel;
        $branch->wifi_password = $request->wifi_password;
        $branch->logo = $profile;
        $branch->status = '1';
        $branch->Save();
        $request->session()->flash('message','Insert Successfully');
        return redirect()->back();
    }

    public function destroy($id){
        if(branch::where('branch_id', $id)->delete($id)){
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
        $branchs = branch::where('branch_id',$id)->first();
        return view('block.branch.edit_branch',['branch'=>$branchs]);
    }

    public function update(Request $request, $id){
        $request->validate([
            'branch_name' => 'required',
            'address' => 'required',
            'tel' => 'required',
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
        $branch = branch::where('branch_id',$id)->first();
        $branch->branch_name = $request->branch_name;
        $branch-> address = $request->address;
        $branch->tel = $request->tel;
        $branch->wifi_password = $request->wifi_password;
        $branch->logo = $profile;
        $branch->status = $status;
        $branch->Save();
        $request->session()->flash('message','Update Successfully');
        return redirect()->back();
    }
}
