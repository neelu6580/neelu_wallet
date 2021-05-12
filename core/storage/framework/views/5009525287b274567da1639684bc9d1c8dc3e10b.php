

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
    
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-8">
        <div class="card" id="edit">
          <div class="card-header header-elements-inline">
            <h3 class="mb-0"><?php echo e(__('Your Profile')); ?></h3>
          </div>
          <div class="card-body">
        
      <!-- neelu form-->
     
              <form action="<?php echo e(route('user.vcard_profile')); ?>" method="post" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>

              
              <div class="form-group row">
                <label class="col-form-label col-lg-4"><?php echo e(__('Image')); ?></label>
                <div class="col-lg-8">
            <input type="file" name="picture" class="form-control" placeholder="Insert picture">
                </div>
              </div>        
              
              <div class="form-group row">
                <label class="col-form-label col-lg-4"><?php echo e(__('Neelu email')); ?></label>
                <div class="col-lg-8">
                  <input type="email" name="neelu_email" class="form-control" placeholder="Neelu Email" value="<?php echo e($user->neelu_email); ?>">    
                </div>
              </div>                
              <div class="form-group row">
                <label class="col-form-label col-lg-4"><?php echo e(__('Neelu password')); ?></label>
                <div class="col-lg-8">
                  <input type="text" name="neelu_password" class="form-control" placeholder="Neelu Password" value="<?php echo e($user->neelu_password); ?>">    
                </div>
              </div>                
              <div class="text-right">
                <button type="submit" class="btn btn-success btn-sm"><?php echo e(__('Save Changes')); ?></button>
              </div>
            </form>
          </div>
        </div>
  
    
      <!-- end here-->
      
      
      <!--neelu list-->
    <div class="card" id="edit">
          <div class="card-header header-elements-inline">
          </div>
          <div class="card-body">     
            <div class="container">
                <h2>Neelu list</h2>
                <table class="table" id="userlist_id">
                    <thead>
                          <tr>
                              <th>Sr.No</th>
                              <th>Image</th>
                            <th>Neelu Email</th>
                            <th>Neelu Password</th>
                            <th>Action</th>
                            </tr>
                     </thead>
                     <tbody>
                     <?php $__currentLoopData = $userslist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
               
               
                         <tr>
                             <td><?php echo e(++$k); ?></td>
                             <td>
                                 
                                  
                                 <?php if(empty($user->picture)): ?>
                                  <img src="<?php echo e(url('asset/profile/user-default.png')); ?>" width ="50" heigth="50">
                                 <?php else: ?>
                                 <img src="<?php echo e(url('asset/profile/')); ?>/<?php echo e($user->picture); ?>" width ="50" heigth="50" alt ="alt.jpg" >
                                 <?php endif; ?>
                                 
                             </td>
                             <td><?php echo e($user->neelu_email); ?></td>
                            <td><?php echo e($user->neelu_password); ?></td>
                            <td>
                                <a href="<?php echo e(url('user/vcard_editprofile')); ?>/<?php echo e($user->id); ?>" class="btn btn-primary">Edit</a>&nbsp;
						        <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#myModal<?php echo e($user->id); ?>">Delete</a>&nbsp;
					<!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#id">Delete</button> -->
                            </td>
                            </tr>
                    
            <!-- Modal -->
  <div class="modal fade" id="myModal<?php echo e($user->id); ?>" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <center><div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div></center>
       <center><div> <h4 class="modal-title">Are you sure want to delete?</h4>
        </div></center>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
            <a href="<?php echo e(url('user/vcard_delete')); ?>/<?php echo e($user->id); ?>" class="btn btn-success" >YES</a>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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




      
      <!--end here -->
     
    
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7B46osUBu80aqL18GWC3UaSeaq98jrpg&callback=initAutocomplete&libraries=places&v=weekly"
      async
    ></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
   <script src=" https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
    $('#userlist_id').DataTable();
                 } );
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('userlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/greenvx4/public_html/vcard/core/resources/views/user/profile/vcard_form.blade.php ENDPATH**/ ?>