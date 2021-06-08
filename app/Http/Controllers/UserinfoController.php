<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Userinfo;
use App\Models\Sell;
use App\Models\Bench;
use App\Models\Harvest;
use App\Models\Syndicate;
use App\Models\Transaction;
use App\Models\Ratings;

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
        $buyList = Transaction::where('sellerId', $request->get('id'))->get();
        for ($i = 0; $i < count($buyList); $i++) {
            $sellObjId = $buyList[$i]->sellObjId;
            $buyList[$i]->sellInfo = Sell::where('id', $sellObjId)->first();
            switch ($buyList[$i]->sellInfo->type) {
                case "syndicate":
                    $craft = Syndicate::where('UID', $buyList[$i]->sellInfo->objid)->first();
                    $buyList[$i]->craft = $craft;
                  break;
                case "bench":
                    $craft = Bench::where('UID', $buyList[$i]->sellInfo->objid)->first();
                    $buyList[$i]->craft = $craft;
                  break;
                case "harvest":
                    $craft = Harvest::where('UID', $buyList[$i]->sellInfo->objid)->first();
                    $buyList[$i]->craft = $craft;
                  break;
                default:
            }
            $buyerId = $buyList[$i]->buyerId;
            $buyList[$i]->buyerRating = Ratings::where('buyerId', $buyerId)->get();
        }

        $rating = Ratings::where('sellerId', $request->get('id'))->get();
        return response()->json(compact('user', 'sellList', 'buyList', 'rating'),200);
    }

    /**
     * accept Object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function acceptObj(Request $request)
    {
      $query = Sell::where('id', $request->get('sellId'))
            ->update(['available' => false]);

      $query1 = Transaction::where('id', $request->get('txId'))
            ->update([
              'completed' => true,
              'compTS' => date('Y-m-d H:i:s')
            ]);
      $query2 = Ratings::create([
              'txId' => $request->get('txId'),
              'sellerId' => $request->get('sellId'),
              'buyerId' => $request->get('buyerId'),
              'rating' => $request->get('rating')
          ]);

      if ($query && $query1 && $query2) {
          return response()->json([
              'status' => "success",
          ]);
      } else {
          return response()->json([
              'status' => "error",
          ]);
      }
    }
}