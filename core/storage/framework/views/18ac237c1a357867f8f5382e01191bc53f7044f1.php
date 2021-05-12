<!doctype html>
<html class="no-js" lang="en">
    <head>
        <base href="<?php echo e(url('/')); ?>"/>
        <title><?php echo e($title); ?> - <?php echo e($set->site_name); ?></title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="robots" content="index, follow">
        <meta name="apple-mobile-web-app-title" content="<?php echo e($set->site_name); ?>"/>
        <meta name="application-name" content="<?php echo e($set->site_name); ?>"/>
        <meta name="msapplication-TileColor" content="#ffffff"/>
        <meta name="description" content="<?php echo e($set->site_desc); ?>" />
        <link rel="shortcut icon" href="<?php echo e(url('/')); ?>/asset/<?php echo e($logo->image_link2); ?>" />
        <link rel="apple-touch-icon" href="<?php echo e(url('/')); ?>/asset/<?php echo e($logo->image_link2); ?>" />
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo e(url('/')); ?>/asset/<?php echo e($logo->image_link2); ?>" />
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo e(url('/')); ?>/asset/<?php echo e($logo->image_link2); ?>" />
        <link href="<?php echo e(url('/')); ?>/asset/static/plugin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo e(url('/')); ?>/asset/static/plugin/font-awesome/css/all.min.css" rel="stylesheet">
        <link href="<?php echo e(url('/')); ?>/asset/static/plugin/et-line/style.css" rel="stylesheet">
        <link href="<?php echo e(url('/')); ?>/asset/static/plugin/themify-icons/themify-icons.css" rel="stylesheet">
        <link href="<?php echo e(url('/')); ?>/asset/static/plugin/ionicons/css/ionicons.min.css" rel="stylesheet">
        <link href="<?php echo e(url('/')); ?>/asset/static/plugin/owl-carousel/css/owl.carousel.min.css" rel="stylesheet">
        <link href="<?php echo e(url('/')); ?>/asset/static/plugin/magnific/magnific-popup.css" rel="stylesheet">
        <link href="<?php echo e(url('/')); ?>/asset/static/style/master.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/asset/css/sweetalert.css" type="text/css">
         <?php echo $__env->yieldContent('css'); ?>
    </head>

    <body data-spy="scroll" data-target="#navbar-collapse-toggle" data-offset="98">
    <!-- Preload -->
    <div id="loading">
        <div class="load-circle"><span class="one"></span></div>
    </div>
    <!-- End Preload -->
    <!-- Header -->
    <header class="header-nav header-dark">
        <div class="fixed-header-bar">
            <!-- Header Nav -->
            <div class="navbar navbar-main navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                        <img alt="" title="" src="<?php echo e(url('/')); ?>/asset/<?php echo e($logo->image_link); ?>">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-main-collapse" aria-controls="navbar-main-collapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse navbar-collapse-overlay" id="navbar-main-collapse">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('about')); ?>"><?php echo e(__('Why')); ?> <?php echo e($set->site_name); ?></a>
                            </li>
                            <li class="nav-item mm-in px-dropdown">
                                <a class="nav-link" href="#"><?php echo e(__('Business')); ?></a>
                                <i class="fa fa-angle-down px-nav-toggle"></i>
                                <ul class="px-dropdown-menu mm-dorp-in">
                                    <?php $__currentLoopData = $cat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a href="<?php echo e(url('/')); ?>/cat/<?php echo e($vcat->id); ?>/1"><?php echo e($vcat->categories); ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </li>                          
                            <li class="nav-item mm-in px-dropdown">
                                <a class="nav-link" href="#"><?php echo e(__('Help')); ?></a>
                                <i class="fa fa-angle-down px-nav-toggle"></i>
                                <ul class="px-dropdown-menu mm-dorp-in">
                                    <li><a href="<?php echo e(url('/')); ?>#faq"><?php echo e(__('FAQs')); ?></a></li>
                                    <li><a href="<?php echo e(route('terms')); ?>"><?php echo e(__('Terms & Conditions')); ?></a></li>
                                    <li><a href="<?php echo e(route('privacy')); ?>"><?php echo e(__('Privacy policy')); ?></a></li>
                                    <li><a href="<?php echo e(url('/')); ?>#contact"><?php echo e(__('Contact us')); ?></a></li>
                                </ul>
                            </li>                            
                            <li class="nav-item mm-in px-dropdown">
                                <a class="nav-link" href="#"><?php echo e(__('Services')); ?></a>
                                <i class="fa fa-angle-down px-nav-toggle"></i>
                                <ul class="px-dropdown-menu mm-dorp-in">
                                    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vpages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(!empty($vpages)): ?>
                                        <li><a href="<?php echo e(url('/')); ?>/page/<?php echo e($vpages->id); ?>"><?php echo e($vpages->title); ?></a></li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </li>
                            <?php if(Auth::guard('user')->check()): ?>
                            <li class="nav-item d-md-none">
                                <a class="nav-link" href="<?php echo e(route('user.dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a>
                            </li>
                            <?php else: ?>
                            <li class="nav-item d-md-none">
                                <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                            </li>
                            <?php endif; ?>
                        </ul>
                        <?php if(Auth::guard('user')->check()): ?>
                        <a href="<?php echo e(route('user.dashboard')); ?>" class="d-none d-lg-inline-block m-btn m-btn-radius m-btn-theme2nd m-btn-sm m-20px-l"><?php echo e(__('Dashboard')); ?></a>
                        <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="d-none d-lg-inline-block m-btn m-btn-radius m-btn-theme2nd m-btn-sm m-20px-l"><?php echo e(__('Login')); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- End Header Nav -->
        </div>
    </header>
    <!-- Header End -->
    <!-- Main -->
    <main>
