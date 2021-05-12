<!doctype html>
<html class="no-js" lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <base href="<?php echo e(url('/')); ?>"/>
        <title><?php echo e($title); ?> | <?php echo e($set->site_name); ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
        <meta name="robots" content="index, follow">
        <meta name="apple-mobile-web-app-title" content="<?php echo e($set->site_name); ?>"/>
        <meta name="application-name" content="<?php echo e($set->site_name); ?>"/>
        <meta name="msapplication-TileColor" content="#ffffff"/>
        <meta name="description" content="<?php echo e($set->site_desc); ?>" />
        <link rel="shortcut icon" href="<?php echo e(url('/')); ?>/asset/<?php echo e($logo->image_link2); ?>" />
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/asset/css/sweetalert.css" type="text/css">
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/asset/dashboard/vendor/nucleo/css/nucleo.css" type="text/css">
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/asset/dashboard/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/asset/dashboard/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/asset/dashboard/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/asset/dashboard/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css">
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/asset/dashboard/css/argon.css?v=1.1.0" type="text/css">
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/asset/css/sweetalert.css" type="text/css">
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/asset/dashboard/vendor/select2/dist/css/select2.min.css">
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/asset/dashboard/vendor/quill/dist/quill.core.css">
        <link href="<?php echo e(url('/')); ?>/asset/fonts/fontawesome/styles.min.css" rel="stylesheet" type="text/css">
         <?php echo $__env->yieldContent('css'); ?>
    </head>
