<?php

namespace App\Http\Controllers;

use App\branch;
use App\ChartAccount;
use App\ExchangeRate;
use App\Expense;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(){
        $branchs = branch::get();
        $chartAccount = ChartAccount::where('account_type_id','2')->get();
        $exchangeRate = ExchangeRate::where('branch_id','1')->get();
        $expense = Expense::with('branchs','chartAccounts')->get();
        return view('block.Expense.Expense-view')->withbranchs($branchs)->withchartaccounts($chartAccount)->withexpenses($expense)->withexchangeRates($exchangeRate);
    }

    public function edit($id){
        $branchs= branch::get();
        $chartAccount = ChartAccount::where('account_type_id','2')->get();
        $expense = Expense::where('operating_expense_id',$id)->first();
        return view('block.Expense.Expense-edit',['expenses'=>$expense])->withbranchs($branchs)->withchartAccounts($chartAccount);
    }

    public function update(Request $request, $id){
        $request->validate([
            'branch_id'=>'required',
            'date' => 'required ',
            'chart_account_id'=>'required',
            'currency' => 'required ',
            'amount' => 'required|numeric',
        ]);
        $expense = Expense::where('operating_expense_id',$id)->first();
        $expense->branch_id = $request->branch_id;
        $expense->chart_account_id = $request->chart_account_id;
        $expense->amount = $request->amount;
        $expense->currency = $request->currency;
        $expense->date = $request->date;
        $expense->description = $request->description;
        $expense->user_update = 'Admin';
        $expense->date_update = date('Y-m-d');
        $expense->Save();
        $request->session()->flash('message','Update Successfully');
        return redirect()->back();
    }

    public function store(Request $request){
        $request->validate([
            'branch_id'=>'required',
            'date' => 'required ',
            'currency' => 'required ',
            'chart_account_id'=>'required',
            'amount' => 'required|numeric',
            'exchange'=> 'required|numeric'
        ]);
        $expense = new Expense();
        $expense->branch_id = $request->branch_id;
        $expense->chart_account_id = $request->chart_account_id;
        $expense->amount = $request->amount;
        $expense->currency = $request->currency;
        $expense->date = $request->date;
        $expense->exchange_rate =   $request->exchange;
        $expense->description = $request->description;
        $expense->user_update = 'Admin';
        $expense->date_update = date('Y-m-d');
        $expense->Save();
        $request->session()->flash('message','Insert Successfully');
        return redirect()->back();

    }

    public function destroy($id){
        if (Expense::where('operating_expense_id', $id)->delete($id)) {
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
