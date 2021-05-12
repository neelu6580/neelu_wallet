<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
table,tr,th,td{
  border:1px solid #dddddd;
  border-collapse:collapse;
}
td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

th {
  background-color: #dddddd;
}
</style>

@extends('userlayout')

@section('content')
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12">
        <div class="card-header">
            <h5 class="h3 mb-0">{{__('Orders')}}</h5>
          </div>
        <div class="row"> 
        @if(isset($orders) && count($orders) > 0)
          @foreach($orders as $k=>$val)
            <div class="col-md-12">
              <div class="card bg-white">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-6">
                      <!-- Title -->
                      <h5 class="h4 mb-0 text-dark">Order Id : #{{$val->ref_id}}</h5>
                    </div>
                    
                    
                            
                       
                    
                    <div class="col-6">
                        <h5 class="h4 mb-0 text-dark" style="  margin-top: -8px!important;  text-align: right;">
                             
                          
                     <?php 
                            if($val->buy_shipment == '0'){
                            }elseif($val->buy_shipment == '1'){
                            }else{
                            require_once("/home/cuminup/public_html/core/vendor/easypost/easypost-php/lib/easypost.php");
                            $privateKey = env('EASYPOST_API_KEY');
                            \EasyPost\EasyPost::setApiKey($privateKey);
                            $shipment_id = $val->buy_shipment;
                            
                            $shipment = \EasyPost\Shipment::retrieve($shipment_id);
                            //dd($shipment->postage_label['label_url']);
                        ?>
                        <a href="{{ $shipment->postage_label['label_url'] }}" target="_blank" style="    padding: 8px 5px; background: #ed8305; color: white; border-radius: 5px;">Generate Postage Label</a>
                        <a href="{{ url('easy_track/'.$val->id) }}" target="_blank" style="padding: 8px 9px; background: #4377c4; color: white; border-radius: 5px;">Track Order</a>
                         <?php } ?>
                        
                         
                            </h5>
                        </div>
                  </div>
                  <div class="row">
                      <div class="col">
    
                      <div class="table-responsive">
<table class="table">
                          <tbody>
  <tr>
    <th>{{__('Product')}}</th>
    <th>{{__('Name')}}</th>
    <th>{{__('Email')}}</th>
    <th>{{__('Phone')}}</th>
    <th>{{__('Quantity')}}</th>
    <th>{{__('Country')}}</th>
    <th>{{__('State')}}</th>
    <th>{{__('Town/City')}}</th>
    <th>{{__('Address')}}</th>
    <th>{{__('Shipping fee')}}</th>
    @if(!empty($val->note))
    <th>{{__('Note')}}</th>
    @endif
   
    <th>{{__('Amount')}}</th>
    <th>{{__('Total')}}</th>
    <th>{{__('Created')}}</th>
    <th>{{__('Fee')}}</th>
  
  </tr>
  <tr>
    <td>{{$val->product->name}}</td>
    <td>{{$val->first_name}} {{$val->last_name}}r</td>
    <td>{{$val->email}}</td>
    <td>{{$val->phone}}</td>
    @if($val->product->quantity_status==0)
    <td>{{$val->quantity}}</td>
     @endif                        
     @if($val->product->shipping_status==1)
    <td>{{$val->country}}</td>
    <td>{{$val->state}}</td>
    <td>{{$val->town}}</td>
    <td>{{$val->address}}</td>
    <td>{{$currency->symbol.$val->shipping_fee}}</td>
    @endif
     @if($val->product->note_status==1 || $val->product->note_status==2)
     @if(!empty($val->note))
    <td>{{$val->note}}</td>
    @endif
    @endif
    <td>{{$currency->symbol}}{{number_format($val->amount,2)}}</td>
    <td>{{$currency->symbol.number_format($val->total,2)}}</td>
    <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
    <td>{{$currency->symbol.number_format($val->charge,2)}}</td>
    
  </tr>
  </tbody>
</table>

  
                     
                       
                       
                            
                      </div>
                    </div>
                </div>
              </div>
            </div> 
            </div>
          @endforeach
        @else
         <div class="col-md-12">
              <div class="card bg-white">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <!-- Title -->
                      <h5 class="h4 mb-0 text-dark"></h5>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col" style="text-align:center">
                        <img src="{{url('asset/profile/nodata.png')}}" width="30%">
                      </div>
                    </div>
                </div>
              </div>
            </div>
        @endif
        </div> 
      </div>
    </div>
    </div>
    </div>
@stop