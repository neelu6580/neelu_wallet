


<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
  <div class="row">
    <div class="col-md-12">
      <div class="">
        <div class="card-body">
          <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> <?php echo e(__('Add account')); ?></a>
          <div class="modal fade" id="modal-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-body p-0">
                  <div class="card border-0 mb-0">
                    <div class="card-header">
                      <h3 class="mb-0"><?php echo e(__('Add Account')); ?></h3>
                    </div>
                    <div class="card-body">
                      <form role="form" action="<?php echo e(url('user/add_bank')); ?>" method="post"> 
                      <?php echo csrf_field(); ?>
                        <div class="form-group row">
                          <label class="col-form-label col-lg-2"><?php echo e(__('Bank')); ?></label>
                          <div class="col-lg-10">
                            <input type="text" name="name" class="form-control">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-form-label col-lg-2"><?php echo e(__('Acct Name')); ?></label>
                          <div class="col-lg-10">
                            <input type="text" name="acct_name" class="form-control" required>
                          </div>
                        </div>                                                                      
                        <div class="form-group row">
                          <label class="col-form-label col-lg-2"><?php echo e(__('Account No')); ?></label>
                          <div class="col-lg-10">
                            <input type="number" name="acct_no" class="form-control" required>
                          </div>
                        </div>                        
                        <div class="form-group row">
                          <label class="col-form-label col-lg-2"><?php echo e(__('ABA Routing #')); ?></label>
                          <div class="col-lg-10">
                            <input type="text" name="swift" class="form-control" required>
                          </div>
                        </div>
                        <div class="text-right">
                          <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Save')); ?></button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <?php $__currentLoopData = $bank; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-md-6">
          <div class="card">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <!-- Title -->
                  <h5 class="h4 mb-0 text-dark"><?php echo e($val->name); ?></h5>
                </div>
                <div class="col text-right">
                  <?php if($val->status==0): ?>
                  <a href="<?php echo e(route('bank.default', ['id' => $val->id])); ?>" class="btn btn-sm btn-success"><?php echo e(__('Default')); ?></a>
                  <?php endif; ?>
                  <a data-toggle="modal" data-target="#modal-form<?php echo e($val->id); ?>"href="#" class="btn btn-sm btn-neutral"><?php echo e(__('Edit')); ?></a>
                  <a href="<?php echo e(route('bank.delete', ['id' => $val->id])); ?>" class="btn btn-sm btn-danger"><?php echo e(__('Delete')); ?></a>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <p class="text-sm text-dark mb-0"><?php echo e(__('Account No')); ?> #: <?php echo e($val->acct_no); ?></p>
                  <p class="text-sm text-dark mb-0"><?php echo e(__('Name')); ?>: <?php echo e($val->acct_name); ?></p>
                  <p class="text-sm text-dark mb-0"><?php echo e(__('ABA Routing #')); ?>: <?php echo e($val->swift); ?></p>
                  <p class="text-sm text-dark mb-0"><?php echo e(__('Default account')); ?>: <?php if($val->status==1): ?> Yes <?php else: ?> No <?php endif; ?></p>
                  <p class="text-sm text-dark mb-0"><?php echo e(__('Created')); ?>: <?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></p>
                  <p class="text-sm text-dark mb-0"><?php echo e(__('Updated')); ?>: <?php echo e(date("Y/m/d h:i:A", strtotime($val->updated_at))); ?></p>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="modal fade" id="modal-form<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-body p-0">
              <div class="card border-0 mb-0">
                <div class="card-header">
                  <h3 class="mb-0"><?php echo e(__('Edit Bank')); ?></h3>
                </div>
                <div class="card-body">
                  <form role="form" action="<?php echo e(url('user/edit_bank')); ?>" method="post"> 
                  <?php echo csrf_field(); ?>
                    <div class="form-group row">
                      <label class="col-form-label col-lg-2"><?php echo e(__('Bank')); ?></label>
                        <div class="col-lg-10">
                          <input type="text" name="name" placeholder="Bank name" class="form-control" value="<?php echo e($val['name']); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                          <label class="col-form-label col-lg-2"><?php echo e(__('Acct Name')); ?></label>
                          <div class="col-lg-10">
                        <input type="text" name="acct_name" placeholder="Account name" class="form-control" value="<?php echo e($val['acct_name']); ?>">
                      </div>
                    </div>                           
                    <div class="form-group row">
                          <label class="col-form-label col-lg-2"><?php echo e(__('Account No')); ?></label>
                          <div class="col-lg-10">
                        <input type="number" name="acct_no" placeholder="Account number" class="form-control" value="<?php echo e($val['acct_no']); ?>">
                        <input type="hidden" name="id" value="<?php echo e($val['id']); ?>">
                      </div>
                    </div>                    
                    <div class="form-group row">
                          <label class="col-form-label col-lg-2"><?php echo e(__('Swift')); ?></label>
                          <div class="col-lg-10">
                        <input type="text" name="swift" placeholder="Swift code" class="form-control" value="<?php echo e($val['swift']); ?>">
                        <input type="hidden" name="id" value="<?php echo e($val['id']); ?>">
                      </div>
                    </div>
                    <div class="text-right">
                      <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Update Acount')); ?></button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
  <div class="row">
      <div class="col-md-12">
      <?php echo e($bank->links()); ?>

      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/user/bank/index.blade.php ENDPATH**/ ?>