<!-- header begin-->
<body>
  <div class=""></div>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-dark bg-cyan" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
          <img src="<?php echo e(url('/')); ?>/asset/<?php echo e($logo->image_link); ?>" class="navbar-brand-img" alt="...">
        </a>
        <div class="ml-auto">
          <!-- Sidenav toggler -->
          <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line bg-light"></i>
              <i class="sidenav-toggler-line bg-light"></i>
              <i class="sidenav-toggler-line bg-light"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link <?php if(route('user.dashboard')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('user.dashboard')); ?>">
                <i class="fa fa-television"></i>
                <span class="nav-link-text"><?php echo e(__('Overview')); ?></span>
              </a>
            </li>  
          </ul>
          <hr class="my-3">
          <h6 class="navbar-heading p-0 text-muted"><?php echo e(__('Your Business')); ?></h6>
          <ul class="navbar-nav">                                            
            <li class="nav-item">
              <a class="nav-link <?php if(route('user.ownbank')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('user.ownbank')); ?>">
                <i class="fa fa-send-o"></i>
                <span class="nav-link-text"><?php echo e(__('Transfers')); ?> 
                  <?php if(count($p_transfer)>0): ?>
                    <span class="badge badge-sm badge-circle badge-floating badge-danger border-white">
                    <?php echo e(count($p_transfer)); ?>

                    </span>
                  <?php endif; ?>
                </span>
              </a>
            </li>   
            <li class="nav-item">
              <a class="nav-link <?php if(route('user.sub')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('user.sub')); ?>">
                <i class="fa fa-bookmark-o"></i>
                <span class="nav-link-text"><?php echo e(__('Subscriptions')); ?></span>
              </a>
            </li>           
            <li class="nav-item">
              <a class="nav-link <?php if(route('user.withdraw')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('user.withdraw')); ?>">
                <i class="fa fa-braille"></i>
                <span class="nav-link-text"><?php echo e(__('Settlements')); ?></span>
              </a>
            </li>                                               
          </ul>
          <hr class="my-3">
          <h6 class="navbar-heading p-0 text-muted"><?php echo e(__('Collect Payments')); ?></h6>
          <ul class="navbar-nav mb-md-3">  
            <li class="nav-item">
              <a class="nav-link <?php if(route('user.product')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('user.product')); ?>">
                <i class="fa fa-shopping-bag"></i>
                <span class="nav-link-text"><?php echo e(__('Store')); ?></span>
              </a>
            </li> 
            <li class="nav-item">
              <a class="nav-link <?php if(route('user.request')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('user.request')); ?>">
                <i class="fa fa-hand-peace-o"></i>
                <span class="nav-link-text"><?php echo e(__('Request Money')); ?>

                  <?php if(count($p_request)>0): ?>
                    <span class="badge badge-sm badge-circle badge-floating badge-danger border-white">
                    <?php echo e(count($p_request)); ?>

                    </span>
                  <?php endif; ?>
                </span>
              </a>
            </li>            
            <li class="nav-item">
              <a class="nav-link <?php if(route('user.sclinks')==url()->current() || route('user.dplinks')==url()->current()): ?> active <?php endif; ?>" href="#navbar-examples3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples3">
                <!--For modern browsers-->
                <i class="fa fa-tags"></i>
                <span class="nav-link-text"><?php echo e(__('Payment Links')); ?></span>
              </a>
              <div class="collapse <?php if(route('user.sclinks')==url()->current() || route('user.dplinks')==url()->current()): ?> show <?php endif; ?>" id="navbar-examples3">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item <?php if(route('user.sclinks')==url()->current()): ?> active <?php endif; ?> text-default">
                    <a href="<?php echo e(route('user.sclinks')); ?>" class="nav-link"><?php echo e(__('Single Charge')); ?></a>
                  </li>                                 
                  <li class="nav-item <?php if(route('user.dplinks')==url()->current()): ?> active <?php endif; ?> text-default">
                    <a href="<?php echo e(route('user.dplinks')); ?>" class="nav-link"><?php echo e(__('Donation')); ?></a>
                  </li>                               
                </ul>
              </div>
            </li> 
            <?php if($set->merchant==1): ?>
              <li class="nav-item">
                <a class="nav-link <?php if(route('user.merchant')==url()->current() || route('user.merchant-documentation')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('user.merchant')); ?>">
                  <i class="fa fa-laptop"></i>
                  <span class="nav-link-text"><?php echo e(__('Website Integration')); ?></span>
                </a>
              </li>  
            <?php endif; ?>  
          </ul>
          <hr class="my-3">
          <h6 class="navbar-heading p-0 text-muted"><?php echo e(__('Billing tools')); ?></h6>
          <ul class="navbar-nav mb-md-3">  
            <li class="nav-item">
              <a class="nav-link <?php if(route('user.invoice')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('user.invoice')); ?>">
                <i class="fas fa-file-invoice"></i>
                <span class="nav-link-text"><?php echo e(__('Invoice')); ?></span>
              </a>
            </li>             
            <li class="nav-item">
              <a class="nav-link <?php if(route('user.plan')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('user.plan')); ?>">
                <i class="fa fa-sticky-note-o"></i>
                <span class="nav-link-text"><?php echo e(__('Payment Plans')); ?></span>
              </a>
            </li> 
          </ul>
          <hr class="my-3">
          <h6 class="navbar-heading p-0 text-muted"><?php echo e(__('Account')); ?></h6>
          <ul class="navbar-nav mb-md-3">  
            <li class="nav-item">
              <a class="nav-link <?php if(route('user.bank')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('user.bank')); ?>">
                <i class="fa fa-braille"></i>
                <span class="nav-link-text"><?php echo e(__('Bank Accounts')); ?></span>
              </a>
            </li>            
            <li class="nav-item">
              <a class="nav-link <?php if(route('user.charges')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('user.charges')); ?>">
                <i class="fa fa-pie-chart"></i>
                <span class="nav-link-text"><?php echo e(__('Charges')); ?></span>
              </a>
            </li>  
            <li class="nav-item">
              <a class="nav-link <?php if(route('user.transactionssc')==url()->current() || route('user.invoicelog')==url()->current() || route('user.senderlog')==url()->current() || route('user.transactionsd')==url()->current() || route('user.depositlog')==url()->current() || route('user.banktransfer')==url()->current()): ?> active <?php endif; ?>" href="#navbar-examples2" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples2">
                <!--For modern browsers-->
                <i class="fa fa-credit-card"></i>
                <span class="nav-link-text"><?php echo e(__('Transactions')); ?></span>
              </a>
              <div class="collapse <?php if(route('user.transactionssc')==url()->current() || route('user.invoicelog')==url()->current() || route('user.senderlog')==url()->current() || route('user.transactionsd')==url()->current() || route('user.depositlog')==url()->current() || route('user.banktransfer')==url()->current()): ?> show <?php endif; ?>" id="navbar-examples2">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item <?php if(route('user.transactionssc')==url()->current()): ?> active <?php endif; ?> text-default">
                    <a href="<?php echo e(route('user.transactionssc')); ?>" class="nav-link"><?php echo e(__('Single Charge')); ?></a>
                  </li>                                 
                  <li class="nav-item <?php if(route('user.transactionsd')==url()->current()): ?> active <?php endif; ?> text-default">
                    <a href="<?php echo e(route('user.transactionsd')); ?>" class="nav-link"><?php echo e(__('Donation')); ?></a>
                  </li>                  
                  <li class="nav-item <?php if(route('user.invoicelog')==url()->current()): ?> active <?php endif; ?> text-default">
                    <a href="<?php echo e(route('user.invoicelog')); ?>" class="nav-link"><?php echo e(__('Invoice')); ?></a>
                  </li>                   
                  <li class="nav-item <?php if(route('user.depositlog')==url()->current()): ?> active <?php endif; ?> text-default">
                    <a href="<?php echo e(route('user.depositlog')); ?>" class="nav-link"><?php echo e(__('Deposit')); ?></a>
                  </li>                   
                  <li class="nav-item <?php if(route('user.banktransfer')==url()->current()): ?> active <?php endif; ?> text-default">
                    <a href="<?php echo e(route('user.banktransfer')); ?>" class="nav-link"><?php echo e(__('Bank Transfer')); ?></a>
                  </li>  
                  <li class="nav-item <?php if(route('user.senderlog')==url()->current()): ?> active <?php endif; ?> text-default">
                    <a href="<?php echo e(route('user.senderlog')); ?>" class="nav-link"><?php echo e(__('Merchant')); ?></a>
                  </li>                                
                </ul>
              </div>
            </li>          
            <li class="nav-item">
              <a class="nav-link <?php if(route('user.ticket')==url()->current() || route('open.ticket')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('user.ticket')); ?>">
                <i class="fa fa-bullseye"></i>
                <span class="nav-link-text"><?php echo e(__('Disputes')); ?></span>
              </a>
            </li>             
            <li class="nav-item">
              <a class="nav-link <?php if(route('user.profile')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('user.profile')); ?>">
                <i class="fa fa-cogs"></i>
                <span class="nav-link-text"><?php echo e(__('Settings')); ?></span>
              </a>
            </li>             
            <li class="nav-item">
              <a class="nav-link <?php if(route('user.audit')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('user.audit')); ?>">
                <i class="fa fa-refresh"></i>
                <span class="nav-link-text"><?php echo e(__('Audit Logs')); ?></span>
              </a>
            </li> 
          </ul>
        </div>
      </div>
    </div>
  </nav>
   <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Search form -->
            
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center ml-md-auto">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-light" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
          </ul>
          <div class="">
              <h6 class="h2 mb-0 text-future">
                  <?php echo e($currency->symbol.number_format($user->balance)); ?>

              </h6>
            </div>
            <ul class="navbar-nav align-items-center ml-auto ml-md-0">
              <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <div class="media align-items-center">
                    <span class="avatar avatar-sm rounded-circle">
                      <img alt="Image placeholder" src="<?php echo e(url('/')); ?>/asset/profile/<?php echo e($cast); ?>">
                    </span>
                    <div class="media-body ml-2 d-none d-lg-block">
                      <span class="mb-0 text-sm text-default"><?php echo e($user->business_name); ?></span>
                    </div>
                  </div>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo e(route('user.logout')); ?>" class="nav-link pr-0">
                  <i class="ni ni-button-power text-danger"></i>
                </a>
              </li>  
            </ul>
        </div>
      </div>
    </nav>
    <div class="header pb-6">
      <div class="container-fluid">
        <div class="header-body">
        </div>
      </div>
    </div>
