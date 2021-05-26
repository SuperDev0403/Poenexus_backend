<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Userinfo;
use App\Models\Sell;
use App\Models\Bench;
use App\Models\Harvest;
use App\Models\Syndicate;

class UserinfoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateUserInfo(Request $request)
    {
        $user = Userinfo::where('id', $request->get('id'))
                        ->update([
                            'accountName' => $request->get('accountName'),
                            'email' => $request->get('email'),
                            'irlName' => $request->get('irlName'),
                            'discordId' => $request->get('discordId'),
                            'tradePoint' => $request->get('tradePoint'),
                            'ign1' => $request->get('ign1'),
                            'ign2' => $request->get('ign2'),
                            'ign3' => $request->get('ign3'),
                        ]);
    
        return response()->json(compact('user'),200);
    }

    /**
     * get user info.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getUserInfo(Request $request)
    {

        $user = Userinfo::where('id', $request->get('id'))->first();
        $sellList = Sell::where('userId', $request->get('id'))->get();
        for ($i = 0; $i < count($sellList); $i++) {
            $type = $sellList[$i]->type;
            switch ($type) {
                case "syndicate":
                    $craft = Syndicate::where('UID', $sellList[$i]->objid)->first();
                    $sellList[$i]->craft = $craft;
                  break;
                case "bench":
                    $craft = Bench::where('UID', $sellList[$i]->objid)->first();
                    $sellList[$i]->craft = $craft;
                  break;
                case "harvest":
                    $craft = Harvest::where('UID', $sellList[$i]->objid)->first();
                    $sellList[$i]->craft = $craft;
                  break;
                default:
            }
        }
        return response()->json(compact('user', 'sellList'),200);
    }
}