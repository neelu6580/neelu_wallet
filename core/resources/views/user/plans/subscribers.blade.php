
@extends('userlayout')

@section('content')
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="card">
      <div class="card-header header-elements-inline">
        <h3 class="mb-0">{{$plan->name}} - #{{$plan->ref_id}}</h3>
      </div>
      <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-buttons">
          <thead>
            <tr>
              <th>{{__('S / N')}}</th>
              <th>{{__('Amount')}}</th>
              <th>{{__('Subscriber')}}</th>
              <th>{{__('Reference ID')}}</th>
              <th>{{__('Expiring Date')}}</th>
              <th>{{__('Renewal')}}</th>
              <th>{{__('Created')}}</th>
            </tr>
          </thead>
          <tbody>  
            @foreach($sub as $k=>$val)
              <tr>
                <td>{{++$k}}.</td>
                <td>@if($val->plan['amount']==null){{$currency->symbol.number_format($val->amount)}} @else {{$currency->symbol.number_format($val->plan['amount'])}} @endif</td>
                <td>{{$val->user['first_name'].' '.$val->user['last_name']}}</td>
                <td>#{{$val->ref_id}}</td>
                <td>{{date("Y/m/d h:i:A", strtotime($val->expiring_date))}}</td>
                <td>@if($val->times>0 && $val->status==1) Yes @else No @endif</td>
                <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

@stop