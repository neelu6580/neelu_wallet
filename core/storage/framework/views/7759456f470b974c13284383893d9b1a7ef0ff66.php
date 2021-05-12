<?php $__env->startSection('css'); ?>
<style>
::placeholder {
  color: grey;
  opacity: 0.6; /* Firefox */
}

:-ms-input-placeholder { /* Internet Explorer 10-11 */
 color: grey;
}

::-ms-input-placeholder { /* Microsoft Edge */
 color: grey;
}
.ecomm i {
    font-size: 50px;
    color: #171347;
}
    /* Create three columns of equal width */
.columns {
  float: left;
  width: 33.3%;
  padding: 8px;
}

/* Style the list */
.price {
  list-style-type: none;
  border: 1px solid #eee;
  margin: 0;
  padding: 0;
  -webkit-transition: 0.3s;
  transition: 0.3s;
}

/* Add shadows on hover */
.price:hover {
  box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
}

/* Pricing header */
.price .header-basic{
      background: rgba(51,142,204,0.89);
  color: white;
  font-size: 25px;
}
.price .header-adv {
      background: rgba(29,51,108,0.89) !important;
  color: white;
  font-size: 25px;
}
.price .header-special {
      background: rgba(20,205,125,0.89) !important;
  color: white;
  font-size: 25px;
}

/* List items */
.price li {
  border-bottom: 1px solid #eee;
  padding: 15px;
  text-align: center;
}

/* Grey list item */
.price .grey {
  background-color: #eee;
  font-size: 20px;
}
.price h1{
    color:#fff;
}

/* The "Sign Up" button */
.button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 12px 25px;
  text-align: center;
  text-decoration: none;
  font-size: 18px
  border-radius: 20px;
}

/* Change the width of the three columns to 100%
(to stack horizontally on small screens) */
@media  only screen and (max-width: 600px) {
  .columns {
    width: 100%;
  }
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section class="gray-bg effect-section">
    <div class="effect-1">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 361.1 384.8" style="enable-background:new 0 0 361.1 384.8;" xml:space="preserve" class="injected-svg svg_img white-color">
        <path d="M53.1,266.7C19.3,178-41,79.1,41.6,50.1S287.7-59.6,293.8,77.5c6.1,137.1,137.8,238,15.6,288.9 S86.8,355.4,53.1,266.7z"></path>
        </svg>
    </div>
    <div class="svg-bottom">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="96px" viewBox="0 0 100 100" version="1.1" preserveAspectRatio="none" class="injected-svg svg_img white-color">
            <path d="M0,0 C16.6666667,66 33.3333333,99 50,99 C66.6666667,99 83.3333333,66 100,0 L100,100 L0,100 L0,0 Z"></path>
        </svg>
    </div>
    <div class="container">
        <div class="row full-screen align-items-center p-50px-tb lg-p-100px-t justify-content-center">
            <div class="col-lg-6 m-50px-tb md-m-20px-t">
                <h6 class="typed theme3rd-bg p-5px-tb p-15px-lr d-inline-block white-color border-radius-15 m-25px-b" data-elements="<?php echo e($set->title); ?>"></h6>
                <h1 class="display-4 m-20px-b"><?php echo e($ui->header_title); ?></h1>
                <p class="font-2"><?php echo e($ui->header_body); ?></p>
                <div class="p-20px-t">
                    <a class="m-btn m-btn-radius m-btn-theme" href="<?php echo e(route('register')); ?>">
                        <span class="m-btn-inner-text"><?php echo e(__('Get Started')); ?></span>
                        <span class="m-btn-inner-icon arrow"></span>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 m-50px-tb lg-m-0px-t text-center">
                <img class="max-width-140" src="<?php echo e(url('/')); ?>/asset/images/<?php echo e($ui->s4_image); ?>" title="" alt="">
            </div>
        </div>
    </div>
</section>
<section class="section p-0px-t section-top-up-100" style="display:none">
    <div class="container">
        <div class="row">
            <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-sm-6 col-lg-3 m-15px-tb">
                <div class="p-25px-lr p-35px-tb white-bg box-shadow-lg hover-top border-radius-15">
                    <h5 class="m-10px-b"><?php echo e($val->title); ?></h5>
                    <p class="m-0px"><?php echo e($val->details); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<h3 class="h1 m-15px-b" style="    text-align: center;">Strategic Partner</h3>
<div class="p-40px-tb border-top-1 border-bottom-1 border-color-gray">
    <div class="container">
        <div class="owl-carousel owl-loaded owl-drag" data-items="7" data-nav-dots="false" data-md-items="6" data-sm-items="5" data-xs-items="4" data-xx-items="3" data-space="30" data-autoplay="true">
            <?php $__currentLoopData = $brand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brands): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="p8">
                    <img src="<?php echo e(url('/')); ?>/asset/brands/<?php echo e($brands->image); ?>" title="" alt="">
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<section class="section effect-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 m-15px-tb text-center">
                <img src="<?php echo e(url('/')); ?>/asset/images/<?php echo e($ui->s3_image); ?>" title="" alt="">
            </div>
            <div class="col-lg-6 m-15px-tb">
                <h3 class="h1"><?php echo e($ui->s3_title); ?></h3>
                <p class="font-2 p-0px-t"><?php echo e($ui->s3_body); ?></p>
                <div class="border-left-2 border-color-theme p-25px-l m-35px-t">
                    <h6 class="font-2"><?php echo e($set->title); ?></h6>
                    <p><?php echo e(__('Stimulate your sales with modular payment solutions and loyalty programs!')); ?></p>
                </div>
                <div class="p-20px-t">
                    <a class="m-btn m-btn-radius m-btn-theme" href="<?php echo e(route('about')); ?>">
                        <span class="m-btn-inner-text">More About Us</span>
                        <span class="m-btn-inner-icon arrow"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--<section class="section effect-section">-->
