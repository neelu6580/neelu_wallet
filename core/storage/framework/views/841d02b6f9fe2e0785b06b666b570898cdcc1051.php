

<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row"> 
      <div class="col-md-12">
          <center><h3 class="mr-3 upgrade-premium my-4"><i class="fas fa-crown"></i> <span class="mobile-view">Business Features</span></h3></center>
      </div>
      <div class="col-md-4">
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
      <div class="col-md-4">       
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
      <div class="col-md-4">        
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
      <div class="col-md-4">
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
      <div class="col-md-4">       
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
      <div class="col-md-4">        
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
      <div class="col-md-12">
          <center><h3 class="mr-3 upgrade-premium my-4">Upload Documents</h3></center>
      </div>
      <div class="col-md-12">
        <div class="card" id="edit">
          <div class="card-header header-elements-inline">
            <h3 class="mb-0"><?php echo e(__('Your Documents')); ?></h3>
          </div>
          <div class="card-body">
            <form method="post" action="<?php echo e(url('user/kyc')); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
                <div class="form-group row">
                  <label class="col-form-label col-lg-3"><?php echo e(__('Company Certificate')); ?></label>
                  <div class="col-lg-9">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="file" class="custom-file-input" id="customFileLang1" name="image">
                            <label class="custom-file-label sdsd" for="customFileLang1"><?php echo e(__('Upload')); ?></label>
                        </div> 
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-lg-3"><?php echo e(__('Address Proof')); ?></label>
                  <div class="col-lg-9">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="file" class="custom-file-input" id="customFileLang3" name="address_id">
                            <label class="custom-file-label sdsd2" for="customFileLang3"><?php echo e(__('Upload')); ?></label>
                        </div> 
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                    <div class="row">
                        <div class="col-md-12">
                            <small>(Document format supported PDF, JPG, JPEG, PNG files,<br> Max Size: 10MB each document,<br> Addredd Proof: latest bank statement or unities bill (within 90 days))</small>
                        </div>
                    </div>
                </div>
                <div class="text-left">
                    <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Upload')); ?></button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/user/dashboard/upgrade.blade.php ENDPATH**/ ?>