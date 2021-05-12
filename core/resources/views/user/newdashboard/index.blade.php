@extends('userlayout')

@section('content')
<head>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    </head>
<style>
.surtitle {
    margin-bottom: 0;
    letter-spacing: 0.5px;
    text-transform: uppercase;
       color: #ffffff !important;

    font-size: 12px;
}

.card-body1 {
    padding: 0.5rem 1rem;
    flex: 1 1 auto;
    border-radius: 15px;
    background: #1093ff;
}

.dvc{    padding: 10px;
    background: #f4f7fc;
    border-radius: 5px;}
@foreach($AllvCardDesigns as $DesignDetails)   
.card-body2{{$DesignDetails->id}}{
background: {{$DesignDetails->class_name}};
  
     padding: 0.5rem 1rem;
    flex: 1 1 auto;
    border-radius: 15px;
   
    }
@endforeach
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
/**FOR SLIDER**/
.card .carousel-item {
  height: 50%;
}
.card .carousel-caption {
  padding: 0;
  right: 0;
  left: 0;
  color: #3d3d3d;
}
.card .carousel-caption h3 {
  color: #3d3d3d;
}
.card .carousel-caption p {
  line-height: 30px;
}
.card .carousel-caption .col-sm-3 {
  display: flex;
  align-items: center;
}
.card .carousel-caption .col-sm-9 {
  text-align: left;
}
.navi a {
    text-decoration:none;
}
a > .ico {
    background-color: grey;
    padding: 10px;
    
}
a:hover > .ico {
    background-color: #666;
}
</style>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
      
      
      <div class="row">
      <div class="col-md-8">
          <div class="row boxbg">
              <div class="col-md-12">
                  <form action="#" class="searchf">
      <input type="text" placeholder="Search.." name="search" class="mainsearch">
      <button type="submit" class="mainbtn"><i class="fa fa-search"></i></button>
    </form>
              </div>
          </div>
           
      <div class="row boxbg"> 
     <div class="col-lg-2 newicon" style="text-align: center;">
         <a href="#">
         <div class="row align-items-center">
           <img class="di" src="https://cuminup.com/asset/images/shopping-cart.png">
            </div>
            <h4>eStore</h4>
            </a>
            </div>
            
           
            
           <div class="col-lg-2 newicon" style="text-align: center;">
               
               
           @if(Auth::user()->user_type == 1)
                <a href="https://cuminup.com/user/virtualcard" class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm">
         <div class="row align-items-center">
          <img class="di" src="https://cuminup.com/asset/images/credit-card.png">
            </div>
           <h4>Cards</h4>
           </a>
            @else
                <a href="https://cuminup.com/user/virtualcard">
         <div class="row align-items-center">
          <img class="di" src="https://cuminup.com/asset/images/credit-card.png">
            </div>
           <h4>Cards</h4>
           </a>
            @endif
            </div>
            
            
            
            
             <div class="col-lg-2 newicon" style="text-align: center;">
                 
            @if(Auth::user()->user_type == 1)
            <a href="https://cuminup.com/user/transfer" class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm">
         <div class="row align-items-center">
           <img class="di" src="https://cuminup.com/asset/images/transfer.png">
            </div>
            <h4>Transfer</h4>
            </a>
            @else
               <a href="https://cuminup.com/user/transfer">
         <div class="row align-items-center">
           <img class="di" src="https://cuminup.com/asset/images/transfer.png">
            </div>
            <h4>Transfer</h4>
            </a>
            @endif
            </div>
            
            
             <div class="col-lg-2 newicon" style="text-align: center;">
                 
            @if(Auth::user()->user_type == 1)
            <a href="https://cuminup.com/user/request" class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm">
         <div class="row align-items-center">
           <img class="di" src="https://cuminup.com/asset/images/coin.png">
            </div>
            <h4>Request</h4>
            </a>
            @else
                <a href="https://cuminup.com/user/request">
         <div class="row align-items-center">
           <img class="di" src="https://cuminup.com/asset/images/coin.png">
            </div>
            <h4>Request</h4>
            </a>
            @endif
            </div>
            
             <div class="col-lg-2 newicon" style="text-align: center;">
                <a href="https://cuminup.com/user/invoice">
         <div class="row align-items-center">
            <img class="di" src="https://cuminup.com/asset/images/quotation.png">
            </div>
           <h4>Invoice</h4>
           </a>
            </div>
            
           <div class="col-lg-2 newicon" style="text-align: center;">
               <a href="https://cuminup.com/user/sc-links">
         <div class="row align-items-center">
           <img class="di" src="https://cuminup.com/asset/images/dashboard.png">
            </div>
           <h4>Payment Link</h4>
           </a>
            </div>
            
         <!--    <div class="col-lg-3 newicon" style="text-align: center;">-->
         <!--<div class="row align-items-center">-->
         <!--  <i class="fas fa-chart-pie di"></i>-->
         <!--   </div>-->
         <!--  <h4>Single Charge</h4>-->
         <!--   </div>-->
            
         <!--    <div class="col-lg-3 newicon" style="text-align: center;">-->
         <!--<div class="row align-items-center">-->
         <!--  <i class="fas fa-chart-pie di"></i>-->
         <!--   </div>-->
         <!--  <h4>Donation Page</h4>-->
         <!--   </div>-->
            
            </div>
          <div class="row boxbg" style="    padding-top: 13px;">  
                  
                  <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col text-center">
                <h4 class="mb-4 text-primary">
                Wallet
                </h4>
                <span class="text-sm text-dark mb-0"><i class="fa fa-google-wallet"></i> Received</span><br>
                <span class="text-xl text-dark mb-0">{{$currency->name}} {{number_format($user->balance)}}.00</span><br>
                <hr>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle" style="color: #323131!important;">Sent</span><br>
                  <span class="surtitle " style="color: #323131!important;">Received</span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle " style="color: #323131!important;">{{$currency->name}} {{number_format($sendMoney_sent)}}.00</span><br>
                  <span class="surtitle " style="color: #323131!important;">{{$currency->name}} {{number_format($request_sent)}}.00</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col text-center">
                <h4 class="mb-4 text-primary">
               eStore
                </h4>
                <span class="text-sm text-dark mb-0"><i class="fa fa-google-wallet"></i> Received</span><br>
                <span class="text-xl text-dark mb-0">{{$currency->name}} {{number_format($estore_received)}}.00</span><br>
                <hr>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle" style="color: #323131!important;">Pending</span><br>
                  <span class="surtitle " style="color: #323131!important;">Total</span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle " style="color: #323131!important;">{{$currency->name}} 0.00</span><br>
                  <span class="surtitle " style="color: #323131!important;">{{$currency->name}} {{number_format($estore_total)}}.00</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col text-center">
                <h4 class="mb-4 text-primary">
                Settlements
                </h4>
                <span class="text-sm text-dark mb-0"><i class="fa fa-google-wallet"></i> Received</span><br>
                <span class="text-xl text-dark mb-0">{{$currency->name}} {{number_format($settlements_received)}}.00</span><br>
                <hr>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle" style="color: #323131!important;">Pending</span><br>
                  <span class="surtitle " style="color: #323131!important;">Total</span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle " style="color: #323131!important;">{{$currency->name}} {{number_format($settlements_pending)}}.00</span><br>
                  <span class="surtitle " style="color: #323131!important;">{{$currency->name}} {{number_format($settlements_total)}}.00</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col text-center">
                <h4 class="mb-4 text-primary">
                Send Money
                </h4>
                <span class="text-sm text-dark mb-0"><i class="fa fa-google-wallet"></i> Received</span><br>
                <span class="text-xl text-dark mb-0">{{$currency->name}} {{number_format($sendMoney_sent)}}.00</span><br>
                <hr>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle" style="color: #323131!important;">Pending</span><br>
                  <span class="surtitle" style="color: #323131!important;">Returned</span><br>
                  <span class="surtitle " style="color: #323131!important;">Total</span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle " style="color: #323131!important;">{{$currency->name}} {{number_format($sendMoney_pending)}}.00</span><br>
                  <span class="surtitle " style="color: #323131!important;">{{$currency->name}} {{number_format($sendMoney_rebursed)}}.00</span><br>
                  <span class="surtitle " style="color: #323131!important;">{{$currency->name}} {{number_format($sendMoney_total)}}.00</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col text-center">
                <h4 class="mb-4 text-primary">
                Request
                </h4>
                <span class="text-sm text-dark mb-0"><i class="fa fa-google-wallet"></i> Received</span><br>
                <span class="text-xl text-dark mb-0">{{$currency->name}} {{number_format($request_sent)}}.00</span><br>
                <hr>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle" style="color: #323131!important;">Pending</span><br>
                  <span class="surtitle " style="color: #323131!important;">Total</span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle " style="color: #323131!important;">{{$currency->name}} {{number_format($request_pending)}}.00</span><br>
                  <span class="surtitle " style="color: #323131!important;">{{$currency->name}} {{number_format($request_total)}}.00</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col text-center">
                <h4 class="mb-4 text-primary">
               Invoices
                </h4>
                <span class="text-sm text-dark mb-0"><i class="fa fa-google-wallet"></i> Received</span><br>
                <span class="text-xl text-dark mb-0">{{$currency->name}} {{number_format($invoice_received)}}.00</span><br>
                <hr>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle" style="color: #323131!important;">Pending</span><br>
                  <span class="surtitle " style="color: #323131!important;">Total</span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle " style="color: #323131!important;">{{$currency->name}} {{number_format($invoice_pending)}}.00</span><br>
                  <span class="surtitle " style="color: #323131!important;">{{$currency->name}} {{number_format($invoice_total)}}.00</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
     
                  
                  </div>  
        <div class="row boxbg">  
                    <div class="col-md-12">
              <p class="text-center text-muted card-text mt-8">No Money Request Found</p>
            </div>
                  </div> 
        
      </div> 
      <div class="col-md-4">
        <div class="card">
          
          @if(count($virtualCardsList) > 0)
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="100000">
    <div class="w-100 carousel-inner" role="listbox">
       
    @foreach($virtualCardsList as $k=> $c_list)
      <div class="carousel-item @if($k == 0){{'active'}}@endif">
           
        <div class="card-body"> 
          <h3>{{$c_list->memo}} Card Details</h3>
            <div class="card">
            <!-- Card body -->
           <a href="{{url('user/virtualcard')}}">
            <div class="card-body2{{$c_list->design_id}}">
              <div class="row justify-content-between align-items-center">
                <div class="col">
                  <!--<span class="text-primary h6 surtitle ">$0.00</span>  -->
                <span class="badge badge-pill badge-success">@if($c_list->card_state == 'OPEN'){{'Active'}}@elseif($c_list->card_state == 'CLOSED'){{'CLOSED'}}@else{{'Inactive'}}@endif</span>               
                  </div>
                
              </div>             
              <div class="my-4">
                <span class="h6 surtitle text-gray mb-2" style="    color: #ffffff !important;">
               {{$c_list->host_name}}
                </span>
                <div class="text-primary" data-toggle="modal" data-target="#modal-more15" style="cursor: pointer;">
                  <div  style="color: #ffffff !important;">XXXX XXXX XXXX   {{$c_list->last_four_digit}}</div>
                </div>
              </div>
              <div class="row">               
                <div class="col-6">
                  <span class="h6 surtitle text-gray">Monthly Limit</span><br>
                  <span class="text-primary" style="
    font-size: 13px;color: #ffffff !important;">{{$currency->symbol}}{{$c_list->restAmount}} / <span class="text-gray" style="color: #ffffff !important;">{{$currency->symbol}}{{$c_list->spend_limit}}</span></span>
                </div>
                <div class="col" data-toggle="modal" data-target="#modal-more15" style="cursor: pointer;">
                  <span class="h6 surtitle text-gray">CVV</span><br>
                  <span class="h6 surtitle text-gray">XXX</span>
                </div>     
                <div class="col">
                    <img src="https://cuminup.com/asset/images/visa.svg" style="width:100%">
                    </div>
              </div>              
            </div>
            </a>
           
          </div>
          <div class="float-right navi">
    <a class="" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon ico" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon ico" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
    </div>
    {{__('Recent Card Transactions')}}
        <table class="table" id="trasactionTable_id">
          <tr>
            <th>#</th>  
              <th>Amount</th>
              <th>Date</th>
          
          </tr>
    <tbody>
        @php
        $AllTransactionsList = app('App\Http\Controllers\VirtualCardController')->getTransactionsList($c_list->token);
        
        @endphp
        @if(count($AllTransactionsList) > 0)
        @foreach($AllTransactionsList as $k=>$TransactionsDetails)
        @if($k > 5)
       <tr>
           <td>{{++$k}}</td>
           <td><td>{{$currency->symbol.number_format($TransactionsDetails->amount/100)}} / {{$currency->symbol.number_format($TransactionsDetails->card->spend_limit/100)}}</td></td>
           <td>{{date("Y/m/d h:i:A", strtotime($TransactionsDetails->created))}}</td>
           
       </tr> 
       @endif
       @endforeach
    @else
    <tr>
        <td></td>
        <td>
    {{'No Data Found!'}}
    </td>
    <td></td>
    </tr>
    @endif
    <tbody>          
      </table>
    </div>
      </div>
         
      @endforeach
      
      <!--div class="carousel-item ">
        <div class="carousel-caption">
          <div class="row">
            <div class="col-sm-3">
              <img src="http://via.placeholder.com/200x200" alt="" class="rounded-circle img-fluid">
            </div>
            <div class="col-sm-9">
              <h3>You will love it.</h3>
              <small>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</small>
              <small class="smallest mute">- Yayo Dudemous</small>
            </div>
          </div>
        </div>
      </div-->
    </div>
    
  </div>
     
      @else
      <div class="card-body"> 
          <h3>Virtual Cards</h3>
            <div class="card">
            <!-- Card body -->
           
            <div class="card-body1">
              <div class="row justify-content-between align-items-center">
                <div class="col">
                  <!--<span class="text-primary h6 surtitle ">$0.00</span>  -->
                  <span class="badge badge-pill badge-success">Card Details</span>                </div>
                
              </div>             
              <div class="my-4">
                <span class="h6 surtitle text-gray mb-2" style="    color: #ffffff !important;">No Card Found</span>
                <div class="text-primary" data-toggle="modal" data-target="#modal-more15" style="cursor: pointer;">
                  <div style="color: #ffffff !important;margin-top:15px">
                     
                      @if(Auth::user()->user_type == 1)
                       <a href="https://cuminup.com/user/virtualcard" class="btn btn-disabled btn-sm dvc" type="button" data-toggle="modal" data-target=".bd-example-modal-sm">Create Virtual Card</a>
            @else
                <a href="https://cuminup.com/user/virtualcard" class="dvc">Create Virtual Card</a>
            @endif
                      </div>
                </div>
              </div>
              <div class="row">               
                <div class="col-6">
                  <br>
                  
                </div>
                <div class="col" data-toggle="modal" data-target="#modal-more15" style="cursor: pointer;">
                  <br>
                  <span class="text-primary"></span>
                </div>     
                <div class="col">
                    <img src="https://cuminup.com/asset/images/visa.svg" style="width:100%">
                    </div>
              </div>              
            </div>
          </div>
    </div>
    @endif
      </div>
      </div>
      <!--TEST-->
    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content text-center mt-5 pt-5 pb-4">
      <h3> <i class="fas fa-crown" style="color: #fff704; font-size: 20px;"></i> Upgrade to Business</h3>
      <a href="{{route('user.upgrade')}}"><p>Click Here..</p></a>
    </div>
  </div>
</div>
  <!--TEST-->
  <script>
  $(document).ready(function() {
    $('#trasactionTable_id').DataTable();
});
  </script>
@stop