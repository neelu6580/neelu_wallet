<?php $__env->startSection('content'); ?>

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
         <div class="row align-items-center">
           <img class="di" src="https://cuminup.com/asset/images/shopping-cart.png">
            </div>
            <h4>eStore</h4>
            </div>
            
            <div class="col-lg-2 newicon" style="text-align: center;">
         <div class="row align-items-center">
            <img class="di" src="https://cuminup.com/asset/images/quotation.png">
            </div>
           <h4>Invoice</h4>
            </div>
            
           <div class="col-lg-2 newicon" style="text-align: center;">
         <div class="row align-items-center">
          <img class="di" src="https://cuminup.com/asset/images/credit-card.png">
            </div>
           <h4>Card</h4>
            </div>
            
            
             <div class="col-lg-2 newicon" style="text-align: center;">
         <div class="row align-items-center">
           <img class="di" src="https://cuminup.com/asset/images/transfer.png">
            </div>
            <h4>Transfer</h4>
            </div>
            
             <div class="col-lg-2 newicon" style="text-align: center;">
         <div class="row align-items-center">
           <img class="di" src="https://cuminup.com/asset/images/coin.png">
            </div>
            <h4>Request</h4>
            </div>
            
           <div class="col-lg-2 newicon" style="text-align: center;">
         <div class="row align-items-center">
           <img class="di" src="https://cuminup.com/asset/images/dashboard.png">
            </div>
           <h4>More</h4>
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
          
        <div class="row boxbg">  
                    <div class="col-md-12">
              <p class="text-center text-muted card-text mt-8">No Money Request Found</p>
            </div>
                  </div> 
        
      </div> 
      <div class="col-md-4">
        <div class="card">
           
          <div class="card-body"> 
          <h3>Your Cards</h3>
            <div class="card">
            <!-- Card body -->
           
            <div class="card-body1">
              <div class="row justify-content-between align-items-center">
                <div class="col">
                  <!--<span class="text-primary h6 surtitle ">$0.00</span>  -->
                  <span class="badge badge-pill badge-success">Active</span>                </div>
                
              </div>             
              <div class="my-4">
                <span class="h6 surtitle text-gray mb-2" style="    color: #ffffff !important;">
                Santosh Resh
                </span>
                <div class="text-primary" data-toggle="modal" data-target="#modal-more15" style="cursor: pointer;">
                  <div  style="color: #ffffff !important;">XXXX XXXX XXXX  7086</div>
                </div>
              </div>
              <div class="row">               
                <div class="col-6">
                  <span class="h6 surtitle text-gray">Monthly Limit</span><br>
                  <span class="text-primary" style="
    font-size: 13px;color: #ffffff !important;">$20.00 / <span class="text-gray" style="color: #ffffff !important;">$1000</span></span>
                </div>
                <div class="col" data-toggle="modal" data-target="#modal-more15" style="cursor: pointer;">
                  <span class="h6 surtitle text-gray">CVV</span><br>
                  <span class="text-primary"></span>
                </div>     
                <div class="col">
                    <img src="https://cuminup.com/asset/images/visa.svg" style="width:100%">
                    </div>
              </div>              
            </div>
          </div>
    </div>
      
     
      
      </div>
      </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/user/newdashboard/index.blade.php ENDPATH**/ ?>