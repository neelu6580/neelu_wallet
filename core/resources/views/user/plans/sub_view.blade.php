@extends('paymentlayout')

@section('content')

<div class="main-content payment">
    <!-- Header -->
    <div class="header py-7 py-lg-8 pt-lg-1">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h3 class="text-white">{{$link->name}}</h3> <span class="text-white">By {{$merchant->business_name}}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5 mb-0">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
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
            <div class="card-body pt-7 px-5">
              <div class="row justify-content-between align-items-center mb-3">
                @if($link->amount!=null)
                <div class="col-6">
                    <span class="form-text text-xl">{{$currency->symbol}} {{$link->amount}}</span>
                </div>
                @endif
              </div>
              <form role="form" action="{{ route('submit.plancharge')}}" method="post" id="modal-details">
                @csrf
                @if($link->amount==null)
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-future">{{$currency->symbol}}</span>
                    </div>
                    <input class="form-control" placeholder="0.00" type="number" name="amount" required>
                  </div>
                </div>
                @else
                    <input type="hidden" name="amount" value="{{$link->amount}}">
                @endif
                @if($link->times!=null)
                <div class="form-group row">
                    <label class="col-form-label col-lg-4">{{__('Auto renewal')}}</label>
                    <div class="col-lg-3">
                        <select class="form-control select" name="status">
                            <option value="1">{{__('Yes')}}
                            </option>
                            <option value="0">{{__('No')}}
                            </option>
                        </select>
                    </div>
                </div>
                @endif
                <div class="text-right">  
                  <small>{{$link->intervals}} Renewal</small>
                </div>
                <input type="hidden" value="{{$link->id}}" name="link">
                <div class="modal fade" id="fund" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                  <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                    <div class="modal-content">
                      <div class="modal-body p-0">
                        <div class="accordion" id="accordionExample">
                          <div class="card bg-white border-0 mb-0">
                            <!--Account Balance-->
                            <div class="card-header" id="headingTwo">
                                <div class="text-left" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                  <h4 class="mb-0">Pay with Account</h4>
                                </div>
                            </div>
                            <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                              <div class="card-body text-center">
                                @if (Auth::guard('user')->check())
                                  <form method="post" role="form" action="{{route('submit.plancharge')}}">
                                    @csrf
                                    <h4 class="mb-0">Account Balance</h4>
                                    <h1 class="mb-1 text-muted">{{$currency->symbol.number_format($user->balance)}}</h1>
                                    <div class="text-center">
                                      <button type="submit" class="btn btn-neutral btn-sm" form="modal-details">Pay now</button>
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
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <button type="button" data-toggle="modal" data-target="#fund" class="btn btn-success my-4">{{__('Pay')}}</button>
                </div>
                <div class="text-center">
                  <p class="paragraph small">If you have any questions, contact
                    <a href="mailto:{{$merchant->email}}">{{$merchant->email}}</a>
                  </p>
                </div>
                <div class="text-center">
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
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@stop