<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h5 class="h3 mb-0"><?php echo e(__('Media')); ?></h5>
          </div>
          <div class="card-body">
            <!-- List group -->
            <ul class="list-group list-group-flush list my--3">
              <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item px-0">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <!-- Avatar -->
                      <a href="#" class="avatar">
                        <img alt="Image placeholder" src="<?php echo e(url('/')); ?>/asset/profile/<?php echo e($val->image); ?>">
                      </a>
                    </div>
                    <div class="col ml--2">
                    <span class="text-gray text-uppercase form-text"><?php echo e($val->image); ?></span>
                    </div>
                    <div class="col-auto">
                      <a href="<?php echo e(url('/')); ?>/user/delete-product-image/<?php echo e($val->id); ?>" class="btn btn-sm btn-neutral"><i class="fa fa-trash"></i> <?php echo e(__('Delete')); ?></a>
                    </div>
                  </div>
                </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul><br><br>
            <form action="<?php echo e(route('submit.product.image')); ?>" enctype="multipart/form-data" method="post">
              <?php echo csrf_field(); ?>
              <div class="form-group row">
                  <div class="col-lg-12">
                      <div class="custom-file text-center">
                      <input type="hidden" value="<?php echo e($product->id); ?>" name="id">
                          <input type="file" class="custom-file-input" name="file" accept="image/*" id="customFileLang">
                          <label class="custom-file-label" for="customFileLang"><?php echo e(__('Choose Media')); ?></label>
                      </div>
                  </div>
              </div> 
  
              <div class="text-right">
                <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Upload')); ?></a>
              </div>  
            </form>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <form action="<?php echo e(route('product.feature.submit')); ?>" method="post">
              <?php echo csrf_field(); ?>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group row">
                    <label class="col-form-label col-lg-12"><?php echo e(__('Status')); ?></label>
                    <div class="col-lg-12">
                      <label class="custom-toggle custom-toggle-success">
                        <?php if($product->status==1): ?>
                          <input type="checkbox" name="status" class="" value="1" checked>
                        <?php else: ?>
                          <input type="checkbox" name="status" class="" value="1">
                        <?php endif; ?>
                        <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                      </label>
                    </div>
                  </div>                 
                </div>    
                <div class="col-lg-6">             
                  <div class="form-group row">
                    <label class="col-form-label col-lg-12"><?php echo e(__('Shipping Status')); ?></label>
                    <div class="col-lg-12">
                      <label class="custom-toggle custom-toggle-success">
                        <?php if($product->shipping_status==1): ?>
                          <input type="checkbox" name="shipping_status" class="" value="1" checked>
                        <?php else: ?>
                          <input type="checkbox" name="shipping_status" class="" value="1">
                        <?php endif; ?>
                        <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>
                      </label>
                    </div>
                  </div> 
                </div>
              </div>    
              <div class="form-group row">
                <div class="col-lg-12">
                <span class="form-text text-xs"><?php echo e(__('Describe your product vividly to give customers a reason to buy and increase your sales.')); ?></span>
                <a data-toggle="modal" data-target="#description" href="" class="btn btn-white btn-sm"><?php echo e(__('Add Description & Shipping fee')); ?></a>
                </div>
              </div>            
              <div class="form-group row">
                <label class="col-form-label col-lg-12"><?php echo e(__('Shareable URL')); ?></label>
                <div class="col-lg-12">
                <span class="form-text text-xs"><?php echo e(route('product.link', ['id' => $product->ref_id])); ?></span>
                <button type="button" class="btn-icon-clipboard" data-clipboard-text="<?php echo e(route('product.link', ['id' => $product->ref_id])); ?>" title="Copy"><?php echo e(__('Copy')); ?></button>
                </div>
              </div>                    
              <div class="form-group row">
                <label class="col-form-label col-lg-7"><?php echo e(__('Delivery Address')); ?></label>
                <div class="col-lg-5">
                  <input type="hidden" value="<?php echo e($product->id); ?>" name="id">
                  <select class="form-control custom-select" name="add_status" required>
                    <option value='0' <?php if($product->add_status==0): ?> selected <?php endif; ?>><?php echo e(__('Disabled')); ?></option>
                    <option value='1' <?php if($product->add_status==1): ?> selected <?php endif; ?>><?php echo e(__('Required')); ?></option>
                  </select>
                </div>
              </div>               
              <div class="form-group row">
                <label class="col-form-label col-lg-7"><?php echo e(__('Delivery Note')); ?></label>
                <div class="col-lg-5">
                  <select class="form-control custom-select" name="note_status" required>
                    <option value='0' <?php if($product->note_status==0): ?> selected <?php endif; ?>><?php echo e(__('Disabled')); ?></option>
                    <option value='1' <?php if($product->note_status==1): ?> selected <?php endif; ?>><?php echo e(__('Required')); ?></option>
                    <option value='2' <?php if($product->note_status==2): ?> selected <?php endif; ?>><?php echo e(__('Optional')); ?></option>
                  </select>
                </div>
              </div>              
              <div class="form-group row">
                <label class="col-form-label col-lg-7"><?php echo e(__('Quantity type')); ?></label>
                <div class="col-lg-5">
                  <select class="form-control custom-select" name="quantity_status" required>
                    <option value='0' <?php if($product->quantity_status==0): ?> selected <?php endif; ?>>Limited</option>
                    <option value='1' <?php if($product->quantity_status==1): ?> selected <?php endif; ?>>Unlimited</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-lg-5"><?php echo e(__('Amount')); ?></label>
                <div class="col-lg-7">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                    </div>
                    <input type="number" step="any" name="amount" value="<?php echo e($product->amount); ?>" maxlength="10" class="form-control" required="">
                  </div>
                </div>
              </div>
              <?php if($product->quantity_status==0): ?>
              <div class="form-group row">
                <label class="col-form-label col-lg-4"><?php echo e(__('Quantity')); ?></label>
                <div class="col-lg-8">
                  <input type="number" name="quantity" class="form-control" value="<?php echo e($product->quantity); ?>" required>
                </div>
              </div> 
              <?php endif; ?> 
              
              <div class="form-group row">
                <label class="col-form-label col-lg-4">Length (in CM)</label>
                <div class="col-lg-8">
                  <input type="number" name="length" class="form-control" value="<?php echo e($product->length); ?>" required>
                </div>
              </div> 
              <div class="form-group row">
                <label class="col-form-label col-lg-4">Width (in CM)</label>
                <div class="col-lg-8">
                  <input type="number" name="width" class="form-control" value="<?php echo e($product->width); ?>" required>
                </div>
              </div> 
              <div class="form-group row">
                <label class="col-form-label col-lg-4">Height (in CM)</label>
                <div class="col-lg-8">
                  <input type="number" name="height" class="form-control" value="<?php echo e($product->height); ?>" required>
                </div>
              </div> 
              <div class="form-group row">
                <label class="col-form-label col-lg-4">Weight (in GM)</label>
                <div class="col-lg-8">
                  <input type="number" name="weight" class="form-control" value="<?php echo e($product->weight); ?>" required>
                </div>
              </div> 
              <div class="text-right">
                <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Save')); ?></a>
              </div>         
            </form>
          </div>
        </div> 
        <div class="modal fade" id="description" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                  <div class="card-header">
                    <h3 class="mb-0"><?php echo e(__('Description & Shipping fee')); ?></h3>
                  </div>
                  <div class="card-body px-lg-5 py-lg-5">
                    <form action="<?php echo e(route('product.description.submit')); ?>" method="post">
                      <?php echo csrf_field(); ?>
                      <div class="form-group">
                        <textarea type="text" name="description" rows="5" class="form-control tinymce" placeholder="Describe your product"><?php echo e($product->description); ?></textarea>
                        <input type="hidden" value="<?php echo e($product->id); ?>" name="id">
                      </div>   
                      <?php if($product->shipping_status==1): ?>
                      <div class="form-group row">
                        <label class="col-form-label col-lg-4"><?php echo e(__('Shipping Fee')); ?></label>
                        <div class="col-lg-8">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                            </div>
                            <input type="number" step="any" name="shipping_fee" value="<?php echo e($product->shipping_fee); ?>" maxlength="10" class="form-control" required="">
                          </div>
                        </div>
                      </div>
                      <?php endif; ?>             
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/greenvx4/public_html/vcard/core/resources/views/user/product/edit.blade.php ENDPATH**/ ?>