<div class="col-lg-4 lg-m-30px-tb">
    <div class="card m-35px-t">
        <div class="card-header bg-transparent">
            <span class="h6 m-0px">Categories</span>
        </div>
        <div class="list-group list-group-flush">
            <?php $__currentLoopData = $cat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
                <?php
                    $cslug=str_slug($vcat->categories);
                    $rate=count(DB::select('select * from trending where cat_id=? and status=?', [$vcat->id,1]));
                ?> 
            <a href="<?php echo e(url('/')); ?>/cat/<?php echo e($vcat->id); ?>/<?php echo e($cslug); ?>" class="list-group-item list-group-item-action d-flex justify-content-between p15px-tb">
                <div>
                    <span><?php echo e($vcat->categories); ?></span>
                </div>
                <div>
                    <i class="ti-angle-right"></i>
                </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <div class="card m-35px-t">
        <div class="card-header bg-transparent">
            <span class="h6 m-0px">Recent Posts</span>
        </div>
        <div class="list-group list-group-flush">
        <?php $__currentLoopData = $trending; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vtrending): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $vslug=str_slug($vtrending->title); ?>
            <a href="<?php echo e(url('/')); ?>/single/<?php echo e($vtrending->id); ?>/<?php echo e($vslug); ?>" class="list-group-item list-group-item-action d-flex p15px-tb">
                <div>
                    <div class="avatar-50 border-radius-5">
                        <img src="<?php echo e(url('/')); ?>/asset/thumbnails/<?php echo e($vtrending->image); ?>" title="" alt="">
                    </div>
                </div>
                <div class="p-15px-l">
                    <p class="m-0px"><?php echo e($vtrending->title); ?></p>
                </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div><?php /**PATH /home/cuminup/public_html/core/resources/views/partials/sidebar.blade.php ENDPATH**/ ?>