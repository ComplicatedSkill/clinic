<?php

namespace App\Http\Controllers;

use App\branch;
use App\ChartAccount;
use App\ExchangeRate;
use App\Http\Controllers\Controller;
use App\OtherIncome;
use Illuminate\Http\Request;

class OtherIncomeController extends Controller
{
    public function index(){
        $branchs = branch::get();
        $chartAccount = ChartAccount::where('account_type_id','1')->get();
        $exchangeRate = ExchangeRate::where('branch_id','1')->get();
        $otherIncome = OtherIncome::with('branchs','chartAccounts')->get();
        return view('block.Other-Income.other-income-view')->withbranchs($branchs)->withchartaccounts($chartAccount)->withontherIncomes($otherIncome)->withexchangeRates($exchangeRate);
    }

    public function edit($id){
        $branchs= branch::get();
        $chartAccount = ChartAccount::where('account_type_id','1')->get();
        $otherIncome = OtherIncome::where('other_income_id',$id)->first();
        return view('block.Other-Income.other-income-edit',['otherIncomes'=>$otherIncome])->withbranchs($branchs)->withchartAccounts($chartAccount);
    }

    public function update(Request $request, $id){
        $request->validate([
            'branch_id'=>'required',
            'date' => 'required ',
            'currency' => 'required ',
            'amount' => 'required|numeric',
        ]);
        $otherIncome = OtherIncome::where('other_income_id',$id)->first();
        $otherIncome->branch_id = $request->branch_id;
        $otherIncome->chart_account_id = $request->chart_account_id;
        $otherIncome->amount = $request->amount;
        $otherIncome->currency = $request->currency;
        $otherIncome->date = $request->date;
        $otherIncome->description = $request->description;
        $otherIncome->user_update = 'Admin';
        $otherIncome->date_update = date('Y-m-d');
        $otherIncome->Save();
        $request->session()->flash('message','Update Successfully');
        return redirect()->back();
    }

    public function store(Request $request){
        $request->validate([
            'branch_id'=>'required',
            'date' => 'required ',
            'currency' => 'required ',
            'amount' => 'required|numeric',
            'exchange'=> 'required|numeric'
        ]);
        $otherIncome = new OtherIncome();
        $otherIncome->branch_id = $request->branch_id;
        $otherIncome->chart_account_id = $request->chart_account_id;
        $otherIncome->amount = $request->amount;
        $otherIncome->currency = $request->currency;
        $otherIncome->date = $request->date;
        $otherIncome->exchange_rate =   $request->exchange;
        $otherIncome->description = $request->description;
        $otherIncome->user_update = 'Admin';
        $otherIncome->date_update = date('Y-m-d');
        $otherIncome->Save();
        $request->session()->flash('message','Insert Successfully');
        return redirect()->back();
    }

    public function destroy($id){
        if (OtherIncome::where('other_income_id', $id)->delete($id)) {
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
