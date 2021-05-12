<!doctype html>
<html class="no-js" lang="en">
    <head>
        <base href="{{url('/')}}"/>
        <title>{{ $title }} - {{$set->site_name}}</title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="robots" content="index, follow">
        <meta name="apple-mobile-web-app-title" content="{{$set->site_name}}"/>
        <meta name="application-name" content="{{$set->site_name}}"/>
        <meta name="msapplication-TileColor" content="#ffffff"/>
        <meta name="description" content="{{$set->site_desc}}" />
        <link rel="shortcut icon" href="{{url('/')}}/asset/{{$logo->image_link2}}" />
        <link rel="apple-touch-icon" href="{{url('/')}}/asset/{{$logo->image_link2}}" />
        <link rel="apple-touch-icon" sizes="72x72" href="{{url('/')}}/asset/{{$logo->image_link2}}" />
        <link rel="apple-touch-icon" sizes="114x114" href="{{url('/')}}/asset/{{$logo->image_link2}}" />
        <link href="{{url('/')}}/asset/static/plugin/bootstrap/css/bootstrap.min.css" rel="stylesheet" media >
        <link href="{{url('/')}}/asset/static/plugin/font-awesome/css/all.min.css" rel="stylesheet" media >
        <link href="{{url('/')}}/asset/static/plugin/et-line/style.css" rel="stylesheet" media >
        <link href="{{url('/')}}/asset/static/plugin/themify-icons/themify-icons.css" rel="stylesheet" media >
        <link href="{{url('/')}}/asset/static/plugin/ionicons/css/ionicons.min.css" rel="stylesheet" media>
        <link href="{{url('/')}}/asset/static/plugin/owl-carousel/css/owl.carousel.min.css" rel="stylesheet" media >
        <link href="{{url('/')}}/asset/static/plugin/magnific/magnific-popup.css" rel="stylesheet" media >
        <link href="{{url('/')}}/asset/static/style/master.css" rel="stylesheet" media >
        <link href="{{url('/')}}/asset/css/sweetalert.css" rel="stylesheet" media >
        
         @yield('css')
         <!--Start of Tawk.to Script-->
<!--<script type="text/javascript">-->
<!--var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();-->
<!--(function(){-->
<!--var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];-->
<!--s1.async=true;-->
<!--s1.src='https://embed.tawk.to/5fb3411a1535bf152a56a2e1/default';-->
<!--s1.charset='UTF-8';-->
<!--s1.setAttribute('crossorigin','*');-->
<!--s0.parentNode.insertBefore(s1,s0);-->
<!--})();-->
<!--</script>-->
<!--End of Tawk.to Script-->

                    
<!--<script type='text/javascript'>-->
<!--		(function(I, L, T, i, c, k, s) {if(I.iticks) return;I.iticks = {host:c, settings:s, clientId:k, cdn:L, queue:[]};var h = T.head || T.documentElement;var e = T.createElement(i);var l = I.location;e.async = true;e.src = (L||c)+'/client/inject-v2.min.js';h.insertBefore(e, h.firstChild);I.iticks.call = function(a, b) {I.iticks.queue.push([a, b]);};})(window, 'https://cdn.intelliticks.com/prod/common', document, 'script', 'https://app.intelliticks.com', 'FzuDcEHSpXHnW66mx_c', {});-->
<!--</script>-->
          <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-V84NG0YGQV"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-V84NG0YGQV');
