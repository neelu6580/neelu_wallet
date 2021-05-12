<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                                        <div><a  style="float:right;margin-top:30px!important;margin-right:20px" href="<?php echo e(url('admin/virtual_cards_transactions')); ?>" class="btn btn-primary"><?php echo e(__('Transactions List')); ?></a></div>

                    <div class="card-header">
                        <h3 class="card-title"><?php echo e(__('List of All Virtual Cards')); ?></h3>
                        
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('S/N')); ?></th>
                                    <th><?php echo e(__('Username')); ?></th>
                                    <th><?php echo e(__('Name on Card')); ?></th>
                                    <th><?php echo e(__('Spend Limit')); ?></th>                                                                     
                                    <th><?php echo e(__('Last 4 Digit')); ?></th>
                                    <th><?php echo e(__('Exp')); ?></th>
                                    <th><?php echo e(__('Funding Acct No')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('Date')); ?></th>
                                    <th><?php echo e(__('Last Update')); ?></th>
                                    <th class="text-center"><?php echo e(__('Action')); ?></th>    
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $virtualCardsList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $cardDetails): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <td><?php echo e(++$k); ?>.</td>
                                    <td><a href="<?php echo e(url('admin/manage-user')); ?>/<?php echo e($cardDetails->user_id); ?>"><?php echo e($cardDetails->FirstName); ?> <?php echo e($cardDetails->LastName); ?></a></td>
                                    <td><?php echo e($cardDetails->memo); ?></td>
                                    <td><?php echo e($currency->symbol.number_format($cardDetails->spend_limit)); ?></td>
                                    
                                    <td>XXXX XXXX XXXX <?php echo e($cardDetails->last_four_digit); ?></td>
                                    <td><?php echo e($cardDetails->exp_month); ?>/<?php echo e($cardDetails->exp_year); ?></td>
                                    <td>XXXXXXXX<?php echo e($cardDetails->FundingLastFour); ?></td>
                                    <td>
                                        <?php if($cardDetails->card_state== 'PAUSED'): ?>
                                            <span class="badge badge-pill badge-primary"><?php echo e(__('Inactive')); ?></span>
                                        <?php elseif($cardDetails->card_state== 'OPEN'): ?>
                                            <span class="badge badge-pill badge-success"><?php echo e(__('Active')); ?></span>
                                        <?php elseif($cardDetails->card_state== 'CLOSED'): ?>
                                            <span class="badge badge-pill badge-danger"><?php echo e(__('Closed')); ?></span>    
                                        
                                        <?php endif; ?>
                                    </td> 
                                    <td><?php echo e(date("Y/m/d h:i:A", strtotime($cardDetails->created_at))); ?></td>
                                    <td><?php echo e(date("Y/m/d h:i:A", strtotime($cardDetails->updated_at))); ?></td>
                                    <td class="text-center">
                                        <div class="">
                                            <div class="dropdown">
                                                <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a href="<?php echo e(route('admin.virtualtransactions', ['id' => $cardDetails->token])); ?>" class="dropdown-item"><i class="fa fa-list"></i><?php echo e(__('Transactons')); ?></a>
                                                    <a data-toggle="modal" data-target="#edit<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item"><i class="fa fa-pen"></i><?php echo e(__('Edit')); ?></a>

                                                    <?php if($cardDetails->card_state == 'OPEN'): ?>
                                                    <a data-toggle="modal" data-target="#pause<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item"><i class="fa fa-pause-circle"></i><?php echo e(__('Pause')); ?></a>
                                                    <?php endif; ?>
                                                    <?php if($cardDetails->card_state == 'PAUSED'): ?>
                                                    <a data-toggle="modal" data-target="#unpause<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item"><i class="fa fa-play-circle"></i><?php echo e(__('Unpause')); ?></a>
                                                    <?php endif; ?>
                                                     <?php if($cardDetails->card_state != 'CLOSED'): ?>
                                                    <a data-toggle="modal" data-target="#close<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item"><i class="fa fa-trash"></i><?php echo e(__('Close')); ?></a>
                                                    <?php endif; ?>
                                                    <?php if($cardDetails->card_state == 'CLOSED'): ?>
                                                    <a data-toggle="modal" data-target="#delete<?php echo e($cardDetails->id); ?>" href="" class="dropdown-item"><i class="fa fa-times-circle" aria-hidden="true"></i><?php echo e(__('Delete')); ?></a>
                                                    <?php endif; ?>
                                                    
                                                </div>
                                            </div>
                                        </div> 
                                    </td>                    
                                </tr>
                                <div class="modal fade" id="edit<?php echo e($cardDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0"><?php echo e(__($cardDetails->FirstName)); ?> <?php echo e(__($cardDetails->LastName)); ?> <?php echo e(__('Card Details')); ?> <?php echo e('('); ?><?php echo e(__($cardDetails->last_four_digit)); ?><?php echo e(')'); ?></h3>
                                                    </div>
                                                      <form action="<?php echo e(route('admin.edit_virtual_card')); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="user_id" value="<?php echo e($cardDetails->user_id); ?>">
                                                        <input type="hidden" name="card_token" value="<?php echo e($cardDetails->token); ?>">
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                <?php echo e(__('Card Number')); ?></label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <input class="form-control" type="text" name="pan" placeholder="e.g. 4111186115678945" minlength="16" maxlength="16" value="<?php echo e($cardDetails->pan); ?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                                            </div>
                                                        </div>
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                <?php echo e(__('Card Exp Months')); ?></label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <input class="form-control" type="number" name="exp_month" placeholder="e.g. 03" minlength="2" maxlength="2" value="<?php echo e($cardDetails->exp_month); ?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                                            </div>
                                                        </div>
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                <?php echo e(__('Card Exp Year')); ?></label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <input class="form-control" type="number" name="exp_year" placeholder="e.g. 2024" minlength="4" maxlength="4" value="<?php echo e($cardDetails->exp_year); ?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
                                                            </div>
                                                        </div>
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                <?php echo e(__('Card CVV')); ?></label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <input class="form-control" type="number" name="cvv" placeholder="e.g. 123" minlength="3" maxlength="3" value="<?php echo e($cardDetails->cvv); ?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>
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
                                <div class="modal fade" id="close<?php echo e($cardDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0"><?php echo e(__('Are you sure you want to closed this?')); ?></h3>
                                                    </div>
                                                    <form action="<?php echo e(route('admin.close_virtual_card')); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="user_id" value="<?php echo e($cardDetails->user_id); ?>">
                                                        <input type="hidden" name="card_token" value="<?php echo e($cardDetails->token); ?>">
                                                    <div class="card-body px-lg-5 py-lg-5 text-right">
                                                        <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                                        <button  type="submit" class="btn btn-danger btn-sm"><?php echo e(__('Closed Now')); ?></button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="unpause<?php echo e($cardDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0"><?php echo e(__('Are you sure you want to unpause this?')); ?></h3>
                                                    </div>
                                                    <form action="<?php echo e(route('admin.open_virtual_card')); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="user_id" value="<?php echo e($cardDetails->user_id); ?>">
                                                        <input type="hidden" name="card_token" value="<?php echo e($cardDetails->token); ?>">
                                                    <div class="card-body px-lg-5 py-lg-5 text-right">
                                                        <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                                        <button  type="submit" class="btn btn-danger btn-sm"><?php echo e(__('Unpause Now')); ?></button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="pause<?php echo e($cardDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0"><?php echo e(__('Are you sure you want to pause this?')); ?></h3>
                                                    </div>
                                                    <form action="<?php echo e(route('admin.pause_virtual_card')); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="user_id" value="<?php echo e($cardDetails->user_id); ?>">
                                                        <input type="hidden" name="card_token" value="<?php echo e($cardDetails->token); ?>">
                                                    <div class="card-body px-lg-5 py-lg-5 text-right">
                                                        <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                                        <button  type="submit" class="btn btn-danger btn-sm"><?php echo e(__('Pause Now')); ?></button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="delete<?php echo e($cardDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0"><?php echo e(__('Are you sure you want to delete this?')); ?></h3>
                                                    </div>
                                                    <div class="card-body px-lg-5 py-lg-5 text-right">
                                                        <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                                        <a  href="<?php echo e(route('admin.delete_virtual_card', ['id' => $cardDetails->id])); ?>" class="btn btn-danger btn-sm"><?php echo e(__('Proceed')); ?></a>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/admin/user/virtualcard.blade.php ENDPATH**/ ?>