<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function edit($id){
        $premissions = Permission::with('User')->where('user_id',$id)->pluck('sub_permission')->toArray();
        echo('');
        return view('block.permission.permission')->withpermissions($premissions);
    }
}