<!--    <div class="container">-->
<!--        <div class="row justify-content-center md-m-25px-b m-40px-b">-->
<!--            <div class="col-lg-8 text-center">-->
<!--                <h3 class="h1 m-15px-b"><?php echo e($ui->s6_title); ?></h3>-->
<!--                <p class="m-0px font-2"><?php echo e($ui->s6_body); ?></p>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="row justify-content-between">-->
<!--            <div class="col-lg-5 m-15px-tb">-->
<!--                <div class="media box-shadow p5 m-30px-b">-->
<!--                    <div class="icon-70 theme-color theme-bg-alt border-radius-50">-->
<!--                        <i class="fas fa-shopping-cart"></i>-->
<!--                    </div>-->
<!--                    <div class="media-body p-15px-l">-->
<!--                        <h5>Sell products</h5>-->
<!--                        <p class="m-0px"><?php echo e(__('Any product can now be sold easily. Create and share your products with clients.')); ?></p>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="media box-shadow p5 m-30px-b">-->
<!--                    <div class="icon-70 green-color green-bg-alt border-radius-50">-->
<!--                        <i class="fas fa-file-invoice"></i>-->
<!--                    </div>-->
<!--                    <div class="media-body p-15px-l">-->
<!--                        <h5>Send invoice</h5>-->
<!--                        <p class="m-0px"><?php echo e(__('Bill clients seamlessly with invoice system and request money from anyone easily.')); ?></p>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="media box-shadow p5">-->
<!--                    <div class="icon-70 yellow-color yellow-bg-alt border-radius-50">-->
<!--                        <i class="fas fa-drafting-compass"></i>-->
<!--                    </div>-->
<!--                    <div class="media-body p-15px-l">-->
<!--                        <h5>Merchant integration</h5>-->
<!--                        <p class="m-0px">Receive money on your website with simple integration and a small fee of 10% per transaction.</p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-lg-6 m-15px-tb">-->
<!--                <img class="max-width-120" src="<?php echo e(url('/')); ?>/asset/images/<?php echo e($ui->s2_image); ?>" title="" alt="">-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->





