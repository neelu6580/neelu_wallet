<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <div class="">
          <div class="card-body">
            <div class="">
              <a href="<?php echo e(route('open.ticket')); ?>" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> <?php echo e(__('Open Ticket')); ?></a>
            </div>
          </div>
        </div>
      </div>
    </div> 
    <div class="row">
      <?php if(count($ticket)>0): ?>
        <?php $__currentLoopData = $ticket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-md-6">
            <div class="card">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-7">
                      <!-- Title -->
                      <h5 class="h4 mb-0">#<?php echo e($val->ticket_id); ?></h5>
                    </div>
                    <div class="col-5 text-right">
                      <a href="<?php echo e(url('/')); ?>/user/reply-ticket/<?php echo e($val->id); ?>" class="btn btn-sm btn-neutral"><?php echo e(__('Reply')); ?></a>
                      <a data-toggle="modal" data-target="#delete<?php echo e($val->id); ?>" href="" class="btn btn-sm btn-danger"><?php echo e(__('Delete')); ?></a>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <p class="text-sm text-dark mb-0"><?php echo e(__('Subject')); ?>: <?php echo e($val->subject); ?></p>
                      <p class="text-sm text-dark mb-0"><?php echo e(__('Transaction Reference')); ?>: <?php if($val->ref_no==null): ?><?php echo e(__('Null')); ?> <?php else: ?> <?php echo e($val->ref_no); ?> <?php endif; ?></p>
                      <p class="text-sm text-dark mb-0"><?php echo e(__('Priority')); ?>: <?php echo e($val->priority); ?></p>
                      <p class="text-sm text-dark mb-0"><?php echo e(__('Status')); ?>: <?php if($val->status==0): ?><?php echo e(__('Open')); ?> <?php elseif($val->status==1): ?><?php echo e(__('Closed')); ?> <?php elseif($val->status==2): ?><?php echo e(__('Resolved')); ?> <?php endif; ?></p>
                      <p class="text-sm text-dark mb-0"><?php echo e(__('Created')); ?>: <?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></p>
                      <p class="text-sm text-dark mb-2"><?php echo e(__('Updated')); ?>: <?php echo e(date("Y/m/d h:i:A", strtotime($val->updated_at))); ?></p>
                      <span class="badge badge-pill badge-success"><?php echo e($val->type); ?></span>
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
                                  <span class="mb-0 text-sm"><?php echo e(__('Are you sure you want to delete this?, all transaction related to this will also be deleted')); ?></span>
                              </div>
                              <div class="card-body px-lg-5 py-lg-5 text-right">
                                  <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                  <a  href="<?php echo e(route('ticket.delete', ['id' => $val->id])); ?>" class="btn btn-danger btn-sm"><?php echo e(__('Proceed')); ?></a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php else: ?>
      <div class="col-md-12">
        <p class="text-center text-muted card-text mt-8">No Support Ticket Found</p>
      </div>
      <?php endif; ?>
    </div>
    <div class="row">
      <div class="col-md-12">
      <?php echo e($ticket->links()); ?>

      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/user/support/index.blade.php ENDPATH**/ ?>