<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 5/6/2020
 * Time: 11:06 AM
 */

namespace App\Http\Controllers;
use App\branch;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories= Category::with('branchs')->get();
        $branchs = branch::get();
        return view('block.category.cat-index',['categories'=>$categories,'branchs'=>$branchs]);
    }

    public function create()
    {
        $branchs = branch::get();
        return view('block.category.cat-create',['branchs'=>$branchs]);
    }

    public function store(Request $request)
    {
        $branch_id  =   $request->branch_id;
        $cat_id     =   $request->cat_id;
        $cat_name_kh=   $request->cat_name_kh;
        $cat_name_eng=  $request->cat_name_eng;
        $cat_desc   =   $request->cat_desc;
        $cat_type   =   $request->cat_type;
        $cat_stat   =   $request->cat_stat;
        $user_create=   'ADMIN';
        $date_create=   date('Y-m-d H:i:s');
        $success    =   DB::table('tbl_category')->insert([
            'branch_id' =>  $branch_id,
            'cat_id'    =>  $cat_id,
            'cat_name_kh' =>  $cat_name_kh,
            'cat_name_eng' =>  $cat_name_eng,
            'cat_desc'   =>  $cat_desc,
            'cat_type' =>  $cat_type,
            'cat_stat'  =>  $cat_stat,
            'user_create' => $user_create,
            'date_create' => $date_create
        ]);
        if($success){
            return redirect('category');
        }
        return back();
    }

    public function show($id)
    {
        $categories=Category::where('cat_id', $id)->first();
        return view('block.category.cat-show',['categories'=>$categories]);
    }

    public function edit($id)
    {
        $branchs = Category::get();
        $categories=Category::where('cat_id', $id)->first();
        return view('block.category.cat-create',['categories'=>$categories ,'branchs'=>$branchs]);
    }

    public function update(Request $request, $id){
        $branch_id  =   $request->branch_id;
        $cat_name_kh=   $request->cat_name_kh;
        $cat_name_eng=  $request->cat_name_eng;
        $cat_desc   =   $request->cat_desc;
        $cat_type   =   $request->cat_type;
        $cat_stat   =   $request->cat_stat;
        $user_create=   'ADMIN';
        $date_create=   date('Y-m-d H:i:s');
        $rows=DB::table('tbl_category')->where('cat_id',$id)->update([

            'branch_id' =>  $branch_id,
            'cat_name_kh' =>  $cat_name_kh,
            'cat_name_eng' =>  $cat_name_eng,
            'cat_desc'   =>  $cat_desc,
            'cat_type' =>  $cat_type,
            'cat_stat'  =>  $cat_stat,
            'user_create' => $user_create,
            'date_create' => $date_create
        ]);
        if($rows>0)
            return redirect('category');
        else
            return back();
    }

    public function destroy($id)
    {
        if(Category::where('cat_id', $id)->delete($id)){
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
