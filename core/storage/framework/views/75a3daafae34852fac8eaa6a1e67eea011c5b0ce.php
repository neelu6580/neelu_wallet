<?php $__env->startSection('content'); ?>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <div class="">
          <div class="card-body">
            <div class="">
              <a href="<?php echo e(route('user.add-invoice')); ?>" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> <?php echo e(__('Create invoice')); ?></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">  
      <div class="col-md-8">
        <div class="row"> 
          <?php if(count($invoice)>0): ?> 
            <?php $__currentLoopData = $invoice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-md-6">
                <div class="card">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col mb-3">
                        <?php if($val->status==0): ?>
                        <a data-toggle="modal" data-target="#modal-formx<?php echo e($val->id); ?>" class="btn btn-sm btn-primary" href="javascript:void;" title="Edit Amount"><i class="fa fa-pencil"></i> <?php echo e(__('Edit')); ?></a>
                        <a href="<?php echo e(route('reminder.invoice', ['id' => $val->id])); ?>" class="btn btn-sm btn-neutral" title="Send Reminder"><i class="fa fa-clock-o"></i> <?php echo e(__('Resend')); ?></a>
                        <a href="<?php echo e(route('paid.invoice', ['id' => $val->id])); ?>" class="btn btn-sm btn-success" title="Mark as paid"><i class="fa fa-check"></i> <?php echo e(__('Mark as Paid')); ?></a>
                        <?php endif; ?>
                        <a data-toggle="modal" data-target="#delete<?php echo e($val->id); ?>" href="" class="text-danger" title="Delete link"><i class="fa fa-close"></i></a>
                      </div>
                    </div>
                    <div class="row align-items-center">
                      <div class="col">
                        <p class="text-sm text-dark mb-0"><?php echo e($val->item); ?></p>
                        <p class="text-sm text-dark mb-0"><?php echo e(__('Invoice ID')); ?>: <?php echo e($val->invoice_no); ?></p>
                        <p class="text-sm text-dark mb-0"><?php echo e(__('Ref')); ?>: #<?php echo e($val->ref_id); ?></p>
                        <p class="text-sm text-dark mb-0"><?php echo e(__('Email')); ?>: <?php echo e($val->email); ?></p>
                        <p class="text-sm text-dark mb-0"><?php echo e(__('Total')); ?>: <?php echo e($currency->symbol.number_format($val->total)); ?></p>
                        <p class="text-sm text-dark mb-0"><?php echo e(__('Sent')); ?>: 
                        <?php if($val->sent==1): ?>
                          Yes @
                        <?php elseif($val->sent==0): ?>
                          No                    
                        <?php endif; ?>
                        <?php echo e($val->sent_date); ?></p>
                        <p class="text-sm text-dark mb-0"><?php echo e(__('Due date')); ?>: <?php echo e(date("h:i:A j, M Y", strtotime($val->due_date))); ?></p>
                        <p class="text-sm text-dark mb-0 mb-3"><button type="button" class="btn-icon-clipboard" data-clipboard-text="<?php echo e(route('view.invoice', ['id' => $val->ref_id])); ?>" title="Copy"><?php echo e(__('COPY LINK')); ?></button></p>
                        <?php if($val->status==1): ?>
                          <span class="badge badge-pill badge-primary"><?php echo e(__('Charge')); ?>: <?php echo e($currency->symbol.number_format($val->charge)); ?></span>
                          <span class="badge badge-pill badge-success"><i class="fa fa-check"></i> <?php echo e(__('Paid')); ?></span>
                        <?php elseif($val->status==0): ?>
                          <span class="badge badge-pill badge-danger"><i class="fa fa-spinner"></i> <?php echo e(__('Pending')); ?></span>                    
                        <?php endif; ?>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="modal-formx<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-body p-0">
                      <div class="card bg-white border-0 mb-0">
                        <div class="card-header">
                          <h3 class="mb-0"><?php echo e(__('Edit Invoice')); ?></h3>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">
                          <form action="<?php echo e(route('update.invoice')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="form-group row">
                              <label class="col-form-label col-lg-2"><?php echo e(__('Amount')); ?></label>
                              <div class="col-lg-10">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                  </div>
                                  <input type="hidden" name="id" value="<?php echo e($val->id); ?>"> 
                                  <input type="number" step="any" name="amount" value="<?php echo e($val->amount); ?>" class="form-control" required="">
                                </div>
                              </div>
                            </div>                       
                            <div class="form-group row">
                              <label class="col-form-label col-lg-2"><?php echo e(__('Quantity')); ?></label>
                              <div class="col-lg-10">
                                <div class="input-group input-group-merge">
                                  <input type="number" name="quantity" value="<?php echo e($val->quantity); ?>" class="form-control" required="">
                                </div>
                              </div>
                            </div>                        
                            <div class="form-group row">
                              <label class="col-form-label col-lg-2"><?php echo e(__('Tax')); ?></label>
                              <div class="col-lg-10">
                                <div class="input-group input-group-merge">
                                  <input type="number" name="tax" maxlength="10" value="<?php echo e($val->tax); ?>" class="form-control">
                                  <span class="input-group-append">
                                    <span class="input-group-text">%</span>
                                  </span>
                                </div>
                              </div>
                            </div>                      
                            <div class="form-group row">
                              <label class="col-form-label col-lg-2"><?php echo e(__('Discount')); ?></label>
                              <div class="col-lg-10">
                                <div class="input-group input-group-merge">
                                  <input type="number" name="discount" maxlength="10" value="<?php echo e($val->discount); ?>" class="form-control">
                                  <span class="input-group-append">
                                    <span class="input-group-text">%</span>
                                  </span>
                                </div>
                              </div>
                            </div>                           
                            <div class="form-group row">
                              <label class="col-form-label col-lg-2" for="exampleDatepicker"><?php echo e(__('Due Date')); ?></label>
                              <div class="col-lg-10">
                                <div class="input-group">
                                  <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                  </span>
                                  <input type="text" class="form-control datepicker" name="due_date" value="<?php echo e($val->due_date); ?>" required>
                                </div>
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
              <div class="modal fade" id="delete<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                  <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                      <div class="modal-content">
                          <div class="modal-body p-0">
                              <div class="card bg-white border-0 mb-0">
                                  <div class="card-header">
                                      <span class="mb-0 text-sm"><?php echo e(__('Are you sure you want to delete this?, all transaction related to this invoice will also be deleted')); ?></span>
                                  </div>
                                  <div class="card-body px-lg-5 py-lg-5 text-right">
                                      <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                      <a  href="<?php echo e(route('delete.invoice', ['id' => $val->id])); ?>" class="btn btn-danger btn-sm"><?php echo e(__('Proceed')); ?></a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php else: ?>
            <div class="col-md-12">
              <p class="text-center text-muted card-text mt-8">No Invoice found</p>
            </div>
          <?php endif; ?>
        </div>
        <div class="row">
          <div class="col-md-12">
          <?php echo e($invoice->links()); ?>

          </div>
        </div>
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
                  <span class="surtitle "><?php echo e($currency->name); ?> <?php echo e(number_format($pending)); ?>.00</span><br>
                  <span class="surtitle "><?php echo e($currency->name); ?> <?php echo e(number_format($total)); ?>.00</span>
                </div>
              </div>
            </div>
          </div>
        </div> 
        <?php $__currentLoopData = $paid; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="card">
            <!-- Card body -->
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col">
                  <p class="text-sm text-dark mb-0"><?php echo e(__('Email')); ?>: <?php echo e($val->email); ?></p>
                  <p class="text-sm text-dark mb-0"><?php echo e(__('Total')); ?>: <?php echo e($currency->symbol.number_format($val->total)); ?></p>
                  <p class="text-sm text-dark mb-0"><?php echo e(__('Due date')); ?>: <?php echo e(date("h:i:A j, M Y", strtotime($val->due_date))); ?></p>
                  <p class="text-sm text-dark mb-0"><?php echo e(__('Payment link')); ?> <button type="button" class="btn-icon-clipboard" data-clipboard-text="<?php echo e(url('/')); ?>/user/view-invoice/<?php echo e($val->ref_id); ?>" title="Copy"><i class="fa fa-copy"></i></button></p>
                  <?php if($val->status==1): ?>
                    <span class="badge badge-success"><i class="fa fa-check"></i> <?php echo e(__('Paid')); ?></span>
                  <?php elseif($val->status==0): ?>
                    <span class="badge badge-danger"><i class="fa fa-spinner"></i> <?php echo e(__('Pending')); ?></span>                    
                  <?php endif; ?>

                </div>
              </div>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/user/invoice/index.blade.php ENDPATH**/ ?>