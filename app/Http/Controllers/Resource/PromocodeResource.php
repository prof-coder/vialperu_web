<?php

namespace App\Http\Controllers\Resource;

use App\Promocode;
use App\Zones;
use App\PromocodeUsage;
use App\Reward;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Setting;
use App\Referral;
class PromocodeResource extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promocodes = Promocode::orderBy('created_at' , 'desc')->get();
        return view('admin.promocode.index', compact('promocodes'));
    }
    
    public function getPromoCodes(){
        return Promocode::orderBy('created_at' , 'desc')->get();
    }
    
    public function userPromoCode(){
        $promocodes = Promocode::orderBy('created_at' , 'desc')->get();
        return view('admin.promocode.users', compact('promocodes'));
    }
    
    public function getPromocodeUser(Request $request){
        return PromocodeUsage::where('promocode_id', $request->promocode_id)->with('promocode','promouser')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $zones = Zones::orderBy('created_at' , 'desc')->get();
        return view('admin.promocode.create',compact('zones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'promo_code' => 'required|max:100|unique:promocodes',
            'discount' => 'required|numeric',
            'expiration' => 'required',
            'set_limit' => 'required',
            'number_of_time' => 'required',
            'user_type' => 'required|not_in:-- Choose User Type --',
            'zone' => 'required',
        ]);

        try{

            Promocode::create($request->all());
            return back()->with('flash_success','Promocode Saved Successfully');

        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Promocode Not Found');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return Promocode::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $promocode = Promocode::findOrFail($id);
            return view('admin.promocode.edit',compact('promocode'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'promo_code' => 'required|max:100',
            'discount' => 'required|numeric',
            'expiration' => 'required',
        ]);

        try {

           $promo = Promocode::findOrFail($id);

            $promo->promo_code = $request->promo_code;
            $promo->discount = $request->discount;
            $promo->expiration = $request->expiration;
            $promo->save();

            return redirect()->route('admin.promocode.index')->with('flash_success', 'Promocode Updated Successfully');    
        } 

        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Promocode Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Promocode  $promocode
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Promocode::find($id)->delete();
            return back()->with('message', 'Promocode deleted successfully');
        } 
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Promocode Not Found');
        }
    }

    public function rewardRuleIndex(){   
        // rewarded history;
        $reward_history  =  Reward::all();
        $min_redeem_ammount =  Setting::get('min_redeem_ammount');
        $reward_point = Setting::get('reward_point');
        $redeem_amount = Setting::get('redeem_amount');
        $currency = Setting::get('currency');

        return view('admin.reward.index', compact('reward_history','min_redeem_ammount','reward_point','redeem_amount','currency'));
    }
    
    public function rewardRuleCreate(){   
        // rewarded history;
        $reward_history  =  Reward::all();
        $min_redeem_ammount =  Setting::get('min_redeem_ammount');
        $reward_point = Setting::get('reward_point');
        $redeem_amount = Setting::get('redeem_amount');
        $currency = Setting::get('currency');

        return view('admin.reward.create', compact('reward_history','min_redeem_ammount','reward_point','redeem_amount','currency'));
    }

    public function rewardRuleUpdate(Request $request){   
        // rewarded rule update;
        Setting::set('min_redeem_ammount', $request->min_redeem_ammount);
        Setting::set('reward_point', $request->reward_point);
        Setting::save();
        return back()->with('message', 'Reward Rule Updated successfully');
    }


    public function referralRuleIndex(){   
        // rewarded history;
        $referral_history  =  Referral::/*where('refer_id','!=',0)*/all();
        $referral_discount =  Setting::get('referral_discount');
        return view('admin.referral.index', compact('referral_history','referral_discount'));
    }
    public function referralRuleCreate(){   
        // rewarded history;
        $referral_history  =  User::where('refer_id','!=',0)->get();
        $referral_discount =  Setting::get('referral_discount');
        return view('admin.referral.create', compact('referral_history','referral_discount'));
    }


    public function referralRuleUpdate(Request $request){   
        // rewarded rule update;
        Setting::set('referral_discount', $request->referral_discount);
        Setting::save();
        return back()->with('message', 'Referral Rule Updated successfully');
    }
}
