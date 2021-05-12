
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<section class="gray-bg effect-section">
    <div class="effect-1">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 361.1 384.8" style="enable-background:new 0 0 361.1 384.8;" xml:space="preserve" class="injected-svg svg_img white-color">
        <path d="M53.1,266.7C19.3,178-41,79.1,41.6,50.1S287.7-59.6,293.8,77.5c6.1,137.1,137.8,238,15.6,288.9 S86.8,355.4,53.1,266.7z"></path>
        </svg>
    </div>
    <div class="svg-bottom">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="96px" viewBox="0 0 100 100" version="1.1" preserveAspectRatio="none" class="injected-svg svg_img white-color">
            <path d="M0,0 C16.6666667,66 33.3333333,99 50,99 C66.6666667,99 83.3333333,66 100,0 L100,100 L0,100 L0,0 Z"></path>
        </svg>
    </div>
    <div class="container">
        <div class="row full-screen align-items-center p-50px-tb lg-p-100px-t justify-content-center">
            <div class="col-lg-6 m-50px-tb md-m-20px-t">
                <h6 class="typed theme3rd-bg p-5px-tb p-15px-lr d-inline-block white-color border-radius-15 m-25px-b" data-elements="<?php echo e($set->title); ?>"></h6>
                <h1 class="display-4 m-20px-b"><?php echo e($ui->header_title); ?></h1>
                <p class="font-2"><?php echo e($ui->header_body); ?></p>
                <div class="p-20px-t">
                    <a class="m-btn m-btn-radius m-btn-theme" href="<?php echo e(route('register')); ?>">
                        <span class="m-btn-inner-text"><?php echo e(__('Get Started')); ?></span>
                        <span class="m-btn-inner-icon arrow"></span>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 m-50px-tb lg-m-0px-t text-center">
                <img class="max-width-140" src="<?php echo e(url('/')); ?>/asset/images/<?php echo e($ui->s4_image); ?>" title="" alt="">
            </div>
        </div>
    </div>
</section>
<section class="section p-0px-t section-top-up-100">
    <div class="container">
        <div class="row">
            <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-sm-6 col-lg-3 m-15px-tb">
                <div class="p-25px-lr p-35px-tb white-bg box-shadow-lg hover-top border-radius-15">
                    <h5 class="m-10px-b"><?php echo e($val->title); ?></h5>
                    <p class="m-0px"><?php echo e($val->details); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<div class="p-40px-tb border-top-1 border-bottom-1 border-color-gray">
    <div class="container">
        <div class="owl-carousel owl-loaded owl-drag" data-items="7" data-nav-dots="false" data-md-items="6" data-sm-items="5" data-xs-items="4" data-xx-items="3" data-space="30" data-autoplay="true">
            <?php $__currentLoopData = $brand; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brands): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="p8">
                    <img src="<?php echo e(url('/')); ?>/asset/brands/<?php echo e($brands->image); ?>" title="" alt="">
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<section class="section effect-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 m-15px-tb text-center">
                <img src="<?php echo e(url('/')); ?>/asset/images/<?php echo e($ui->s3_image); ?>" title="" alt="">
            </div>
            <div class="col-lg-6 m-15px-tb">
                <h3 class="h1"><?php echo e($ui->s3_title); ?></h3>
                <p class="font-2 p-0px-t"><?php echo e($ui->s3_body); ?></p>
                <div class="border-left-2 border-color-theme p-25px-l m-35px-t">
                    <h6 class="font-2"><?php echo e($set->title); ?></h6>
                    <p><?php echo e(__('Stimulate your sales with modular payment solutions and loyalty programs!')); ?></p>
                </div>
                <div class="p-20px-t">
                    <a class="m-btn m-btn-radius m-btn-theme" href="<?php echo e(route('about')); ?>">
                        <span class="m-btn-inner-text">More About Us</span>
                        <span class="m-btn-inner-icon arrow"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section effect-section">
    <div class="container">
        <div class="row justify-content-center md-m-25px-b m-40px-b">
            <div class="col-lg-8 text-center">
                <h3 class="h1 m-15px-b"><?php echo e($ui->s6_title); ?></h3>
                <p class="m-0px font-2"><?php echo e($ui->s6_body); ?></p>
            </div>
        </div>
        <div class="row justify-content-between">
            <div class="col-lg-5 m-15px-tb">
                <div class="media box-shadow p5 m-30px-b">
                    <div class="icon-70 theme-color theme-bg-alt border-radius-50">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="media-body p-15px-l">
                        <h5>Sell products</h5>
                        <p class="m-0px"><?php echo e(__('Any product can now be sold easily. Create & share your products to clients')); ?></p>
                    </div>
                </div>
                <div class="media box-shadow p5 m-30px-b">
                    <div class="icon-70 green-color green-bg-alt border-radius-50">
                        <i class="fas fa-file-invoice"></i>
                    </div>
                    <div class="media-body p-15px-l">
                        <h5>Send invoice</h5>
                        <p class="m-0px"><?php echo e(__('Billing of your clients is now possible with invoice system, requesting money from anyone is now easy')); ?></p>
                    </div>
                </div>
                <div class="media box-shadow p5">
                    <div class="icon-70 yellow-color yellow-bg-alt border-radius-50">
                        <i class="fas fa-drafting-compass"></i>
                    </div>
                    <div class="media-body p-15px-l">
                        <h5>Merchant integeration</h5>
                        <p class="m-0px">Receiving money on your website is now easy with simple integeration at a fee of <?php echo e($set->merchant_charge); ?>% per transaction</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 m-15px-tb">
                <img class="max-width-120" src="<?php echo e(url('/')); ?>/asset/images/<?php echo e($ui->s2_image); ?>" title="" alt="">
            </div>
        </div>
    </div>
