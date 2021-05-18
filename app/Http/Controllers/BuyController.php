<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Bench;
use App\Models\Harvest;
use App\Models\Syndicate;
use App\Models\Userinfo;
use App\Models\Sell;

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
        // return "hi";
        $response = Http::get('https://poe.ninja/api/data/CurrencyOverview?league=Ultimatum&type=Currency&language=en');
    
        return $response;
    }
}