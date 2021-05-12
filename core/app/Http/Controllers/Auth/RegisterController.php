<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Settings;
use App\Models\Audit;
use App\Models\Referral;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use DB;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:user');
    }

    public function register(Request $request)
    {
        // echo request()->headers->get('referer');
        
        // if(isset($_SERVER['HTTP_REFERER']))
        // {
        //     $allowed_host = 'cuminup.com';
        //     $host = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST);
        
        //     if(substr($host, 0 - strlen($allowed_host)) == $allowed_host) {
        //       echo "yes";
        //     } else {
        //       echo "no";
        //     }
        // }
        // die('helo');
        $data['title']='Register';
        return view('/auth/register', $data);
    }    
    
    public function submitregister(Request $request)
    {
        $set=Settings::first();
        if($set->recaptcha==1){
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'business_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                 'phone' => 'required|unique:users',
                'password' => 'required|string|min:6',
                'g-recaptcha-response' => 'required|captcha'
            ]);        
        }else{
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'business_name' => 'required|string|max:255',
                'phone' => 'required|unique:users',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ]);
        }
        if ($validator->fails()) {
            // adding an extra field 'error'...
            $data['title']='Register';
            $data['errors']=$validator->errors();
            return view('/auth/register', $data);
        }

        $basic = Settings::first();

        if ($basic->email_verification == 1) {
            $email_verify = 0;
        } else {
            $email_verify = 1;
        }

        if ($basic->sms_verification == 1) {
            $phone_verify = 1;
        } else {
            $phone_verify = 1;
        }
        $verification_code = strtoupper(Str::random(6));
        $sms_code = strtoupper(Str::random(6));
        $email_time = Carbon::parse()->addMinutes(5);
        $phone_time = Carbon::parse()->addMinutes(5);
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->business_name = $request->business_name;
        $user->email = $request->email;
        $user->email_verify = $email_verify;
        $user->image = 'person.jpg';
        $user->verification_code = $verification_code;
        $user->email_time = $email_time;
        $user->balance = $basic->balance_reg;
        $user->ip_address = user_ip();
        $user->password = Hash::make($request->password);
        
        if($request->prefix)
        {
            $getdtls = DB::table('countries')->where('id',$request->prefix)->first();
        }
        $user->prefix = $getdtls->calling_code;
        $user->phone_iso = $getdtls->iso_code;
        $user->phone = $request->phone;
        $user->source_from = $request->source_from;
        $user->business_country = $request->business_country;
        
        $user->save();


        if ($basic->email_verification == 1) {
            //$text = "Before you can start accepting payments, you need to confirm your email address. Your email verification code is ".$user->verification_code;
            //send_email($user->email, $user->business_name, 'Hello '.$request->business_name, $text);
            send_email($user->email, $user->business_name, 'Welcome to '.$basic->site_name, 'We are excited to have you on board!, It’s our duty to make your experience smooth and convenient.');
        }

        if (Auth::guard('user')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {

            return redirect()->route('user.profile');
        }
    }    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