<!-- header end -->

<?php echo $__env->yieldContent('content'); ?>


<!-- footer begin -->
      <footer class="footer pt-0">

      </footer>
    </div>
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
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/jquery/dist/jquery.min.js"></script>
  <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/js-cookie/js.cookie.js"></script>
  <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/chart.js/dist/Chart.extension.js"></script>
  <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/jvectormap-next/jquery-jvectormap.min.js"></script>
  <script src="<?php echo e(url('/')); ?>/asset/dashboard/js/vendor/jvectormap/jquery-jvectormap-world-mill.js"></script>
  <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
  <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
  <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/datatables.net-select/js/dataTables.select.min.js"></script>
  <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/clipboard/dist/clipboard.min.js"></script>
  <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/select2/dist/js/select2.min.js"></script>
  <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/nouislider/distribute/nouislider.min.js"></script>
  <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/quill/dist/quill.min.js"></script>
  <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/dropzone/dist/min/dropzone.min.js"></script>
  <script src="<?php echo e(url('/')); ?>/asset/dashboard/vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
  <!-- Argon JS -->
  <script src="<?php echo e(url('/')); ?>/asset/dashboard/js/argon.js?v=1.1.0"></script>
  <!-- Demo JS - remove this in your project -->
  <script src="<?php echo e(url('/')); ?>/asset/dashboard/js/demo.min.js"></script>
  <script src="<?php echo e(url('/')); ?>/asset/js/sweetalert.js"></script>
  <script src="<?php echo e(url('/')); ?>/asset/js/countries.js"></script>
  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  <script src="<?php echo e(url('/')); ?>/asset/tinymce/tinymce.min.js"></script>
  <script src="<?php echo e(url('/')); ?>/asset/tinymce/init-tinymce.js"></script>
