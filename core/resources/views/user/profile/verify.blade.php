@extends('loginlayout')

@section('content')
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



</head>
<div class="main-content">
    <!-- Header -->
    <div class="header py-7 py-lg-8 pt-lg-9 bg-future">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
               <div class="progress1">
    <div class="progress-bar1" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width:34%">
      <span class="sr-only">33% Complete</span>
     Step 1 > Create an account
    </div>
    <div class="progress-bar1" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width:33%">
      <span class="sr-only">33% Complete</span>
     Step 2 > Mobile Verification
    </div>
    <!--<div class="progress-bar2" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:25%">-->
    <!--  <span class="sr-only">0% Complete</span>-->
    <!--Step 3 > Add Bank Account-->
    <!--</div>-->
    <div class="progress-bar2" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:33%">
      <span class="sr-only">0% Complete</span>
     Step 3 > Create Physical/Digital Products
    </div>
  </div>
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-dark">
                @if(Auth::guard('user')->user()->status == 1 )
                  {{__('Account has been blocked')}}
                @else
                  {{__('Mobile verification')}}
                @endif
              </h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5 mb-0">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">

          <!--div class="card card-profile bg-white border-0 mb-5">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <img src="{{url('/')}}/asset/profile/{{$cast}}" class="rounded-circle border-secondary">
                </div>
              </div>
            </div>
            <div class="card-body pt-7 px-5">
                
              <div class="text-center text-dark mb-5">
                <small>{{__('We have sent you 6 digit of verification code on your email id')}}, <span class="text-muted"><a href="{{route('user.send-emailVcode')}}">{{__('Resend email')}}</a></span></small>
              </div>
              <form role="form" action="{{ route('user.email-verify')}}" method="post">
                @csrf
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input type="hidden"  name="id" value="{{Auth::guard('user')->user()->id}}">
                    <input class="form-control" placeholder="{{ __('Code') }}" type="text" name="email_code" required>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-success my-4">{{__('Verify')}}</button>
                </div>
              </form>
            </div>
          </div-->
           <div class="card card-profile bg-white border-0 mb-5">
               
             
                <div class="text-center text-dark mb-5">
                <center><p><small>{{__('Please Verify Captcha')}}</small></p></center>
              </div>
               <div class="card-body" style="margin-bottom: 70px;">
              <center><div id="recaptcha-container222" ></div></center>
              </div>
               
               
           </div>
           <br>
        </div>
      </div>
    </div>
     <div class="modal fade" id="after_register" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                  <div class="modal-content">
                    <div class="modal-body p-0">
                      <div class="card border-0 mb-0">
                        <div class="card-body px-lg-5 py-lg-5">
                          
                            <div class="text-left">
                                
                            </div>    
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> 
<div class="modal fade" id="after_register_model2" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true" style="background:#333;">
                <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                  <div class="modal-content">
                    <div class="modal-body p-0">
                      <div class="card border-0 mb-0">
                        <div class="card-body px-lg-5 py-lg-5">
                         
                            <div class="text-center">
                                <h3>OTP Verification</h3> 
                            <span style="color:red;" id="verify_otp_error_result"></span><br>
                            <input type="text" name="" id="inputOtp" class="form-control" placeholder="Enter Mobile OTP Here" required maxlength="6"> 
                            <p id="hide_countDownTimer_idd" style="font-size:10px">&nbsp;&nbsp;Resend OTP After: <b><span id="SecondsUntilExpire"></span></b></p>

                            <br>
                            <button class="btn btn-success" onclick="VerifyTOPSubmit()">Verify OTP</button>
                            <a href="{{$_SERVER['REQUEST_URI']}}" class="btn btn-primary" id="resend_otp_button_idd" style="display:none">Resend OTP Now</a>
                            
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
 <form action="{{ route('user.mobile-verify')}}" method="POST" id="submit_form_idd">
     @csrf
     <input type="hidden" value="{{$email_code}}" name="email_code">
      <input type="hidden" value="" id="mobile_token_id" name="mobile_token">
     
</form>                  
<!--FIREBASE SETTING-->

<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-app.js"></script>

<script src="https://www.gstatic.com/firebasejs/7.19.0/firebase-analytics.js"></script>
<script defer src="https://www.gstatic.com/firebasejs/7.19.0/firebase-auth.js"></script>                 
    <script>
 $(document).ready(function(){
//FOR INDIVIDUAL USER POPUP MODEL VALIDATION     
$("#after_register,#after_register_model2,#after_register_model2_error").modal({
show:false,
backdrop:'static'});
//FOR BUSINESS USER POPUP MODEL VALIDATION     
$("#OTP_CaptchaModelID,#OTP_VerifyModelID,#after_register_modelbusi_error").modal({
show:false,
backdrop:'static'});
    
});   
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  var firebaseConfig = {
  apiKey: "AIzaSyC6Lv7OHLKcpMzOC4Fq0rUyoGcdP6LK7TY",
  authDomain: "achcuminup.firebaseapp.com",
  projectId: "achcuminup",
  storageBucket: "achcuminup.appspot.com",
  messagingSenderId: "7924668898",
  appId: "1:7924668898:web:30a0dbdf03a89d145cc1bb",
  measurementId: "G-B9Q3F73QGK"
};
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();

   //var verifyotp=document.getElementById("verifyotp");

