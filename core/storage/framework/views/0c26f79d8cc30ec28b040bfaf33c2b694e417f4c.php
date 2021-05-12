<?php $__env->startSection('content'); ?>
<div class="content"> 
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title font-weight-semibold"><?php echo e(__('Congifure website')); ?></h6>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.settings.update')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2"><?php echo e(__('Company / Website name')); ?></label>
                            <div class="col-lg-10">
                                <input type="text" name="site_name" maxlength="200" value="<?php echo e($set->site_name); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2"><?php echo e(__('Company email')); ?></label>
                            <div class="col-lg-10">
                                <input type="email" name="email" value="<?php echo e($set->email); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2"><?php echo e(__('Mobile')); ?></label>
                            <div class="col-lg-10">
                                <div class="input-group">
                                    <input type="text" name="mobile" max-length="14" value="<?php echo e($set->mobile); ?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2"><?php echo e(__('Website title')); ?></label>
                            <div class="col-lg-10">
                                <input type="text" name="title" max-length="200" value="<?php echo e($set->title); ?>" class="form-control">
                            </div>
                        </div>                         
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2"><?php echo e(__('Withdraw duration')); ?></label>
                            <div class="col-lg-10">
                                <input type="text" name="withdraw_duration" max-length="200" value="<?php echo e($set->withdraw_duration); ?>" class="form-control">
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2"><?php echo e(__('Transfer fee')); ?> <span class="text-danger">*</span></label>
                            <div class="col-lg-2">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </span>
                                    <input type="number" name="transfer_charge" max-length="10" value="<?php echo e($set->transfer_charge); ?>" class="form-control">
                                </div>
                            </div>
                            <label class="col-form-label col-lg-2"><?php echo e(__('Balance on signup ')); ?><span class="text-danger">*</span></label>
                            <div class="col-lg-2">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text"><?php echo e($currency->name); ?></span>
                                    </span>
                                    <input type="number" name="bal" max-length="10" value="<?php echo e($set->balance_reg); ?>" class="form-control">
                                </div>
                            </div>                                                                                                                                                                 
                            <label class="col-form-label col-lg-2"><?php echo e(__('Withdraw charge ')); ?><span class="text-danger">*</span></label>
                            <div class="col-lg-2">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </span>
                                    <input type="number" name="withdraw_charge" max-length="10" value="<?php echo e($set->withdraw_charge); ?>" class="form-control">
                                </div>
                            </div>                            
                            <label class="col-form-label col-lg-2"><?php echo e(__('Withdraw limit')); ?> <span class="text-danger">*</span></label>
                            <div class="col-lg-2">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </span>
                                    <input type="number" name="withdraw_limit" max-length="10" value="<?php echo e($set->withdraw_limit); ?>" class="form-control">
                                </div>
                            </div>                             
                            <label class="col-form-label col-lg-2"><?php echo e(__('Merchant charge')); ?> <span class="text-danger">*</span></label>
                            <div class="col-lg-2">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </span>
                                    <input type="number" name="merchant_charge" max-length="10" value="<?php echo e($set->merchant_charge); ?>" class="form-control">
                                </div>
                            </div>                              
                            <label class="col-form-label col-lg-2"><?php echo e(__('Invoice charge')); ?> <span class="text-danger">*</span></label>
                            <div class="col-lg-2">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </span>
                                    <input type="number" name="invoice_charge" max-length="10" value="<?php echo e($set->invoice_charge); ?>" class="form-control">
                                </div>
                            </div>                            
                            <label class="col-form-label col-lg-2"><?php echo e(__('Product charge')); ?> <span class="text-danger">*</span></label>
                            <div class="col-lg-2">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </span>
                                    <input type="number" name="product_charge" max-length="10" value="<?php echo e($set->product_charge); ?>" class="form-control">
                                </div>
                            </div>                            
                        </div>           
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2"><?php echo e(__('Status')); ?> <span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <div class="form-check form-check-inline form-check-switchery">
                                    <label class="form-check-label">
                                    <?php if($set->kyc==1): ?>
                                        <input type="checkbox" name="kyc" class="form-check-input-switchery" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="kyc" class="form-check-input-switchery" value="1">
                                    <?php endif; ?>
                                    <?php echo e(__('KYC ')); ?>      
                                    </label>
                                </div> 
                                <div class="form-check form-check-inline form-check-switchery">
                                    <label class="form-check-label">
                                    <?php if($set->email_verification==1): ?>
                                        <input type="checkbox" name="email_activation" class="form-check-input-switchery" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="email_activation" class="form-check-input-switchery" value="1">
                                    <?php endif; ?>
                                    <?php echo e(__('Email verification ')); ?>      
                                    </label>
                                </div>   
                                <div class="form-check form-check-inline form-check-switchery">
                                    <label class="form-check-label">
                                    <?php if($set->sms_verification==1): ?>
                                        <input type="checkbox" name="sms_activation" class="form-check-input-switchery" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="sms_activation" class="form-check-input-switchery" value="1">
                                    <?php endif; ?>
                                    <?php echo e(__('SMS Verification')); ?>       
                                    </label>
                                </div>                                 
                                <div class="form-check form-check-inline form-check-switchery">
                                    <label class="form-check-label">
                                    <?php if($set->email_notify==1): ?>
                                        <input type="checkbox" name="email_notify" class="form-check-input-switchery" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="email_notify" class="form-check-input-switchery" value="1">
                                    <?php endif; ?>
                                    <?php echo e(__('Email notify ')); ?>      
                                    </label>
                                </div>                                 
                                <div class="form-check form-check-inline form-check-switchery">
                                    <label class="form-check-label">
                                    <?php if($set->sms_notify==1): ?>
                                        <input type="checkbox" name="sms_notify" class="form-check-input-switchery" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="sms_notify" class="form-check-input-switchery" value="1">
                                    <?php endif; ?>
                                    <?php echo e(__('SMS notify ')); ?>      
                                    </label>
                                </div> 
                                <div class="form-check form-check-inline form-check-switchery">
                                    <label class="form-check-label">
                                    <?php if($set->registration==1): ?>
                                        <input type="checkbox" name="registration" class="form-check-input-switchery" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="registration" class="form-check-input-switchery" value="1">
                                    <?php endif; ?>
                                    <?php echo e(__('Registration')); ?>       
                                    </label>
                                </div>                                                                                                                              
                                <div class="form-check form-check-inline form-check-switchery">
                                    <label class="form-check-label">
                                    <?php if($set->merchant==1): ?>
                                        <input type="checkbox" name="merchant" class="form-check-input-switchery" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="merchant" class="form-check-input-switchery" value="1">
                                    <?php endif; ?>
                                    <?php echo e(__('Merchant ')); ?>      
                                    </label>
                                </div>                                 
                                <div class="form-check form-check-inline form-check-switchery">
                                    <label class="form-check-label">
                                    <?php if($set->recaptcha==1): ?>
                                        <input type="checkbox" name="recaptcha" class="form-check-input-switchery" value="1" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="recaptcha" class="form-check-input-switchery" value="1">
                                    <?php endif; ?>
                                    <?php echo e(__('Recaptcha')); ?>      
                                    </label>
                                </div> 
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-form-label col-lg-2"><?php echo e(__('Short description')); ?></label>
                            <div class="col-lg-10">
                                <textarea type="text" name="site_desc" rows="4" class="form-control"><?php echo e($set->site_desc); ?></textarea>
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
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/boompay/core/resources/views/admin/settings/basic-setting.blade.php ENDPATH**/ ?>