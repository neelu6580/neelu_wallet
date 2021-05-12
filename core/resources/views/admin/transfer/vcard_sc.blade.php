
@extends('master')

@section('content')
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
      
    <div class="card">
      <div class="card-header header-elements-inline">
                                                      <a  style="float:right;margin-top:30px!important;margin-right:20px" data-toggle="modal" data-target="#single-charge" href="" class="btn btn-success">{{__('Add New')}}</a>

        <h3 class="mb-0">{{__('Virtual Card Single Charge')}}</h3>
        
      </div>
      <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-buttons">
          <thead>
            <tr>
              <th>{{__('S / N')}}</th>
            
              <th>{{__('Name')}}</th>
              <th>{{__('Amount')}}</th>
              <th>{{__('Reference ID')}}</th>
              <th>{{__('Redirect Url')}}</th>
             
              <th>{{__('Link')}}</th>
               <th>{{__('Status')}}</th>
              <th>{{__('Created')}}</th>
              <th>{{__('Updated')}}</th>
              
              <th>Action</th>
            </tr>
          </thead>
          <tbody>  
          
          
            @foreach($links as $k=>$val)
              <tr>
                <td>{{++$k}}.</td>
                <td>{{$val->name}}</td>
                <td>{{$val->amount}}</td>
                <td>{{$val->ref_id}}</td>
                <td>{{$val->redirect_link}}</td>
              
                <td>
                <a class="btn-icon-clipboard text-primary" data-clipboard-text="{{url('vcard-single-charge')}}/{{$val->ref_id}}" title="" data-original-title="Copy">COPY LINK</a>
                </td>
                <td>
                    @if($val->status== 0)
                        <span class="badge badge-pill badge-danger">{{__('Inactive')}}</span>
                    @elseif($val->status== 1)
                        <span class="badge badge-pill badge-success">{{__('Active')}}</span>
                    @elseif($val->status== 2)
                        <span class="badge badge-pill badge-danger">{{__('Deleted')}}</span>    
                    
                    @endif
                </td> 
                <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>
                <td>
                    <div class="">
                                            <div class="dropdown">
                                                <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a data-toggle="modal" data-target="#edit-single-charge{{$val->id}}" href="" class="dropdown-item"><i class="fa fa-pen"></i>{{__('Edit')}}</a>

                                                    
                                                   
                                                    <a data-toggle="modal" data-target="#delete{{$val->id}}" href="" class="dropdown-item"><i class="fa fa-times-circle" aria-hidden="true"></i>{{__('Delete')}}</a>
                                                   
                                                    
                                                </div>
                                            </div>
                                        </div> 
                </td>
            </tr>
            
            <div class="modal fade" id="edit-single-charge{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                  <div class="card-header">
                    <h3 class="mb-0">{{__('Update Payment Link')}}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    <span class="form-text text-xs">Single Charge allows you to create payment links for your customers, Transaction Charge is {{$set->single_charge}}% per transaction</span>

                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.vcard_single_charge_edit')}}" method="post" id="modal-details">
                      @csrf
                      <input type="hidden" name="link_id" value="{{$val->id}}">
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
                                        <input type="number" class="form-control" name="amount" placeholder="0.00" value="{{$val->amount}}">
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
                              <textarea type="text" name="description" rows="4" class="tinymce form-control">{{$val->description}}</textarea>
                          </div>
                        </div>   
                        <hr>             
                        <div class="form-group row">
                          <label class="col-form-label col-lg-12">{{__('Redirect after payment  - Optional')}}</label>
                          <div class="col-lg-12">
                              <input type="text" name="redirect_url" class="form-control" placeholder="https://google.com" value="{{$val->redirect_link}}">
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
                    <form action="{{route('admin.vcard_single_charge')}}" method="post" id="modal-details">
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

<div class="modal fade" id="delete{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0">{{__('Are you sure you want to delete this?')}}</h3>
                                                    </div>
                                                    <div class="card-body px-lg-5 py-lg-5 text-right">
                                                        <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                                                        <a  href="{{route('admin.delete_virtual_card_paylink', ['id' => $val->id])}}" class="btn btn-danger btn-sm">{{__('Proceed')}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

@stop