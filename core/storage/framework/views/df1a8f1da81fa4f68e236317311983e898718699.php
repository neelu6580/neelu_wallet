<?php $__env->startSection('content'); ?>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <div class="">
          <div class="card-body">
            <div class="">
              <a data-toggle="modal" data-target="#create-plan" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> <?php echo e(__('Plan')); ?></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="modal fade" id="create-plan" tabindex="-1" role="dialog" aria-labelledby="create-plan" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
              <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                  <div class="card-header">
                    <h3 class="mb-0"><?php echo e(__('Create New Plan')); ?></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="card-body">
                    <form action="<?php echo e(route('submit.plan')); ?>" method="post" id="modal-details">
                      <?php echo csrf_field(); ?>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12"><?php echo e(__('Plan Name')); ?><span class="text-danger">*</span></label>
                            <div class="col-lg-12">
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12"><?php echo e(__('Amount')); ?></label>
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                    </span>
                                    <input type="number" class="form-control" name="amount" placeholder="0.00" min="10">
                                    <span class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </span>
                                </div>
                                <span class="form-text text-xs">Leave empty to allow customers enter desired amount</span>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12"><?php echo e(__('Interval')); ?></label>
                            <div class="col-lg-12">
                                <select class="form-control select" name="interval">
                                    <option value="1 Hour"><?php echo e(__('Hourly')); ?></option>
                                    <option value="1 Day"><?php echo e(__('Daily')); ?></option>
                                    <option value="1 Week"><?php echo e(__('Weekly')); ?></option>
                                    <option value="1 Month"><?php echo e(__('Monthly')); ?></option>
                                    <option value="4 Months"><?php echo e(__('Quaterly')); ?></option>
                                    <option value="6 Months"><?php echo e(__('Every 6 Months')); ?></option>
                                    <option value="1 Year"><?php echo e(__('Yearly')); ?></option>
                                </select>
                            </div>
                        </div>           
                        <div class="form-group row">
                          <label class="col-form-label col-lg-12"><?php echo e(__('Number of times to charge a subscriber?')); ?></label>
                          <div class="col-lg-12">
                              <input type="text" name="times" class="form-control">
                              <span class="form-text text-xs">Leave empty to charge subscriber indefinitely</span>
                          </div>
                        </div> 
                        <div class="text-right">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btn-sm" form="modal-details"><?php echo e(__('Create plan')); ?></button>
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
    <div class="card">
      <div class="card-header header-elements-inline">
        <h3 class="mb-0"><?php echo e(__('Plans')); ?></h3>
      </div>
      <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-buttons">
          <thead>
            <tr>
              <th><?php echo e(__('S / N')); ?></th>
              <th><?php echo e(__('Name')); ?></th>
              <th><?php echo e(__('Amount')); ?></th>
              <th><?php echo e(__('Interval')); ?></th>
              <th><?php echo e(__('Expired/Active')); ?></th>
              <th><?php echo e(__('Status')); ?></th>
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
                  <td><?php echo e($val->name); ?></td>
                  <td><?php echo e($currency->symbol.number_format($val->amount)); ?></td>
                  <td><?php echo e($val->intervals); ?> - <?php if($val->times==null): ?> Indefinitely <?php else: ?> <?php echo e($val->times); ?> time(s) <?php endif; ?></td>
                  <td><?php echo e($expired); ?> / <?php echo e($active); ?></td>
                  <td><?php if($val->active==0): ?> <span class="badge badge-pill badge-danger">Disabled</span> <?php elseif($val->active==1): ?> <span class="badge badge-pill badge-success">Active</span><?php endif; ?></td>
                  <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></td>
                  <td><a class="btn-icon-clipboard text-primary" data-clipboard-text="<?php echo e(route('subview.link', ['id' => $val->ref_id])); ?>" title="Copy"><?php echo e(__('Copy Subscription Link')); ?></a></td>
                  <td class="text-right">
                  <div class="dropdown">
                          <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                              <a href="<?php echo e(route('user.plansub', ['id' => $val->ref_id])); ?>" class="dropdown-item"><?php echo e(__('Subscribers')); ?></a>
                              <a data-toggle="modal" data-target="#edit<?php echo e($val->id); ?>" href="" class="dropdown-item"><?php echo e(__('Edit')); ?></a>
                              <?php if($val->active==1): ?>
                                <a class='dropdown-item' href="<?php echo e(route('plan.unpublish', ['id' => $val->id])); ?>"><?php echo e(__('Disable')); ?></a>
                              <?php else: ?>
                                <a class='dropdown-item' href="<?php echo e(route('plan.publish', ['id' => $val->id])); ?>"><?php echo e(__('Activate')); ?></a>
                              <?php endif; ?>
                          </div>
                      </div>
                  </td> 
              </tr>
              <div class="modal fade" id="edit<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                  <div class="modal-content">
                    <div class="modal-body p-0">
                      <div class="card bg-white border-0 mb-0">
                        <div class="card-header">
                          <h3 class="mb-0"><?php echo e(__('Edit Plan')); ?></h3>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="card-body">
                          <form action="<?php echo e(route('update.plan')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-12"><?php echo e(__('Plan Name')); ?><span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <input type="text" name="name" class="form-control" value="<?php echo e($val->name); ?>" required>
                                    <span class="form-text text-xs">Amount & Interval can only be edited if no active subscriber</span>
                                </div>
                            </div>
                            <?php if($active<1): ?>
                            <div class="form-group row">
                              <label class="col-form-label col-lg-12"><?php echo e(__('Amount')); ?></label>
                              <div class="col-lg-12">
                                  <div class="input-group">
                                      <span class="input-group-prepend">
                                          <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                      </span>
                                      <input type="number" class="form-control" name="amount" placeholder="0.00" min="10" value="<?php echo e($val->amount); ?>">
                                      <span class="input-group-append">
                                          <span class="input-group-text">.00</span>
                                      </span>
                                  </div>
                                  <span class="form-text text-xs">Leave empty to allow customers enter desired amount</span>
                              </div>
                            </div>  
                            <div class="form-group row">
                              <label class="col-form-label col-lg-12"><?php echo e(__('Interval')); ?></label>
                              <div class="col-lg-12">
                                  <select class="form-control select" name="interval">
                                      <option value="1 Hour" <?php if($val->intervals=='1 Hour'): ?> selected <?php endif; ?>><?php echo e(__('Hourly')); ?></option>
                                      <option value="1 Day" <?php if($val->intervals=='1 Day'): ?> selected <?php endif; ?>><?php echo e(__('Daily')); ?></option>
                                      <option value="1 Week" <?php if($val->intervals=='1 Week'): ?> selected <?php endif; ?>><?php echo e(__('Weekly')); ?></option>
                                      <option value="1 Month" <?php if($val->intervals=='1 Month'): ?> selected <?php endif; ?>><?php echo e(__('Monthly')); ?></option>
                                      <option value="4 Months" <?php if($val->intervals=='4 Months'): ?> selected <?php endif; ?>><?php echo e(__('Quaterly')); ?></option>
                                      <option value="6 Months" <?php if($val->intervals=='6 Months'): ?> selected <?php endif; ?>><?php echo e(__('Every 6 Months')); ?></option>
                                      <option value="1 Year" <?php if($val->intervals=='1 Year'): ?> selected <?php endif; ?>><?php echo e(__('Yearly')); ?></option>
                                  </select>
                              </div>
                            </div> 
                            <?php endif; ?>
                            <input name="plan_id" type="hidden" value="<?php echo e($val->id); ?>">               
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
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/boompay/core/resources/views/user/plans/index.blade.php ENDPATH**/ ?>