<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ProviderDevice;
use Exception;
use App\PushNotification;
use App\ProviderService;

class SendPushNotification extends Controller
{
	/**
     * New Ride Accepted by a Driver.
     *
     * @return void
     */
    public function RideAccepted( $user_id ){

    	return $this->sendPushToUser( $user_id , trans('api.push.request_accepted'));
    }

    public function chatNotify($userID,$msg,$request_id,$username){      //push notification to user
       
        return $this->sendPushToUser($userID,$msg,'chat',$request_id,$username);
    }
    public function userNotify($userID,$title,$msg,$msg_type,$notification_images){      //push notification to user
       
        $notifications  = PushNotification::where('to_user',$userID)->orderBy('id','desc')->first();
        $img="";
        $image = "http://quickrideja.com/public/user/profile/".$notification_images;
        return $this->sendPushToUser($userID,$title,'admin',$msg,$msg_type,$img,$image);
    }
    
   	public function chatNotifyProvider($providerID,$msg,$request_id,$username){    //push notification to provider
       
        return $this->sendPushToProvider($providerID,$msg,'chat',$request_id,$username);
    }
    public function specialNoteNotifyProvider($providerID,$msg,$request_id,$username){    //push notification to provider
       
        return $this->sendPushToProvider($providerID,$msg,'SpecialNote',$request_id,$username);
    }
    public function changeLocationNotifyProvider($providerID,$msg,$request_id,$username){    //push notification to provider
       
        return $this->sendPushToProvider($providerID,$msg,'DestinationLocationChange',$request_id,$username);
    }
    public function notifyProvider($providerID,$title,$msg,$msg_type,$notification_images)  {    //push notification to provider
    
        $notifications  = PushNotification::where('to_user',$providerID)->orderBy('id','desc')->first();
        $img="";
        $image = "http://quickrideja.com/public/user/profile/".$notification_images;
        return $this->sendPushToProvider($providerID,$title,'admin',$msg,$msg_type,$img,$image);
    }
    
    /**
     * Driver Arrived at your location.
     *
     * @return void
     */
    public function user_schedule($user){

        return $this->sendPushToUser($user, trans('api.push.schedule_start'));
    }

    /**
     * New Incoming request
     *
     * @return void
     */
    public function provider_schedule($provider){

        return $this->sendPushToProvider($provider, trans('api.push.schedule_start'));

    }

    /**
     * New Ride Accepted by a Driver.
     *
     * @return void
     */
    public function UserCancellRide($request){

        return $this->sendPushToProvider($request->provider_id, trans('api.push.user_cancelled'));
    }


    /**
     * New Ride Accepted by a Driver.
     *
     * @return void
     */
    public function ProviderCancellRide( $obj ){

        return $this->sendPushToUser($obj->user_id, trans('api.push.provider_cancelled'));
    }

    /**
     * Driver Arrived at your location.
     *
     * @return void
     */
    public function Arrived($request){

        return $this->sendPushToUser($request->user_id, trans('api.push.arrived'));
    }

    /**
     * Money added to user wallet.
     *
     * @return void
     */
    public function ProviderNotAvailable($user_id){

        return $this->sendPushToUser($user_id,trans('api.push.provider_not_available'));
    }

    /**
     * New Incoming request
     *
     * @return void
     */
    public function IncomingRequest($provider){
      
        return $this->sendPushToProvider($provider, trans('api.push.incoming_request'));

    }
    

    /**
     * Driver Documents verfied.
     *
     * @return void
     */
    public function DocumentsVerfied($provider_id) {

        return $this->sendPushToProvider($provider_id, trans('api.push.document_verfied'));
    }

	
	 /**
     * Dropped
     *
     * @return void
     */
    public function Dropped($user_id) {

          return $this->sendPushToUser($user_id,trans('api.push.drop'));
    }
	
	
    /**
     * Money added to user wallet.
     *
     * @return void
     */
    public function WalletMoney($user_id, $money){

        return $this->sendPushToUser($user_id, $money.' '.trans('api.push.added_money_to_wallet'));
    }

    /**
     * Money charged from user wallet.
     *
     * @return void
     */
    public function ChargedWalletMoney($user_id, $money){

        return $this->sendPushToUser($user_id, $money.' '.trans('api.push.charged_from_wallet'));
    }

