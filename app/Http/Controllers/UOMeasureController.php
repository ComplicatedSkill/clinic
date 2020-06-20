<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 5/7/2020
 * Time: 8:23 AM
 */

namespace App\Http\Controllers;

use App\UOM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UOMeasureController extends Controller
{
    public function index()
    {
        $Measures= UOM::get();
        return view('block.uom.uom-index',['measures'=>$Measures]);
    }

    public function create()
    {
        return view('block.uom.uom-create');
    }
    public function store(Request $request){
        $uom_code   =   $request    ->  uom_code;
        $uom_name   =   $request    ->  uom_name;
        $uom_fix    =   $request    ->  uom_fix;
        $uom_stat   =   $request    ->  uom_stat;
        $uom_des1   =   $request    ->  uom_des1;
        $uom_des2   =   $request    ->  uom_des2;
        $user_create=   'ADMIN';
        $date_create=   date('Y-m-d H:i:s');
        $success    =   DB::table('tbl_uom')->insert([
            'uom_code'  =>  $uom_code,
            'uom_name'  =>  $uom_name,
            'uom_fix'   =>  $uom_fix,
            'uom_stat'  =>  $uom_stat,
            'description'  =>  $uom_des1,
            'user_create'   => $user_create,
            'date_create'   => $date_create
        ]);
        if($success){
            return redirect('uom');
        }
        return back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $branchs = DB::table('tbl_branch')->get();
        $measures=DB::table('tbl_uom')->where('uom_id', $id)->first();
        return view('block.uom.uom-create',['measures'=>$measures ,'branchs'=>$branchs]);
    }

    public function update(Request $request, $id)
    {
        $uom_code   =   $request    ->  uom_code;
        $uom_name   =   $request    ->  uom_name;
        $uom_fix    =   $request    ->  uom_fix;
        $uom_stat   =   $request    ->  uom_stat;
        $uom_des1   =   $request    ->  uom_des1;
        $uom_des2   =   $request    ->  uom_des2;
        $user_update=   'ADMIN';
        $date_update=   date('Y-m-d H:i:s');
        $rows    =  DB::table('tbl_uom')->where('uom_id',$id)->update([
            'uom_code'  =>  $uom_code,
            'uom_name'  =>  $uom_name,
            'uom_fix'   =>  $uom_fix,
            'uom_stat'  =>  $uom_stat,
            'description'  =>  $uom_des1,
            'user_update'   => $user_update,
            'date_update'   => $date_update
        ]);
        if($rows)
            return redirect('uom');
        else
            return back();
    }

    public function destroy($id)
    {
        if(UOM::where('uom_id', $id)->delete($id)){
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
}