<section class="section effect-section" style="padding-top: 10px;">
    <div class="container">
        <div class="row justify-content-center md-m-25px-b m-40px-b">
            <div class="col-lg-8 text-center">
                <h3 class="h1 m-15px-b" style="    font-size: 38px;">Cashless - Billing features that stand out</h3>
                <p class="m-0px font-2">Get more than just a payment gateway! Our payment solutions are the talk of the town and here's why. Recurring payments help you receive repetitive revenue, and flexible settlements makes it easier for you to share payments with your drop shippers.</p>
            </div>
        </div>
<div class="row">
                        <div class="col-sm-6 col-lg-3 m-15px-tb">
                <div class="p-25px-lr p-35px-tb white-bg box-shadow-lg hover-top border-radius-15" style="padding-top: 10px;">
                    <div class="icon-70 yellow-color yellow-bg-alt border-radius-50" style="margin-bottom: 10px;">
                        <i class="fas fa-shopping-basket"></i>
                    </div>
                    <h5 class="m-10px-b">Sell Product</h5>
                    <p class="m-0px">Combine multiple products and services on a single payment form to sell more.</p>
                </div>
            </div>
                        <div class="col-sm-6 col-lg-3 m-15px-tb">
                <div class="p-25px-lr p-35px-tb white-bg box-shadow-lg hover-top border-radius-15" style="padding-top: 10px;">
                    <div class="icon-70 yellow-color yellow-bg-alt border-radius-50" style="margin-bottom: 10px;">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                    <h5 class="m-10px-b">Recurring Payments</h5>
                    <p class="m-0px">Receive payments periodically, without <br>hassle!</p>
                </div>
            </div>
                        <div class="col-sm-6 col-lg-3 m-15px-tb">
                <div class="p-25px-lr p-35px-tb white-bg box-shadow-lg hover-top border-radius-15" style="padding-top: 10px;">
                    <div class="icon-70 yellow-color yellow-bg-alt border-radius-50" style="margin-bottom: 10px;">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h5 class="m-10px-b">Send & Request</h5>
                    <p class="m-0px">Transfer and request money without account restrictions to any member.</p>
                </div>
            </div>
                        <div class="col-sm-6 col-lg-3 m-15px-tb">
                <div class="p-25px-lr p-35px-tb white-bg box-shadow-lg hover-top border-radius-15" style="padding-top: 10px;">
                    <div class="icon-70 yellow-color yellow-bg-alt border-radius-50" style="margin-bottom: 10px;">
                        <i class="fab fa-angellist"></i>
                    </div>
                    <h5 class="m-10px-b">Auto-Settlement</h5>
                    <p class="m-0px">Settle accounts twice a week automatically with the small fees!</p>
                </div>
            </div>
                    </div><div class="row">
                        <div class="col-sm-6 col-lg-3 m-15px-tb">
                <div class="p-25px-lr p-35px-tb white-bg box-shadow-lg hover-top border-radius-15" style="padding-top: 10px;">
                    <div class="icon-70 yellow-color yellow-bg-alt border-radius-50" style="margin-bottom: 10px;">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <h5 class="m-10px-b">Become a Merchant</h5>
                    <p class="m-0px">Securely store card details for a seamless checkout process.</p>
                </div>
            </div>
                        <div class="col-sm-6 col-lg-3 m-15px-tb">
                <div class="p-25px-lr p-35px-tb white-bg box-shadow-lg hover-top border-radius-15" style="padding-top: 10px;">
                    <div class="icon-70 yellow-color yellow-bg-alt border-radius-50" style="margin-bottom: 10px;">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <h5 class="m-10px-b">Payment Link</h5>
                    <p class="m-0px">Create your own Merchant account that allow to integrate your website with merchant key to accept payment!</p>
                </div>
            </div>
                        <div class="col-sm-6 col-lg-3 m-15px-tb">
                <div class="p-25px-lr p-35px-tb white-bg box-shadow-lg hover-top border-radius-15" style="padding-top: 10px;">
                    <div class="icon-70 yellow-color yellow-bg-alt border-radius-50" style="margin-bottom: 10px;">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                    <h5 class="m-10px-b">e-Invoicing</h5>
                    <p class="m-0px">Request your payment easily with our customizable invoice!</p>
                </div>
            </div>
                        <div class="col-sm-6 col-lg-3 m-15px-tb">
                <div class="p-25px-lr p-35px-tb white-bg box-shadow-lg hover-top border-radius-15" style="padding-top: 10px;">
                    <div class="icon-70 yellow-color yellow-bg-alt border-radius-50" style="margin-bottom: 10px;">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <h5 class="m-10px-b">e-Wallet Topup</h5>
                    <p class="m-0px">Get more customers by receiving payment via e-Wallet!</p>
                </div>
            </div>
                    </div>
    </div>
