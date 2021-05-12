<?php $__env->startSection('content'); ?>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="card">
      <div class="card-header header-elements-inline">
        <h3 class="mb-0"><?php echo e(__('Plans')); ?></h3>
      </div>
      <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-buttons">
          <thead>
            <tr>
              <th><?php echo e(__('S / N')); ?></th>
              <th><?php echo e(__('Author')); ?></th>
              <th><?php echo e(__('Name')); ?></th>
              <th><?php echo e(__('Amount')); ?></th>
              <th><?php echo e(__('Interval')); ?></th>
              <th><?php echo e(__('Expired/Active')); ?></th>
              <th><?php echo e(__('Status')); ?></th>
              <th><?php echo e(__('Suspended')); ?></th>
              <th><?php echo e(__('Created')); ?></th>
              <th class="scope"></th>  
              <th class="scope"></th>  
            </tr>
          </thead>
          <tbody>  
            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php 
                $active=App\Models\Subscribers::whereplan_id($val->id)->where('expiring_date', '>', Carbon\Carbon::now())->count();
                $expired=App\Models\Subscribers::whereplan_id($val->id)->where('expiring_date', '<', Carbon\Carbon::now())->count();
              ?>
              <tr>
                  <td><?php echo e(++$k); ?>.</td>
                  <td><?php echo e($val->user['business_name']); ?></td>
                  <td><?php echo e($val->name); ?></td>
                  <td><?php echo e($currency->symbol.number_format($val->amount)); ?></td>
                  <td><?php echo e($val->intervals); ?> - <?php if($val->times==null): ?> Indefinitely <?php else: ?> <?php echo e($val->times); ?> time(s) <?php endif; ?></td>
                  <td><?php echo e($expired); ?> / <?php echo e($active); ?></td>
                  <td><?php if($val->active==0): ?> <span class="badge badge-pill badge-danger">Disabled</span> <?php elseif($val->active==1): ?> <span class="badge badge-pill badge-success">Active</span><?php endif; ?></td>
                  <td>
                    <?php if($val->status==1): ?>
                        <span class="badge badge-pill badge-success"><?php echo e(__('Yes')); ?></span>
                    <?php else: ?>
                        <span class="badge badge-pill badge-danger"><?php echo e(__('No')); ?></span>
                    <?php endif; ?>
                    </td>
                  <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></td>
                  <td><?php echo e(route('subview.link', ['id' => $val->ref_id])); ?></td>
                  <td class="text-right">
                  <div class="dropdown">
                          <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                              <a href="<?php echo e(route('admin.plansub', ['id' => $val->ref_id])); ?>" class="dropdown-item"><?php echo e(__('Subscribers')); ?></a>
                              <?php if($val->status==0): ?>
                                <a class='dropdown-item' href="<?php echo e(route('plan.unpublish', ['id' => $val->id])); ?>"><?php echo e(__('Disable')); ?></a>
                              <?php else: ?>
                                <a class='dropdown-item' href="<?php echo e(route('plan.publish', ['id' => $val->id])); ?>"><?php echo e(__('Activate')); ?></a>
                              <?php endif; ?>
                          </div>
                      </div>
                  </td> 
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/boompay/core/resources/views/admin/transfer/plans.blade.php ENDPATH**/ ?>