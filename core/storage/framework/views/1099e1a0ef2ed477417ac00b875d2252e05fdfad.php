<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0"><?php echo e(__('Orders')); ?></h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('S/N')); ?></th>
                                    <th><?php echo e(__('Ref')); ?></th>
                                    <th><?php echo e(__('Buyer')); ?></th>
                                    <th><?php echo e(__('Vendor')); ?></th>
                                    <th><?php echo e(__('Product Name')); ?></th>
                                    <th><?php echo e(__('Amount')); ?></th>
                                    <th><?php echo e(__('Total')); ?></th>
                                    <th><?php echo e(__('Charge')); ?></th>
                                    <th><?php echo e(__('Quantity')); ?></th>
                                    <th><?php echo e(__('Shipping fee')); ?></th>
                                    <th><?php echo e(__('Address')); ?></th>                                                               
                                    <th><?php echo e(__('Country')); ?></th>                                                               
                                    <th><?php echo e(__('State')); ?></th>                                                               
                                    <th><?php echo e(__('Town')); ?></th>                                                               
                                    <th><?php echo e(__('First Name')); ?></th>                                                               
                                    <th><?php echo e(__('Last Name')); ?></th>                                                               
                                    <th><?php echo e(__('Email')); ?></th>                                                               
                                    <th><?php echo e(__('Phone')); ?></th>                                                               
                                    <th><?php echo e(__('Created')); ?></th>
                                    <th><?php echo e(__('Updated')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(++$k); ?>.</td>
                                    <td>#<?php echo e($val->ref_id); ?></td>
                                    <td><?php echo e($val->seller->business_name); ?></td>
                                    <td><?php echo e($val->first_name.' '.$val->last_name); ?></td>
                                    <td><?php echo e($val->lala->name); ?></td>
                                    <td><?php echo e($currency->symbol.number_format($val->amount)); ?></td>
                                    <td><?php echo e($currency->symbol.number_format($val->total)); ?></td>
                                    <td><?php echo e($currency->symbol.number_format($val->charge)); ?></td>
                                    <td><?php echo e($val->quantity); ?></td>
                                    <td><?php echo e($currency->symbol.number_format($val->shipping_fee)); ?></td>
                                    <td><?php echo e($val->address); ?></td>                                    
                                    <td><?php echo e($val->country); ?></td>                                    
                                    <td><?php echo e($val->state); ?></td>                                    
                                    <td><?php echo e($val->town); ?></td>                                    
                                    <td><?php echo e($val->first_name); ?></td>                                    
                                    <td><?php echo e($val->last_name); ?></td>                                    
                                    <td><?php echo e($val->email); ?></td>                                    
                                    <td><?php echo e($val->phone); ?></td>                                    
                                    <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></td>  
                                    <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->updated_at))); ?></td>                  
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
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/admin/transfer/orders.blade.php ENDPATH**/ ?>