</section>



<section class="section effect-section" style="
    padding: 0px 0;
">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 m-15px-tb text-center">
                <img src="https://www.cuminup.com/asset/images/ACH.jpg" title="" alt="">
            </div>
            <div class="col-lg-6 m-15px-tb">
                <h3 class="h1">AUTOMATED CLEARING HOUSE (ACH)</h3>
                
                <div class="border-left-2 border-color-theme p-25px-l m-35px-t">
                    <h6 class="font-2">Get paid faster with ACH payment processing.</h6>
                    <p>
Use CuminUp ACH to make and accept payments.</p>
                </div>
                <div class="p-20px-t" style="
    padding-top: 40px;
">
                    <a class="m-btn m-btn-radius m-btn-theme" href="https://www.cuminpay.com/demo/register">
                        <span class="m-btn-inner-text">Apply Now</span>
                        <span class="m-btn-inner-icon arrow"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>






<!-- card contents -->


<section class="section effect-section" style="
    padding: 0px 0;
">
    <div class="container">
        <div class="row align-items-center">
            
            <div class="col-lg-6 m-15px-tb">
                <h3 class="h1">Digital Wallet & Prepaid Cards</h3>
                
               
                    <p class="font-2 p-0px-t">
                        CuminUp put the purchase control in your hands Business or Personal, You decide who can charge your card, How much, How often
                    </p>
                     <div class="border-left-2 border-color-theme p-25px-l m-35px-t">
                    <h6 class="font-2">Virtual / Physical Cards ship cards to your business or customers. Various business that we support </h6>
                    <p>1. Advertising and Affiliate Agencies</p>
                    <p>2. Online Travel Agencies</p>
                    <p>3. PEOs & Payroll providers</p>
                    <p>4. SaaS Procurement Platform</p>
                    <p>5. Disbursements (Insurance & Warranty Payouts)</p>
                    <p>6. Health Insurance, FSA, HSA, and Benefits Providers</p>
                    <p>7. Expense Management Providers</p>
                    <p>8. Financial Services</p>
                    <p>9. Rewards and Incentives Platforms</p>
                    <p>10. Marketplaces</p>
                </div>
                <div class="p-20px-t" style="
    padding-top: 40px;
">
                    <a class="m-btn m-btn-radius m-btn-theme" href="https://www.cuminup.com/register">
                        <span class="m-btn-inner-text">Join CuminUp & Grow with us</span>
                        <span class="m-btn-inner-icon arrow"></span>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 m-15px-tb text-center">
                <img src="https://www.cuminup.com/asset/images/cp.png" title="" alt="" style="    margin-bottom: 35px;">
            </div>
            
        </div>
    </div>
</section>


<!-- end card contents -->

<!-- ppe contents -->



<section class="section effect-section" style="
    padding: 0px 0;
">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 m-15px-tb text-center">
                <img src="https://www.cuminup.com/asset/images/cb.png" title="" alt="">
            </div>
            <div class="col-lg-6 m-15px-tb">
                <h3 class="h1">Does your business need help during the COVID-19 pandemic?</h3>
                
                <div class="border-left-2 border-color-theme p-25px-l m-35px-t">
                    <h6 class="font-2">Apply for a Paycheck Protection Program (PPP) Loan via our Loan Partner and get PPP help.</h6>
                    <p>
