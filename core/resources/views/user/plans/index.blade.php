
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
              <a data-toggle="modal" data-target="#create-plan" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> {{__('Plan')}}</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="modal fade" id="create-plan" tabindex="-1" role="dialog" aria-labelledby="create-plan" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
              <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                  <div class="card-header">
                    <h3 class="mb-0">{{__('Create New Plan')}}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="card-body">
                    <form action="{{route('submit.plan')}}" method="post" id="modal-details">
                      @csrf
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">{{__('Plan Name')}}<span class="text-danger">*</span></label>
                            <div class="col-lg-12">
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">{{__('Amount')}}</label>
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text">{{$currency->symbol}}</span>
                                    </span>
                                    <input type="number" class="form-control" name="amount" placeholder="0.00" min="10">
                                    <span class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </span>
                                </div>
                                <span class="form-text text-xs">Leave empty to allow customers enter desired amount</span>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12">{{__('Interval')}}</label>
                            <div class="col-lg-12">
                                <select class="form-control select" name="interval">
                                    <option value="1 Hour">{{__('Hourly')}}</option>
                                    <option value="1 Day">{{__('Daily')}}</option>
                                    <option value="1 Week">{{__('Weekly')}}</option>
                                    <option value="1 Month">{{__('Monthly')}}</option>
                                    <option value="4 Months">{{__('Quaterly')}}</option>
                                    <option value="6 Months">{{__('Every 6 Months')}}</option>
                                    <option value="1 Year">{{__('Yearly')}}</option>
                                </select>
                            </div>
                        </div>           
                        <div class="form-group row">
                          <label class="col-form-label col-lg-12">{{__('Number of times to charge a subscriber?')}}</label>
                          <div class="col-lg-12">
                              <input type="text" name="times" class="form-control">
                              <span class="form-text text-xs">Leave empty to charge subscriber indefinitely</span>
                          </div>
                        </div> 
                        <div class="text-right">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btn-sm" form="modal-details">{{__('Create plan')}}</button>
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
    <div class="card">
      <div class="card-header header-elements-inline">
        <h3 class="mb-0">{{__('Plans')}}</h3>
      </div>
      <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-buttons">
          <thead>
            <tr>
              <th>{{__('S / N')}}</th>
              <th>{{__('Name')}}</th>
              <th>{{__('Amount')}}</th>
              <th>{{__('Interval')}}</th>
              <th>{{__('Expired/Active')}}</th>
              <th>{{__('Status')}}</th>
              <th>{{__('Created')}}</th>
              <th class="scope"></th>  
              <th class="scope"></th>  
            </tr>
          </thead>
          <tbody>  
            @foreach($plans as $k=>$val)
              @php 
                $active=App\Models\Subscribers::whereplan_id($val->id)->where('expiring_date', '>', Carbon\Carbon::now())->count();
                $expired=App\Models\Subscribers::whereplan_id($val->id)->where('expiring_date', '<', Carbon\Carbon::now())->count();
              @endphp
              <tr>
                  <td>{{++$k}}.</td>
                  <td>{{$val->name}}</td>
                  <td>{{$currency->symbol.number_format($val->amount)}}</td>
                  <td>{{$val->intervals}} - @if($val->times==null) Indefinitely @else {{$val->times}} time(s) @endif</td>
                  <td>{{$expired}} / {{$active}}</td>
                  <td>@if($val->active==0) <span class="badge badge-pill badge-danger">Disabled</span> @elseif($val->active==1) <span class="badge badge-pill badge-success">Active</span>@endif</td>
                  <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                  <td><a class="btn-icon-clipboard text-primary" data-clipboard-text="{{route('subview.link', ['id' => $val->ref_id])}}" title="Copy">{{__('Copy Subscription Link')}}</a></td>
                  <td class="text-right">
                  <div class="dropdown">
                          <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                              <a href="{{route('user.plansub', ['id' => $val->ref_id])}}" class="dropdown-item">{{__('Subscribers')}}</a>
                              <a data-toggle="modal" data-target="#edit{{$val->id}}" href="" class="dropdown-item">{{__('Edit')}}</a>
                              @if($val->active==1)
                                <a class='dropdown-item' href="{{route('plan.unpublish', ['id' => $val->id])}}">{{ __('Disable')}}</a>
                              @else
                                <a class='dropdown-item' href="{{route('plan.publish', ['id' => $val->id])}}">{{ __('Activate')}}</a>
                              @endif
                          </div>
                      </div>
                  </td> 
              </tr>
              <div class="modal fade" id="edit{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                  <div class="modal-content">
                    <div class="modal-body p-0">
                      <div class="card bg-white border-0 mb-0">
                        <div class="card-header">
                          <h3 class="mb-0">{{__('Edit Plan')}}</h3>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="card-body">
                          <form action="{{route('update.plan')}}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label class="col-form-label col-lg-12">{{__('Plan Name')}}<span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <input type="text" name="name" class="form-control" value="{{$val->name}}" required>
                                    <span class="form-text text-xs">Amount & Interval can only be edited if no active subscriber</span>
                                </div>
                            </div>
                            @if($active<1)
                            <div class="form-group row">
                              <label class="col-form-label col-lg-12">{{__('Amount')}}</label>
                              <div class="col-lg-12">
                                  <div class="input-group">
                                      <span class="input-group-prepend">
                                          <span class="input-group-text">{{$currency->symbol}}</span>
                                      </span>
                                      <input type="number" class="form-control" name="amount" placeholder="0.00" min="10" value="{{$val->amount}}">
                                      <span class="input-group-append">
                                          <span class="input-group-text">.00</span>
                                      </span>
                                  </div>
                                  <span class="form-text text-xs">Leave empty to allow customers enter desired amount</span>
                              </div>
                            </div>  
                            <div class="form-group row">
                              <label class="col-form-label col-lg-12">{{__('Interval')}}</label>
                              <div class="col-lg-12">
                                  <select class="form-control select" name="interval">
                                      <option value="1 Hour" @if($val->intervals=='1 Hour') selected @endif>{{__('Hourly')}}</option>
                                      <option value="1 Day" @if($val->intervals=='1 Day') selected @endif>{{__('Daily')}}</option>
                                      <option value="1 Week" @if($val->intervals=='1 Week') selected @endif>{{__('Weekly')}}</option>
                                      <option value="1 Month" @if($val->intervals=='1 Month') selected @endif>{{__('Monthly')}}</option>
                                      <option value="4 Months" @if($val->intervals=='4 Months') selected @endif>{{__('Quaterly')}}</option>
                                      <option value="6 Months" @if($val->intervals=='6 Months') selected @endif>{{__('Every 6 Months')}}</option>
                                      <option value="1 Year" @if($val->intervals=='1 Year') selected @endif>{{__('Yearly')}}</option>
                                  </select>
                              </div>
                            </div> 
                            @endif
                            <input name="plan_id" type="hidden" value="{{$val->id}}">               
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
          </tbody>
        </table>
      </div>
    </div>

@stop