</script>      

    </head>

    <body data-spy="scroll" data-target="#navbar-collapse-toggle" data-offset="98">
    <!-- Preload -->
    <!--<div id="loading">-->
    <!--    <div class="load-circle"><span class="one"></span></div>-->
    <!--</div>-->
    <!-- End Preload -->
    <!-- Header -->
    <header class="header-nav header-dark">
        <div class="fixed-header-bar">
            <!-- Header Nav -->
            <div class="navbar navbar-main navbar-expand-lg">
                <div class="container">
                    <a class="navbar-brand" href="{{url('/')}}">
                        <img alt="" title="" src="{{url('/')}}/asset/{{$logo->image_link}}">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-main-collapse" aria-controls="navbar-main-collapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse navbar-collapse-overlay" id="navbar-main-collapse">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('about')}}">Why CuminUp</a>
                            </li>
                            <li class="nav-item mm-in px-dropdown">
                                <a class="nav-link" href="#">Features</a>
                                <i class="fa fa-angle-down px-nav-toggle"></i>
                                <ul class="px-dropdown-menu mm-dorp-in">
                                    <!--@foreach($pages as $vpages)-->
                                    <!--    @if(!empty($vpages))-->
                                    <!--    <li><a href="{{url('/')}}/page/{{$vpages->id}}">{{$vpages->title}}</a></li>-->
                                    <!--    @endif-->
                                    <!--@endforeach-->
                                    <li><a href="{{url('/facebook')}}">Facebook</a></li>
                                    <li><a href="{{url('/productpaymentform')}}">Product payment Form</a></li>
                                    <li><a href="{{url('/chatapps')}}">Chat / Messenger Apps</a></li>
                                    <li><a href="{{url('/instagram')}}">Instagram</a></li>
                                    <li><a href="{{url('/webplugin')}}">Shopping Cart Web Plugin</a></li>
                                    <li><a href="{{url('/paymenturl')}}">Payment URL</a></li>
                                    <li><a href="{{url('/ecomsolution')}}">Custom eCommerce Website Solution</a></li>
                                    
                                    
                                    
                                </ul>
                            </li>
                            <!--<li class="nav-item mm-in px-dropdown">-->
                            <!--    <a class="nav-link" href="#">{{__('Business')}}</a>-->
                            <!--    <i class="fa fa-angle-down px-nav-toggle"></i>-->
                            <!--    <ul class="px-dropdown-menu mm-dorp-in">-->
                            <!--        @foreach($cat as $vcat)-->
                            <!--        <li><a href="{{url('/')}}/cat/{{$vcat->id}}/1">{{$vcat->categories}}</a></li>-->
                            <!--        @endforeach-->
                            <!--    </ul>-->
                            <!--</li>                          -->
                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('/costing')}}">Fees & Costing</a>
                            </li>
                             <li class="nav-item">
                                <a class="nav-link" href="{{url('/')}}#contact">Get in touch</a>
                            </li>
                            <!--<li class="nav-item mm-in px-dropdown">-->
                            <!--    <a class="nav-link" href="#">{{__('Help')}}</a>-->
                            <!--    <i class="fa fa-angle-down px-nav-toggle"></i>-->
                            <!--    <ul class="px-dropdown-menu mm-dorp-in">-->
                            <!--        <li><a href="{{url('/')}}#faq">{{__('FAQs')}}</a></li>-->
                            <!--        <li><a href="{{route('terms')}}">{{__('Terms & Conditions')}}</a></li>-->
                            <!--        <li><a href="{{route('privacy')}}">{{__('Privacy policy')}}</a></li>-->
                            <!--        <li><a href="{{url('/')}}#contact">{{__('Contact us')}}</a></li>-->
                            <!--    </ul>-->
                            <!--</li>                            -->
                            
                            @if (Auth::guard('user')->check())
                            <li class="nav-item d-md-none">
                                <a class="nav-link" href="{{route('user.dashboard')}}">{{__('Dashboard')}}</a>
                            </li>
                            @else
                            <li class="nav-item d-md-none">
                                <a class="nav-link" href="{{route('login')}}">{{__('Login')}}</a>
                            </li>
                            @endif
                        </ul>
                        @if (Auth::guard('user')->check())
                        <a href="{{route('user.dashboard')}}" class="d-none d-lg-inline-block m-btn m-btn-radius m-btn-theme2nd m-btn-sm m-20px-l">{{__('Dashboard')}}</a>
                        @else
                        <a href="{{route('login')}}" class="d-none d-lg-inline-block m-btn m-btn-radius m-btn-theme2nd m-btn-sm m-20px-l">{{__('Login')}}</a>
                         <a href="{{route('register')}}" class="d-none d-lg-inline-block m-btn m-btn-radius m-btn-theme2nd1 m-btn-sm m-20px-l">Free Signup</a>
                         <a href="https://ach.cuminup.com" target="_blank" class="d-none d-lg-inline-block m-btn m-btn-radius m-btn-theme2nd1 m-btn-sm m-20px-l" style="    background: #00c685;
    border: 2px solid #00c685;">Open ACH Account</a>
                        @endif
                    </div>
                </div>
            </div>
            <!-- End Header Nav -->
        </div>
    </header>
    <!-- Header End -->
    <!-- Main -->
    <main>
