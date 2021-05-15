<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Bench;
use App\Models\Harvest;
use App\Models\Syndicate;
use App\Models\Userinfo;

class SellController extends Controller
{
    /**
     * Get Sell Data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getSellData(Request $request)
    {
        $bench = Bench::all();
        $harvest = Harvest::all();
        $syndicate = Syndicate::all();
        $userinfo = Userinfo::where('id', $request->get('userId'))->first();
    
        return response()->json(compact('bench', 'harvest', 'syndicate', 'userinfo'),200);
    }
}