
@extends('master')

@section('content')
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
      
    <div class="card">
      <div class="card-header header-elements-inline">

        <h3 class="mb-0">{{__('Single Charge')}}</h3>
        
      </div>
      <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-buttons">
          <thead>
            <tr>
              <th>{{__('S / N')}}</th>
              <th>{{__('Merchant')}}</th>
              <th>{{__('Name')}}</th>
              <th>{{__('Amount')}}</th>
              <th>{{__('Reference ID')}}</th>
              <th>{{__('Redirect Url')}}</th>
              <th>{{__('Status')}}</th>
              <th>{{__('Suspended')}}</th>
              <th>{{__('Created')}}</th>
              <th>{{__('Updated')}}</th>
              <th>{{__('Link')}}</th>
              <th></th>
            </tr>
          </thead>
          <tbody>  
          
          
            @foreach($links as $k=>$val)
              <tr>
                <td>{{++$k}}.</td>
                <td>@if($val->user['business_name']==null) [Deleted] @else {{$val->user['business_name']}} @endif</td>
                <td>{{$val->name}}</td>
                <td>@if($val->amount==null) Not fixed @else {{$currency->symbol.number_format($val->amount)}} @endif</td>
                <td>#{{$val->ref_id}}</td>
                <td>@if($val->redirect_link==null) null @else {{$val->redirect_link}} @endif</td>
                <td>
                    @if($val->active==1)
                        <span class="badge badge-pill badge-success">{{__('Active')}}</span>
                    @else
                        <span class="badge badge-pill badge-danger">{{__('Disabled')}}</span>
                    @endif
                </td>                
                <td>
                    @if($val->status==1)
                        <span class="badge badge-pill badge-success">{{__('Yes')}}</span>
                    @else
                        <span class="badge badge-pill badge-danger">{{__('No')}}</span>
                    @endif
                </td>
                <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>
                <td>{{route('scview.link', ['id' => $val->ref_id])}}</td>
                <td class="text-center">
                    <div class="">
                        <div class="dropdown">
                            <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                @if($val->status==1)
                                    <a class='dropdown-item' href="{{route('links.unpublish', ['id' => $val->id])}}">{{ __('Unsuspend')}}</a>
                                @else
                                    <a class='dropdown-item' href="{{route('links.publish', ['id' => $val->id])}}">{{ __('Suspend')}}</a>
                                @endif
                                <a class="dropdown-item" href="{{route('admin.linkstrans', ['id' => $val->id])}}">{{__('Transactions')}}</a>
                                <a data-toggle="modal" data-target="#delete{{$val->id}}" href="" class="dropdown-item">{{ __('Delete')}}</a>
                                <a data-toggle="modal" data-target="#description{{$val->id}}" href="" class="dropdown-item">{{ __('Description')}}</a>
                            </div>
                        </div>
                    </div> 
                </td>
                <div class="modal fade" id="delete{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card bg-white border-0 mb-0">
                                    <div class="card-header">
                                        <h3 class="mb-0">{{__('Are you sure you want to delete this?')}}</h3>
                                    </div>
                                    <div class="card-body px-lg-5 py-lg-5 text-right">
                                        <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{ __('Close')}}</button>
                                        <a  href="{{route('delete.link', ['id' => $val->id])}}" class="btn btn-danger btn-sm">{{ __('Proceed')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
                <div class="modal fade" id="description{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card bg-white border-0 mb-0">
                                    <div class="card-header">
                                        <p class="mb-0 text-sm">{{$val->description}}</p>
                                    </div>
                                    <div class="card-body px-lg-5 py-lg-5 text-right">
                                        <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{ __('Close')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    
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

@stop