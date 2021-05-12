<?php $__env->startSection('content'); ?>
<div class="main-content">
    <!-- Header -->
    <div class="header bg-future py-7 py-lg-5 pt-lg-9" style="margin-top:-4rem">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-dark"><?php echo e(__('Sign In')); ?></h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-header bg-transparent pb-3">
            </div>
            <div class="card-body px-lg-5 py-lg-5" style="padding-top:0rem!important">
              <div class="text-center text-dark mb-5" style="    margin-bottom: 1rem !important;">
                <small><?php echo e(__('Welcome back,')); ?> please confirm you are visiting <?php echo e(url('/')); ?></small>
              </div>
              
              <script>
// Add active class to the current button (highlight it)
var header = document.getElementById("nav-tabs");
var btns = header.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("active");
  current[0].className = current[0].className.replace(" active", "");
  this.className += " active";
  });
}
</script>
<style>
    <style>
/* Style the buttons */
.btn {
  border: none;
  outline: none;
  padding: 10px 16px;
  background-color: #f1f1f1;
  cursor: pointer;
  font-size: 18px;
}

/* Style the active class, and buttons on mouse-over */
.active, .btn:hover {
  background-color: #666;
  color: white;
}

.form-error-msg{
                color:red;
            }
</style>
</style>
              
              <ul class="nav nav-tabs login-mobile-rep" style="    padding-bottom: 10px;">
                   <li><button class="btn active btn2 login-btn " data-toggle="tab" href="#emailtab">Login By Email</button></li>
                   <p style="text-align:center;    margin-bottom: 5px;
    margin-top: 5px;">Or</p>
              <li><button class="btn login-btn " data-toggle="tab" href="#phonetab">Login By Phone</button></li>
              
             
            </ul>
            
            <div class="tab-content">
             
              <div id="phonetab" class="tab-pane fade in" style="    background: #f7fafc;">
                <form role="form" action="<?php echo e(route('submitloginphone')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="fa fa-phone"></i></span>
                    </div>
                    <?php $countries =DB::table('countries')->get(); ?>
                            <select class="form-control" name="prefix" style="max-width: 80px;">
                                <option value="">Select Country Code</option>
                                <?php foreach($countries as $country){?>
                                <option value="<?=$country->id?>" <?=($country->iso_code =='US') ? 'selected' : ''?>><?= '( +'.$country->calling_code .') '. $country->name ?></option>
                                <?php }?>
                            </select>
                    <input class="form-control" placeholder="<?php echo e(__('Phone')); ?>" type="number" step="any" name="phone" required>
                  </div>
                  <?php if($errors->has('email')): ?>
                      <span class="error form-error-msg ">
                        <strong><?php echo e($errors->first('email')); ?></strong>
                      </span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="<?php echo e(__('Password')); ?>" type="password" name="password" required>
                  </div>
                  <?php if($errors->has('password')): ?>
                    <span class="error form-error-msg ">
                      <strong><?php echo e($errors->first('password')); ?></strong>
                    </span>
                  <?php endif; ?>
                </div>
                <!--<div class="custom-control custom-control-alternative custom-checkbox">-->
                <!--  <input class="custom-control-input" id=" customCheckLogin" type="checkbox" name="remember_me">-->
                <!--  <label class="custom-control-label" for=" customCheckLogin">-->
                <!--    <span class="text-muted"><?php echo e(__('Remember me')); ?></span>-->
                <!--  </label>-->
                <!--</div>-->
               
                <?php if($set->recaptcha==1): ?>
                <div class="form-group">
                  
                  <?php echo app('captcha')->display(); ?>

                  <?php if($errors->has('g-recaptcha-response')): ?>
                      <span class="help-block">
                          <?php echo e($errors->first('g-recaptcha-response')); ?>

                      </span>
                  <?php endif; ?>
                  </div>
                <?php endif; ?>
                <div class="text-center">
                  <button type="submit" class="btn btn-success my-4 text-uppercase" style="    margin-top: 0.5rem !important;    margin-bottom: 0.5rem !important;"><?php echo e(__('Login')); ?></button>
                </div>
                <div class="row mt-3">
                  <div class="col-6">
                    <a href="<?php echo e(route('user.password.request')); ?>" class="text-dark"><small><?php echo e(__('Forgot password?')); ?></small></a>
                  </div>
                  <div class="col-6 text-right">
                    <a href="<?php echo e(route('register')); ?>" class="text-dark"><small><?php echo e(__('Create an account')); ?></small></a>
                  </div>
                </div>
              </form>
              </div>
              
               <div id="emailtab" class="tab-pane fade active show" style="    background: #f7fafc;">
                <form role="form" action="<?php echo e(route('submitlogin')); ?>" method="post">
                <?php echo csrf_field(); ?>
                
                
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="<?php echo e(__('Email')); ?>" type="email" name="email" required>
                  </div>
                  <?php if($errors->has('email')): ?>
                      <span class="error form-error-msg ">
                        <strong><?php echo e($errors->first('email')); ?></strong>
                      </span>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" placeholder="<?php echo e(__('Password')); ?>" type="password" name="password" required>
                  </div>
                  <?php if($errors->has('password')): ?>
                    <span class="error form-error-msg ">
                      <strong><?php echo e($errors->first('password')); ?></strong>
                    </span>
                  <?php endif; ?>
                </div>
                <!--<div class="custom-control custom-control-alternative custom-checkbox">-->
                <!--  <input class="custom-control-input" id=" customCheckLogin" type="checkbox" name="remember_me">-->
                <!--  <label class="custom-control-label" for=" customCheckLogin">-->
                <!--    <span class="text-muted"><?php echo e(__('Remember me')); ?></span>-->
                <!--  </label>-->
                <!--</div>-->
                
                <?php if($set->recaptcha==1): ?>
                  <?php echo app('captcha')->display(); ?>

                  <?php if($errors->has('g-recaptcha-response')): ?>
                      <span class="help-block">
                          <?php echo e($errors->first('g-recaptcha-response')); ?>

                      </span>
                  <?php endif; ?>
                <?php endif; ?>
                
                
                <div class="text-center">
                  <button type="submit" class="btn btn-success my-4 text-uppercase"><?php echo e(__('Login')); ?></button>
                </div>
                <div class="row mt-3">
                  <div class="col-6">
                    <a href="<?php echo e(route('user.password.request')); ?>" class="text-dark"><small><?php echo e(__('Forgot password?')); ?></small></a>
                  </div>
                  <div class="col-6 text-right">
                    <a href="<?php echo e(route('register')); ?>" class="text-dark"><small><?php echo e(__('Create an account')); ?></small></a>
                  </div>
                </div>
              </form>
              </div>
            </div>



              
            </div>
          </div>
        </div>
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('loginlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/greenvx4/public_html/vcard/core/resources/views//auth/login.blade.php ENDPATH**/ ?>