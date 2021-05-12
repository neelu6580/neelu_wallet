<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
table,tr,th,td{
  border:1px solid #dddddd;
  border-collapse:collapse;
}
td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

th {
  background-color: #dddddd;
}
</style>



<?php $__env->startSection('content'); ?>
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12">
        <div class="card-header">
            <h5 class="h3 mb-0"><?php echo e(__('Orders')); ?></h5>
          </div>
        <div class="row"> 
        <?php if(isset($orders) && count($orders) > 0): ?>
          <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-12">
              <div class="card bg-white">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-6">
                      <!-- Title -->
                      <h5 class="h4 mb-0 text-dark">Order Id : #<?php echo e($val->ref_id); ?></h5>
                    </div>
                    
                    
                            
                       
                    
                    <div class="col-6">
                        <h5 class="h4 mb-0 text-dark" style="  margin-top: -8px!important;  text-align: right;">
                             
                          
                     <?php 
                            if($val->buy_shipment == '0'){
                            }elseif($val->buy_shipment == '1'){
                            }else{
                            require_once("/home/cuminup/public_html/core/vendor/easypost/easypost-php/lib/easypost.php");
                            $privateKey = env('EASYPOST_API_KEY');
                            \EasyPost\EasyPost::setApiKey($privateKey);
                            $shipment_id = $val->buy_shipment;
                            
                            $shipment = \EasyPost\Shipment::retrieve($shipment_id);
                            //dd($shipment->postage_label['label_url']);
                        ?>
                        <a href="<?php echo e($shipment->postage_label['label_url']); ?>" target="_blank" style="    padding: 8px 5px; background: #ed8305; color: white; border-radius: 5px;">Generate Postage Label</a>
                        <a href="<?php echo e(url('easy_track/'.$val->id)); ?>" target="_blank" style="padding: 8px 9px; background: #4377c4; color: white; border-radius: 5px;">Track Order</a>
                         <?php } ?>
                        
                         
                            </h5>
                        </div>
                  </div>
                  <div class="row">
                      <div class="col">
    
                      <div class="table-responsive">
<table class="table">
                          <tbody>
  <tr>
    <th><?php echo e(__('Product')); ?></th>
    <th><?php echo e(__('Name')); ?></th>
    <th><?php echo e(__('Email')); ?></th>
    <th><?php echo e(__('Phone')); ?></th>
    <th><?php echo e(__('Quantity')); ?></th>
    <th><?php echo e(__('Country')); ?></th>
    <th><?php echo e(__('State')); ?></th>
    <th><?php echo e(__('Town/City')); ?></th>
    <th><?php echo e(__('Address')); ?></th>
    <th><?php echo e(__('Shipping fee')); ?></th>
    <?php if(!empty($val->note)): ?>
    <th><?php echo e(__('Note')); ?></th>
    <?php endif; ?>
   
    <th><?php echo e(__('Amount')); ?></th>
    <th><?php echo e(__('Total')); ?></th>
    <th><?php echo e(__('Created')); ?></th>
    <th><?php echo e(__('Fee')); ?></th>
  
  </tr>
  <tr>
    <td><?php echo e($val->product->name); ?></td>
    <td><?php echo e($val->first_name); ?> <?php echo e($val->last_name); ?>r</td>
    <td><?php echo e($val->email); ?></td>
    <td><?php echo e($val->phone); ?></td>
    <?php if($val->product->quantity_status==0): ?>
    <td><?php echo e($val->quantity); ?></td>
     <?php endif; ?>                        
     <?php if($val->product->shipping_status==1): ?>
    <td><?php echo e($val->country); ?></td>
    <td><?php echo e($val->state); ?></td>
    <td><?php echo e($val->town); ?></td>
    <td><?php echo e($val->address); ?></td>
    <td><?php echo e($currency->symbol.$val->shipping_fee); ?></td>
    <?php endif; ?>
     <?php if($val->product->note_status==1 || $val->product->note_status==2): ?>
     <?php if(!empty($val->note)): ?>
    <td><?php echo e($val->note); ?></td>
    <?php endif; ?>
    <?php endif; ?>
    <td><?php echo e($currency->symbol); ?><?php echo e(number_format($val->amount,2)); ?></td>
    <td><?php echo e($currency->symbol.number_format($val->total,2)); ?></td>
    <td><?php echo e(date("Y/m/d h:i:A", strtotime($val->created_at))); ?></td>
    <td><?php echo e($currency->symbol.number_format($val->charge,2)); ?></td>
    
  </tr>
  </tbody>
</table>

  
                     
                       
                       
                            
                      </div>
                    </div>
                </div>
              </div>
            </div> 
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
         <div class="col-md-12">
              <div class="card bg-white">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-8">
                      <!-- Title -->
                      <h5 class="h4 mb-0 text-dark"></h5>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col" style="text-align:center">
                        <img src="<?php echo e(url('asset/profile/nodata.png')); ?>" width="30%">
                      </div>
                    </div>
                </div>
              </div>
            </div>
        <?php endif; ?>
        </div> 
      </div>
    </div>
    </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/user/product/orders.blade.php ENDPATH**/ ?>