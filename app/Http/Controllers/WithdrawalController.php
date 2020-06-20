<?php

namespace App\Http\Controllers;

use App\branch;
use App\ChartAccount;
use App\ExchangeRate;
use App\Http\Controllers\Controller;
use App\Withdrawal;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function index(){
        $branchs = branch::get();
        $chartAccount = ChartAccount::where('account_type_id','4')->get();
        $exchangeRate = ExchangeRate::where('branch_id','1')->get();
        $cashWithdrawal = Withdrawal::with('branchs','chartAccounts')->get();
        return view('block.Cash-Withdrawal.Cash-Withdrawal-view')->withbranchs($branchs)->withchartaccounts($chartAccount)->withcashWithdrawals($cashWithdrawal)->withexchangeRates($exchangeRate);
    }

    public function edit($id){
        $branchs= branch::get();
        $chartAccount = ChartAccount::where('account_type_id','4')->get();
        $cashWithdrawal = Withdrawal::where('cash_withdrawal_id',$id)->first();
        return view('block.Cash-Withdrawal.Cash-Withdrawal-edit',['cashWithdrawals'=>$cashWithdrawal])->withbranchs($branchs)->withchartAccounts($chartAccount);
    }

    public function update(Request $request, $id){
        $request->validate([
            'branch_id'=>'required',
            'date' => 'required ',
            'chart_account_id'=>'required',
            'currency' => 'required ',
            'amount' => 'required|numeric',
        ]);
        $cashWithdrawal = Withdrawal::where('cash_withdrawal_id',$id)->first();
        $cashWithdrawal->branch_id = $request->branch_id;
        $cashWithdrawal->chart_account_id = $request->chart_account_id;
        $cashWithdrawal->amount = $request->amount;
        $cashWithdrawal->currency = $request->currency;
        $cashWithdrawal->date = $request->date;
        $cashWithdrawal->description = $request->description;
        $cashWithdrawal->user_update = 'Admin';
        $cashWithdrawal->date_update = date('Y-m-d');
        $cashWithdrawal->Save();
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
        $cashWithdrawal = new Withdrawal();
        $cashWithdrawal->branch_id = $request->branch_id;
        $cashWithdrawal->chart_account_id = $request->chart_account_id;
        $cashWithdrawal->amount = $request->amount;
        $cashWithdrawal->currency = $request->currency;
        $cashWithdrawal->date = $request->date;
        $cashWithdrawal->exchange_rate =   $request->exchange;
        $cashWithdrawal->description = $request->description;
        $cashWithdrawal->user_update = 'Admin';
        $cashWithdrawal->date_update = date('Y-m-d');
        $cashWithdrawal->Save();
        $request->session()->flash('message','Insert Successfully');
        return redirect()->back();

    }

    public function destroy($id){
        if (Withdrawal::where('cash_withdrawal_id', $id)->delete($id)) {
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
