<?php $__env->startSection('content'); ?>

<div class="main-content payment">
    <!-- Header -->
    <div class="header py-7 py-lg-5 pt-lg-1">
      <div class="container">
        <div class="header-body text-center mb-7">
        </div>
      </div>
    </div>
    <div class="container mt--8 pb-5 mb-0">
        <div class="row justify-content-center">     
            <div class="col-md-8">
                <div class="card card-profile bg-white border-0 mb-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                            <img src="<?php echo e(url('/')); ?>/asset/profile/<?php echo e($merchant->image); ?>" class="rounded-circle border-secondary">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                <span class="form-text text-xl"><?php echo e($currency->symbol); ?> <?php echo e(number_format($product->amount)); ?>.00</span>
                                <span class="form-text text-sm text-default"><?php echo e($product->name); ?> by <?php echo e($merchant->business_name); ?></span>
                            </div>
                        </div>
                        <form action="<?php echo e(route('pay.product')); ?>" method="post" id="modal-details">
                            <?php echo csrf_field(); ?>
                            <div class="row justify-content-between align-items-center">
                                <div class="col">
                                    <?php if($product->quantity_status==0): ?>
                                        <?php if($product->quantity!=0): ?>
                                            <div class="col-lg-4">
                                                <span class="badge badge-pill badge-primary mb-3"><?php echo e(__('In stock')); ?>: <?php echo e($product->quantity); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="col-auto">
                                    <div class="text-right">                        
                                        <?php if($product->quantity_status==1): ?>
                                            <?php if($product->status==1): ?>
                                                <button type="button" data-toggle="modal" data-target="#fund" class="btn btn-success my-4 btn-sm"><?php echo e(__('Pay with Card')); ?></button>
                                            <?php else: ?>
                                                <button type="submit" disabled class="btn btn-success btn-sm"><?php echo e(__('NOT AVAILABLE')); ?></button>
                                            <?php endif; ?>                                                             
                                        <?php elseif($product->quantity_status==0): ?>
                                            <?php if($product->quantity!=0): ?>
                                                <?php if($product->status==1): ?>
                                                    <button type="button" data-toggle="modal" data-target="#fund" class="btn btn-success my-4 btn-sm"><?php echo e(__('Pay with Card')); ?></button>
                                                <?php else: ?>
                                                    <button type="submit" disabled class="btn btn-success btn-sm"><?php echo e(__('NOT AVAILABLE')); ?></button>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <?php if(!empty($product->description)): ?>
                            <span class="form-text text-xs text-default"><?php echo $product->description; ?>.</span>
                            <?php endif; ?>
                            <?php if($product->quantity_status==0): ?>
                                <div class="form-group row">
                                    <?php if($product->quantity!=0): ?>
                                        <div class="col-lg-3">
                                            <input type="number" id="quantity" name="quantity" value="1" step="1" min="1" max="<?php echo e($product->quantity); ?>" title="Qty" size="4" inputmode="numeric" class="form-control" required="">
                                        </div>
                                        <label class="col-form-label col-lg-5"><?php echo e(__('Quantity')); ?></label>
                                    <?php else: ?>
                                    <div class="col-lg-3">
                                        <span class="badge badge-pill badge-primary mb-3"><?php echo e(__('Out of stock')); ?></span>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            <?php else: ?>
                                <input type="hidden" id="quantity" value="1" name="quantity">
                            <?php endif; ?>
                                <input type="hidden" id="amount" value="<?php echo e($product->amount); ?>" name="amount">
                                <?php if(empty($product->shipping_fee)): ?>
                                    <input type="hidden" id="ship_fee" value="0" name="shipping_fee">
                                <?php else: ?>
                                <input type="hidden" id="ship_fee" value="<?php echo e($product->shipping_fee); ?>" name="shipping_fee">
                                <?php endif; ?>
                                <input type="hidden" name="ref_id" value="<?php echo e($ref); ?>">
                                <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                                <input type="hidden" name="amount" value="<?php echo e($product->amount); ?>">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                                        </div>
                                    </div>                 
                                </div>    
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                                        </div>
                                    </div>                 
                                </div>  
                            </div>                         
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <input type="email" name="email" class="form-control" placeholder="Your Email Address" required>
                                        </div>
                                    </div>                 
                                </div>    
                                <div class="col-lg-6">
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <input type="number" inputmode="numeric" name="phone" class="form-control" placeholder="Mobile Number" required>
                                        </div>
                                    </div>                 
                                </div>  
                            </div> 
                            <?php if($product->note_status!=0): ?>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <textarea type="text" name="note" class="form-control" placeholder="Delivery Note <?php if($product->note_status==1): ?>(Optional) <?php endif; ?>" <?php if($product->note_status==2): ?>required="" <?php endif; ?>></textarea>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if($product->shipping_status==1): ?>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <input type="text" name="address" class="form-control" placeholder="Your Address" required>
                                </div> 
                            </div> 
                            <div class="form-group row">                           
                                <div class="col-lg-12">
                                    <input type="text" name="town" class="form-control" placeholder="Town/City" required>
                                </div>
                            </div>                        
                            <div class="form-group row">                           
                                <div class="col-lg-6">
                                    <select class="form-control custom-select" name="country" id="country" required>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <select class="form-control custom-select" name="state" id="state" required>
                                    </select>
                                </div>
                            </div>                        
                            <?php endif; ?>
                            <div class="modal fade" id="fund" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                    <div class="modal-content">
                                    <div class="modal-body p-0">
                                        <div class="accordion" id="accordionExample">
                                        <div class="card bg-white border-0 mb-0">
                                            <!--Pay with Card-->
                                            <div class="card-header" id="headingOne">
                                            <div class="text-left" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <h4 class="mb-0">Card</h4>
                                            </div>
                                            </div>
                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <form action="<?php echo e(route('pay.product')); ?>" role="form" method="post" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="<?php echo e($stripe->val1); ?>" id="payment-form">
                                                <?php echo csrf_field(); ?>
                                                <div class="form-group row">
                                                    <div class="col-xs-12 col-md-12 form-group required">
                                                    <input type="number" class="form-control input-lg custom-input" name="cardNumber" placeholder="Valid Card Number" min="16" autocomplete="off" required autofocus size="20"/>
                                                    </div>                                  
                                                </div> 
                                                <div class='form-group row'>
                                                    <div class='col form-group cvc'>
                                                    <input autocomplete='off' class='form-control card-cvc' name="cardCVC" placeholder='CVC' type='text' maxlength="3" required>
                                                    </div>
                                                    <div class='col form-group expiration required'>
                                                    <input class='form-control card-expiry-month' name="cardM" placeholder='MM' maxlength='2' type='text'>
                                                    </div>
                                                    <div class='col form-group expiration required'>
                                                    <input class='form-control card-expiry-year' name="cardY" placeholder='YYYY' maxlength='4'type='text'>
                                                    </div>
                                                </div>			
                                                <input type="hidden" value="card" name="type">  	                
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-success btn-sm" form="modal-details"><?php echo e(__('Pay')); ?> <span id="cardresult"></span></button><br>
                                                    <img src="<?php echo e(url('/')); ?>/asset/payment_gateways/creditcard.png" style="height:auto;  max-width:40%;">
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
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-12 text-right">
                                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-formbuy">Photos</a>
                            </div>
                        </div>
                        <div class="row justify-content-between align-items-center">
                            <div class="col">
                                <span class="text-sm text-default"><?php echo e(__('Product')); ?></span><br>
                                <span class="text-sm text-default"><?php echo e(__('Subtotal')); ?></span>
                            </div>
                            <div class="col-auto">
                                <span class="text-sm text-default"><?php echo e($product->name); ?> x <span id="product1">1</span></span><br>
                                <span class="text-sm text-default"><?php echo e($currency->symbol); ?><span id="subtotal1"><?php echo e($subtotal); ?></span>.00</span>
                            </div>
                        </div>  
                        <hr>  
                        <?php if($product->shipping_status==1): ?>                
                        <div class="row justify-content-between align-items-center">
                            <div class="col">
                                <span class="text-sm text-default"><?php echo e(__('Shipping')); ?></span>
                            </div>
                            <div class="col-auto">
                                <span class="text-sm text-default"><?php echo e(__('Flat rate')); ?>: <?php echo e($currency->symbol); ?><?php echo e($ship_fee); ?>.00</span>
                            </div>
                        </div>
                        <hr>
                        <?php endif; ?>
                        <div class="row justify-content-between align-items-center mb-5">
                            <div class="col">
                                <span class="text-sm text-default"><?php echo e(__('Total')); ?></span>
                            </div>
                            <div class="col-auto">
                                <span class="text-sm text-default"><?php echo e($currency->symbol); ?><span id="total1"><?php echo e($total); ?></span>.00</span>
                            </div>
                        </div>
                        <div class="text-center">
                            <p class="paragraph small">If you have any questions, contact
                                <a href="mailto:<?php echo e($merchant->email); ?>"><?php echo e($merchant->email); ?></a>
                            </p>
                        </div>
                        <div class="text-center">
                            <?php if($merchant->facebook!=null): ?>
                                <a href="<?php echo e($merchant->facebook); ?>"><i class="sn fab fa-facebook"></i></a>   
                            <?php endif; ?> 
                            <?php if($merchant->twitter!=null): ?>                      
                                <a href="<?php echo e($merchant->twitter); ?>"><i class="sn fab fa-twitter"></i></a>
                            <?php endif; ?>      
                            <?php if($merchant->linkedin!=null): ?>                     
                                <a href="<?php echo e($merchant->linkedin); ?>"><i class="sn fab fa-linkedin"></i></a> 
                            <?php endif; ?>     
                            <?php if($merchant->instagram!=null): ?>                        
                                <a href="<?php echo e($merchant->instagram); ?>"><i class="sn fab fa-instagram"></i></a>   
                            <?php endif; ?> 
                            <?php if($merchant->youtube!=null): ?>                          
                                <a href="<?php echo e($merchant->youtube); ?>"><i class="sn fab fa-youtube"></i></a>  
                            <?php endif; ?>                          
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modal-formbuy" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content modal-lg">
                            <div class="modal-body p-0">
                            <div class="card bg-white border-0 mb-0">
                                <div class="card-body px-lg-5 py-lg-5">
                                    <div id="carouselExampleIndicators" class="carousel slide bg-transparent" data-ride="carousel">
                                        <div class="carousel-inner bg-transparent">
                                            <?php if($product->new==0): ?>
                                                <div class="carousel-item active">
                                                    <img class="d-block w-80" src="<?php echo e(url('/')); ?>/asset/images/product-placeholder.jpg" alt="product image">
                                                </div>
                                            <?php else: ?>
                                                <?php $__currentLoopData = $image; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="carousel-item bg-transparent <?php if($val->id==$first->id): ?>active <?php endif; ?>">
                                                    <img class="d-block w-100" src="<?php echo e(url('/')); ?>/asset/profile/<?php echo e($val->image); ?>" alt="product image">
                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?> 
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only"><?php echo e(__('Previous')); ?></span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only"><?php echo e(__('Next')); ?></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('paymentlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/boompay/core/resources/views/user/product/buy.blade.php ENDPATH**/ ?>