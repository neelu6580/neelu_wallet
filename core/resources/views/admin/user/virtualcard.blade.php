@extends('master')

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                                        <div><a  style="float:right;margin-top:30px!important;margin-right:20px" href="{{url('admin/virtual_cards_transactions')}}" class="btn btn-primary">{{__('Transactions List')}}</a></div>

                    <div class="card-header">
                        <h3 class="card-title">{{__('List of All Virtual Cards')}}</h3>
                        
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                            <thead>
                                <tr>
                                    <th>{{__('S/N')}}</th>
                                    <th>{{__('Username')}}</th>
                                    <th>{{__('Name on Card')}}</th>
                                    <th>{{__('Spend Limit')}}</th>                                                                     
                                    <th>{{__('Last 4 Digit')}}</th>
                                    <th>{{__('Exp')}}</th>
                                    <th>{{__('Funding Acct No')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('Date')}}</th>
                                    <th>{{__('Last Update')}}</th>
                                    <th class="text-center">{{__('Action')}}</th>    
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($virtualCardsList as $k => $cardDetails)

                                <tr>
                                    <td>{{++$k}}.</td>
                                    <td><a href="{{url('admin/manage-user')}}/{{$cardDetails->user_id}}">{{$cardDetails->FirstName}} {{$cardDetails->LastName}}</a></td>
                                    <td>{{$cardDetails->memo}}</td>
                                    <td>{{$currency->symbol.number_format($cardDetails->spend_limit)}}</td>
                                    
                                    <td>XXXX XXXX XXXX {{$cardDetails->last_four_digit}}</td>
                                    <td>{{$cardDetails->exp_month}}/{{$cardDetails->exp_year}}</td>
                                    <td>XXXXXXXX{{$cardDetails->FundingLastFour}}</td>
                                    <td>
                                        @if($cardDetails->card_state== 'PAUSED')
                                            <span class="badge badge-pill badge-primary">{{__('Inactive')}}</span>
                                        @elseif($cardDetails->card_state== 'OPEN')
                                            <span class="badge badge-pill badge-success">{{__('Active')}}</span>
                                        @elseif($cardDetails->card_state== 'CLOSED')
                                            <span class="badge badge-pill badge-danger">{{__('Closed')}}</span>    
                                        
                                        @endif
                                    </td> 
                                    <td>{{date("Y/m/d h:i:A", strtotime($cardDetails->created_at))}}</td>
                                    <td>{{date("Y/m/d h:i:A", strtotime($cardDetails->updated_at))}}</td>
                                    <td class="text-center">
                                        <div class="">
                                            <div class="dropdown">
                                                <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a href="{{route('admin.virtualtransactions', ['id' => $cardDetails->token])}}" class="dropdown-item"><i class="fa fa-list"></i>{{__('Transactons')}}</a>
                                                    <a data-toggle="modal" data-target="#edit{{$cardDetails->id}}" href="" class="dropdown-item"><i class="fa fa-pen"></i>{{__('Edit')}}</a>

                                                    @if($cardDetails->card_state == 'OPEN')
                                                    <a data-toggle="modal" data-target="#pause{{$cardDetails->id}}" href="" class="dropdown-item"><i class="fa fa-pause-circle"></i>{{__('Pause')}}</a>
                                                    @endif
                                                    @if($cardDetails->card_state == 'PAUSED')
                                                    <a data-toggle="modal" data-target="#unpause{{$cardDetails->id}}" href="" class="dropdown-item"><i class="fa fa-play-circle"></i>{{__('Unpause')}}</a>
                                                    @endif
                                                     @if($cardDetails->card_state != 'CLOSED')
                                                    <a data-toggle="modal" data-target="#close{{$cardDetails->id}}" href="" class="dropdown-item"><i class="fa fa-trash"></i>{{__('Close')}}</a>
                                                    @endif
                                                    @if($cardDetails->card_state == 'CLOSED')
                                                    <a data-toggle="modal" data-target="#delete{{$cardDetails->id}}" href="" class="dropdown-item"><i class="fa fa-times-circle" aria-hidden="true"></i>{{__('Delete')}}</a>
                                                    @endif
                                                    {{--@if($cardDetails->status==1)
                                                        <a class='dropdown-item' href="{{route('withdraw.decline', ['id' => $cardDetails->id])}}">{{__('Decline')}}</a>
                                                        <a class='dropdown-item' href="{{route('withdraw.approve', ['id' => $cardDetails->id])}}">{{__('Approve')}}</a>
                                                    @endif --}}
                                                </div>
                                            </div>
                                        </div> 
                                    </td>                    
                                </tr>
                                <div class="modal fade" id="edit{{$cardDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0">{{__($cardDetails->FirstName)}} {{__($cardDetails->LastName)}} {{__('Card Details')}} {{'('}}{{__($cardDetails->last_four_digit)}}{{')'}}</h3>
                                                    </div>
                                                      <form action="{{route('admin.edit_virtual_card')}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{$cardDetails->user_id}}">
                                                        <input type="hidden" name="card_token" value="{{$cardDetails->token}}">
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                {{__('Card Number')}}</label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <input class="form-control" type="text" name="pan" placeholder="e.g. 4111186115678945" minlength="16" maxlength="16" value="{{$cardDetails->pan}}" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                                            </div>
                                                        </div>
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                {{__('Card Exp Months')}}</label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <input class="form-control" type="text" name="exp_month" placeholder="e.g. 03" minlength="2" maxlength="2" value="{{$cardDetails->exp_month}}" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                                            </div>
                                                        </div>
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                {{__('Card Exp Year')}}</label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <input class="form-control" type="text" name="exp_year" placeholder="e.g. 2024" minlength="4" maxlength="4" value="{{$cardDetails->exp_year}}" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                                            </div>
                                                        </div>
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                {{__('Card CVV')}}</label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <input class="form-control" type="text" name="cvv" placeholder="e.g. 123" minlength="3" maxlength="3" value="{{$cardDetails->cvv}}" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
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
                                <div class="modal fade" id="close{{$cardDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0">{{__('Are you sure you want to closed this?')}}</h3>
                                                    </div>
                                                    <form action="{{route('admin.close_virtual_card')}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{$cardDetails->user_id}}">
                                                        <input type="hidden" name="card_token" value="{{$cardDetails->token}}">
                                                    <div class="card-body px-lg-5 py-lg-5 text-right">
                                                        <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                                                        <button  type="submit" class="btn btn-danger btn-sm">{{__('Closed Now')}}</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="unpause{{$cardDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0">{{__('Are you sure you want to unpause this?')}}</h3>
                                                    </div>
                                                    <form action="{{route('admin.open_virtual_card')}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{$cardDetails->user_id}}">
                                                        <input type="hidden" name="card_token" value="{{$cardDetails->token}}">
                                                    <div class="card-body px-lg-5 py-lg-5 text-right">
                                                        <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                                                        <button  type="submit" class="btn btn-danger btn-sm">{{__('Unpause Now')}}</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="pause{{$cardDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0">{{__('Are you sure you want to pause this?')}}</h3>
                                                    </div>
                                                    <form action="{{route('admin.pause_virtual_card')}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{$cardDetails->user_id}}">
                                                        <input type="hidden" name="card_token" value="{{$cardDetails->token}}">
                                                    <div class="card-body px-lg-5 py-lg-5 text-right">
                                                        <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                                                        <button  type="submit" class="btn btn-danger btn-sm">{{__('Pause Now')}}</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="delete{{$cardDetails->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0">{{__('Are you sure you want to delete this?')}}</h3>
                                                    </div>
                                                    <div class="card-body px-lg-5 py-lg-5 text-right">
                                                        <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{__('Close')}}</button>
                                                        <a  href="{{route('admin.delete_virtual_card', ['id' => $cardDetails->id])}}" class="btn btn-danger btn-sm">{{__('Proceed')}}</a>
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
@stop