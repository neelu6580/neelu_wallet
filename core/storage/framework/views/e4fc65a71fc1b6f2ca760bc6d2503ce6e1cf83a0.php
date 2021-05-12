<?php $__env->startSection('content'); ?>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="card">
        <div class="card-header header-elements-inline">
            <h3 class="mb-0"><?php echo e(__('Bank transfer logs')); ?></h3>
        </div>
        <div class="table-responsive py-4">
            <table class="table table-flush" id="datatable-buttons">
            <thead class="">
                <tr>
                    <th><?php echo e(__('S/N')); ?></th>
                    <th><?php echo e(__('Reference ID')); ?></th>
                    <th><?php echo e(__('Amount')); ?></th>
                    <th><?php echo e(__('Status')); ?></th>
                    <th><?php echo e(__('Created')); ?></th>
                    <th><?php echo e(__('Last updated')); ?></th>
                </tr>
                </thead>
                <tbody>  
                <?php $__currentLoopData = $bank_transfer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e(++$k); ?>.</td>
                    <td>#<?php echo e($val->trx); ?></td>
                    <td><?php echo e($currency->symbol.number_format($val->amount)); ?></td>
                    <td><?php if($val->status==0): ?> <span class="badge badge-pill badge-danger">pending</span> <?php elseif($val->status==1): ?> <span class="badge badge-pill badge-success">successful</span> <?php elseif($val->status==2): ?> refunded <?php endif; ?></td>
                    <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></td>
                    <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->updated_at))); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            </table>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/greenvx4/public_html/vcard/core/resources/views/user/transactions/bank_transfer.blade.php ENDPATH**/ ?>