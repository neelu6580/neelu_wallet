<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Settings;
use App\Models\Blog;
use App\Models\Logo;
use App\Models\Currency;
use App\Models\Social;
use App\Models\Faq;
use App\Models\Category;
use App\Models\Page;
use App\Models\Design;
use App\Models\About;
use App\Models\Review;
use App\Models\User;
use App\Models\Services;
use App\Models\Brands;
use App\Models\Branch;
use App\Models\Transfer;
use App\Models\Requests;
use App\Models\Plans;
use App\Models\Subscribers;
use App\Models\Charges;
use App\Models\Gateway;
use App\Models\Audit;
use App\Models\Deposits;
use App\Models\Banktransfer;
use App\Models\Withdraw;
use App\Models\Ticket;
use Illuminate\Support\Facades\View;
use Session;
use Image;
use App\Lib\CoinPaymentHosted;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view){
            $currency=Currency::whereStatus(1)->first();
            $set=Settings::first();
            if($set->next_settlement<Carbon::now()){
                $dt = Carbon::create($set->next_settlement);
                $dt->add($set->duration.' '.$set->period); 
                $set->next_settlement=$dt;
                $set->save();  
            }
            //Update settlement date of pending settlement
            $pcheck=Withdraw::wherestatus(0)->where('next_settlement', '<', $set->next_settlement)->get();
            foreach($pcheck as $xcheck){
                $xcheck->next_settlement=$set->next_settlement;
                $xcheck->save();
            }
            $stripe=Gateway::whereid(103)->first();
            $paystack=Gateway::whereid(107)->first();
            $btc=Gateway::whereid(505)->first();
            $eth=Gateway::whereid(506)->first();
            $sub=Subscribers::wherestatus(1)->where('times', '>', 0)->where('expiring_date', '<', Carbon::now())->get();
            $transfer=Transfer::where('temp', '!-', null )->wherestatus(0)->get();
            if (Auth::guard('admin')->check()) {
                $admin=Admin::find(Auth::guard('admin')->user()->id);
                $view->with('admin', $admin );
            }
            if (Auth::guard('user')->check()) {
                $user=User::find(Auth::guard('user')->user()->id);
                if(empty($user->image)){
                    $cast="person.jpg";
                }else{
                    $cast=$user->image;
                }      
                //Check for pending coinpayment transactions
                    $depo=Deposits::whereStatus(0)->whereuser_id($user->id)->where('txn_id', '!=', 'null')->get();  
                    foreach($depo as $val){
                        if($val->gateway['id']==505){
                            $method = Gateway::find(505);
                            $cps = new CoinPaymentHosted();
                            $cps->Setup($method->val2, $method->val1);
                            $req = array(
                                'txid' => $val->txn_id,
                            );
                            $result = $cps->ViewTransaction($req);
                            $status=$result['result']['status'];
                            if($status>=100 || $status==2){
                                $user->balance=$user->balance + $val->amount - $val->charge;
                                $user->update();
                                $val->status = 1;
                                $val->update();            
                            }elseif($status<0){
                                $val->status = 2;
                                $val->update();
                            }
                        }elseif($val->gateway['id']==506){
                            $method = Gateway::find(506);
                            $cps = new CoinPaymentHosted();
                            $cps->Setup($method->val2, $method->val1);
                            $req = array(
                                'txid' => $val->txn_id,
                            );
                            $result = $cps->ViewTransaction($req);
                            $status=$result['result']['status'];
                            if($status>=100 || $status==2){
                                $user->balance=$user->balance + $val->amount - $val->charge;
                                $user->update();
                                $val->status = 1;
                                $val->update();            
                            }elseif($status<0){
                                $val->status = 2;
                                $val->update();
                            }
                        }
                    } 
                //        
                $p_transfer=Transfer::where('Receiver_id', Auth::guard('user')->user()->id)->where('status',0)->orWhere('Temp', Auth::guard('user')->user()->email)->get();
                $p_request=Requests::where('email', Auth::guard('user')->user()->email)->wherestatus(0)->get();
                $view->with('p_transfer', $p_transfer );
                $view->with('p_request', $p_request );
                $view->with('user', $user );
                $view->with('cast', $cast );
            }
            //Failed Transfer Claim
            foreach($transfer as $val){
                $set=Settings::first();
                $date1=Carbon::now();
                $date2=Carbon::parse($val->created_at);
                $check=$date1->diffInDays($date2);
                if($check==5 || $check>5){
                    $sender=User::whereid($val->sender_id)->first();
                    $sender->balance=$val->amount+$sender->balance;
                    $sender->save();
                    $val->status=2;
                    $val->save();
                    if($set->email_notify==1){
                        send_transferrefund($sender->ref_id);
                    } 
                }
            }  
            //Subscription Management
            foreach($sub as $val){
                $user=User::find($val->user_id);
                $link=Plans::whereid($val->plan_id)->first();
                $receiver=User::whereid($link->user_id)->first();
                $set=Settings::first();
                if($user->balance>$val->amount || $user->balance==$val->amount){
                    $user->balance=$user->balance-$val->amount;
                    $user->save();        
                    $receiver->balance=$receiver->balance+(($val->amount)-($val->amount*$set->subscription_charge/100));
                    $receiver->save();
                    //Audit log
                    $audit['user_id']=$user->id;
                    $audit['trx']=str_random(16);
                    $audit['log']='Payment for subscription #'.$link->ref_id.' - '.$link->name.' was successful';
                    Audit::create($audit);                
                    $audit['user_id']=$receiver->id;
                    $audit['trx']=str_random(16);
                    $audit['log']='Received payment for subscription #'.$link->ref_id.' - '.$link->name.' was successful';
                    Audit::create($audit);
                    //Charges
                    $chargea['user_id']=$receiver->id;
                    $chargea['ref_id']=str_random(16);
                    $chargea['amount']=$val->amount*$set->subscription_charge/100;
                    $chargea['log']='Received payment for subscription #'.$link->ref_id.' - '.$link->name.' was successful';
                    Charges::create($chargea);
                    //Change status to successful
                    $change=Subscribers::whereuser_id($user->id)->whereplan_id($val->plan_id)->first();
                    $change->charge=$val->amount*$set->subscription_charge/100;
                    $dt = Carbon::create($change->expiring_date);
                    $dt->add($change->plan['intervals']);   
                    $change->expiring_date=$dt;
                    $change->times=$change->times-1;
                    $change->save(); 
                    //Notify users
                    if($set->email_notify==1){
                        new_subscription($link->ref_id, 'account', $change->ref_id);
                    } 
                }else{
                    //Notify users
                    if($set->email_notify==1 && $val->notify==1){
                        $ffg=Subscribers::whereuser_id($user->id)->whereplan_id($val->plan_id)->first();
                        insufficient_balance($link->ref_id, 'account', $ffg->ref_id);
                    } 
                }
            }
            $pticket=Ticket::where('status', 0)->get();
            $pdeposit=Deposits::where('status', 0)->get();
            $pbank=Banktransfer::where('status', 0)->get();
            $pwithdraw=Withdraw::where('status', 0)->get();
            $view->with('pticket', $pticket );
            $view->with('pwithdraw', $pwithdraw );
            $view->with('pdeposit', $pdeposit );
            $view->with('pbank', $pbank );
            $view->with('stripe', $stripe );
            $view->with('paystack', $paystack );
            $view->with('btc', $btc );
            $view->with('eth', $eth );
            $view->with('currency', $currency );
        });
        $data['set']=Settings::first();
        $data['blog']=Blog::whereStatus(1)->get();
        $data['logo']=Logo::first();
        $data['social']=Social::all();
        $data['faq']=Faq::all();
        $data['cat']=Category::all();
        $data['pages']=Page::whereStatus(1)->get();
        $data['ui']=Design::first();
        $data['about']=About::first();
        $data['trending'] = Blog::whereStatus(1)->orderBy('views', 'DESC')->limit(5)->get();
        $data['posts'] = Blog::whereStatus(1)->orderBy('views', 'DESC')->limit(5)->get();
        $data['review'] = Review::whereStatus(1)->get();
        $data['item'] = Services::all();
        $data['item4'] = Services::whereId(4)->first();
        $data['brand'] = Brands::whereStatus(1)->get();
        $data['branch'] = Branch::all();
        $data['xfaq']=Faq::first();

        
        view::share($data);
    }
}
