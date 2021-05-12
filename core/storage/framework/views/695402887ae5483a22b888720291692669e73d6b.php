    <?php $__env->startSection('content'); ?>
    <div class="container-fluid mt--6">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <h3 class="mb-0"><?php echo e(__('Congifure website')); ?></h3>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo e(route('admin.settings.update')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Website name')); ?></label>
                                    <div class="col-lg-10">
                                        <input type="text" name="site_name" maxlength="200" value="<?php echo e($set->site_name); ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Company email')); ?></label>
                                    <div class="col-lg-10">
                                        <input type="email" name="email" value="<?php echo e($set->email); ?>" class="form-control" required>
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Support email')); ?></label>
                                    <div class="col-lg-10">
                                        <input type="email" name="support_email" value="<?php echo e($set->support_email); ?>" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Mobile')); ?></label>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <input type="text" name="mobile" max-length="14" value="<?php echo e($set->mobile); ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Website title')); ?></label>
                                    <div class="col-lg-10">
                                        <input type="text" name="title" max-length="200" value="<?php echo e($set->title); ?>" class="form-control" required>
                                    </div>
                                </div>                         
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Withdraw duration')); ?></label>
                                    <div class="col-lg-10">
                                        <input type="text" name="withdraw_duration" max-length="200" value="<?php echo e($set->withdraw_duration); ?>" class="form-control" required>
                                    </div>
                                </div>         
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Short description')); ?></label>
                                    <div class="col-lg-10">
                                        <textarea type="text" name="site_desc" rows="4" class="form-control" required><?php echo e($set->site_desc); ?></textarea>
                                    </div>
                                </div>                           
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Tawk ID')); ?></label>
                                    <div class="col-lg-10">
                                        <input type="text" name="livechat" class="form-control" value="<?php echo e($set->livechat); ?>">
                                    </div>
                                </div>           
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Save Changes')); ?></button>
                                    </div>
                            </form>
                        </div>
                    </div>                     
                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <h3 class="mb-0"><?php echo e(__('Features')); ?></h3>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo e(route('admin.features.update')); ?>" method="post">
                                <?php echo csrf_field(); ?>   
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <?php if($set->kyc==1): ?>
                                                <input type="checkbox" name="kyc" id="customCheckLogin1" class="custom-control-input" value="1" checked>
                                            <?php else: ?>
                                                <input type="checkbox" name="kyc" id="customCheckLogin1"  class="custom-control-input" value="1">
                                            <?php endif; ?>
                                            <label class="custom-control-label" for="customCheckLogin1">
                                            <span class="text-muted"><?php echo e(__('Kyc')); ?></span>     
                                            </label>
                                        </div>  
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <?php if($set->email_verification==1): ?>
                                                <input type="checkbox" name="email_activation" id="customCheckLogin2" class="custom-control-input" value="1" checked>
                                            <?php else: ?>
                                                <input type="checkbox" name="email_activation"id="customCheckLogin2"  class="custom-control-input" value="1">
                                            <?php endif; ?>
                                            <label class="custom-control-label" for="customCheckLogin2">
                                            <span class="text-muted"><?php echo e(__('Email verification')); ?></span>     
                                            </label>
                                        </div>                       
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <?php if($set->email_notify==1): ?>
                                                <input type="checkbox" name="email_notify" id="customCheckLogin3" class="custom-control-input" value="1" checked>
                                            <?php else: ?>
                                                <input type="checkbox" name="email_notify"id="customCheckLogin3"  class="custom-control-input" value="1">
                                            <?php endif; ?>
                                            <label class="custom-control-label" for="customCheckLogin3">
                                            <span class="text-muted"><?php echo e(__('Email notify')); ?></span>     
                                            </label>
                                        </div>  
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <?php if($set->registration==1): ?>
                                                <input type="checkbox" name="registration" id="customCheckLogin4" class="custom-control-input" value="1" checked>
                                            <?php else: ?>
                                                <input type="checkbox" name="registration"id="customCheckLogin4"  class="custom-control-input" value="1">
                                            <?php endif; ?>
                                            <label class="custom-control-label" for="customCheckLogin4">
                                            <span class="text-muted"><?php echo e(__('Registration')); ?></span>     
                                            </label>
                                        </div>                                    
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <?php if($set->subscription==1): ?>
                                                <input type="checkbox" name="subscription" id="customCheckLogin13" class="custom-control-input" value="1" checked>
                                            <?php else: ?>
                                                <input type="checkbox" name="subscription"id="customCheckLogin13"  class="custom-control-input" value="1">
                                            <?php endif; ?>
                                            <label class="custom-control-label" for="customCheckLogin13">
                                            <span class="text-muted"><?php echo e(__('Subscription')); ?></span>     
                                            </label>
                                        </div>                                                                                                                                                                                           
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <?php if($set->recaptcha==1): ?>
                                                <input type="checkbox" name="recaptcha" id="customCheckLogin6" class="custom-control-input" value="1" checked>
                                            <?php else: ?>
                                                <input type="checkbox" name="recaptcha"id="customCheckLogin6"  class="custom-control-input" value="1">
                                            <?php endif; ?>
                                            <label class="custom-control-label" for="customCheckLogin6">
                                            <span class="text-muted"><?php echo e(__('Recaptcha')); ?></span>     
                                            </label>
                                        </div>
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <?php if($set->merchant==1): ?>
                                                <input type="checkbox" name="merchant" id="customCheckLogin7" class="custom-control-input" value="1" checked>
                                            <?php else: ?>
                                                <input type="checkbox" name="merchant" id="customCheckLogin7"  class="custom-control-input" value="1">
                                            <?php endif; ?>
                                            <label class="custom-control-label" for="customCheckLogin7">
                                            <span class="text-muted"><?php echo e(__('Merchant')); ?></span>     
                                            </label>
                                        </div>                                        
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <?php if($set->transfer==1): ?>
                                                <input type="checkbox" name="transfer" id="customCheckLogin8" class="custom-control-input" value="1" checked>
                                            <?php else: ?>
                                                <input type="checkbox" name="transfer" id="customCheckLogin8"  class="custom-control-input" value="1">
                                            <?php endif; ?>
                                            <label class="custom-control-label" for="customCheckLogin8">
                                            <span class="text-muted"><?php echo e(__('Transfer')); ?></span>     
                                            </label>
                                        </div>                                        
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <?php if($set->request_money==1): ?>
                                                <input type="checkbox" name="request_money" id="customCheckLogin9" class="custom-control-input" value="1" checked>
                                            <?php else: ?>
                                                <input type="checkbox" name="request_money" id="customCheckLogin9"  class="custom-control-input" value="1">
                                            <?php endif; ?>
                                            <label class="custom-control-label" for="customCheckLogin8">
                                            <span class="text-muted"><?php echo e(__('Request Money')); ?></span>     
                                            </label>
                                        </div>
                                    </div>                                    
                                    <div class="col-lg-4">
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <?php if($set->invoice==1): ?>
                                                <input type="checkbox" name="invoice" id="customCheckLogin10" class="custom-control-input" value="1" checked>
                                            <?php else: ?>
                                                <input type="checkbox" name="invoice" id="customCheckLogin10"  class="custom-control-input" value="1">
                                            <?php endif; ?>
                                            <label class="custom-control-label" for="customCheckLogin10">
                                            <span class="text-muted"><?php echo e(__('Invoice')); ?></span>     
                                            </label>
                                        </div>
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <?php if($set->store==1): ?>
                                                <input type="checkbox" name="store" id="customCheckLogin10" class="custom-control-input" value="1" checked>
                                            <?php else: ?>
                                                <input type="checkbox" name="store" id="customCheckLogin10"  class="custom-control-input" value="1">
                                            <?php endif; ?>
                                            <label class="custom-control-label" for="customCheckLogin10">
                                            <span class="text-muted"><?php echo e(__('Store')); ?></span>     
                                            </label>
                                        </div>                                        
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <?php if($set->donation==1): ?>
                                                <input type="checkbox" name="donation" id="customCheckLogin11" class="custom-control-input" value="1" checked>
                                            <?php else: ?>
                                                <input type="checkbox" name="donation" id="customCheckLogin11"  class="custom-control-input" value="1">
                                            <?php endif; ?>
                                            <label class="custom-control-label" for="customCheckLogin11">
                                            <span class="text-muted"><?php echo e(__('Donation')); ?></span>     
                                            </label>
                                        </div>                                        
                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                            <?php if($set->single==1): ?>
                                                <input type="checkbox" name="single" id="customCheckLogin12" class="custom-control-input" value="1" checked>
                                            <?php else: ?>
                                                <input type="checkbox" name="single" id="customCheckLogin12"  class="custom-control-input" value="1">
                                            <?php endif; ?>
                                            <label class="custom-control-label" for="customCheckLogin12">
                                            <span class="text-muted"><?php echo e(__('Single Charge')); ?></span>     
                                            </label>
                                        </div>
                                    </div>
                                </div>         
                                <div class="text-right">
                                    <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Save Changes')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>                   
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0"><?php echo e(__('Charges')); ?></h3>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo e(route('admin.charges.update')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Transfer/Request')); ?> <span class="text-danger">*</span></label>
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <input type="number" name="transfer_charge" value="<?php echo e($set->transfer_charge); ?>" class="form-control" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>
                                    </div>                                                                                                                                                                
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Withdraw')); ?><span class="text-danger">*</span></label>
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <input type="number" name="withdraw_charge" value="<?php echo e($set->withdraw_charge); ?>" class="form-control" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>
                                    </div>                                                       
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Merchant')); ?> <span class="text-danger">*</span></label>
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <input type="number" name="merchant_charge" value="<?php echo e($set->merchant_charge); ?>" class="form-control" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>
                                    </div>                              
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Invoice')); ?> <span class="text-danger">*</span></label>
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <input type="number" name="invoice_charge" value="<?php echo e($set->invoice_charge); ?>" class="form-control" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>
                                    </div>                            
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Product Order')); ?> <span class="text-danger">*</span></label>
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <input type="number" name="product_charge" max-length="10" value="<?php echo e($set->product_charge); ?>" class="form-control" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>
                                    </div>                                    
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Single Charge')); ?> <span class="text-danger">*</span></label>
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <input type="number" name="single_charge" max-length="10" value="<?php echo e($set->single_charge); ?>" class="form-control" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>
                                    </div>                                    
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Donation')); ?> <span class="text-danger">*</span></label>
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <input type="number" name="donation_charge" max-length="10" value="<?php echo e($set->donation_charge); ?>" class="form-control" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>
                                    </div>                                    
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Subscription')); ?> <span class="text-danger">*</span></label>
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <input type="number" name="subscription_charge" max-length="10" value="<?php echo e($set->subscription_charge); ?>" class="form-control" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                        </div>
                                    </div>  
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Withdraw Limit')); ?> <span class="text-danger">*</span></label>
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                            </span>
                                            <input type="number" name="withdraw_limit" value="<?php echo e($set->withdraw_limit); ?>" class="form-control" required>
                                        </div>
                                    </div>  
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Balance on Signup ')); ?><span class="text-danger">*</span></label>
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                            </span>
                                            <input type="number" name="bal" value="<?php echo e($set->balance_reg); ?>" class="form-control" required>
                                        </div>
                                    </div>                                    
                                    <label class="col-form-label col-lg-2"><?php echo e(__('Minimum Transfer')); ?><span class="text-danger">*</span></label>
                                    <div class="col-lg-2">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                            </span>
                                            <input type="number" name="min_transfer" value="<?php echo e($set->min_transfer); ?>" class="form-control" required>
                                        </div>
                                    </div>                           
                                </div>                    
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Save Changes')); ?></button>
                                    </div>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="mb-0"><?php echo e(__('Security')); ?></h3>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo e(route('admin.account.update')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2"><?php echo e(__('Username')); ?></label>
                                        <div class="col-lg-10">
                                            <input type="text" name="username" value="<?php echo e($val->username); ?>" class="form-control">
                                        </div>
                                    </div>                         
                                    <div class="form-group row">
                                        <label class="col-form-label col-lg-2"><?php echo e(__('Password')); ?></label>
                                        <div class="col-lg-10">
                                            <input type="password" name="password"  class="form-control" required>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/boompay/core/resources/views/admin/settings/index.blade.php ENDPATH**/ ?>