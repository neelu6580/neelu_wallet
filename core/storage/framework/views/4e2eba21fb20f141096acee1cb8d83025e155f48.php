<?php $__env->startSection('content'); ?>

<div class="main-content payment">
    <!-- Header -->
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
    <!-- Page content -->
    <div class="container mt--8 pb-5 mb-0">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
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
              <div class="row justify-content-between align-items-center mb-3">
                <?php if($link->amount!=null): ?>
                <div class="col-6">
                    <span class="form-text text-xl"><?php echo e($currency->symbol); ?> <?php echo e($link->amount); ?></span>
                </div>
                <?php endif; ?>
              </div>
              <form role="form" action="<?php echo e(route('submit.plancharge')); ?>" method="post" id="modal-details">
                <?php echo csrf_field(); ?>
                <?php if($link->amount==null): ?>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-future"><?php echo e($currency->symbol); ?></span>
                    </div>
                    <input class="form-control" placeholder="0.00" type="number" name="amount" required>
                  </div>
                </div>
                <?php else: ?>
                    <input type="hidden" name="amount" value="<?php echo e($link->amount); ?>">
                <?php endif; ?>
                <?php if($link->times!=null): ?>
                <div class="form-group row">
                    <label class="col-form-label col-lg-4"><?php echo e(__('Auto renewal')); ?></label>
                    <div class="col-lg-3">
                        <select class="form-control select" name="status">
                            <option value="1"><?php echo e(__('Yes')); ?>

                            </option>
                            <option value="0"><?php echo e(__('No')); ?>

                            </option>
                        </select>
                    </div>
                </div>
                <?php endif; ?>
                <div class="text-right">  
                  <small><?php echo e($link->intervals); ?> Renewal</small>
                </div>
                <input type="hidden" value="<?php echo e($link->id); ?>" name="link">
                <div class="modal fade" id="fund" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                  <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                    <div class="modal-content">
                      <div class="modal-body p-0">
                        <div class="accordion" id="accordionExample">
                          <div class="card bg-white border-0 mb-0">
                            <!--Account Balance-->
                            <div class="card-header" id="headingTwo">
                                <div class="text-left" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                  <h4 class="mb-0">Pay with Account</h4>
                                </div>
                            </div>
                            <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                              <div class="card-body text-center">
                                <?php if(Auth::guard('user')->check()): ?>
                                  <form method="post" role="form" action="<?php echo e(route('submit.plancharge')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <h4 class="mb-0">Account Balance</h4>
                                    <h1 class="mb-1 text-muted"><?php echo e($currency->symbol.number_format($user->balance)); ?></h1>
                                    <div class="text-center">
                                      <button type="submit" class="btn btn-neutral btn-sm" form="modal-details">Pay now</button>
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
                <div class="text-center">
                  <button type="button" data-toggle="modal" data-target="#fund" class="btn btn-success my-4"><?php echo e(__('Pay')); ?></button>
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
<?php echo $__env->make('paymentlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/user/plans/sub_view.blade.php ENDPATH**/ ?>