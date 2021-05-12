@extends('master')

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                                        <div>

                                            <a  style="float:right;margin-top:30px!important;margin-right:20px" data-toggle="modal" data-target="#addNew" href="" class="btn btn-success">{{__('Add New')}}</a></div>

                    <div class="card-header">
                        <h3 class="card-title">{{__('List of All Card Type')}}</h3>
                        
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                            <thead>
                                <tr>
                                    <th>{{__('S/N')}}</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Description')}}</th>                                                                     
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('Date')}}</th>
                                    <th>{{__('Last Update')}}</th>
                                    <th class="text-center">{{__('Action')}}</th>    
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($virtualCardsType as $k => $typeDetails)

                                <tr>
                                    <td>{{++$k}}.</td>
                                    <td>{{$typeDetails->name}}</td>
                                    <td>{{$typeDetails->description}}</td>
                                    
                                  
                                  
                                   
                                    <td>
                                        @if($typeDetails->status== 0)
                                            <span class="badge badge-pill badge-danger">{{__('Inactive')}}</span>
                                        @elseif($typeDetails->status== 1)
                                            <span class="badge badge-pill badge-success">{{__('Active')}}</span>
                                        @elseif($typeDetails->card_state== 2)
                                            <span class="badge badge-pill badge-danger">{{__('Deleted')}}</span>    
                                        
                                        @endif
                                    </td> 
                                    <td>{{date("Y/m/d h:i:A", strtotime($typeDetails->created_at))}}</td>
                                    <td>{{date("Y/m/d h:i:A", strtotime($typeDetails->updated_at))}}</td>
                                    <td class="text-center">
                                        <div class="">
                                            <div class="dropdown">
                                                <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a data-toggle="modal" data-target="#editSubscription{{$typeDetails->id}}" href="" class="dropdown-item"><i class="fa fa-pen"></i>{{__('Edit')}}</a>

                                                    
                                                   
                                                    <a data-toggle="modal" data-target="#delete{{$typeDetails->id}}" href="" class="dropdown-item"><i class="fa fa-times-circle" aria-hidden="true"></i>{{__('Delete')}}</a>
                                                   
                                                    
                                                </div>
                                            </div>
                                        </div> 
                                    </td>                    
                                </tr>
                                
                                 <div class="modal fade" id="editSubscription{{$typeDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0">{{__('Update Card Type')}} </h3>
                                                    </div>
                                                      <form action="{{route('admin.edit_virtual_card_type')}}" method="POST">
                                                        @csrf
                                                       <input type="hidden" name="type_id" value="{{$typeDetails->id}}">
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                {{__('Name')}}</label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <input class="form-control" type="text" name="type_name" placeholder="Enter Card Type Name" value="{{$typeDetails->name}}" required>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                {{__('Description')}}</label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <textarea class="form-control" type="text" name="description" placeholder="Enter Description"  required>{{$typeDetails->description}}</textarea>
                                                            </div>
                                                        </div>
                                                         <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                {{__('Status')}}</label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <select class="form-control" name="status">
                                                                     <option>Select Status</option>
                                                                     <option value="1" @if($typeDetails->status == 1){{'selected'}} @endif>Active</option>
                                                                     <option value="0" @if($typeDetails->status == 0){{'selected'}} @endif>Inactive</option>
                                                                    </select> 
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
                                
                                
                                
                                
                                <div class="modal fade" id="delete{{$typeDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0">{{__('Are you sure you want to delete this?')}}</h3>
                                                    </div>
                                                    <div class="card-body px-lg-5 py-lg-5 text-right">
                                                        <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                                                        <a  href="{{route('admin.delete_virtual_card_type', ['id' => $typeDetails->id])}}" class="btn btn-danger btn-sm">{{__('Proceed')}}</a>
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
 <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0">{{__('Add New Card Type')}} </h3>
                                                    </div>
                                                      <form action="{{route('admin.add_virtual_card_type')}}" method="POST">
                                                        @csrf
                                                       
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                {{__('Type Name')}}</label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <input class="form-control" type="text" name="type_name" placeholder="Enter Type Name" required>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                {{__('Features')}}</label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <textarea class="form-control" type="text" name="description" placeholder="Enter Description" required></textarea>
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