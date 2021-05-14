<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Bench;
use App\Models\Harvest;
use App\Models\Syndicate;

class SellController extends Controller
{
    /**
     * Get Sell Data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getSellData()
    {
        $bench = Bench::all();
        $harvest = Harvest::all();
        $syndicate = Syndicate::all();
    
        return response()->json(compact('bench', 'harvest', 'syndicate'),200);
    }
}