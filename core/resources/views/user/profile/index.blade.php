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
        <div class="card" id="edit">
          <div class="card-header header-elements-inline">
            <h3 class="mb-0">{{__('Your Profile')}}</h3>
          </div>
          <div class="card-body">
            <form action="{{url('user/account')}}" method="post">
            @csrf
                <div class="form-group row">
                  <label class="col-form-label col-lg-3">{{__('Full Name')}}</label>
                  <div class="col-lg-9">
                    <div class="row">
                        <div class="col-6">
                          <input type="text" name="first_name" class="form-control" placeholder="First Name" value="{{$user->first_name}}">
                        </div>      
                        <div class="col-6">
                          <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="{{$user->last_name}}">
                        </div>
                    </div>
                  </div>
                </div>  
                <div class="form-group row">
                  <label class="col-form-label col-lg-3">{{__('Business Name')}}</label>
                  <div class="col-lg-9">
                    <input type="text" name="business_name" class="form-control" placeholder="Your Business Name" value="{{$user->business_name}}" required>
                    <span class="form-text text-xs">{{__('Your business name is the official name of your company. It should be the same as the name on your registration documents.')}}</span>
                  </div>
                </div>   
                <div class="form-group row">
                  <label class="col-form-label col-lg-3">{{__('Phone Number')}}</label>
                  <div class="col-lg-9">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">+</span>
                      </div>
                      <?php $countries = DB::table('countries')->get(); ?>
                      <select class="form-control" name="prefix" style="margin-right: 10px;">
                          <?php foreach($countries as $country){?>
                          <option value="<?=$country->id?>" <?=($country->iso_code == $user->phone_iso) ? 'selected' :''?>> {{$country->name}} {{'('}}{{'+'}}{{$country->calling_code}}{{')'}}</option>
                          <?php }?>
                      </select>
                      <input type="number" inputmode="numeric" name="phone" maxlength="14" class="form-control" value="{{$user->phone}}">
                    </div>
                  </div>
                </div>     
                <div class="form-group row">
                  <label class="col-form-label col-lg-3">{{__('Email Address')}}</label>
                  <div class="col-lg-9">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                      </div>
                      <input type="email" name="email" class="form-control" placeholder="{{__('Email Address')}}" value="{{$user->email}}">
                    </div>
                  </div>
                </div>           
                <div class="form-group row">
                  <label class="col-form-label col-lg-3">{{__('Office Address')}}</label>
                  <div class="col-lg-9">
                    <!--<input type="text" name="office_address" class="form-control" placeholder="Search Address" value="{{$user->office_address}}">-->
                    <input type="text" class="form-control" id="autocomplete" onFocus="geolocate()" placeholder="Enter your address">
                  </div>
                </div> 
                
                <div class="form-group row">
                  <label class="col-form-label col-lg-3">Address Line 1</label>
                  <div class="col-lg-9">
                    <input type="text" id="street_number" name="address1" class="form-control" placeholder="Address Line 1" value="{{$user->address1}}"  readonly="readonly">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-lg-3">Address Line 2</label>
                  <div class="col-lg-9">
                    <input type="text" id="route" name="address2" class="form-control" placeholder="Address Line 2" value="{{$user->address2}}"  readonly="readonly">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-lg-3">City</label>
                  <div class="col-lg-9">
                    <input type="text" id="locality" name="city" class="form-control" placeholder="City" value="{{$user->city}}"  readonly="readonly">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-lg-3">State</label>
                  <div class="col-lg-9">
                    <input type="text" id="administrative_area_level_1" name="state" class="form-control" placeholder="State" value="{{$user->state}}"  readonly="readonly">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-lg-3">Country</label>
                  <div class="col-lg-9">
                    <input type="text" id="country" name="country" class="form-control" placeholder="Country" value="{{$user->country}}"  readonly="readonly">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-form-label col-lg-3">Zip Code</label>
                  <div class="col-lg-9">
                    <input type="text" id="postal_code" name="zip_code" class="form-control" placeholder="Zip Code" value="{{$user->zip_code}}"  readonly="readonly">
                  </div>
                </div>
                
                <div class="form-group row">
                  <label class="col-form-label col-lg-3">{{__('Website')}}</label>
                  <div class="col-lg-9">
                    <input type="text" name="website_link" class="form-control" placeholder="Your Business Website Link" value="{{$user->website_link}}"  readonly="readonly">
                  </div>
                </div> 
                <!--<div class="form-group row">-->
                <!--  <label class="col-form-label col-lg-3">{{__('Social Security number ( SSN )')}}</label>-->
                <!--  <div class="col-lg-9">-->
                <!--    <input type="text" class="form-control" name="verify_ssn" placeholder="Your Social Security number ( SSN )" value="{{$user->verify_ssn}}">-->
                <!--  </div>-->
                <!--</div>-->
                <!--<div class="form-group row">-->
                <!--  <label class="col-form-label col-lg-3">{{__('Employer Identification Number ( EIN )')}}</label>-->
                <!--  <div class="col-lg-9">-->
                <!--    <input type="text" class="form-control" name="verify_ein" placeholder="Your Employer Identification Number ( EIN )" value="{{$user->verify_ein}}">-->
                <!--  </div>-->
                <!--</div>-->
                <div class="form-group row">
                  <label class="col-form-label col-lg-5">{{__('Technical skill, are you a developer')}}</label>
                  <div class="col-lg-7">
                    <select class="form-control custom-select" name="developer" required>
                      <option value='1' @if($user->developer==1) selected @endif>{{__('Yes')}}</option>
                      <option value='0' @if($user->developer==0) selected @endif>{{__('No')}}</option>
                    </select>
                  </div>
                </div> 
                <div class="form-group row">
                <label class="col-form-label-castro col-lg-2">{{__('Password')}}</label>
                <div class="col-lg-10">
                <a data-toggle="modal" data-target="#modal-formx" href="" class="btn btn-white btn-sm">{{__('Change password')}}</a>
                </div>
              </div>                    
              <div class="text-right">
                <button type="submit" class="btn btn-success btn-sm">{{__('Save Changes')}}</button>
              </div>
            </form>
          </div>
        </div>
        <div class="card bg-white" id="2fa">
          <div class="card-body">
            <h3 class="mb-0">{{__('Two-Factor Security Option')}}</h3>
            <div class="align-item-sm-center flex-sm-nowrap text-left">
                <span class="form-text text-sm">
                {{__('Two-factor authentication is a method for protection your web account. 
                  When it is activated you need to enter not only your password, but also a special code. 
                  You can receive this code by in mobile app. 
                  Even if third person will find your password, then cant access with that code.')}}
                </span>
                <span class="badge badge-pill badge-primary mb-3">
                  @if($user->fa_status==0)
                  {{__('Disabled')}}
                  @else
                  {{__('Active')}}
                  @endif
                </span>
                <span class="form-text text-sm text-default">
                {{__('1. Install an authentication app on your device. Any app that supports the Time-based One-Time Password (TOTP) protocol should work.')}}
                </span>
                <span class="form-text text-sm text-default">
                {{__('2. Use the authenticator app to scan the barcode below.')}}
                </span>
                <span class="form-text text-sm text-default">
                {{__('3. Enter the code generated by the authenticator app.')}}
                </span>
                <a data-toggle="modal" data-target="#modal-form2fa" href="" class="btn btn-success btn-sm">
                @if($user->fa_status==0)
                  {{__('Enable 2fa')}}
                @elseif($user->fa_status==1)
                  {{__('Disable 2fa')}}
                @endif
                </a>
                <div class="modal fade" id="modal-form2fa" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                  <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                    <div class="modal-content">
                      <div class="modal-body p-0">
                        <div class="card bg-white border-0 mb-0 text-center">
                          <div class="card-body px-lg-5 py-lg-5">
                          @if($user->fa_status==0)
                            <img src="{{$image}}" class="mb-3 user-profile">
                          @endif
                            <form action="{{route('change.2fa')}}" method="post">
                              @csrf
                              <div class="form-group row">
                                <div class="col-lg-12">
                                  <input type="number" name="code" class="form-control" minlength="6" placeholder="Six digit code" required>
                                    <input type="hidden"  name="vv" value="{{$secret}}">
                                  @if($user->fa_status==0)
                                    <input type="hidden"  name="type" value="1">
                                  @elseif($user->fa_status==1)
                                    <input type="hidden"  name="type" value="0">
                                  @endif
                                </div>
                              </div>            
                              <div class="text-right">
                                <button type="submit" class="btn btn-success btn-sm">
                                @if($user->fa_status==0)
                                  {{__('Enable 2fa')}}
                                @elseif($user->fa_status==1)
                                  {{__('Disable 2fa')}}
                                @endif
                                </button>
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
        </div>
        <div class="card" id="edit">
          <div class="card-header header-elements-inline">
            <h3 class="mb-0">{{__('Your Profile')}}</h3>
          </div>
          <div class="card-body">
            <form action="{{route('user.social')}}" method="post">
              @csrf
              <div class="form-group row">
                <label class="col-form-label col-lg-4">{{__('Facebook')}}</label>
                <div class="col-lg-8">
                  <input type="url" name="facebook" class="form-control" placeholder="Your Facebook Profile Link" value="{{$user->facebook}}">    
                </div>
              </div>                
              <div class="form-group row">
                <label class="col-form-label col-lg-4">{{__('Twitter')}}</label>
                <div class="col-lg-8">
                  <input type="url" name="twitter" class="form-control" placeholder="Your Twitter Profile Link" value="{{$user->twitter}}">    
                </div>
              </div>                
              <div class="form-group row">
                <label class="col-form-label col-lg-4">{{__('Instagram')}}</label>
                <div class="col-lg-8">
                  <input type="url" name="instagram" class="form-control" placeholder="Your Instagram Profile Link" value="{{$user->instagram}}">    
                </div>
              </div>                
              <div class="form-group row">
                <label class="col-form-label col-lg-4">{{__('LinkedIn')}}</label>
                <div class="col-lg-8">
                  <input type="url" name="linkedin" class="form-control" placeholder="Your LinkedIn Profile Link" value="{{$user->linkedin}}">    
                </div>
              </div>               
              <div class="form-group row">
                <label class="col-form-label col-lg-4">{{__('Youtube')}}</label>
                <div class="col-lg-8">
                  <input type="url" name="youtube" class="form-control" placeholder="Your Youtube Channel Link" value="{{$user->youtube}}">    
                </div>
              </div>                     
              <div class="text-right">
                <button type="submit" class="btn btn-success btn-sm">{{__('Save Changes')}}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body text-center">
            <h3 class="card-title mb-3">{{__('Business Logo')}}</h3>
            <p class="card-text text-sm">{{__('Please upload your Company or Brand logo.')}}</p>
            <a href="#" class="avatar text-center">
              <img src="{{url('/')}}/asset/profile/{{$cast}}"/>
            </a>
            <form action="{{url('user/avatar')}}" enctype="multipart/form-data" method="post">
            @csrf
                <div class="form-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFileLang" name="image" accept="image/*" required>
                    <label class="custom-file-label" for="customFileLang">{{__('Choose Media')}}</label>
                  </div> 
                </div>              
              <div class="text-right">
                <button type="submit" class="btn btn-success btn-sm">{{__('Change File')}}</button>
              </div>
            </form>
          </div>
        </div>
        <div class="card">
          <div class="card-body text-center">
            <h3 class="card-title mb-3">{{__('Update')}}</h3>
            <p class="card-text text-sm">{{__('Kindly update your SSN or EIN and National ID to verify your account.')}}</p>
                <form action="{{url('user/standverify')}}" enctype="multipart/form-data" method="post">
                @csrf
                    <div class="form-group">
                      <div class="custom-file">
                        <input type="text" class="form-control" name="verify_ssn" placeholder="Enter your SSN" value="{{$user->verify_ssn}}">
                        <input type="text" class="form-control mt-1" name="verify_ein" placeholder="Enter your EIN"  value="{{$user->verify_ein}}">
                        <input type="file" class="custom-file-input" id="customFileLang2" name="photo_id">
                        <label class="custom-file-label sdsd1" for="customFileLang2" style="top: 100px;">{{__('Upload National ID')}}</label>
                        <small class="text-left">(Format supported: PDF, JPG, JPEG, PNG files,<br> Max Size: 10MB,<br> National ID: Passport, National ID,Driving License, Insurance Card)</small>
                      </div> 
                    </div>              
                  <div class="text-center">
                    <button type="submit" class="btn btn-success btn-sm">{{__('Submit')}}</button>
                  </div>
                </form>
          </div>
        </div>
        @if(Auth::user()->user_type == 1)
            <div class="card">
                <div class="card-body text-center">
                    <span class="badge badge-pill badge-primary">
                        <a href="{{route('user.upgrade')}}"><span class="badge badge-pill badge-primary">Upgrade to Business</span></a>
                    </span>
                </div>
            </div>
        @else
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{__('Business Details')}}</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tbody> 
                        <tr>
                            <td>{{__('Company Certificate')}}</td>
                            <td><a href="{{url('/')}}/asset/profile/{{$user->kyc_link}}" target="_blank">{{__('View')}}</a></td>           
                        </tr>
                        <tr>
                            <td>{{__('Address id')}}</td>
                            <td><a href="{{url('/')}}/asset/profile/{{$user->address_id}}" target="_blank">{{__('View')}}</a></td>           
                        </tr>
                        <tr>
                            <td>{{__('National id')}}</td>
                            <td><a href="{{url('/')}}/asset/profile/{{$user->photo_id}}" target="_blank">{{__('View')}}</a></td>           
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @endif
            @if($set->kyc)
              <div class="card" id="kyc">
                <div class="card-body text-center">
                  <h3 class="card-title mb-3">{{__('Upgrade your Business')}}</h3>
                  <p class="card-text text-sm">To upgrade your business to a standard {{$set->site_name}} account with no limits, all you need is a Certificate of Registration.</p>
                  <span class="badge badge-pill badge-primary mb-3">
                    @if($user->kyc_status==0 && !empty($user->kyc_link))
                    {{__('Under Review')}}
                    @elseif($user->kyc_status==0 && empty($user->kyc_link))
                     {{__('Upload Document')}}
                    @elseif($user->kyc_status==2)
                    {{__('Rejected')}}
                    @else
                    {{__('Verified')}}
                    @endif
                  </span>
                  <!--@if(empty($user->kyc_link) || ($user->kyc_status==2))-->
                  <!--    <form method="post" action="{{url('user/kyc')}}" enctype="multipart/form-data">-->
                  <!--    @csrf-->
                  <!--        <div class="form-group">-->
                  <!--          <div class="custom-file">-->
                              <!--<input type="file" class="custom-file-input" id="customFileLang1" name="image" lang="en">-->
                  <!--            <input type="file" class="custom-file-input" id="customFileLang1" name="image">-->
                  <!--            <label class="custom-file-label sdsd" for="customFileLang1">{{__('Company Certificate')}}</label>-->
                  <!--            <input type="file" class="custom-file-input" id="customFileLang3" name="address_id">-->
                  <!--            <label class="custom-file-label sdsd2 mb-5" for="customFileLang3" style="top: 50px; height: calc(2.8em + 1.25rem + 2px) !important;">{{__('Address Proof Latest – latest bank statement or unities bill (within 90 days)')}}</label>-->
                  <!--            <small style="position: relative; top: 30px;">Document format supported PDF, JPG, JPEG, PNG or GIF files <br> Max Size: 10MB</small>-->
                  <!--          </div>-->
                  <!--        </div>-->
                  <!--      <div class="text-right">-->
                  <!--        <input type="submit" class="btn btn-success btn-sm" value="Upload">-->
                  <!--      </div>-->
                  <!--    </form>-->
                  <!--@endif-->
                </div>
              </div>
            @endif
          <div class="card">
          <div class="card-body text-center">
              <h3 class="card-title mb-3">{{__('Delete Account')}}</h3>
              <p class="card-text text-xs text-dark">{{__('Closing this account means you will no longer be able to access this account on')}} {{$set->site_name}}</p>
              <div class="text-right">
                  <a data-toggle="modal" data-target="#modal-formp" href="" class="btn btn-neutral btn-sm"><i class="fa fa-trash"></i> {{__('Delete Account')}}</a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div> 
    <div class="row">
      <div class="col-md-12">
        <div class="modal fade" id="modal-formp" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
              <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                  <div class="card-header">
                    <h3 class="mb-0">{{__('Delete Account')}}</h3>
                  </div>
                  <div class="card-body px-lg-5 py-lg-5">
                    <form action="{{route('delaccount')}}" method="post">
                      @csrf
                      <div class="form-group row">
                        <div class="col-lg-12">
                          <textarea type="text" name="reason" class="form-control" rows="5" placeholder="{{__('Sorry to see you leave, Please tell us why you are leaving')}}" required></textarea>
                        </div>
                      </div>             
                      <div class="text-right">
                        <button type="submit" class="btn btn-success btn-sm">{{__('Delete account')}}</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="modal-formx" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
              <div class="modal-body p-0">
                <div class="card bg-white border-0 mb-0">
                  <div class="card-header header-elements-inline">
                    <h3 class="mb-0">{{__('Change Password')}}</h3>
                  </div>
                  <div class="card-body px-lg-5 py-lg-5">
                    <form action="{{route('change.password')}}" method="post">
                      @csrf
                      <div class="form-group row">
                        <label class="col-form-label col-lg-4">{{__('New Password')}}</label>
                        <div class="col-lg-8">
                          <input type="password" name="password" class="form-control" minlength="6" placeholder="Your New Password" required>
                        </div>
                      </div>             
                      <div class="text-right">
                        <button type="submit" class="btn btn-success btn-sm">{{__('Change Password')}}</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> 
      </div>
    
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA7B46osUBu80aqL18GWC3UaSeaq98jrpg&callback=initAutocomplete&libraries=places&v=weekly"
      async
    ></script>
@stop