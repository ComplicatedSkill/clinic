<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 5/8/2020
 * Time: 2:57 PM
 */

namespace App\Http\Controllers;
use App\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PositionController extends Controller
{

    public function index(){
        $positions = Position::get();
        return view('block.position.position-index', ['positions' => $positions]);
    }

    public function create()
    {
        return view('block.position.position-create');
    }

    public function store(Request $request)
    {
        $posit_desc =$request->posit_desc;
        $posit_status=$request->posit_status;
        $user_create = 'ADMIN';
        $date_create = date('Y-m-d H:i:s');
        $success = DB::table('tbl_position')->insert([
            'description'  => $posit_desc,
            'posit_status'=> $posit_status,
            'user_create' => $user_create,
            'date_create' => $date_create
        ]);
        if($success){
            return redirect('position');
        }
        return back();
    }

    public function show(Position $positions)
    {
        //
    }

    public function edit($id)
    {
        $positions = DB::table('tbl_position')->where('position_id', $id)->first();
        return view('block.position.position-create',['positions' => $positions]);
    }

    public function update(Request $request, $id){
        $posit_type =$request->posit_type;
        $posit_desc =$request->posit_desc;
        $posit_status=$request->posit_status;
        $user_update = 'ADMIN';
        $date_update = date('Y-m-d H:i:s');
        $rows = DB::table('tbl_position')->where('position_id',$id)->update([
            'description'  => $posit_desc,
            'posit_status'=> $posit_status,
            'user_update' => $user_update,
            'date_update' => $date_update
        ]);
        if($rows>0)
            return redirect('position');
        else
            return back();
    }


    public function destroy($id)
    {
        if(Position::where('position_id', $id)->delete($id)){
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
