@extends('userlayout')

@section('content')
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <div class="">
          <div class="card-body">
            <div class="">
              <a href="{{route('open.ticket')}}" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> {{__('Open Ticket')}}</a>
            </div>
          </div>
        </div>
      </div>
    </div> 
    <div class="row">
      @if(count($ticket)>0)
        @foreach($ticket as $k=>$val)
          <div class="col-md-6">
            <div class="card">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-7">
                      <!-- Title -->
                      <h5 class="h4 mb-0">#{{$val->ticket_id}}</h5>
                    </div>
                    <div class="col-5 text-right">
                      <a href="{{url('/')}}/user/reply-ticket/{{$val->id}}" class="btn btn-sm btn-neutral">{{__('Reply')}}</a>
                      <a data-toggle="modal" data-target="#delete{{$val->id}}" href="" class="btn btn-sm btn-danger">{{__('Delete')}}</a>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <p class="text-sm text-dark mb-0">{{__('Subject')}}: {{$val->subject}}</p>
                      <p class="text-sm text-dark mb-0">{{__('Transaction Reference')}}: @if($val->ref_no==null){{__('Null')}} @else {{$val->ref_no}} @endif</p>
                      <p class="text-sm text-dark mb-0">{{__('Priority')}}: {{$val->priority}}</p>
                      <p class="text-sm text-dark mb-0">{{__('Status')}}: @if($val->status==0){{__('Open')}} @elseif($val->status==1){{__('Closed')}} @elseif($val->status==2){{__('Resolved')}} @endif</p>
                      <p class="text-sm text-dark mb-0">{{__('Created')}}: {{date("Y/m/d h:i:A", strtotime($val->created_at))}}</p>
                      <p class="text-sm text-dark mb-2">{{__('Updated')}}: {{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</p>
                      <span class="badge badge-pill badge-success">{{$val->type}}</span>
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
                                  <a  href="{{route('ticket.delete', ['id' => $val->id])}}" class="btn btn-danger btn-sm">{{__('Proceed')}}</a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        @endforeach
      @else
      <div class="col-md-12">
        <p class="text-center text-muted card-text mt-8">No Support Ticket Found</p>
      </div>
      @endif
    </div>
    <div class="row">
      <div class="col-md-12">
      {{ $ticket->links() }}
      </div>
    </div>
@stop