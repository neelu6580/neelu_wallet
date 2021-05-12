@extends('userlayout')

@section('content')
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <div class="">
          <div class="card-body">
            <div class="">
              <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> {{__('Withdraw request')}}</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="modal fade" id="modal-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                  <div class="card-header">
                    <h3 class="mb-0">{{__('Withdraw Request')}}</h3>
                  </div>
                  <div class="card-body">
                    <form action="{{route('withdraw.submit')}}" method="post">
                      @csrf
                      <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('Amount')}}</label>
                        <div class="col-lg-10">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">{{$currency->symbol}}</span>
                            </div>
                            <input type="number" name="amount" class="form-control" required="">
                            <span class="form-text text-xs">Withdraw charge is {{$set->withdraw_charge}}%, & mininmum withdraw is {{$currency->symbol.number_format($set->withdraw_limit)}} for startup business. A verified business has no withdrawal limits. Payout takes {{$set->withdraw_duration}} to process.</span>
                          </div>
                        </div>
                      </div> 
                      <div class="form-group row">
                        <label class="col-form-label col-lg-2">{{__('Bank')}}</label>
                        <div class="col-lg-10">
                          <select class="form-control select" name="bank" data-dropdown-css-class="bg-primary" data-fouc required>
                          @if(count($bank)>0) 
                            @foreach($bank as $val)
                              <option value='{{$val->id}}'>{{$val->name}} - {{$val->acct_no}}</option>
                            @endforeach
                          @endif
                          </select>
                        </div>
                      </div>                 
                      <div class="text-right">
                        <button type="submit" class="btn btn-success btn-sm">{{__('Save')}}</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> 
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <div class="row">  
        @if(count($withdraw)>0) 
          @foreach($withdraw as $k=>$val)
            <div class="col-md-6">
              <div class="card bg-white">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <!-- Title -->
                      <h5 class="h4 mb-0 text-dark">#{{$val->reference}}</h5>
                    </div>
                    <div class="col-4 text-right">
                      @if($val->status==0)
                        <a data-toggle="modal" data-target="#modal-forma{{$val->id}}" href="" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i> {{__('Edit')}}</a>
                      @endif
                    </div>
                  </div>
                  <div class="row">
                      <div class="col">
                        <p class="text-sm text-dark mb-0">{{__('Amount')}}: {{$currency->symbol.number_format($val->amount)}}</p>
                        <p class="text-sm text-dark mb-0">{{__('Bank')}}: {{$val->wallet['name']}} - {{$val->wallet['acct_no']}}</p>
                        <p class="text-sm text-dark mb-0">{{__('Next Settlement')}}: @if($val->status==0){{date("Y/m/d", strtotime($val->next_settlement))}} @else - @endif</p>
                        <p class="text-sm text-dark mb-2">{{__('Date')}}: {{date("Y/m/d h:i:A", strtotime($val->created_at))}}</p>
                        @if($val->status==1)
                          <span class="badge badge-pill badge-primary">{{__('Charge')}}: {{$currency->symbol.number_format($val->charge)}}</span>
                        @endif
                        @if($val->status==1)
                          <span class="badge badge-pill badge-success"><i class="fa fa-check"></i> {{__('Paid out')}}</span>
                        @elseif($val->status==0)
                          <span class="badge badge-pill badge-danger"><i class="fa fa-spinner"></i>  {{__('Pending')}}</span>                        
                        @elseif($val->status==2)
                          <span class="badge badge-pill badge-info"><i class="fa fa-close"></i> {{__('Declined')}}</span>
                        @endif
                      </div>
                    </div>
                </div>
              </div>
            </div> 
            <div class="modal fade" id="modal-forma{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
              <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                  <div class="modal-body p-0">
                    <div class="card bg-white border-0 mb-0">
                    <div class="card-header header-elements-inline">
                      <h3 class="mb-0">{{__('Bank Details')}}</h3>
                    </div>
                      <div class="card-body px-lg-5 py-lg-5">
                        <form action="{{url('user/withdraw-update')}}" method="post">
                          @csrf
                          <div class="form-group row">
                            <label class="col-form-label col-lg-2">{{__('Bank')}}</label>
                            <div class="col-lg-10">
                              <select class="form-control custom-select" name="bank" data-fouc>
                              @foreach($bank as $valx)
                                <option value='{{$valx->id}}'
                                  @if($valx->id==$val->wallet->id)
                                  selected
                                  @endif
                                  >{{$valx->name}} - {{$valx->acct_no}}</option>
                              @endforeach
                              </select>
                              <input name="withdraw_id" type="hidden" value="{{$val->id}}">
                            </div>
                          </div>                
                          <div class="text-right">
                            <button type="submit" class="btn btn-success btn-sm">{{__('Save')}}</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> 
          @endforeach
        @else
          <div class="col-md-12">
            <p class="text-center text-muted card-text mt-8">No Withdrawal Request found</p>
          </div>
        @endif
        </div> 
        <div class="row">
          <div class="col-md-12">
          {{ $withdraw->links() }}
          </div>
        </div>
      </div> 
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-auto">
                <div class="icon icon-shape text-white rounded-circle bg-dash">
                  <i class="fa fa-calendar text-primary"></i>
                </div>
              </div>
              <div class="col">
                <h3 class="mb-0">{{__('Next Settlement')}}</h3>
                <ul class="list list-unstyled mb-0">
                  <li><span class="text-default text-sm">{{date("Y/m/d", strtotime($set->next_settlement))}}</span></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            
            <div class="row align-items-center">
              <div class="col text-center">
                <h4 class="mb-4 text-primary">
                {{__('Statistics')}}
                </h4>
                <span class="text-sm text-dark mb-0"><i class="fa fa-google-wallet"></i> {{__('Received')}}</span><br>
                <span class="text-xl text-dark mb-0">{{$currency->name}} {{number_format($received)}}.00</span><br>
                <hr>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle">{{__('Pending')}}</span><br>
                  <span class="surtitle ">{{__('Total')}}</span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle ">{{$currency->name}} {{number_format($pending)}}.00</span><br>
                  <span class="surtitle ">{{$currency->name}} {{number_format($total)}}.00</span>
                </div>
              </div>
            </div>

          </div>
        </div>
    </div>

@stop