</body>

</html>
<?php echo $__env->make('sweetalert::alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('script'); ?>
<?php if(session('success')): ?>
    <script>
      "use strict";
        $(document).ready(function () {
            swal("Success!", "<?php echo e(session('success')); ?>", "success");
        });
    </script>
<?php endif; ?>

<?php if(session('alert')): ?>
    <script>
      "use strict";
        $(document).ready(function () {
            swal("Sorry!", "<?php echo e(session('alert')); ?>", "error");
        });
    </script>
<?php endif; ?>
    <script>
    <?php if(Session::has('message')): ?>
    "use strict";
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
    populateCountries("country", "state");
    </script>
    <script type="text/javascript">
$(function() {
   
    var $form = $(".require-validation");
   
    $('form.require-validation').bind('submit', function(e) {
        var $form         = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid         = true;
        $errorMessage.addClass('hide');
  
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
          }
        });
   
        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
          }, stripeResponseHandler);
        }
  
  });
  
  function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];
               
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
   
});
</script>
<script type="text/javascript">
  "use strict";
  function cardcharge(){
    var amount = $("#cardamount").val();
    var charge = $("#charge").val();
    var survix =  (parseFloat(amount)*parseFloat(charge)/100)+parseFloat(amount);
    var cur = '<?php echo e($currency->name); ?>';
    if(isNaN(survix)){
      survix =0;           
    }
    var ddd = cur+' '+survix;
    $("#cardresult").text(ddd);
  }
</script>
<script type="text/javascript">
  "use strict";
  function cryptocharge(){
    var amount = $("#amountcrypto").val();
    var charge = $("#chargecrypto").val();
    var survix =  (parseFloat(amount)*parseFloat(charge)/100)+parseFloat(amount);
    var cur = '<?php echo e($currency->name); ?>';
    if(isNaN(survix)){
      survix =0;           
    }
    var ddd = cur+' '+survix;
    $("#resultcrypto").text(ddd);
  }
</script> 
<script type="text/javascript">
  "use strict";
  function transfercharge(){
    var amount = $("#amounttransfer").val();
    var charge = $("#chargetransfer").val();
    var survix =  (parseFloat(amount)*parseFloat(charge)/100)+parseFloat(amount);
    var cur = '<?php echo e($currency->name); ?>';
    if(isNaN(survix)){
      survix =0;           
    }
    var ddd = cur+' '+survix;
    $("#resulttransfer").text(ddd);
  }
</script> 
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/boompay/core/resources/views/userlayout.blade.php ENDPATH**/ ?>