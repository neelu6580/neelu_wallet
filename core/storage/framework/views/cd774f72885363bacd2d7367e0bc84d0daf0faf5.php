<?php $__env->startSection('content'); ?>
<head>
    <style>
.surtitle {
    margin-bottom: 0;
    letter-spacing: 0.5px;
    text-transform: uppercase;
       color: #ffffff !important;

    font-size: 12px;
}
<?php $__currentLoopData = $virtualCardsProductDesigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $productDetails): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
.card-body<?php echo e($productDetails->id); ?> {
    padding: 0.5rem 1rem;
    flex: 1 1 auto;
    border-radius: 15px;
    background: <?php echo e($productDetails->class_name); ?>;
}

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
/*
.card-body2 {
    padding: 0.5rem 1rem;
    flex: 1 1 auto;
    border-radius: 15px;
    background: green;
}

.card-body3 {
    padding: 0.5rem 1rem;
    flex: 1 1 auto;
    border-radius: 15px;
    background: #df7b50;
}

.card-body4 {
    padding: 0.5rem 1rem;
    flex: 1 1 auto;
    border-radius: 15px;
    background: black;
}

*/
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
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                                        <div>


                    <div class="card-header">
                        <h3 class="card-title"><?php echo e(__('Step 2:Select Design')); ?></h3>
                        
                    </div>
 <div class="row"> 
 <?php $__currentLoopData = $virtualCardsProductDesigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $productDetails): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-4">
        <div class="card">
           
          <div class="card-body"> 
          <a href="<?php echo e(url('user/select_plan/'.$product_type_id.'/'.$productDetails->id)); ?>">
            <div class="card">
            <!-- Card body -->
           
            <div class="card-body<?php echo e($productDetails->id); ?>">
              <div class="row justify-content-between align-items-center">
                <div class="col">
                  <!--<span class="text-primary h6 surtitle ">$0.00</span>  -->
                 <?php if($productDetails->status== 0): ?>
                                            <span class="badge badge-pill badge-danger"><?php echo e(__('Inactive')); ?></span>
                                        <?php elseif($productDetails->status== 1): ?>
                                            <span class="badge badge-pill badge-success"><?php echo e(__('Active')); ?></span>
                                        <?php elseif($productDetails->status== 2): ?>
                                            <span class="badge badge-pill badge-danger"><?php echo e(__('Deleted')); ?></span>    
                                        
                                        <?php endif; ?>               </div>
                
              </div>             
              <div class="my-4">
                <span class="h6 surtitle text-gray mb-2" style="    color: #ffffff !important;">
                Santosh Resh
                </span>
                
                  <div  style="color: #ffffff !important;">XXXX XXXX XXXX  7086</div>
               
              </div>
              <div class="row">               
                <div class="col-6">
                  <span class="h6 surtitle text-gray">Monthly Limit</span><br>
                  <span class="text-primary" style="
    font-size: 13px;color: #ffffff !important;"><?php echo e($currency->symbol); ?>x.xx / <span class="text-gray" style="color: #ffffff !important;"><?php echo e($currency->symbol); ?>x.xx</span></span>
                </div>
                <div class="col" data-toggle="modal" data-target="#modal-more15" style="cursor: pointer;">
                  <span class="h6 surtitle text-gray">CVV</span><br>
                  <span class="surtitle text-gray">xxx</span>
                </div>     
                <div class="col">
                    <img src="https://cuminup.com/asset/images/visa.svg" style="width:100%">
                    </div>
              </div>
             
            </div>
             
          </div>
          </a>
          
    </div>
      
     
      
      </div>
      </div>
      
      <div class="modal fade" id="editDesign<?php echo e($productDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0"><?php echo e(__('Update Card Design')); ?> </h3>
                                                    </div>
                                                      <form action="#" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                       <input type="hidden" name="design_id" value="<?php echo e($productDetails->id); ?>">
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                <?php echo e(__('Name')); ?></label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <input class="form-control" type="text" name="design_name" placeholder="Enter Card Type Name" value="<?php echo e($productDetails->design_name); ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                <?php echo e(__('Status')); ?></label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <select class="form-control" name="status">
                                                                     <option value="1">Active</option>
                                                                     <option value="0">Inactive</option>
                                                                </select>     
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                <?php echo e(__('Description')); ?></label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <textarea class="form-control" type="text" name="description" placeholder="Enter Description"  required><?php echo e($productDetails->description); ?></textarea>
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
                                
                                
                                
                                
                                <div class="modal fade" id="delete<?php echo e($productDetails->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0"><?php echo e(__('Are you sure you want to delete this?')); ?></h3>
                                                    </div>
                                                    <div class="card-body px-lg-5 py-lg-5 text-right">
                                                        <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                                        <a  href="#" class="btn btn-danger btn-sm"><?php echo e(__('Proceed')); ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>   
      
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
   

      </div>
                   
                            

                                                  
                                
                                
                                 
                                
                                             
                            
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--ADD MODEL-->
 <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0"><?php echo e(__('Add New Card Design')); ?> </h3>
                                                    </div>
                                                      <form action="#" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                       
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                <?php echo e(__('Design Name')); ?></label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <input class="form-control" type="text" name="design_name" placeholder="Enter Design Name" required>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row p-3">
                                                            <div class="col-sm-3">
                                                                <?php echo e(__('Features')); ?></label>
                                                            </div>
                                                             <div class="col-sm-9">
                                                                 <textarea class="form-control" type="text" name="description" placeholder="Enter Description" required></textarea>
                                                            </div>
                                                        </div>
                                                    <div class="card-body px-lg-5 py-lg-5 text-right">
                                                        <button type="button" class="btn btn-neutral" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                                                        <button  type="submit" class="btn btn-success"><?php echo e(__('Add Now')); ?></button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/greenvx4/public_html/vcard/core/resources/views/user/instantissue/products_design.blade.php ENDPATH**/ ?>