A new round of funding for the Paycheck Protection Program (PPP), administered by the SBA, continues the availability of much-needed financial support for eligible small businesses to help keep employees and stay open safely during the COVID-19 pandemic.</p>
                </div>
                <div class="p-20px-t" style="
    padding-top: 40px;
">
                    <a class="m-btn m-btn-radius m-btn-theme" target="_blank" href="https://www.smartbizloans.com/apply?partner_id=cuminup&sb_apply_form=paycheck_protection ">
                        <span class="m-btn-inner-text">Apply Now</span>
                        <span class="m-btn-inner-icon arrow"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- end of ppe contents -->


<br>

<br>


<!-- content for Mercury account -->

<br><br>
<section class="section effect-section" style="
    padding: 0px 0;
">
    <div class="container">
        <div class="row align-items-center">
            
            <div class="col-lg-6 m-15px-tb">
                <h3 class="h1">CuminUp Banking partner </h3>
                
               <p class="font-2 p-0px-t">
                    That built for start-ups and SME’s 
                   </p>
                    <p class="font-2 p-0px-t">
                       
                       companies Get full-stack bank accounts
                    </p>
                     <div class="border-left-2 border-color-theme p-25px-l m-35px-t">
                    <h6 class="font-2">Open FDIC-insured bank accounts that come with Virtual & Debit Cards, team management, and a lot more. </h6>
                     <p>Mercury makes bank accounts that help tech companies scale</p>
                    
                   
                </div>
                <div class="p-20px-t">
                    <img src="https://www.cuminup.com/asset/images/mc.png" style="width:50%">
                   
                    <h5 style="    padding-top: 20px;">Open an account right from your laptop</h5>
                    <a class="m-btn m-btn-radius m-btn-theme" href="https://www.cuminup.com/register">
                        
                        <span class="m-btn-inner-text">Get Started</span>
                        <span class="m-btn-inner-icon arrow"></span>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 m-15px-tb text-center">
                <img src="https://www.cuminup.com/asset/images/lp.png" title="" alt="" style="    margin-bottom: 35px;">
            </div>
            
        </div>
    </div>
</section>


<!-- end of mercury account -->


<br><br>







<?php if(count($review)>0): ?>
<section class="p-50px-t">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-6">
                <img src="<?php echo e(url('/')); ?>/asset/images/<?php echo e($ui->s7_image); ?>" title="" alt="">
            </div>
            <div class="col-lg-5 m-30px-b m-30px-t">
                <h3 class="h3 m-30px-b"><?php echo e($ui->s7_title); ?></h3>
                <div class="owl-carousel owl-nav-arrow-bottom white-bg box-shadow-lg p5" data-items="1" data-nav-arrow="true" data-nav-dots="false" data-md-items="1" data-sm-items="1" data-xs-items="1" data-xx-items="1" data-space="0" data-autoplay="true">
                    <?php $__currentLoopData = $review; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vreview): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="p-25px m-20px-b">
                        <p class="m-0px"><?php echo e($vreview->review); ?></p>
                        <div class="media m-20px-t">
                            <div class="avatar-60 border-radius-50">
                                <img src="<?php echo e(url('/')); ?>/asset/review/<?php echo e($vreview->image_link); ?>" alt="" title="">
                            </div>
                            <div class="media-body p-15px-l align-self-center">
                                <h6 class="m-0px"><?php echo e($vreview->name); ?></h6>
                                <span class="font-small"><?php echo e($vreview->occupation); ?></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<section class="section gray-bg" style="    padding-top: 50px;">
    
    
    
  <div class="container">
        
        <div class="row justify-content-between  ">
            <div class="col-lg-6 m-15px-tb get-paid" style="
    padding-top: 165px;
">
  
                <h3 class="h1" style="
    padding-bottom: 22px;
">Get paid anywhere, when you can sell everywhere</h3>
                <p class="font-2 p-0px-t">Whether you sell on an eCommerce website, social media, or other platforms CuminUp helps you receive online payments easily.</p>
                
                <div class="social-icon si-30 white round nav" style="
    padding-top: 20px;">
                                                                                            <a href="#" style="
    width: 60px;
    height: 60px;
    font-size: 45px;background-color: #ffffff00;
    color: #171347;
    border: 0px solid #ffffff;
    padding: 5px;