<?php echo $__env->yieldContent('content'); ?>
<footer class="dark-bg footer">
        <div class="footer-top border-style top light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 m-15px-tb">
                        <div class="p-25px-b">
                            <img src="<?php echo e(url('/')); ?>/asset/<?php echo e($logo->image_link); ?>" title="" alt="">
                        </div>
                        <p class="white-color-light">
                        <?php echo e($set->title); ?>

                        </p>
                        <div class="social-icon si-30 white round nav">
                            <?php $__currentLoopData = $social; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $socials): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!empty($socials->value)): ?>
                                <a href="<?php echo e($socials->value); ?>"><i class="fab fa-<?php echo e($socials->type); ?>"></i></a>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="col-lg-2 col-6 col-sm-4 ml-lg-auto m-15px-tb">
                        <h5 class="white-color footer-title">
                            <?php echo e(__('Quick links')); ?>

                        </h5>
                        <ul class="list-unstyled links-white footer-link-1">
                            <li><a href="<?php echo e(url('/')); ?>#contact"><?php echo e(__('Contact')); ?></a></li>
                            <li><a href="<?php echo e(route('user.merchant')); ?>"><?php echo e(__('Merchant Services')); ?></a></li>
                            <li><a href="<?php echo e(route('user.invoice')); ?>"><?php echo e(__('Send Invoices')); ?></a></li>
                            <li><a href="<?php echo e(route('user.product')); ?>"><?php echo e(__('Sell Products')); ?></a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-6 col-sm-4 m-15px-tb">
                        <h5 class="white-color footer-title">
                        <?php echo e(__('Company')); ?>

                        </h5>
                        <ul class="list-unstyled links-white footer-link-1">
                            <li><a href="<?php echo e(route('about')); ?>"><?php echo e(__('About us')); ?></a></li>
                            <li><a href="<?php echo e(route('terms')); ?>"><?php echo e(__('Terms of Use')); ?></a></li>
                            <li><a href="<?php echo e(route('privacy')); ?>"><?php echo e(__('Privacy Policy')); ?></a></li>
                            <?php if(count($faq)>0): ?>
                            <li><a href="<?php echo e(url('/')); ?>#faq"><?php echo e(__('FAQs')); ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-6 col-sm-4 m-15px-tb">
                        <h5 class="white-color footer-title">
                            <?php echo e(__('More')); ?>

                        </h5>
                        <ul class="list-unstyled links-white footer-link-1">
                            <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vpages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!empty($vpages)): ?>
                            <li><a href="<?php echo e(url('/')); ?>/page/<?php echo e($vpages->id); ?>"><?php echo e($vpages->title); ?></a></li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom border-style top light">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-left m-5px-tb">
                        <p class="m-0px font-small white-color-light"><?php echo e($set->site_name); ?>  &copy; <?php echo e(date('Y')); ?>. <?php echo e(__('All Rights Reserved.')); ?></p>
                    </div>
                    <div class="col-md-6 m-5px-tb">
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
        <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/<?php echo e($set->livechat); ?>/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script>
        <script>
            var urx = "<?php echo e(url('/')); ?>";
        </script>
        <script src="<?php echo e(url('/')); ?>/asset/js/sweetalert.js"></script>  
        <script src="<?php echo e(url('/')); ?>/asset/static/js/jquery-3.2.1.min.js"></script>
        <script src="<?php echo e(url('/')); ?>/asset/static/js/jquery-migrate-3.0.0.min.js"></script>
        <script src="<?php echo e(url('/')); ?>/asset/static/plugin/appear/jquery.appear.js"></script>
        <script src="<?php echo e(url('/')); ?>/asset/static/plugin/bootstrap/js/popper.min.js"></script>
        <script src="<?php echo e(url('/')); ?>/asset/static/plugin/bootstrap/js/bootstrap.js"></script>
        <script src="<?php echo e(url('/')); ?>/asset/static/js/custom.js"></script>
<?php echo $__env->make('sweetalert::alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('script'); ?>
<?php if(session('success')): ?>
    <script>
        $(document).ready(function () {
            swal("Success!", "<?php echo e(session('success')); ?>", "success");
        });
    </script>
<?php endif; ?>
<?php if(session('alert')): ?>
    <script>
        $(document).ready(function () {
            swal("Sorry!", "<?php echo e(session('alert')); ?>", "error");
        });
    </script>
<?php endif; ?>
<script>
    <?php if(Session::has('message')): ?>
    var type = "<?php echo e(Session::get('alert-type','info')); ?>";
    switch (type) {
        case 'info':
            toastr.info("<?php echo e(Session::get('message')); ?>");
            break;
        case 'warning':
            toastr.warning("<?php echo e(Session::get('message')); ?>");
            break;
        case 'success':
            toastr.success("<?php echo e(Session::get('message')); ?>");
            break;
        case 'error':
            toastr.error("<?php echo e(Session::get('message')); ?>");
            break;
    }
    <?php endif; ?>
</script>
</body>
</html><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/boompay/core/resources/views/layout.blade.php ENDPATH**/ ?>