<?php $__env->startSection('content'); ?>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="card">
        <div class="card-header header-elements-inline">
            <h3 class="mb-0"><?php echo e(__('Transactions')); ?></h3>
        </div>
        <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-buttons">
            <thead>
            <tr>
                <th><?php echo e(__('S / N')); ?></th>
                <th><?php echo e(__('Name')); ?></th>
                <th><?php echo e(__('From')); ?></th>
                <th><?php echo e(__('IP Address')); ?></th>
                <th><?php echo e(__('Type')); ?></th>
                <th><?php echo e(__('Status')); ?></th>
                <th><?php echo e(__('Amount')); ?></th>
                <th><?php echo e(__('Charge')); ?></th>
                <th><?php echo e(__('Reference ID')); ?></th>
                <th><?php echo e(__('Payment Type')); ?></th>
                <th><?php echo e(__('Created')); ?></th>
                <th><?php echo e(__('updated')); ?></th>
            </tr>
            </thead>
            <tbody>  
            <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$xval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                <td><?php echo e(++$k); ?>.</td>
                <td><?php echo e($xval->ddlink['name']); ?></td>
                <td><?php if($xval->sender_id!=null): ?> <?php echo e($xval->sender['first_name'].' '.$xval->sender['last_name']); ?> [<?php echo e($xval->sender['email']); ?>] <?php else: ?> <?php echo e($xval->first_name.' '.$xval->last_name); ?> [<?php echo e($xval->email); ?>] <?php endif; ?></td>
                <td><?php echo e($xval->ip_address); ?></td>
                <td><?php if($xval->sender_id==$user->id): ?> Paid <?php else: ?> Received <?php endif; ?></td>
                <td><?php if($xval->status==0): ?> <span class="badge badge-pill badge-danger">failed</span> <?php elseif($xval->status==1): ?> <span class="badge badge-pill badge-success">successful</span> <?php elseif($xval->status==2): ?> refunded <?php endif; ?></td>
                <td><?php echo e($currency->symbol.$xval->amount); ?></td>
                <td><?php if($xval->sender_id==$user->id || $xval->charge==null): ?> - <?php else: ?> <?php echo e($currency->symbol.$xval->charge); ?> <?php endif; ?></td>
                <td><?php echo e($xval->ref_id); ?></td>
                <td><?php echo e($xval->payment_type); ?> <?php if($xval->payment_type=='card'): ?> - XXXX XXXX XXXX <?php echo e(substr($xval->card_number, 12)); ?> <?php endif; ?></td>
                <td><?php echo e(date("Y/m/d h:i:A", strtotime($xval->created_at))); ?></td>
                <td><?php echo e(date("Y/m/d h:i:A", strtotime($xval->updated_at))); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/boompay/core/resources/views/admin/transfer/trans.blade.php ENDPATH**/ ?>