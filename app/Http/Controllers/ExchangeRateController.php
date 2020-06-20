<?php

namespace App\Http\Controllers;

use App\branch;
use App\ExchangeRate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExchangeRateController extends Controller
{
    public function index(){
        $branchs = branch::get();
        $exchangeRate = ExchangeRate::with('branchs')->get();
        return view('block.Exchange_Rate.exchange-rate')->withbranchs($branchs)->withexchangeRate($exchangeRate);
    }

    public function edit($id){

        $branchs = branch::get();
        $exchangeRate = ExchangeRate::where('exchange_rate_id',$id)->first();
        return view('block.Exchange_Rate.ex-edit',['exchangeRate'=>$exchangeRate])->withbranchs($branchs);
    }

    public function update(Request $request, $id){
        $request->validate([
            'ask_amount' => 'required|numeric',
        ]);
        $exchangeRate = ExchangeRate::where('exchange_rate_id',$id)->first();
        $exchangeRate->branch_id = $request->branch_id;
        $exchangeRate->ask = $request->amount;
        $exchangeRate-> description = $request->description;
        $exchangeRate->user_update = 'Admin';
        $exchangeRate->date_update = date('Y-m-d');
        $exchangeRate->Save();
        $request->session()->flash('message','Update Successfully');
        return redirect()->back();
    }

    public function store(Request $request){
        $request->validate([
            'ask_amount' => 'required|numeric',
            'bid_amount' => 'required|numeric '
        ]);
        $exchangeRate = new ExchangeRate();
        $exchangeRate->branch_id = $request->branch_id;
        $exchangeRate->ask = $request->amount;
        $exchangeRate-> description = $request->description;
        $exchangeRate->user_update = 'Admin';
        $exchangeRate->date_update = date('Y-m-d');
        $exchangeRate->Save();
        $request->session()->flash('message','Insert Successfully');
        return redirect()->back();

    }

    public function destroy($id){
        if (ExchangeRate::where('exchange_rate_id', $id)->delete($id)) {
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
