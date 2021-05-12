@extends('master')

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                                        <div>

                                            <a  style="float:right;margin-top:30px!important;margin-right:20px" data-toggle="modal" data-target="#addNewSubscription" href="" class="btn btn-success">{{__('Add New')}}</a></div>

                    <div class="card-header">
                        <h3 class="card-title">{{__('List of All Subscriptions')}}</h3>
                        
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                            <thead>
                                <tr>
                                    <th>{{__('S/N')}}</th>
                                    <th>{{__('Plan Name')}}</th>
                                    <th>{{__('Card Quantity')}}</th>
                                     <th>{{__('Expedited Fee')}}</th>
                                    <th>{{__('Price')}}</th>
                                    <th>{{__('Features')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('Date')}}</th>
                                    <th>{{__('Last Update')}}</th>
                                    <th class="text-center">{{__('Action')}}</th>    
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($virtualCardsPlan as $k => $planDetails)

                                <tr>
                                    <td>{{++$k}}.</td>
                                    <td>{{$planDetails->plan_name}}</td>
                                    
                                    
                                    <td>{{$planDetails->plan_quantity}}</td>
                                    <td>{{$currency->symbol.number_format($planDetails->plan_expedited_fee,2)}}</td>
                                    <td>{{$currency->symbol.number_format($planDetails->plan_price,2)}}</td>
                                    <td>{!!$planDetails->plan_features!!}</td>
                                    <td>
                                        @if($planDetails->status== 0)
                                            <span class="badge badge-pill badge-danger">{{__('Inactive')}}</span>
                                        @elseif($planDetails->status== 1)
                                            <span class="badge badge-pill badge-success">{{__('Active')}}</span>
                                        @elseif($planDetails->card_state== 2)
                                            <span class="badge badge-pill badge-danger">{{__('Deleted')}}</span>    
                                        
                                        @endif
                                    </td> 
                                    <td>{{date("Y/m/d h:i:A", strtotime($planDetails->created_at))}}</td>
                                    <td>{{date("Y/m/d h:i:A", strtotime($planDetails->updated_at))}}</td>
                                    <td class="text-center">
                                        <div class="">
                                            <div class="dropdown">
                                                <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a data-toggle="modal" data-target="#editSubscription{{$planDetails->id}}" href="" class="dropdown-item"><i class="fa fa-pen"></i>{{__('Edit')}}</a>

                                                    
                                                   
                                                    <a data-toggle="modal" data-target="#delete{{$planDetails->id}}" href="" class="dropdown-item"><i class="fa fa-times-circle" aria-hidden="true"></i>{{__('Delete')}}</a>
                                                   
                                                    
                                                </div>
                                            </div>
                                        </div> 
                                    </td>                    
                                </tr>
                                
                                 <div class="modal fade" id="editSubscription{{$planDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0">{{__('Update Subscription Plan')}} </h3>
                                                    </div>
                                                      <form action="{{route('admin.edit_virtual_card_subsription')}}" method="POST">
                                                        @csrf
                                                       <input type="hidden" name="plan_id" value="{{$planDetails->id}}">
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                {{__('Plan Name')}}</label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <input class="form-control" type="text" name="plan_name" placeholder="Enter Plan Name" value="{{$planDetails->plan_name}}" required>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                {{__('Card Quantity')}}</label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <input class="form-control" type="text" name="plan_quantity" placeholder="Enter Card Quantity"  value="{{$planDetails->plan_quantity}}" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                                            </div>
                                                        </div>
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                {{__('Expedited Fee (USD)')}}</label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <input class="form-control" type="text" name="plan_expedited_fee" placeholder="Enter Expedited Fee" value="{{$planDetails->plan_expedited_fee}}"  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                                            </div>
                                                        </div>
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                {{__('Price (USD)')}}</label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <input class="form-control" type="text" name="plan_price" placeholder="e.g. 50"  value="{{$planDetails->plan_price}}" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                                            </div>
                                                        </div>
                                                        <!--div class="row p-3">
                                                            <div class="col-sm-3">
                                                                {{__('Features')}}</label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <textarea class="form-control" type="text" name="plan_features" placeholder="Enter Features Details"  required>{{$planDetails->plan_features}}</textarea>
                                                            </div>
                                                        </div-->
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                {{__('Status')}}</label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <select class="form-control" name="status">
                                                                     <option>Select Status</option>
                                                                     <option value="1" @if($planDetails->status == 1){{'selected'}} @endif>Active</option>
                                                                     <option value="0" @if($planDetails->status == 0){{'selected'}} @endif>Inactive</option>
                                                                    </select> 
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                          <label class="col-form-label col-lg-12">{{__('Description')}}<span class="text-danger">*</span></label>
                                                          <div class="col-lg-12">
                                                              <textarea type="text" name="plan_features" rows="4" class="tinymce form-control">{{$planDetails->plan_features}}</textarea>
                                                          </div>
                                                        </div>
                                                        
                                                    <div class="card-body px-lg-5 py-lg-5 text-right">
                                                        <button type="button" class="btn btn-neutral" data-dismiss="modal">{{__('Close')}}</button>
                                                        <button  type="submit" class="btn btn-success">{{__('Update Now')}}</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                
                                <div class="modal fade" id="delete{{$planDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0">{{__('Are you sure you want to delete this?')}}</h3>
                                                    </div>
                                                    <div class="card-body px-lg-5 py-lg-5 text-right">
                                                        <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                                                        <a  href="{{route('admin.delete_virtual_card_plan', ['id' => $planDetails->id])}}" class="btn btn-danger btn-sm">{{__('Proceed')}}</a>
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
            </div>
        </div>
    </div>
</div>
<!--ADD MODEL-->
 <div class="modal fade" id="addNewSubscription" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0">{{__('Add New Subscription Plan')}} </h3>
                                                    </div>
                                                      <form action="{{route('admin.add_virtual_card_subsription')}}" method="POST">
                                                        @csrf
                                                       
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                {{__('Plan Name')}}</label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <input class="form-control" type="text" name="plan_name" placeholder="Enter Plan Name" required>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                {{__('Card Quantity')}}</label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <input class="form-control" type="text" name="plan_quantity" placeholder="Enter Card Quantity"   onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                                            </div>
                                                        </div>
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                {{__('Expedited Fee (USD)')}}</label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <input class="form-control" type="text" name="plan_expedited_fee" placeholder="Enter Expedited Fee" value=""  onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                                            </div>
                                                        </div>
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                {{__('Price (USD)')}}</label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <input class="form-control" type="text" name="plan_price" placeholder="e.g. 50"  value="" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                          <label class="col-form-label col-lg-12">{{__('Description')}}<span class="text-danger">*</span></label>
                          <div class="col-lg-12">
                              <textarea type="text" name="plan_features" rows="4" class="tinymce form-control"></textarea>
                          </div>
                        </div>  
                                                    <div class="card-body px-lg-5 py-lg-5 text-right">
                                                        <button type="button" class="btn btn-neutral" data-dismiss="modal">{{__('Close')}}</button>
                                                        <button  type="submit" class="btn btn-success">{{__('Add Now')}}</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
@stop