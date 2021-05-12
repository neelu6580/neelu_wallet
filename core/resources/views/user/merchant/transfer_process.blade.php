@extends('paymentlayout')

@section('content')
<div class="main-content payment">
    <div class="header py-7 py-lg-5 pt-lg-1">
        <div class="container">
            <div class="header-body text-center mb-7">

            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5 mb-0">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="accordion" id="accordionExample">
                    <div class="card bg-white border-0 mb-0">
                        <div class="card-header" id="headingOne">
                            <div class="text-left" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            <h4 class="mb-0">Card</h4>
                            </div>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="row justify-content-between align-items-center mb-3">
                                    <div class="col-8">
                                        <span class="form-text text-xl">{{$currency->symbol}} {{number_format($link->amount)}}</span>
                                    </div>
                                </div>
                                <form action="{{ route('pay.merchant')}}" role="form" method="post" class="require-validation" data-cc-on-file="true" data-stripe-publishable-key="{{$stripe->val1}}" id="payment-form">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-xs-12 col-md-12 form-group required">
                                            <input type="number" class="form-control input-lg custom-input" name="cardNumber" placeholder="Valid Card Number" min="16" autocomplete="off" required autofocus size="20"/>
                                        </div>                                  
                                        <div class="col-xs-12 col-md-12 form-group required">
                                            <input type="email" class="form-control input-lg custom-input" name="email" placeholder="Email Address" autocomplete="off" required autofocus/>
                                        </div>
                                        <div class="col form-group required">
                                            <input type="text" class="form-control input-lg custom-input" name="first_name" placeholder="First Name" autocomplete="off" required autofocus/>
                                        </div>                                  
                                        <div class="col form-group required">
                                            <input type="text" class="form-control input-lg custom-input" name="last_name" placeholder="Last Name" autocomplete="off" required autofocus/>
                                        </div>
                                    </div> 
                                    <div class='form-group row'>
                                        <div class='col form-group cvc'>
                                            <input autocomplete='off' class='form-control card-cvc' name="cardCVC" placeholder='CVC' type='text' maxlength="3" required>
                                        </div>
                                        <div class='col form-group expiration required'>
                                            <input class='form-control card-expiry-month' name="cardM" placeholder='MM' maxlength='2' type='text'>
                                        </div>
                                        <div class='col form-group expiration required'>
                                            <input class='form-control card-expiry-year' name="cardY" placeholder='YYYY' maxlength='4'type='text'>
                                        </div>
                                    </div>			
                                    <input type="hidden" value="card" name="type"> 
                                    <input type="hidden" name="amount" value="{{number_format($link->amount)}}">
                                    <input type="hidden" value="{{$link->reference}}" name="link"> 	                
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success btn-sm">{{__('Pay')}}</button><br>
                                        <img src="{{url('/')}}/asset/payment_gateways/creditcard.png" style="height:auto;  max-width:40%;">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--Account Balance-->
                        <hr>
                        <div class="card-header" id="headingTwo">
                            <div class="text-left collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <h4 class="mb-0">Pay with Account</h4>
                            </div>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body text-center">
                            @if (Auth::guard('user')->check())
                                <form method="post" role="form" action="{{route('pay.merchant')}}">
                                @csrf
                                <h4 class="mb-0">Account Balance</h4>
                                <h1 class="mb-1 text-muted">{{$currency->symbol.number_format($user->balance)}}</h1>
                                <input type="hidden" value="account" name="type">
                                <input type="hidden" value="{{$link->reference}}" name="link">
                                <input type="hidden" name="amount" value="{{$link->amount}}">
                                <div class="text-center">
                                    <button type="submit" onclick="second_modal()" class="btn btn-neutral btn-sm">Pay now</button>
                                </div>
                                </form>
                            @else
                                <h3 class="mb-3 text-muted">Login to Complete Transfer</h3>
                                <a href="{{route('login')}}" class="btn btn-neutral btn-sm">Login</a>
                            @endif
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            <div class="col-md-4">
                <div class="card">
                    <img class="card-img-top" src="{{url('/')}}/asset/profile/{{$boom->image}}" alt="Image placeholder">
                    <div class="card-body">
                        <h5 class="h2 card-title mb-0">{{$boom->name}}</h5>
                        <small class="text-muted">by {{$merchant->business_name}} on {{date("h:i:A j, M Y", strtotime($link->created_at))}}</small>
                        <p class="mb-0 text-sm">{{$link->description}}</p>
                        <div class="text-left">
                        <p class="paragraph small">If you have any questions, contact
                            <a href="mailto:{{$merchant->email}}">{{$merchant->email}}</a>
                        </p>
                        </div>
                        <div class="text-left">
                            @if($merchant->facebook!=null)
                                <a href="{{$merchant->facebook}}"><i class="sn fab fa-facebook"></i></a>   
                            @endif 
                            @if($merchant->twitter!=null)                      
                                <a href="{{$merchant->twitter}}"><i class="sn fab fa-twitter"></i></a>
                            @endif      
                            @if($merchant->linkedin!=null)                     
                                <a href="{{$merchant->linkedin}}"><i class="sn fab fa-linkedin"></i></a> 
                            @endif     
                            @if($merchant->instagram!=null)                        
                                <a href="{{$merchant->instagram}}"><i class="sn fab fa-instagram"></i></a>   
                            @endif 
                            @if($merchant->youtube!=null)                          
                                <a href="{{$merchant->youtube}}"><i class="sn fab fa-youtube"></i></a>  
                            @endif                           
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop