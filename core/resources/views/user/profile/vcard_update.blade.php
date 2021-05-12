@extends('userlayout')

@section('content')

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
       
      <!-- neelu form-->
        <div class="card" id="edit">
          <div class="card-header header-elements-inline">
            <h3 class="mb-0">{{__('Edit Your Profile')}}</h3>
          </div>
          <div class="card-body">
              <form action="{{route('user.vcard_update')}}" method="post">
              @csrf
              <input type="hidden" name="user_id" value="{{$userdetail->id}}">
              <div class="form-group row">
                <label class="col-form-label col-lg-4">{{__('Neelu email')}}</label>
                <div class="col-lg-8">
                  <input type="email" name="neelu_email" class="form-control" placeholder="Enter new email" value="{{$userdetail->neelu_email}}">    
                </div>
              </div>                
              <div class="form-group row">
                <label class="col-form-label col-lg-4">{{__('Neelu password')}}</label>
                <div class="col-lg-8">
                  <input type="text" name="neelu_password" class="form-control" placeholder="Enter new password" value="{{$userdetail->neelu_password}}">    
                </div>
              </div>                
              <div class="text-right">
                <button type="submit" class="btn btn-success btn-sm">{{__('Update')}}</button>
              </div>
            </form>
          </div>
        </div>
  
    
      <!-- end here-->
      
      
 
     
    
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7B46osUBu80aqL18GWC3UaSeaq98jrpg&callback=initAutocomplete&libraries=places&v=weekly"
      async
    ></script>
@stop