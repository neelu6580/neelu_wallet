<?php $__env->startSection('content'); ?>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <div class="">
          <div class="card-body">
            <div class="">
              <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i><?php echo e(__(' New Product')); ?></a>
              <a href="<?php echo e(route('user.list')); ?>" class="btn btn-sm btn-success"><i class="fa fa-braille"></i><?php echo e(__(' Your Orders')); ?></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="modal fade" id="modal-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                  <div class="card-header">
                    <h3 class="mb-0"><?php echo e(__('New Product')); ?></h3>
                  </div>
                  <div class="card-body px-lg-5 py-lg-5">
                    <form action="<?php echo e(route('submit.product')); ?>" method="post">
                      <?php echo csrf_field(); ?>
                      <div class="form-group row">
                        <label class="col-form-label col-lg-2"><?php echo e(__('Name')); ?></label>
                        <div class="col-lg-10">
                          <input type="text" name="name" class="form-control" placeholder="The name of your product" required>
                        </div>
                      </div>       
                      <div class="form-group row">
                        <label class="col-form-label col-lg-2"><?php echo e(__('Amount')); ?></label>
                        <div class="col-lg-10">
                          <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                            </div>
                            <input type="number" step="any" name="amount" maxlength="10" class="form-control" required="">
                          </div>
                        </div>
                      </div>  
                      <div class="form-group row">
                        <label class="col-form-label col-lg-2"><?php echo e(__('Quantity')); ?></label>
                        <div class="col-lg-10">
                          <input type="number" name="quantity" class="form-control" value="1" required>
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
    <div class="row">  
      <div class="col-md-8">
        <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-md-12">
            <div class="card">
              <!-- Card body -->
              <div class="card-body">
                <div class="row mb-3">
                  <div class="col-4">
                    <span class="form-text text-xl"><?php echo e($currency->symbol); ?> <?php echo e(number_format($val->amount)); ?>.00</span>
                  </div>
                  <div class="col-8 text-right">
                    <?php if($val->status==1): ?>
                    <a href="<?php echo e(url('/')); ?>/user/edit-product/<?php echo e($val->id); ?>" class="btn btn-sm btn-success" title="Edit Product"><i class="fa fa-pencil"></i> Edit</a>
                    <a href="<?php echo e(url('/')); ?>/user/orders/<?php echo e($val->id); ?>" class="btn btn-sm btn-neutral" title="Orders"><i class="fa fa-spinner"></i> Orders</a>
                    <?php endif; ?>
                    <a data-toggle="modal" data-target="#delete<?php echo e($val->id); ?>" href="" class="text-danger" title="Delete link"><i class="fa fa-close"></i></a>
                  </div>
                </div>
                <div class="row align-items-center">
                  <div class="col-auto">
                    <!-- Avatar -->
                    <a href="javascript:void;" class="avatar avatar-l">
                      <img               
                      <?php if($val->new==0): ?>
                        src="<?php echo e(url('/')); ?>/asset/images/product-placeholder.jpg"
                      <?php else: ?>
                        <?php
                        $image=App\Models\Productimage::whereproduct_id($val->id)->first();
                        ?>
                        src="<?php echo e(url('/')); ?>/asset/profile/<?php echo e($image['image']); ?>"
                      <?php endif; ?> alt="Image placeholder">
                    </a>
                  </div>
                  <div class="col">
                    <p class="text-sm text-dark mb-0"><?php echo e($val->name); ?></p>
                    <p class="text-sm text-dark mb-0">Stock: <?php echo e($val->quantity); ?></p>
                    <p class="text-sm text-dark mb-0"><button type="button" class="btn-icon-clipboard" data-clipboard-text="<?php echo e(route('product.link', ['id' => $val->ref_id])); ?>" title="Copy"><?php echo e(__('Copy Product Link')); ?></button></p>
                    <?php if($val->status==1): ?>
                        <span class="badge badge-pill badge-success"><?php echo e(__('Active')); ?></span>
                    <?php else: ?>
                        <span class="badge badge-pill badge-danger"><?php echo e(__('Disabled')); ?></span>
                    <?php endif; ?>

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
                                  <a  href="<?php echo e(route('delete.product', ['id' => $val->id])); ?>" class="btn btn-danger btn-sm"><?php echo e(__('Proceed')); ?></a>
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
                  <span class="surtitle "><?php echo e(__('Total')); ?></span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle "><?php echo e($currency->name); ?> 00.00</span><br>
                  <span class="surtitle "><?php echo e($currency->name); ?> <?php echo e(number_format($total)); ?>.00</span>
                </div>
              </div>
            </div>
          </div>
        </div> 
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/boompay/core/resources/views/user/product/index.blade.php ENDPATH**/ ?>