<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Mews\Purifier\Facades\Purifier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Models\Settings;
use App\Models\Admin;
use App\Models\Etemplate;
use Carbon\Carbon;


class SettingController extends Controller
{

    public function Settings()
    {
        $data['title']='General settings';
        $data['val']=Admin::first();
        return view('admin.settings.index', $data);
    }     
    
    public function Email()
    {
        $data['title']='Email settings';
        $data['val']=Etemplate::first();
        return view('admin.settings.email', $data);
    } 

    public function EmailUpdate(Request $request)
    {
        $data = Etemplate::findOrFail(1);
        $data->esender=$request->sender;
        $data->emessage=Purifier::clean($request->message);
        $res=$data->save();
        if ($res) {
            return back()->with('success', 'Update was Successful!');
        } else {
            return back()->with('alert', 'An error occured');
        }
    }      

    public function SettlementUpdate(Request $request)
    {
        $data = Settings::findOrFail(1);
        $data->duration=$request->duration;
        $data->period=$request->period;             
        $res=$data->save();
        if ($res) {
            return back()->with('success', 'Update was Successful!');
        } else {
            return back()->with('alert', 'An error occured');
        }
    } 
    
    public function Account()
    {
        $data['title']='Change account details';
        $data['val']=Admin::first();
        return view('admin.settings.account', $data);
    } 

    public function AccountUpdate(Request $request)
    {
        $data = Admin::whereid(1)->first();
        $data->username=$request->username;
        $data->password=Hash::make($request->password);
        $res=$data->save();
        if ($res) {
            return back()->with('success', 'Update was Successful!');
        } else {
            return back()->with('alert', 'An error occured');
        }
    }  
        
    
    public function SettingsUpdate(Request $request)
    {
        $data = Settings::findOrFail(1);
        $data->site_name=$request->site_name;
        $data->livechat=$request->livechat;
        $data->email=$request->email;
        $data->support_email=$request->support_email;
        $data->mobile=$request->mobile;
        $data->title=$request->title;
        $data->withdraw_duration=$request->withdraw_duration;
        $data->site_desc=$request->site_desc;
        $res=$data->save();
        if ($res) {
            return back()->with('success', 'Update was Successful!');
        } else {
            return back()->with('alert', 'An error occured');
        }
    }    
    public function Features(Request $request)
    {
        $data = Settings::findOrFail(1);
        if(empty($request->kyc)){
            $data->kyc=0;	
        }else{
            $data->kyc=$request->kyc;
        }    
        if(empty($request->email_activation)){
            $data->email_verification=0;	
        }else{
            $data->email_verification=$request->email_activation;
        }             
        if(empty($request->email_notify)){
            $data->email_notify=0;	
        }else{
            $data->email_notify=$request->email_notify;
        }      
        if(empty($request->registration)){
            $data->registration=0;	
        }else{
            $data->registration=$request->registration;
        }                   
        if(empty($request->merchant)){
            $data->merchant=0;	
        }else{
            $data->merchant=$request->merchant;
        }         
        if(empty($request->recaptcha)){
            $data->recaptcha=0;	
        }else{
            $data->recaptcha=$request->recaptcha;
        }           
        if(empty($request->subscription)){
            $data->subscription=0;	
        }else{
            $data->subscription=$request->subscription;
        }           
        if(empty($request->transfer)){
            $data->transfer=0;	
        }else{
            $data->transfer=$request->transfer;
        }          
        if(empty($request->request_money)){
            $data->request_money=0;	
        }else{
            $data->request_money=$request->request_money;
        }           
        if(empty($request->invoice)){
            $data->invoice=0;	
        }else{
            $data->invoice=$request->invoice;
        }          
        if(empty($request->store)){
            $data->store=0;	
        }else{
            $data->store=$request->store;
        }           
        if(empty($request->donation)){
            $data->donation=0;	
        }else{
            $data->donation=$request->donation;
        }           
        if(empty($request->single)){
            $data->single=0;	
        }else{
            $data->single=$request->single;
        }    
        $res=$data->save();
        if ($res) {
            return back()->with('success', 'Update was Successful!');
        } else {
            return back()->with('alert', 'An error occured');
        }
    }      
    
    public function charges(Request $request)
    {
        $data = Settings::findOrFail(1);
        $data->transfer_charge=$request->transfer_charge;
        $data->balance_reg=$request->bal;
        $data->withdraw_charge=$request->withdraw_charge;
        $data->withdraw_limit=$request->withdraw_limit;
        $data->withdraw_duration=$request->withdraw_duration;
        $data->merchant_charge=$request->merchant_charge;
        $data->invoice_charge=$request->invoice_charge;
        $data->product_charge=$request->product_charge; 
        $data->subscription_charge=$request->subscription_charge; 
        $data->donation_charge=$request->donation_charge; 
        $data->single_charge=$request->single_charge; 
        $data->min_transfer=$request->min_transfer; 
        $data->shipping_commission=$request->shipping_commission; 
        $res=$data->save();
        if ($res) {
            return back()->with('success', 'Update was Successful!');
        } else {
            return back()->with('alert', 'An error occured');
        }
    }  
}
