<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Setting;
use Auth;
use App\ServiceType;
use App\Provider;
use App\ProviderDocument;
use App\ProviderProfile;
use App\PushNotification;
use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SendPushNotification;
use App\ProviderService;
use \Carbon\Carbon;
use DateTime;
use App\Page;
use App\ContactUs;
use App\Complaint;
use App\Blog;
use App\LostItem;
use App\User;
use App\UserRequests;
use App\RequestFilter;
use App\PromocodeUsage;
use App\UserRequestRating;
use App\Settings;
use App\UserComplaint;
use App\FareSetting;

class CommonController extends Controller
{
   

    public function index(Request $request) {
            
        $data['services']   =   ServiceType::all();   
        //$details              =   $this->getIpDetails();
        //$data['services']         =   $details['services'];
        //$data['ip_details']       =   $details['ip_details'];
        $data['testimonials']   =   Testimonial::orderBy('id', 'desc')->take(8)->get();
    
        return view('index', ['data' => $data ]);
    }

    public function lang(){
         $locale = session()->get('locale');
        if($locale){

             return $locale;

           }else{

             return $locale = 'en';

        }
    }

    public function reset(){
        return view('user.auth.reset');
    }
    public function complaint(){
        $data['message_cats'] = ['test1','test2','test3'];
        return view('pages.complaint', compact('data'));
    }

    public function contact_us(){
        $data['message_cats'] = ['test1','test2','test3'];
        return view('pages.contact_us', compact('data'));
    }
    public function lost_item(){
        return view('pages.lost_item');
    }


    public function getCountry($id){
        return view('pages.country',compact('id'));
    }
 /**
     * update password.
     *
     * @return \Illuminate\Http\Response
     */
    public function password_update(Request $request){
     
        $this->validate($request,[
            'email'     => 'required|email',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
            ]);
        try {
            User::where('email',$request->email)->update(['password' => bcrypt($request->password)]);
             return redirect('PassengerSignin');
        } catch (Exception $e) {
            return back()->with('flash_error','Something Went Wrong!');
        }
    }
    
    public function provider_password_update(Request $request){
        $this->validate($request,[
            'email'     => 'required|email',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
            ]);
        try {
            Provider::where('email',$request->email)->update(['password' => bcrypt($request->password)]);
             return redirect('provider/login');
        } catch (Exception $e) {
            return back()->with('flash_error','Something Went Wrong!');
        } 
    }

    public function contact(Request $request) {
        // dd($request->all());
        $json = array();
        
        $this->validate($request,[
            'name'      => 'required',
            'email'     => 'required|email',
            'message'   => 'required',
            
            ]);
            
        try{
            
            $message = new ContactUs();
            $message->name          =   $request->name;
            $message->email         =   $request->email;
            $message->message       =   $request->message;
                                    
            $message->save();
            
            
            $json['success'] = ( $message->id ) ? true : false;
        
            return redirect()->back()->with('message', 'We have received your request successfully.We will get back within 24 hours.');
                
        } catch(Exception $e) {
            
            return response()->json(['error' => trans('api.something_went_wrong')], 500);
        
        }
        
    
    }

       public function complaint_form(Request $request) {

        $json = array();
        //$data = str_replace(url('/'), '', url()->previous());
        //dd($data);
        //$u = explode('?', $data);
        //$url = explode('=', $u[1]);
        $this->validate($request,[
            'name'      => 'required',
            'email'     => 'required|email',
            'transfer'   => 'required',
            'message'   => 'required',
            // 'phone'     => 'required',
            
            ]);
            
        try{
            
            $message = new Complaint();
            $message->name          =   $request->name;
            $message->email         =   $request->email;        
            // $message->subject       =   $request->subject;
            $message->transfer       =   $request->transfer;
            $message->message       =   $request->message;
            //$message->type         =    $url[1];
            
            // if ($request->hasFile('attachment')) {
            //     $file = $request->file('attachment');
            //     $name = time().'.'.$file->getClientOriginalExtension();
            //     $destinationPath = public_path('/uploads');
            //     $file->move($destinationPath, $name);
            //     $message->attachment    =   $name;
            // }
            
            $message->save();
         
            
            $json['success'] = ( $message->id ) ? true : false;
        
        sendMail('Support',$request->email,$request->name,'New Query Received');
        return redirect()->back()->with('message', 'Query Saved Successfully');
                
        } catch(Exception $e) {
            
            return response()->json(['error' => trans('api.something_went_wrong')], 500);
        
        }
        
    
    }