</section>
<?php if(count($review)>0): ?>
<section class="p-50px-t">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-6">
                <img src="<?php echo e(url('/')); ?>/asset/images/<?php echo e($ui->s7_image); ?>" title="" alt="">
            </div>
            <div class="col-lg-5 m-30px-b m-30px-t">
                <h3 class="h3 m-30px-b"><?php echo e($ui->s7_title); ?></h3>
                <div class="owl-carousel owl-nav-arrow-bottom white-bg box-shadow-lg p5" data-items="1" data-nav-arrow="true" data-nav-dots="false" data-md-items="1" data-sm-items="1" data-xs-items="1" data-xx-items="1" data-space="0" data-autoplay="true">
                    <?php $__currentLoopData = $review; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vreview): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="p-25px m-20px-b">
                        <p class="m-0px"><?php echo e($vreview->review); ?></p>
                        <div class="media m-20px-t">
                            <div class="avatar-60 border-radius-50">
                                <img src="<?php echo e(url('/')); ?>/asset/review/<?php echo e($vreview->image_link); ?>" alt="" title="">
                            </div>
                            <div class="media-body p-15px-l align-self-center">
                                <h6 class="m-0px"><?php echo e($vreview->name); ?></h6>
                                <span class="font-small"><?php echo e($vreview->occupation); ?></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<section class="section gray-bg">
    <div class="container">
        <div class="row justify-content-center md-m-25px-b m-40px-b">
            <div class="col-lg-8 text-center">
                <h3 class="h1 m-15px-b"><?php echo e(__('Latest News')); ?></h3>
            </div>
        </div>
        <div class="row">
            <?php $__currentLoopData = $blog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 m-15px-tb">
                    <div class="card blog-grid-1">
                        <div class="blog-img">
                            <a href="<?php echo e(url('/')); ?>/single/<?php echo e($val->id); ?>/<?php echo e(str_slug($val->title)); ?>">
                                <img src="<?php echo e(url('/')); ?>/asset/thumbnails/<?php echo e($val->image); ?>" title="" alt="">
                            </a>
                            <span class="date"><?php echo e(date("j", strtotime($val->created_at))); ?> <span><?php echo e(date("M", strtotime($val->created_at))); ?></span></span>
                        </div>
                        <div class="card-body blog-info">
                            <h5>
                                <a href="<?php echo e(url('/')); ?>/single/<?php echo e($val->id); ?>/<?php echo e(str_slug($val->title)); ?>"><?php echo e($val->title); ?></a>
                            </h5>
                            <p class="m-0px"><?php echo str_limit($val->details, 60);; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="row justify-content-center md-m-25px-b m-40px-b">
            <div class="col-lg-6 text-center">
                <h3 class="h1 m-0px"><?php echo e(__('Join millions who choose')); ?> <?php echo e($set->site_name); ?> <?php echo e(__('worldwide.')); ?></h3>
                <div class="p-20px-t">
                    <a class="m-btn m-btn-dark m-btn-radius" href="<?php echo e(route('register')); ?>"><?php echo e(__('Sign Up for Free')); ?> </a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section bg-no-repeat bg-right-center gray-bg" id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-15px-tb">
                <div class="row md-m-25px-b m-40px-b">
                    <div class="col-lg-12">
                        <h3 class="h1 m-15px-b">Need a hand?</h3>
                        <p class="m-0px font-2">We are always open and we welcome and questions you have for our team. If you wish to get in touch, please fill out the form below. Someone from our team will get back to you shortly.</p>
                    </div>
                </div>
                <form class="rd-mailform" method="post" action="<?php echo e(route('contact-submit')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input  type="text" name="name" placeholder="Rachel Roth" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input  type="email" name="email" placeholder="name@example.com"  class="form-control">
                            </div>
                        </div>                        
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input  type="number" name="mobile" placeholder="12345678987"  class="form-control">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <textarea class="form-control" name="message" rows="3" placeholder="Hi there, I would like to ..."></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="m-btn m-btn-dark m-btn-radius" type="submit" name="send">Get Started</button>
                        </div>
                    </div>
                </form>
                <div class="h1 theme-color"></div>
                <div class="media align-items-center p-10px-tb">
                    <div class="icon-40 theme-bg-alt border-radius-50 theme-color">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="media-body p-15px-l">
                        <h6 class="h4 m-0px"><?php echo e($set->mobile); ?></h6>
                    </div>
                </div>                
                <div class="media align-items-center p-10px-tb">
                    <div class="icon-40 theme-bg-alt border-radius-50 theme-color">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="media-body p-15px-l">
                        <h6 class="h4 m-0px"><?php echo e($set->email); ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 m-15px-tb ml-auto" id="faq">
                <div class="accordion accordion-08 p10 border-radius-15 dark-bg white-color-light links-white">
                    <?php $__currentLoopData = $faq; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vfaq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="acco-group">
                        <a href="#" class="acco-heading"><?php echo e($vfaq->question); ?></a>
                        <div class="acco-des"><?php echo $vfaq->answer; ?></div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/boompay/core/resources/views/front/index.blade.php ENDPATH**/ ?>