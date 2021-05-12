<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row"> 
      <div class="col-lg-4">
        <?php if($set->merchant==1): ?>
          <div class="card bg-white shadow">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-12">
                  <h3 class="card-title mb-3"><?php echo e(__('Payment Button')); ?></h3>
                </div>
              </div>
              <p class="card-text text-sm">Receiving money on your website is now easy with simple integeration at a fee of <?php echo e($set->merchant_charge); ?>% per transaction</p>
              <a href="<?php echo e(route('submit.merchant')); ?>" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> <?php echo e(__('Become a Merchant')); ?></a>
            </div>
          </div>
        <?php endif; ?>
        <div class="card bg-white shadow">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-12">
                <h3 class="card-title mb-3"><?php echo e(__('Invoice')); ?></h3>
              </div>
            </div>
            <p class="card-text text-sm"><?php echo e(__('Billing of your clients is now possible with invoice system, requesting money from anyone is now easy')); ?></p>
            <a href="<?php echo e(route('user.invoice')); ?>" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> <?php echo e(__('Create Invoice')); ?></a>
          </div>
        </div>
        <div class="card bg-white shadow">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-12">
                <h3 class="card-title mb-3"><?php echo e(__('Store')); ?></h3>
              </div>
            </div>
            <p class="card-text text-sm"><?php echo e(__('Digital and any product can now be sold easily. Create & share your products to clients')); ?></p>
            <a href="<?php echo e(route('user.product')); ?>" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> <?php echo e(__('Sell Product')); ?></a>
          </div>
        </div> 
      </div>
      <div class="col-lg-4">
        <div class="card bg-white shadow">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-12">
                <h3 class="card-title mb-3"><?php echo e(__('Transfer Money')); ?></h3>
              </div>
            </div>
            <p class="card-text text-sm"><?php echo e(__('You can now transfer money to anyone without account restriction, all you need is an email address.')); ?></p>
            <a href="<?php echo e(route('user.ownbank')); ?>" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> <?php echo e(__('Send Money')); ?></a>
          </div>
        </div>        
        <div class="card bg-white shadow">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-12">
                <h3 class="card-title mb-3"><?php echo e(__('Request Money')); ?></h3>
              </div>
            </div>
            <p class="card-text text-sm"><?php echo e(__('Easily receive money from any member of this community')); ?></p>
            <a href="<?php echo e(route('user.request')); ?>" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> <?php echo e(__('Request Money')); ?></a>
          </div>
        </div>        
        <div class="card bg-white shadow">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-12">
                <h3 class="card-title mb-3"><?php echo e(__('Donation Page')); ?></h3>
              </div>
            </div>
            <p class="card-text text-sm"><?php echo e(__('You can now create a donation page to get funds for any project')); ?></p>
            <a href="<?php echo e(route('user.dplinks')); ?>" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> <?php echo e(__('Donations')); ?></a>
          </div>
        </div>
      </div>      
      <div class="col-lg-4">
        <div class="card bg-white shadow">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-12">
                <h3 class="card-title mb-3"><?php echo e(__('Single Charge')); ?></h3>
              </div>
            </div>
            <p class="card-text text-sm"><?php echo e(__('Sending payment link for single charge is now possible. Single charge is a one time payment for any needed service or product.')); ?></p>
            <a href="<?php echo e(route('user.sclinks')); ?>" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> <?php echo e(__('Payment Links')); ?></a>
          </div>
        </div>        
        <div class="card bg-white shadow">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-12">
                <h3 class="card-title mb-3"><?php echo e(__('Payment Plan & Subscription')); ?></h3>
              </div>
            </div>
            <p class="card-text text-sm"><?php echo e(__('You can now run your own payment plans and subscription service with ease. Options like fixed asmount and auto renewal is now available')); ?></p>
            <a href="<?php echo e(route('user.plan')); ?>" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> <?php echo e(__('Payment Plans')); ?></a>
          </div>
        </div>        
        <div class="card bg-white shadow">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-12">
                <h3 class="card-title mb-3"><?php echo e(__('Charges')); ?></h3>
              </div>
            </div>
            <p class="card-text text-sm"><?php echo e(__('keep track of your transactions')); ?></p>
            <a href="<?php echo e(route('user.charges')); ?>" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> <?php echo e(__('Transactions')); ?></a>
          </div>
        </div>
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/boompay/core/resources/views/user/dashboard/index.blade.php ENDPATH**/ ?>