"><img src="https://www.cuminup.com/asset/images/facebook.png" alt="" title=""></a>
                                                                                                                            <a href="#" style="
    width: 60px;
    height: 60px;
    font-size: 45px;background-color: #ffffff00;
    color: #171347;
    border: 0px solid #ffffff;
    padding: 5px;
"><img src="https://www.cuminup.com/asset/images/whatsapp.png" alt="" title=""></a>
                                                                                                                            <a href="#" style="
    width: 60px;
    height: 60px;
    font-size: 45px;background-color: #ffffff00;
    color: #171347;
    border: 0px solid #ffffff;
    padding: 5px;
"><img src="https://www.cuminup.com/asset/images/messenger.png" alt="" title=""></a>
                                                                                                                                                                                                                                                                                                                                                                            <a href="#" style="
    width: 60px;
    height: 60px;
    font-size: 45px;background-color: #ffffff00;
    color: #171347;
    border: 0px solid #ffffff;
    padding: 5px;
"><img src="https://www.cuminup.com/asset/images/instagram.png" alt="" title=""></a>
                                                                                  
                                                                                    </div>
                                                                                    
   <div class="social-icon si-30 white round nav" style="
    padding-top: 20px;">
   <a href="#" style="
    width: 60px;
    height: 60px;
    font-size: 45px;background-color: #ffffff00;
    color: #171347;
    border: 0px solid #ffffff;
    padding: 5px;
"><img src="https://www.cuminup.com/asset/images/main-socmed-wp@2x-291x300.png" alt="" title=""></a>
                                                                                                                            <a href="#" style="
    width: 60px;
    height: 60px;
    font-size: 45px;background-color: #ffffff00;
    color: #171347;
    border: 0px solid #ffffff;
    padding: 5px;
"><img src="https://www.cuminup.com/asset/images/twitter.png" alt="" title=""></a>
                                                                                                                            <a href="#" style="
    width: 60px;
    height: 60px;
    font-size: 45px;background-color: #ffffff00;
    color: #171347;
    border: 0px solid #ffffff;
    padding: 5px;background-color: #ffffff00;
    color: #171347;
    border: 0px solid #ffffff;
    padding: 5px;
"><img src="https://www.cuminup.com/asset/images/gmail.png" alt="" title=""></a>
                                                                                                                                                                                                                                                                                                                                                                            <a href="#" style="
    width: 60px;
    height: 60px;
    font-size: 45px;background-color: #ffffff00;
    color: #171347;
    border: 0px solid #ffffff;
    padding: 5px;
"><img src="https://www.cuminup.com/asset/images/outlook.png" alt="" title=""></a>
                                                                                                                          
                                                                                    </div>                                                                     
                                                                                    
            </div>
            <div class="col-lg-6 m-15px-tb">
                <img class="max-width-120" src="https://www.cuminup.com/asset/images/pay.png" title="" alt="" style="
    width: 100%;
">
            </div>
        </div>
    </div>
    
    
    
    <!--<div class="container">-->
    <!--    <div class="row justify-content-center md-m-25px-b m-40px-b">-->
    <!--        <div class="col-lg-8 text-center">-->
    <!--            <h3 class="h1 m-15px-b"><?php echo e(__('Latest News')); ?></h3>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--    <div class="row">-->
    <!--        <?php $__currentLoopData = $blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>-->
    <!--            <div class="col-lg-4 m-15px-tb">-->
    <!--                <div class="card blog-grid-1">-->
    <!--                    <div class="blog-img">-->
    <!--                        <a href="<?php echo e(url('/')); ?>/single/<?php echo e($val->id); ?>/<?php echo e(str_slug($val->title)); ?>">-->
    <!--                            <img src="<?php echo e(url('/')); ?>/asset/thumbnails/<?php echo e($val->image); ?>" title="" alt="">-->
    <!--                        </a>-->
    <!--                        <span class="date"><?php echo e(date("j", strtotime($val->created_at))); ?> <span><?php echo e(date("M", strtotime($val->created_at))); ?></span></span>-->
    <!--                    </div>-->
    <!--                    <div class="card-body blog-info">-->
    <!--                        <h5>-->
    <!--                            <a href="<?php echo e(url('/')); ?>/single/<?php echo e($val->id); ?>/<?php echo e(str_slug($val->title)); ?>"><?php echo e($val->title); ?></a>-->
    <!--                        </h5>-->
    <!--                        <p class="m-0px"><?php echo str_limit($val->details, 60);; ?></p>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
    <!--    </div>-->
    <!--</div>-->
