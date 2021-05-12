<?php $__env->startSection('content'); ?>

 <?php $countries =DB::table('countries')->get(); ?>
 <head> 
  <style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
</head>
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
                                <div class="col-lg-4">
                                    
                                    <select class="form-control" name="prefix" >
                                      <?php foreach($countries as $country){?>
                                      <option value="<?=$country->id?>" <?=($country->iso_code == $client->phone_iso) ? 'selected' :''?>> <?= '(+'.$country->calling_code .') ' .$country->name?></option>
                                      <?php }?>
                                  </select>
                                  </div>
                                  <div class="col-lg-6">
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
                                <label class="col-form-label col-lg-2"><?php echo e(__('Business country')); ?></label>
                                <div class="col-lg-10">
                                    <select class="form-control" name="business_country" >
                                        <?php foreach($countries as $country){?>
                                        <option value="<?=$country->id?>"  <?=($country->id == $client->business_country) ? 'selected' :''?>><?= $country->name ?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>   
                            
                            
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2"><?php echo e(__('Source')); ?></label>
                                <div class="col-lg-10">
                                    <select class="form-control" name="source_from">
                                    <option value="By Social Media" <?=($client->source_from =='By Social Media' ) ? 'selected' :''?>>By Social Media</option>
                                    <option value="Google Ads/ Search Result" <?=($client->source_from == 'Google Ads/ Search Result') ? 'selected' :''?>>Google Ads/ Search Result</option>
                                    <option value="From a Friend" <?=($client->source_from == 'From a Friend') ? 'selected' :''?>>From a Friend</option>
                                    <option value="From SureUp" <?=($client->source_from =='From SureUp' ) ? 'selected' :''?>>From SureUp</option>
                                    <option value="From Merchant" <?=($client->source_from == 'From Merchant') ? 'selected' :''?>>From Merchants</option>
                                    <option value="From Tempo" <?=($client->source_from == 'From Tempo') ? 'selected' :''?>>From Tempo</option>

                                    <option value="Others" <?=($client->source_from == 'Others') ? 'selected' :''?>>Others</option>
                                    </select>
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
                             <div class="form-group row">
                                <label class="col-form-label col-lg-3"><?php echo e(__('Virtual Card Activation')); ?><span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <label class="switch">
                                            <?php if($client->virtual_card_activation ==1): ?>
                                          <input type="checkbox" name="virtual_card_activation" checked>
                                          <?php else: ?>
                                         <input type="checkbox" name="virtual_card_activation">
                                            <?php endif; ?>
                                          <span class="slider round"></span>
                                        </label>
                                        
                                    </div>                                     
                                                                                                 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3"><?php echo e(__('eStore Activation')); ?><span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <label class="switch">
                                            <?php if($client->estore_activation ==1): ?>
                                          <input type="checkbox" name="estore_activation" checked>
                                          <?php else: ?>
                                         <input type="checkbox" name="estore_activation">
                                            <?php endif; ?>
                                          <span class="slider round"></span>
                                        </label>
                                        
                                    </div>                                     
                                                                                                 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3"><?php echo e(__('Transfer Activation')); ?><span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <label class="switch">
                                            <?php if($client->transfer_activation ==1): ?>
                                          <input type="checkbox" name="transfer_activation" checked>
                                          <?php else: ?>
                                         <input type="checkbox" name="transfer_activation">
                                            <?php endif; ?>
                                          <span class="slider round"></span>
                                        </label>
                                        
                                    </div>                                     
                                                                                                 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3"><?php echo e(__('Request Activation')); ?><span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <label class="switch">
                                            <?php if($client->request_activation ==1): ?>
                                          <input type="checkbox" name="request_activation" checked>
                                          <?php else: ?>
                                         <input type="checkbox" name="request_activation">
                                            <?php endif; ?>
                                          <span class="slider round"></span>
                                        </label>
                                        
                                    </div>                                     
                                                                                                 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3">Billing Tools<span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <label class="switch">
                                            <?php if($client->invoice_activation ==1): ?>
                                          <input type="checkbox" name="invoice_activation" checked>
                                          <?php else: ?>
                                         <input type="checkbox" name="invoice_activation">
                                            <?php endif; ?>
                                          <span class="slider round"></span>
                                        </label>
                                        
                                    </div>                                     
                                                                                                 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-3"><?php echo e(__('Payment Link Activation')); ?><span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <label class="switch">
                                            <?php if($client->payment_link_activation ==1): ?>
                                          <input type="checkbox" name="payment_link_activation" checked>
                                          <?php else: ?>
                                         <input type="checkbox" name="payment_link_activation">
                                            <?php endif; ?>
                                          <span class="slider round"></span>
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

                                        <?php elseif($client->kyc_status==2): ?>
                                         <?php echo e(__('Rejected')); ?>

                                        <?php else: ?>
                                        <?php echo e(__('Verified')); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td class="text-left">
                                        <ul class="p-0">
                                            <?php if(!empty($client->kyc_link)): ?>
                                                <li><a href="<?php echo e(url('/')); ?>/asset/profile/<?php echo e($client->kyc_link); ?>" target="_blank"><?php echo e(__('Company Certificate')); ?></a></li>
                                                <!--li><a href="<?php echo e(url('/')); ?>/asset/profile/<?php echo e($client->photo_id); ?>" target="_blank"><?php echo e(__('Photo ID')); ?></a></li-->
                                                <li><a href="<?php echo e(url('/')); ?>/asset/profile/<?php echo e($client->address_id); ?>" target="_blank"><?php echo e(__('Address Proof')); ?></a></li>
                                            <?php else: ?>
                                            <?php echo e(__('No file')); ?>

                                            <?php endif; ?>
                                        </ul>
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
                                                <!--<a class='dropdown-item' href ="<?php echo e(url('/')); ?>/admin/reject-kyc/<?php echo e($client->id); ?>"><i class="icon-eye-blocked2 mr-2"></i><?php echo e(__('Reject')); ?></a>-->
                                                <a class='dropdown-item' data-toggle="modal" data-target="#rejectmessage"><i class="icon-eye-blocked2 mr-2"></i><?php echo e(__('Reject')); ?></a>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                            
                                            <?php if($client->kyc_status==1): ?>
                                                <a class='dropdown-item' data-toggle="modal" data-target="#rejectmessage"><i class="icon-eye-blocked2 mr-2"></i><?php echo e(__('Reject')); ?></a>
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo e(__('Business Details')); ?></h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <td><?php echo e(__('SSN')); ?></td>
                                    <td><?php echo e($client->verify_ssn); ?></td>           
                                </tr> 
                                <tr>
                                    <td><?php echo e(__('EIN')); ?></td>
                                    <td><?php echo e($client->verify_ein); ?></td>           
                                </tr> 
                                <tr>
                                    <td><?php echo e(__('National id')); ?></td>
                                    <td><a href="<?php echo e(url('/')); ?>/asset/profile/<?php echo e($client->photo_id); ?>" target="_blank"><?php echo e(__('View')); ?></a></td>           
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo e(__('Change Password')); ?></h3>
                        <form action="<?php echo e(url('/')); ?>/admin/request-password/<?php echo e($client->id); ?>" method="post">
                        <?php echo csrf_field(); ?>
                            <div class="form-group">
                              <div class="custom-file">
                                <input type="text" class="form-control" name="password" placeholder="New Password">
                                <input type="text" class="form-control mt-4" name="password_confirmation" placeholder="Confirm Password">
                              </div> 
                            </div>              
                          <div class="text-center">
                            <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Submit')); ?></button>
                          </div>
                        </form>
                    </div>
                </div>
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
    
    <!-- Modal -->
    <div class="modal fade" id="rejectmessage" tabindex="-1" role="dialog" aria-labelledby="rejectmessageTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="rejectmessageTitle">Add Comment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?php echo e(url('/')); ?>/admin/reject-kyc/<?php echo e($client->id); ?>" method="post">
            <?php echo csrf_field(); ?>
                <div class="form-group row">
                  <label class="col-form-label col-lg-4"><?php echo e(__('Add Comment')); ?></label>
                  <div class="col-lg-8">
                    <div class="row">
                        <div class="col-12">
                          <textarea name="comment" class="form-control" row="5"></textarea>
                        </div> 
                    </div>
                  </div>
                </div>
                <div class="text-right">
                <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Submit')); ?></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/greenvx4/public_html/vcard/core/resources/views/admin/user/edit.blade.php ENDPATH**/ ?>