     public function sendMessage(Request $request) {
        $json = array();
        
        $this->validate($request,[
            'name'      => 'required',
            'email'     => 'required|email',
            'subject'   => 'required',
            'message'   => 'required',
            'phone'     => 'required',
            
            ]);
            
        try{
            
            $message = new ContactUs();
            $message->name          =   $request->name;
            $message->email         =   $request->email;        
            $message->subject       =   $request->subject;
            $message->message       =   $request->message;
            $message->phone         =   $request->phone;
            
            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                $name = time().'.'.$file->getClientOriginalExtension();
                $destinationPath = public_path('/uploads');
                $file->move($destinationPath, $name);
                $message->attachment    =   $name;
            }
            
            $message->save();
            
            
            $json['success'] = ( $message->id ) ? true : false;
        
        sendMail('Contact us',$request->email,$request->name,'New Query Received');
        return response()->json( $json );
                
        } catch(Exception $e) {
            
            return response()->json(['error' => trans('api.something_went_wrong')], 500);
        
        }
        
    
    }

    public function lostItemForm(Request $request) {
        $json = array();
        
        $this->validate($request,[
            'name'      => 'required',
            'email'     => 'required|email',
            'lost_item'   => 'required',
            'phone'     => 'required',
            ]);
            
        try{
            $message = new LostItem();
            $message->name          =   $request->name;
            $message->email         =   $request->email;        
            $message->lost_item       =   $request->lost_item;
            $message->phone       =   $request->phone;
            $message->save();
            $json['success'] = ( $message->id ) ? true : false;
        
        return response()->json( $json );
                
        } catch(Exception $e) {
            
            return response()->json(['error' => trans('api.something_went_wrong')], 500);
        
        }
    
    }
     public function blogs(Request $request){
          $blogs =Blog::orderBy('id','desc')->get();
                    
          return view('pages.blog',compact('blogs'));    
        }

        public function blog_detail($id){
        $blog_detail = Blog::where('id',$id)->first();
          
            return view('pages.blogdetail',compact('blog_detail'));
    }
        public function fare_estimate()
    {
        $services   = ServiceType::all(); 
        $sessiondata = session()->all();
        return view('pages.fare_estimate', compact(['services', 'sessiondata']));

    }
    
    public function ride_overview(){
        return $this->commonpage('ride-overview');
       }

    public function ride_safety(){
        return $this->commonpage('ride-safety');
       
    }
    public function airports(){
       return $this->commonpage('airports');

    }
    public function drive_overview(){
       return $this->commonpage('drive-overview');

    }
    public function requirements(){
       return $this->commonpage('requirements');

    }
    public function driver_app(){
       return $this->commonpage('driver-app');

    }
    public function vehicle_solutions(){
       return $this->commonpage('vehicle-solutions');

    }
    public function drive_safety(){
       return $this->commonpage('drive-safety');

    }
    public function local(){
       return $this->commonpage('local');
    }
    public function mylift($id){
        return $this->commonpage(str_slug(strtolower($id), '-'));
    }

    // public function myliftxl(){
    //     return $this->commonpage('drive-safety');
    // }

    // public function myliftxll(){
    //     return $this->commonpage('drive-safety');
    // }

    // public function myliftgox(){
    //     return $this->commonpage('drive-safety');
    // }

    // public function common($val,$page){
     
    //  $data = Page::select($locale.'_title',$locale.'_description')->where('slug',$val)->first(); 
    //   return view('pages.'.$page,compact('data')); 
    // }

    public function helpPage()
    {  
        $data =Page::where('en_title','faq')->get();

        return view('pages.help',compact('data'));

    }
    public function refund()
    { 
        return view('pages.refund');
        
    }
    public function user()
    {
        return view('pages.user');

    }

    public function driver()
    {
        return view('pages.driver');

    }

    public function cities()
    {
        return $this->commonpage('cities');

    }

    public function how_it_works()
    { 
        $data =Page::where('en_title','how it work')->get();

        return view('pages.how_it_works',compact('data'));

    }

    public function stories()
    {   

        return view('pages.story');

    }
    
    public function about_us() {
      return  $this->commonpage('about-us');
    }
    public function privacy() {
       return $this->commonpage('privacy-policy');
    }
     public function refund_policy() {
       return $this->commonpage('refund-policy');
    }
    //  public function fee_estimation() {
    //    return $this->commonpage('fee-estimate');
    // }
     public function help() {
      return  $this->commonpage('help');
    }
     public function terms_condition() {
       return $this->commonpage('terms-conditions');
    }
    public function why_us() {
        // return view('user.layout.why_us');
       return $this->commonpage('why-us');
    }
    public function commonpage($val) {
        $locale = $this->lang();
        $data = Page::select($locale.'_title',$locale.'_description')->where('slug',$val)->first();
        return view('pages.static',compact('data'));
    }
    
    
    public function download_page()
    {
        return view('downloadpage');
    }
    
     

    // public function help()
    // {
    //     return view('user.layout.help');     
    // }
    
    public function driver_story () {

        $providers = DB::table('providers')
            ->join('provider_profiles', 'providers.id', '=', 'provider_profiles.provider_id')
            ->select('providers.*', 'provider_profiles.description')
           ->where('providers.status', 'approved')
            ->whereNotNull('provider_profiles.description')
            ->paginate(4);


        return view('user.layout.driver_story', compact('providers') );         
    
    }


    public function locale(Request $request ) {

              
        if( $request->has('locale') ) {

            Session::put('locale', $request->input('locale', 'en')  );
            Session::save();
        }

        return redirect()->back();

    }


    public function calculate_price(Request $request ) {

        
        $services   = ServiceType::all();    
        $ip     =   \Request::getClientIp(true);
        $ip_details = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip={$ip}"));

        return view('user.layout.calculate_price', compact('services', 'ip_details' ) );    
    }

    public function searchingajax()
    {
        $allrequests  = DB::table('user_requests')->select('id','status','created_at')->where('status', 'SEARCHING')->get();
        
        foreach($allrequests as $request)
        {
            $time = new \DateTime($request->created_at);
            $diff = $time->diff(new DateTime());
            $minutes = ($diff->days * 24 * 60) +
                       ($diff->h * 60) + $diff->i;
            if($minutes > 2)
            {
                DB::table('user_requests')
                    ->where('status', 'SEARCHING')
                    ->update(['status' => "CANCELLED"]);
                //return 1;
            }
        }
    }
    
    public function ajaxforofflineprovider(Request $request)
    {
        $allrequests  = DB::table('providers')->select('updated_at','id')->where('status','!=', 'riding')->get();
        
        foreach($allrequests as $request)
        {
            $time = new \DateTime($request->updated_at);
            $diff = $time->diff(new DateTime());
            $minutes = ($diff->days * 24 * 60) +
                       ($diff->h * 60) + $diff->i;
            if($minutes > 2)
            {
                $data = ProviderService::where('provider_id',$request->id)->update(['status' =>'offline']);
            }
        }
        //return $expected;
    }
    
    public function providerDocumentExpiryNotification(){
        $docs = ProviderDocument::with('provider','document')->where('expires_at','>=', Carbon::now()->toDateString())->get();
        foreach($docs as $doc){
           if(!empty($doc->provider) && !empty($doc->document)){
               $days = Carbon::parse($doc->expires_at)->diffInDays(Carbon::parse(Carbon::now()->toDateString()));
              
               if($days<=$doc->document->expire){
                   $msg="Your document ".$doc->document->name." will expire in ".$days." days. Please update your document";
                   $title="Document Expiry Notification";
                    $notification = new PushNotification;
                    $notification->type = 2;
                    $notification->title = $title;
                    $notification->zone = 0;
                    $notification->notification_text = $msg;
                    $notification->from_user = 1;
                    $notification->to_user = $doc->provider->id;
                    $notification->expiration_date = Carbon::parse($doc->expires_at);
                    $notification->save();
                   (new SendPushNotification)->notifyProvider($doc->provider->id,$title,$msg,'admin','');
                   
               }
                  
           }
        }
        
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function search_shedule_provider(Request $request) {
        
        $schedule_req_time  =   Setting::get('schedule_req_time');
        $count = UserRequests::where('status','SCHEDULED')->where('provider_id','=','0')->count();
        $requests = UserRequests::where('status','SCHEDULED')->where('provider_id','=','0')->orderBy('id', 'DESC')->get();        
        if($count>0){
            
            foreach($requests as $request)
            {
                $to_time=strtotime(date('Y-m-d H:i', strtotime($request['schedule_at'])));
                $from_time=strtotime(date('Y-m-d H:i'));
                $minuts = round(abs($to_time - $from_time) / 60,2);
                //dd((int)$minuts);
                if((int)$minuts<(int)$schedule_req_time)
                {  

                    $spoint[0]  =   $request['s_latitude']; 
                    $spoint[1]  =   $request['s_longitude'];
                    $dpoint[0]  =   $request['d_latitude']; 
                    $dpoint[1]  =   $request['d_longitude'];
                    $distance       =   Setting::get('provider_search_radius', '10');
                    $latitude       =   $request['s_latitude']; 
                    $longitude      =   $request['s_longitude'];
                    $service_type   =   $request['service_type_id']; 
                    $promo_code     =   $request['d_longitude'];
                    
                    $Providers  = Provider::with('service')
                                ->select(DB::Raw("(6387 * acos( cos( radians('$latitude') ) * cos( radians(latitude) ) * cos( radians(longitude) - radians('$longitude') ) + sin( radians('$latitude') ) * sin( radians(latitude) ) ) ) AS distance"),'id')
                                ->where('status', 'approved')
                                ->whereRaw("(6387 * acos( cos( radians('$latitude') ) * cos( radians(latitude) ) * cos( radians(longitude) - radians('$longitude') ) + sin( radians('$latitude') ) * sin( radians(latitude) ) ) ) <= $distance")
                                ->whereHas('service', function($query) use ($service_type){
                                            $query->where('status','active');
                                            $query->where('service_type_id',$service_type);
                                })
                                ->orderBy('distance','asc')
                                ->get();
               
                    //List Providers who are currently busy and add them to the filter list.
                    if(count($Providers) == 0) {
                        return response()->json([
                            'message' => 'No Providers Found! Please try again.',
                        ]);
                        //return back()->with('flash_success', 'No Providers Found! Please try again.');
                    }
                    //dd($request);
                    try{
                        
                        if(isset($request['ride_type']) && $request['ride_type']=='rental'){
                            $details = "https://maps.googleapis.com/maps/api/directions/json?origin=".$request->s_latitude.",".$request->s_longitude."&destination=".$request->s_latitude.",".$request->s_longitude."&mode=driving&key=".env('GOOGLE_MAP_KEY');
                        }   else{

                            $details = "https://maps.googleapis.com/maps/api/directions/json?origin=".$request->s_latitude.",".$request->s_longitude."&destination=".$request->d_latitude.",".$request->d_longitude."&mode=driving&key=".env('GOOGLE_MAP_KEY');
                        }

            
                        $json = curl($details);
                        $details = json_decode($json, TRUE);
                        
                        $route_key  = $details['routes'][0]['overview_polyline']['points'];
                        $booking_id = Helper::generate_booking_id();
                        
                        $UserRequest = UserRequests::findOrFail($request['id']);
                        $UserRequest->booking_id = $booking_id;
                        $UserRequest->provider_id = $Providers[0]->id;
                        $UserRequest->current_provider_id = $Providers[0]->id;
                        $UserRequest->status = 'SEARCHING';
            
                        //if(Auth::user()->wallet_balance > 0) {
                            //$UserRequest->use_wallet = $request->use_wallet ? : 0;
                       // }
            
                        $UserRequest->assigned_at = Carbon::now();
                        $UserRequest->route_key = $route_key;
            
                        if($Providers->count() <= Setting::get('surge_trigger') && $Providers->count() > 0) {
                            $UserRequest->surge = 1;
                        }

                        $UserRequest->save();
                        
                        $user = User::findOrFail($request['user_id']);
                        
                        $data = array(
                            'username'      => $user->first_name,
                            'usermobile'    => $user->mobile,
                            'payment_mode'  => $user->payment_mode,
                            'booking_id'    => $booking_id,
                            'drivername'    => $Providers[0]->first_name,
                            'drivermobile'  => $Providers[0]->mobile
                        );
            
                        (new SendPushNotification)->IncomingRequest($Providers[0]->id);
                        
                        if(isset($UserRequest->id) && $UserRequest->id!=''):
                            foreach ($Providers as $key => $Provider) {
                
                                $Filter = new RequestFilter;
                                $Filter->request_id = $UserRequest->id;
                                $Filter->provider_id = $Provider->id; 
                                $Filter->save();
                            }
                        endif;
                        //dd($UserRequest);    
                        if($UserRequest) {  
                            return response()->json([
                                    'message' => 'Providor assigned to sheduled request!.',
                                    'request_id' => $UserRequest->id,
                                    'current_provider' => $UserRequest->provider_id,
                                ]);
                        }   else {
                            return response()->json([
                                    'message' => 'Something went wrong.',
                                ]);
                        }
            
                    }   catch (Exception $e) {
                        return response()->json(['error' => $e->getMessage()]);
                    } 
                }
            }
        }   else{
                return response()->json([
                    'message' => 'No Ride Sheduled.',
                ]);
        }
    }

}