@yield('content')
<footer class="dark-bg footer">
        <div class="footer-top border-style top light">
            <div class="container">
                <div class="row">
                
                    
                    <div class="col-lg-4 m-15px-tb">
                        <div class="p-25px-b">
                            <img src="{{url('/')}}/asset/{{$logo->dark}}" title="" alt="" style="    background: white;
    border-radius: 5px;
    padding: 5px;">
                        </div>
                        <p class="white-color-light">
                        {{$set->title}}
                        </p>
                        <div class="social-icon si-30 white round nav">
                            @foreach($social as $socials)
                                @if(!empty($socials->value))
                                <a href="{{$socials->value}}"><i class="fab fa-{{$socials->type}}"></i></a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-3 col-6 col-sm-4 ml-lg-auto m-15px-tb">
                        <h5 class="white-color footer-title">
                            {{__('Quick links')}}
                        </h5>
                        <ul class="list-unstyled links-white footer-link-1">
                            <li> <a href="{{route('about')}}">Why CuminUp</a></li>
                            <li><a href="{{url('/costing')}}">Fees & Costing</a></li>
                            
                            <li><a href="{{url('/')}}#contact">{{__('Contact')}}</a></li>
                             <li>
                                <a href="{{route('login')}}">{{__('Login')}}</a>
                            </li>
                            <!--<li><a href="{{route('user.merchant')}}">{{__('Merchant Services')}}</a></li>-->
                            <!--<li><a href="{{route('user.invoice')}}">{{__('Send Invoices')}}</a></li>-->
                            <!--<li><a href="{{route('user.product')}}">{{__('Sell Products')}}</a></li>-->
                        </ul>
                    </div>
                    <div class="col-lg-2 col-6 col-sm-4 m-15px-tb">
                        <h5 class="white-color footer-title">
                        {{__('Company')}}
                        </h5>
                        <ul class="list-unstyled links-white footer-link-1">
                            <!--<li><a href="{{route('about')}}">{{__('About us')}}</a></li>-->
                            <li><a href="{{route('terms')}}">{{__('Terms of Use')}}</a></li>
                            <li><a href="{{route('privacy')}}">{{__('Privacy Policy')}}</a></li>
                            <li><a href="https://www.cuminpay.com/demo/page/8">BSA and AML Policy</a></li>
                           
                             <li><a href="{{url('/security')}}">Security</a></li>
                            @if(count($faq)>0)
                            <li><a href="{{url('/')}}#faq">{{__('FAQs')}}</a></li>
                            @endif
                        </ul>
                    </div>
                    <div class="col-lg-3 feature-ft" style="padding-left:70px">
                        <h5 class="white-color footer-title">
                           Features
                        </h5>
                        <ul class="list-unstyled links-white footer-link-1">
                            <!--@foreach($pages as $vpages)-->
                            <!--    @if(!empty($vpages))-->
                            <!--<li><a href="{{url('/')}}/page/{{$vpages->id}}">{{$vpages->title}}</a></li>-->
                            <!--    @endif-->
                            <!--@endforeach-->
                            
                                    <li><a href="{{url('/facebook')}}">Facebook</a></li>
                                    <li><a href="{{url('/productpaymentform')}}">Product payment Form</a></li>
                                    <li><a href="{{url('/chatapps')}}">Chat / Messenger Apps</a></li>
                                    <li><a href="{{url('/instagram')}}">Instagram</a></li>
                                    <li><a href="{{url('/webplugin')}}">Shopping Cart Web Plugin</a></li>
                                    <li><a href="{{url('/paymenturl')}}">Payment URL</a></li>
                                    <li><a href="{{url('/ecomsolution')}}">Custom eCommerce Solution</a></li>
                                    <!--<li><a href="{{url('/costing')}}">Fees & Costing</a></li>-->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom border-style top light">
            <div class="container">
                <div class="row">
                        
                    <p style="
    color: white;
    font-size: 12px;
