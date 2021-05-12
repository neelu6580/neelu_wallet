<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <div class="">
          <div class="card-body">
            <div class="">
              <a data-toggle="modal" data-target="#donation-page" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> <?php echo e(__('Donation Page')); ?></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">   
        <div class="modal fade" id="donation-page" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                  <div class="card-header">
                    <h3 class="mb-0"><?php echo e(__('Create New Donation Link')); ?></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <span class="form-text text-xs">Create a donation page for your customers, Transaction Charge is <?php echo e($set->donation_charge); ?>% per donation</span>

                  </div>
                  <div class="card-body">
                    <form action="<?php echo e(route('submit.donationpage')); ?>"enctype="multipart/form-data" method="post" id="modal-detailx">
                      <?php echo csrf_field(); ?>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="col-form-label col-lg-12"><?php echo e(__('Name')); ?><span class="text-danger">*</span></label>
                                <div class="col-lg-12">
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="col-form-label col-lg-12"><?php echo e(__('Goal')); ?></label>
                                <div class="col-lg-12">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                        </span>
                                        <input type="number" class="form-control" name="goal" placeholder="0.00" required>
                                        <span class="input-group-append">
                                            <span class="input-group-text">.00</span>
                                        </span>
                                    </div>
                                </div>
                            </div>  
                        </div> 
                        <div class="form-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFileLang" name="image" accept="image/*" required>
                            <label class="custom-file-label" for="customFileLang"><?php echo e(__('Image')); ?></label>
                          </div> 
                        </div>    
                        <div class="form-group row">
                          <label class="col-form-label col-lg-12"><?php echo e(__('Description')); ?><span class="text-danger">*</span></label>
                          <div class="col-lg-12">
                              <textarea type="text" name="description" rows="6" class="tinymce form-control"></textarea>
                          </div>
                        </div>  
                        <div class="text-right">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btn-sm" form="modal-detailx"><?php echo e(__('Create Page')); ?></button>
                        </div>         
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> 
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="row">  
          <?php if(count($links)>0): ?>
            <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-md-4">
                <div class="card bg-white">
                  <?php 
                  $donors=App\Models\Donations::wheredonation_id($val->id)->wherestatus(1)->get();
                  $donated=App\Models\Donations::wheredonation_id($val->id)->wherestatus(1)->sum('amount');
                  ?>
                    <div class="card-body">
                      <div class="row mb-2">
                        <div class="col-8">
                          <button type="button" class="btn btn-sm btn-neutral mr-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </button>
                          <div class="dropdown-menu dropdown-menu-left">
                            <?php if($val->active==1): ?>
                                <a class='dropdown-item' href="<?php echo e(route('dplinks.unpublish', ['id' => $val->id])); ?>"><?php echo e(__('Disable')); ?></a>
                            <?php else: ?>
                                <a class='dropdown-item' href="<?php echo e(route('dplinks.publish', ['id' => $val->id])); ?>"><?php echo e(__('Activate')); ?></a>
                            <?php endif; ?>
                            <a class="dropdown-item" href="<?php echo e(route('user.sclinkstrans', ['id' => $val->id])); ?>"><?php echo e(__('Transactions')); ?></a>
                            <a class="dropdown-item" data-toggle="modal" data-target="#donors<?php echo e($val->id); ?>" href="#"><?php echo e(__('Donors')); ?></a>
                            <a class="dropdown-item" data-toggle="modal" data-target="#edit<?php echo e($val->id); ?>" href="#"><?php echo e(__('Edit')); ?></a>
                            <a class="dropdown-item" data-toggle="modal" data-target="#delete<?php echo e($val->id); ?>" href=""><?php echo e(__('Delete')); ?></a>
                          </div>
                        </div>                        
                        <div class="col-4 text-right">
                            <?php if($val->active==1): ?>
                                <span class="badge badge-pill badge-success"><?php echo e(__('Active')); ?></span>
                            <?php else: ?>
                                <span class="badge badge-pill badge-danger"><?php echo e(__('Disabled')); ?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-auto">
                          <a href="javascript:void;" class="avatar avatar-l">
                            <img class="" src="<?php echo e(url('/')); ?>/asset/profile/<?php echo e($val->image); ?>" alt="Image placeholder">
                          </a>
                        </div>
                        <div class="col">
                          <h5 class="h4 mb-0 text-dark"><?php echo e($val->name); ?></h5>
                          <p class="text-sm text-dark mb-0"><?php echo e(__('Donors')); ?>: (<?php echo e(count($donors)); ?>)</p>
                          <p class="text-sm text-dark mb-0"><?php echo e(__('Amount')); ?>: <?php echo e($currency->symbol.number_format($donated)); ?>/<?php echo e($currency->symbol.number_format($val->amount)); ?></p>
                          <p class="text-sm text-dark mb-0"><?php echo e(__('Date')); ?>: <?php echo e(date("h:i:A j, M Y", strtotime($val->created_at))); ?></p>
                          <p class="text-sm text-dark mb-2"><a class="btn-icon-clipboard text-primary" data-clipboard-text="<?php echo e(route('dpview.link', ['id' => $val->ref_id])); ?>" title="Copy"><?php echo e(__('COPY LINK')); ?></a></p>
                        </div>
                      </div>
                      <div class="row justify-content-between align-items-center">
                        <div class="col">
                            <div class="progress progress-xs mb-0">
                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e(($donated*100)/$val->amount); ?>%;"></div>
                            </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>             
              <div class="modal fade" id="edit<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-body p-0">
                      <div class="card bg-white border-0 mb-0">
                        <div class="card-header">
                          <h3 class="mb-0"><?php echo e(__('Edit Payment')); ?></h3>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">
                          <form action="<?php echo e(route('update.dplinks')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                              <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="col-form-label col-lg-12"><?php echo e(__('Name')); ?><span class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <input type="text" name="name" class="form-control" value="<?php echo e($val->name); ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label class="col-form-label col-lg-12"><?php echo e(__('Goal')); ?></label>
                                    <div class="col-lg-12">
                                        <div class="input-group">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                            </span>
                                            <input type="number" class="form-control" name="goal" value="<?php echo e($val->amount); ?>" min="<?php echo e($donated); ?>" placeholder="0.00" required>
                                            <span class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>  
                            </div>  
                            <div class="form-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFileLang" name="image" accept="image/*">
                                <label class="custom-file-label" for="customFileLang"><?php echo e(__('Image')); ?></label>
                              </div> 
                            </div> 
                            <div class="form-group row">
                              <label class="col-form-label col-lg-12"><?php echo e(__('Description')); ?><span class="text-danger">*</span></label>
                              <div class="col-lg-12">
                                  <textarea type="text" name="description" rows="5" class="tinymce form-control" required><?php echo e($val->description); ?></textarea>
                              </div>
                            </div>   
                            <input type="hidden" name="id" value="<?php echo e($val->id); ?>">                                     
                            <div class="text-right">
                              <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Save')); ?></button>
                            </div>
                          </form>
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
              <div class="modal fade" id="delete<?php echo e($val->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                  <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                      <div class="modal-content">
                          <div class="modal-body p-0">
                              <div class="card bg-white border-0 mb-0">
                                  <div class="card-header">
                                      <span class="mb-0 text-sm"><?php echo e(__('Are you sure you want to delete this?, all transaction related to this payment link will also be deleted')); ?></span>
                                  </div>
                                  <div class="card-body px-lg-5 py-lg-5 text-right">
                                      <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                      <a  href="<?php echo e(route('delete.user.link', ['id' => $val->id])); ?>" class="btn btn-danger btn-sm"><?php echo e(__('Proceed')); ?></a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php else: ?>
            <div class="col-md-12">
              <p class="text-center text-muted card-text mt-8">No Donation Page Found</p>
            </div>
          <?php endif; ?>
        </div> 
        <div class="row">
          <div class="col-md-12">
          <?php echo e($links->links()); ?>

          </div>
        </div>
      </div> 
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/greenvx4/public_html/vcard/core/resources/views/user/link/dp.blade.php ENDPATH**/ ?>