</section>
<section class="section" style="    background-image: url(https://www.cuminup.com/asset/images/image.png);
       background-size: cover;
    background-position: right;">
    <div class="container">
        <div class="row justify-content-center md-m-25px-b m-40px-b">
            <div class="col-lg-6 text-center">
                <h3 class="h1 m-0px" style="    color: #ffffff;">Join thousands who choose CuminUp <?php echo e(__('worldwide.')); ?></h3>
                <div class="p-20px-t">
                    <a class="m-btn m-btn-dark m-btn-radius" href="<?php echo e(route('register')); ?>"><?php echo e(__('Sign Up for Free')); ?> </a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section bg-no-repeat bg-right-center gray-bg" id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-15px-tb">
                <div class="row md-m-25px-b m-40px-b">
                    <div class="col-lg-12">
                        <h3 class="h1 m-15px-b">Need a hand?</h3>
                        <p class="m-0px font-2">We are here for all of your business needs. Our team of caring experts are standing by. Send your questions today by fill out the form below. Someone from our team will get back to you shortly. Someone from our team will get back to you shortly.</p>
                    </div>
                </div>
                <form class="rd-mailform" method="post" action="<?php echo e(route('contact-submit')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input  type="text" name="name" placeholder="Mr. John Doe" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input  type="email" name="email" placeholder="name@example.com"  class="form-control" required>
                            </div>
                        </div>                        
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input  type="number" name="mobile" placeholder="12345678987"  class="form-control" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control" name="message" rows="3" placeholder="Hi there, I would like to ..." required></textarea>
                            </div>
                        </div>
                       
                        <?php if($set->recaptcha==1): ?>
                        <div class="col-12">
                            <div class="form-group">
                          <?php echo app('captcha')->display(); ?>

                          <?php if($errors->has('g-recaptcha-response')): ?>
                              <span class="help-block">
                                  <?php echo e($errors->first('g-recaptcha-response')); ?>

                              </span>
                          <?php endif; ?>
                          </div>
                          </div>
                        <?php endif; ?>
                    
                        <div class="col-12">
                            <button class="m-btn m-btn-dark m-btn-radius" type="submit" name="send">Get Started</button>
                        </div>
                    </div>
                </form>
                <div class="h1 theme-color"></div>
                <!--<div class="media align-items-center p-10px-tb">-->
                <!--    <div class="icon-40 theme-bg-alt border-radius-50 theme-color">-->
                <!--        <i class="fas fa-phone"></i>-->
                <!--    </div>-->
                <!--    <div class="media-body p-15px-l">-->
                <!--        <h6 class="h4 m-0px"><?php echo e($set->mobile); ?></h6>-->
                <!--    </div>-->
                <!--</div>                -->
                <div class="media align-items-center p-10px-tb">
                    <div class="icon-40 theme-bg-alt border-radius-50 theme-color">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="media-body p-15px-l">
                        <h6 class="h4 m-0px"><?php echo e($set->email); ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 m-15px-tb ml-auto" id="faq">
                <div class="accordion accordion-08 p10 border-radius-15 dark-bg white-color-light links-white">
                    <?php $__currentLoopData = $faq; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vfaq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="acco-group">
                        <a href="#" class="acco-heading"><?php echo e($vfaq->question); ?></a>
                        <div class="acco-des"><?php echo $vfaq->answer; ?></div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp1\htdocs\neelu_wallet\core\resources\views/front/index.blade.php ENDPATH**/ ?>