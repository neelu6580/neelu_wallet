

<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row"> 
      <div class="col-lg-4">
        <div class="card bg-white shadow">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-12">
                <h3 class="card-title mb-3"><?php echo e(__('eStore')); ?></h3>
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
                <h3 class="card-title mb-3"><?php echo e(__('e-Invoice')); ?></h3>
              </div>
            </div>
            <p class="card-text text-sm"><?php echo e(__('Billing of your clients is now possible with invoice system, requesting money from anyone is now easy')); ?></p>
            <a href="<?php echo e(route('user.invoice')); ?>" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> <?php echo e(__('Create Invoice')); ?></a>
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
      </div>
      <?php if(Auth::user()->user_type == 1): ?>
          <div class="col-md-12">
              <!--<center><a href="<?php echo e(route('user.upgrade')); ?>"><h3 class="mr-3 upgrade-premium mb-5"><i class="fas fa-crown"></i> <span class="mobile-view">Upgrade to Business</span></h3></a></center>-->
              
                <!--<?php if(empty($user->kyc_link) || $user->kyc_status=='2'): ?>-->
                <div class="alert alert-error alert-dismissible" style="height:50px;background-color: #dd4b39;color: #ffffff;">
    				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    				  <strong><i class="icon fa fa-warning"></i>Alert!</strong>
    				   Your Business account is not started yet. Please upload the document to start.
    				<span class="pull-right">
    					<a href="<?php echo e(route('user.upgrade')); ?>" class="btn bg-navy" style="display:unset !important;background-color: #001f3f ;color: #ffffff;"><i class="fa fa-rocket"></i>  Upgrade Now</a>
    				</span>
                </div>
                <!--<?php endif; ?>-->
          </div>
      <?php endif; ?>
       <div class="col-lg-4">
        <div class="card bg-white shadow">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-12">
                <h3 class="card-title mb-3"><?php echo e(__('Virtual Card')); ?></h3>
              </div>
            </div>
            <p class="card-text text-sm"><?php echo e(__('Enroll and personalize your card and Complete enrollment and accept terms to activate your card visit')); ?></p>
            
          <?php if(Auth::user()->user_type == 1): ?>
                <a class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm"><i class="fa fa-arrow-right"></i> <?php echo e(__('Manage Virtual Cards')); ?></a>
            <?php else: ?>
                <a href="<?php echo e(route('user.ownbank')); ?>" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> <?php echo e(__('Manage Virtual Cards')); ?></a>
            <?php endif; ?>
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
            <?php if(Auth::user()->user_type == 1): ?>
                <a class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm"><i class="fa fa-arrow-right"></i> <?php echo e(__('Send Money')); ?></a>
            <?php else: ?>
                <a href="<?php echo e(route('user.ownbank')); ?>" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> <?php echo e(__('Send Money')); ?></a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">       
        <div class="card bg-white shadow">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-12">
                <h3 class="card-title mb-3"><?php echo e(__('Request Money')); ?></h3>
              </div>
            </div>
            <p class="card-text text-sm"><?php echo e(__('Easily receive money from any member of this community')); ?></p>
            <?php if(Auth::user()->user_type == 1): ?>
                <a class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm"><i class="fa fa-arrow-right"></i> <?php echo e(__('Request Money')); ?></a>
            <?php else: ?>
                <a href="<?php echo e(route('user.request')); ?>" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> <?php echo e(__('Request Money')); ?></a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">        
        <div class="card bg-white shadow">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-12">
                <h3 class="card-title mb-3"><?php echo e(__('Donation Page')); ?></h3>
              </div>
            </div>
            <p class="card-text text-sm"><?php echo e(__('You can now create a donation page to get funds for any project')); ?></p>
            <?php if(Auth::user()->user_type == 1): ?>
                <a class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm"><i class="fa fa-arrow-right"></i> <?php echo e(__('Donations')); ?></a>
            <?php else: ?>
                <a href="<?php echo e(route('user.dplinks')); ?>" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> <?php echo e(__('Donations')); ?></a>
            <?php endif; ?>
          </div>
        </div>
      </div>      
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
              <?php if(Auth::user()->user_type == 1): ?>
                <a class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm"><i class="fa fa-arrow-right"></i> <?php echo e(__('Become a Merchant')); ?></a>
              <?php else: ?>
                <a href="<?php echo e(route('submit.merchant')); ?>" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> <?php echo e(__('Become a Merchant')); ?></a>
              <?php endif; ?>
            </div>
          </div>
        <?php endif; ?>
      </div>
      <div class="col-lg-4">       
        <div class="card bg-white shadow">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-12">
                <h3 class="card-title mb-3"><?php echo e(__('Payment Plan & Subscription')); ?></h3>
              </div>
            </div>
            <p class="card-text text-sm"><?php echo e(__('You can now run your own payment plans and subscription service with ease. Options like fixed asmount and auto renewal is now available')); ?></p>
            <?php if(Auth::user()->user_type == 1): ?>
                <a class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm"><i class="fa fa-arrow-right"></i> <?php echo e(__('Payment Plans')); ?></a>
            <?php else: ?>
                <a href="<?php echo e(route('user.plan')); ?>" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> <?php echo e(__('Payment Plans')); ?></a>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="col-lg-4">        
        <div class="card bg-white shadow">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-12">
                <h3 class="card-title mb-3"><?php echo e(__('Charges')); ?></h3>
              </div>
            </div>
            <p class="card-text text-sm"><?php echo e(__('keep track of your transactions')); ?></p>
            <?php if(Auth::user()->user_type == 1): ?>
                <a class="btn btn-disabled btn-sm" type="button" data-toggle="modal" data-target=".bd-example-modal-sm"><i class="fa fa-arrow-right"></i> <?php echo e(__('Payment Plans')); ?></a>
            <?php else: ?>
                <a href="<?php echo e(route('user.charges')); ?>" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i> <?php echo e(__('Transactions')); ?></a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <!-- Small modal -->
<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Small modal</button>-->

<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content text-center mt-5 pt-5 pb-4">
      <h3> <i class="fas fa-crown" style="color: #fff704; font-size: 20px;"></i> Upgrade to Business</h3>
      <a href="<?php echo e(route('user.upgrade')); ?>"><p>Click Here..</p></a>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/greenvx4/public_html/vcard/core/resources/views/user/dashboard/index.blade.php ENDPATH**/ ?>