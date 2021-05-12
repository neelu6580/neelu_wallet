<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
  <div class="card">
          <div class="card-header">
            <!-- Title -->
            <h5 class="h3 mb-0">Attachements</h5>
          </div>
          <div class="card-body">
            <div class="timeline timeline-one-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
              <?php $__currentLoopData = json_decode($ticket->files); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="timeline-block">
                  <span class="timeline-step badge-success">
                    <i class="fa fa-file"></i>
                  </span>
                  <div class="timeline-content">
                    <div class="d-flex justify-content-between pt-1">
                      <div>
                        <a href="<?php echo e(url('/')); ?>/asset/profile/<?php echo e($val); ?>"><span class="text-muted text-sm"><?php echo e($val); ?></span></a>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
        </div>
    <div class="card shadow">
          <div class="card-header bg-transparent">
            <h3 class="mb-0"><?php echo e(__('Log')); ?></h3>
          </div>
          <div class="card-body">
            <div class="timeline timeline-one-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
              <div class="timeline-block">
                  <span class="timeline-step badge-primary">
                      <i class="fa fa-star"></i>
                  </span>
                  <div class="timeline-content">
                      <small class="text-xs"><?php echo e(date("Y/m/d h:i:A", strtotime($ticket->created_at))); ?></small>
                      <h5 class="mt-3 mb-0"><?php echo e($ticket->message); ?></h5>
                      <p class="text-sm mt-1 mb-0"><?php echo e($ticket->user['first_name'].' '.$ticket->user['last_name']); ?></p>
                  </div>
              </div>
            <?php $__currentLoopData = $reply; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $df): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($df->status==1): ?>
                <div class="timeline-block">
                  <span class="timeline-step badge-primary">
                    <i class="fa fa-star"></i>
                  </span>
                  <div class="timeline-content">
                    <small class="text-xs"><?php echo e(date("Y/m/d h:i:A", strtotime($df->created_at))); ?></small>
                    <h5 class="mt-3 mb-0"><?php echo e($df->reply); ?></h5>
                    <p class="text-sm mt-1 mb-0"><?php echo e($ticket->user['first_name'].' '.$ticket->user['last_name']); ?></p>
                  </div>
                </div>
                <?php elseif($df->status==0): ?>
                  <div class="timeline-block">
                      <span class="timeline-step badge-primary">
                      <i class="fa fa-star"></i>
                      </span>
                      <div class="timeline-content">
                      <small class="text-xs"><?php echo e(date("Y/m/d h:i:A", strtotime($df->created_at))); ?></small>
                      <h5 class="mt-3 mb-0"><?php echo e($df->reply); ?></h5>
                      <p class="text-sm mt-1 mb-0"><?php if($df->staff_id==1): ?> <?php echo e(__('Administrator')); ?> <?php else: ?> <?php echo e($df->staff['first_name'].' '.$df->staff['last_name']); ?> - <span class="badge badge-pill badge-success">Staff</span> <?php endif; ?></p>
                      </div>
                  </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
        </div>
		<div class="card">
          	<div class="card-header header-elements-inline">
            	<h3 class="mb-0"><?php echo e(__('Reply')); ?></h3>
          	</div>
          	<div class="card-body">
				<form method="post" action="<?php echo e(route('ticket.reply')); ?>">
					<?php echo csrf_field(); ?>
					<textarea class="form-control mb-3" rows="4" placeholder="Enter your message..."  name="reply" required></textarea>
					<input type="hidden"  name="ticket_id" value="<?php echo e($ticket->ticket_id); ?>">			
					<input type="hidden"  name="staff_id" value="<?php echo e($admin->id); ?>">			
					<div class="d-flex align-items-center">
						<button type="submit" class="btn btn-success btn-sm">Send</button>
					</div>	
				</form>
		  	</div>
        </div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/admin/user/edit-ticket.blade.php ENDPATH**/ ?>