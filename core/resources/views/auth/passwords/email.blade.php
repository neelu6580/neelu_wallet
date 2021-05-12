@extends('loginlayout')
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



</head>
  
  
@section('content')
   
<div class="main-content">
    <!-- Header -->
    <div class="header bg-future py-7 py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-dark">{{__('Reset password')}}</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
          
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-header bg-transparent pb-3">
            </div>
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-dark mb-5">
                <small>{{__('Still cannot Remember')}}</small>
              </div>
              <script>
// Add active class to the current button (highlight it)
var header = document.getElementById("nav-tabs");
var btns = header.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("active");
  current[0].className = current[0].className.replace(" active", "");
  this.className += " active";
  });
}
</script>
<style>
    <style>
/* Style the buttons */
.btn {
  border: none;
  outline: none;
  padding: 10px 16px;
  background-color: #f1f1f1;
  cursor: pointer;
  font-size: 18px;
}

/* Style the active class, and buttons on mouse-over */
.active, .btn:hover {
  background-color: #666;
  color: white;
}

.form-error-msg{
                color:red;
            }
</style>
</style>
              
              <ul class="nav nav-tabs login-mobile-rep" style="padding-bottom: 10px;">
              <li><button class="btn active login-btn " data-toggle="tab" href="#emailtab">Login By Email</button></li>
              <p style="text-align:center; margin-bottom: 5px; margin-top: 5px;">Or</p>
              <li><button class="btn btn2 login-btn " data-toggle="tab" href="#phonetab">Login By Phone</button></li>
            </ul>
            <div class="tab-content">
             
              <div id="emailtab" class="tab-pane active " style="    background: #f7fafc;">
              <form role="form" action="{{route('user.password.email')}}" method="post">
                @csrf
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="{{ __('Email') }}" type="email" name="email" required>
                  </div>
                </div>
               
                
                <div class="text-center">
                  <button type="submit" class="btn btn-success my-4">{{__('Reset')}}</button>
                </div>
              </form>
            </div>
            
            <div id="phonetab" class="tab-pane fade in show" style="    background: #f7fafc;">
             
                
                 <div class="form-group row">
                  <div class="col-lg-12">
                    <div class="row">
                        <div class="col-5">
                          <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                              <span class="input-group-text text-future"><i class="fa fa-flag"></i></span>
                            </div>
                            <?php $countries =DB::table('countries')->orderby('name','ASC')->get(); ?>
                            <select class="form-control" name="prefix" id="indi_countryCallingCode">
                                <option value="">Select Country Code</option>
                                <?php foreach($countries as $country){?>
                                <option value="<?=$country->calling_code?>" <?=($country->iso_code =='IN') ? 'selected' : ''?>>{{$country->name}} {{'('}}{{'+'}}{{$country->calling_code}}{{')'}}</option>
                                <?php }?>
                            </select>
                          </div>
                        </div>      
                        <div class="col-7">
                          <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                              <span class="input-group-text text-future"><i class="fa fa-phone"></i></span>
                            </div>
                            <input class="form-control" placeholder="{{__('Phone Number')}}" type="text" maxlength="13" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" name="phone" required id="inputPhone_individual">
                          
                          </div>
                          
                        </div>
                        <span id="phone_err22" style="color:red;margin-left:12px;"></span>
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-success my-4" onclick="clickindividualSUbmitButton()">{{__('Submit')}}</button>
                </div>
             
            </div>
            
            </div>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="{{route('login')}}" class="text-dark"><small>{{__('Login')}}</small></a>
            </div>
            <div class="col-6 text-right">
              <a href="{{route('register')}}" class="text-dark"><small>{{__('Create an account')}}</small></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="after_register" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                  <div class="modal-content">
                    <div class="modal-body p-0">
                      <div class="card border-0 mb-0">
                        <div class="card-body px-lg-5 py-lg-5">
                          <div id="recaptcha-container222"></div>
                            <div class="text-left">
                                
                            </div>    
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> 
<div class="modal fade" id="after_register_model2" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true" style="background-color: #333;">
                <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                  <div class="modal-content">
                    <div class="modal-body p-0">
                      <div class="card border-0 mb-0">
                        <div class="card-body px-lg-5 py-lg-5">
                         
                            <div class="text-center">
                                <h3>OTP Verification</h3> 
                            <span style="color:red;" id="verify_otp_error_result"></span><br>
                            <input type="text" name="" id="inputOtp" class="form-control" placeholder="Enter Mobile OTP Here" required maxlength="6"> 
                          <p id="hide_countDownTimer_idd" style="font-size:10px">&nbsp;&nbsp;Resend OTP After: <b><span id="SecondsUntilExpire"></span> Second</b></p>

                            <br>
                            <button class="btn btn-success" onclick="VerifyTOPSubmit()">Verify OTP</button>
                            <a href="{{$_SERVER['REQUEST_URI']}}?resend=1" class="btn btn-primary" id="resend_otp_button_idd" style="display:none">Resend OTP Now</a>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
