<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0"><?php echo e(__('Products')); ?></h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('S/N')); ?></th>
                                    <th><?php echo e(__('Ref')); ?></th>
                                    <th><?php echo e(__('Vendor')); ?></th>
                                    <th><?php echo e(__('Received - Amount/Charges')); ?></th>
                                    <th><?php echo e(__('Product Name')); ?></th>
                                    <th><?php echo e(__('Amount')); ?></th>
                                    <th><?php echo e(__('Quantity')); ?></th>
                                    <th><?php echo e(__('Shipping fee')); ?></th>                                                             
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('Suspended')); ?></th>
                                    <th><?php echo e(__('Created')); ?></th>
                                    <th><?php echo e(__('Updated')); ?></th>
                                    <th class="text-center"><?php echo e(__('Action')); ?></th>    
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $amount=App\Models\Order::whereproduct_id($val->id)->sum('total');
                                    $charge=App\Models\Order::whereproduct_id($val->id)->sum('charge');
                                ?>
                                <tr>
                                    <td><?php echo e(++$k); ?>.</td>
                                    <td>#<?php echo e($val->ref_id); ?></td>
                                    <td><?php echo e($val->user->business_name); ?></td>
                                    <td><?php echo e($currency->symbol.number_format($amount)); ?> / <?php echo e($currency->symbol.number_format($charge)); ?></td>
                                    <td><?php echo e($val->name); ?></td>
                                    <td><?php echo e($currency->symbol.number_format($val->amount)); ?></td>
                                    <td><?php echo e($val->quantity); ?></td>
                                    <td><?php echo e($currency->symbol.number_format($val->shipping_fee)); ?></td>
                                    <td>
                                        <?php if($val->status==0): ?>
                                            <span class="badge badge-pill badge-danger"><?php echo e(__('Disabled')); ?></span>
                                        <?php elseif($val->status==1): ?>
                                            <span class="badge badge-pill badge-success"><?php echo e(__('Active')); ?></span>                                        
                                        <?php endif; ?>
                                    </td> 
                                    <td>
                                        <?php if($val->active==1): ?>
                                            <span class="badge badge-pill badge-success"><?php echo e(__('Yes')); ?></span>
                                        <?php else: ?>
                                            <span class="badge badge-pill badge-danger"><?php echo e(__('No')); ?></span>
                                        <?php endif; ?>
                                    </td>                                      
                                    <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></td>  
                                    <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->updated_at))); ?></td>
                                    <td class="text-center">
                                        <div class="">
                                            <div class="dropdown">
                                                <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <?php if($val->active==1): ?>
                                                        <a class='dropdown-item' href="<?php echo e(route('product.unpublish', ['id' => $val->id])); ?>"><?php echo e(__('Unsuspend')); ?></a>
                                                    <?php else: ?>
                                                        <a class='dropdown-item' href="<?php echo e(route('product.publish', ['id' => $val->id])); ?>"><?php echo e(__('Suspend')); ?></a>
                                                    <?php endif; ?>
                                                    <a class="dropdown-item" href="<?php echo e(route('admin.orders', ['id' => $val->id])); ?>"><?php echo e(__('Orders')); ?></a>
                                                    <a data-toggle="modal" data-target="#delete<?php echo e($val->id); ?>" href="" class="dropdown-item"><?php echo e(__('Delete')); ?></a>
                                                </div>
                                            </div>
                                        </div> 
                                    </td>                  
                                </tr>
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
                                                        <a  href="<?php echo e(route('product.delete', ['id' => $val->id])); ?>" class="btn btn-danger btn-sm"><?php echo e(__('Proceed')); ?></a>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/boompay/core/resources/views/admin/transfer/product.blade.php ENDPATH**/ ?>