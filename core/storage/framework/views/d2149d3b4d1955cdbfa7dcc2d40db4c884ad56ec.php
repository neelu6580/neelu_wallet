

<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <div class="">
          <div class="card-body">
            <div class="">
              <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> <?php echo e(__('Withdraw request')); ?></a>
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
                    <h3 class="mb-0"><?php echo e(__('Withdraw Request')); ?></h3>
                  </div>
                  <div class="card-body">
                    <form action="<?php echo e(route('withdraw.submit')); ?>" method="post">
                      <?php echo csrf_field(); ?>
                      <div class="form-group row">
                        <label class="col-form-label col-lg-2"><?php echo e(__('Amount')); ?></label>
                        <div class="col-lg-10">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                            </div>
                            <input type="number" name="amount" class="form-control" required="">
                            <span class="form-text text-xs">Withdraw charge is <?php echo e($set->withdraw_charge); ?>%, & mininmum withdraw is <?php echo e($currency->symbol.number_format($set->withdraw_limit)); ?> for startup business. A verified business has no withdrawal limits. Payout takes <?php echo e($set->withdraw_duration); ?> to process.</span>
                          </div>
                        </div>
                      </div> 
                      <div class="form-group row">
                        <label class="col-form-label col-lg-2"><?php echo e(__('Bank')); ?></label>
                        <div class="col-lg-10">
                          <select class="form-control select" name="bank" data-dropdown-css-class="bg-primary" data-fouc required>
                          <?php if(count($bank)>0): ?> 
                            <?php $__currentLoopData = $bank; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value='<?php echo e($val->id); ?>'><?php echo e($val->name); ?> - <?php echo e($val->acct_no); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          <?php endif; ?>
                          </select>
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
        <div class="row">  
        <?php if(count($withdraw)>0): ?> 
          <?php $__currentLoopData = $withdraw; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6">
              <div class="card bg-white">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <!-- Title -->
                      <h5 class="h4 mb-0 text-dark">#<?php echo e($val->reference); ?></h5>
                    </div>
                    <div class="col-4 text-right">
                      <?php if($val->status==0): ?>
                        <a data-toggle="modal" data-target="#modal-forma<?php echo e($val->id); ?>" href="" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i> <?php echo e(__('Edit')); ?></a>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col">
                        <p class="text-sm text-dark mb-0"><?php echo e(__('Amount')); ?>: <?php echo e($currency->symbol.number_format($val->amount)); ?></p>
                        <p class="text-sm text-dark mb-0"><?php echo e(__('Bank')); ?>: <?php echo e($val->wallet['name']); ?> - <?php echo e($val->wallet['acct_no']); ?></p>
                        <p class="text-sm text-dark mb-0"><?php echo e(__('Next Settlement')); ?>: <?php if($val->status==0): ?><?php echo e(date("Y/m/d", strtotime($val->next_settlement))); ?> <?php else: ?> - <?php endif; ?></p>
                        <p class="text-sm text-dark mb-2"><?php echo e(__('Date')); ?>: <?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></p>
                        <?php if($val->status==1): ?>
                          <span class="badge badge-pill badge-primary"><?php echo e(__('Charge')); ?>: <?php echo e($currency->symbol.number_format($val->charge)); ?></span>
                        <?php endif; ?>
                        <?php if($val->status==1): ?>
                          <span class="badge badge-pill badge-success"><i class="fa fa-check"></i> <?php echo e(__('Paid out')); ?></span>
                        <?php elseif($val->status==0): ?>
                          <span class="badge badge-pill badge-danger"><i class="fa fa-spinner"></i>  <?php echo e(__('Pending')); ?></span>                        
                        <?php elseif($val->status==2): ?>
                          <span class="badge badge-pill badge-info"><i class="fa fa-close"></i> <?php echo e(__('Declined')); ?></span>
                        <?php endif; ?>
                      </div>
                    </div>
                </div>
              </div>
            </div> 
            <div class="modal fade" id="modal-forma<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
              <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                  <div class="modal-body p-0">
                    <div class="card bg-white border-0 mb-0">
                    <div class="card-header header-elements-inline">
                      <h3 class="mb-0"><?php echo e(__('Bank Details')); ?></h3>
                    </div>
                      <div class="card-body px-lg-5 py-lg-5">
                        <form action="<?php echo e(url('user/withdraw-update')); ?>" method="post">
                          <?php echo csrf_field(); ?>
                          <div class="form-group row">
                            <label class="col-form-label col-lg-2"><?php echo e(__('Bank')); ?></label>
                            <div class="col-lg-10">
                              <select class="form-control custom-select" name="bank" data-fouc>
                              <?php $__currentLoopData = $bank; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $valx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value='<?php echo e($valx->id); ?>'
                                  <?php if($valx->id==$val->wallet->id): ?>
                                  selected
                                  <?php endif; ?>
                                  ><?php echo e($valx->name); ?> - <?php echo e($valx->acct_no); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                              <input name="withdraw_id" type="hidden" value="<?php echo e($val->id); ?>">
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
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
          <div class="col-md-12">
            <p class="text-center text-muted card-text mt-8">No Withdrawal Request found</p>
          </div>
        <?php endif; ?>
        </div> 
        <div class="row">
          <div class="col-md-12">
          <?php echo e($withdraw->links()); ?>

          </div>
        </div>
      </div> 
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-auto">
                <div class="icon icon-shape text-white rounded-circle bg-dash">
                  <i class="fa fa-calendar text-primary"></i>
                </div>
              </div>
              <div class="col">
                <h3 class="mb-0"><?php echo e(__('Next Settlement')); ?></h3>
                <ul class="list list-unstyled mb-0">
                  <li><span class="text-default text-sm"><?php echo e(date("Y/m/d", strtotime($set->next_settlement))); ?></span></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
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
                  <span class="surtitle "><?php echo e($currency->name); ?> <?php echo e(number_format($pending)); ?>.00</span><br>
                  <span class="surtitle "><?php echo e($currency->name); ?> <?php echo e(number_format($total)); ?>.00</span>
                </div>
              </div>
            </div>

          </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/user/profile/withdraw.blade.php ENDPATH**/ ?>