<div class="modal fade" id="after_register_model2_error" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                  <div class="modal-content">
                    <div class="modal-body p-0">
                      <div class="card border-0 mb-0">
                        <div class="card-body px-lg-5 py-lg-5">
                         
                            <div class="text-center">
                                <h5 style="color:red">Sorry your phone number format is incorrect!</h5> 
                            <span style="color:red;" id="verify_otp_error_result"></span><br>
                           
                            
                            <a href="{{url('user-password/reset')}}" class="btn btn-primary">Try Again!!</a>
                            
                            
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>  
       
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
var phoneinput;
     phoneinput = document.getElementById("inputPhone_individual");
   //var verifyotp=document.getElementById("verifyotp");

function clickindividualSUbmitButton() {
      var str2 = "+";
   //alert(document.getElementById("indi_countryCallingCode").value);
    var callingCode2 = document.getElementById("indi_countryCallingCode");
    var plusCallingCode2 = str2.concat(callingCode2.value);
    //CHECK MOBILE IS EXIST
    let _token   = $('meta[name="csrf-token"]').attr('content');
        if(phoneinput!='')
        { 
            $.ajax({
                url: "{{url('/check_usermobile')}}",
                method: "POST",
                data: {phone:phoneinput.value,country_code:plusCallingCode2,_token:_token},
                success: function(data) { 
                   
                    console.log(data.result);
                    if(data.result == '1')
                    {
                        $("#phone_err22").html('Sorry, Phone number is not exist!');
                        //$('#individual_submit').prop('disabled', true);
                        //$("#indi_SENDOTPSUBMITbutton").prop('disabled', false);
                        //$('#phone_err22').hide();
                       
                    }
                },
                error:function(err){
                     //$("#indi_SENDOTPSUBMITbutton").prop('disabled', true);
                    //$("#business_submit").prop('disabled', true);
                    //$('#phone_err22').show();
                    console.log(err.responseJSON.response.phone[0]);
                    //SEND OTP Via Firebase
                    
                       var str1 = "+";
                       //alert(document.getElementById("indi_countryCallingCode").value);
                        var callingCode = document.getElementById("indi_countryCallingCode");
                        var plusCallingCode = str1.concat(callingCode.value);
                    $('#after_register').modal('show');
                    TimerStartFunction();
                    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container222', {
                        'size': 'normal',
                        'callback': function(response) { 
                            
                        },
                        'expired-callback': function() {
                        }
                        });
                        
                         $('#after_register').modal('hide');
                         
                        var cverify=window.recaptchaVerifier;
                        
                        firebase.auth().signInWithPhoneNumber(plusCallingCode.concat(phoneinput.value),cverify).then(function(response){
                           
                        $('#after_register_model2').modal('show');
                        console.log('Result'+response);
                        window.confirmationResult=response;
                        }).catch(function(error){
                            console.log(error.message);
                            $('#after_register').modal('hide');
                            $('#after_register_model2_error').modal('show');
                           
                           
                        })
                        
                }
            });
        }
    
   }
   
$(document).ready(function(){ 
    var sPageURL = window.location.search.substring(1);
    if(sPageURL== 'resend=1')
    {
         $('#after_register_model2').modal('hide');
          resendFunction();
    }
   
});     
   function resendFunction() {
  
                     //$("#indi_SENDOTPSUBMITbutton").prop('disabled', true);
                    //$("#business_submit").prop('disabled', true);
                    //$('#phone_err22').show();
                   
                    //SEND OTP Via Firebase
                    
                       
                    $('#after_register').modal('show');
                    TimerStartFunction();
                    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container222', {
                        'size': 'normal',
                        'callback': function(response) { 
                            
                        },
                        'expired-callback': function() {
                        }
                        });
                        
                         $('#after_register').modal('hide');
                         
                        var cverify=window.recaptchaVerifier;
                       var sess_phone_input = "{{Session::get('country_code')}}{{Session::get('phone_no')}}";
                        firebase.auth().signInWithPhoneNumber(sess_phone_input,cverify).then(function(response){
                           
                        $('#after_register_model2').modal('show');
                        console.log('Result'+response);
                        window.confirmationResult=response;
                        }).catch(function(error){
                            console.log(error.message);
                            $('#after_register').modal('hide');
                            $('#after_register_model2_error').modal('show');
                           
                           
                        })
                        
                }
            
    
   
   
    function VerifyTOPSubmit(){ 
      var otpinput=document.getElementById("inputOtp");
      if(otpinput.value.length == 0)
      {
       $('#verify_otp_error_result').html('Please enter your OTP here!');
      }
               confirmationResult.confirm(otpinput.value).then(function(response){
                   $('#after_register').modal('hide');
                   $('#after_register_model2').modal('hide');
                   location.href = '{{url('/')}}/user-password/reset-byphone';

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
                   $('#verify_otp_error_result').html('Sorry your OTP is not Matched!');
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