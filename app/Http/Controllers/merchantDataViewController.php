<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MerchantData;
use App\MerchantOfferings;
use Illuminate\Support\Facades\Validator;
use Carbon\carbon;

class merchantDataViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $merchantData=MerchantData::all();
        
        return view('merchantView.index', compact('merchantData', $merchantData));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('merchantView.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes=$request->validate([
            'merchant_name' => 'required|string|max:255',
            'merchant_image' => 'required|image|mimes:png|max:50',
            'point_type' => 'required|string',
            'description' => 'required|string|max:255',
            'loyalty_text' => 'required|string|max:255',
            'loyalty_icon' => 'required|image|mimes:png|max:50',
            'food_type' => 'required|string|max:255',
            'min_points_to_redeem' => 'required|integer',
        ]);
        $attributes['merchant_image'] = $this->storeImage($attributes['merchant_image'], "logo");
        $attributes['loyalty_icon'] = $this->storeImage($attributes['loyalty_icon'], "icons");
        $attributes['merchant_code']=$this->generateMerchantCode($attributes['merchant_name'], $attributes['point_type']);
        
        MerchantData::create($attributes);

        $attributes_for_offer_redeem=$request->validate([
            'offerings_for_redeem' => 'required|array',
            'min_points_to_redeem_offer' => 'required|array'
        ]);
        
        $this->createMerchantOfferings($attributes_for_offer_redeem, $attributes['merchant_code']);
        
        return redirect('/merchantData');
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
        $merchantData=MerchantData::findOrFail($id);
        $merchantOffers=MerchantOfferings::where('merchant_code', $merchantData['merchant_code'])->get();
        
        return view('merchantView.edit', compact(['merchantData','merchantOffers']));
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
        $merchantData = MerchantData::findOrFail($id);
        
        $merchantCode = $merchantData->merchant_code;

        $attributes=$request->validate([
            'merchant_name' => 'required|string|max:255',
            'merchant_image' => 'nullable|image|mimes:png',
            'point_type' => 'required|string',
            'description' => 'required|string|max:255',
            'loyalty_text' => 'required|string|max:255',
            'loyalty_icon' => 'nullable|image|mimes:png',
            'food_type' => 'required|string|max:255',
            'min_points_to_redeem' => 'required|integer',
        ]);
        
        $merchantData->update($attributes);

        $attributes_for_offer_redeem=$request->validate([
            'offerings_for_redeem' => 'required|array',
            'min_points_to_redeem_offer' => 'required|array'
        ]);
        // dd($attributes_for_offer_redeem);
        $merchantOfferings = MerchantOfferings::where('merchant_code', $merchantCode)->delete();

        $this->createMerchantOfferings($attributes_for_offer_redeem, $merchantCode);
        
        return redirect('/merchantData');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($data, Request $request)
    {
        if(MerchantOfferings::where('merchant_code', $request->all()['merchant_code'])->where('offerings_for_redeem', $request->all()['offerings_for_redeem'])->delete()){
            return response('Success', 200);
        }else{
            return response('Something went wrong', 406);
        }
    }

    private function storeImage($image, $type){
        $image_path= "images/" . $type . "/";
        $image->storeAs($image_path, $image->getClientOriginalName(), 'public');

        return $image_path . $image->getClientOriginalName();
    }

    private function generateMerchantCode($name, $type){
        $merchant_code = [
            'merchant_code' => md5($name . "_" . $type)
        ];
        
        $rules = ['merchant_code' => 'unique:merchant_data,merchant_code'];

        $validate = Validator::make($merchant_code, $rules)->passes();
        
        return $validate ? $merchant_code['merchant_code'] : MerchantData::where('merchant_name', $name)->where('point_type', $type)->pluck('merchant_code')[0];
    }

    private function createMerchantOfferings($attributes_for_offer_redeem, $merchant_code){
        $total_offers=sizeof( $attributes_for_offer_redeem['offerings_for_redeem']);
        
        for($i=0; $i<$total_offers; $i++){
            if($attributes_for_offer_redeem['offerings_for_redeem'][$i]){
                $merchantOfferings[$i]['offerings_for_redeem']=$attributes_for_offer_redeem['offerings_for_redeem'][$i];
                $merchantOfferings[$i]['min_points_to_redeem_offer']=$attributes_for_offer_redeem['min_points_to_redeem_offer'][$i];
                $merchantOfferings[$i]['merchant_code']=$merchant_code;
                $merchantOfferings[$i]['updated_at']=Carbon::now();
            }
        }
        
        return MerchantOfferings::insert($merchantOfferings) ? true : false;
    }
}
