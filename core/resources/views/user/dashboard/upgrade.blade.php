@extends('userlayout')

@section('content')
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row"> 
      <div class="col-md-12">
          <center><h3 class="mr-3 upgrade-premium my-4"><i class="fas fa-crown"></i> <span class="mobile-view">Business Features</span></h3></center>
      </div>
      <div class="col-md-4">
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
      <div class="col-md-4">       
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
      <div class="col-md-4">        
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
      <div class="col-md-4">
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
      <div class="col-md-4">       
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
      <div class="col-md-4">        
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
      <div class="col-md-12">
          <center><h3 class="mr-3 upgrade-premium my-4">Upload Documents</h3></center>
      </div>
      <div class="col-md-12">
        <div class="card" id="edit">
          <div class="card-header header-elements-inline">
            <h3 class="mb-0">{{__('Your Documents')}}</h3>
          </div>
          <div class="card-body">
            <form method="post" action="{{url('user/kyc')}}" enctype="multipart/form-data">
            @csrf
                <div class="form-group row">
                  <label class="col-form-label col-lg-3">{{__('Company Certificate')}}</label>
                  <div class="col-lg-9">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="file" class="custom-file-input" id="customFileLang1" name="image">
                            <label class="custom-file-label sdsd" for="customFileLang1">{{__('Upload')}}</label>
                        </div> 
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-lg-3">{{__('Address Proof')}}</label>
                  <div class="col-lg-9">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="file" class="custom-file-input" id="customFileLang3" name="address_id">
                            <label class="custom-file-label sdsd2" for="customFileLang3">{{__('Upload')}}</label>
                        </div> 
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                    <div class="row">
                        <div class="col-md-12">
                            <small>(Document format supported PDF, JPG, JPEG, PNG files,<br> Max Size: 10MB each document,<br> Addredd Proof: latest bank statement or unities bill (within 90 days))</small>
                        </div>
                    </div>
                </div>
                <div class="text-left">
                    <button type="submit" class="btn btn-success btn-sm">{{__('Upload')}}</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@stop