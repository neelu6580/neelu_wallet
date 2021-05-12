
<?php $__env->startSection('content'); ?>

<div class="main-content payment">
    <!-- Header -->
    <div class="header py-7 py-lg-8 pt-lg-1">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5 mb-0">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card card-profile bg-white border-0 mb-5">
            <div class="card-body pt-7 px-5">
              <div class="text-center text-dark mb-5">
                <small><?php echo e(__('PLEASE SEND EXACTLY')); ?> <span class="text-success"> <?php echo e($bcoin); ?></span> <?php echo e(__('BTC')); ?> <?php echo e(__('TO')); ?> <span class="text-primary"> <?php echo e($wallet); ?> .</span> Your account will be credited upon 2 confirmations automatically</small>
              </div>
              <div class="text-center">
                <?php echo $qr; ?>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('paymentlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/user/payment/coinpaybtc.blade.php ENDPATH**/ ?>