<?php $__env->startSection('content'); ?>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="card">
      <div class="card-header header-elements-inline">
        <h3 class="mb-0">Card Transaction History</h3>
      </div>
      <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-buttons">
          <thead>
            <tr>
              <th>S / N</th>
              <th>Name on Card</th>
              <th>Last Four</th>
              <th>Amount</th>
              <!--th>Spend Limit</th-->
              <th>Status</th>
             
              <th>Funded on</th>
              <th>Bank</th>
               <th>Authorized</th>
             
            </tr>
          </thead>
          <tbody>  

              <!--tr>
                <td>1</td>
                 <td>AMAZON - GROCERY</td>
                  <td>$9.35</td>
                   <td>Settled</td>
                    <td>Mar 9, 2021, 5:42AM</td>
                     <td>Mar 11, 2021</td>
                      <td>Mercury Checking</td>
            </tr-->
           
                <?php $__currentLoopData = $AllTransactionsList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$TransactionsDetails): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($TransactionsDetails->card->token == $card_last_four_by_url): ?> 
                <?php $virtualCardUserData = DB::table('virtual_cards')->where('token',$card_last_four_by_url)->first();?>
                    <?php if(!empty($virtualCardUserData) && $virtualCardUserData->user_id == Auth::id()): ?>
                    
                 <tr>
                <td><?php echo e(++$k); ?></td>
                <td><?php echo e($TransactionsDetails->card->memo); ?></td>
                <td>XXXX XXXX XXXX <?php echo e($TransactionsDetails->card->last_four); ?></td>
                  <td><?php echo e($currency->symbol.number_format($TransactionsDetails->amount/100)); ?> / <?php echo e($currency->symbol.number_format($TransactionsDetails->card->spend_limit/100)); ?></td>
                 <!--td><?php echo e($currency->symbol.number_format($TransactionsDetails->card->spend_limit)); ?></td-->
                  <td><?php echo e($TransactionsDetails->status); ?></td>
                   
                    <td><?php echo e(date("Y/m/d h:i:A", strtotime($TransactionsDetails->card->funding->created))); ?></td>
                     <td><?php echo e($TransactionsDetails->card->funding->account_name); ?></td>
                     <td><?php echo e(date("Y/m/d h:i:A", strtotime($TransactionsDetails->created))); ?></td>
                 </tr> 
                 <?php endif; ?>
                <?php endif; ?> 
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
           
          </tbody>
        </table>
      </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/user/virtualtransactions/index.blade.php ENDPATH**/ ?>