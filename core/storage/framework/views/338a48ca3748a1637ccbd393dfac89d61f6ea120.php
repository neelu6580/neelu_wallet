<?php $__env->startSection('content'); ?>
<div class="main-content">
    <!-- Header -->
    <div class="header bg-future py-7 py-lg-5 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-dark"><?php echo e(__('Create an account')); ?></h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-7 col-md-7">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-header bg-transparent pb-3">
            </div>
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-dark mb-5">
                <small><?php echo e(__('Lets get to know you')); ?></small>
              </div>
              <form role="form" action="<?php echo e(route('submitregister')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="form-group row">
                  <div class="col-lg-12">
                    <div class="row">
                        <div class="col-6">
                          <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                              <span class="input-group-text text-future"><i class="fa fa-user"></i></span>
                            </div>
                            <input class="form-control" placeholder="<?php echo e(__('First Name')); ?>" type="text" name="first_name" required>
                          </div>
                        </div>      
                        <div class="col-6">
                          <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                              <span class="input-group-text text-future"><i class="fa fa-user"></i></span>
                            </div>
                            <input class="form-control" placeholder="<?php echo e(__('Last Name')); ?>" type="text" name="last_name" required>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="ni ni-user-run"></i></span>
                    </div>
                    <input class="form-control" placeholder="<?php echo e(__('Business Name')); ?>" type="text" name="business_name" required>
                  </div>
                  <?php if($errors->has('business_name')): ?>
                    <span class="error form-error-msg "><?php echo e($errors->first('business_name')); ?></span>
                  <?php endif; ?>
                </div>                                              
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="<?php echo e(__('Email')); ?>" type="email" name="email" required>
                  </div>
                  <?php if($errors->has('email')): ?>
                    <span class="error form-error-msg"><?php echo e($errors->first('email')); ?></span>
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
                    <span class="error form-error-msg "><?php echo e($errors->first('password')); ?></span>
                  <?php endif; ?>
                </div>
                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input class="custom-control-input" id=" customCheckLogin" type="checkbox" required>
                  <label class="custom-control-label" for=" customCheckLogin">
                    <span class="text-muted">Agree to <a href="<?php echo e(route('terms')); ?>">Terms & Conditions</a></span>
                  </label>
                </div>
                <?php if($set->recaptcha==1): ?>
                  <?php echo app('captcha')->display(); ?>

                  <?php if($errors->has('g-recaptcha-response')): ?>
                      <span class="help-block">
                          <?php echo e($errors->first('g-recaptcha-response')); ?>

                      </span>
                  <?php endif; ?>
                <?php endif; ?>
                <div class="text-center">
                  <button type="submit" class="btn btn-success my-4"><?php echo e(__('Create an account')); ?></button>
                </div>
                <div class="row mt-3">
                  <div class="col-6">
                    <a href="<?php echo e(route('user.password.request')); ?>" class="text-dark"><small><?php echo e(__('Forgot password?')); ?></small></a>
                  </div>
                  <div class="col-6 text-right">
                    <a href="<?php echo e(route('login')); ?>" class="text-dark"><small><?php echo e(__('Login')); ?></small></a>
                  </div>
                </div>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('loginlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/boompay/core/resources/views//auth/register.blade.php ENDPATH**/ ?>