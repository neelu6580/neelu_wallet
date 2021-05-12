<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h3 class="mb-0"> <?php echo e($details->title); ?></h3>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('page.update')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2"><?php echo e($details->title); ?>:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="title" class="form-control" value="<?php echo e($details->title); ?>">
                                    <input type="hidden" name="id" value="<?php echo e($details->id); ?>">
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2"><?php echo e(__('Details')); ?>:</label>
                                <div class="col-lg-10">
                                    <textarea type="text" name="content" class="form-control tinymce"><?php echo e($details->content); ?></textarea>
                                </div>
                            </div>               
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Save')); ?></button>
                        </div>
                    </form>
            </div>
        </div> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/admin/web-control/pagesedit.blade.php ENDPATH**/ ?>