$( document ).ready(function() {
   
          var str1 = "+";
                       //alert(document.getElementById("indi_countryCallingCode").value);
                      
                    //$('#after_register').modal('show');
                    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container222', {
                        'size': 'normal',
                        'callback': function(response) { 
                            
                        },
                        'expired-callback': function() {
                        }
                        });
                         $('#after_register').modal('hide');
                        var cverify=window.recaptchaVerifier;
                        var phoneinput;
                             phoneinput = "{{'+'}}{{$user_phone_calling_code}}{{$user_phone}}";
                        firebase.auth().signInWithPhoneNumber(phoneinput,cverify).then(function(response){
                           
                        $('#after_register_model2').modal('show');
                        TimerStartFunction();
                        console.log('Result'+response);
                        window.confirmationResult=response;
                        }).catch(function(error){
                            console.log(error.message);
                            $('#after_register').modal('hide');
                            $('#after_register_model2_error').modal('show');
                           
                           
                        })
    
   
  }); 
    function VerifyTOPSubmit(){ 
      var otpinput=document.getElementById("inputOtp");
      if(otpinput.value.length == 0)
      {
       $('#verify_otp_error_result').html('Please enter your OTP here!');
      }
               confirmationResult.confirm(otpinput.value).then(function(response){
                   //$('#after_register').modal('hide');
                   $('#after_register_model2').modal('hide');
                   var userobj=response.user;
                    var token=userobj.xa;
                    
                    $('#mobile_token_id').val(token);
                   $('#submit_form_idd').submit();
                   //location.href = 'https://cuminup.com/user-password/reset-byphone';

                  // $('#inputPhone_individual').prop('readonly', true);
                    //$('#individual_submit').removeAttr('disabled');
                    //$('#indi_SENDOTPSUBMITbutton').prop('disabled', true);
                   // $('#verify_otp_success_result').html('OTP has been verified successfylly.');
                  // console.log(response);
                 
                 
                    var userobj=response.user;
                    var token=userobj.xa;
                    var provider="phone";
                   var email=phoneinput.value;
                    if(token!=null && token!=undefined && token!=""){
                    //sendDatatoServerPhp(email,provider,token,email);
                    }
               })
               .catch(function(error){
                   $('#verify_otp_error_result').html('Sorry your have entered wrong otp!');
                   console.log(error);
               })
           }
    </script>
<script>
//FOR SESSION
function TimerStartFunction()
{
    var IDLE_TIMEOUT = 120; //seconds
    var _idleSecondsTimer = 0;
    var _idleSecondsCounter = 0;
    
    document.onclick = function() {
       // _idleSecondsCounter = 0;
    };
    
    document.onmousemove = function() {
       // _idleSecondsCounter = 0;
    };
    
    document.onkeypress = function() {
       // _idleSecondsCounter = 0;
    };
    
    _idleSecondsTimer = window.setInterval(CheckIdleTime, 1000);
    
    function CheckIdleTime() {
         _idleSecondsCounter++;
         var oPanel = document.getElementById("SecondsUntilExpire");
         if (oPanel)
             oPanel.innerHTML = (IDLE_TIMEOUT - _idleSecondsCounter) + "";
        if (_idleSecondsCounter >= IDLE_TIMEOUT) {
            $('#hide_countDownTimer_idd').hide();
            $('#resend_otp_button_idd').show();
            //window.clearInterval(_idleSecondsTimer);
            //document.location.href = "@php echo url('/user/logout'); @endphp";
           // alert("Time expired!");
          // $('#modal-formx_sessionlogout').modal('show');
         /*   if(confirm('Are you sure do you still want to stay here?')){ 
               
                document.location.href = "@php echo $_SERVER['REQUEST_URI']; @endphp";
            } else { 
                
                
                //document.getElementById('id01').style.display='block'
              
              // document.location.href = "@php echo url('/user/logout'); @endphp";
                //document.location.href = "@php echo url('/login'); @endphp";
            }
            */
            
        } else if(_idleSecondsCounter == '170') {
            //$('#modal-formx_sessionlogout').modal('show');
        }
    }
}
</script>    
 
@stop