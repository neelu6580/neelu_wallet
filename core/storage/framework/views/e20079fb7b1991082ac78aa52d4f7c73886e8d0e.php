<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
          <div class="card-header header-elements-inline">
            <h3 class="mb-0"><?php echo e(__('Create merchant')); ?></h3>
                <div class="header-elements">
                  <div class="list-icons">
                </div>
              </div>
          </div>
          <div class="card-body">
            <form action="<?php echo e(route('submit.merchant')); ?>" enctype="multipart/form-data" method="post">
              <?php echo csrf_field(); ?>
              <div class="form-group row">
                <label class="col-form-label col-lg-2"><?php echo e(__('Merchant Name')); ?></label>
                <div class="col-lg-10">
                  <input type="text" name="merchant_name" class="form-control" placeholder="Name of your website / Brand" required>
                </div>
              </div>                 
              <div class="form-group row">
                <label class="col-form-label col-lg-2"><?php echo e(__('Description')); ?></label>
                <div class="col-lg-10">
                  <div class="input-group">
                    <textarea type="text" class="form-control" rows="4" placeholder="Product description or extra instructions"  name="merchant_description" required></textarea>
                  </div>
                </div>
              </div> 
              <div class="form-group row">
                <label class="col-form-label col-lg-2"><?php echo e(__('Merchant Link')); ?></label>
                <div class="col-lg-10">
                  <input type="url" name="site_link" class="form-control" placeholder="https://merchant.site" required>
                </div>
              </div>                
              <div class="form-group row">
                  <label class="col-form-label col-lg-2"><?php echo e(__('Brand Image')); ?></label>
                  <div class="col-lg-10">
                      <div class="custom-file">
                          <input type="file" class="custom-file-input" name="image" accept="image/*" id="customFileLang">
                          <label class="custom-file-label" for="customFileLang"><?php echo e(__('Choose Image')); ?></label>
                      </div>
                  </div>
              </div>                        
              <div class="form-group row">
                <label class="col-form-label col-lg-2"><?php echo e(__('Send Notifications To')); ?></label>
                <div class="col-lg-10">
                  <input type="email" name="email" class="form-control" placeholder="If provided, this email address will get transaction notices" required>
                </div>
              </div>                 
              <div class="text-right">
                <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Save')); ?></a>
              </div>         
            </form>
          </div>
        </div>
        <!-- /basic layout -->
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/user/merchant/create.blade.php ENDPATH**/ ?>