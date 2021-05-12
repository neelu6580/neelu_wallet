@extends('userlayout')

@section('content')
<head>
        <meta name="csrf-token" content="{{ csrf_token()}}" />

</head>    
<style>

.card {
    margin-bottom: 30px;
    border: 0;
    box-shadow: 0 0 2rem 0 rgb(248 249 254);
        background-color: #f8f9fe;
}
.openname{color: #0f0f0f!important;font-weight: bold;}
.openc{ width: 60%;    margin-bottom: -1rem !important;
    margin: 0px auto;
    text-align: left;
    background: whitesmoke;
    padding: 10px;
    border-radius: 8px;}
.openn{ color: #b2aeae!important;
    font-size: 12px!important;}
 @foreach($AllvCardDesigns as $DesignDetails)   
.card-body2{{$DesignDetails->id}}{width: 60%;margin: 9px auto; padding: 0.5rem 1rem;
background: {{$DesignDetails->class_name}};    font-size: 14px;
    border-radius: 8px;
    flex: 1 1 auto;}
@endforeach

@foreach($AllvCardDesigns as $DesignDetails)    
    .card-body{{$DesignDetails->id}}
    {    
        padding: 0.5rem 1rem;
    background: {{$DesignDetails->class_name}};
        border-radius: 15px;
        flex: 1 1 auto;
    }
@endforeach

.text-gray {
    color: #9f9e9e !important;
}
.text-primary {
    color: #ffffff !important;
}
strong {
    font-weight: bold;
}
    .btn-neutral
{
    color: #2642dd;
    border-color: transparent;
    background-color: rgba(55, 125, 255, 0.1);
    box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08);
}
.btn-neutral:hover
{
    color: #fff;
    border-color: #1937e4;
    background-color: #1937e4;
}
</style>

