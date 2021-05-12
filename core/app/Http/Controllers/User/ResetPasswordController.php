<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use DB;
use Session;
use App\Models\PasswordReset;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/login';

    public function showResetForm(Request $request, $token)
    {
        // echo("hello"); die;
        $data['title'] = "Change Password";
         $tk =PasswordReset::where('token',$token)->first();
         if(is_null($tk))
         {
            $notification =  array('message' => 'Token Not Found!!','alert-type' => 'warning');
            return redirect()->route('user.password.request')->with($notification);
         }else{
            $email = $tk->email;
            return view('auth.passwords.reset',$data)->with(
                ['token' => $token, 'email' => $email]
            );
         }
    }


    public function reset(Request $request)
    {
        //  print_r($request->all());die;
        // $this->validate($request, $this->rules(), $this->validationErrorMessages());
        
        $tk =PasswordReset::where('token',$request->token)->first();
        
       
        $user = User::whereEmail($tk->email)->first();
        if(!$user)
        {
            return back()->with('warning', 'Email don\'t match!!');
        }
        $user->password = bcrypt($request->password);
        $user->save();
        // return back()->with('success', 'Successfully Password Reset.');
        
        return redirect('login')->with('success', 'Successfully Password Reset.');
    }
    
        public function checkUserMobile(Request $request)
    { 
        $validator = Validator::make($request->all(), [
           
            'phone' => 'required|min:10|unique:users|regex:/^\S*$/u',
           ]);
       // $checkhandleSileApiResult = app('App\Http\Controllers\SilaController')->checkHandle($request->username);   
        if ($validator->fails()) {
            Session::put('phone_no',$request->phone);
            Session::put('country_code',$request->country_code);
            return response()->json(['result'=>'0','response'=>$validator->messages()], 400);
        }  else {
             return response()->json(['result'=>'1','response'=>'Available.'], 200);
        }
    }
    
    public function resetbyPhone()
    { 
        if(!empty(Session::get('phone_no')))
        {
            $user = DB::table('users')->where('phone',Session::get('phone_no'))->first();
            //$to =$user->email;
            //$name = $user->name;
            //$subject = 'Password Reset';
            $code = str_random(30);
            //$link = url('/user-password/').'/reset/'.$code;
            //$message = "Use This Link to Reset Password: <br>";
            //$message .= "<a href='$link'>".$link."</a>";
            DB::table('password_resets')->insert(
                ['email' => $user->email, 'token' => $code,  'created_at' => date("Y-m-d h:i:s")]
            );
            $data['token'] = $code;
           $data['title'] = "Set New password";
           return view('auth.passwords.reset_by_mobile',$data);
        } else {
            return back()->with('alert', 'Phone don\'t match!!');
        }
    }
    
    public function resetby_Phone(Request $request)
    {
        $tk =PasswordReset::where('token',$request->token)->first();
        
       
        $user = DB::table('users')->where('phone',$tk->phone);//User::whereEmail($tk->phone)->first();
        if(!$user)
        {
            return back()->with('warning', 'Phone don\'t match!!');
        }
        $user->password = bcrypt($request->password);
        $user->save();
        // return back()->with('success', 'Successfully Password Reset.');
        
        return redirect('login')->with('success', 'Successfully Password Reset.');
    }
}
