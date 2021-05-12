@extends('userlayout')

@section('content')
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
.surtitle {
    margin-bottom: 0;
    letter-spacing: 0.5px;
    text-transform: uppercase;
       color: #ffffff !important;

    font-size: 12px;
}

.card-body{{$virtualCardsProductDesigns->id}} {
    padding: 0.5rem 1rem;
    flex: 1 1 auto;
    border-radius: 15px;
    background: {{$virtualCardsProductDesigns->class_name}};
}


    .newicon{text-align: center;
    padding: 8px 16px;}
    .newicon1{    padding: 36px 10px;
    border-radius: 50px;}
    .mainsearch{    width: 94%;
    border:1px solid #f3f3f3;
    padding: 8px;
    border-radius: 8px;}
    .mainbtn{    border: 1px solid #e1e1e1;
    padding: 7px 9px;
    border-radius: 6px;}
    .searchf{      padding-bottom: 15px;
    padding-top: 15px;}
    .di{margin: 0px auto;
    padding: 14px;
    background: #f1f1f1;
    width: 50%;
    border-radius: 30px;}
    .boxbg{    background: white;
    border-radius: 10px;
    margin-bottom: 20px;}
    
</style>
</head>    
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                                        <div>


                    <div class="card-header">
                        <h3 class="card-title">{{__('Step 3:Select Quantity')}}</h3>
                        
                    </div>
 <div class="row"> 
<div class="col-md-8">
    <p style="padding: 15px;">{{__('How many cards would you like?')}}</p>
    <form action="#" method="POST">
    @foreach($allplans as $k =>$planDetails)
    <div class="radio">
    </div>
      
 <label><input type="radio" name="colorRadio" style="-webkit-appearance:auto!important;margin-left:20px" id="radio{{$planDetails->id}}" value="{{$planDetails->id}}"> {{$planDetails->plan_quantity}} {{__('Cards')}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$currency->symbol.number_format( $planDetails->plan_price)}}.00</label>

  @endforeach
  <br>
 <label><input type="radio" name="colorRadio" style="-webkit-appearance:auto!important;margin-left:20px" id="radio" value="custom">  {{__('Custom Card Quantity')}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="number" id="custom_input" size="4" style="width:60px;" value="2"></label>

    </form>  
    @foreach($allplans as  $planDetails)
    <div class="{{$planDetails->id}} box" style="display:none;padding: 15px;">
       <h4> Order Summary and Confirmation </h4>
<h6>Program Type :	Instant Issue General Purpose Reloadable</h6>
       <li>Quantity :	{{$planDetails->plan_quantity}} </li>
    <li> Expedited Fee :	{{$currency->symbol.number_format($planDetails->plan_expedited_fee,2)}} </li>
     <li>Card Fee:	{{$currency->symbol.number_format($planDetails->plan_price,2)}} </li>
    <li>Total Cost:	{{$currency->symbol.number_format($planDetails->plan_price+$planDetails->plan_expedited_fee,2)}} </li>
    <li>{{__('Description:')}} {!!$planDetails->plan_features!!}</li>
                 <center><a  href="{{url('user/complete_order/'.$product_type_id.'/'.$design_id.'/'.$planDetails->id)}}" class="btn btn-success">Complete Order | <i class="fa fa-arrow-right" aria-hidden="true"></i></a></center>
<br>
        </div>

    @endforeach
    <div class="custom box" style="display:none;padding: 15px;">
       <h4> Order Summary and Confirmation </h4>
        <h6>Program Type :	Instant Issue General Purpose Reloadable</h6>
                  <li>Quantity :	<span id="custom_field">2</span> </li>
                <li> Expedited Fee :	$0.00 </li>
                <li>Total Cost:	{{$currency->symbol}}<span id="custom_field_price"></span>.00 </li>
                             <center><a  href="{{url('user/complete_order/'.$product_type_id.'/'.$design_id.'/0')}}" class="btn btn-success">Complete Order | <i class="fa fa-arrow-right" aria-hidden="true"></i></a></center>
            <br>
    </div>
        
    <div class="default box" style="padding: 15px;">
               <h4> Order Summary and Confirmation </h4>
        <h6>Program Type :	Instant Issue General Purpose Reloadable</h6>
               <li>Quantity :	2 </li>
            <li> Expedited Fee :	$0.00 </li>
            <li>Total Cost:	{{$currency->symbol}}6.00 </li>
                         <center><a  href="{{url('user/complete_order/'.$product_type_id.'/'.$design_id.'/-1')}}" class="btn btn-success">Complete Order | <i class="fa fa-arrow-right" aria-hidden="true"></i></a></center>
        <br>
    </div>
        
    </div>
    <div class="col-md-4">
        <div class="card">
           
          <div class="card-body"> 
          <a href="#">
            <div class="card">
            <!-- Card body -->
           
            <div class="card-body{{$virtualCardsProductDesigns->id}}">
              <div class="row justify-content-between align-items-center">
                <div class="col">
                  <!--<span class="text-primary h6 surtitle ">$0.00</span>  -->
                
                                            <span class="badge badge-pill badge-success">{{__('active')}}</span>
                                                      </div>
                
              </div>             
              <div class="my-4">
                <span class="h6 surtitle text-gray mb-2" style="    color: #ffffff !important;">
                Santosh Resh
                </span>
                
                  <div  style="color: #ffffff !important;">XXXX XXXX XXXX  7086</div>
               
              </div>
              <div class="row">               
                <div class="col-6">
                  <span class="h6 surtitle text-gray">Monthly Limit</span><br>
                  <span class="text-primary" style="
    font-size: 13px;color: #ffffff !important;">{{$currency->symbol}}x.xx / <span class="text-gray" style="color: #ffffff !important;">$x.xx</span></span>
                </div>
                <div class="col" data-toggle="modal" data-target="#modal-more15" style="cursor: pointer;">
                  <span class="h6 surtitle text-gray">CVV</span><br>
                  <span class="surtitle text-gray">xxx</span>
                </div>     
                <div class="col">
                    <img src="https://cuminup.com/asset/images/visa.svg" style="width:100%">
                    </div>
              </div>
             
            </div>
             
          </div>
          </a>
          
    </div>
      
     
      
      </div>
      </div>
      
      
                                
                                
                                
                                
                               
      
    
   

      </div>
                   
                            

                                                  
                                
                                
                                 
                                
                                             
                            
                        
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
                                                        <h3 class="mb-0">{{__('Add New Card Design')}} </h3>
                                                    </div>
                                                      <form action="#" method="POST">
                                                        @csrf
                                                       
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                {{__('Design Name')}}</label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <input class="form-control" type="text" name="design_name" placeholder="Enter Design Name" required>
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
                                
<script>
$("#custom_input").keyup(function() {
    $("#custom_field_price").html($("#custom_input").val()*4);
    $("#custom_field").html($("#custom_input").val());
});


$(document).ready(function(){
    $('input[type="radio"]').click(function(){
        var inputValue = $(this).attr("value");
        var targetBox = $("." + inputValue);
        $(".box").not(targetBox).hide();
        $(targetBox).show();
    });
});
</script>                                
@stop