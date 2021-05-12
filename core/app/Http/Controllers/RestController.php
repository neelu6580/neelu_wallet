<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Stripe\Stripe;
use Stripe\Token;
use Stripe\Charge;
use App\Models\User;
use App\Models\Settings;
use App\Models\Logo;
use App\Models\Bank;
use App\Models\Currency;
use App\Models\Transfer;
use App\Models\Adminbank;
use App\Models\Gateway;
use App\Models\Deposits;
use App\Models\Banktransfer;
use App\Models\Withdraw;
use App\Models\Exttransfer;
use App\Models\Merchant;
use App\Models\Ticket;
use App\Models\Reply;
use App\Models\Invoice;
use App\Models\Virtualcard;
use App\Models\Product;
use App\Models\Productimage;
use App\Models\Order;
use App\Models\Audit;
use App\Models\Requests;
use App\Models\Paymentlink;
use App\Models\Transactions;
use App\Models\Charges;
use App\Models\Donations;
use App\Models\Plans;
use App\Models\Subscribers;
use Carbon\Carbon;
use Session;
use Image;
use Redirect;
use App\Lib\coinPayments;
use App\Lib\CoinPaymentHosted;

use DB;
use PDF;
use App\Models\Customer;

class RestController extends Controller
{

        
    public function __construct()
    {		
        
    }
    
    public function  get_userlist()
     {
         $data['userlist']=DB::table('neelu_crud')->where('status',1)->orderBy('id','DESC')->get();
         return response()->json(['status'=>'1','response'=>$data], 200);

     }
     
     public function  get_userDetails(Request $request)
     {
          $validator = Validator::make($request->all(), [
                'user_id' => 'required'
                ]);
           // $checkhandleSileApiResult = app('App\Http\Controllers\SilaController')->checkHandle($request->username);   
            if ($validator->fails()) {
                
                return response()->json(['status'=>'0','response'=>$validator->messages()], 400);
                
            }else{
         
                  $FetchResult  =DB::table('neelu_crud')->where(['id'=>$request->user_id,'status'=>1])->orderBy('id','DESC')->get();
                 if(count($FetchResult) > 0)
                   {
         
                   return response()->json(['status'=>'1','response'=>$FetchResult], 200);
                   }
                else{
                 return response()->json(['status'=>'0','response'=>'User does not exist!'], 400);

                }
            }
     }
     
     public function  userRegister(Request $request)
     {   
             $validator = Validator::make($request->all(), [
                'neelu_email' => 'required|email|unique:neelu_crud|regex:/^\S*$/u',
                'pwd' => 'required',
               ]);
           // $checkhandleSileApiResult = app('App\Http\Controllers\SilaController')->checkHandle($request->username);   
            if ($validator->fails()) {
                
                return response()->json(['status'=>'0','response'=>$validator->messages()], 400);
                
            }  else {
                
              $insertData = array(
                            'neelu_email'=>$request->neelu_email,
                            'neelu_password'=>$request->pwd,
                            'status'=>1
                            );
                        
             $insertResult = DB::table('neelu_crud')->insert($insertData); 
             if($insertResult)
             {
                  return response()->json(['status'=>'1','response'=>'User Register Successfully.'], 200);
             } else {
                 return response()->json(['status'=>'0','response'=>'Something went wrong!'], 400);
             }
    
            }
     }
      public function  productRegister(Request $request)
     {   
             $validator = Validator::make($request->all(), [
              // 'product_id' => 'required',
                'product_name' => 'required|regex:/^\S*$/u',
                'quantity' => 'required'
                
               ]);
            if ($validator->fails()) {
                
                return response()->json(['response'=>$validator->messages()], 400);
                
            }  else {
                
              $insertData = array(
                            'Product_Id'=>$request->product_id,
                            'Product_name'=>$request->product_name,
                            'Quantity'=>$request->quantity,
                            'Price'=>$request->price,
                            'Description'=>$request->description,
                            );
                        
             $insertResult = DB::table('laravelproduct')->insert($insertData); 
             if($insertResult)
             {
                  return response()->json(['response'=>'Product Register Successfully.'], 200);
             } else {
                 return response()->json(['response'=>'Something went wrong!'], 400);
             }
    
            }
     }

}
