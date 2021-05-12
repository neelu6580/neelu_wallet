<?php $__env->startSection('content'); ?>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="card">
      <div class="card-header header-elements-inline">
        <h3 class="mb-0"><?php echo e($plan->name); ?> - #<?php echo e($plan->ref_id); ?></h3>
      </div>
      <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-buttons">
          <thead>
            <tr>
              <th><?php echo e(__('S / N')); ?></th>
              <th><?php echo e(__('Amount')); ?></th>
              <th><?php echo e(__('Subscriber')); ?></th>
              <th><?php echo e(__('Reference ID')); ?></th>
              <th><?php echo e(__('Expiring Date')); ?></th>
              <th><?php echo e(__('Renewal')); ?></th>
              <th><?php echo e(__('Created')); ?></th>
            </tr>
          </thead>
          <tbody>  
            <?php $__currentLoopData = $sub; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e(++$k); ?>.</td>
                <td><?php if($val->plan['amount']==null): ?><?php echo e($currency->symbol.number_format($val->amount)); ?> <?php else: ?> <?php echo e($currency->symbol.number_format($val->plan['amount'])); ?> <?php endif; ?></td>
                <td><?php echo e($val->user['first_name'].' '.$val->user['last_name']); ?></td>
                <td>#<?php echo e($val->ref_id); ?></td>
                <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->expiring_date))); ?></td>
                <td><?php if($val->times>0 && $val->status==1): ?> Yes <?php else: ?> No <?php endif; ?></td>
                <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/boompay/core/resources/views/user/plans/subscribers.blade.php ENDPATH**/ ?>