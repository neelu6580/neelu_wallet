<?php $__env->startSection('content'); ?>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <div class="">
          <div class="card-body">
            <div class="">
              <!--a data-toggle="modal" data-target="#create-plan" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> <?php echo e(__('Plan')); ?></a-->
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="modal fade" id="create-plan" tabindex="-1" role="dialog" aria-labelledby="create-plan" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
              <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                  <div class="card-header">
                    <h3 class="mb-0"><?php echo e(__('Create New Plan')); ?></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="card-body">
                    <form action="<?php echo e(route('submit.plan')); ?>" method="post" id="modal-details">
                      <?php echo csrf_field(); ?>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12"><?php echo e(__('Plan Name')); ?><span class="text-danger">*</span></label>
                            <div class="col-lg-12">
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12"><?php echo e(__('Amount')); ?></label>
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text"><?php echo e($currency->symbol); ?></span>
                                    </span>
                                    <input type="number" class="form-control" name="amount" placeholder="0.00" min="10">
                                    <span class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </span>
                                </div>
                                <span class="form-text text-xs">Leave empty to allow customers enter desired amount</span>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label class="col-form-label col-lg-12"><?php echo e(__('Interval')); ?></label>
                            <div class="col-lg-12">
                                <select class="form-control select" name="interval">
                                    <option value="1 Hour"><?php echo e(__('Hourly')); ?></option>
                                    <option value="1 Day"><?php echo e(__('Daily')); ?></option>
                                    <option value="1 Week"><?php echo e(__('Weekly')); ?></option>
                                    <option value="1 Month"><?php echo e(__('Monthly')); ?></option>
                                    <option value="4 Months"><?php echo e(__('Quaterly')); ?></option>
                                    <option value="6 Months"><?php echo e(__('Every 6 Months')); ?></option>
                                    <option value="1 Year"><?php echo e(__('Yearly')); ?></option>
                                </select>
                            </div>
                        </div>           
                        <div class="form-group row">
                          <label class="col-form-label col-lg-12"><?php echo e(__('Number of times to charge a subscriber?')); ?></label>
                          <div class="col-lg-12">
                              <input type="text" name="times" class="form-control">
                              <span class="form-text text-xs">Leave empty to charge subscriber indefinitely</span>
                          </div>
                        </div> 
                        <div class="text-right">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btn-sm" form="modal-details"><?php echo e(__('Create plan')); ?></button>
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
    <div class="card">
      <div class="card-header header-elements-inline">
        <h3 class="mb-0"><?php echo e(__('Orders')); ?></h3>
      </div>
      <div class="table-responsive py-4">
        <table class="table table-flush" id="datatable-buttons">
          <thead>
            <tr>
              <th><?php echo e(__('S / N')); ?></th>
              <th><?php echo e(__('Order Ref No')); ?></th>
              <th><?php echo e(__('User Name')); ?></th>
              <th><?php echo e(__('Plan name')); ?></th>
              <th><?php echo e(__('Card Quantity')); ?></th>
              <th><?php echo e(__('Card Design')); ?></th>
              <th><?php echo e(__('Amount')); ?></th>
              <th><?php echo e(__('Status')); ?></th>
              <th><?php echo e(__('Created')); ?></th>
              <th><?php echo e(__('Updated')); ?></th>
             
            </tr>
          </thead>
          <tbody>  
            <?php $__currentLoopData = $virtualCardsOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$OrderDetails): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
              <tr>
                  <td><?php echo e(++$k); ?>.</td>
                  <td><?php echo e($OrderDetails->order_ref_no); ?></td>
                   <td><?php echo e($OrderDetails->first_name); ?> <?php echo e($OrderDetails->last_name); ?></td>
                  <td><?php if(!empty($OrderDetails->plan_id)): ?>
                       <?php $planDetails = DB::table('virtual_cards_plan')->where('id',$OrderDetails->plan_id)->first(); ?>
                      <?php echo e($planDetails->plan_name); ?>

                      <?php endif; ?>
                  
                  </td>
                  <td><?php echo e($planDetails->plan_quantity); ?> <?php echo e(__('Cards')); ?></td>
                  <td><?php if(!empty($OrderDetails->design_id)): ?>
                       <?php $designDetails = DB::table('virtual_cards_design')->where('id',$OrderDetails->design_id)->first(); ?>
                      
                      
<head>
        <style>
.surtitle {
    margin-bottom: 0;
    letter-spacing: 0.5px;
    text-transform: uppercase;
       color: #ffffff !important;

    font-size: 12px;
}

.card-body<?php echo e($designDetails->id); ?> {
    padding: 0.5rem 1rem;
    flex: 1 1 auto;
    border-radius: 15px;
    height:100px;
    background: <?php echo e($designDetails->class_name); ?>;
}


    .newicon{text-align: center;
    padding: 8px 16px;}
    .newicon1{    padding: 36px 10px;
    border-radius: 50px;}
    .mainsearch{    width: 94%;
    border:1px solid #f3f3f3;
    padding: 8px;
    border-radius: 8px;}
    .mainbtn{    border: 1px solid #e1e1e1;
    padding: 7px 9px;
    border-radius: 6px;}
    .searchf{      padding-bottom: 15px;
    padding-top: 15px;}
    .di{margin: 0px auto;
    padding: 14px;
    background: #f1f1f1;
    width: 50%;
    border-radius: 30px;}
    .boxbg{    background: white;
    border-radius: 10px;
    margin-bottom: 20px;}
    
</style>
</head> 
                      <div class="card-body<?php echo e($designDetails->id); ?>">
                          
              <div class="">
                <span class="h6 surtitle text-gray" style="    color: #ffffff !important;">
                <?php echo e(__('Jhon Deo')); ?>

                </span>
                
                  <div  style="color: #ffffff !important;">XXXX XXXX XXXX  7086</div>
               
              </div>
              <div class="row">               
                <div class="col">
                  <span class="h6 surtitle text-gray">Monthly Limit</span><br>
                  <span class="text-primary" style="
    font-size: 13px;color: #ffffff !important;">$0 / <span class="text-gray" style="color: #ffffff !important;">$0</span></span>
                </div>
                <!--div class="col" data-toggle="modal" data-target="#modal-more15" style="cursor: pointer;">
                  <span class="h6 surtitle text-gray">CVV</span><br>
                  <span class="text-primary"></span>
                </div-->     
                <div class="col">
                    <img src="https://cuminup.com/asset/images/visa.svg" style="width:200%;margin-top:15px;margin-left: -10px;">
                    </div>
              </div>
             
            </div>
                      
                      <?php endif; ?>
                      </td>
                  <td><?php echo e($currency->symbol.number_format($OrderDetails->amount,2)); ?></td>
                  <td><?php if($OrderDetails->status==0): ?> <span class="badge badge-pill badge-danger">Inactive</span> <?php elseif($OrderDetails->status==1): ?> <span class="badge badge-pill badge-success">Placed</span><?php endif; ?></td>
                  <td><?php echo e(date("Y/m/d h:i:A", strtotime($OrderDetails->created_at))); ?></td>
                   <td><?php echo e(date("Y/m/d h:i:A", strtotime($OrderDetails->updated_at))); ?></td>
                  <!--td><a class="btn-icon-clipboard text-primary" data-clipboard-text="<?php echo e(route('subview.link', ['id' => $OrderDetails->id])); ?>" title="Copy"><?php echo e(__('Copy Subscription Link')); ?></a></td-->
                  
              </tr>
              
              </div> 
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/greenvx4/public_html/vcard/core/resources/views/admin/user/vcard_orders.blade.php ENDPATH**/ ?>