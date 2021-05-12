<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0"><?php echo e(__('Update Account Information')); ?></h3>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo e(url('admin/profile-update')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2"><?php echo e(__('Business name')); ?></label>
                                <div class="col-lg-10">
                                    <input type=""hidden value="<?php echo e($client->id); ?>" name="id">
                                    <input type="text" name="business_name" class="form-control" value="<?php echo e($client->business_name); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2"><?php echo e(__('First Name')); ?></label>
                                <div class="col-lg-10">
                                    <input type="text" name="first_name" class="form-control" value="<?php echo e($client->first_name); ?>">
                                </div>
                            </div>                          
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2"><?php echo e(__('Last Name')); ?></label>
                                <div class="col-lg-10">
                                    <input type="text" name="last_name" class="form-control" value="<?php echo e($client->last_name); ?>">
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2"><?php echo e(__('Email')); ?></label>
                                <div class="col-lg-10">
                                    <input type="email" name="email" class="form-control" readonly value="<?php echo e($client->email); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2"><?php echo e(__('Mobile')); ?></label>
                                <div class="col-lg-10">
                                    <input type="text" name="mobile" class="form-control" value="<?php echo e($client->phone); ?>">
                                </div>
                            </div>                         
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2"><?php echo e(__('Office address')); ?></label>
                                <div class="col-lg-10">
                                    <input type="text" name="address" class="form-control" value="<?php echo e($client->office_address); ?>">
                                </div>
                            </div>                          
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2"><?php echo e(__('Website')); ?></label>
                                <div class="col-lg-10">
                                    <input type="text" name="website" class="form-control" value="<?php echo e($client->website_link); ?>">
                                </div>
                            </div>                                               
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2"><?php echo e(__('Balance')); ?></label>
                                <div class="col-lg-10">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                        </span>
                                        <input type="number" name="balance" max-length="10" value="<?php echo e($client->balance); ?>" class="form-control">
                                    </div>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2"><?php echo e(__('Status')); ?><span class="text-danger">*</span></label>
                                <div class="col-lg-10">
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <?php if($client->email_verify==1): ?>
                                            <input type="checkbox" name="email_verify" id=" customCheckLogin5" class="custom-control-input" value="1" checked>
                                        <?php else: ?>
                                            <input type="checkbox" name="email_verify"id=" customCheckLogin5"  class="custom-control-input" value="1">
                                        <?php endif; ?>
                                        <label class="custom-control-label" for=" customCheckLogin5">
                                        <span class="text-muted"><?php echo e(__('Email verification')); ?></span>     
                                        </label>
                                    </div>                                     
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <?php if($client->fa_status==1): ?>
                                            <input type="checkbox" name="fa_status" id=" customCheckLogin6" class="custom-control-input" value="1" checked>
                                        <?php else: ?>
                                            <input type="checkbox" name="fa_status" id=" customCheckLogin6"  class="custom-control-input" value="1">
                                        <?php endif; ?>
                                        <label class="custom-control-label" for=" customCheckLogin6">
                                        <span class="text-muted"><?php echo e(__('2fa security')); ?></span>     
                                        </label>
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
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="card-img-actions d-inline-block mb-3">
                            <img class="img-fluid rounded-circle" src="<?php echo e(url('/')); ?>/asset/profile/<?php echo e($client->image); ?>" width="120" height="120" alt="">
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex align-item-sm-center flex-sm-nowrap">
                            <div>
                                <ul class="list list-unstyled mb-0">
                                    <li><span class="text-sm"><?php echo e(__('Joined:')); ?> <?php echo e(date("Y/m/d h:i:A", strtotime($client->created_at))); ?></span></li>
                                    <li><span class="text-sm"><?php echo e(__('Last Login:')); ?> <?php echo e(date("Y/m/d h:i:A", strtotime($client->last_login))); ?></span></li>
                                    <li><span class="text-sm"><?php echo e(__('Last Updated:')); ?> <?php echo e(date("Y/m/d h:i:A", strtotime($client->updated_at))); ?></span></li>
                                    <li><span class="text-sm"><?php echo e(__('IP Address:')); ?> <?php echo e($client->ip_address); ?></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>  
                <?php if($set->kyc==1): ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo e(__('Business verification')); ?></h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <th>#</th>
                                <th class="text-center"><?php echo e(__('Status')); ?></th>
                                <th class="text-center"><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">
                                        <?php if($client->kyc_status==0): ?>
                                        <?php echo e(__('Unverified')); ?>

                                        <?php else: ?>
                                        <?php echo e(__('Verified')); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if(!empty($client->kyc_link)): ?>
                                            <a href="<?php echo e(url('/')); ?>/asset/profile/<?php echo e($client->kyc_link); ?>"><?php echo e(__('View')); ?></a>
                                        <?php else: ?>
                                        <?php echo e(__('No file')); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td class="">
                                        <div class="dropdown">
                                            <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <?php if($client->kyc_status!=1): ?>
                                            <?php if(!empty($client->kyc_link)): ?> 
                                                <a class='dropdown-item' href ="<?php echo e(url('/')); ?>/admin/approve-kyc/<?php echo e($client->id); ?>"><i class="icon-eye mr-2"></i><?php echo e(__('Approve')); ?></a>
                                                <a class='dropdown-item' href ="<?php echo e(url('/')); ?>/admin/reject-kyc/<?php echo e($client->id); ?>"><i class="icon-eye-blocked2 mr-2"></i><?php echo e(__('Reject')); ?></a>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>           
                                </tr> 
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0"><?php echo e(__('Audit Logs')); ?></h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                        <thead>
                            <tr>
                            <th><?php echo e(__('S / N')); ?></th>
                            <th><?php echo e(__('Reference ID')); ?></th>
                            <th><?php echo e(__('Log')); ?></th>
                            <th><?php echo e(__('Created')); ?></th>
                            </tr>
                        </thead>
                        <tbody>  
                            <?php $__currentLoopData = $audit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(++$k); ?>.</td>
                                <td>#<?php echo e($val->trx); ?></td>
                                <td><?php echo e($val->log); ?></td>
                                <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/boompay/core/resources/views/admin/user/edit.blade.php ENDPATH**/ ?>