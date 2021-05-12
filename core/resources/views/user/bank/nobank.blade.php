@extends('paymentlayout')

@section('content')
<div class="main-content">
    <!-- Header -->
    <div class="header py-7 py-lg-8 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
              <div class="progress1">
    <div class="progress-bar1" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width:25%">
      <span class="sr-only">25% Complete</span>
     Step 1 > Create an account
    </div>
    <div class="progress-bar1" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width:25%">
      <span class="sr-only">25% Complete</span>
     Step 2 > Email Verification
    </div>
    <div class="progress-bar1" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width:25%">
      <span class="sr-only">25% Complete</span>
    Step 3 > Add Bank Account
    </div>
    <div class="progress-bar2" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:25%">
      <span class="sr-only">0% Complete</span>
     Step 4 > Create an products
    </div>
  </div>
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                 
              <h1 class="text-white">
                  {{__('Add Bank Account')}}
              </h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5 mb-0">
      <div class="row justify-content-center">
        <div class="col-lg-7 col-md-7">

          <div class="card card-profile bg-white border-0 mb-5">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <img src="{{url('/')}}/asset/profile/{{$cast}}" class="rounded-circle border-secondary">
                </div>
              </div>
            </div>
            <div class="card-body pt-7 px-5">
                <div class="text-center text-dark mb-5">
                <!--<small>{{__('Settlements will be paid to this account')}}</small>-->
                
                 <small>Where should we send your payouts?</small>
              </div>
              <form role="form" action="{{ route('add.bank')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                <span class="input-group-text">#</span>
                                </div>
                                <input class="form-control" placeholder="{{ __('Account Number') }}" type="number" name="acct_no" required>
                            </div>
                        </div>                
                    </div>                     
                    <div class="col-lg-6">
                        <div class="form-group">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                <span class="input-group-text">#</span>
                                </div>
                                <input class="form-control" placeholder="{{ __('Routing Number') }}" type="text" name="swift" required>
                            </div>
                        </div>                
                    </div>                
                </div>                
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-building"></i></span>
                    </div>
                    <input class="form-control" placeholder="{{ __('Bank Name') }}" type="text" name="name" required>
                  </div>
                </div>                
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input class="form-control" placeholder="{{ __('Account holder name') }}" type="text" name="acct_name" required>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-success my-4">{{__('Save')}}</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@stop