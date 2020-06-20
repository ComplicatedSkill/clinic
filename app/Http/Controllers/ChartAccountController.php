<?php

namespace App\Http\Controllers;

use App\AccountType;
use App\branch;
use App\ChartAccount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChartAccountController extends Controller
{
    public function index(){
        $branchs = branch::get();
        $accountTypes = AccountType::get();
        $chartAccount = ChartAccount::with('branchs','accountTypes')->get();
        return view('block.Chart-Account.chart-account-view')->withbranchs($branchs)->withchartaccounts($chartAccount)->withaccountType($accountTypes);
    }

    public function edit($id){
        $branchs = branch::get();
        $accountTypes = AccountType::get();
        $chartAccount = ChartAccount::where('chart_account_id',$id)->first();
        return view('block.Chart-Account.chart-account-edit',['chartAccount'=>$chartAccount])->withbranchs($branchs)->withaccountType($accountTypes);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name_kh' => 'required ',
             'name_eng' => 'required ',
            'account_type_id' => 'required'
        ]);
        $chartAccount = ChartAccount::where('chart_account_id',$id)->first();
        $chartAccount->branch_id = $request->branch_id;
        $chartAccount->chart_account_name_kh = $request->name_kh;
        $chartAccount->chart_account_name_eng = $request->name_eng;
        $chartAccount->account_type_id = $request->account_type_id;
        $chartAccount->description = $request->description;
        $chartAccount->user_update = 'Admin';
        $chartAccount->date_update = date('Y-m-d');
        $chartAccount->Save();
        $request->session()->flash('message','Update Successfully');
        return redirect()->back();
    }

    public function store(Request $request){
        $request->validate([
            'name_kh' => 'required ',
            'name_eng' => 'required ',
            'account_type_id' => 'required'
        ]);
        $chartAccount = new ChartAccount();
        $chartAccount->branch_id = $request->branch_id;
        $chartAccount->chart_account_name_kh = $request->name_kh;
        $chartAccount->chart_account_name_eng = $request->name_eng;
        $chartAccount->account_type_id = $request->account_type_id;
        $chartAccount->description = $request->description;
        $chartAccount->user_create = 'Admin';
        $chartAccount->date_create = date('Y-m-d');
        $chartAccount->Save();
        $request->session()->flash('message','Insert Successfully');
        return redirect()->back();

    }

    public function destroy($id){
        if (ChartAccount::where('chart_account_id', $id)->delete($id)) {
            return response()->json([
                'status' => 200,
                'message' => 'Record deleted successfully!'
            ]);
        } else {
            return response()->json([
                'status' => 201,
                'message' => 'Record deleted failed!'
            ]);
        }
    }
}
