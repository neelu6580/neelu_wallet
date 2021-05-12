<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Carriers</h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                            <thead>
            					<tr>
            					    <th>S. No.</th>
            						<th>Object</th>
            						<th>Type</th>
            						<th>Readable</th>
            						<th>Logo</th>
            						<th>Access Key Id</th>
            						<th>Secret Key</th>
            						<th>Merchant Id</th>
            						<th>Status</th>
            						<th>Action</th>
            					</tr>
            				</thead>
            				<tbody>
            					<?php $__currentLoopData = $carriers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            						<tr>
            						    <td><?php echo e(++$k); ?></td>
            						    <td><?php echo e($data->object); ?></td>
            						    <td><?php echo e($data->type); ?></td>
            						    <td><?php echo e($data->readable); ?></td>
            						    <td><?php echo e($data->logo); ?></td>
            						    <td><?php echo e($data->access_key_id); ?></td>
            						    <td><?php echo e($data->secret_key); ?></td>
            						    <td><?php echo e($data->merchant_id); ?></td>
            						    <td>
            						        <?php if($data->status == 1): ?>
            						            Active
            						        <?php else: ?>
            						            Inactive
            						        <?php endif; ?>
            						    </td>
            						   
            						    <td class="text-center">
                                            <div class="">
                                                <div class="dropdown">
                                                    <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a data-toggle="modal" data-target="#description<?php echo e($data->id); ?>" href="" class="dropdown-item">Edit</a>
                                                    </div>
                                                </div>
                                            </div> 
                                        </td> 
            						</tr>
                                    <div class="modal fade" id="description<?php echo e($data->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                        <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body p-0">
                                                    <div class="card bg-white border-0 mb-0">
                                                        <div class="card-body">
                                                            <form method="Post" action="<?php echo e(route('admin.carriers.update', $data->id)); ?>">
                                                                <?php echo csrf_field(); ?>
                                                                <div class="form-group">
                                                                    <label>Status</label>
                                                                    <select class="form-control makeSlug" name="status">
                                                                        <option value="1">Active</option>
                                                                        <option value="0">Inctive</option>
                                                                    </select>
                                                                  <div class="help-block with-errors"></div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-primary">Submit</button>
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
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/admin/shipment/carrier.blade.php ENDPATH**/ ?>