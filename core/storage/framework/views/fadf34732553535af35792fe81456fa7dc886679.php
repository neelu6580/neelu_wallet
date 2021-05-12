  <?php $__env->startSection('content'); ?>
    <div class="container-fluid mt--6">
      <div class="content-wrapper">
      <?php if($admin->id==1): ?>
        <div class="row">
          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                  <div>
                    <h3 class="mb-0"><?php echo e(__('Total received')); ?></h3>
                    <ul class="list list-unstyled mb-0">
                      <li><span class="text-default text-sm"><?php echo e($currency->symbol.number_format($received)); ?></span></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                  <div>
                    <h3 class="mb-0"><?php echo e(__('Virtual Card')); ?></h3>
                    <ul class="list list-unstyled mb-0">
                      <li><span class="text-default text-sm"><?php echo e(__('Active card/Inactive/Total card')); ?>: <?php echo e(count($Allactive)); ?>/<?php echo e(count($Allinactive)); ?>/<?php echo e(count($Allactive)+count($Allinactive)); ?></span></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                  <div>
                    <h3 class="mb-0"><?php echo e(__('Users')); ?></h3>
                    <ul class="list list-unstyled mb-0">
                      <li><span class="text-default text-sm"><?php echo e(__('Active/Blocked users')); ?>: <?php echo e($activeusers); ?>/<?php echo e($blockedusers); ?></span></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>                      
            <div class="card">
              <div class="card-body">
                <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                  <div>
                    <h3 class="mb-0"><?php echo e(__('Single Charge')); ?></h3>
                    <ul class="list list-unstyled mb-0">
                      <li><span class="text-default text-sm"><?php echo e(__('Amount/Charges')); ?>: <?php echo e($currency->symbol.number_format($sin)); ?>/<?php echo e($currency->symbol.number_format($sinc)); ?></span></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>            
            <div class="card">
              <div class="card-body">
                <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                  <div>
                    <h3 class="mb-0"><?php echo e(__('Donations')); ?></h3>
                    <ul class="list list-unstyled mb-0">
                      <li><span class="text-default text-sm"><?php echo e(__('Amount/Charges')); ?>: <?php echo e($currency->symbol.number_format($do)); ?>/<?php echo e($currency->symbol.number_format($doc)); ?></span></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>          
          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                  <div>
                    <h3 class="mb-0"><?php echo e(__('Merchant')); ?></h3>
                    <ul class="list list-unstyled mb-0">
                      <li><span class="text-default text-sm"><?php echo e(__('Amount/Charges:')); ?> <?php echo e($currency->symbol.number_format($mer)); ?>/<?php echo e($currency->symbol.number_format($merc)); ?></span></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>            
            <div class="card">
              <div class="card-body">
                <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                  <div>
                    <h3 class="mb-0"><?php echo e(__('Invoice')); ?></h3>
                    <ul class="list list-unstyled mb-0">
                      <li><span class="text-default text-sm"><?php echo e(__('Amount/Charges:')); ?> <?php echo e($currency->symbol.number_format($in)); ?>/<?php echo e($currency->symbol.number_format($inc)); ?></span></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>            
            <div class="card">
              <div class="card-body">
                <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                  <div>
                    <h3 class="mb-0"><?php echo e(__('Request Money')); ?></h3>
                    <ul class="list list-unstyled mb-0">
                      <li><span class="text-default text-sm"><?php echo e(__('Amount/Charges:')); ?> <?php echo e($currency->symbol.number_format($req)); ?>/<?php echo e($currency->symbol.number_format($reqc)); ?></span></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>   
            <div class="card">
              <div class="card-body">
                <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                  <div>
                    <h3 class="mb-0"><?php echo e(__('Settlement')); ?></h3>
                    <ul class="list list-unstyled mb-0">
                      <li><span class="text-default text-sm"><?php echo e(__('Amount/Charges')); ?>: <?php echo e($currency->symbol.number_format($wd)); ?>/<?php echo e($currency->symbol.number_format($wdc)); ?></span></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>                      
          </div>  
          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                  <div>
                    <h3 class="mb-0"><?php echo e(__('Funding account')); ?></h3>
                    <ul class="list list-unstyled mb-0">
                      <li><span class="text-default text-sm"><?php echo e(__('Amount/Charges:')); ?> <?php echo e($currency->symbol.number_format($de)); ?>/<?php echo e($currency->symbol.number_format($dec)); ?></span></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                  <div>
                    <h3 class="mb-0"><?php echo e(__('Product Order')); ?></h3>
                    <ul class="list list-unstyled mb-0">
                      <li><span class="text-default text-sm"><?php echo e(__('Amount/Charges:')); ?> <?php echo e($currency->symbol.number_format($or)); ?>/<?php echo e($currency->symbol.number_format($orc)); ?></span></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                  <div>
                    <h3 class="mb-0"><?php echo e(__('Transfers')); ?></h3>
                    <ul class="list list-unstyled mb-0">
                      <li><span class="text-default text-sm"><?php echo e(__('Amount/Charges:')); ?> <?php echo e($currency->symbol.number_format($tran)); ?>/<?php echo e($currency->symbol.number_format($tranc)); ?></span></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div> 
          </div>        

  <?php endif; ?>
          <?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp1\htdocs\neelu_wallet\core\resources\views/admin/dashboard/index.blade.php ENDPATH**/ ?>