<?php

namespace App\Http\Controllers;

use App\branch;
use App\CashDeposit;
use App\ChartAccount;
use App\ExchangeRate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CashDepositController extends Controller
{
    public function index(){
        $branchs = branch::get();
        $chartAccount = ChartAccount::where('account_type_id','3')->get();
        $exchangeRate = ExchangeRate::where('branch_id','1')->get();
        $cashDeposit = CashDeposit::with('branchs','chartAccounts')->get();
        return view('block.Cash-Deposit.Cash-Deposit-view')->withbranchs($branchs)->withchartaccounts($chartAccount)->withcashDeposits($cashDeposit)->withexchangeRates($exchangeRate);
    }

    public function edit($id){
        $branchs= branch::get();
        $chartAccount = ChartAccount::where('account_type_id','3')->get();
        $cashDeposit = CashDeposit::where('cash_deposit_id',$id)->first();
        return view('block.Cash-Deposit.Cash-Deposit-edit',['cashDeposits'=>$cashDeposit])->withbranchs($branchs)->withchartAccounts($chartAccount);
    }

    public function update(Request $request, $id){
        $request->validate([
            'branch_id'=>'required',
            'date' => 'required ',
            'chart_account_id'=>'required',
            'currency' => 'required ',
            'amount' => 'required|numeric',
        ]);
        $cashDeposit = CashDeposit::where('cash_deposit_id',$id)->first();
        $cashDeposit->branch_id = $request->branch_id;
        $cashDeposit->chart_account_id = $request->chart_account_id;
        $cashDeposit->amount = $request->amount;
        $cashDeposit->currency = $request->currency;
        $cashDeposit->date = $request->date;
        $cashDeposit->description = $request->description;
        $cashDeposit->user_update = 'Admin';
        $cashDeposit->date_update = date('Y-m-d');
        $cashDeposit->Save();
        $request->session()->flash('message','Update Successfully');
        return redirect()->back();
    }

    public function store(Request $request){
        $request->validate([
            'branch_id'=>'required',
            'chart_account_id'=>'required',
            'date' => 'required ',
            'currency' => 'required ',
            'amount' => 'required|numeric',
            'exchange'=> 'required|numeric'
        ]);
        $cashDeposit = new CashDeposit();
        $cashDeposit->branch_id = $request->branch_id;
        $cashDeposit->chart_account_id = $request->chart_account_id;
        $cashDeposit->amount = $request->amount;
        $cashDeposit->currency = $request->currency;
        $cashDeposit->date = $request->date;
        $cashDeposit->exchange_rate =   $request->exchange;
        $cashDeposit->description = $request->description;
        $cashDeposit->user_update = 'Admin';
        $cashDeposit->date_update = date('Y-m-d');
        $cashDeposit->Save();
        $request->session()->flash('message','Insert Successfully');
        return redirect()->back();

    }

    public function destroy($id){
        if (CashDeposit::where('cash_deposit_id', $id)->delete($id)) {
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
