@extends('paymentlayout')

@section('content')

<div class="main-content payment">
    <!-- Header -->
    <div class="header py-7 py-lg-5 pt-lg-1">
      <div class="container">
        <div class="header-body text-center mb-7">

        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5 mb-0">
      <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <img class="card-img-top" src="{{url('/')}}/asset/profile/{{$link->image}}" alt="Image placeholder">
                <div class="card-body">
                    <h5 class="h2 card-title mb-0">Fundraiser for {{$link->name}}</h5>
                    <small class="text-muted">by {{$merchant->business_name}} on {{date("h:i:A j, M Y", strtotime($link->created_at))}}</small>
                    <a href="#" data-toggle="modal" data-target="#donation-details" class="btn btn-link px-0">Read more</a>
                    <div class="modal fade" id="donation-details" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                        <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <div class="card bg-white border-0 mb-0">
                                        <div class="card-header">
                                            <h3 class="mb-0">{{$link->name}}</h3>
                                        </div>
                                        <div class="card-body px-lg-5 py-lg-5 text-left">
                                            <p class="mb-0">{!!$link->description!!}</p>
                                            <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
        <div class="col-md-8">
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-5" role="alert">
                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                    @foreach($errors->all() as $error)
                    <span class="alert-text">{{$error}}</span>
                    @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
          <div class="card card-profile bg-white border-0 mb-5">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <img src="{{url('/')}}/asset/profile/{{$merchant->image}}" class="rounded-circle border-secondary">
                </div>
              </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-between align-items-center mb-3">
                    <div class="col-8">
                        <span class="form-text text-xl">{{$currency->symbol}} {{number_format($link->amount)}} Goal</span>
                    </div>
                    <div class="col-4 text-right">  
                        @if($donated<$link->amount)               
                            <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#donation-page">Donate Now</a>
                        @endif
                    </div>
                    <div class="modal fade" id="donation-page" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                        <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <div class="card bg-white border-0 mb-0">
                                    <div class="card-header">
                                        <h3 class="mb-0">{{__('Contribute to this project')}}</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{route('send.donation')}}" method="post" id="modal-details">
                                        @csrf
                                            <div class="form-group row">
                                                <label class="col-form-label col-lg-12">{{__('Amount')}}</label>
                                                <div class="col-lg-12">
                                                    <div class="input-group">
                                                        <span class="input-group-prepend">
                                                            <span class="input-group-text">{{$currency->symbol}}</span>
                                                        </span>
                                                        <input type="number" class="form-control" name="amount" id="xx" placeholder="0.00" required>
                                                        <span class="input-group-append">
                                                            <span class="input-group-text">.00</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>  
                                            <div class="form-group row">
                                                <label class="col-form-label col-lg-4">{{__('Donate as')}}</label>
                                                <div class="col-lg-8">
                                                    <select class="form-control select" name="status" id="xstatus" onchange="mystatus()" required>
                                                        <option value="1">{{__('Anonymous')}}
                                                        </option>
                                                        <option value="0">{{__('Display name')}}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <input type="hidden" value="{{$link->ref_id}}" name="link">  
                                            <div class="modal fade" id="fund" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                                <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body p-0">
                                                        <div class="accordion" id="accordionExample">
                                                            <div class="card bg-white border-0 mb-0">
                                                                <!--Pay with Card-->
                                                                <div class="card-header" id="headingOne">
                                                                    <div class="text-left" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                    <h4 class="mb-0">Card</h4>
                                                                    </div>
                                                                </div>
                                                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                                    <div class="card-body">
                                                                    <form action="{{ route('send.donation')}}" role="form" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{$stripe->val1}}" id="payment-form">
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
                                                                        <div class="text-center">
                                                                        <button type="submit" class="btn btn-success btn-sm" form="modal-details">{{__('Pay')}} <span id="cardresult"></span></button><br>
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
                                                                        <form method="post" role="form" action="{{route('send.donation')}}">
                                                                        @csrf
                                                                        <h4 class="mb-0">Account Balance</h4>
                                                                        <h1 class="mb-1 text-muted">{{$currency->symbol.number_format($user->balance)}}</h1>
                                                                        <input type="hidden" value="account" name="type">
                                                                        <input type="hidden" value="{{$link->ref_id}}" name="link">
                                                                        <input type="hidden" name="amount" id="castro">
                                                                        <input type="hidden" name="status" id="boom" value="1">
                                                                        <div class="text-center">
                                                                            <button type="submit" onclick="second_modal()" class="btn btn-neutral btn-sm">Pay now</button>
                                                                        </div>
                                                                        </form>
                                                                    @else
                                                                    @php
                                                                    Session::put('oldLink', url()->current());
                                                                    @endphp
                                                                        <h3 class="mb-3 text-muted">Login to Complete Transfer</h3>
                                                                        <a href="{{route('login')}}" class="btn btn-neutral btn-sm">Login</a>
                                                                    @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                            <button type="button" data-toggle="modal" data-target="#fund" class="btn btn-success btn-sm">{{__('Pay')}}</button>
                                            </div>         
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
                <div class="row justify-content-between align-items-center">
                    <div class="col">
                        <div class="progress progress-xs mb-0">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{($donated*100)/$link->amount}}%;"></div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between align-items-center mb-3">
                    <div class="col-8">
                        <span class="form-text text-md text-dark">{{$currency->symbol}} {{number_format($donated)}} raised</span>
                    </div>
                </div>  
              <div class="text-left text-dark mb-5">
                <p>Donations ({{count($dd)}})</p>
              </div>
              <ul class="list-group list-group-flush list my--3">
                @foreach($paid as $k=>$val)
                    <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="icon icon-shape text-white rounded-circle bg-success">
                                <i class="fa fa-bookmark-o"></i>
                            </div>
                        </div>
                        <div class="col ml--2">
                        <h4 class="mb-0">
                            @if($val->anonymous==0) 
                                @if($val->user_id==null)
                                    @php
                                        $fff=App\Models\Transactions::whereref_id($val->ref_id)->first();
                                    @endphp
                                    {{$fff['first_name'].' '.$fff['last_name']}}
                                @endif
                                {{$val->user['first_name'].' '.$val->user['last_name']}} 
                            @else 
                                Anonymous 
                            @endif
                        </h4>
                        <small>{{$currency->symbol.number_format($val->amount)}} @ {{date("h:i:A j, M Y", strtotime($val->created_at))}}</small>
                        </div>
                    </div>
                    </li>
                @endforeach
              </ul>
                <div class="row mt-5">
                    <div class="col-md-12">
                    {{ $paid->links() }}
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@stop