<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                                        <div><a  style="float:right;margin-top:30px!important;margin-right:20px" href="<?php echo e(url('admin/virtual_cards')); ?>" class="btn btn-primary"><?php echo e(__('Go Back')); ?></a></div>

                    <div class="card-header">
                        <h3 class="card-title"><?php echo e(__('Transactions List')); ?></h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                            <thead>
                                <tr>
                                  <th>S / N</th>
                                  <th>User Name</th>
                                  <th>Name on Card</th>
                                  <th>Last Four</th>
                                  <th>Amount</th>
                                  <!--th>Spend Limit</th-->
                                  <th>Status</th>
                                  <th>Authorized</th>
                                  <th>Funded on</th>
                                  <th>Bank</th>
                                 
                                </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $AllTransactionsList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$TransactionsDetails): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <tr>
                <td><?php echo e(++$k); ?></td>
                <td>
                    <?php $virtualCardUserData = DB::table('virtual_cards')->where('last_four_digit',$TransactionsDetails->card->last_four)->first();?>
                    <?php if(!empty($virtualCardUserData)): ?>
                    <?php $UserData = DB::table('users')->where('id',$virtualCardUserData->user_id)->first();?>
                    <?php echo e($UserData->first_name); ?> <?php echo e($UserData->last_name); ?>

                    <?php else: ?>
                    <?php echo e('NA'); ?>

                    <?php endif; ?>
                </td>
                <td><?php echo e($TransactionsDetails->card->memo); ?></td>
                <td>XXXX XXXX XXXX <?php echo e($TransactionsDetails->card->last_four); ?></td>
                  <td><?php echo e($currency->symbol.number_format($TransactionsDetails->amount/100)); ?> / <?php echo e($currency->symbol.number_format($TransactionsDetails->card->spend_limit/100)); ?></td>
                 <!--td><?php echo e($currency->symbol.number_format($TransactionsDetails->card->spend_limit)); ?></td-->
                  <td><?php echo e($TransactionsDetails->status); ?></td>
                   <td><?php echo e(date("Y/m/d h:i:A", strtotime($TransactionsDetails->created))); ?></td>
                    <td><?php echo e(date("Y/m/d h:i:A", strtotime($TransactionsDetails->card->funding->created))); ?></td>
                     <td><?php echo e($TransactionsDetails->card->funding->account_name); ?></td>
                 </tr>        
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
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/greenvx4/public_html/vcard/core/resources/views/admin/user/virtualcardsTransactions.blade.php ENDPATH**/ ?>