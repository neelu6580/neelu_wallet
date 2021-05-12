<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <div class="card bg-white">
          <div class="card-body">
            <div class="">
              <h3 class="">To CuminPay Account</h3>
              <p class="mt-0 mb-5">To CuminPay Account charges: <?php echo e($set->transfer_charge); ?>% per transaction.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
          <div class="card-header header-elements-inline">
            <h3 class="mb-0">Transfer Funds</h3>
                <div class="header-elements">
                  <div class="list-icons">
                </div>
              </div>
          </div>
          <div class="card-body">
            <form action="<?php echo e(route('submit.ownbank')); ?>" method="post" id="modal-details">
            <?php echo csrf_field(); ?>
                <div class="form-group row">
                  <label class="col-form-label col-lg-2">Account number</label>
                  <div class="col-lg-10">
                    <div class="input-group">
                      <span class="input-group-prepend">
                        <span class="input-group-text">#</span>
                      </span>
                      <input type="number" name="acct_no" maxlength="12" class="form-control" required>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-lg-2">Amount</label>
                  <div class="col-lg-10">
                    <div class="input-group">
                      <span class="input-group-prepend">
                        <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                      </span>
                      <input type="number" class="form-control" name="amount" id="amount" required>
                      <span class="input-group-append">
                        <span class="input-group-text">.00</span>
                      </span>
                    </div>
                  </div>
                </div>                   
                <div class="text-right">
                  <a href="#" data-toggle="modal" data-target="#modal-form" class="btn btn-primary">Send<i class="icon-paperplane ml-2"></i></a>
                </div>         
                <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                  <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                      <div class="modal-body p-0">
                        <div class="card bg-white border-0 mb-0">
                          <div class="card-header bg-transparent pb-2ß">
                            <div class="text-dark text-center mt-2 mb-3">Enter account pin to complete transfer</div>
                            <div class="text-center text-dark"><i class="ni ni-key-25 icon-2x"></i></div> 
                          </div>
                          <div class="card-body px-lg-5 py-lg-5">
                            <div class="form-group">
                              <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="ni ni-lock-circle-open text-dark"></i></span>
                                </div>
                                <input class="form-control" placeholder="Pin" type="password" name="pin">
                              </div>
                            </div>
                          <div class="text-right">
                            <button type="submit" class="btn btn-primary" form="modal-details">Submit</button>
                          </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> 
            </form>
          </div>
        </div>
        <!-- /basic layout -->
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/user/transfermoney/own_bank.blade.php ENDPATH**/ ?>