<?php

namespace App\Http\Controllers;
use App\Models\Userinfo;
use Illuminate\Http\Request;

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
        return response()->json(compact('user'),200);
    }
}