<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row align-items-center py-4">
      <div class="col-lg-6 col-5">
        @if($created_vcards_limit->cvard_limit > 0  && Auth::user()->user_type == 1)      
            <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> Create Card</a>
        @elseif($created_vcards_limit->cvard_limit > 0 && Auth::user()->user_type == 2) 
         <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> Create Card</a>
        @else
            <a data-toggle="modal" data-target="#limitexceeed-formx" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> Create Card</a>
        @endif
        
        
      </div>
      <div class="col-lg-3 col-3">
          <label>Card Status:</label>
          <select id="selected_id" onchange="selectedValue(this.value)">
              <option>Open</option>
              <option>Paused</option>
              <option>Closed</option>
              </select>
          </div>
      <div class="col-lg-2 col-2">
          <b>{{__('Remaining Cards:') }} {{$created_vcards_limit->cvard_limit}}</b>
         </div> 
    </div>
    <div class="modal fade" id="modal-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">New Virtual Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <p class="form-text text-xs">Card creation charge is 5.7% of amount entitled to card. Maximum cash a card can hold is USD10,000.</p>
              </div>
              <div class="card-body">
                <form method="post" action="{{route('user.create_new')}}">
                    @csrf
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                  <div class="form-group row">
                    <label class="col-form-label col-lg-12">Nice Name</label>
                    <div class="col-lg-12">
                      <input type="text" name="name_on_card" class="form-control" placeholder="Name on Card" required>
                    </div>
                  </div> 
                   
                  <div class="form-group row">
                    <label class="col-form-label col-lg-12">Spend Limit</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                          <input type="text" name="card_limit" class="form-control" onchange="checkWalletLimit()" id="amount_id" min="{{$set->virtual_card_min_amt}}" max="50" placeholder="Card extend limit e.i 100" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                          
                        </div>
                        <span id="check_wal_bal_msg" style="color:green"></span>
                          <span id="check_wal_bal_error" style="color:red"></span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-form-label col-lg-12">Spend Type</label>
                    <div class="col-lg-12">
                      <select name="spend_limit_duration" class="form-control" required>
                          <option value="">Select Limit Duration</option>
                         
                         <option value="MONTHLY">Monthly</option>
                         <option value="ANNUALLY">Annually</option>
                         <option value="FOREVER">Forever</option>
                         <option value="TRANSACTION">Per Transaction</option>
                        </select>  
                    </div>
                  </div>
                  <div class="form-group row">
                    
                    <input type="radio" class="form-control-input" style="-webkit-appearance:auto!important;margin-left:16px" name="card_type" value="SINGLE_USE"><label class="col-form-label col-lg-12" style="margin-top:-32px;margin-left:20px">Single Use (Closes shortly after first use)</label>
                    <!--div class="col-lg-12">
                      <select class="form-control" name="card_type" required>
                          <option value="">Select Card Type</option>
                         <option value="SINGLE_USE">Single Use</option>
                         
                        </select>  
                    </div-->
                  </div>
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Zip code</label>
                    <div class="col-lg-12">
                      <input type="number" name="zip_code" class="form-control" required="">
                    </div>
                  </div-->                 
                  <div class="text-right">
                    <button type="submit" class="btn btn-neutral btn-block my-4" id="create_card_btn_id">Create Card</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>  
    <div class="row" id="open_div_id">
      @foreach($virtualCardsList as $cardDetails)
      @if($cardDetails->card_state == 'OPEN')
        <div class="col-lg-4">
          <div class="card">
            <!-- Card body -->
            <div class="card-body{{$cardDetails->design_id}}">
              <div class="row justify-content-between align-items-center">
                <div class="col">
                  <!--<span class="text-primary h6 surtitle ">$0.00</span>  -->
                 @if($cardDetails->card_state == 'OPEN') <span class="badge badge-pill badge-success">{{'Active'}}</span>
                 @elseif($cardDetails->card_state == 'CLOSED')<span class="badge badge-pill badge-danger">{{'CLOSED'}}</span>
                 @else<span class="badge badge-pill badge-danger">{{'Inactive'}}@endif</span>                </div>
                <div class="col-auto">
                  <a class="mr-0 text-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-arrow-circle-down" style="color:white"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-left" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(15px, 20px, 0px);">
                    
                    <a href="{{url('user/virtualtransactions')}}/{{$cardDetails->token}}" class="dropdown-item"><i class="fas fa-sync-alt"></i>Transactions</a>
                     @if($cardDetails->card_state != 'CLOSED')
                    <a data-toggle="modal" data-target="#updatecard-model{{$cardDetails->id}}" href="" class="dropdown-item"><i class="fas fa-money-bill-wave-alt"></i>Update Card</a>
                    @endif
                    @if($cardDetails->card_state == 'PAUSED')
                    <a data-toggle="modal" data-target="#opencard-model{{$cardDetails->id}}" href="" class="dropdown-item"><i class="fa fa-pause-circle"></i>Unpause</a>
                    @endif
                    @if($cardDetails->card_state == 'OPEN')
                    <a data-toggle="modal" data-target="#pausecard-model{{$cardDetails->id}}" href="" class="dropdown-item"><i class="fa fa-pause-circle"></i>Pause</a>
                    @endif
                     @if($cardDetails->card_state != 'CLOSED')
                    <a data-toggle="modal" data-target="#closecard-model{{$cardDetails->id}}" href="" class="dropdown-item"><i class="fa fa-trash"></i>Close</a>
                    @endif
                        <!--a data-toggle="modal" data-target="#modal-more9" href="" class="dropdown-item"><i class="fab fa-cc-mastercard"></i>Card Details</a>
                        <a href="#" class="dropdown-item"><i class="fas fa-exclamation-circle"></i>Pause</a>
                        <a href="#" class="dropdown-item"><i class="fas fa-trash"></i>Close</a-->
                                      </div>
                </div>
              </div>             
              <div class="my-4">
                <span class="h6 surtitle text-white mb-2">
               
                </span>
                <div class="text-primary"  data-toggle="modal" data-target="#modal-more{{$cardDetails->id}}" style="cursor: pointer;">
                  <img src="https://cuminup.com/asset/images/logo_1604661746.png" class="navbar-brand-img" alt="...">
                </div>
              </div>
              <div class="row">               
                <div class="col-6">
                  <span class="h6 surtitle text-white">{{$cardDetails->memo}}</span><br>
                  <span class="text-white" style="    font-size: 13px;">{{$currency->symbol.number_format($cardDetails->restAmount)}} / <span class="text-white">{{$currency->symbol.number_format($cardDetails->spend_limit)}}</span></span>
                </div>
                <div class="col"  data-toggle="modal" data-target="#modal-more{{$cardDetails->id}}" style="cursor: pointer;">
                  <span class="h6 surtitle text-white">{{$cardDetails->last_four_digit}}</span><br>
                  
                </div>     
                <div class="col">
                    <img src="https://cuminup.com/asset/images/visa.svg" style="width:100%">
                    </div>
              </div>              
            </div>
          </div>
        </div>
        
        <div class="modal fade" id="modal-more{{$cardDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                <div class="card-header">
                    <h3 class="mb-0 font-weight-bolder">{{$cardDetails->memo}} Card Details</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
               <div class="card-body2{{$cardDetails->design_id}}">
              <div class="row justify-content-between align-items-center">
                <div class="col">
                  <!--<span class="text-primary h6 surtitle ">$0.00</span>  -->
                  <span class="badge badge-pill badge-success">@if($cardDetails->card_state == 'OPEN'){{'Active'}}@elseif($cardDetails->card_state == 'CLOSED'){{'CLOSED'}}@else{{'Inactive'}}@endif</span>                </div>
               
              </div>             
              <div class="my-4">
                <span class="h6 surtitle text-white mb-2">
                {{$cardDetails->memo}}
                </span>
                <div class="text-primary" data-toggle="modal" data-target="#modal-more9" style="cursor: pointer;">
                  <div>{{substr($cardDetails->pan,0,4)}} {{substr($cardDetails->pan,4,4)}} {{substr($cardDetails->pan,8,4)}} {{substr($cardDetails->pan,12,4)}}</div>
                </div>
              </div>
              <div class="row">               
                <div class="col-6">
                  <span class="h6 surtitle text-white">@if(empty($cardDetails->exp_month)){{'XX'}}@else{{$cardDetails->exp_month}}@endif / @if(empty($cardDetails->exp_year)){{'XX'}}@else{{substr($cardDetails->exp_year,2,4)}}@endif</span><br>
                  <!--span class="text-white">${{$cardDetails->spend_limit}} /<span class="text-white">$1000</span></span-->
                </div>
                <div class="col" data-toggle="modal" data-target="#modal-more9" style="cursor: pointer;">
                  <span class="h6 surtitle text-white">@if(empty($cardDetails->cvv)){{'XXX'}}@else{{$cardDetails->cvv}}@endif</span><br>
                  <!--span class="text-white">{{$cardDetails->cvv}}</span-->
                </div>     
                <div class="col">
                    <img src="https://cuminup.com/asset/images/visa.svg" style="width:100%">
                    </div>
              </div>              
            </div>
                
                <div class="my-4 openc">
                <span class="h6 surtitle text-gray mb-2 openn">
                Nick Name
                </span>
                <div class="text-primary openname" data-toggle="modal" data-target="#modal-more9">
                  <div style="color: black!important;">{{$cardDetails->memo}}</div>
                </div>
              </div>
              
              <div class="my-4 openc">
                <span class="h6 surtitle text-gray mb-2 openn">
                Monthly Limit
                </span>
                <div class="text-primary openname" data-toggle="modal" data-target="#modal-more9">
                  <div style="color: black!important;">{{$currency->symbol.number_format($cardDetails->restAmount)}} / {{$currency->symbol.number_format($cardDetails->spend_limit)}}</div>
                </div>
              </div>
              
              <div class="my-4 openc" style="    margin-bottom: 1rem!important;">
                <span class="h6 surtitle text-gray mb-2 openn">
                Funding Source
                </span>
                <div class="text-primary openname" data-toggle="modal" data-target="#modal-more9">
                  <div style="color: black!important;">{{$cardDetails->FundingAccount}}</div>
                  <p style="color: black!important;">xxxx xxx xxx {{$cardDetails->FundingLastFour}}</p>
                </div>
              </div>
            <div class="row" style="width:60%;margin:0px auto">
                <div class="col-md-6">
                      @if($cardDetails->card_state == 'PAUSED')
                    <a data-toggle="modal" data-target="#opencard-model{{$cardDetails->id}}" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-pause-circle"></i>&nbsp;<strong>Unpause</strong></a>
                    @endif
                    @if($cardDetails->card_state == 'OPEN')
                    <a data-toggle="modal" data-target="#pausecard-model{{$cardDetails->id}}" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-pause-circle"></i>&nbsp;<strong>Pause</strong></a>
                    @endif
                </div>
                <div class="col-md-6">
                     @if($cardDetails->card_state != 'CLOSED')
                    <a data-toggle="modal" data-target="#closecard-model{{$cardDetails->id}}" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-trash"></i>&nbsp;<strong>Close</strong></a>
                    @endif
                </div>
            </div>
                </div>
            </div>
            </div>
        </div>
      </div>
      
       <div class="modal fade" id="limitexceeed-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Limit Exceeded</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Please upgrade your plan!</h3>
              </div>
              <div class="card-body">
                <form method="post" action="{{route('user.open_virtual_card')}}">
                    @csrf
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="{{$cardDetails->token}}">    
                  
                   
                  <br>
                                
                  
                </form>
                <div class="text-center">
                    @if(Auth::user()->cvard_limit == 0)
                    <a href="{{url('user/instant_issue_designs/1')}}"  class="btn btn-success">Upgrade Now</a>
                    @else
                  <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> Create Card</a>
                    @endif
                    <!--a href="{{url('user/upgrade')}}"  class="btn btn-success">Upgrade Now</a-->
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
      <div class="modal fade" id="opencard-model{{$cardDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Unpause Your Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Are you sure do you want to unpause it?</h3>
              </div>
              <div class="card-body">
                <form method="post" action="{{route('user.open_virtual_card')}}">
                    @csrf
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="{{$cardDetails->token}}">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Unpause Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
      <div class="modal fade" id="closecard-model{{$cardDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Close Your Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Are you sure do you want to close it?</h3>
              </div>
              <div class="card-body">
                <form method="post" action="{{route('user.close_virtual_card')}}">
                    @csrf
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="{{$cardDetails->token}}">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Close Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
       <div class="modal fade" id="pausecard-model{{$cardDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Pause Virtual Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Are you sure do you want to pause it?</h3>
              </div>
              <div class="card-body">
                <form method="post" action="{{route('user.pause_virtual_card')}}">
                    @csrf
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="{{$cardDetails->token}}">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Pause Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
      <div class="modal fade" id="updatecard-model{{$cardDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Update Virtual Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <p class="form-text text-xs">Card creation charge is 5.7% of amount entitled to card. Maximum cash a card can hold is USD10,000.</p>
              </div>
              <div class="card-body">
                <form method="post" action="{{route('user.update_virtual_card')}}">
                    @csrf
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                  <div class="form-group row">
                    <label class="col-form-label col-lg-12">Nice Name (Name on Card)</label>
                    <div class="col-lg-12">
                    <input type="hidden" name="card_token" value="{{$cardDetails->token}}">    
                      <input type="text" name="name_on_card" class="form-control" placeholder="Name on Card" value="{{$cardDetails->memo}}" required>
                    </div>
                  </div> 
                   
                  <div class="form-group row">
                    <label class="col-form-label col-lg-12">Monthly Limit</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                          <input type="text" name="card_limit" class="form-control" min="10" max="5000" value="{{$cardDetails->spend_limit}}" placeholder="Card extend limit e.i 100" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>

                        </div>
                    </div>
                  </div>
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Spend Limit Duration</label>
                    <div class="col-lg-12">
                      <select class="form-control" name="spend_limit_duration" required>
                          <option value="">Select Limit Duration</option>
                         <option value="TRANSACTION" @if($cardDetails->spend_limit_duration == 'TRANSACTION'){{'Selected'}}@endif>TRANSACTION</option>
                         <option value="MONTHLY" @if($cardDetails->spend_limit_duration == 'MONTHLY'){{'Selected'}}@endif>MONTHLY</option>
                         <option value="ANNUALLY" @if($cardDetails->spend_limit_duration == 'ANNUALLY'){{'Selected'}}@endif>ANNUALLY</option>
                         <option value="FOREVER" @if($cardDetails->spend_limit_duration == 'FOREVER'){{'Selected'}}@endif>FOREVER</option>
                        </select>  
                    </div>
                  </div-->
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Card Type</label>
                    <div class="col-lg-12">
                      <select class="form-control" name="card_type" required>
                          <option value="">Select Card Type</option>
                         <option value="SINGLE_USE" @if($cardDetails->type == 'SINGLE_USE'){{'Selected'}}@endif>SINGLE USE</option>
                         
                        </select>  
                    </div>
                  </div-->
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Zip code</label>
                    <div class="col-lg-12">
                      <input type="number" name="zip_code" class="form-control" required="">
                    </div>
                  </div-->                 
                  <div class="text-right">
                    <button type="submit" class="btn btn-neutral btn-block my-4">Update Card</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
      @endforeach
      
       @if(count($virtualCardsList) == 0)
        <div class="col-lg-12">
          <div class="card">
              
             <div class="card-header text-center">
                <h3 class="mb-0 font-weight-bolder">No Virtual Cards yet!</h3>
                <br>
                 <div class="text-center">
                    
                    <a href="{{url('user/instant_issue_designs/1')}}"  class="btn btn-success">Upgrade Now</a>
                    <!--a href="{{url('user/upgrade')}}"  class="btn btn-success">Upgrade Now</a-->
                  </div>
              </div> 
        </div>
        </div> 
        @endif
    </div>
    <!--PAUSED-->
    <div class="row" id="paused_id" style="display:none;">
      @foreach($virtualCardsList as $cardDetails)
      @if($cardDetails->card_state == 'PAUSED')
        <div class="col-lg-4">
          <div class="card">
            <!-- Card body -->
            <div class="card-body{{$cardDetails->design_id}}">
              <div class="row justify-content-between align-items-center">
                <div class="col">
                  <!--<span class="text-primary h6 surtitle ">$0.00</span>  -->
                 @if($cardDetails->card_state == 'OPEN') <span class="badge badge-pill badge-success">{{'Active'}}</span>
                 @elseif($cardDetails->card_state == 'CLOSED')<span class="badge badge-pill badge-danger">{{'CLOSED'}}</span>
                 @else<span class="badge badge-pill badge-danger">{{'Inactive'}}@endif</span>                </div>
                <div class="col-auto">
                  <a class="mr-0 text-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-arrow-circle-down" style="color:white"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-left" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(15px, 20px, 0px);">
                    
                    <a href="{{url('user/virtualtransactions')}}/{{$cardDetails->token}}" class="dropdown-item"><i class="fas fa-sync-alt"></i>Transactions</a>
                     @if($cardDetails->card_state != 'CLOSED')
                    <a data-toggle="modal" data-target="#updatecard-model{{$cardDetails->id}}" href="" class="dropdown-item"><i class="fas fa-money-bill-wave-alt"></i>Update Card</a>
                    @endif
                    @if($cardDetails->card_state == 'PAUSED')
                    <a data-toggle="modal" data-target="#opencard-model{{$cardDetails->id}}" href="" class="dropdown-item"><i class="fa fa-pause-circle"></i>Unpause</a>
                    @endif
                    @if($cardDetails->card_state == 'OPEN')
                    <a data-toggle="modal" data-target="#pausecard-model{{$cardDetails->id}}" href="" class="dropdown-item"><i class="fa fa-pause-circle"></i>Pause</a>
                    @endif
                     @if($cardDetails->card_state != 'CLOSED')
                    <a data-toggle="modal" data-target="#closecard-model{{$cardDetails->id}}" href="" class="dropdown-item"><i class="fa fa-trash"></i>Close</a>
                    @endif
                        <!--a data-toggle="modal" data-target="#modal-more9" href="" class="dropdown-item"><i class="fab fa-cc-mastercard"></i>Card Details</a>
                        <a href="#" class="dropdown-item"><i class="fas fa-exclamation-circle"></i>Pause</a>
                        <a href="#" class="dropdown-item"><i class="fas fa-trash"></i>Close</a-->
                                      </div>
                </div>
              </div>             
              <div class="my-4">
                <span class="h6 surtitle text-white mb-2">
               
                </span>
                <div class="text-primary"  data-toggle="modal" data-target="#modal-more{{$cardDetails->id}}" style="cursor: pointer;">
                  <img src="https://cuminup.com/asset/images/logo_1604661746.png" class="navbar-brand-img" alt="...">
                </div>
              </div>
              <div class="row">               
                <div class="col-6">
                  <span class="h6 surtitle text-white">{{$cardDetails->memo}}</span><br>
                  <span class="text-white" style="    font-size: 13px;">{{$currency->symbol.number_format($cardDetails->restAmount)}} / <span class="text-white">{{$currency->symbol.number_format($cardDetails->spend_limit)}}</span></span>
                </div>
                <div class="col"  data-toggle="modal" data-target="#modal-more{{$cardDetails->id}}" style="cursor: pointer;">
                  <span class="h6 surtitle text-white">{{$cardDetails->last_four_digit}}</span><br>
                  
                </div>     
                <div class="col">
                    <img src="https://cuminup.com/asset/images/visa.svg" style="width:100%">
                    </div>
              </div>              
            </div>
          </div>
        </div>
        
        <div class="modal fade" id="modal-more{{$cardDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                <div class="card-header">
                    <h3 class="mb-0 font-weight-bolder">{{$cardDetails->memo}} Card Details</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
               <div class="card-body2{{$cardDetails->design_id}}">
              <div class="row justify-content-between align-items-center">
                <div class="col">
                  <!--<span class="text-primary h6 surtitle ">$0.00</span>  -->
                  <span class="badge badge-pill badge-success">@if($cardDetails->card_state == 'OPEN'){{'Active'}}@elseif($cardDetails->card_state == 'CLOSED'){{'CLOSED'}}@else{{'Inactive'}}@endif</span>                </div>
               
              </div>             
              <div class="my-4">
                <span class="h6 surtitle text-white mb-2">
                {{$cardDetails->memo}}
                </span>
                <div class="text-primary" data-toggle="modal" data-target="#modal-more9" style="cursor: pointer;">
                  <div>{{substr($cardDetails->pan,0,4)}} {{substr($cardDetails->pan,4,4)}} {{substr($cardDetails->pan,8,4)}} {{substr($cardDetails->pan,12,4)}}</div>
                </div>
              </div>
              <div class="row">               
                <div class="col-6">
                  <span class="h6 surtitle text-white">@if(empty($cardDetails->exp_month)){{'XX'}}@else{{$cardDetails->exp_month}}@endif / @if(empty($cardDetails->exp_year)){{'XX'}}@else{{substr($cardDetails->exp_year,2,4)}}@endif</span><br>
                  <!--span class="text-white">${{$cardDetails->spend_limit}} /<span class="text-white">$1000</span></span-->
                </div>
                <div class="col" data-toggle="modal" data-target="#modal-more9" style="cursor: pointer;">
                  <span class="h6 surtitle text-white">@if(empty($cardDetails->cvv)){{'XXX'}}@else{{$cardDetails->cvv}}@endif</span><br>
                  <!--span class="text-white">{{$cardDetails->cvv}}</span-->
                </div>     
                <div class="col">
                    <img src="https://cuminup.com/asset/images/visa.svg" style="width:100%">
                    </div>
              </div>              
            </div>
                
                <div class="my-4 openc">
                <span class="h6 surtitle text-gray mb-2 openn">
                Nick Name
                </span>
                <div class="text-primary openname" data-toggle="modal" data-target="#modal-more9">
                  <div style="color: black!important;">{{$cardDetails->memo}}</div>
                </div>
              </div>
              
              <div class="my-4 openc">
                <span class="h6 surtitle text-gray mb-2 openn">
                Monthly Limit
                </span>
                <div class="text-primary openname" data-toggle="modal" data-target="#modal-more9">
                  <div style="color: black!important;">{{$currency->symbol.number_format($cardDetails->restAmount)}} / {{$currency->symbol.number_format($cardDetails->spend_limit)}}</div>
                </div>
              </div>
              
              <div class="my-4 openc" style="    margin-bottom: 1rem!important;">
                <span class="h6 surtitle text-gray mb-2 openn">
                Funding Source
                </span>
                <div class="text-primary openname" data-toggle="modal" data-target="#modal-more9">
                  <div style="color: black!important;">{{$cardDetails->FundingAccount}}</div>
                  <p style="color: black!important;">xxxx xxx xxx {{$cardDetails->FundingLastFour}}</p>
                </div>
              </div>
            <div class="row" style="width:60%;margin:0px auto">
                <div class="col-md-6">
                      @if($cardDetails->card_state == 'PAUSED')
                    <a data-toggle="modal" data-target="#opencard-model{{$cardDetails->id}}" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-pause-circle"></i>&nbsp;<strong>Unpause</strong></a>
                    @endif
                    @if($cardDetails->card_state == 'OPEN')
                    <a data-toggle="modal" data-target="#pausecard-model{{$cardDetails->id}}" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-pause-circle"></i>&nbsp;<strong>Pause</strong></a>
                    @endif
                </div>
                <div class="col-md-6">
                     @if($cardDetails->card_state != 'CLOSED')
                    <a data-toggle="modal" data-target="#closecard-model{{$cardDetails->id}}" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-trash"></i>&nbsp;<strong>Close</strong></a>
                    @endif
                </div>
            </div>
                </div>
            </div>
            </div>
        </div>
      </div>
      
       <div class="modal fade" id="limitexceeed-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Limit Exceeded</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Please upgrade your plan!</h3>
              </div>
              <div class="card-body">
                <form method="post" action="{{route('user.open_virtual_card')}}">
                    @csrf
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="{{$cardDetails->token}}">    
                  
                   
                  <br>
                                
                  
                </form>
                <div class="text-center">
                    
                    <a href="{{url('user/instant_issue_designs/1')}}"  class="btn btn-success">Upgrade Now</a>
                    <!--a href="{{url('user/upgrade')}}"  class="btn btn-success">Upgrade Now</a-->
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
      <div class="modal fade" id="opencard-model{{$cardDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Unpause Your Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Are you sure do you want to unpause it?</h3>
              </div>
              <div class="card-body">
                <form method="post" action="{{route('user.open_virtual_card')}}">
                    @csrf
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="{{$cardDetails->token}}">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Unpause Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
      <div class="modal fade" id="closecard-model{{$cardDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Close Your Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Are you sure do you want to close it?</h3>
              </div>
              <div class="card-body">
                <form method="post" action="{{route('user.close_virtual_card')}}">
                    @csrf
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="{{$cardDetails->token}}">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Close Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
       <div class="modal fade" id="pausecard-model{{$cardDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Pause Virtual Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Are you sure do you want to pause it?</h3>
              </div>
              <div class="card-body">
                <form method="post" action="{{route('user.pause_virtual_card')}}">
                    @csrf
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="{{$cardDetails->token}}">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Pause Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
      <div class="modal fade" id="updatecard-model{{$cardDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Update Virtual Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <p class="form-text text-xs">Card creation charge is 5.7% of amount entitled to card. Maximum cash a card can hold is USD10,000.</p>
              </div>
              <div class="card-body">
                <form method="post" action="{{route('user.update_virtual_card')}}">
                    @csrf
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                  <div class="form-group row">
                    <label class="col-form-label col-lg-12">Nice Name (Name on Card)</label>
                    <div class="col-lg-12">
                    <input type="hidden" name="card_token" value="{{$cardDetails->token}}">    
                      <input type="text" name="name_on_card" class="form-control" placeholder="Name on Card" value="{{$cardDetails->memo}}" required>
                    </div>
                  </div> 
                   
                  <div class="form-group row">
                    <label class="col-form-label col-lg-12">Monthly Limit</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                          <input type="text" name="card_limit" class="form-control" min="10" max="5000" value="{{$cardDetails->spend_limit}}" placeholder="Card extend limit e.i 100" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>

                        </div>
                    </div>
                  </div>
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Spend Limit Duration</label>
                    <div class="col-lg-12">
                      <select class="form-control" name="spend_limit_duration" required>
                          <option value="">Select Limit Duration</option>
                         <option value="TRANSACTION" @if($cardDetails->spend_limit_duration == 'TRANSACTION'){{'Selected'}}@endif>TRANSACTION</option>
                         <option value="MONTHLY" @if($cardDetails->spend_limit_duration == 'MONTHLY'){{'Selected'}}@endif>MONTHLY</option>
                         <option value="ANNUALLY" @if($cardDetails->spend_limit_duration == 'ANNUALLY'){{'Selected'}}@endif>ANNUALLY</option>
                         <option value="FOREVER" @if($cardDetails->spend_limit_duration == 'FOREVER'){{'Selected'}}@endif>FOREVER</option>
                        </select>  
                    </div>
                  </div-->
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Card Type</label>
                    <div class="col-lg-12">
                      <select class="form-control" name="card_type" required>
                          <option value="">Select Card Type</option>
                         <option value="SINGLE_USE" @if($cardDetails->type == 'SINGLE_USE'){{'Selected'}}@endif>SINGLE USE</option>
                         
                        </select>  
                    </div>
                  </div-->
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Zip code</label>
                    <div class="col-lg-12">
                      <input type="number" name="zip_code" class="form-control" required="">
                    </div>
                  </div-->                 
                  <div class="text-right">
                    <button type="submit" class="btn btn-neutral btn-block my-4">Update Card</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
      @endforeach
      
       @if(count($virtualCardsList) == 0)
        <div class="col-lg-12">
          <div class="card">
              
             <div class="card-header text-center">
                <h3 class="mb-0 font-weight-bolder">No Virtual Cards yet!</h3>
                <br>
                 <div class="text-center">
                    
                    <a href="{{url('user/instant_issue_designs/1')}}"  class="btn btn-success">Upgrade Now</a>
                    <!--a href="{{url('user/upgrade')}}"  class="btn btn-success">Upgrade Now</a-->
                  </div>
              </div> 
        </div>
        </div> 
        @endif
    </div>
    <!--END PAUSED-->
    <!--CLOSED START-->
    <div class="row" id="closed_id" style="display:none;">
      @foreach($virtualCardsList as $cardDetails)
      @if($cardDetails->card_state == 'CLOSED')
        <div class="col-lg-4">
          <div class="card">
            <!-- Card body -->
            <div class="card-body{{$cardDetails->design_id}}">
              <div class="row justify-content-between align-items-center">
                <div class="col">
                  <!--<span class="text-primary h6 surtitle ">$0.00</span>  -->
                 @if($cardDetails->card_state == 'OPEN') <span class="badge badge-pill badge-success">{{'Active'}}</span>
                 @elseif($cardDetails->card_state == 'CLOSED')<span class="badge badge-pill badge-danger">{{'CLOSED'}}</span>
                 @else<span class="badge badge-pill badge-danger">{{'Inactive'}}@endif</span>                </div>
                <div class="col-auto">
                  <a class="mr-0 text-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-arrow-circle-down" style="color:white"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-left" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(15px, 20px, 0px);">
                    
                    <a href="{{url('user/virtualtransactions')}}/{{$cardDetails->token}}" class="dropdown-item"><i class="fas fa-sync-alt"></i>Transactions</a>
                     @if($cardDetails->card_state != 'CLOSED')
                    <a data-toggle="modal" data-target="#updatecard-model{{$cardDetails->id}}" href="" class="dropdown-item"><i class="fas fa-money-bill-wave-alt"></i>Update Card</a>
                    @endif
                    @if($cardDetails->card_state == 'PAUSED')
                    <a data-toggle="modal" data-target="#opencard-model{{$cardDetails->id}}" href="" class="dropdown-item"><i class="fa fa-pause-circle"></i>Unpause</a>
                    @endif
                    @if($cardDetails->card_state == 'OPEN')
                    <a data-toggle="modal" data-target="#pausecard-model{{$cardDetails->id}}" href="" class="dropdown-item"><i class="fa fa-pause-circle"></i>Pause</a>
                    @endif
                     @if($cardDetails->card_state != 'CLOSED')
                    <a data-toggle="modal" data-target="#closecard-model{{$cardDetails->id}}" href="" class="dropdown-item"><i class="fa fa-trash"></i>Close</a>
                    @endif
                        <!--a data-toggle="modal" data-target="#modal-more9" href="" class="dropdown-item"><i class="fab fa-cc-mastercard"></i>Card Details</a>
                        <a href="#" class="dropdown-item"><i class="fas fa-exclamation-circle"></i>Pause</a>
                        <a href="#" class="dropdown-item"><i class="fas fa-trash"></i>Close</a-->
                                      </div>
                </div>
              </div>             
              <div class="my-4">
                <span class="h6 surtitle text-white mb-2">
               
                </span>
                <div class="text-primary"  data-toggle="modal" data-target="#modal-more{{$cardDetails->id}}" style="cursor: pointer;">
                  <img src="https://cuminup.com/asset/images/logo_1604661746.png" class="navbar-brand-img" alt="...">
                </div>
              </div>
              <div class="row">               
                <div class="col-6">
                  <span class="h6 surtitle text-white">{{$cardDetails->memo}}</span><br>
                  <span class="text-white" style="    font-size: 13px;">{{$currency->symbol.number_format($cardDetails->restAmount)}} / <span class="text-white">{{$currency->symbol.number_format($cardDetails->spend_limit)}}</span></span>
                </div>
                <div class="col"  data-toggle="modal" data-target="#modal-more{{$cardDetails->id}}" style="cursor: pointer;">
                  <span class="h6 surtitle text-white">{{$cardDetails->last_four_digit}}</span><br>
                  
                </div>     
                <div class="col">
                    <img src="https://cuminup.com/asset/images/visa.svg" style="width:100%">
                    </div>
              </div>              
            </div>
          </div>
        </div>
        
        <div class="modal fade" id="modal-more{{$cardDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                <div class="card-header">
                    <h3 class="mb-0 font-weight-bolder">{{$cardDetails->memo}} Card Details</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
               <div class="card-body2{{$cardDetails->design_id}}">
              <div class="row justify-content-between align-items-center">
                <div class="col">
                  <!--<span class="text-primary h6 surtitle ">$0.00</span>  -->
                  <span class="badge badge-pill badge-success">@if($cardDetails->card_state == 'OPEN'){{'Active'}}@elseif($cardDetails->card_state == 'CLOSED'){{'CLOSED'}}@else{{'Inactive'}}@endif</span>                </div>
               
              </div>             
              <div class="my-4">
                <span class="h6 surtitle text-white mb-2">
                {{$cardDetails->memo}}
                </span>
                <div class="text-primary" data-toggle="modal" data-target="#modal-more9" style="cursor: pointer;">
                  <div>{{substr($cardDetails->pan,0,4)}} {{substr($cardDetails->pan,4,4)}} {{substr($cardDetails->pan,8,4)}} {{substr($cardDetails->pan,12,4)}}</div>
                </div>
              </div>
              <div class="row">               
                <div class="col-6">
                  <span class="h6 surtitle text-white">@if(empty($cardDetails->exp_month)){{'XX'}}@else{{$cardDetails->exp_month}}@endif / @if(empty($cardDetails->exp_year)){{'XX'}}@else{{substr($cardDetails->exp_year,2,4)}}@endif</span><br>
                  <!--span class="text-white">${{$cardDetails->spend_limit}} /<span class="text-white">$1000</span></span-->
                </div>
                <div class="col" data-toggle="modal" data-target="#modal-more9" style="cursor: pointer;">
                  <span class="h6 surtitle text-white">@if(empty($cardDetails->cvv)){{'XXX'}}@else{{$cardDetails->cvv}}@endif</span><br>
                  <!--span class="text-white">{{$cardDetails->cvv}}</span-->
                </div>     
                <div class="col">
                    <img src="https://cuminup.com/asset/images/visa.svg" style="width:100%">
                    </div>
              </div>              
            </div>
                
                <div class="my-4 openc">
                <span class="h6 surtitle text-gray mb-2 openn">
                Nick Name
                </span>
                <div class="text-primary openname" data-toggle="modal" data-target="#modal-more9">
                  <div style="color: black!important;">{{$cardDetails->memo}}</div>
                </div>
              </div>
              
              <div class="my-4 openc">
                <span class="h6 surtitle text-gray mb-2 openn">
                Monthly Limit
                </span>
                <div class="text-primary openname" data-toggle="modal" data-target="#modal-more9">
                  <div style="color: black!important;">{{$currency->symbol.number_format($cardDetails->restAmount)}} / {{$currency->symbol.number_format($cardDetails->spend_limit)}}</div>
                </div>
              </div>
              
              <div class="my-4 openc" style="    margin-bottom: 1rem!important;">
                <span class="h6 surtitle text-gray mb-2 openn">
                Funding Source
                </span>
                <div class="text-primary openname" data-toggle="modal" data-target="#modal-more9">
                  <div style="color: black!important;">{{$cardDetails->FundingAccount}}</div>
                  <p style="color: black!important;">xxxx xxx xxx {{$cardDetails->FundingLastFour}}</p>
                </div>
              </div>
            <div class="row" style="width:60%;margin:0px auto">
                <div class="col-md-6">
                      @if($cardDetails->card_state == 'PAUSED')
                    <a data-toggle="modal" data-target="#opencard-model{{$cardDetails->id}}" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-pause-circle"></i>&nbsp;<strong>Unpause</strong></a>
                    @endif
                    @if($cardDetails->card_state == 'OPEN')
                    <a data-toggle="modal" data-target="#pausecard-model{{$cardDetails->id}}" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-pause-circle"></i>&nbsp;<strong>Pause</strong></a>
                    @endif
                </div>
                <div class="col-md-6">
                     @if($cardDetails->card_state != 'CLOSED')
                    <a data-toggle="modal" data-target="#closecard-model{{$cardDetails->id}}" href="" class="dropdown-item" style="color: grey;"><i class="fa fa-trash"></i>&nbsp;<strong>Close</strong></a>
                    @endif
                </div>
            </div>
                </div>
            </div>
            </div>
        </div>
      </div>
      
       <div class="modal fade" id="limitexceeed-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Limit Exceeded</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Please upgrade your plan!</h3>
              </div>
              <div class="card-body">
                <form method="post" action="{{route('user.open_virtual_card')}}">
                    @csrf
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="{{$cardDetails->token}}">    
                  
                   
                  <br>
                                
                  
                </form>
                <div class="text-center">
                    
                    <a href="{{url('user/instant_issue_designs/1')}}"  class="btn btn-success">Upgrade Now</a>
                    <!--a href="{{url('user/upgrade')}}"  class="btn btn-success">Upgrade Now</a-->
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
      <div class="modal fade" id="opencard-model{{$cardDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Unpause Your Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Are you sure do you want to unpause it?</h3>
              </div>
              <div class="card-body">
                <form method="post" action="{{route('user.open_virtual_card')}}">
                    @csrf
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="{{$cardDetails->token}}">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Unpause Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
      <div class="modal fade" id="closecard-model{{$cardDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Close Your Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Are you sure do you want to close it?</h3>
              </div>
              <div class="card-body">
                <form method="post" action="{{route('user.close_virtual_card')}}">
                    @csrf
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="{{$cardDetails->token}}">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Close Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
       <div class="modal fade" id="pausecard-model{{$cardDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Pause Virtual Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <h3>Are you sure do you want to pause it?</h3>
              </div>
              <div class="card-body">
                <form method="post" action="{{route('user.pause_virtual_card')}}">
                    @csrf
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                
                    <input type="hidden" name="card_token" value="{{$cardDetails->token}}">    
                  
                   
                  <br>
                                
                  <div class="text-center">
                    <button type="submit" class="btn btn-success">Pause Now</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
      <div class="modal fade" id="updatecard-model{{$cardDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            <div class="card bg-white border-0 mb-0">
              <div class="card-header">
                <h3 class="mb-0 font-weight-bolder">Update Virtual Card</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                </button>
                <p class="form-text text-xs">Card creation charge is 5.7% of amount entitled to card. Maximum cash a card can hold is USD10,000.</p>
              </div>
              <div class="card-body">
                <form method="post" action="{{route('user.update_virtual_card')}}">
                    @csrf
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Amount</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" class="form-control" min="3000" max="10000" required="">
                        </div>
                    </div>
                  </div-->
                  <div class="form-group row">
                    <label class="col-form-label col-lg-12">Nice Name (Name on Card)</label>
                    <div class="col-lg-12">
                    <input type="hidden" name="card_token" value="{{$cardDetails->token}}">    
                      <input type="text" name="name_on_card" class="form-control" placeholder="Name on Card" value="{{$cardDetails->memo}}" required>
                    </div>
                  </div> 
                   
                  <div class="form-group row">
                    <label class="col-form-label col-lg-12">Monthly Limit</label>
                    <div class="col-lg-12">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                          <input type="text" name="card_limit" class="form-control" min="10" max="5000" value="{{$cardDetails->spend_limit}}" placeholder="Card extend limit e.i 100" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>

                        </div>
                    </div>
                  </div>
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Spend Limit Duration</label>
                    <div class="col-lg-12">
                      <select class="form-control" name="spend_limit_duration" required>
                          <option value="">Select Limit Duration</option>
                         <option value="TRANSACTION" @if($cardDetails->spend_limit_duration == 'TRANSACTION'){{'Selected'}}@endif>TRANSACTION</option>
                         <option value="MONTHLY" @if($cardDetails->spend_limit_duration == 'MONTHLY'){{'Selected'}}@endif>MONTHLY</option>
                         <option value="ANNUALLY" @if($cardDetails->spend_limit_duration == 'ANNUALLY'){{'Selected'}}@endif>ANNUALLY</option>
                         <option value="FOREVER" @if($cardDetails->spend_limit_duration == 'FOREVER'){{'Selected'}}@endif>FOREVER</option>
                        </select>  
                    </div>
                  </div-->
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Card Type</label>
                    <div class="col-lg-12">
                      <select class="form-control" name="card_type" required>
                          <option value="">Select Card Type</option>
                         <option value="SINGLE_USE" @if($cardDetails->type == 'SINGLE_USE'){{'Selected'}}@endif>SINGLE USE</option>
                         
                        </select>  
                    </div>
                  </div-->
                  <!--div class="form-group row">
                    <label class="col-form-label col-lg-12">Zip code</label>
                    <div class="col-lg-12">
                      <input type="number" name="zip_code" class="form-control" required="">
                    </div>
                  </div-->                 
                  <div class="text-right">
                    <button type="submit" class="btn btn-neutral btn-block my-4">Update Card</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
      @endforeach
      
       @if(count($virtualCardsList) == 0)
        <div class="col-lg-12">
          <div class="card">
              
             <div class="card-header text-center">
                <h3 class="mb-0 font-weight-bolder">No Virtual Cards yet!</h3>
                <br>
                 <div class="text-center">
                    
                    <a href="{{url('user/instant_issue_designs/1')}}"  class="btn btn-success">Upgrade Now</a>
                    <!--a href="{{url('user/upgrade')}}"  class="btn btn-success">Upgrade Now</a-->
                  </div>
              </div> 
        </div>
        </div> 
        @endif
    </div>
    <!--END CLOSED-->
    
   
    
          <div class="modal fade" id="modal-formfund9" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                <div class="card-header">
                    <h3 class="mb-0 font-weight-bolder">Add Funds to Virtual Card</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="card-body">
                    <form method="post" action="http://vcard.ewalletscard.com/user/fund-virtual">
                    <input type="hidden" name="_token" value="qvuwGVN5NwUQukGJx44qtIeJmGkLWhDk6PoIl3yG">                    <input type="hidden" name="id" value="e9bc954b-261c-4d70-a1c5-2c64fd3c716c">
                    <div class="form-group row">
                        <label class="col-form-label col-lg-12">Amount</label>
                        <div class="col-lg-12">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" step="any" name="amount" class="form-control" max="10000" required="">
                            </div>
                            <p class="form-text text-xs">Charge is 4.3%.</p>
                        </div>
                    </div>                 
                    <div class="text-right">
                        <button type="submit" class="btn btn-neutral btn-block my-4">Fund Card</button>
                    </div>
                    </form>
                </div>
                </div>
            </div>
            </div>
        </div>
      </div>      
      
    


