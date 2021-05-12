<?php $__env->startSection('content'); ?>
<div class="main-content payment">
  <div class="header py-7 py-lg-8 pt-lg-1">
    <div class="container">
      <div class="header-body text-center mb-7">
        <div class="row justify-content-center">
          <div class="col-xl-5 col-lg-6 col-md-8 px-5">
            <h3 class="text-white"><?php echo e($link->name); ?></h3> <span class="text-white">By <?php echo e($merchant->business_name); ?></span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">    
    </div>
  </div>
  <div class="container mt--8 pb-5 mb-0">
    <div class="row justify-content-center">
      <div class="col-lg-5 col-md-7">
        <?php if($errors->any()): ?>
        <div class="alert alert-danger alert-dismissible fade show mb-5" role="alert">
          <span class="alert-icon"><i class="ni ni-like-2"></i></span>
          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <span class="alert-text"><?php echo e($error); ?></span>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php endif; ?>
        <div class="card card-profile bg-white border-0 mb-5">
          <div class="row justify-content-center">
            <div class="col-lg-3 order-lg-2">
              <div class="card-profile-image">
                <img src="<?php echo e(url('/')); ?>/asset/profile/<?php echo e($merchant->image); ?>" class="rounded-circle border-secondary">
              </div>
            </div>
          </div>
          <div class="card-body pt-7 px-5">
            <div class="text-center text-dark mb-5">
              <small><?php echo $link->description; ?></small>
            </div>
            <form role="form" action="<?php echo e(route('send.single')); ?>" method="post" id="modal-details">
              <?php echo csrf_field(); ?>
              <?php if($link->amount==null): ?>
              <div class="form-group">
                <div class="input-group input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text text-future"><?php echo e($currency->symbol); ?></span>
                  </div>
                  <input class="form-control" placeholder="0.00" id="xx" type="number" name="amount" required>
                </div>
              </div>
              <?php else: ?>
              <div class="form-group">
                <div class="input-group input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text text-future"><?php echo e($currency->symbol); ?></span>
                  </div>
                  <input class="form-control" readonly type="number" name="amount" value="<?php echo e($link->amount); ?>">
                </div>
              </div>
              <?php endif; ?>
              <input type="hidden" value="<?php echo e($link->ref_id); ?>" name="link">
              <div class="modal fade" id="fund" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                  <div class="modal-content">
                    <div class="modal-body p-0">
                      <div class="accordion" id="accordionExample">
                        <div class="card bg-white border-0 mb-0">
                          <!--Pay with Card-->
                          <div class="card-header" id="headingOne">
                            <div class="text-left" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              <h4 class="mb-0">Card</h4>
                            </div>
                          </div>
                          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                              <form action="<?php echo e(route('send.single')); ?>" role="form" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="<?php echo e($stripe->val1); ?>" id="payment-form">
                                <?php echo csrf_field(); ?>
                                <div class="form-group row">
                                  <div class="col-xs-12 col-md-12 form-group required">
                                    <input type="number" class="form-control input-lg custom-input" name="cardNumber" placeholder="Valid Card Number" min="16" autocomplete="off" required autofocus size="20"/>
                                  </div>                                  
                                  <div class="col-xs-12 col-md-12 form-group required">
                                    <input type="email" class="form-control input-lg custom-input" name="email" placeholder="Email Address" autocomplete="off" required autofocus/>
                                  </div>
                                  <div class="col form-group required">
                                    <input type="text" class="form-control input-lg custom-input" name="first_name" placeholder="First Name" autocomplete="off" required autofocus/>
                                  </div>                                  
                                  <div class="col form-group required">
                                    <input type="text" class="form-control input-lg custom-input" name="last_name" placeholder="Last Name" autocomplete="off" required autofocus/>
                                  </div>
                                </div> 
                                <div class='form-group row'>
                                  <div class='col form-group cvc'>
                                    <input autocomplete='off' class='form-control card-cvc' name="cardCVC" placeholder='CVC' type='text' maxlength="3" required>
                                  </div>
                                  <div class='col form-group expiration required'>
                                    <input class='form-control card-expiry-month' name="cardM" placeholder='MM' maxlength='2' type='text'>
                                  </div>
                                  <div class='col form-group expiration required'>
                                    <input class='form-control card-expiry-year' name="cardY" placeholder='YYYY' maxlength='4'type='text'>
                                  </div>
                                </div>			
                                <input type="hidden" value="card" name="type">  	                
                                <div class="text-center">
                                  <button type="submit" class="btn-block btn-success btn-sm" form="modal-details" style="font-size: 16px;"><?php echo e(__('Pay')); ?> <span id="cardresult"></span></button><br>
                                  <img src="<?php echo e(url('/')); ?>/asset/payment_gateways/creditcard.png" style="height:auto;  max-width:40%;">
                                </div>
                                
                              </form>
                            </div>
                          </div>
                          <!--Account Balance-->
                          <hr>
                          <div class="card-header" id="headingTwo">
                              <div class="text-left collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <h4 class="mb-0">Pay with Account</h4>
                              </div>
                          </div>
                          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body text-center">
                              <?php if(Auth::guard('user')->check()): ?>
                                <form method="post" role="form" action="<?php echo e(route('send.single')); ?>">
                                  <?php echo csrf_field(); ?>
                                  <h4 class="mb-0">Account Balance</h4>
                                  <h1 class="mb-1 text-muted"><?php echo e($currency->symbol.number_format($user->balance)); ?></h1>
                                  <input type="hidden" value="account" name="type">
                                  <input type="hidden" value="<?php echo e($link->ref_id); ?>" name="link">
                                  <input type="hidden" name="amount" id="castro" value="<?php echo e($link->amount); ?>">
                                  <div class="text-center">
                                    <button type="submit" onclick="second_modal()" class="btn btn-neutral btn-sm">Pay now</button>
                                  </div>
                                </form>
                              <?php else: ?>
                                <?php
                                  Session::put('oldLink', url()->current());
                                ?>
                                <h3 class="mb-3 text-muted">Login to Complete Transfer</h3>
                                <a href="<?php echo e(route('login')); ?>" class="btn btn-neutral btn-sm">Login</a>
                              <?php endif; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <button type="button" data-toggle="modal" data-target="#fund" class="btn-block btn-success my-4" style="font-size:17px;border-radius:4px;padding:5px"><?php echo e(__('Pay')); ?></button>
              </div>
              <div class="text-center">
                <p class="paragraph small">If you have any questions, contact
                  <a href="mailto:<?php echo e($merchant->email); ?>"><?php echo e($merchant->email); ?></a>
                </p>
              </div>
              <div class="text-center">
                <?php if($merchant->facebook!=null): ?>
                  <a href="<?php echo e($merchant->facebook); ?>"><i class="sn fab fa-facebook"></i></a>   
                <?php endif; ?> 
                <?php if($merchant->twitter!=null): ?>                      
                  <a href="<?php echo e($merchant->twitter); ?>"><i class="sn fab fa-twitter"></i></a>
                <?php endif; ?>      
                <?php if($merchant->linkedin!=null): ?>                     
                  <a href="<?php echo e($merchant->linkedin); ?>"><i class="sn fab fa-linkedin"></i></a> 
                <?php endif; ?>     
                <?php if($merchant->instagram!=null): ?>                        
                  <a href="<?php echo e($merchant->instagram); ?>"><i class="sn fab fa-instagram"></i></a>   
                <?php endif; ?> 
                <?php if($merchant->youtube!=null): ?>                          
                  <a href="<?php echo e($merchant->youtube); ?>"><i class="sn fab fa-youtube"></i></a>  
                <?php endif; ?>                        
              </div> 
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('paymentlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/greenvx4/public_html/vcard/core/resources/views/user/link/sc_view.blade.php ENDPATH**/ ?>