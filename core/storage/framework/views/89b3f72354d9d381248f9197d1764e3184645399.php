<!doctype html>
<html class="no-js" lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <base href="<?php echo e(url('/')); ?>"/>
        <title><?php echo e($title); ?> | <?php echo e($set->site_name); ?></title>
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
        <meta name="description" content="<?php echo e($set->site_desc); ?>" />
        <link rel="shortcut icon" href="<?php echo e(url('/')); ?>/asset/<?php echo e($logo->image_link2); ?>" />
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/asset/dashboard/vendor/nucleo/css/nucleo.css" type="text/css">
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/asset/dashboard/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/asset/dashboard/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/asset/dashboard/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/asset/dashboard/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css">
		<link rel="stylesheet" href="<?php echo e(url('/')); ?>/asset/dashboard/vendor/quill/dist/quill.core.css">
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/asset/dashboard/css/argon.css?v=1.1.0" type="text/css">
        <link rel="stylesheet" href="<?php echo e(url('/')); ?>/asset/css/sweetalert.css" type="text/css">
        <link href="<?php echo e(url('/')); ?>/asset/fonts/fontawesome/styles.min.css" rel="stylesheet" type="text/css">
         <?php echo $__env->yieldContent('css'); ?>
        
    </head>
<!-- header begin-->
<body>
    <style>
        .dropdown-toggle::after {
    display:none;
}
    </style>
