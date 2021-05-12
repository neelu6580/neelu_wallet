<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <div class="">
          <div class="card-body">
            <div class="">
              <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> <?php echo e(__('Send money')); ?></a>
              <a data-toggle="modal" data-target="#fund" href=""  class="btn btn-sm btn-success"><?php echo e(__('Load Fund to Your Account')); ?></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    <div class="row">
      <div class="col-md-12">   
        <div class="modal fade" id="fund" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
              <div class="modal-body p-0">
                <div class="accordion" id="accordionExample">
                  <div class="card bg-white border-0 mb-0">
                    <div class="card-header" id="headingOne">
                      <div class="text-left" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <h4 class="mb-0">Card</h4>
                      </div>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                      <div class="card-body">
                        <form action="<?php echo e(route('card')); ?>" role="form" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="<?php echo e($stripe->val1); ?>" id="payment-form">
                          <?php echo csrf_field(); ?>
                          <div class="form-group row">
                            <div class="col-xs-12 col-md-12 form-group required">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                </div>
                                <input type="number" step="any" class="form-control" name="amount" id="cardamount" onkeyup="cardcharge()" placeholder="0.00" min="<?php echo e($stripe->minamo); ?>" required > 
                                <input type="hidden" value="<?php echo e($stripe->charge); ?>" id="charge"> 
                                <div class="input-group-append">
                                  <span class="input-group-text">.00</span>
                                </div>
                              </div>
                            </div>
                            <div class="col form-group required">
                              <input type="text" class="form-control input-lg custom-input card-number" name="cardNumber" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="Valid Card Number" maxlength="16" autocomplete="off" required autofocus size="20"/>
                            </div>
                          </div> 
                          <div class='form-group row'>
                            <div class='col form-group cvc'>
                              <input autocomplete='off' class='form-control card-cvc' name="cardCVC" placeholder='CVC' type='text' maxlength="3" required onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                            </div>
                            <div class='col form-group expiration required'>
                              <input class='form-control card-expiry-month' name="cardM" placeholder='MM' maxlength='2' type='text' onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                            </div>
                            <div class='col form-group expiration required'>
                              <input class='form-control card-expiry-year' name="cardY" placeholder='YYYY' maxlength='4'type='text' onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                            </div>
                          </div>			  	                
                          <div class="text-center">
                            <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Pay')); ?> <span id="cardresult"></span></button><br>
                            <img src="<?php echo e(url('/')); ?>/asset/payment_gateways/creditcard.png" style="height:auto;  max-width:40%;">
                          </div>
                          
                        </form>
                      </div>
                    </div>
                    <?php if($adminbank->status==1): ?>
                      <hr>
                      <div class="card-header" id="headingTwo">
                          <div class="text-left collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <h4 class="mb-0">Transfer</h4>
                          </div>
                      </div>
                      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body text-center">
                          <h4 class="mb-0"><?php echo e($adminbank->bank_name); ?></h4>
                          <h1 class="mb-1 text-muted"><?php echo e($adminbank->acct_no); ?></h1>
                          <form method="post" action="<?php echo e(route('bank_transfersubmit')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="form-group row">
                              <div class="col-lg-6 offset-lg-3">
                                <div class="input-group">
                                  <span class="input-group-prepend">
                                    <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                  </span>
                                  <input type="number" step="any" name="amount" max-length="10" class="form-control" required>
                                </div>
                              </div>
                            </div>
                            <div class="text-center">
                              <button type="submit" class="btn btn-neutral btn-sm">I'hv sent the money</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    <?php endif; ?>
                    <hr>
                    <div class="card-header" id="headingThree">
                        <div class="text-left collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          <h4 class="mb-0">Crypto Currency</h4>
                        </div>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                      <div class="card-body">
                        <form method="post" action="<?php echo e(route('crypto')); ?>">
                          <?php echo csrf_field(); ?>
                          <div class="form-group row">
                            <div class="col-lg-8 offset-lg-2">
                              <div class="input-group">
                                <span class="input-group-prepend">
                                  <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                </span>
                                <input type="number" step="any" name="amount" max-length="10" class="form-control" required>
                              </div>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-lg-8 offset-lg-2">
                              <select class="form-control select" name="crypto" data-dropdown-css-class="bg-primary" data-fouc required>
                                  <option value='505'>Bitcoin</option>
                                  <option value='506'>Ethereum</option>
                              </select>
                            </div>
                          </div>          
                          <div class="text-center">
                            <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Pay')); ?></button>
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
                    <h3 class="mb-0"><?php echo e(__('Transfer money')); ?></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <span class="form-text text-xs">Transfer charge is <?php echo e($set->transfer_charge); ?>% per transaction, If user is not a member of <?php echo e($set->site_name); ?>, registration will be required to claim money. Money will be refunded within 5 days if user does not claim money.</span>
                  </div>
                  <div class="card-body">
                    <form action="<?php echo e(route('submit.ownbank')); ?>" method="post" id="modal-details">
                      <?php echo csrf_field(); ?>
                        <div class="form-group row">
                          <label class="col-form-label col-lg-2"><?php echo e(__('Email')); ?></label>
                          <div class="col-lg-10">
                              <input type="email" name="email" class="form-control" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-form-label col-lg-2"><?php echo e(__('Amount')); ?></label>
                          <div class="col-lg-10">
                            <div class="input-group">
                              <span class="input-group-prepend">
                                <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                              </span>
                              <input type="number" class="form-control" name="amount" id="amounttransfer" min="<?php echo e($set->min_transfer); ?>"  onkeyup="transfercharge()" required>
                              <input type="hidden" value="<?php echo e($set->transfer_charge); ?>" id="chargetransfer">
                              <span class="input-group-append">
                                <span class="input-group-text">.00</span>
                              </span>
                            </div>
                          </div>
                        </div>                   
                        <div class="text-right">
                        <button type="submit" class="btn btn-success btn-sm" form="modal-details"><?php echo e(__('Pay')); ?> <span id="resulttransfer"></span></button>
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
          <?php if(count($transfer)>0): ?>  
            <?php $__currentLoopData = $transfer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-md-6">
                <div class="card bg-white">
                  <!-- Card body -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col-8">
                        <!-- Title -->
                        <h5 class="h4 mb-0 text-dark">#<?php echo e($val->ref_id); ?></h5>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col">
                          <p class="text-sm text-dark mb-0"><?php echo e(__('Amount')); ?>: <?php echo e($currency->symbol.number_format($val->amount)); ?></p>
                          <?php if($val->receiver['email']!=null): ?>
                          <p class="text-sm text-dark mb-0"><?php echo e(__('Email')); ?>: <?php echo e($val->receiver['email']); ?></p>
                          <?php else: ?>
                          <p class="text-sm text-dark mb-0"><?php echo e(__('Email')); ?>: <?php echo e($val->temp); ?></p>
                          <?php endif; ?>
                          <p class="text-sm text-dark mb-2"><?php echo e(__('Date')); ?>: <?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></p>
                          <span class="badge badge-pill badge-primary">
                          <?php if($val->status==2): ?> <s><?php echo e(__('Fee')); ?>: <?php echo e($currency->symbol.number_format($val->charge)); ?></s>
                          <?php else: ?> <?php echo e(__('Charge')); ?>: <?php echo e($currency->symbol.number_format($val->charge)); ?> <?php endif; ?></span>
                          <?php if($val->status==1): ?>
                            <span class="badge badge-pill badge-success"><i class="fa fa-check"></i> <?php echo e(__('Confirmed')); ?></span>
                          <?php elseif($val->status==0): ?>
                            <span class="badge badge-pill badge-danger"><i class="fa fa-spinner"></i> <?php echo e(__('Pending')); ?></span>                        
                          <?php elseif($val->status==2): ?>
                            <span class="badge badge-pill badge-info"><i class="fa fa-check"></i> <?php echo e(__('Returned')); ?></span>
                          <?php endif; ?>
                        </div>
                      </div>
                  </div>
                </div>
              </div> 
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php else: ?>
          <div class="col-md-12">
            <p class="text-center text-muted card-text mt-8">No Transfer Log Found</p>
          </div>
          <?php endif; ?>
        </div> 
        <div class="row">
          <div class="col-md-12">
          <?php echo e($transfer->links()); ?>

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
                <span class="text-sm text-dark mb-0"><i class="fa fa-google-wallet"></i> <?php echo e(__('Sent')); ?></span><br>
                <span class="text-xl text-dark mb-0"><?php echo e($currency->name); ?> <?php echo e(number_format($sent)); ?>.00</span><br>
                <hr>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle"><?php echo e(__('Pending')); ?></span><br>
                  <span class="surtitle"><?php echo e(__('Returned')); ?></span><br>
                  <span class="surtitle "><?php echo e(__('Total')); ?></span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle "><?php echo e($currency->name); ?> <?php echo e(number_format($pending)); ?>.00</span><br>
                  <span class="surtitle "><?php echo e($currency->name); ?> <?php echo e(number_format($rebursed)); ?>.00</span><br>
                  <span class="surtitle "><?php echo e($currency->name); ?> <?php echo e(number_format($total)); ?>.00</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php $__currentLoopData = $received; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="card">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col-8">
                  <h5 class="h4 mb-0 text-dark">#<?php echo e($val->ref_id); ?></h5>
                </div>
                <div class="col-4 text-right">
                  <?php if($val->status==0): ?>
                  <a href="<?php echo e(url('/')); ?>/user/received/<?php echo e($val->id); ?>" class="btn btn-sm btn-success" title="Mark as received"><i class="fa fa-check"></i> <?php echo e(__('Confirm')); ?></a>
                  <?php endif; ?>
                </div>
              </div>
              <div class="row align-items-center">
                <div class="col">
                  <p class="text-sm text-dark mb-0"><?php echo e(__('Email')); ?>: <?php echo e($val->sender['email']); ?></p>
                  <p class="text-sm text-dark mb-0"><?php echo e(__('Total')); ?>: <?php echo e($currency->symbol.number_format($val->amount)); ?></p>
                  <p class="text-sm text-dark mb-0"><?php echo e(__('Date')); ?>: <?php echo e(date("h:i:A j, M Y", strtotime($val->created_at))); ?></p>
                  <?php if($val->status==1): ?>
                    <span class="badge badge-pill badge-success"><i class="fa fa-check"></i> <?php echo e(__('Received')); ?></span>
                  <?php elseif($val->status==0): ?>
                    <span class="badge badge-pill badge-danger"><i class="fa fa-spinner"></i> <?php echo e(__('Pending')); ?></span>                       
                  <?php elseif($val->status==2): ?>
                    <span class="badge badge-pill badge-info"><i class="fa fa-spinner"></i> <?php echo e(__('Returned')); ?></span>                    
                  <?php endif; ?>

                </div>
              </div>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/greenvx4/public_html/vcard/core/resources/views/user/transfer/index.blade.php ENDPATH**/ ?>