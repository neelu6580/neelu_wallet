<?php $__env->startSection('content'); ?>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
      
    <div class="card">
      <div class="card-header header-elements-inline">
                                                      <a  style="float:right;margin-top:30px!important;margin-right:20px" data-toggle="modal" data-target="#single-charge" href="" class="btn btn-success"><?php echo e(__('Add New')); ?></a>

        <h3 class="mb-0"><?php echo e(__('Virtual Card Single Charge')); ?></h3>
        
      </div>
      <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-buttons">
          <thead>
            <tr>
              <th><?php echo e(__('S / N')); ?></th>
            
              <th><?php echo e(__('Name')); ?></th>
              <th><?php echo e(__('Amount')); ?></th>
              <th><?php echo e(__('Reference ID')); ?></th>
              <th><?php echo e(__('Redirect Url')); ?></th>
             
              <th><?php echo e(__('Link')); ?></th>
               <th><?php echo e(__('Status')); ?></th>
              <th><?php echo e(__('Created')); ?></th>
              <th><?php echo e(__('Updated')); ?></th>
              
              <th>Action</th>
            </tr>
          </thead>
          <tbody>  
          
          
            <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e(++$k); ?>.</td>
                <td><?php echo e($val->name); ?></td>
                <td><?php echo e($val->amount); ?></td>
                <td><?php echo e($val->ref_id); ?></td>
                <td><?php echo e($val->redirect_link); ?></td>
              
                <td>
                <a class="btn-icon-clipboard text-primary" data-clipboard-text="<?php echo e(url('vcard-single-charge')); ?>/<?php echo e($val->ref_id); ?>" title="" data-original-title="Copy">COPY LINK</a>
                </td>
                <td>
                    <?php if($val->status== 0): ?>
                        <span class="badge badge-pill badge-danger"><?php echo e(__('Inactive')); ?></span>
                    <?php elseif($val->status== 1): ?>
                        <span class="badge badge-pill badge-success"><?php echo e(__('Active')); ?></span>
                    <?php elseif($val->status== 2): ?>
                        <span class="badge badge-pill badge-danger"><?php echo e(__('Deleted')); ?></span>    
                    
                    <?php endif; ?>
                </td> 
                <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></td>
                <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->updated_at))); ?></td>
                <td>
                    <div class="">
                                            <div class="dropdown">
                                                <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a data-toggle="modal" data-target="#edit-single-charge<?php echo e($val->id); ?>" href="" class="dropdown-item"><i class="fa fa-pen"></i><?php echo e(__('Edit')); ?></a>

                                                    
                                                   
                                                    <a data-toggle="modal" data-target="#delete<?php echo e($val->id); ?>" href="" class="dropdown-item"><i class="fa fa-times-circle" aria-hidden="true"></i><?php echo e(__('Delete')); ?></a>
                                                   
                                                    
                                                </div>
                                            </div>
                                        </div> 
                </td>
            </tr>
            
            <div class="modal fade" id="edit-single-charge<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                  <div class="card-header">
                    <h3 class="mb-0"><?php echo e(__('Update Payment Link')); ?></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    <span class="form-text text-xs">Single Charge allows you to create payment links for your customers, Transaction Charge is <?php echo e($set->single_charge); ?>% per transaction</span>

                  </div>
                  <div class="card-body">
                    <form action="<?php echo e(route('admin.vcard_single_charge_edit')); ?>" method="post" id="modal-details">
                      <?php echo csrf_field(); ?>
                      <input type="hidden" name="link_id" value="<?php echo e($val->id); ?>">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-form-label col-lg-12"><?php echo e(__('Payment link name')); ?><span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <input type="text" name="name" class="form-control" value="<?php echo e($val->name); ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="col-form-label col-lg-12"><?php echo e(__('Amount')); ?></label>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                        </span>
                                        <input type="number" class="form-control" name="amount" placeholder="0.00" value="<?php echo e($val->amount); ?>">
                                        <span class="input-group-append">
                                            <span class="input-group-text">.00</span>
                                        </span>
                                    </div>
                                    <span class="form-text text-xs">Leave empty to allow customers enter desired amount</span>
                                </div>
                            </div>  
                        </div>  
                        <div class="form-group row">
                          <label class="col-form-label col-lg-12"><?php echo e(__('Description')); ?><span class="text-danger">*</span></label>
                          <div class="col-lg-12">
                              <textarea type="text" name="description" rows="4" class="tinymce form-control"><?php echo e($val->description); ?></textarea>
                          </div>
                        </div>   
                        <hr>             
                        <div class="form-group row">
                          <label class="col-form-label col-lg-12"><?php echo e(__('Redirect after payment  - Optional')); ?></label>
                          <div class="col-lg-12">
                              <input type="text" name="redirect_url" class="form-control" placeholder="https://google.com" value="<?php echo e($val->redirect_link); ?>">
                          </div>
                        </div> 
                        <div class="text-right">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btn-sm" form="modal-details"><?php echo e(__('Create link')); ?></button>
                        </div>         
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
    </div>
    
    <div class="modal fade" id="single-charge" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                  <div class="card-header">
                    <h3 class="mb-0"><?php echo e(__('Create New Payment Link')); ?></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    <span class="form-text text-xs">Single Charge allows you to create payment links for your customers, Transaction Charge is <?php echo e($set->single_charge); ?>% per transaction</span>

                  </div>
                  <div class="card-body">
                    <form action="<?php echo e(route('admin.vcard_single_charge')); ?>" method="post" id="modal-details">
                      <?php echo csrf_field(); ?>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-form-label col-lg-12"><?php echo e(__('Payment link name')); ?><span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="col-form-label col-lg-12"><?php echo e(__('Amount')); ?></label>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                        </span>
                                        <input type="number" class="form-control" name="amount" placeholder="0.00">
                                        <span class="input-group-append">
                                            <span class="input-group-text">.00</span>
                                        </span>
                                    </div>
                                    <span class="form-text text-xs">Leave empty to allow customers enter desired amount</span>
                                </div>
                            </div>  
                        </div>  
                        <div class="form-group row">
                          <label class="col-form-label col-lg-12"><?php echo e(__('Description')); ?><span class="text-danger">*</span></label>
                          <div class="col-lg-12">
                              <textarea type="text" name="description" rows="4" class="tinymce form-control"></textarea>
                          </div>
                        </div>   
                        <hr>             
                        <div class="form-group row">
                          <label class="col-form-label col-lg-12"><?php echo e(__('Redirect after payment  - Optional')); ?></label>
                          <div class="col-lg-12">
                              <input type="text" name="redirect_url" class="form-control" placeholder="https://google.com" >
                          </div>
                        </div> 
                        <div class="text-right">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btn-sm" form="modal-details"><?php echo e(__('Create link')); ?></button>
                        </div>         
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

<div class="modal fade" id="delete<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0"><?php echo e(__('Are you sure you want to delete this?')); ?></h3>
                                                    </div>
                                                    <div class="card-body px-lg-5 py-lg-5 text-right">
                                                        <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                                        <a  href="<?php echo e(route('admin.delete_virtual_card_paylink', ['id' => $val->id])); ?>" class="btn btn-danger btn-sm"><?php echo e(__('Proceed')); ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/greenvx4/public_html/vcard/core/resources/views/admin/transfer/vcard_sc.blade.php ENDPATH**/ ?>