<?php
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use App\Models\Etemplate;
use App\Models\Settings;
use App\Models\Logo;
use App\Models\Paymentlink;
use App\Models\Transactions;
use App\Models\Currency;
use App\Models\User;
use App\Models\Plans;
use App\Models\Subscribers;
use App\Models\Invoice;
use App\Models\Exttransfer;
use App\Models\Merchant;
use App\Models\Requests;
use App\Models\Transfer;
use App\Models\Withdraw;
use App\Models\Bank;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

// 3-11-2020
function sendsms($mobile,$message)
    {
        if($mobile && $message)
        {
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,"https://www.experttexting.com/ExptRestApi/sms/json/Message/Send?username=caribpay&password=Webtech@2020&api_key=6ljxqccz53x23ns&from=DEFAULT&to=".$mobile."&text=".$message."&type=text");
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            $output=curl_exec($ch);
            curl_close($ch);
            $result=json_decode($output);
            
            if ($result) 
            {
            	return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
        die;
        // https://www.experttexting.com/ExptRestApi/sms/json/Message/Send?username=caribpay&password=Webtech@2020&api_key=6ljxqccz53x23ns&from=DEFAULT&to=+919560042073&text=Dear customer,9560042073@123456 is your caribmall login password&type=text
        $mobile = $phone;
        $otp = $password;
        $url ='https://www.experttexting.com/ExptRestApi/sms/json/Message/Send/';
        $field = array('to'=>$mobile,'message'=>'Dear customer,'.$otp.' is your Survey Polls OTP login password, please login and reset your password','sender'=>'Info');
        $fields =json_encode($field);
        $ch = curl_init();
        //set options 
        // hPy06dvel6F6dNb5406eQeye1BPkHmSSPqoZhkk7P-6Q9txawA3rxNkf4xprLdkM
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/json","Authorization: Bearer HrbSftjdpaImP-dg41WrQvjT55IIU6LRocVr17Rl4wgfmLAcH6dV1mxQL1uOQ47E")); // Live Token
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //needed so that the $result=curl_exec() output is the file and isn't just true/false
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        $result=json_decode($result);
        if ($result->status==TRUE) 
        {
        	$data['mobile']  = "'{$mobile}'";
    		$data['otp']    = "'{$otp}'";
		    db_insert('otplist', $data);
            return $otp;
        }
        else
        {
            return false;
        }
    }
// 3-11-2020
function send_email($to, $name, $subject, $message) {
    $set=Settings::first();
    $mlogo=Logo::first();
    $from=$set->email;
    $site=$set->site_name;
    $phone=$set->phone;
    $details=$set->site_desc;
    $email=$set->email;
    $logo=url('/').'/asset/'.$mlogo->image_link;
    $data=array('name'=>$name,'subject'=>$subject,'content'=>$message,'website'=>$set->site_name,'phone'=>$phone,'details'=>$details,'email'=>$email,'logo'=>$logo);
    Mail::send(['html' => 'emails/mail'], $data, function($message) use($name, $to, $subject, $from, $site) {
    $message->to($to, $name);
    $message->subject($subject);
    $message->from($from, $site);
    });
}

 function send_paymentlinkreceipt($ref, $type, $token) {
    $link=Paymentlink::whereref_id($ref)->first();
    $dd=Transactions::whereref_id($token)->first();
    $receiver=User::whereid($link->user_id)->first();
    $currency=Currency::whereStatus(1)->first();
    $set=Settings::first();
    $mlogo=Logo::first();

    $receiver_name=$receiver->first_name.' '.$receiver->last_name;
    $from=$set->email;
    $receiver_email=$receiver->email;
    if($dd->sender_id!=null){
        $bb=User::whereid($dd->sender_id)->first();
        $sender_email=$bb->email;
    }else{
        $sender_email=$dd->email;
    }
    $site=$set->site_name;
    $details=$set->site_desc;
    $method=$type;
    $reference=$token;
    $payment_link=$link->ref_id;
    $amount=$currency->name.' '.number_format((float)$dd->amount,2, '.', '');
    $charge=$currency->name.' '.number_format((float)$dd->charge,2, '.', '');
    $logo=url('/').'/asset/'.$mlogo->image_link;
    $receiver_subject='New successful transaction';
    $sender_subject='Payment was successful';   
    $sender_text='Payment to '.$receiver->business_name.' was successful';

    if($dd->sender_id==null){
        $sender_name=$dd->first_name.' '.$dd->last_name;
        $receiver_text='A payment from '.$dd->first_name.' '.$dd->last_name.' was successfully received';
    }else{
        $xx=User::whereid($dd->sender_id)->first();
        $sender_name=$xx->first_name.' '.$xx->last_name;
        $receiver_text='A payment from '.$sender_name.' was successfully received';
    }

    $data=array(
        'created'=>$dd->created_at,
        'sender_subject'=>$sender_subject,
        'receiver_subject'=>$receiver_subject,
        'receiver_name'=>$receiver_name,
        'sender_name'=>$sender_name,
        'website'=>$set->site_name,
        'sender_text'=>$sender_text,
        'receiver_text'=>$receiver_text,
        'details'=>$details,
        'amount'=>$amount,
        'charges'=>$charge,
        'method'=>$method,
        'reference'=>$reference,
        'payment_link'=>$payment_link,
        'logo'=>$logo
        );
    Mail::send(['html' => 'emails/payment_links/rpmail'], $data, function($r_message) use($receiver_name, $receiver_email, $receiver_subject, $from, $site) {
        $r_message->to($receiver_email, $receiver_name)->subject($receiver_subject)->from($from, $site);});    
    Mail::send(['html' => 'emails/payment_links/spmail'], $data, function($s_message) use($sender_name, $sender_email, $sender_subject, $from, $site) {
    $s_message->to($sender_email, $sender_name)->subject($sender_subject)->from($from, $site);});
 } 
 
 function send_productlinkreceipt($ref, $type, $token) {
    $link=Product::whereref_id($ref)->first();
    $dd=Order::whereref_id($token)->first();
    $receiver=User::whereid($link->user_id)->first();
    $currency=Currency::whereStatus(1)->first();
    $set=Settings::first();
    $mlogo=Logo::first();
    //dd($dd->buy_shipment);
    
    $product_id = $dd->product_id;
    
     
    if($dd->buy_shipment == '0'){ 
        $track_url = "No Details Available";
    }elseif($dd->buy_shipment == '1'){
        $track_url = "No Details Available";
    }else{
        require_once("/home/cuminup/public_html/core/vendor/easypost/easypost-php/lib/easypost.php");
        $privateKey = env('EASYPOST_API_KEY');
        \EasyPost\EasyPost::setApiKey($privateKey);
        $shipment_id = $dd->buy_shipment;
        $shipment = \EasyPost\Shipment::retrieve($shipment_id);
        $track_url = url('easy_track/'.$dd->id);
        //dd($track_url);
    }

    $receiver_name=$receiver->first_name.' '.$receiver->last_name;
    $from=$set->email;
    $receiver_email=$receiver->email;
    $sender_email=$dd->email;
    $site=$set->site_name;
    $details=$set->site_desc;
    $method=$type;
    $reference=$token;
    $payment_link=$link->ref_id;
    $quantity=$dd->quantity;
    $address=$dd->address;
    $country=$dd->country;
    $state=$dd->state;
    $town=$dd->town;
    $phone=$dd->phone;
    $email=$dd->email;
    if($dd->shipping_fee==null){
        $shipping_fee=' - ';
    }else{
        $shipping_fee=$currency->name.' '.number_format((float)$dd->shipping_fee,2, '.', '');
    }

    $total=$currency->name.' '.number_format((float)$dd->total,2, '.', '');
    $amount=$currency->name.' '.number_format((float)$dd->amount,2, '.', '');
    $charge=$currency->name.' '.number_format((float)$dd->charge,2, '.', '');
    $logo=url('/').'/asset/'.$mlogo->image_link;
    $receiver_subject='New successful transaction';
    $sender_subject='Payment was successful';   
    $sender_text='Payment to '.$receiver->business_name.' was successful';
    $sender_name=$dd->first_name.' '.$dd->last_name;
    $receiver_text='A payment from '.$dd->first_name.' '.$dd->last_name.' was successfully received';
    

    $data=array(
        'created'=>$dd->created_at,
        'sender_subject'=>$sender_subject,
        'receiver_subject'=>$receiver_subject,
        'receiver_name'=>$receiver_name,
        'sender_name'=>$sender_name,
        'website'=>$set->site_name,
        'sender_text'=>$sender_text,
        'receiver_text'=>$receiver_text,
        'details'=>$details,
        'amount'=>$amount,
        'charges'=>$charge,
        'total'=>$total,
        'quantity'=>$quantity,
        'address'=>$address,
        'country'=>$country,
        'state'=>$state,
        'town'=>$town,
        'phone'=>$phone,
        'email'=>$email,
        'shipping_fee'=>$shipping_fee,
        'method'=>$method,
        'reference'=>$reference,
        'payment_link'=>$payment_link,
        'logo'=>$logo,
        'track_url'=>$track_url,
        'product_id'=>$product_id
        );
        
    $pdf = PDF::loadView('emails.product.test', $data);
    
    //dd($data);
    
    Mail::send(['html' => 'emails/product/rpmail'], $data, function($r_message) use($receiver_name, $receiver_email, $receiver_subject, $from, $site, $pdf, $data) {
        $r_message->to($receiver_email, $receiver_name)->subject($receiver_subject)->from($from, $site)->attachData($pdf->output(), "invoice.pdf");});    
    Mail::send(['html' => 'emails/product/spmail'], $data, function($s_message) use($sender_name, $sender_email, $sender_subject, $from, $site, $pdf, $data) {
    $s_message->to($sender_email, $sender_name)->subject($sender_subject)->from($from, $site)->attachData($pdf->output(), "invoice.pdf");});
    
    //return $data;
 }  

 function send_requestreceipt($ref) {
    $link=Requests::whereref_id($ref)->first();
    $receiver=User::whereid($link->user_id)->first();
    $dd=User::whereemail($link->email)->first();
    $currency=Currency::whereStatus(1)->first();
    $set=Settings::first();
    $mlogo=Logo::first();

    $receiver_name=$receiver->first_name.' '.$receiver->last_name;
    $from=$set->email;
    $receiver_email=$receiver->email;
    $sender_email=$dd->email;
    $site=$set->site_name;
    $reference=$link->ref_id;
    $amount=$currency->name.' '.number_format((float)$link->amount,2, '.', '');
    $charge=$currency->name.' '.number_format((float)$link->charge,2, '.', '');
    $logo=url('/').'/asset/'.$mlogo->image_link;
    $receiver_subject='New successful transaction';
    $sender_subject='Payment was successful';   
    $sender_text='Payment to '.$receiver->business_name.' was successful';

    if($dd->sender_id==null){
        $sender_name=$dd->first_name.' '.$dd->last_name;
        $receiver_text='A payment from '.$dd->first_name.' '.$dd->last_name.' was successfully received';
    }else{
        $xx=User::whereid($dd->sender_id)->first();
        $sender_name=$xx->first_name.' '.$xx->last_name;
        $receiver_text='A payment from '.$sender_name.' was successfully received';
    }

    $data=array(
        'created'=>$dd->created_at,
        'sender_subject'=>$sender_subject,
        'receiver_subject'=>$receiver_subject,
        'receiver_name'=>$receiver_name,
        'sender_name'=>$sender_name,
        'website'=>$set->site_name,
        'sender_text'=>$sender_text,
        'receiver_text'=>$receiver_text,
        'amount'=>$amount,
        'charges'=>$charge,
        'reference'=>$reference,
        'logo'=>$logo
        );
    Mail::send(['html' => 'emails/request/rpmail'], $data, function($r_message) use($receiver_name, $receiver_email, $receiver_subject, $from, $site) {
        $r_message->to($receiver_email, $receiver_name)->subject($receiver_subject)->from($from, $site);});    
    Mail::send(['html' => 'emails/request/spmail'], $data, function($s_message) use($sender_name, $sender_email, $sender_subject, $from, $site) {
    $s_message->to($sender_email, $sender_name)->subject($sender_subject)->from($from, $site);});
 }  

 function send_transferreceipt($ref) {
    $link=Transfer::whereref_id($ref)->first();
    $receiver=User::whereid($link->receiver_id)->first();
    $dd=User::whereid($link->sender_id)->first();
    $currency=Currency::whereStatus(1)->first();
    $set=Settings::first();
    $mlogo=Logo::first();

    $receiver_name=$receiver->first_name.' '.$receiver->last_name;
    $from=$set->email;
    $receiver_email=$receiver->email;
    $sender_email=$dd->email;
    $site=$set->site_name;
    $reference=$link->ref_id;
    $amount=$currency->name.' '.number_format((float)$link->amount,2, '.', '');
    $charge=$currency->name.' '.number_format((float)$link->charge,2, '.', '');
    $logo=url('/').'/asset/'.$mlogo->image_link;
    $receiver_subject='New successful transaction';
    $sender_subject='Payment was successful';   
    $sender_text='Payment to '.$receiver->business_name.' was successful';

    if($dd->sender_id==null){
        $sender_name=$dd->first_name.' '.$dd->last_name;
        $receiver_text='A payment from '.$dd->first_name.' '.$dd->last_name.' was successfully received';
    }else{
        $xx=User::whereid($dd->sender_id)->first();
        $sender_name=$xx->first_name.' '.$xx->last_name;
        $receiver_text='A payment from '.$sender_name.' was successfully received';
    }

    $data=array(
        'created'=>$dd->created_at,
        'sender_subject'=>$sender_subject,
        'receiver_subject'=>$receiver_subject,
        'receiver_name'=>$receiver_name,
        'sender_name'=>$sender_name,
        'website'=>$set->site_name,
        'sender_text'=>$sender_text,
        'receiver_text'=>$receiver_text,
        'amount'=>$amount,
        'charges'=>$charge,
        'reference'=>$reference,
        'logo'=>$logo
        );
    Mail::send(['html' => 'emails/transfer/rpmail'], $data, function($r_message) use($receiver_name, $receiver_email, $receiver_subject, $from, $site) {
        $r_message->to($receiver_email, $receiver_name)->subject($receiver_subject)->from($from, $site);});    
    Mail::send(['html' => 'emails/transfer/spmail'], $data, function($s_message) use($sender_name, $sender_email, $sender_subject, $from, $site) {
    $s_message->to($sender_email, $sender_name)->subject($sender_subject)->from($from, $site);});
 } 

 function send_ntransferreceipt($ref) {
    $link=Transfer::whereref_id($ref)->first();
    $dd=User::whereid($link->sender_id)->first();
    $currency=Currency::whereStatus(1)->first();
    $set=Settings::first();
    $mlogo=Logo::first();

    $from=$set->email;
    $receiver_email=$link->temp;
    $sender_email=$dd->email;
    $site=$set->site_name;
    $reference=$link->ref_id;
    $amount=$currency->name.' '.number_format((float)$link->amount,2, '.', '');
    $charge=$currency->name.' '.number_format((float)$link->charge,2, '.', '');
    $logo=url('/').'/asset/'.$mlogo->image_link;
    $receiver_subject='Confirm transaction';
    $sender_subject='Payment was successful';   
    $sender_text='Payment to '.$receiver_email.' was successful, since '.$link->temp.' is not registered, user will have to register with that email address to claim funds, funds will be returned within 5 days if money is not confirmed by recipient';
    $sender_name=$dd->first_name.' '.$dd->last_name;
    $receiver_text='You are receiving this email because '.$sender_name.', sent '.$amount.' to this email, but no account was found with this email, click button link to register with this email and confirm transaction, <a href="'.route('register').'">Register</a>';

    $data=array(
        'created'=>$dd->created_at,
        'sender_subject'=>$sender_subject,
        'receiver_subject'=>$receiver_subject,
        'sender_name'=>$sender_name,
        'website'=>$set->site_name,
        'sender_text'=>$sender_text,
        'receiver_text'=>$receiver_text,
        'amount'=>$amount,
        'charges'=>$charge,
        'reference'=>$reference,
        'logo'=>$logo
        );
    Mail::send(['html' => 'emails/transfer/nrpmail'], $data, function($r_message) use($receiver_email, $receiver_subject, $from, $site) {
        $r_message->to($receiver_email)->subject($receiver_subject)->from($from, $site);});    
    Mail::send(['html' => 'emails/transfer/nspmail'], $data, function($s_message) use($sender_name, $sender_email, $sender_subject, $from, $site) {
    $s_message->to($sender_email, $sender_name)->subject($sender_subject)->from($from, $site);});
 } 
 
 function send_invoicereceipt($ref, $type, $token) {
    $link=Invoice::whereref_id($ref)->first();
    $dd=Transactions::whereref_id($token)->first();
    $receiver=User::whereid($link->user_id)->first();
    $currency=Currency::whereStatus(1)->first();
    $set=Settings::first();
    $mlogo=Logo::first();

    $receiver_name=$receiver->first_name.' '.$receiver->last_name;
    $from=$set->email;
    $receiver_email=$receiver->email;
    if($dd->sender_id!=null){
        $bb=User::whereid($dd->sender_id)->first();
        $sender_email=$bb->email;
    }else{
        $sender_email=$dd->email;
    }
    $site=$set->site_name;
    $details=$set->site_desc;
    $method=$type;
    $reference=$token;
    $payment_link=$link->ref_id;
    $amount=$currency->name.' '.number_format((float)$dd->amount,2, '.', '');
    $charge=$currency->name.' '.number_format((float)$dd->charge,2, '.', '');
    $logo=url('/').'/asset/'.$mlogo->image_link;
    $receiver_subject='New successful transaction';
    $sender_subject='Payment was successful';   
    $sender_text='Payment to '.$receiver->business_name.' was successful';

    if($dd->sender_id==null){
        $sender_name=$dd->first_name.' '.$dd->last_name;
        $receiver_text='A payment from '.$dd->first_name.' '.$dd->last_name.' was successfully received';
    }else{
        $xx=User::whereid($dd->sender_id)->first();
        $sender_name=$xx->first_name.' '.$xx->last_name;
        $receiver_text='A payment from '.$sender_name.' was successfully received';
    }

    $data=array(
        'created'=>$dd->created_at,
        'sender_subject'=>$sender_subject,
        'receiver_subject'=>$receiver_subject,
        'receiver_name'=>$receiver_name,
        'sender_name'=>$sender_name,
        'website'=>$set->site_name,
        'sender_text'=>$sender_text,
        'receiver_text'=>$receiver_text,
        'details'=>$details,
        'amount'=>$amount,
        'charges'=>$charge,
        'method'=>$method,
        'reference'=>$reference,
        'payment_link'=>$payment_link,
        'logo'=>$logo
        );
    Mail::send(['html' => 'emails/invoice/receiver/rpmail'], $data, function($r_message) use($receiver_name, $receiver_email, $receiver_subject, $from, $site) {
        $r_message->to($receiver_email, $receiver_name)->subject($receiver_subject)->from($from, $site);});    
    Mail::send(['html' => 'emails/invoice/sender/spmail'], $data, function($s_message) use($sender_name, $sender_email, $sender_subject, $from, $site) {
    $s_message->to($sender_email, $sender_name)->subject($sender_subject)->from($from, $site);});
 }

 function send_merchantreceipt($ref, $type, $token) {
    $link=Merchant::wheremerchant_key($ref)->first();
    $dd=Exttransfer::wherereference($token)->first();
    $receiver=User::whereid($link->user_id)->first();
    $currency=Currency::whereStatus(1)->first();
    $set=Settings::first();
    $mlogo=Logo::first();

    $receiver_name=$receiver->first_name.' '.$receiver->last_name;
    $from=$set->email;
    $receiver_email=$receiver->email;
    if($dd->sender_id!=null){
        $bb=User::whereid($dd->user_id)->first();
        $sender_email=$bb->email;
    }else{
        $sender_email=$dd->email;
    }
    $site=$set->site_name;
    $details=$set->site_desc;
    $method=$type;
    $reference=$token;
    $payment_link=$link->ref_id;
    $amount=$currency->name.' '.number_format((float)$dd->amount,2, '.', '');
    $charge=$currency->name.' '.number_format((float)$dd->charge,2, '.', '');
    $logo=url('/').'/asset/'.$mlogo->image_link;
    $receiver_subject='New successful transaction';
    $sender_subject='Payment was successful';   
    $sender_text='Payment to '.$receiver->business_name.' was successful';

    if($dd->sender_id==null){
        $sender_name=$dd->first_name.' '.$dd->last_name;
        $receiver_text='A payment from '.$dd->first_name.' '.$dd->last_name.' was successfully received';
    }else{
        $xx=User::whereid($dd->user_id)->first();
        $sender_name=$xx->first_name.' '.$xx->last_name;
        $receiver_text='A payment from '.$sender_name.' was successfully received';
    }

    $data=array(
        'created'=>$dd->created_at,
        'sender_subject'=>$sender_subject,
        'receiver_subject'=>$receiver_subject,
        'receiver_name'=>$receiver_name,
        'sender_name'=>$sender_name,
        'website'=>$set->site_name,
        'sender_text'=>$sender_text,
        'receiver_text'=>$receiver_text,
        'details'=>$details,
        'amount'=>$amount,
        'charges'=>$charge,
        'method'=>$method,
        'reference'=>$reference,
        'payment_link'=>$payment_link,
        'logo'=>$logo
        );
    Mail::send(['html' => 'emails/merchant/receiver/rpmail'], $data, function($r_message) use($receiver_name, $receiver_email, $receiver_subject, $from, $site) {
        $r_message->to($receiver_email, $receiver_name)->subject($receiver_subject)->from($from, $site);});    
    Mail::send(['html' => 'emails/merchant/sender/spmail'], $data, function($s_message) use($sender_name, $sender_email, $sender_subject, $from, $site) {
    $s_message->to($sender_email, $sender_name)->subject($sender_subject)->from($from, $site);});
 } 
 
 function new_subscription($ref, $type, $token) {
    $link=Plans::whereref_id($ref)->first();
    $dd=Subscribers::whereref_id($token)->first();
    $bb=User::whereid($dd->user_id)->first();
    $receiver=User::whereid($link->user_id)->first();
    $currency=Currency::whereStatus(1)->first();
    $set=Settings::first();
    $mlogo=Logo::first();

    $sender_name=$bb->first_name.' '.$bb->last_name;
    $receiver_name=$receiver->first_name.' '.$receiver->last_name;
    $from=$set->email;
    $receiver_email=$receiver->email;
    $sender_email=$bb->email;
    $site=$set->site_name;
    $details=$set->site_desc;
    $method=$type;
    $reference=$token;
    $payment_link=$link->ref_id;
    $amount=$currency->name.' '.number_format((float)$dd->amount,2, '.', '');
    $charge=$currency->name.' '.number_format((float)$dd->charge,2, '.', '');
    $next=$dd->expiring_date;
    $plan_name=$link->name;

    if($dd->times>0 && $dd->status==1){
        $renewal='Yes';
    }else{
        $renewal='No';
    }

    $logo=url('/').'/asset/'.$mlogo->image_link;
    $receiver_subject='New successful transaction';
    $sender_subject='Payment was successful';   
    $sender_text='Payment to '.$receiver->business_name.' was successful';
    $receiver_text='A payment from '.$bb->first_name.' '.$bb->last_name.' was successfully received';

    $data=array(
        'created'=>$dd->created_at,
        'sender_subject'=>$sender_subject,
        'receiver_subject'=>$receiver_subject,
        'receiver_name'=>$receiver_name,
        'sender_name'=>$sender_name,
        'website'=>$set->site_name,
        'sender_text'=>$sender_text,
        'receiver_text'=>$receiver_text,
        'details'=>$details,
        'amount'=>$amount,
        'charges'=>$charge,
        'next'=>$next,
        'plan_name'=>$plan_name,
        'renewal'=>$renewal,
        'method'=>$method,
        'reference'=>$reference,
        'payment_link'=>$payment_link,
        'logo'=>$logo
        );
    Mail::send(['html' => 'emails/subscription/receiver/new'], $data, function($r_message) use($receiver_name, $receiver_email, $receiver_subject, $from, $site) {
        $r_message->to($receiver_email, $receiver_name)->subject($receiver_subject)->from($from, $site);});    
    Mail::send(['html' => 'emails/subscription/sender/new'], $data, function($s_message) use($sender_name, $sender_email, $sender_subject, $from, $site) {
    $s_message->to($sender_email, $sender_name)->subject($sender_subject)->from($from, $site);});
 }
 
 function send_invoice($ref) {
    $link=Invoice::whereref_id($ref)->first();
    $link->sent = 1;
    $link->save();
    $user=User::whereid($link->user_id)->first();
    $currency=Currency::whereStatus(1)->first();
    $set=Settings::first();
    $mlogo=Logo::first();

    $from=$set->email;
    $sender_email=$link->email;
    $site=$set->site_name;
    $payment_link=$link->ref_id;
    $quantity=$link->quantity;
    $r_d=$link->discount;
    $r_t=$link->tax;
    $total=$currency->name.' '.number_format((float)$link->total,2, '.', '');
    $amount=$currency->name.' '.number_format((float)$link->amount,2, '.', '');
    $discount=$currency->name.' '.number_format((float)$link->amount*$link->quantity*$r_d/100, 2, '.', '');
    $tax=$currency->name.' '.number_format((float)$link->amount*$link->quantity*$r_t/100, 2, '.', '');

    $logo=url('/').'/asset/'.$mlogo->image_link;
    $sender_subject='Payment for Invoice #'.$link->invoice_no;   
    $sender_text='Invoice for '.$link->item.' will be due by '.date("h:i:A j, M Y", strtotime($link->due_date));

    $data=array(
        'created'=>$link->created_at,
        'sender_subject'=>$sender_subject,
        'sender_name'=>$site,
        'receiver_name'=>$user->first_name.' '.$user->last_name,
        'website'=>$set->site_name,
        'sender_text'=>$sender_text,
        'payment_link'=>$payment_link,
        'quantity'=>$quantity,
        'r_d'=>$r_d,
        'r_t'=>$r_t,
        'total'=>$total,
        'amount'=>$amount,
        'discount'=>$discount,
        'tax'=>$tax,
        'logo'=>$logo
        );  
    Mail::send(['html' => 'emails/invoice/sender/invoice'], $data, function($s_message) use($sender_email, $sender_subject, $from, $site) {
    $s_message->to($sender_email)->subject($sender_subject)->from($from, $site);});
 }

 function send_transferrefund($ref) {
    $link=Transfer::whereref_id($ref)->first();
    $user=User::whereid($link->sender_id)->first();
    $currency=Currency::whereStatus(1)->first();
    $set=Settings::first();
    $mlogo=Logo::first();

    $from=$set->email;
    $sender_email=$user->email;
    $sender_name=$user->first_name.' '.$user->last_name;
    $site=$set->site_name;
    $amount=$currency->name.' '.number_format((float)$link->amount,2, '.', '');

    $logo=url('/').'/asset/'.$mlogo->image_link;
    $sender_subject='Refund for #'.$link->ref_id;   
    $sender_text='Account has been credited with '.$amount.'.  '.$link->temp.' failed to claim transfer request within the last 5 days.';

    $data=array(
        'created'=>$link->created_at,
        'sender_subject'=>$sender_subject,
        'sender_name'=>$user->first_name.' '.$user->last_name,
        'website'=>$set->site_name,
        'sender_text'=>$sender_text,
        'reference'=>$payment_link,
        'amount'=>$amount,
        'logo'=>$logo
        );  
    Mail::send(['html' => 'emails/transfer/refund'], $data, function($s_message) use($sender_name, $sender_email, $sender_subject, $from, $site) {
    $s_message->to($sender_email, $sender_name)->subject($sender_subject)->from($from, $site);});
 }  
 
 function new_withdraw($ref) {
    $link=Withdraw::wherereference($ref)->first();
    $bank=Bank::whereid($link->bank_id)->first();
    $user=User::whereid($link->user_id)->first();
    $currency=Currency::whereStatus(1)->first();
    $set=Settings::first();
    $mlogo=Logo::first();

    $from=$set->email;
    $sender_email=$user->email;
    $sender_name=$user->first_name.' '.$user->last_name;
    $site=$set->site_name;
    $amount=$currency->name.' '.number_format((float)$link->amount,2, '.', '');
    $charge=$currency->name.' '.number_format((float)$link->charge,2, '.', '');

    $logo=url('/').'/asset/'.$mlogo->image_link;
    $sender_subject='Withdraw Request is currently been Processed';   
    $sender_text='Withdrawal request takes '.$set->withdraw_duration.' to process. Thanks for working with us.';

    $data=array(
        'created'=>$link->created_at,
        'sender_subject'=>$sender_subject,
        'sender_name'=>$sender_name,
        'website'=>$set->site_name,
        'sender_text'=>$sender_text,
        'reference'=>$ref,
        'amount'=>$amount,
        'charge'=>$charge,
        'bank'=>$bank->name,
        'acct_name'=>$bank->acct_name,
        'acct_no'=>$bank->acct_no,
        'logo'=>$logo
        );  
    Mail::send(['html' => 'emails/withdraw/new'], $data, function($s_message) use($sender_name, $sender_email, $sender_subject, $from, $site) {
    $s_message->to($sender_email, $sender_name)->subject($sender_subject)->from($from, $site);});
 }
 function send_withdraw($ref, $status) {
    $link=Withdraw::whereid($ref)->first();
    $bank=Bank::whereid($link->bank_id)->first();
    $user=User::whereid($link->user_id)->first();
    $currency=Currency::whereStatus(1)->first();
    $set=Settings::first();
    $mlogo=Logo::first();

    if($status=='approved'){
        $charge=$currency->name.' '.number_format((float)$link->charge,2, '.', '');
    }else{
        $charge=' - ';
    }
    $from=$set->email;
    $receiver_email=$user->email;
    $receiver_name=$user->first_name.' '.$user->last_name;
    $site=$set->site_name;
    $amount=$currency->name.' '.number_format((float)$link->amount,2, '.', '');

    $logo=url('/').'/asset/'.$mlogo->image_link;
    $receiver_subject='We sent you money';   
    $receiver_text='Withdrawal request of '.$amount.' has been paid out. Thanks for working with us.';

    $data=array(
        'created'=>$link->created_at,
        'receiver_subject'=>$receiver_subject,
        'receiver_name'=>$receiver_name,
        'website'=>$set->site_name,
        'receiver_text'=>$receiver_text,
        'reference'=>$ref,
        'amount'=>$amount,
        'charge'=>$charge,
        'bank'=>$bank->name,
        'acct_name'=>$bank->acct_name,
        'acct_no'=>$bank->acct_no,
        'logo'=>$logo
        );  
    Mail::send(['html' => 'emails/withdraw/send'], $data, function($s_message) use($receiver_name, $receiver_email, $receiver_subject, $from, $site) {
    $s_message->to($receiver_email, $receiver_name)->subject($receiver_subject)->from($from, $site);});
 } 
 
 function send_request($ref) {
    $link=Requests::whereref_id($ref)->first();
    $user=User::whereid($link->user_id)->first();
    $to=User::whereemail($link->email)->first();
    $currency=Currency::whereStatus(1)->first();
    $set=Settings::first();
    $mlogo=Logo::first();

    $from=$set->email;
    $sender_email=$user->email;
    $receiver_email=$to->email;
    $site=$set->site_name;
    $payment_link=$link->ref_id;
    $amount=$currency->name.' '.number_format((float)$link->amount,2, '.', '');
    $charge=$currency->name.' '.number_format((float)$link->charge,2, '.', '');

    $logo=url('/').'/asset/'.$mlogo->image_link;
    $sender_subject='Money request #'.$ref;   
    $sender_text=$user->first_name.' '.$user->last_name.' just sent a Money request';

    $data=array(
        'created'=>$link->created_at,
        'sender_subject'=>$sender_subject,
        'sender_name'=>$user->first_name.' '.$user->last_name,
        'website'=>$set->site_name,
        'sender_text'=>$sender_text,
        'sender_email'=>$sender_email,
        'receiver_email'=>$receiver_email,
        'payment_link'=>$payment_link,
        'amount'=>$amount,
        'charge'=>$charge,
        'reference'=>$ref,
        'confirm'=>$link->confirm,
        'logo'=>$logo
        );  
    Mail::send(['html' => 'emails/request/new'], $data, function($s_message) use($receiver_email, $sender_subject, $from, $site) {
    $s_message->to($receiver_email)->subject($sender_subject)->from($from, $site);});
 } 
 
 function insufficient_balance($ref, $type, $token) {
    $link=Plans::whereref_id($ref)->first();
    $dd=Subscribers::whereref_id($token)->first();
    $dd->notify=0;
    $dd->save();
    $bb=User::whereid($dd->user_id)->first();
    $currency=Currency::whereStatus(1)->first();
    $set=Settings::first();
    $mlogo=Logo::first();

    $sender_name=$bb->first_name.' '.$bb->last_name;
    $from=$set->email;
    $sender_email=$bb->email;
    $site=$set->site_name;
    $method=$type;
    $reference=$token;
    $payment_link=$link->ref_id;
    $amount=$currency->name.' '.number_format((float)$dd->amount,2, '.', '');
    $charge=$currency->name.' '.number_format((float)$dd->charge,2, '.', '');
    $plan_name=$link->name;

    if($dd->times>0 && $dd->status==1){
        $renewal='Yes';
    }else{
        $renewal='No';
    }

    $logo=url('/').'/asset/'.$mlogo->image_link;
    $sender_subject='Could not renew subscription';   
    $sender_text='Payment for '.$plan_name.' was unsuccessful due to insufficient balance';

    $data=array(
        'created'=>$dd->created_at,
        'sender_subject'=>$sender_subject,
        'sender_name'=>$sender_name,
        'website'=>$set->site_name,
        'sender_text'=>$sender_text,
        'amount'=>$amount,
        'plan_name'=>$plan_name,
        'renewal'=>$renewal,
        'method'=>$method,
        'reference'=>$reference,
        'payment_link'=>$payment_link,
        'logo'=>$logo
        );  
    Mail::send(['html' => 'emails/subscription/sender/failed'], $data, function($s_message) use($sender_name, $sender_email, $sender_subject, $from, $site) {
    $s_message->to($sender_email, $sender_name)->subject($sender_subject)->from($from, $site);});
 }

if (! function_exists('user_ip')) {
    function user_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}


if (! function_exists('send_sms')) {
    function send_sms($recipients, $message)
    {
        $temp = Etemplate::first();
        $account_sid = $temp->twilio_sid;
        $auth_token = $temp->twilio_auth;
        $twilio_number = $temp->twilio_number;
        $client = new Client($account_sid, $auth_token);
        try{
            $client->messages->create($recipients, 
                [
                    'from' => $twilio_number,
                    'body' => $message
                ] );
            }catch (TwilioException $e){

            }catch (Exception $e){
    
            }
    }
}


if (! function_exists('notify'))
{
    function notify( $user, $subject, $message)
    {
        send_email($user->email, $user->name, $subject, $message);
        send_sms($user->mobile, strip_tags($message));
    }
}




if (!function_exists('send_email_verification')) {
    function send_email_verification($to, $name, $subject, $message)
    {
        $temp = Etemplate::first();
        $gnl = Settings::first();
        $template = $temp->emessage;
        $from = $temp->esender;

        $headers = "From: $gnl->site_name <$from> \r\n";
        $headers .= "Reply-To: $gnl->site_name <$from> \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $mm = str_replace("{{name}}", $name, $template);
        $message = str_replace("{{message}}", $message, $mm);

        if (mail($to, $subject, $message, $headers)) {
            // echo 'Your message has been sent.';
        } else {
            //echo 'There was a problem sending the email.';
        }
    }
}


if (!function_exists('send_sms_verification')) {

    function send_sms_verification($to, $message)
    {
        $temp = Etemplate::first();
        $gnl = Settings::first();
        if ($gnl->sms_verification == 1) {
            $sendtext = urlencode($message);
            $appi = $temp->smsapi;
            $appi = str_replace("{{number}}", $to, $appi);
            $appi = str_replace("{{message}}", $sendtext, $appi);
            $result = file_get_contents($appi);
        }
    }
}

if (!function_exists('castrotime')) {

    function castrotime($timestamp)
    {
        $datetime1=new DateTime("now");
        $datetime2=date_create($timestamp);
        $diff=date_diff($datetime1, $datetime2);
        $timemsg='';
        if($diff->y > 0){
            $timemsg = $diff->y * 12;
        }
        else if($diff->m > 0){
            $timemsg = $diff->m *30;
        }
        else if($diff->d > 0){
            $timemsg = $diff->d *1;
        }    
        if($timemsg == "")
            $timemsg = 0;
        else
            $timemsg = $timemsg;
    
        return $timemsg;
    }
}

if (!function_exists('timeAgo')) {
    function timeAgo($timestamp){
        //$time_now = mktime(date('h')+0,date('i')+30,date('s'));
        $datetime1=new DateTime("now");
        $datetime2=date_create($timestamp);
        $diff=date_diff($datetime1, $datetime2);
        $timemsg='';
        if($diff->y > 0){
            $timemsg = $diff->y .' year'. ($diff->y > 1?"s":'');
    
        }
        else if($diff->m > 0){
            $timemsg = $diff->m . ' month'. ($diff->m > 1?"s":'');
        }
        else if($diff->d > 0){
            $timemsg = $diff->d .' day'. ($diff->d > 1?"s":'');
        }
        else if($diff->h > 0){
            $timemsg = $diff->h .' hour'.($diff->h > 1 ? "s":'');
        }
        else if($diff->i > 0){
            $timemsg = $diff->i .' minute'. ($diff->i > 1?"s":'');
        }
        else if($diff->s > 0){
            $timemsg = $diff->s .' second'. ($diff->s > 1?"s":'');
        }
        if($timemsg == "")
            $timemsg = "Just now";
        else
            $timemsg = $timemsg.' ago';
    
        return $timemsg;
    }
}


if (! function_exists('convertCurrency'))
{

    function convertCurrency($amount,$from_currency,$to_currency){
        $gnl = Settings::first();
        $apikey = $gnl->api;
        $from_Currency = urlencode($from_currency);
        $to_Currency = urlencode($to_currency);
        $query =  "{$from_Currency}_{$to_Currency}";
        // change to the free URL if you're using the free version
        $json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apikey}");
        $obj = json_decode($json, true);
        $val = floatval($obj["$query"]);
        $total = $val * $amount;
        return $total;
    }
}


if (! function_exists('boomtime'))
{
    function boomtime($timestamp){
        //$time_now = mktime(date('h')+0,date('i')+30,date('s'));
        $datetime1=new DateTime("now");
        $datetime2=date_create($timestamp);
        $diff=date_diff($datetime1, $datetime2);
        $timemsg='';
        if($diff->h > 0){
            $timemsg = $diff->h * 1;
        }    
        if($timemsg == "")
            $timemsg = 0;
        else
            $timemsg = $timemsg;

        return $timemsg;
    }
}
