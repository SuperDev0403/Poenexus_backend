<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Bench;
use App\Models\Harvest;
use App\Models\Syndicate;
use App\Models\Userinfo;
use App\Models\Sell;
use App\Models\Transaction;

class BuyController extends Controller
{
    /**
     * Get Buy Data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getBuyData(Request $request)
    {
        $sell = Sell::all();
        $bench = Bench::all();
        $harvest = Harvest::all();
        $syndicate = Syndicate::all();
        $userinfo = Userinfo::where('id', $request->get('userId'))->first();
    
        return response()->json(compact('bench', 'harvest', 'syndicate', 'userinfo', 'sell'),200);
    }
    
    /**
     * Get Price Chaos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getPriceChaos()
    {
        $response = Http::get('https://poe.ninja/api/data/CurrencyOverview?league=Ultimatum&type=Currency&language=en');
    
        return $response;
    }
    
    /**
     * Save data in transaction
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveTransaction(Request $request)
    {
        $transaction = Transaction::create([
            'reqTS' => date('Y-m-d H:i:s'),
            'sellObjId' => $request->get('sellObjId'),
            'sellUid' => $request->get('sellUid'),
            'sellerId' => $request->get('sellerId'),
            'sellIgn' => $request->get('sellIgn'),
            'buyerId' => $request->get('buyerId'),
            'buyIgn' => $request->get('buyIgn'),
            'converted' => $request->get('converted'),
            'notified' => null,
            'noteTS' => null,
            'completed' => null,
            'compTS' => null,
            'buyHasReq' => true,
            'buyHasReqTS' => date('Y-m-d H:i:s'),
        ]);
    
        return response()->json(compact('transaction'),200);
    }
}