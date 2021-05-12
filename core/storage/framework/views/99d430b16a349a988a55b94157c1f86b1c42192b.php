<?php $__env->startSection('content'); ?>

<div class="main-content payment">
    <!-- Header -->
    <div class="header py-7 py-lg-5 pt-lg-1">
      <div class="container">
        <div class="header-body text-center mb-7">

        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5 mb-0">
      <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <img class="card-img-top" src="<?php echo e(url('/')); ?>/asset/profile/<?php echo e($link->image); ?>" alt="Image placeholder">
                <div class="card-body">
                    <h5 class="h2 card-title mb-0">Fundraiser for <?php echo e($link->name); ?></h5>
                    <small class="text-muted">by <?php echo e($merchant->business_name); ?> on <?php echo e(date("h:i:A j, M Y", strtotime($link->created_at))); ?></small>
                    <a href="#" data-toggle="modal" data-target="#donation-details" class="btn btn-link px-0">Read more</a>
                    <div class="modal fade" id="donation-details" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                        <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <div class="card bg-white border-0 mb-0">
                                        <div class="card-header">
                                            <h3 class="mb-0"><?php echo e($link->name); ?></h3>
                                        </div>
                                        <div class="card-body px-lg-5 py-lg-5 text-left">
                                            <p class="mb-0"><?php echo $link->description; ?></p>
                                            <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-left">
                    <p class="paragraph small">If you have any questions, contact
                        <a href="mailto:<?php echo e($merchant->email); ?>"><?php echo e($merchant->email); ?></a>
                    </p>
                    </div>
                    <div class="text-left">
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
                </div>
            </div>
        </div>
        <div class="col-md-8">
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
            <div class="card-body">
                <div class="row justify-content-between align-items-center mb-3">
                    <div class="col-8">
                        <span class="form-text text-xl"><?php echo e($currency->symbol); ?> <?php echo e(number_format($link->amount)); ?> Goal</span>
                    </div>
                    <div class="col-4 text-right">  
                        <?php if($donated<$link->amount): ?>               
                            <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#donation-page">Donate Now</a>
                        <?php endif; ?>
                    </div>
                    <div class="modal fade" id="donation-page" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                        <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <div class="card bg-white border-0 mb-0">
                                    <div class="card-header">
                                        <h3 class="mb-0"><?php echo e(__('Contribute to this project')); ?></h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?php echo e(route('send.donation')); ?>" method="post" id="modal-details">
                                        <?php echo csrf_field(); ?>
                                            <div class="form-group row">
                                                <label class="col-form-label col-lg-12"><?php echo e(__('Amount')); ?></label>
                                                <div class="col-lg-12">
                                                    <div class="input-group">
                                                        <span class="input-group-prepend">
                                                            <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                                        </span>
                                                        <input type="number" class="form-control" name="amount" id="xx" placeholder="0.00" required>
                                                        <span class="input-group-append">
                                                            <span class="input-group-text">.00</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>  
                                            <div class="form-group row">
                                                <label class="col-form-label col-lg-4"><?php echo e(__('Donate as')); ?></label>
                                                <div class="col-lg-8">
                                                    <select class="form-control select" name="status" id="xstatus" onchange="mystatus()" required>
                                                        <option value="1"><?php echo e(__('Anonymous')); ?>

                                                        </option>
                                                        <option value="0"><?php echo e(__('Display name')); ?>

                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
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
                                                                    <form action="<?php echo e(route('send.donation')); ?>" role="form" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="<?php echo e($stripe->val1); ?>" id="payment-form">
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
                                                                        <button type="submit" class="btn btn-success btn-sm" form="modal-details"><?php echo e(__('Pay')); ?> <span id="cardresult"></span></button><br>
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
                                                                        <form method="post" role="form" action="<?php echo e(route('send.donation')); ?>">
                                                                        <?php echo csrf_field(); ?>
                                                                        <h4 class="mb-0">Account Balance</h4>
                                                                        <h1 class="mb-1 text-muted"><?php echo e($currency->symbol.number_format($user->balance)); ?></h1>
                                                                        <input type="hidden" value="account" name="type">
                                                                        <input type="hidden" value="<?php echo e($link->ref_id); ?>" name="link">
                                                                        <input type="hidden" name="amount" id="castro">
                                                                        <input type="hidden" name="status" id="boom" value="1">
                                                                        <div class="text-center">
                                                                            <button type="submit" onclick="second_modal()" class="btn btn-neutral btn-sm">Pay now</button>
                                                                        </div>
                                                                        </form>
                                                                    <?php else: ?>
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
                                            <div class="text-right">
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                            <button type="button" data-toggle="modal" data-target="#fund" class="btn btn-success btn-sm"><?php echo e(__('Pay')); ?></button>
                                            </div>         
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
                <div class="row justify-content-between align-items-center">
                    <div class="col">
                        <div class="progress progress-xs mb-0">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e(($donated*100)/$link->amount); ?>%;"></div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between align-items-center mb-3">
                    <div class="col-8">
                        <span class="form-text text-md text-dark"><?php echo e($currency->symbol); ?> <?php echo e(number_format($donated)); ?> raised</span>
                    </div>
                </div>  
              <div class="text-left text-dark mb-5">
                <p>Donations (<?php echo e(count($dd)); ?>)</p>
              </div>
              <ul class="list-group list-group-flush list my--3">
                <?php $__currentLoopData = $paid; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="list-group-item px-0">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <div class="icon icon-shape text-white rounded-circle bg-success">
                                <i class="fa fa-bookmark-o"></i>
                            </div>
                        </div>
                        <div class="col ml--2">
                        <h4 class="mb-0">
                            <?php if($val->anonymous==0): ?> 
                                <?php if($val->user_id==null): ?>
                                    <?php
                                        $fff=App\Models\Transactions::whereref_id($val->ref_id)->first();
                                    ?>
                                    <?php echo e($fff['first_name'].' '.$fff['last_name']); ?>

                                <?php endif; ?>
                                <?php echo e($val->user['first_name'].' '.$val->user['last_name']); ?> 
                            <?php else: ?> 
                                Anonymous 
                            <?php endif; ?>
                        </h4>
                        <small><?php echo e($currency->symbol.number_format($val->amount)); ?> @ <?php echo e(date("h:i:A j, M Y", strtotime($val->created_at))); ?></small>
                        </div>
                    </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
                <div class="row mt-5">
                    <div class="col-md-12">
                    <?php echo e($paid->links()); ?>

                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('paymentlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/boompay/core/resources/views/user/link/dp_view.blade.php ENDPATH**/ ?>