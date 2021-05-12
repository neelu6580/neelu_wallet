<?php $__env->startSection('content'); ?>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <style type="text/css">
      div.pac-container {
        z-index: 99999999999 !important;
      } 
    </style>
    <script>
      // This sample uses the Autocomplete widget to help the user select a
      // place, then it retrieves the address components associated with that
      // place, and then it populates the form fields with those details.
      // This sample requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script
      // src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
      let placeSearch;
      let autocomplete;
      const componentForm = {
        street_number: "short_name",
        route: "long_name",
        locality: "long_name",
        administrative_area_level_1: "short_name",
        country: "long_name",
        postal_code: "short_name",
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search predictions to
        // geographical location types.
        autocomplete = new google.maps.places.Autocomplete(
          document.getElementById("autocomplete"),
          { types: ["geocode"] }
        );
        // Avoid paying for data that you don't need by restricting the set of
        // place fields that are returned to just the address components.
        autocomplete.setFields(["address_component"]);
        // When the user selects an address from the drop-down, populate the
        // address fields in the form.
        autocomplete.addListener("place_changed", fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        const place = autocomplete.getPlace();

        for (const component in componentForm) {
          document.getElementById(component).value = "";
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details,
        // and then fill-in the corresponding field on the form.
        for (const component of place.address_components) {
          const addressType = component.types[0];

          if (componentForm[addressType]) {
            const val = component[componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition((position) => {
            const geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude,
            };
            const circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy,
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>
    
    
<?php 
    if(session()->has('new_to')){
    $new_ship = session()->get('new_to');
    //dd($shipment);
    
    require_once("/home/cuminup/public_html/core/vendor/easypost/easypost-php/lib/easypost.php");
    $privateKey = env('EASYPOST_API_KEY');
    \EasyPost\EasyPost::setApiKey($privateKey);
    
    $shipment = \EasyPost\Shipment::retrieve($new_ship);
    
    //dd($shipment);
    
    if(!empty($shipment->rates)){
        foreach ($shipment->rates as $rate) {
          $all_rates[] = array ( 
            'id' => $rate->id,
            'object' => $rate->object,
            'created_at' => $rate->created_at,
            'updated_at' => $rate->updated_at,
            'mode' => $rate->mode,
            'service' => $rate->service,
            'carrier' => $rate->carrier,
            'rate' => $rate->rate,
            'currency' => $rate->currency,
            'retail_rate' => $rate->retail_rate,
            'retail_currency' => $rate->retail_currency,
            'list_rate' => $rate->list_rate,
            'list_currency' => $rate->list_currency,
            'delivery_days' => $rate->delivery_days,
            'delivery_date' => $rate->delivery_date,
            'delivery_date_guaranteed' => $rate->delivery_date_guaranteed,
            'est_delivery_days' => $rate->est_delivery_days,
            'shipment_id' => $rate->shipment_id,
            'carrier_account_id' => $rate->carrier_account_id,
          );
        }
        
        $lowest_new = min(array_column($all_rates, 'rate'));
        $shipping_comm = DB::table('settings')->orderBy('created_at', 'desc')->first();
        $margin = ($shipping_comm->shipping_commission * $rate['rate'] / 100 );
        $lowest_rate = $lowest_new + $margin;
        //dd($lowest_rate);
        
        require_once("/home/cuminup/public_html/core/vendor/easypost/easypost-php/lib/easypost.php");
        $privateKey = env('EASYPOST_API_KEY');
        \EasyPost\EasyPost::setApiKey($privateKey);
        
        //dd($shipment->to_address['id']);
        
        $retrieved_address = \EasyPost\Address::retrieve($shipment->to_address['id']);
        //dd($retrieved_address);
        
        //dd($retrieved_address);

    }else{
        $all_rates = "No Rates Found";
        $retrieved_address = "Address not found";
        $lowest_rate = "Shipping not allowed";
    }}
    //dd($all_rates);
?>
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
                            <img  <?php if(empty($logo_product_img)): ?>src="<?php echo e(url('/')); ?>/asset/profile/<?php echo e($merchant->image); ?>" <?php else: ?> src="<?php echo e(url('/')); ?>/asset/<?php echo e($logo_product_img); ?>" <?php endif; ?> class="rounded-circle border-secondary">
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
                                        
                                        <?php if($product->shipping_status==1): ?>
                                            <button type="button" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-success my-4 btn-sm">Add Address</button>
                                        <?php endif; ?>
                                        
                                        <!-- Modal -->
                                        
                                    </div>
                                </div>
                            </div>
                            <?php if(!empty($product->description)): ?>
                            <span class="form-text text-xs text-default">Product Details: <?php echo $product->description; ?>.</span>
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
                                <?php if(session()->has('new_to')){ ?>
                                    <input type="hidden" value="<?php echo e(bcdiv($lowest_rate, 1, 2)); ?>" name="shipping_fee">
                                <?php } ?>
                                <input type="hidden" name="ref_id" value="<?php echo e($ref); ?>">
                                <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                                <input type="hidden" name="amount" value="<?php echo e($product->amount); ?>">
                                <?php 
                                    if(session()->has('new_to')){ 
                                        require_once("/home/cuminup/public_html/core/vendor/easypost/easypost-php/lib/easypost.php");
                                        $privateKey = env('EASYPOST_API_KEY');
                                        \EasyPost\EasyPost::setApiKey($privateKey);
                                        
                                        $shipment = \EasyPost\Shipment::retrieve($new_ship);
                                        $shipment->buy(array(
                                          'rate'      => $shipment->lowest_rate()
                                        ));
                                       // dd($shipment->id);
                                ?>
                                    <input type="hidden" value="<?php echo e($shipment->id); ?>" name="buy_shipment">
                                <?php }else{ ?>
                                    <input type="hidden" value="1" name="buy_shipment">
                                <?php } ?>
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
                                        <div class="col-lg-6">
                                            <?php $countries = DB::table('countries')->orderBy('name','ASC')->get(); ?>
                                          <select class="form-control" name="prefix" style="margin-right: 10px;">
                                              <?php foreach($countries as $country){?>
                                              <option value="<?=$country->id?>" <?=($country->iso_code == 'US') ? 'selected' :''?>> <?= '(+'.$country->calling_code .') ' .$country->name?></option>
                                              <?php }?>
                                          </select>
                                          </div>
                                          <div class="col-lg-6">
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
                                    <input type="text" name="address" class="form-control" placeholder="Your Address" value="<?php if(!empty($retrieved_address)){ echo $retrieved_address->street1. ' ' .$retrieved_address->street2; } ?>" data-toggle="modal" data-target="#exampleModalCenter" required>
                                </div> 
                            </div> 
                            <div class="form-group row">                           
                                <div class="col-lg-12">
                                    <input type="text" name="town" class="form-control" placeholder="Town/City" value="<?php if(!empty($retrieved_address)){ echo $retrieved_address->city; } ?>" data-toggle="modal" data-target="#exampleModalCenter" required>
                                </div>
                            </div>                        
                            <div class="form-group row">                           
                                <div class="col-lg-6">
                                    <!--<select class="form-control custom-select" name="country" id="country" required>-->
                                    <!--</select>-->
                                    <input type="text" name="country" class="form-control" placeholder="country" value="<?php if(!empty($retrieved_address)){ echo $retrieved_address->country; } ?>" data-toggle="modal" data-target="#exampleModalCenter" required>
                                </div>
                                <div class="col-lg-6">
                                    <!--<select class="form-control custom-select" name="state" id="state" required>-->
                                    <!--</select>-->
                                     <input type="text" name="state" class="form-control" placeholder="state" value="<?php if(!empty($retrieved_address)){ echo $retrieved_address->state; } ?>" data-toggle="modal" data-target="#exampleModalCenter" required>
                                </div>
                            </div> 
                            
                            <div class="form-group row">  
                                <div class="col-lg-6">
                                    <input type="text" name="zip_code" class="form-control" placeholder="Zip Code" value="<?php if(!empty($retrieved_address)){ echo $retrieved_address->zip; } ?>" data-toggle="modal" data-target="#exampleModalCenter" required>
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
                                <?php if(!empty($all_rates)): ?>
                                    <?php if($all_rates == 'No Rates Found'): ?>
                                        <tr>
                                            <td>
                                                <div class="radio r1">
                                                    <span class="text-sm text-default"><?php echo e(__('Flat rate')); ?>: <?php echo e($currency->symbol); ?>0.00</span>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php else: ?>
                                        <?php $__currentLoopData = $all_rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php 
                                                $shipping_comm = DB::table('settings')->orderBy('created_at', 'desc')->first();
                                                //dd($shipping_comm->shipping_commission);
                                                $margin = ($shipping_comm->shipping_commission * $rate['rate'] / 100 );
                                                //dd($margin);
                                                $total_rate = $margin + $rate['rate'];
                                                $lowest_rate = min(array_column($all_rates, 'rate'));
                                           
                                                if ($lowest_rate == $rate['rate']){
                                            ?>
                                                <span class="text-sm text-default"><?php echo e(__('Flat rate')); ?>: <?php echo e($currency->symbol); ?><?php echo e(bcdiv($total_rate, 1, 2)); ?></span>
                                            <?php } ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="text-sm text-default"><?php echo e(__('Flat rate')); ?>: <?php echo e($currency->symbol); ?>0.00</span>
                                <?php endif; ?>
                                <!--<span class="text-sm text-default"><?php echo e(__('Flat rate')); ?>: <?php echo e($currency->symbol); ?><?php echo e($ship_fee); ?>.00</span>-->
                            </div>
                        </div>
                        <hr>
                        <?php endif; ?>
                        <div class="row justify-content-between align-items-center mb-5">
                            <div class="col">
                                <span class="text-sm text-default"><?php echo e(__('Total')); ?></span>
                            </div>
                            <div class="col-auto">
                                <?php if(!empty($all_rates)): ?>
                                    <?php if($all_rates == 'No Rates Found'): ?>
                                        <tr>
                                            <td>
                                                <div class="radio r1">
                                                   <span class="text-sm text-default"><?php echo e($currency->symbol); ?><span id="total1"><?php echo e($subtotal); ?></span>.00</span>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php else: ?>
                                        <?php $__currentLoopData = $all_rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php 
                                                $shipping_comm = DB::table('settings')->orderBy('created_at', 'desc')->first();
                                                $margin = ($shipping_comm->shipping_commission * $rate['rate'] / 100 );
                                                $total_rate = $margin + $rate['rate'];
                                                
                                                $grand_total = $subtotal + $total_rate;
                                                
                                                //dd($rate['rate']);
                                           
                                                if ($lowest_rate == $rate['rate']){
                                            ?>
                                                <span class="text-sm text-default"><?php echo e(__('Flat rate')); ?>: <?php echo e($currency->symbol); ?><?php echo e(bcdiv($grand_total, 1, 2)); ?></span>
                                            <?php } ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="text-sm text-default"><?php echo e($currency->symbol); ?><?php echo e($subtotal); ?>.00</span>
                                <?php endif; ?>
                                <!--<span class="text-sm text-default"><?php echo e($currency->symbol); ?><span id="total1"><?php echo e($total); ?></span>.00</span>-->
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
                                                    <img class="d-block w-80" <?php if(empty($logo_product_img)): ?>src="<?php echo e(url('/')); ?>/asset/profile/<?php echo e($logo->image_link2); ?>" <?php else: ?> src="<?php echo e(url('/')); ?>/asset/<?php echo e($logo_product_img); ?>" <?php endif; ?>  alt="product image">
                                                </div>
                                            <?php else: ?>
                                                <?php $__currentLoopData = $image; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="carousel-item bg-transparent <?php if($val->id==$first->id): ?>active <?php endif; ?>">
                                                    <img class="d-block w-100" <?php if(empty($logo_product_img)): ?>src="<?php echo e(url('/')); ?>/asset/profile/<?php echo e($val->image); ?>" <?php else: ?> src="<?php echo e(url('/')); ?>/asset/<?php echo e($logo_product_img); ?>" <?php endif; ?>  alt="product image">
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
    
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Enter Delivery Address</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="get" action="<?php echo e(url('buy-product/'.$product->ref_id)); ?>">
                <?php echo csrf_field(); ?>
              <div class="form-group">
                <input type="text" class="form-control" id="autocomplete" onFocus="geolocate()" placeholder="Enter your address">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" id="street_number" name="address1" placeholder="Address Line 1" readonly="readonly">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" id="route" name="address2" placeholder="Address Line 2" readonly="readonly">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" id="locality" name="city" placeholder="City" readonly="readonly">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" id="administrative_area_level_1" name="state" placeholder="State" readonly="readonly">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" id="country" name="country" placeholder="Country" readonly="readonly">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" id="postal_code" name="zip_code" placeholder="Zip Code" readonly="readonly">
              </div>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    
       <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7B46osUBu80aqL18GWC3UaSeaq98jrpg&callback=initAutocomplete&libraries=places&v=weekly"
      async
    ></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('paymentlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cuminup/public_html/core/resources/views/user/product/buy.blade.php ENDPATH**/ ?>