    /**
     * Sending Push to a user Device.
     *
     * @return void
     */
    public function sendPushToUser($user_id, $push_message,$msg_type = "",$request_id="",$username="",$admin="",$img="")
    {
    //dd($img);
    	try{
	    	$user = User::findOrFail($user_id);
            if($user->device_token != ""){
    	    	if($user->device_type == 'ios'){
    	    		/*return \PushNotification::app('IOSUser')
    		            ->to($user->device_token)
    		            ->send($push_message);*/
    		            
        shell_exec('curl -X POST --header "Authorization: key=AAAAfwv7jpg:APA91bHg6LLpvsPrT-ON1vYMU0bMsG22pUp8QvmmS1zhsa_YzRNPtsxegrePaGd0lFktU0LDztzZV78k710GfujN36i7uU9XnDcXzcGGm6ps3Fbq30P_4chGhTeNVoBIHY-Qpt3Bwejq" --header "Content-Type: application/json" https://fcm.googleapis.com/fcm/send -d "{\"to\":\"'.$user->device_token.'\",\"priority\":\"high\",\"data\":{\"msg_type\":\"'.$msg_type.'\",\"request_id\":\"'.$request_id.'\",\"image_url\":\"'.$img.'\",\"user_name\":\"'.$username.'\",\"msg\":\"'.$push_message.'\"},\"notification\":{\"body\": \"'.stripslashes($push_message).'\",\"title\":\"'.$msg_type.'\",\"image\":\"'.$img.'\"}}"');

    	    	}elseif($user->device_type == 'android'){
    	    	  
    	    		 //return \PushNotification::app('AndroidUser')
    		      //      ->to($user->device_token)
    		      //      ->send($push_message,array('msg_type' => $msg_type)); 

		shell_exec('curl -X POST --header "Authorization: key=AAAAfwv7jpg:APA91bHg6LLpvsPrT-ON1vYMU0bMsG22pUp8QvmmS1zhsa_YzRNPtsxegrePaGd0lFktU0LDztzZV78k710GfujN36i7uU9XnDcXzcGGm6ps3Fbq30P_4chGhTeNVoBIHY-Qpt3Bwejq" --header "Content-Type: application/json" https://fcm.googleapis.com/fcm/send -d "{\"to\":\"'.$user->device_token.'\",\"priority\":\"high\",\"data\":{\"msg_type\":\"'.$msg_type.'\",\"request_id\":\"'.$request_id.'\",\"image_url\":\"'.$img.'\",\"user_name\":\"'.$username.'\",\"msg\":\"'.$push_message.'\"},\"notification\":{\"body\": \"'.stripslashes($push_message).'\",\"title\":\"'.$msg_type.'\",\"image\":\"'.$img.'\"}}"');
					
    	    	}
            }

    	}   catch(Exception $e){
    		return $e;
    	}
    }




