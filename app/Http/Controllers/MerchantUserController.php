<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User ;
use stdClass;
use App\MerchantUser;
use App\MerchantOffering;
use App\UserPoint;

class MerchantUserController extends Controller
{

    public function getUserData($userCode) {

        $user = User::where('user_code', $userCode)->first()->toArray();
        if ($user != NULL) {
            $userData = new stdClass;
            $userData->uid = $user['uid'];
            $userData->createdAt = $user['created_at'];
            return json_encode($userData);
        } else {
            return 0;
        }
    }


    public function getMerchantData($merchantUid) {

        $merchant = MerchantUser::where('merchant_uid', $merchantUid)
                ->leftJoin('merchant_data', 'merchant_users.merchant_data_id', '=', 'merchant_data.id')
                ->select('merchant_code', 'point_type')->first()->toArray();
        if ($merchant != NULL) {
            $merchantData = new stdClass;
            $merchantData->pointType = $merchant['point_type'];
            $merchantData->merchantCode = $merchant['merchant_code'];
        } else {
            $merchantData = 0;
        }
        $merchantOffering = MerchantOffering::where('merchant_code', $merchantData->merchantCode)->select('offerings')->get()->toArray();
        if ($merchantOffering != NULL) {
            $i=0;
            $offerList = new stdClass;
            foreach ($merchantOffering as $offers) {
                $offer = 'offerNum' . $i;
                $offerList->$offer = $offers['offerings'];
                $i++;
            }
            $merchantData->offers = $offerList;
        } else {
            $merchantData->offers = 0;
        }
        return json_encode($merchantData);
    }


    public function rewardToUser(Request $request)
    {
        try {
            $validated = $request->validate([
                'merchantUid' => 'required',
                'userUid' => 'required',
                'rewardAmount' => 'required',
            ]);
            $merchant = MerchantUser::where('merchant_uid', $validated['merchantUid'])
                    ->leftJoin('merchant_data', 'merchant_users.merchant_data_id', '=', 'merchant_data.id')
                    ->select('merchant_code', 'point_type')->first()->toArray();
            $userPoint = UserPoint::where([
                ['uid', $validated['userUid'] ],
                ['merchant_code', $merchant['merchant_code'] ]
                ])->first();
            $userPoint->current_points = (int)$userPoint['current_points'] + (int)$validated['rewardAmount'];
            $userPoint->save();
            return 1;
        } catch (Exception $e) {
            return $e;
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