"><strong>Disclaimers</strong>- “CuminUp” is a brand that is managed by Linsyxtech Technologies Inc. and Greentech Fin Inc. According to the United States protocol and have respective licenses and permissions for provided services. Cuminup ACH is Supported by Sila Inc. for SDK and Financial Institution intermediary bank- Evolve Bank &amp; Trust.
Banking services are fully managed by Mercury Bank.
 By continuing using the website, you confirm your agreement with the above-mentioned statements and documents. If you are interested in particular services, please contact the sales team for more information about the servicing company; 

</p>
                    <div class="col-md-6 text-center text-md-left m-5px-tb">
                        <p class="m-0px font-small white-color-light" style="margin-left:-15px!important">{{$set->site_name}}  &copy; {{date('Y')}}. {{__('All Rights Reserved.')}}</p>
                    </div>
                    <div class="col-md-6 m-5px-tb">
                    </div>
                </div>
                  <script type="text/javascript"> //<![CDATA[
  var tlJsHost = ((window.location.protocol == "https:") ? "https://secure.trust-provider.com/" : "http://www.trustlogo.com/");
  document.write(unescape("%3Cscript src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E"));
//]]></script>
<script language="JavaScript" type="text/javascript">
  TrustLogo("https://www.positivessl.com/images/seals/positivessl_trust_seal_md_167x42.png", "POSDV", "none");
</script>
        
            </div>
             
        </div>
  
              
        
     
    </footer>
</div>
        <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/{{$set->livechat}}/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script>
        <script>
            var urx = "{{url('/')}}";
        </script>
        <script defer src="{{url('/')}}/asset/js/sweetalert.js"></script>  
        <script src="{{url('/')}}/asset/static/js/jquery-3.2.1.min.js"></script>
        <script defer src="{{url('/')}}/asset/static/js/jquery-migrate-3.0.0.min.js"></script>
        <script defer src="{{url('/')}}/asset/static/plugin/appear/jquery.appear.js"></script>
        <script defer src="{{url('/')}}/asset/static/plugin/bootstrap/js/popper.min.js"></script>
        <script defer src="{{url('/')}}/asset/static/plugin/bootstrap/js/bootstrap.js"></script>
        <script defer src="{{url('/')}}/asset/static/js/custom.js"></script>
@include('sweetalert::alert')
@yield('script')
@if (session('success'))
    <script>
        $(document).ready(function () {
            swal("Success!", "{{ session('success') }}", "success");
        });
    </script>
@endif
@if(session('alert'))
    <script>
        $(document).ready(function () {
            swal("Sorry!", "{{ session('alert') }}", "error");
        });
    </script>
@endif
<script>
    @if(Session::has('message'))
    var type = "{{Session::get('alert-type','info')}}";
    switch (type) {
        case 'info':
            toastr.info("{{Session::get('message')}}");
            break;
        case 'warning':
            toastr.warning("{{Session::get('message')}}");
            break;
        case 'success':
            toastr.success("{{Session::get('message')}}");
            break;
        case 'error':
            toastr.error("{{Session::get('message')}}");
            break;
    }
    @endif
</script>
@if($set->recaptcha==1)
  {!! NoCaptcha::renderJs() !!}
@endif
</body>
</html>