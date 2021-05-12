<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                                        <div>

                                            <a  style="float:right;margin-top:30px!important;margin-right:20px" data-toggle="modal" data-target="#addNew" href="" class="btn btn-success"><?php echo e(__('Add New')); ?></a></div>

                    <div class="card-header">
                        <h3 class="card-title"><?php echo e(__('List of All Card Type')); ?></h3>
                        
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('S/N')); ?></th>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Description')); ?></th>                                                                     
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('Date')); ?></th>
                                    <th><?php echo e(__('Last Update')); ?></th>
                                    <th class="text-center"><?php echo e(__('Action')); ?></th>    
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $virtualCardsType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $typeDetails): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <td><?php echo e(++$k); ?>.</td>
                                    <td><?php echo e($typeDetails->name); ?></td>
                                    <td><?php echo e($typeDetails->description); ?></td>
                                    
                                  
                                  
                                   
                                    <td>
                                        <?php if($typeDetails->status== 0): ?>
                                            <span class="badge badge-pill badge-danger"><?php echo e(__('Inactive')); ?></span>
                                        <?php elseif($typeDetails->status== 1): ?>
                                            <span class="badge badge-pill badge-success"><?php echo e(__('Active')); ?></span>
                                        <?php elseif($typeDetails->card_state== 2): ?>
                                            <span class="badge badge-pill badge-danger"><?php echo e(__('Deleted')); ?></span>    
                                        
                                        <?php endif; ?>
                                    </td> 
                                    <td><?php echo e(date("Y/m/d h:i:A", strtotime($typeDetails->created_at))); ?></td>
                                    <td><?php echo e(date("Y/m/d h:i:A", strtotime($typeDetails->updated_at))); ?></td>
                                    <td class="text-center">
                                        <div class="">
                                            <div class="dropdown">
                                                <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a data-toggle="modal" data-target="#editSubscription<?php echo e($typeDetails->id); ?>" href="" class="dropdown-item"><i class="fa fa-pen"></i><?php echo e(__('Edit')); ?></a>

                                                    
                                                   
                                                    <a data-toggle="modal" data-target="#delete<?php echo e($typeDetails->id); ?>" href="" class="dropdown-item"><i class="fa fa-times-circle" aria-hidden="true"></i><?php echo e(__('Delete')); ?></a>
                                                   
                                                    
                                                </div>
                                            </div>
                                        </div> 
                                    </td>                    
                                </tr>
                                
                                 <div class="modal fade" id="editSubscription<?php echo e($typeDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0"><?php echo e(__('Update Card Type')); ?> </h3>
                                                    </div>
                                                      <form action="<?php echo e(route('admin.edit_virtual_card_type')); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                       <input type="hidden" name="type_id" value="<?php echo e($typeDetails->id); ?>">
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                <?php echo e(__('Name')); ?></label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <input class="form-control" type="text" name="type_name" placeholder="Enter Card Type Name" value="<?php echo e($typeDetails->name); ?>" required>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                <?php echo e(__('Description')); ?></label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <textarea class="form-control" type="text" name="description" placeholder="Enter Description"  required><?php echo e($typeDetails->description); ?></textarea>
                                                            </div>
                                                        </div>
                                                         <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                <?php echo e(__('Status')); ?></label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <select class="form-control" name="status">
                                                                     <option>Select Status</option>
                                                                     <option value="1" <?php if($typeDetails->status == 1): ?><?php echo e('selected'); ?> <?php endif; ?>>Active</option>
                                                                     <option value="0" <?php if($typeDetails->status == 0): ?><?php echo e('selected'); ?> <?php endif; ?>>Inactive</option>
                                                                    </select> 
                                                            </div>
                                                        </div>
                                                    <div class="card-body px-lg-5 py-lg-5 text-right">
                                                        <button type="button" class="btn btn-neutral" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                                        <button  type="submit" class="btn btn-success"><?php echo e(__('Update Now')); ?></button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                
                                <div class="modal fade" id="delete<?php echo e($typeDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0"><?php echo e(__('Are you sure you want to delete this?')); ?></h3>
                                                    </div>
                                                    <div class="card-body px-lg-5 py-lg-5 text-right">
                                                        <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                                        <a  href="<?php echo e(route('admin.delete_virtual_card_type', ['id' => $typeDetails->id])); ?>" class="btn btn-danger btn-sm"><?php echo e(__('Proceed')); ?></a>
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
            </div>
        </div>
    </div>
</div>
<!--ADD MODEL-->
 <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0"><?php echo e(__('Add New Card Type')); ?> </h3>
                                                    </div>
                                                      <form action="<?php echo e(route('admin.add_virtual_card_type')); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                       
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                <?php echo e(__('Type Name')); ?></label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <input class="form-control" type="text" name="type_name" placeholder="Enter Type Name" required>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                <?php echo e(__('Features')); ?></label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <textarea class="form-control" type="text" name="description" placeholder="Enter Description" required></textarea>
                                                            </div>
                                                        </div>
                                                    <div class="card-body px-lg-5 py-lg-5 text-right">
                                                        <button type="button" class="btn btn-neutral" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                                        <button  type="submit" class="btn btn-success"><?php echo e(__('Add Now')); ?></button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/greenvx4/public_html/vcard/core/resources/views/admin/user/vcard_type.blade.php ENDPATH**/ ?>