<?php $__env->startSection('content'); ?>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="card">
      <div class="card-header header-elements-inline">
        <h3 class="mb-0"><?php echo e(__('Single Charge')); ?></h3>
      </div>
      <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-buttons">
          <thead>
            <tr>
              <th><?php echo e(__('S / N')); ?></th>
              <th><?php echo e(__('Merchant')); ?></th>
              <th><?php echo e(__('Name')); ?></th>
              <th><?php echo e(__('Donors')); ?></th>
              <th><?php echo e(__('Amount')); ?></th>
              <th><?php echo e(__('Reference ID')); ?></th>
              <th><?php echo e(__('Status')); ?></th>
              <th><?php echo e(__('Suspended')); ?></th>
              <th><?php echo e(__('Created')); ?></th>
              <th><?php echo e(__('Updated')); ?></th>
              <th><?php echo e(__('Link')); ?></th>
              <th></th>
            </tr>
          </thead>
          <tbody>  
            <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php 
                  $donors=App\Models\Donations::wheredonation_id($val->id)->wherestatus(1)->get();
                  $donated=App\Models\Donations::wheredonation_id($val->id)->wherestatus(1)->sum('amount');
                  ?>
              <tr>
                <td><?php echo e(++$k); ?>.</td>
                <td><?php if($val->user['business_name']==null): ?> [Deleted] <?php else: ?> <?php echo e($val->user['business_name']); ?> <?php endif; ?></td>
                <td><?php echo e($val->name); ?></td>
                <td><?php echo e(count($donors)); ?></td>
                <td><?php echo e($currency->symbol.number_format($donated)); ?>/<?php echo e($currency->symbol.number_format($val->amount)); ?></td>
                <td>#<?php echo e($val->ref_id); ?></td>
                <td>
                    <?php if($val->active==1): ?>
                        <span class="badge badge-pill badge-success"><?php echo e(__('Active')); ?></span>
                    <?php else: ?>
                        <span class="badge badge-pill badge-danger"><?php echo e(__('Disabled')); ?></span>
                    <?php endif; ?>
                </td>                
                <td>
                    <?php if($val->status==1): ?>
                        <span class="badge badge-pill badge-success"><?php echo e(__('Yes')); ?></span>
                    <?php else: ?>
                        <span class="badge badge-pill badge-danger"><?php echo e(__('No')); ?></span>
                    <?php endif; ?>
                </td>
                <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></td>
                <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->updated_at))); ?></td>
                <td><?php echo e(route('scview.link', ['id' => $val->ref_id])); ?></td>
                <td class="text-center">
                    <div class="">
                        <div class="dropdown">
                            <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <?php if($val->status==1): ?>
                                    <a class='dropdown-item' href="<?php echo e(route('links.unpublish', ['id' => $val->id])); ?>"><?php echo e(__('Unsuspend')); ?></a>
                                <?php else: ?>
                                    <a class='dropdown-item' href="<?php echo e(route('links.publish', ['id' => $val->id])); ?>"><?php echo e(__('Suspend')); ?></a>
                                <?php endif; ?>
                                <a class="dropdown-item" href="<?php echo e(route('admin.linkstrans', ['id' => $val->id])); ?>"><?php echo e(__('Transactions')); ?></a>
                                <a data-toggle="modal" data-target="#delete<?php echo e($val->id); ?>" href="" class="dropdown-item"><?php echo e(__('Delete')); ?></a>
                                <a data-toggle="modal" data-target="#description<?php echo e($val->id); ?>" href="" class="dropdown-item"><?php echo e(__('Description')); ?></a>
                                <a class="dropdown-item" data-toggle="modal" data-target="#donors<?php echo e($val->id); ?>" href="#"><?php echo e(__('Donors')); ?></a>
                            </div>
                        </div>
                    </div> 
                </td>
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
                                        <a  href="<?php echo e(route('delete.link', ['id' => $val->id])); ?>" class="btn btn-danger btn-sm"><?php echo e(__('Proceed')); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
                <div class="modal fade" id="description<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card bg-white border-0 mb-0">
                                    <img class="card-img-top" src="<?php echo e(url('/')); ?>/asset/profile/<?php echo e($val->image); ?>" alt="Image placeholder">
                                    <div class="card-body">
                                        <p class="mb-0 text-sm"><?php echo e($val->description); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="donors<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                  <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                      <div class="modal-content">
                          <div class="modal-body p-0">
                              <div class="card bg-white border-0 mb-0">
                                  <div class="card-body px-lg-5 py-lg-5">
                                    <ul class="list-group list-group-flush list my--3">
                                      <?php if(count($donors)>0): ?>
                                        <?php $__currentLoopData = $donors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$xval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="list-group-item px-0">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <div class="icon icon-shape text-white rounded-circle bg-success">
                                                        <i class="fa fa-bookmark-o"></i>
                                                    </div>
                                                </div>
                                                <div class="col ml--2">
                                                <h4 class="mb-0">
                                                    <?php if($xval->anonymous==0): ?> 
                                                      <?php if($xval->user_id==null): ?>
                                                          <?php
                                                              $fff=App\Models\Transactions::whereref_id($xval->ref_id)->first();
                                                          ?>
                                                          <?php echo e($fff['first_name'].' '.$fff['last_name']); ?>

                                                      <?php endif; ?>
                                                      <?php echo e($xval->user['first_name'].' '.$xval->user['last_name']); ?> 
                                                    <?php else: ?> 
                                                      Anonymous 
                                                    <?php endif; ?>
                                                </h4>
                                                <small><?php echo e($currency->symbol.$xval->amount); ?> @ <?php echo e(date("h:i:A j, M Y", strtotime($xval->created_at))); ?></small>
                                                </div>
                                            </div>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <?php else: ?>
                                        <li class="list-group-item px-0"><p class="text-sm">No Donors</p></li>
                                      <?php endif; ?>
                                    </ul>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>   
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/boompay/core/resources/views/admin/transfer/dp.blade.php ENDPATH**/ ?>