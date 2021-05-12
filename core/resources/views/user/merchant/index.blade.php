
@extends('userlayout')

@section('content')
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <div class="">
          <div class="card-body">
            <div class="">
              <a href="{{route('user.add-merchant')}}" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> {{__('Add website')}}</a>
              <a href="{{route('user.merchant-documentation')}}"  class="btn btn-sm btn-success">{{__('Documentation')}}</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">  
      <div class="col-md-8">
        @foreach($merchant as $k=>$val)
          <div class="col-md-12">
              <div class="card">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-4">
                      <h5 class="h3 mb-0 text-dark">{{$val->name}}</h5>
                    </div>
                    <div class="col-8 text-right">
                      @if($val->status==1)
                      <a href="{{url('/')}}/user/edit-merchant/{{$val->id}}" class="btn btn-sm btn-primary" title="Edit Merchant">Edit</a>
                      <a href="{{url('/')}}/user/log-merchant/{{$val->merchant_key}}" class="btn btn-sm btn-neutral" title="Merchant Logs">Merchant Logs</a>
                      @endif
                      <a data-toggle="modal" data-target="#delete{{$val->id}}" href="" class="text-danger" title="Delete link"><i class="fa fa-close"></i></a>
                    </div>
                  </div>
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <!-- Avatar -->
                      <a href="javascript:void;" class="avatar avatar-xl">
                        <img alt="Image placeholder" src="{{url('/')}}/asset/profile/{{$val->image}}">
                      </a>
                    </div>
                    <div class="col">
                      <p class="text-sm text-dark mb-0"><div class="text-success text-sm">{{$val->site_url}}</div></p>
                      <p class="text-sm text-dark mb-0">{{__('Notify email')}}: {{$val->email}}</p>
                      <p class="text-sm text-dark mb-0">{{__('Description')}}: {{$val->description}}</p>
                      <p class="text-sm text-dark mb-0">{{__('Date')}}: {{date("h:i:A j, M Y", strtotime($val->created_at))}}</p>
                      <p class="text-sm text-dark mb-0"><button type="button" class="btn-icon-clipboard" data-clipboard-text="{{$val->merchant_key}}" title="Copy">{{__('Copy Merchant key')}}</button></p>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <div class="modal fade" id="delete{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
              <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                  <div class="modal-content">
                      <div class="modal-body p-0">
                          <div class="card bg-white border-0 mb-0">
                              <div class="card-header">
                                  <span class="mb-0 text-sm">{{__('Are you sure you want to delete this?, all transaction related to this will also be deleted')}}</span>
                              </div>
                              <div class="card-body px-lg-5 py-lg-5 text-right">
                                  <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                                  <a  href="{{route('delete.merchant', ['id' => $val->id])}}" class="btn btn-danger btn-sm">{{__('Proceed')}}</a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        @endforeach
      </div>
      <div class="col-md-4">
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
                  <span class="surtitle">{{__('Abandoned')}}</span><br>
                  <span class="surtitle ">{{__('Total')}}</span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle ">{{$currency->name}} {{number_format($pending)}}.00</span><br>
                  <span class="surtitle ">{{$currency->name}} {{number_format($abadoned)}}.00</span><br>
                  <span class="surtitle ">{{$currency->name}} {{number_format($total)}}.00</span>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
@stop