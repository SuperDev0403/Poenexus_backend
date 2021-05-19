<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Bench;
use App\Models\Harvest;
use App\Models\Syndicate;
use App\Models\Userinfo;
use App\Models\Sell;

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

    /**
     * save Sell Data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveSell(Request $request)
    {
        $sell = Sell::create([
            'userId' => $request->get('userId'),
            'mode' => $request->get('mode'),
            'type' => $request->get('type'),
            'ign' => $request->get('ign'),
            'security' => $request->get('security'),
            'collat' => $request->get('collat'),
            'objid' => $request->get('objid'),
            'price_c' => $request->get('price_c'),
            'price_ex' => $request->get('price_ex'),
            'timestamp' => date('Y-m-d H:i:s'),
            'available' => $request->get('available'),
        ]);

        return response()->json(compact('sell'),200);
    }
}