    /**
     * Sending Push to a user Device.
     *
     * @return void
     */
    public function sendPushToProvider($provider_id, $push_message,$msg_type = "",$request_id="",$username="",$admin="",$img="")
    {
        //dd($img);
    	try{
            $provider = ProviderDevice::where('provider_id',$provider_id)->first();

            if($provider->token != ""){
            	if($provider->type == 'ios'){
            		/*return \PushNotification::app('IOSProvider')
        	            ->to($provider->token)
        	            ->send($push_message);*/
        shell_exec('curl -X POST --header "Authorization: key=AAAAfwv7jpg:APA91bHg6LLpvsPrT-ON1vYMU0bMsG22pUp8QvmmS1zhsa_YzRNPtsxegrePaGd0lFktU0LDztzZV78k710GfujN36i7uU9XnDcXzcGGm6ps3Fbq30P_4chGhTeNVoBIHY-Qpt3Bwejq" --header "Content-Type: application/json" https://fcm.googleapis.com/fcm/send -d "{\"to\":\"'.$provider->token.'\",\"priority\":\"high\",\"data\":{\"msg_type\":\"'.$msg_type.'\",\"request_id\":\"'.$request_id.'\",\"image_url\":\"'.$img.'\",\"user_name\":\"'.$username.'\",\"msg\":\"'.$push_message.'\"},\"message_type\":\"chat\",\"notification\":{\"body\": \"'.stripslashes($push_message).'\",\"title\":\"'.$msg_type.'\",\"image\":\"'.$img.'\"}}"');	            

            	}elseif($provider->type == 'android'){
            
               // 		return \PushNotification::app('AndroidProvider')
        	   //         ->to($provider->token)
        	   //         ->send($push_message,array('msg_type' => $msg_type));
        shell_exec('curl -X POST --header "Authorization: key=AAAAfwv7jpg:APA91bHg6LLpvsPrT-ON1vYMU0bMsG22pUp8QvmmS1zhsa_YzRNPtsxegrePaGd0lFktU0LDztzZV78k710GfujN36i7uU9XnDcXzcGGm6ps3Fbq30P_4chGhTeNVoBIHY-Qpt3Bwejq" --header "Content-Type: application/json" https://fcm.googleapis.com/fcm/send -d "{\"to\":\"'.$provider->token.'\",\"priority\":\"high\",\"data\":{\"msg_type\":\"'.$msg_type.'\",\"request_id\":\"'.$request_id.'\",\"image_url\":\"'.$img.'\",\"user_name\":\"'.$username.'\",\"msg\":\"'.$push_message.'\"},\"message_type\":\"chat\",\"notification\":{\"body\": \"'.stripslashes($push_message).'\",\"title\":\"'.$msg_type.'\",\"image\":\"'.$img.'\"}}"');
	
            	}
            }

    	} catch(Exception $e){
            //dd($e->getMessage());
    		return $e;
    	}
    }
    public function offnotificationtoprovider()
    {
        $push_message = "You are offline.Please change your status.";
        $msg_type = "offline";
        $request_id=1;
        $username="upendra";
        //$admin="";
        //$img="";
        $data = ProviderService::where('status','offline')->get();
        foreach($data as $p)
        {
            return $this->sendPushToProvideroffline($p['provider_id'],$push_message,$msg_type);
        }    
    }
    public function sendPushToProvideroffline($provider_id, $push_message,$msg_type = "",$request_id="",$username="",$admin="",$img="")
    {
    	try{
            $provider = ProviderDevice::where('provider_id',$provider_id)->first();
            if($provider['token'] != ""){
            	if($provider->type == 'ios'){
            		/*return \PushNotification::app('IOSProvider')
        	            ->to($provider->token)
        	            ->send($push_message);*/
        	    shell_exec('curl -X POST --header "Authorization: key=AAAAfwv7jpg:APA91bHg6LLpvsPrT-ON1vYMU0bMsG22pUp8QvmmS1zhsa_YzRNPtsxegrePaGd0lFktU0LDztzZV78k710GfujN36i7uU9XnDcXzcGGm6ps3Fbq30P_4chGhTeNVoBIHY-Qpt3Bwejq" --header "Content-Type: application/json" https://fcm.googleapis.com/fcm/send -d "{\"to\":\"'.$provider->token.'\",\"priority\":\"high\",\"data\":{\"msg_type\":\"'.$msg_type.'\",\"request_id\":\"'.$request_id.'\",\"image_url\":\"'.$img.'\",\"user_name\":\"'.$username.'\",\"msg\":\"'.$push_message.'\"},\"message_type\":\"chat\",\"notification\":{\"body\": \"'.stripslashes($push_message).'\",\"title\":\"'.$msg_type.'\",\"image\":\"'.$img.'\"}}"');         

            	}   elseif($provider->type == 'android'){
            
                // 		return \PushNotification::app('AndroidProvider')
        	    //         ->to($provider->token)
        	    //         ->send($push_message,array('msg_type' => $msg_type));
        	   	shell_exec('curl -X POST --header "Authorization: key=AAAAfwv7jpg:APA91bHg6LLpvsPrT-ON1vYMU0bMsG22pUp8QvmmS1zhsa_YzRNPtsxegrePaGd0lFktU0LDztzZV78k710GfujN36i7uU9XnDcXzcGGm6ps3Fbq30P_4chGhTeNVoBIHY-Qpt3Bwejq" --header "Content-Type: application/json" https://fcm.googleapis.com/fcm/send -d "{\"to\":\"'.$provider->token.'\",\"priority\":\"high\",\"data\":{\"msg_type\":\"'.$msg_type.'\",\"request_id\":\"'.$request_id.'\",\"image_url\":\"'.$img.'\",\"user_name\":\"'.$username.'\",\"msg\":\"'.$push_message.'\"},\"message_type\":\"chat\",\"notification\":{\"body\": \"'.stripslashes($push_message).'\",\"title\":\"'.$msg_type.'\",\"image\":\"'.$img.'\"}}"');
	
            	}
            }

    	} catch(Exception $e){
    		return $e;
    	}
    }
}