<div class="preloader"></div>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-dark bg-cyan" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
          <img src="<?php echo e(url('/')); ?>/asset/<?php echo e($logo->dark); ?>" class="navbar-brand-img" alt="...">
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
              <a class="nav-link <?php if(route('admin.dashboard')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('admin.dashboard')); ?>">
                <i class="fa fa-television"></i>
                <span class="nav-link-text"><?php echo e(__('Summary')); ?></span>
              </a>
            </li>                                             
          </ul>
          <hr class="my-3">
          <h6 class="navbar-heading p-0 text-muted"><?php echo e(__('Client')); ?></h6>
          <ul class="navbar-nav mb-md-3"> 
            <?php if($admin->profile==1): ?>
            <li class="nav-item">
              <a class="nav-link <?php if(route('admin.users')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('admin.users')); ?>">
                <i class="fa fa-user"></i>
                <span class="nav-link-text"><?php echo e(__('Customers')); ?></span>
              </a>
            </li> 
            <?php endif; ?>         
            <?php if($admin->id==1): ?>    
            <li class="nav-item">
              <a class="nav-link <?php if(route('admin.staffs')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('admin.staffs')); ?>">
                <i class="fa fa-user"></i>
                <span class="nav-link-text"><?php echo e(__('Staffs')); ?></span>
              </a>
            </li> 
            <?php endif; ?>     
            <?php if($admin->promo==1): ?>                  
            <li class="nav-item">
              <a class="nav-link <?php if(route('admin.promo')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('admin.promo')); ?>">
                <i class="fa fa-envelope"></i>
                <span class="nav-link-text"><?php echo e(__('Promotional Emails')); ?></span>
              </a>
            </li>   
            <?php endif; ?>
            <?php if($admin->support==1): ?>
            <li class="nav-item">
              <a class="nav-link <?php if(route('admin.ticket')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('admin.ticket')); ?>">
                <i class="fa fa-feed"></i>
                <span class="nav-link-text"><?php echo e(__('Support ticket')); ?>

                  <?php if(count($pticket)>0): ?>
                   <span class="badge badge-sm badge-circle badge-floating badge-danger border-white"><?php echo e(count($pticket)); ?></span>
                  <?php endif; ?>
                </span>
              </a>
            </li>  
            <?php endif; ?>
            <?php if($admin->message==1): ?>        
            <li class="nav-item">
              <a class="nav-link <?php if(route('admin.message')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('admin.message')); ?>">
                <i class="fa fa-commenting"></i>
                <?php $enqu=DB::table('contact')->where('seen', 0)->get();?>
                
                <span class="nav-link-text"><?php echo e(__('Enquiry Messages')); ?></span> 
                <?php if(count($enqu)>0): ?>
                   <span class="badge badge-sm badge-circle badge-floating badge-danger border-white"> <?php echo e(count($enqu)); ?></span>
                  <?php endif; ?>
              </a>
            </li>  
            <?php endif; ?>
            <?php if($admin->deposit==1): ?>
            <li class="nav-item">
              <a class="nav-link <?php if(route('admin.deposit.method')==url()->current() || route('admin.banktransfer')==url()->current() || route('admin.deposit.log')==url()->current()): ?> active <?php endif; ?>" href="#card" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                <i class="fa fa-bookmark-o"></i>
                <span class="nav-link-text"><?php echo e(__('Deposit')); ?>

                  <?php if(count($pdeposit)>0 || count($pbank)>0): ?>
                  <span class="badge badge-sm badge-circle badge-floating badge-danger border-white"><?php echo e(count($pdeposit) + count($pbank)); ?></span>
                  <?php endif; ?>
                </span>
              </a>
              <div class="collapse <?php if(route('admin.deposit.method')==url()->current() || route('admin.banktransfer')==url()->current() || route('admin.deposit.log')==url()->current()): ?> show <?php endif; ?>" id="card">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item <?php if(route('admin.deposit.method')==url()->current()): ?> active <?php endif; ?>"><a href="<?php echo e(route('admin.deposit.method')); ?>" class="nav-link"><?php echo e(__('Payment gateways')); ?></a></li>
                  <li class="nav-item <?php if(route('admin.banktransfer')==url()->current()): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('admin.banktransfer')); ?>" class="nav-link"><?php echo e(__('Bank transfer & logs')); ?>

                      <?php if(count($pbank)>0): ?>
                        <span class="badge badge-sm badge-circle badge-floating badge-danger border-white">
                        <?php echo e(count($pbank)); ?>

                        </span>
                      <?php endif; ?>
                    </a>
                  </li>
                  <li class="nav-item <?php if(route('admin.deposit.log')==url()->current()): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('admin.deposit.log')); ?>" class="nav-link"><?php echo e(__('Deposit log')); ?>

                      <?php if(count($pdeposit)>0): ?>
                      <span class="badge badge-sm badge-circle badge-floating badge-danger border-white">
                      <?php echo e(count($pdeposit)); ?>

                      </span>
                      <?php endif; ?>
                      </a>
                  </li>                          
                </ul>
              </div>
            </li> 
            <?php endif; ?>
            <?php if($admin->store==1): ?>
            <li class="nav-item">
              <a class="nav-link <?php if(route('admin.product')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('admin.product')); ?>">
                <i class="fa fa-shopping-bag"></i>
                <span class="nav-link-text"><?php echo e(__('Store')); ?></span>
              </a>
            </li> 
            <?php endif; ?>
            <?php if($admin->single_charge==1 || $admin->donation==1): ?>
            <li class="nav-item">
              <a class="nav-link <?php if(route('admin.sclinks')==url()->current() || route('admin.dplinks')==url()->current()): ?> active <?php endif; ?>" href="#navbar-examples3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples3">
                <!--For modern browsers-->
                <i class="fa fa-tags"></i>
                <span class="nav-link-text"><?php echo e(__('Payment Links')); ?></span>
              </a>
              <div class="collapse <?php if(route('admin.sclinks')==url()->current() || route('admin.dplinks')==url()->current()): ?> show <?php endif; ?>" id="navbar-examples3">
                <ul class="nav nav-sm flex-column">
                  <?php if($admin->single_charge==1): ?>
                  <li class="nav-item <?php if(route('admin.vcardsclinks')==url()->current()): ?> active <?php endif; ?> text-default">
                    <a href="<?php echo e(route('admin.vcardsclinks')); ?>" class="nav-link"><?php echo e(__('Vcard Single Charge')); ?></a>
                  </li> 
                  <li class="nav-item <?php if(route('admin.sclinks')==url()->current()): ?> active <?php endif; ?> text-default">
                    <a href="<?php echo e(route('admin.sclinks')); ?>" class="nav-link"><?php echo e(__('Single Charge')); ?></a>
                  </li>  
                  <?php endif; ?>
                  <?php if($admin->donation==1): ?>                               
                  <li class="nav-item <?php if(route('user.dplinks')==url()->current()): ?> active <?php endif; ?> text-default">
                    <a href="<?php echo e(route('admin.dplinks')); ?>" class="nav-link"><?php echo e(__('Donation')); ?></a>
                  </li>       
                  <?php endif; ?>                        
                </ul>
              </div>
            </li> 
            <?php endif; ?>
            <?php if($admin->transfer==1): ?>
            <li class="nav-item">
              <a class="nav-link <?php if(route('admin.ownbank')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('admin.ownbank')); ?>">
                <i class="fa fa-send-o"></i>
                <span class="nav-link-text"><?php echo e(__('Transfers')); ?></span>
              </a>
            </li>
            <?php endif; ?>
            <?php if($admin->request_money==1): ?>
            <li class="nav-item">
              <a class="nav-link <?php if(route('admin.request')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('admin.request')); ?>">
                <i class="fa fa-hand-peace-o"></i>
                <span class="nav-link-text"><?php echo e(__('Request Money')); ?></span>
              </a>
            </li> 
            <?php endif; ?>
            <?php if($admin->invoice==1): ?>
            <li class="nav-item">
              <a class="nav-link <?php if(route('admin.invoice')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('admin.invoice')); ?>">
                <i class="fas fa-file-invoice"></i>
                <span class="nav-link-text"><?php echo e(__('Invoice')); ?></span>
              </a>
            </li> 
            <?php endif; ?>
            <?php if($admin->merchant==1): ?>
            <li class="nav-item">
              <a class="nav-link <?php if(route('merchant.log')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('merchant.log')); ?>">
                <i class="fa fa-laptop"></i>
                <span class="nav-link-text"><?php echo e(__('Website Integration')); ?></span>
              </a>
            </li>  
            <?php endif; ?>
            <?php if($admin->subscriptiton==1): ?>
            <li class="nav-item">
              <a class="nav-link <?php if(route('admin.plan')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('admin.plan')); ?>">
                <i class="fa fa-sticky-note-o"></i>
                <span class="nav-link-text"><?php echo e(__('Payment Plans')); ?></span>
              </a>
            </li> 
            <?php endif; ?>
            <?php if($admin->settlement==1): ?>
            <li class="nav-item">
              <a href="<?php echo e(route('admin.withdraw.log')); ?>" class="nav-link <?php if(route('admin.withdraw.log')==url()->current()): ?> active <?php endif; ?>">
                <i class="fa fa-calendar-check-o"></i>
                <span class="nav-link-text mr-1"><?php echo e(__('Settlement')); ?></span>
                <?php if(count($pwithdraw)>0): ?>
                  <span class="badge badge-sm badge-circle badge-floating badge-danger border-white">
                    <?php echo e(count($pwithdraw)); ?>

                  </span>
                <?php endif; ?>
              </a>
            </li>
            <?php endif; ?>
            <?php if($admin->charges==1): ?>
            <li class="nav-item">
              <a class="nav-link <?php if(route('admin.charges')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('admin.charges')); ?>">
                <i class="fa fa-pie-chart-o"></i>
                <span class="nav-link-text"><?php echo e(__('Charges')); ?></span>
              </a>
            </li>
            
            <?php endif; ?>
          <li class="nav-item">
              <a class="nav-link <?php if(route('admin.virtual_cards')==url()->current() || route('admin.virtual_cards_transactions')==url()->current() || route('admin.vcard_orders')==url()->current()): ?> active <?php endif; ?>" href="#card7676" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                <i class="fa fa-credit-card"></i>
                <span class="nav-link-text"><?php echo e(__('Virtual Cards')); ?>

                  <?php if(count($pdeposit)>0 || count($pbank)>0): ?>
                  <!--span class="badge badge-sm badge-circle badge-floating badge-danger border-white"><?php echo e(count($pdeposit) + count($pbank)); ?></span-->
                  <?php endif; ?>
                </span>
              </a>
              <div class="collapse <?php if(route('admin.virtual_cards')==url()->current() || route('admin.virtual_cards_transactions')==url()->current() || route('admin.card_design_list')==url()->current() || route('admin.card_type_list')==url()->current() || route('admin.vcard_orders')==url()->current()): ?> show <?php endif; ?>" id="card7676">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item <?php if(route('admin.virtual_cards')==url()->current()): ?> active <?php endif; ?>"><a href="<?php echo e(route('admin.virtual_cards')); ?>" class="nav-link"><?php echo e(__('Virtual Cards List')); ?></a></li>
                  <li class="nav-item <?php if(route('admin.virtual_cards_transactions')==url()->current()): ?> active <?php endif; ?>"><a href="<?php echo e(route('admin.virtual_cards_transactions')); ?>" class="nav-link"><?php echo e(__('Transactions List')); ?></a></li>
                  
                                            
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if(route('admin.subscription_list')==url()->current() || route('admin.subscription_list')==url()->current() || route('admin.deposit.log')==url()->current()): ?> active <?php endif; ?>" href="#card7777" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                <i class="fa fa-inr"></i>
                <span class="nav-link-text"><?php echo e(__('vCard Suscription')); ?>

                  <?php if(count($pdeposit)>0 || count($pbank)>0): ?>
                  <!--span class="badge badge-sm badge-circle badge-floating badge-danger border-white"><?php echo e(count($pdeposit) + count($pbank)); ?></span-->
                  <?php endif; ?>
                </span>
              </a>
              <div class="collapse <?php if(route('admin.subscription_list')==url()->current() || route('admin.subscription_list')==url()->current() || route('admin.deposit.log')==url()->current()): ?> show <?php endif; ?>" id="card7777">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item <?php if(route('admin.subscription_list')==url()->current()): ?> active <?php endif; ?>"><a href="<?php echo e(route('admin.subscription_list')); ?>" class="nav-link"><?php echo e(__('Subscription List')); ?></a></li>
                  <!--li class="nav-item <?php if(route('admin.virtual_cards_transactions')==url()->current()): ?> active <?php endif; ?>"><a href="<?php echo e(route('admin.virtual_cards_transactions')); ?>" class="nav-link"><?php echo e(__('Add New Subscription')); ?></a></li-->
                 <li class="nav-item <?php if(route('admin.vcard_orders')==url()->current()): ?> active <?php endif; ?>"><a href="<?php echo e(route('admin.vcard_orders')); ?>" class="nav-link"><?php echo e(__('vCard Orders List')); ?></a></li>
                  <li class="nav-item <?php if(route('admin.card_type_list')==url()->current()): ?> active <?php endif; ?>"><a href="<?php echo e(route('admin.card_type_list')); ?>" class="nav-link"><?php echo e(__('Card Type')); ?></a></li>
                  <li class="nav-item <?php if(route('admin.card_design_list')==url()->current()): ?> active <?php endif; ?>"><a href="<?php echo e(route('admin.card_design_list')); ?>" class="nav-link"><?php echo e(__('Card Design')); ?></a></li>

                                            
                </ul>
              </div>
            </li>
          </ul>
          <hr class="my-3">
          <h6 class="navbar-heading p-0 text-muted"><?php echo e(__('More')); ?></h6>
          <ul class="navbar-nav mb-md-3"> 
            <?php if($admin->blog==1): ?>
            <li class="nav-item">
              <a class="nav-link <?php if(route('admin.blog')==url()->current() || route('admin.cat')==url()->current()): ?> show <?php endif; ?>" href="#brcard" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                <i class="fa fa-newspaper-o"></i>
                  <span class="nav-link-text"><?php echo e(__('Blog')); ?></span>
              </a>
              <div class="collapse <?php if(route('admin.blog')==url()->current() || route('admin.cat')==url()->current()): ?> show <?php endif; ?>" id="brcard">
                <ul class="nav nav-sm flex-column">
                  <li class="nav-item <?php if(route('admin.blog')==url()->current()): ?> active <?php endif; ?>"><a href="<?php echo e(route('admin.blog')); ?>" class="nav-link"><?php echo e(__('Articles')); ?></a></li>
                  <li class="nav-item <?php if(route('admin.cat')==url()->current()): ?> active <?php endif; ?>"><a href="<?php echo e(route('admin.cat')); ?>" class="nav-link"><?php echo e(__('Category')); ?></a></li>
                </ul>
              </div>
            </li>
            <?php endif; ?> 
            <?php if($admin->id==1): ?>
            <li class="nav-item">
              <a class="nav-link  <?php if(route('homepage')==url()->current() || route('admin.service')==url()->current() || route('admin.brand')==url()->current() || route('admin.logo')==url()->current() || route('admin.review')==url()->current() || route('admin.page')==url()->current() || route('admin.faq')==url()->current() || route('admin.currency')==url()->current() || route('admin.terms')==url()->current() || route('privacy-policy')==url()->current() || route('about-us')==url()->current() || route('social-links')==url()->current()): ?> active <?php endif; ?>" href="#xx" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                <i class="fa fa-desktop"></i>
                <span class="nav-link-text"><?php echo e(__('Website design')); ?></span>
              </a>
              <div class="collapse <?php if(route('homepage')==url()->current() || route('admin.service')==url()->current() || route('admin.brand')==url()->current() || route('admin.logo')==url()->current() || route('admin.review')==url()->current() || route('admin.page')==url()->current() || route('admin.faq')==url()->current() || route('admin.currency')==url()->current() || route('admin.terms')==url()->current() || route('privacy-policy')==url()->current() || route('about-us')==url()->current() || route('social-links')==url()->current()): ?> show <?php endif; ?> " id="xx">
                <ul class="nav nav-sm flex-column">
                    <li class="nav-item <?php if(route('homepage')==url()->current()): ?> active <?php endif; ?>"><a href="<?php echo e(route('homepage')); ?>" class="nav-link"><?php echo e(__('Homepage')); ?></a></li>
                    <li class="nav-item <?php if(route('admin.brand')==url()->current()): ?> active <?php endif; ?>"><a href="<?php echo e(route('admin.brand')); ?>" class="nav-link"><?php echo e(__('Brands')); ?></a></li>	
                    <li class="nav-item <?php if(route('admin.logo')==url()->current()): ?> active <?php endif; ?>"><a href="<?php echo e(route('admin.logo')); ?>" class="nav-link"><?php echo e(__('Logo & Favicon')); ?></a></li>	
                    <li class="nav-item <?php if(route('admin.review')==url()->current()): ?> active <?php endif; ?>"><a href="<?php echo e(route('admin.review')); ?>"class="nav-link"><?php echo e(__('Platform Review')); ?></a></li>
					          <li class="nav-item <?php if(route('admin.service')==url()->current()): ?> active <?php endif; ?>"><a href="<?php echo e(route('admin.service')); ?>"class="nav-link">Services</a></li>
                    <li class="nav-item <?php if(route('admin.page')==url()->current()): ?> active <?php endif; ?>"><a href="<?php echo e(route('admin.page')); ?>" class="nav-link"><?php echo e(__('Webpages')); ?></a></li>
                    <li class="nav-item <?php if(route('admin.faq')==url()->current()): ?> active <?php endif; ?>"><a href="<?php echo e(route('admin.faq')); ?>" class="nav-link"><?php echo e(__('FAQs')); ?></a></li>
                    <li class="nav-item <?php if(route('admin.currency')==url()->current()): ?> active <?php endif; ?>"><a href="<?php echo e(route('admin.currency')); ?>" class="nav-link"><?php echo e(__('Currency')); ?></a></li>
                    <li class="nav-item <?php if(route('admin.terms')==url()->current()): ?> active <?php endif; ?>"><a href="<?php echo e(route('admin.terms')); ?>" class="nav-link"><?php echo e(__('Terms & Condition')); ?></a></li>
                    <li class="nav-item <?php if(route('privacy-policy')==url()->current()): ?> active <?php endif; ?>"><a href="<?php echo e(route('privacy-policy')); ?>" class="nav-link"><?php echo e(__('Privacy policy')); ?></a></li>
                    <li class="nav-item <?php if(route('about-us')==url()->current()): ?> active <?php endif; ?>"><a href="<?php echo e(route('about-us')); ?>" class="nav-link"><?php echo e(__('About us')); ?></a></li>
                    <li class="nav-item <?php if(route('social-links')==url()->current()): ?> active <?php endif; ?>"><a href="<?php echo e(route('social-links')); ?>" class="nav-link"><?php echo e(__('Social Links')); ?></a></li>                           
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if(route('admin.setting')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('admin.setting')); ?>">
                <i class="fa fa-cogs"></i>
                <span class="nav-link-text"><?php echo e(__('Settings')); ?></span>
              </a>
            </li> 
            
            <li class="nav-item">
              <a class="nav-link <?php if(route('admin.carriers')==url()->current()): ?> active <?php endif; ?>" href="<?php echo e(route('admin.carriers')); ?>">
                <i class="fa fa-truck"></i>
                <span class="nav-link-text">Shipment</span>
              </a>
            </li> 
            <?php endif; ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo e(route('admin.logout')); ?>">
                <i class="fa fa-power-off"></i>
                <span class="nav-link-text"><?php echo e(__('Log out')); ?></span>
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
          <ul class="navbar-nav align-items-center ml-auto ml-md-0">
              <?php $countkyc = DB::table('users')->where('kyc_link','!=','')->where('seen',0)->orderby('updated_at','DESC')->get(); ?>
            <li class="nav-item dropdown">
                
                
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-bell" style="color:#256377"></i> <span class="badge badge-sm badge-circle badge-floating badge-danger border-white"> <?php echo e(count($countkyc)); ?></span></a>
                <?php if(count($countkyc)>0): ?>
                <div class="dropdown-menu" style="height: 200px;    overflow-y: scroll;">
                    <?php $__currentLoopData = $countkyc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kyc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a class="dropdown-item" href="<?php echo e(route('user.manage', ['id' => $kyc->id])); ?>" target="_blank"><b><?php echo e($kyc->first_name); ?> <?php echo e($kyc->last_name); ?></b> Uploaded KYC Document </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div> 
                <?php endif; ?>
            </li>
            <li class="nav-item">
              <a class="nav-link pr-0" href="javascript:void" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="<?php echo e(url('/')); ?>/asset/profile/person.jpg">
                  </span>
                  <div class="media-body ml-2 d-none d-lg-block">
                      <span class="mb-0 text-sm text-default"><?php echo e(Auth::guard('admin')->user()->username); ?></span>
                    </div>
                </div>
              </a>
            </li> 
            <li class="nav-item">
              <a href="<?php echo e(route('admin.logout')); ?>" class="nav-link pr-0">
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
          <div class="row align-items-center">
            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">

              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php echo $__env->yieldContent('content'); ?>
  </div>
</div>
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
  <script src="<?php echo e(url('/')); ?>/asset/tinymce/tinymce.min.js"></script>
	<script src="<?php echo e(url('/')); ?>/asset/tinymce/init-tinymce.js"></script>
</body>

</html>
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
<script type="text/javascript">
"use strict";
function exchange(){
	var percent = $("#percent").val();
	var duration = $("#duration").val();
	var period = $("#period").find(":selected").text();
	var myarr1 = period.split("-");
  	var dar1 = myarr1[1].split("<");	
	var compound = parseFloat(percent)*parseFloat(duration)*parseInt(dar1);
	var interest = compound-100;
  $("#compound").val(compound);
  $("#interest").val(interest);
}
  $("#percent").change(exchange);
  exchange();
  $("#duration").change(exchange);
  exchange();
  $("#period").change(exchange);
  exchange();
  
</script> 

<?php /**PATH C:\xampp1\htdocs\neelu_wallet\core\resources\views/master.blade.php ENDPATH**/ ?>