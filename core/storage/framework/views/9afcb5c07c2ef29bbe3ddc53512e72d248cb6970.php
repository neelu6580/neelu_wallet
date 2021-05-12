<?php $__env->startSection('content'); ?>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <div class="">
          <div class="card-body">
            <div class="">
              <a href="<?php echo e(route('user.add-merchant')); ?>" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> <?php echo e(__('Add website')); ?></a>
              <a href="<?php echo e(route('user.merchant-documentation')); ?>"  class="btn btn-sm btn-success"><?php echo e(__('Documentation')); ?></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">  
      <div class="col-md-8">
        <?php $__currentLoopData = $merchant; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-md-12">
              <div class="card">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-4">
                      <h5 class="h3 mb-0 text-dark"><?php echo e($val->name); ?></h5>
                    </div>
                    <div class="col-8 text-right">
                      <?php if($val->status==1): ?>
                      <a href="<?php echo e(url('/')); ?>/user/edit-merchant/<?php echo e($val->id); ?>" class="btn btn-sm btn-primary" title="Edit Merchant">Edit</a>
                      <a href="<?php echo e(url('/')); ?>/user/log-merchant/<?php echo e($val->merchant_key); ?>" class="btn btn-sm btn-neutral" title="Merchant Logs">Merchant Logs</a>
                      <?php endif; ?>
                      <a data-toggle="modal" data-target="#delete<?php echo e($val->id); ?>" href="" class="text-danger" title="Delete link"><i class="fa fa-close"></i></a>
                    </div>
                  </div>
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <!-- Avatar -->
                      <a href="javascript:void;" class="avatar avatar-xl">
                        <img alt="Image placeholder" src="<?php echo e(url('/')); ?>/asset/profile/<?php echo e($val->image); ?>">
                      </a>
                    </div>
                    <div class="col">
                      <p class="text-sm text-dark mb-0"><div class="text-success text-sm"><?php echo e($val->site_url); ?></div></p>
                      <p class="text-sm text-dark mb-0"><?php echo e(__('Notify email')); ?>: <?php echo e($val->email); ?></p>
                      <p class="text-sm text-dark mb-0"><?php echo e(__('Description')); ?>: <?php echo e($val->description); ?></p>
                      <p class="text-sm text-dark mb-0"><?php echo e(__('Date')); ?>: <?php echo e(date("h:i:A j, M Y", strtotime($val->created_at))); ?></p>
                      <p class="text-sm text-dark mb-0"><button type="button" class="btn-icon-clipboard" data-clipboard-text="<?php echo e($val->merchant_key); ?>" title="Copy"><?php echo e(__('Copy Merchant key')); ?></button></p>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <div class="modal fade" id="delete<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
              <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                  <div class="modal-content">
                      <div class="modal-body p-0">
                          <div class="card bg-white border-0 mb-0">
                              <div class="card-header">
                                  <span class="mb-0 text-sm"><?php echo e(__('Are you sure you want to delete this?, all transaction related to this will also be deleted')); ?></span>
                              </div>
                              <div class="card-body px-lg-5 py-lg-5 text-right">
                                  <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                  <a  href="<?php echo e(route('delete.merchant', ['id' => $val->id])); ?>" class="btn btn-danger btn-sm"><?php echo e(__('Proceed')); ?></a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col text-center">
                <h4 class="mb-4 text-primary">
                <?php echo e(__('Statistics')); ?>

                </h4>
                <span class="text-sm text-dark mb-0"><i class="fa fa-google-wallet"></i> <?php echo e(__('Received')); ?></span><br>
                <span class="text-xl text-dark mb-0"><?php echo e($currency->name); ?> <?php echo e(number_format($received)); ?>.00</span><br>
                <hr>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle"><?php echo e(__('Pending')); ?></span><br>
                  <span class="surtitle"><?php echo e(__('Abandoned')); ?></span><br>
                  <span class="surtitle "><?php echo e(__('Total')); ?></span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle "><?php echo e($currency->name); ?> <?php echo e(number_format($pending)); ?>.00</span><br>
                  <span class="surtitle "><?php echo e($currency->name); ?> <?php echo e(number_format($abadoned)); ?>.00</span><br>
                  <span class="surtitle "><?php echo e($currency->name); ?> <?php echo e(number_format($total)); ?>.00</span>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/boompay/core/resources/views/user/merchant/index.blade.php ENDPATH**/ ?>