<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="card">
          <!-- Card body -->
          <div class="card-body">
            <div class="row justify-content-between align-items-center">
              <div class="col">
                <img src="<?php echo e(url('/')); ?>/asset/profile/<?php echo e($merchant->image); ?>" alt="Image placeholder">
              </div>
              <div class="col-auto">
                <span class="text-dark"><?php echo e(__('Invoice No')); ?> #<?php echo e($invoice->invoice_no); ?></span>
              </div>
            </div>
            <div class="row justify-content-between align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle"><?php echo e(__('FROM')); ?> <?php echo e($invoice->user->email); ?></span><br>
                  <span class="surtitle "><?php echo e(__('TO')); ?> <?php echo e($invoice->email); ?></span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle "><?php echo e(__('DUE DATE')); ?> <?php echo e($invoice->due_date); ?></span>
                </div>
              </div>
            </div>
            <div class="row justify-content-between align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle "><?php echo e(__('INVOICE ITEM')); ?></span><br>
                  <span class="surtitle "><?php echo e(__('QUANTITY')); ?></span><br>
                  <span class="surtitle "><?php echo e(__('AMOUNT')); ?></span><br>
                  <?php if($invoice->notes!=null): ?>
                  <span class="surtitle "><?php echo e(__('NOTES')); ?></span>
                  <?php endif; ?>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle "><?php echo e($invoice->item); ?></span><br>
                  <span class="surtitle "><?php echo e($invoice->quantity); ?></span><br>
                  <span class="surtitle "><?php echo e($currency->symbol.$invoice->amount); ?></span><br>
                  <?php if($invoice->notes!=null): ?>
                  <span class="surtitle "><?php echo e($invoice->notes); ?></span>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <hr>
            <div class="row justify-content-between align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle "><?php echo e(__('SUBTOTAL')); ?></span><br>
                  <span class="surtitle "><?php echo e(__('DISCOUNT')); ?></span></br>
                  <span class="surtitle "><?php echo e(__('TAX')); ?></span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle "><?php echo e($currency->symbol.number_format($invoice->amount*$invoice->quantity)); ?></span><br>
                  <span class="surtitle ">- <?php echo e($currency->symbol.number_format($invoice->amount*$invoice->quantity*$invoice->discount/100)); ?> (<?php echo e($invoice->discount); ?>%)</span><br>
                  <span class="surtitle ">+ <?php echo e($currency->symbol); ?><?php echo e(($invoice->amount*$invoice->quantity*$invoice->tax/100)); ?> (<?php echo e($invoice->tax); ?>%)</span>
                </div>
              </div>
            </div>
            <hr>
            <div class="row justify-content-between align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle"><?php echo e(__('TOTAL')); ?></span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle "><?php echo e($currency->symbol.number_format($invoice->total)); ?></span>
                </div>
              </div>
            </div>
            <form action="<?php echo e(route('submit.preview')); ?>" method="post">
              <?php echo csrf_field(); ?>
              <input type="hidden" name="id" value="<?php echo e($invoice->id); ?>">                                                         
              <div class="text-right">
                <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Send')); ?></a>
              </div>         
            </form>
          </div>
        </div>
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/user/invoice/preview.blade.php ENDPATH**/ ?>