@extends('userlayout')

@section('content')
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <div class="">
          <div class="card-body">
            <div class="">
              <a data-toggle="modal" data-target="#single-charge" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> {{__('Single Charge')}}</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="modal fade" id="single-charge" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                  <div class="card-header">
                    <h3 class="mb-0">{{__('Create New Payment Link')}}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    <span class="form-text text-xs">Single Charge allows you to create payment links for your customers, Transaction Charge is {{$set->single_charge}}% per transaction</span>

                  </div>
                  <div class="card-body">
                    <form action="{{route('submit.singlecharge')}}" method="post" id="modal-details">
                      @csrf
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-form-label col-lg-12">{{__('Payment link name')}}<span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="col-form-label col-lg-12">{{__('Amount')}}</label>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">{{$currency->symbol}}</span>
                                        </span>
                                        <input type="number" class="form-control" name="amount" placeholder="0.00">
                                        <span class="input-group-append">
                                            <span class="input-group-text">.00</span>
                                        </span>
                                    </div>
                                    <span class="form-text text-xs">Leave empty to allow customers enter desired amount</span>
                                </div>
                            </div>  
                        </div>  
                        <div class="form-group row">
                          <label class="col-form-label col-lg-12">{{__('Description')}}<span class="text-danger">*</span></label>
                          <div class="col-lg-12">
                              <textarea type="text" name="description" rows="4" class="tinymce form-control"></textarea>
                          </div>
                        </div>   
                        <hr>             
                        <div class="form-group row">
                          <label class="col-form-label col-lg-12">{{__('Redirect after payment  - Optional')}}</label>
                          <div class="col-lg-12">
                              <input type="text" name="redirect_url" class="form-control" placeholder="https://google.com" >
                          </div>
                        </div> 
                        <div class="text-right">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btn-sm" form="modal-details">{{__('Create link')}}</button>
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
      <div class="col-md-12">
        <div class="row">  
          @if(count($links)>0)
            @foreach($links as $k=>$val)
              <div class="col-md-4">
                <div class="card bg-white">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row mb-2">
                      <div class="col-8">
                        <button type="button" class="btn btn-sm btn-neutral mr-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-left">
                          @if($val->active==1)
                              <a class='dropdown-item' href="{{route('sclinks.unpublish', ['id' => $val->id])}}">{{ __('Disable')}}</a>
                          @else
                              <a class='dropdown-item' href="{{route('sclinks.publish', ['id' => $val->id])}}">{{ __('Activate')}}</a>
                          @endif
                          <a class="dropdown-item" href="{{route('user.sclinkstrans', ['id' => $val->id])}}">{{__('Transactions')}}</a>
                          <a class="dropdown-item" data-toggle="modal" data-target="#edit{{$val->id}}" href="#">{{__('Edit')}}</a>
                          <a class="dropdown-item" data-toggle="modal" data-target="#delete{{$val->id}}" href="">{{__('Delete')}}</a>
                        </div>
                      </div>
                      <div class="col-4 text-right">
                          @if($val->active==1)
                              <span class="badge badge-pill badge-success">{{__('Active')}}</span>
                          @else
                              <span class="badge badge-pill badge-danger">{{__('Disabled')}}</span>
                          @endif
                      </div>
                    </div>
                    <div class="row">
                        <div class="col">
                          <h5 class="h4 mb-0 text-dark">{{$val->name}}</h5>
                          <p class="text-sm text-dark mb-0">{{__('Amount')}}: @if($val->amount==null) Not fixed @else {{$currency->symbol.number_format($val->amount)}} @endif</p>
                          <p class="text-sm text-dark mb-0">{{__('Date')}}: {{date("h:i:A j, M Y", strtotime($val->created_at))}}</p>
                          <p class="text-sm text-dark mb-2"><a class="btn-icon-clipboard text-primary" data-clipboard-text="{{route('scview.link', ['id' => $val->ref_id])}}" title="Copy">{{__('COPY LINK')}}</a></p>
                        </div>
                      </div>
                  </div>
                </div>
              </div>    
              <div class="modal fade" id="edit{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-body p-0">
                      <div class="card bg-white border-0 mb-0">
                        <div class="card-header">
                          <h3 class="mb-0">{{__('Edit Payment Link')}}</h3>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">
                          <form action="{{route('update.sclinks')}}" method="post">
                            @csrf
                            <div class="form-group row">
                              <div class="col-lg-6">
                                  <label class="col-form-label col-lg-12">{{__('Payment link name')}}<span class="text-danger">*</span></label>
                                  <div class="col-lg-12">
                                      <input type="text" name="name" class="form-control" value="{{$val->name}}" required>
                                  </div>
                              </div>
                              <div class="col-lg-6">
                                  <label class="col-form-label col-lg-12">{{__('Amount')}}</label>
                                  <div class="col-lg-12">
                                      <div class="input-group">
                                          <span class="input-group-prepend">
                                              <span class="input-group-text">{{$currency->symbol}}</span>
                                          </span>
                                          <input type="number" class="form-control" name="amount" value="{{$val->amount}}" placeholder="0.00">
                                          <span class="input-group-append">
                                              <span class="input-group-text">.00</span>
                                          </span>
                                      </div>
                                      <span class="form-text text-xs">Leave empty to allow customers enter desired amount</span>
                                  </div>
                              </div>  
                            </div>  
                            <div class="form-group row">
                              <label class="col-form-label col-lg-12">{{__('Description')}}<span class="text-danger">*</span></label>
                              <div class="col-lg-12">
                                  <textarea type="text" name="description" rows="4" class="form-control tinymce">{{$val->description}}</textarea>
                              </div>
                            </div>   
                            <hr>             
                            <div class="form-group row">
                              <label class="col-form-label col-lg-12">{{__('Redirect after payment  - Optional')}}</label>
                              <div class="col-lg-12">
                                  <input type="text" name="redirect_url" class="form-control" value="{{$val->redirect_link}}" placeholder="https://google.com" >
                              </div>
                            </div>  
                            <input type="hidden" name="id" value="{{$val->id}}">                                     
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
                                      <span class="mb-0 text-sm">{{__('Are you sure you want to delete this?, all transaction related to this payment link will also be deleted')}}</span>
                                  </div>
                                  <div class="card-body px-lg-5 py-lg-5 text-right">
                                      <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                                      <a  href="{{route('delete.user.link', ['id' => $val->id])}}" class="btn btn-danger btn-sm">{{__('Proceed')}}</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            @endforeach
          @else
          <div class="col-md-12">
            <p class="text-center text-muted card-text mt-8">No Single Charge Page Found</p>
          </div>
          @endif
        </div> 
        <div class="row">
          <div class="col-md-12">
          {{ $links->links() }}
          </div>
        </div>
      </div> 
    </div>
@stop