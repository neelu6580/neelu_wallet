@extends('userlayout')

@section('content')
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row"> 
      <div class="col-lg-4">
        <div class="card bg-white shadow">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-12">
                <h3 class="card-title mb-3">{{__('eStore')}}</h3>
              </div>
            </div>
            <p class="card-text text-sm">{{__('Digital and any product can now be sold easily. Create & share your products to clients')}}</p>
            <a href="{{route('user.product')}}" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> {{__('Sell Product')}}</a>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card bg-white shadow">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-12">
                <h3 class="card-title mb-3">{{__('e-Invoice')}}</h3>
              </div>
            </div>
            <p class="card-text text-sm">{{__('Billing of your clients is now possible with invoice system, requesting money from anyone is now easy')}}</p>
            <a href="{{route('user.invoice')}}" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> {{__('Create Invoice')}}</a>
          </div>
        </div>
      </div>
     
      <div class="col-lg-4">
        <div class="card bg-white shadow">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-12">
                <h3 class="card-title mb-3">{{__('Single Charge')}}</h3>
              </div>
            </div>
            <p class="card-text text-sm">{{__('Sending payment link for single charge is now possible. Single charge is a one time payment for any needed service or product.')}}</p>
            <a href="{{route('user.sclinks')}}" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> {{__('Payment Links')}}</a>
          </div>
        </div> 
      </div>
      @if(Auth::user()->user_type == 1)
          <div class="col-md-12">
              <!--<center><a href="{{route('user.upgrade')}}"><h3 class="mr-3 upgrade-premium mb-5"><i class="fas fa-crown"></i> <span class="mobile-view">Upgrade to Business</span></h3></a></center>-->
              
                <!--@if(empty($user->kyc_link) || $user->kyc_status=='2')-->
                <div class="alert alert-error alert-dismissible" style="height:50px;background-color: #dd4b39;color: #ffffff;">
    				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    				  <strong><i class="icon fa fa-warning"></i>Alert!</strong>
    				   Your Business account is not started yet. Please upload the document to start.
    				<span class="pull-right">
    					<a href="{{route('user.upgrade')}}" class="btn bg-navy" style="display:unset !important;background-color: #001f3f ;color: #ffffff;"><i class="fa fa-rocket"></i>  Upgrade Now</a>
    				</span>
                </div>
                <!--@endif-->
          </div>
      @endif
       <div class="col-lg-4">
        <div class="card bg-white shadow">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-12">
                <h3 class="card-title mb-3">{{__('Virtual Card')}}</h3>
              </div>
            </div>
            <p class="card-text text-sm">{{__('Enroll and personalize your card and Complete enrollment and accept terms to activate your card visit')}}</p>
            
          @if(Auth::user()->user_type == 1)
                <a class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm"><i class="fa fa-arrow-right"></i> {{__('Manage Virtual Cards')}}</a>
            @else
                <a href="{{route('user.ownbank')}}" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> {{__('Manage Virtual Cards')}}</a>
            @endif
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card bg-white shadow">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-12">
                <h3 class="card-title mb-3">{{__('Transfer Money')}}</h3>
              </div>
            </div>
            <p class="card-text text-sm">{{__('You can now transfer money to anyone without account restriction, all you need is an email address.')}}</p>
            @if(Auth::user()->user_type == 1)
                <a class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm"><i class="fa fa-arrow-right"></i> {{__('Send Money')}}</a>
            @else
                <a href="{{route('user.ownbank')}}" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> {{__('Send Money')}}</a>
            @endif
          </div>
        </div>
      </div>
      <div class="col-lg-4">       
        <div class="card bg-white shadow">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-12">
                <h3 class="card-title mb-3">{{__('Request Money')}}</h3>
              </div>
            </div>
            <p class="card-text text-sm">{{__('Easily receive money from any member of this community')}}</p>
            @if(Auth::user()->user_type == 1)
                <a class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm"><i class="fa fa-arrow-right"></i> {{__('Request Money')}}</a>
            @else
                <a href="{{route('user.request')}}" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> {{__('Request Money')}}</a>
            @endif
          </div>
        </div>
      </div>
      <div class="col-lg-4">        
        <div class="card bg-white shadow">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-12">
                <h3 class="card-title mb-3">{{__('Donation Page')}}</h3>
              </div>
            </div>
            <p class="card-text text-sm">{{__('You can now create a donation page to get funds for any project')}}</p>
            @if(Auth::user()->user_type == 1)
                <a class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm"><i class="fa fa-arrow-right"></i> {{__('Donations')}}</a>
            @else
                <a href="{{route('user.dplinks')}}" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> {{__('Donations')}}</a>
            @endif
          </div>
        </div>
      </div>      
      <div class="col-lg-4">
        @if($set->merchant==1)
          <div class="card bg-white shadow">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-12">
                  <h3 class="card-title mb-3">{{__('Payment Button')}}</h3>
                </div>
              </div>
              <p class="card-text text-sm">Receiving money on your website is now easy with simple integeration at a fee of {{$set->merchant_charge}}% per transaction</p>
              @if(Auth::user()->user_type == 1)
                <a class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm"><i class="fa fa-arrow-right"></i> {{__('Become a Merchant')}}</a>
              @else
                <a href="{{route('submit.merchant')}}" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> {{__('Become a Merchant')}}</a>
              @endif
            </div>
          </div>
        @endif
      </div>
      <div class="col-lg-4">       
        <div class="card bg-white shadow">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-12">
                <h3 class="card-title mb-3">{{__('Payment Plan & Subscription')}}</h3>
              </div>
            </div>
            <p class="card-text text-sm">{{__('You can now run your own payment plans and subscription service with ease. Options like fixed asmount and auto renewal is now available')}}</p>
            @if(Auth::user()->user_type == 1)
                <a class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm"><i class="fa fa-arrow-right"></i> {{__('Payment Plans')}}</a>
            @else
                <a href="{{route('user.plan')}}" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> {{__('Payment Plans')}}</a>
            @endif
          </div>
        </div>
      </div>
      <div class="col-lg-4">        
        <div class="card bg-white shadow">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-12">
                <h3 class="card-title mb-3">{{__('Charges')}}</h3>
              </div>
            </div>
            <p class="card-text text-sm">{{__('keep track of your transactions')}}</p>
            @if(Auth::user()->user_type == 1)
                <a class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm"><i class="fa fa-arrow-right"></i> {{__('Payment Plans')}}</a>
            @else
                <a href="{{route('user.charges')}}" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> {{__('Transactions')}}</a>
            @endif
          </div>
        </div>
      </div>
    </div>
    <!-- Small modal -->
<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Small modal</button>-->

<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content text-center mt-5 pt-5 pb-4">
      <h3> <i class="fas fa-crown" style="color: #fff704; font-size: 20px;"></i> Upgrade to Business</h3>
      <a href="{{route('user.upgrade')}}"><p>Click Here..</p></a>
    </div>
  </div>
</div>
@stop