<!-- footer begin -->
      <footer class="footer pt-0">

      </footer>
    </div>
  </div>
<script>
function selectedValue(selectedvalue)
{
    if(selectedvalue == 'Paused')
    {
        $('#open_div_id').hide();
        $('#closed_id').hide();
        $('#paused_id').show();
    }
    else if(selectedvalue == 'Open')
    {
        $('#closed_id').hide();
        $('#paused_id').hide();
         $('#open_div_id').show();
        
    }
    else if(selectedvalue == 'Closed')
    {
        $('#open_div_id').hide();
        $('#paused_id').hide();
          $('#closed_id').show();
    }
}

function checkWalletLimit()
{
 if($('#amount_id').val()!='')
        { 
          let _token   = $('meta[name="csrf-token"]').attr('content');
           var amt = $('#amount_id').val();
            $.ajax({
                url: "{{url('user')}}/check_wallet_balance",
                method: "POST",
                data: {amount:amt,_token:_token},
                success: function(data) { 
                    console.log(data);
                    if(data.result == '1')
                    {
                        //$('#checked').show();
                        $('#check_wal_bal_error').hide();
                        $('#check_wal_bal_msg').show();
                       $('#check_wal_bal_msg').html(data.response);
                       $("#create_card_btn_id").prop('disabled', false);
                    }
                },
                error:function(err){ 
                    if(err.responseJSON.result == '0') {
                         $('#check_wal_bal_msg').hide();
                         $('#check_wal_bal_error').show();
                         $("#check_wal_bal_error").html('Sorry, Insufficient balance in your wallet! <a href="{{url("user/transfer")}}">Add Fund</a>');
                        $("#create_card_btn_id").prop('disabled', true);
                        
                    }
                }
            });
        }
}        
</script>

    
@stop