
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
              <a href="{{route('user.add-invoice')}}" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> {{__('Create invoice')}}</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">  
      <div class="col-md-8">
        <div class="row"> 
          @if(count($invoice)>0) 
            @foreach($invoice as $k=>$val)
              <div class="col-md-6">
                <div class="card">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col mb-3">
                        @if($val->status==0)
                        <a data-toggle="modal" data-target="#modal-formx{{$val->id}}" class="btn btn-sm btn-primary" href="javascript:void;" title="Edit Amount"><i class="fa fa-pencil"></i> {{__('Edit')}}</a>
                        <a href="{{route('reminder.invoice', ['id' => $val->id])}}" class="btn btn-sm btn-neutral" title="Send Reminder"><i class="fa fa-clock-o"></i> {{__('Resend')}}</a>
                        <a href="{{route('paid.invoice', ['id' => $val->id])}}" class="btn btn-sm btn-success" title="Mark as paid"><i class="fa fa-check"></i> {{__('Mark as Paid')}}</a>
                        @endif
                        <a data-toggle="modal" data-target="#delete{{$val->id}}" href="" class="text-danger" title="Delete link"><i class="fa fa-close"></i></a>
                      </div>
                    </div>
                    <div class="row align-items-center">
                      <div class="col">
                        <p class="text-sm text-dark mb-0">{{$val->item}}</p>
                        <p class="text-sm text-dark mb-0">{{__('Invoice ID')}}: {{$val->invoice_no}}</p>
                        <p class="text-sm text-dark mb-0">{{__('Ref')}}: #{{$val->ref_id}}</p>
                        <p class="text-sm text-dark mb-0">{{__('Email')}}: {{$val->email}}</p>
                        <p class="text-sm text-dark mb-0">{{__('Total')}}: {{$currency->symbol.number_format($val->total)}}</p>
                        <p class="text-sm text-dark mb-0">{{__('Sent')}}: 
                        @if($val->sent==1)
                          Yes @
                        @elseif($val->sent==0)
                          No                    
                        @endif
                        {{$val->sent_date}}</p>
                        <p class="text-sm text-dark mb-0">{{__('Due date')}}: {{date("h:i:A j, M Y", strtotime($val->due_date))}}</p>
                        <p class="text-sm text-dark mb-0 mb-3"><button type="button" class="btn-icon-clipboard" data-clipboard-text="{{route('view.invoice', ['id' => $val->ref_id])}}" title="Copy">{{__('COPY LINK')}}</button></p>
                        @if($val->status==1)
                          <span class="badge badge-pill badge-primary">{{__('Charge')}}: {{$currency->symbol.number_format($val->charge)}}</span>
                          <span class="badge badge-pill badge-success"><i class="fa fa-check"></i> {{__('Paid')}}</span>
                        @elseif($val->status==0)
                          <span class="badge badge-pill badge-danger"><i class="fa fa-spinner"></i> {{__('Pending')}}</span>                    
                        @endif

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="modal-formx{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-body p-0">
                      <div class="card bg-white border-0 mb-0">
                        <div class="card-header">
                          <h3 class="mb-0">{{__('Edit Invoice')}}</h3>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">
                          <form action="{{route('update.invoice')}}" method="post">
                            @csrf
                            <div class="form-group row">
                              <label class="col-form-label col-lg-2">{{__('Amount')}}</label>
                              <div class="col-lg-10">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">{{$currency->symbol}}</span>
                                  </div>
                                  <input type="hidden" name="id" value="{{$val->id}}"> 
                                  <input type="number" step="any" name="amount" value="{{$val->amount}}" class="form-control" required="">
                                </div>
                              </div>
                            </div>                       
                            <div class="form-group row">
                              <label class="col-form-label col-lg-2">{{__('Quantity')}}</label>
                              <div class="col-lg-10">
                                <div class="input-group input-group-merge">
                                  <input type="number" name="quantity" value="{{$val->quantity}}" class="form-control" required="">
                                </div>
                              </div>
                            </div>                        
                            <div class="form-group row">
                              <label class="col-form-label col-lg-2">{{__('Tax')}}</label>
                              <div class="col-lg-10">
                                <div class="input-group input-group-merge">
                                  <input type="number" name="tax" maxlength="10" value="{{$val->tax}}" class="form-control">
                                  <span class="input-group-append">
                                    <span class="input-group-text">%</span>
                                  </span>
                                </div>
                              </div>
                            </div>                      
                            <div class="form-group row">
                              <label class="col-form-label col-lg-2">{{__('Discount')}}</label>
                              <div class="col-lg-10">
                                <div class="input-group input-group-merge">
                                  <input type="number" name="discount" maxlength="10" value="{{$val->discount}}" class="form-control">
                                  <span class="input-group-append">
                                    <span class="input-group-text">%</span>
                                  </span>
                                </div>
                              </div>
                            </div>                           
                            <div class="form-group row">
                              <label class="col-form-label col-lg-2" for="exampleDatepicker">{{__('Due Date')}}</label>
                              <div class="col-lg-10">
                                <div class="input-group">
                                  <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                  </span>
                                  <input type="text" class="form-control datepicker" name="due_date" value="{{$val->due_date}}" required>
                                </div>
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
              <div class="modal fade" id="delete{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                  <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                      <div class="modal-content">
                          <div class="modal-body p-0">
                              <div class="card bg-white border-0 mb-0">
                                  <div class="card-header">
                                      <span class="mb-0 text-sm">{{__('Are you sure you want to delete this?, all transaction related to this invoice will also be deleted')}}</span>
                                  </div>
                                  <div class="card-body px-lg-5 py-lg-5 text-right">
                                      <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                                      <a  href="{{route('delete.invoice', ['id' => $val->id])}}" class="btn btn-danger btn-sm">{{__('Proceed')}}</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            @endforeach
          @else
           <div class="col-md-12">
            <p style="background: #fff; padding: 10px; border-radius: 7px;">Let’s Create your first Invoice!.</p>
            <div class="card">
              <!-- Card body -->
              <div class="card-body">
                <div class="row mb-3">
                  <div class="col" style="text-align:center">
                    <img src="{{url('asset/profile/nodata.png')}}" width="30%">
                  </div>
                 
                </div>
                
              </div>
            </div>
          </div>
          @endif
        </div>
        <div class="row">
          <div class="col-md-12">
          {{ $invoice->links() }}
          </div>
        </div>
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
        @foreach($paid as $k=>$val)
          <div class="card">
            <!-- Card body -->
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col">
                  <p class="text-sm text-dark mb-0">{{__('Email')}}: {{$val->email}}</p>
                  <p class="text-sm text-dark mb-0">{{__('Total')}}: {{$currency->symbol.number_format($val->total)}}</p>
                  <p class="text-sm text-dark mb-0">{{__('Due date')}}: {{date("h:i:A j, M Y", strtotime($val->due_date))}}</p>
                  <p class="text-sm text-dark mb-0">{{__('Payment link')}} <button type="button" class="btn-icon-clipboard" data-clipboard-text="{{url('/')}}/user/view-invoice/{{$val->ref_id}}" title="Copy"><i class="fa fa-copy"></i></button></p>
                  @if($val->status==1)
                    <span class="badge badge-success"><i class="fa fa-check"></i> {{__('Paid')}}</span>
                  @elseif($val->status==0)
                    <span class="badge badge-danger"><i class="fa fa-spinner"></i> {{__('Pending')}}</span>                    
                  @endif

                </div>
              </div>
            </div>
          </div>
        @endforeach 
      </div>
    </div>
@stop