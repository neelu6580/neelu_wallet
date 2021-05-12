<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12">
        <div class="card-header">
            <h5 class="h3 mb-0"><?php echo e(__('Orders')); ?></h5>
          </div>
        <div class="row">  
          <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6">
              <div class="card bg-white">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <!-- Title -->
                      <h5 class="h4 mb-0 text-dark">#<?php echo e($val->ref_id); ?></h5>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col">
                        <p class="text-sm text-dark mb-0"><?php echo e(__('Product')); ?>: <?php echo e($val->product->name); ?></p>
                        <p class="text-sm text-dark mb-0"><?php echo e(__('Name')); ?>: <?php echo e($val->first_name); ?> <?php echo e($val->last_name); ?></p>
                        <p class="text-sm text-dark mb-0"><?php echo e(__('Email')); ?>: <?php echo e($val->email); ?></p>
                        <p class="text-sm text-dark mb-0"><?php echo e(__('Phone')); ?>: <?php echo e($val->phone); ?></p>
                        <?php if($val->product->quantity_status==0): ?>
                        <p class="text-sm text-dark mb-0"><?php echo e(__('Quantity')); ?>: <?php echo e($val->quantity); ?></p>
                        <?php endif; ?>                        
                        <?php if($val->product->shipping_status==1): ?>
                        <p class="text-sm text-dark mb-0"><?php echo e(__('Country')); ?>: <?php echo e($val->country); ?></p>
                        <p class="text-sm text-dark mb-0"><?php echo e(__('State')); ?>: <?php echo e($val->state); ?></p>
                        <p class="text-sm text-dark mb-0"><?php echo e(__('Town/City')); ?>: <?php echo e($val->town); ?></p>
                        <p class="text-sm text-dark mb-0"><?php echo e(__('Address')); ?>: <?php echo e($val->address); ?></p>
                        <p class="text-sm text-dark mb-0"><?php echo e(__('Shipping fee')); ?>: <?php echo e($currency->symbol.$val->shipping_fee); ?></p>
                        <?php endif; ?>
                        <?php if($val->product->note_status==1 || $val->product->note_status==2): ?>
                            <?php if(!empty($val->note)): ?>
                                <p class="text-sm text-dark mb-0"><?php echo e(__('Note')); ?>: <?php echo e($val->note); ?></p>
                            <?php endif; ?>
                        <?php endif; ?>    
                        <p class="text-sm text-dark mb-0"><?php echo e(__('Amount')); ?>: <?php echo e($currency->symbol); ?><?php echo e(number_format($val->amount)); ?></p>
                        <p class="text-sm text-dark mb-0"><?php echo e(__('Total')); ?>: <?php echo e($currency->symbol.number_format($val->total)); ?></p>
                        <p class="text-sm text-dark mb-0"><?php echo e(__('Created')); ?>: <?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></p>
                        <span class="badge badge-pill badge-primary"><?php echo e(__('Fee')); ?>: <?php echo e($currency->symbol.number_format($val->charge)); ?></span>
                      </div>
                    </div>
                </div>
              </div>
            </div> 
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div> 
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/boompay/core/resources/views/user/product/orders.blade.php ENDPATH**/ ?>