@php
    use Carbon\Carbon;
    date_default_timezone_set('Asia/Jakarta');
@endphp
<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ env('APP_URL') }}/wp-content/uploads/2020/10/cropped-DSW-logo-black-2-32x32.png" sizes="32x32" />
    <link rel="icon" href="{{ env('APP_URL') }}/wp-content/uploads/2020/10/cropped-DSW-logo-black-2-192x192.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="{{ env('APP_URL') }}/wp-content/uploads/2020/10/cropped-DSW-logo-black-2-180x180.png" />
    <meta name="msapplication-TileImage" content="{{ env('APP_URL') }}/wp-content/uploads/2020/10/cropped-DSW-logo-black-2-270x270.png" />
    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>My Tickets &#8211; Data Science Weekend</title>
    <link rel='dns-prefetch' href='//maps.googleapis.com' />
    <link rel='dns-prefetch' href='//cdnjs.cloudflare.com' />
    <link rel='dns-prefetch' href='//fonts.googleapis.com' />
    <link rel='dns-prefetch' href='//s.w.org' />
    <link rel='preconnect' href='https://fonts.gstatic.com/' crossorigin />
    <link rel="alternate" type="application/rss+xml" title="Data Science Weekend &raquo; Feed" href="./feed/index.html" />
    <link rel="alternate" type="application/rss+xml" title="Data Science Weekend &raquo; Comments Feed" href="./comments/feed/index.html" />
    <script type="text/javascript">
    // WooCommerce Event Manager Ajax URL
        var ajaxurl = "./wp-admin/admin-ajax.php";
    </script>
            <script type="text/javascript">
                window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/13.0.0\/72x72\/","ext":".png","svgUrl":"https:\/\/s.w.org\/images\/core\/emoji\/13.0.0\/svg\/","svgExt":".svg","source":{"concatemoji":".\/wp-includes\/js\/wp-emoji-release.min.js?ver=5.5.3"}};
                !function(e,a,t){var r,n,o,i,p=a.createElement("canvas"),s=p.getContext&&p.getContext("2d");function c(e,t){var a=String.fromCharCode;s.clearRect(0,0,p.width,p.height),s.fillText(a.apply(this,e),0,0);var r=p.toDataURL();return s.clearRect(0,0,p.width,p.height),s.fillText(a.apply(this,t),0,0),r===p.toDataURL()}function l(e){if(!s||!s.fillText)return!1;switch(s.textBaseline="top",s.font="600 32px Arial",e){case"flag":return!c([127987,65039,8205,9895,65039],[127987,65039,8203,9895,65039])&&(!c([55356,56826,55356,56819],[55356,56826,8203,55356,56819])&&!c([55356,57332,56128,56423,56128,56418,56128,56421,56128,56430,56128,56423,56128,56447],[55356,57332,8203,56128,56423,8203,56128,56418,8203,56128,56421,8203,56128,56430,8203,56128,56423,8203,56128,56447]));case"emoji":return!c([55357,56424,8205,55356,57212],[55357,56424,8203,55356,57212])}return!1}function d(e){var t=a.createElement("script");t.src=e,t.defer=t.type="text/javascript",a.getElementsByTagName("head")[0].appendChild(t)}for(i=Array("flag","emoji"),t.supports={everything:!0,everythingExceptFlag:!0},o=0;o<i.length;o++)t.supports[i[o]]=l(i[o]),t.supports.everything=t.supports.everything&&t.supports[i[o]],"flag"!==i[o]&&(t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&t.supports[i[o]]);t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&!t.supports.flag,t.DOMReady=!1,t.readyCallback=function(){t.DOMReady=!0},t.supports.everything||(n=function(){t.readyCallback()},a.addEventListener?(a.addEventListener("DOMContentLoaded",n,!1),e.addEventListener("load",n,!1)):(e.attachEvent("onload",n),a.attachEvent("onreadystatechange",function(){"complete"===a.readyState&&t.readyCallback()})),(r=t.source||{}).concatemoji?d(r.concatemoji):r.wpemoji&&r.twemoji&&(d(r.twemoji),d(r.wpemoji)))}(window,document,window._wpemojiSettings);
            </script>
            <style type="text/css">
    img.wp-smiley,
    img.emoji {
        display: inline !important;
        border: none !important;
        box-shadow: none !important;
        height: 1em !important;
        width: 1em !important;
        margin: 0 .07em !important;
        vertical-align: -0.1em !important;
        background: none !important;
        padding: 0 !important;
    }
    pre {
        background: none !important;
        border: none !important;
        font-family: Arial;
        text-align: left;
    }
    </style>
        <link rel='stylesheet' id='wp-block-library-css'  href='./wp-includes/css/dist/block-library/style.min.css?ver=5.5.3' type='text/css' media='all' />
    <link rel='stylesheet' id='wc-block-vendors-style-css'  href='{{ env('APP_URL') }}/wp-content/plugins/woocommerce/packages/woocommerce-blocks/build/vendors-style.css?ver=3.1.0' type='text/css' media='all' />
    <link rel='stylesheet' id='wc-block-style-css'  href='{{ env('APP_URL') }}/wp-content/plugins/woocommerce/packages/woocommerce-blocks/build/style.css?ver=3.1.0' type='text/css' media='all' />
    <link rel='stylesheet' id='export-wp-page-to-static-html-css'  href='{{ env('APP_URL') }}/wp-content/plugins/export-wp-page-to-static-html/public/css/export-wp-page-to-static-html-public.css?ver=1.0.0' type='text/css' media='all' />
    <link rel='stylesheet' id='woocommerce-layout-css'  href='{{ env('APP_URL') }}/wp-content/plugins/woocommerce/assets/css/woocommerce-layout.css?ver=4.5.2' type='text/css' media='all' />
    <link rel='stylesheet' id='woocommerce-smallscreen-css'  href='{{ env('APP_URL') }}/wp-content/plugins/woocommerce/assets/css/woocommerce-smallscreen.css?ver=4.5.2' type='text/css' media='only screen and (max-width: 768px)' />
    <link rel='stylesheet' id='woocommerce-general-css'  href='{{ env('APP_URL') }}/wp-content/plugins/woocommerce/assets/css/woocommerce.css?ver=4.5.2' type='text/css' media='all' />
    <style id='woocommerce-inline-inline-css' type='text/css'>
    .woocommerce form .form-row .required { visibility: visible; }
    </style>
    <link rel='stylesheet' id='bootstrap-css'  href='{{ env('APP_URL') }}/wp-content/themes/miexpo/assets/css/bootstrap.css' type='text/css' media='all' />
    <link rel='stylesheet' id='font-awesome-css'  href='{{ env('APP_URL') }}/wp-content/themes/miexpo/assets/css/font-awesome.css' type='text/css' media='all' />
    <link rel='stylesheet' id='flaticon-css'  href='{{ env('APP_URL') }}/wp-content/themes/miexpo/assets/css/flaticon.css' type='text/css' media='all' />
    <link rel='stylesheet' id='elementor-animations-css'  href='{{ env('APP_URL') }}/wp-content/plugins/elementor/assets/lib/animations/animations.min.css?ver=3.0.9' type='text/css' media='all' />
    <link rel='stylesheet' id='animate-css'  href='{{ env('APP_URL') }}/wp-content/themes/miexpo/assets/css/animate.css' type='text/css' media='all' />
    <link rel='stylesheet' id='owl-css'  href='{{ env('APP_URL') }}/wp-content/themes/miexpo/assets/css/owl.css' type='text/css' media='all' />
    <link rel='stylesheet' id='miexpo-jquery-ui-css'  href='{{ env('APP_URL') }}/wp-content/themes/miexpo/assets/css/jquery-ui.css' type='text/css' media='all' />
    <link rel='stylesheet' id='custom-animate-css'  href='{{ env('APP_URL') }}/wp-content/themes/miexpo/assets/css/custom-animate.css' type='text/css' media='all' />
    <link rel='stylesheet' id='magnific-popup-css'  href='{{ env('APP_URL') }}/wp-content/themes/miexpo/assets/css/magnific-popup.css' type='text/css' media='all' />
    <link rel='stylesheet' id='jquery-fancybox-css'  href='{{ env('APP_URL') }}/wp-content/themes/miexpo/assets/css/jquery.fancybox.min.css' type='text/css' media='all' />
    <link rel='stylesheet' id='jquery-mCustomScrollbar-css'  href='{{ env('APP_URL') }}/wp-content/themes/miexpo/assets/css/jquery.mCustomScrollbar.min.css' type='text/css' media='all' />
    <link rel='stylesheet' id='miexpo-style-css'  href='{{ env('APP_URL') }}/wp-content/themes/miexpo/style.css?ver=5.5.3' type='text/css' media='all' />
    <style id='miexpo-style-inline-css' type='text/css'>

                    .page-title{
                            background-image:url();
                    }
                

                    .page-title.blog-title{
                            background-image:url({{ env('APP_URL') }}/wp-content/uploads/2020/07/Wedding-virtual-expo.jpg);
                    }
                    .blog-newsletter {
                        background-image:url();
                    }
                
    </style>
    <link rel='stylesheet' id='responsive-css'  href='{{ env('APP_URL') }}/wp-content/themes/miexpo/assets/css/responsive.css' type='text/css' media='all' />
    <link rel='stylesheet' id='miexpo-theme-css'  href='{{ env('APP_URL') }}/wp-content/themes/miexpo/assets/css/theme.css' type='text/css' media='all' />
    <link rel='stylesheet' id='miexpo-update-css'  href='{{ env('APP_URL') }}/wp-content/themes/miexpo/assets/css/theme-update.css' type='text/css' media='all' />
    <link rel='stylesheet' id='select2-css'  href='{{ env('APP_URL') }}/wp-content/plugins/woocommerce/assets/css/select2.css?ver=4.5.2' type='text/css' media='all' />
    <link rel='stylesheet' id='qlwapp-css'  href='{{ env('APP_URL') }}/wp-content/plugins/wp-whatsapp-chat/assets/frontend/css/qlwapp.min.css?ver=4.7.0' type='text/css' media='all' />
    <link rel='stylesheet' id='elementor-icons-css'  href='{{ env('APP_URL') }}/wp-content/plugins/elementor/assets/lib/eicons/css/elementor-icons.min.css?ver=5.9.1' type='text/css' media='all' />
    <link rel='stylesheet' id='elementor-frontend-legacy-css'  href='{{ env('APP_URL') }}/wp-content/plugins/elementor/assets/css/frontend-legacy.min.css?ver=3.0.9' type='text/css' media='all' />
    <link rel='stylesheet' id='elementor-frontend-css'  href='{{ env('APP_URL') }}/wp-content/plugins/elementor/assets/css/frontend.min.css?ver=3.0.9' type='text/css' media='all' />
    <link rel='stylesheet' id='elementor-post-2523-css'  href='{{ env('APP_URL') }}/wp-content/uploads/elementor/css/post-2523.css?ver=1602463056' type='text/css' media='all' />
    <link rel='stylesheet' id='elementor-global-css'  href='{{ env('APP_URL') }}/wp-content/uploads/elementor/css/global.css?ver=1602463056' type='text/css' media='all' />
    <link rel='stylesheet' id='elementor-post-2085-css'  href='{{ env('APP_URL') }}/wp-content/uploads/elementor/css/post-2085.css?ver=1602736086' type='text/css' media='all' />
    <link rel='stylesheet' id='mep-jquery-ui-style-css'  href='{{ env('APP_URL') }}/wp-content/plugins/mage-eventpress/css/jquery-ui.css?ver=5.5.3' type='text/css' media='all' />
    <link rel='stylesheet' id='font-awesome-css-cdn-5.2.0-css'  href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.2.0/css/all.min.css?ver=1' type='text/css' media='all' />
    <link rel='stylesheet' id='font-awesome-css-cdn-css'  href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css?ver=1' type='text/css' media='all' />
    <link rel='stylesheet' id='mep-calendar-min-style-css'  href='{{ env('APP_URL') }}/wp-content/plugins/mage-eventpress/css/calendar.min.css?ver=5.5.3' type='text/css' media='all' />
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css?family=Karla:400&#038;display=swap&#038;ver=1602406384" /><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karla:400&#038;display=swap&#038;ver=1602406384" media="print" onload="this.media='all'"><noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karla:400&#038;display=swap&#038;ver=1602406384" /></noscript><link rel='stylesheet' id='google-fonts-1-css'  href='https://fonts.googleapis.com/css?family=Roboto%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7CRoboto+Slab%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic&#038;ver=5.5.3' type='text/css' media='all' />
            <script>
                /* <![CDATA[ */
                var rcewpp = {
                    "ajax_url":"./wp-admin/admin-ajax.php",
                    "nonce": "83e6e0741b",
                    "home_url": "."
                };
                /* ]]\> */
            </script>
            <script type='text/javascript' id='jquery-core-js-extra'>
    /* <![CDATA[ */
    var mep_ajax = {"mep_ajaxurl":".\/wp-admin\/admin-ajax.php"};
    /* ]]> */
    </script>
    <script type='text/javascript' src='./wp-includes/js/jquery/jquery.js?ver=1.12.4-wp' id='jquery-core-js'></script>
    <script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/plugins/export-wp-page-to-static-html/public/js/export-wp-page-to-static-html-public.js?ver=1.0.0' id='export-wp-page-to-static-html-js'></script>
    <script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/plugins/mage-eventpress/js/moment.js?ver=1' id='mep-moment-js-js'></script>
    <script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/plugins/mage-eventpress/js/calendar.min.js?ver=1' id='mep-calendar-scripts-js'></script>
    <link rel="https://api.w.org/" href="./wp-json/index.html" /><link rel="alternate" type="application/json" href="./wp-json/wp/v2/pages/2085/index.html" /><link rel="EditURI" type="application/rsd+xml" title="RSD" href="./xmlrpc.php?rsd" />
    <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="./wp-includes/wlwmanifest.xml" /> 
    <meta name="generator" content="WordPress 5.5.3" />
    <meta name="generator" content="WooCommerce 4.5.2" />
    <link rel="canonical" href="./index.html" />
    <link rel='shortlink' href='./index.html' />
    <link rel="alternate" type="application/json+oembed" href="./wp-json/oembed/1.0/embed/index.html?url=https%3A%2F%2F%2F" />
    <link rel="alternate" type="text/xml+oembed" href="./wp-json/oembed/1.0/embed/index.html?url=https%3A%2F%2F%2F&#038;format=xml" />
    <meta name="framework" content="Redux 4.1.20" />    <style>
        .mep-default-sidrbar-events-schedule ul li i, .mep-ev-start-date, h3.mep_list_date i, .mep-list-footer ul li i, .df-ico i, .mep-default-sidrbar-meta i, .mep-default-sidrbar-address ul li i, .mep-default-sidrbar-social ul li a, .mep-tem3-title-sec, button.mep-cat-control, .pagination-sec a {
            background: #8b516f;
        }
        .mep-default-sidrbar-events-schedule h3 i, .mep_event_list .mep_list_date, .mep-event-theme-1 .mep-social-share li a, .mep-template-2-hamza .mep-social-share li a {
            color: #8b516f;
        }
        .mep_event_list_item:hover { border-color: #8b516f; }
        .mep_event_list_item .mep-list-header:before, .mep_event_grid_item .mep-list-header:before {
            border-color: #8b516f;
        }
        /*Cart sec Label Style*/
        .mep-default-feature-cart-sec h3, .mep-event-theme-1 h3.ex-sec-title, .mep-tem3-mid-sec h3.ex-sec-title {
            background: #8b516f;
            color: #ffffff;
        }

        /*FAQ Sec Style*/
        .mep-default-feature-faq-sec h4, .tmep-emplate-3-faq-sec .mep-event-faq-part h4 {
            background: #ffffff;
            color: ;
        }

        h3.ex-sec-title {
            background: #8b516f;
        }

        /*Cart Button Style*/
        .mep-default-feature-cart-sec button.single_add_to_cart_button.button.alt.btn-mep-event-cart, .mep-event-theme-1 .btn-mep-event-cart, .mep-template-2-hamza .btn-mep-event-cart, .mep-tem3-mid-sec .btn-mep-event-cart {
            background: #8b516f;
            color: #ffffff !important;
            border-color: #8b516f;
        }

        /*Calender Button Style*/
        .mep-default-sidrbar-calender-btn a, .mep-event-theme-1 .mep-add-calender, .mep-template-2-hamza .mep-add-calender, .mep-tem3-mid-sec .mep-add-calender, #mep_add_calender_button {
            background: #ffffff;
            color: #ffffff !important;
            border-color: #ffffff;
        }
        #mep_add_calender_button,
        ul#mep_add_calender_links li a{
            background: #8b516f;
        }
        /**/
        .mep_list_event_details p.read-more a{
            color: #8b516f;
        }
            </style>
    <style type="text/css" id="tve_global_variables">:root{}</style>	<noscript><style>.woocommerce-product-gallery{ opacity: 1 !important; }</style></noscript>
	<style>
  /*  Custom CSS Code From WooCommerce Event Manager Plugin */
</style>
<style type="text/css" id="thrive-default-styles"></style><link rel="icon" href="{{ env('APP_URL') }}/wp-content/uploads/2020/10/cropped-DSW-logo-black-2-32x32.png" sizes="32x32" />
<link rel="icon" href="{{ env('APP_URL') }}/wp-content/uploads/2020/10/cropped-DSW-logo-black-2-192x192.png" sizes="192x192" />
<link rel="apple-touch-icon" href="{{ env('APP_URL') }}/wp-content/uploads/2020/10/cropped-DSW-logo-black-2-180x180.png" />
<meta name="msapplication-TileImage" content="{{ env('APP_URL') }}/wp-content/uploads/2020/10/cropped-DSW-logo-black-2-270x270.png" />
		<style type="text/css" id="wp-custom-css">
			i.fa.fa-link {display: none;}
@media only screen and (min-width: 992px) {#contact .sec-title.centered {text-align: center;margin-left: -350px;}}
		</style>
		<style type="text/css" id="miexpo_options-dynamic-css" title="dynamic-css" class="redux-options-output">h1,h2,h3,h4,h5,h6{font-family:Karla;font-weight:normal;font-style:normal;font-display:swap;}.sec-title h2{font-family:Karla;font-weight:400;font-style:normal;font-display:swap;}</style>            <style>
              :root { 
                --qlwapp-scheme-brand:#1d911b;--qlwapp-scheme-text:#ffffff;--qlwapp-scheme-qlwapp_scheme_form_nonce:8803116fce;--qlwapp-scheme-_wp_http_referer:/wp-admin/admin.php?page=qlwapp_scheme;              }
                                #qlwapp .qlwapp-toggle,
                  #qlwapp .qlwapp-box .qlwapp-header,
                  #qlwapp .qlwapp-box .qlwapp-user,
                  #qlwapp .qlwapp-box .qlwapp-user:before {
                    background-color: var(--qlwapp-scheme-brand);  
                  }
                                              #qlwapp .qlwapp-toggle,
                  #qlwapp .qlwapp-toggle .qlwapp-icon,
                  #qlwapp .qlwapp-toggle .qlwapp-text,
                  #qlwapp .qlwapp-box .qlwapp-header,
                  #qlwapp .qlwapp-box .qlwapp-user {
                    color: var(--qlwapp-scheme-text);
                  }
                          </style>
                          <link rel="stylesheet" href="{{ asset('css/style.css') }}">
                </head>
    <body data-rsssl=1 class="home page-template page-template-elementor_header_footer page page-id-2085 wp-custom-logo theme-miexpo woocommerce-no-js elementor-default elementor-template-full-width elementor-kit-2523 elementor-page elementor-page-2085">
        <div class="page-wrapper">
            <!-- Main Header-->
            @include('Components.Header')
            <!-- Price Section Two -->
            <section class="price-section-two mt-4" style="background-color:#fff; background-image:url('https://54.179.228.148/wp-content/uploads/2020/10/chairs-2181994_1920.jpg');">
                <div class="auto-container mt-4">
                    <!-- Sec Title -->
                    <div class="sec-title centered mt-4">
                        <div class="title mt-3">Data Science Weekend</div>
                        <h2>My Tickets</h2>
                        <div class="separator"></div>
                    </div>
                    <div class="text-center">
                        <div class="d-inline-block w-100 shadow text-left rounded p-5">
                            <div class="table-responsive-xl">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Ticket Name</th>
                                            <th>Event</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <td></td>
                                            <th>Link</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tickets as $ticket)
                                            @php
                                                $status = $ticket->status == 0 ? "<span class='bg-merah rounded p-2 pl-3 pr-3'>Unpaid</span>" : "<span class='bg-hijau rounded p-2 pl-3 pr-3'>Paid</span>";
                                            @endphp
                                            <tr>
                                                <td>{{ $ticket->ticket->name }}</td>
                                                <td>{{ $ticket->ticket->event->title }}</td>
                                                <td>
                                                    @currency($ticket->total_pay)
                                                </td>
                                                <td>{!! $status !!}</td>
                                                <td collspan="6">
                                                    @php
                                                        $now = Carbon::now();
                                                        $dueDate = Carbon::parse($ticket->due_date);
                                                        $minutes = $dueDate->diffInMinutes($now);
                                                    @endphp
                                                    @if ($ticket->status == 0 && $minutes > 0)
                                                        <a href="{{ route('ticket.checkout', ['orderID' => $ticket->id]) }}" class="bg-primer rounded p-2 pl-3 pr-3">
                                                        Pay Now!
                                                        </a>
                                                    @elseif ($ticket->status == 1)
                                                        Ready
                                                    @else
                                                        Expired
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($ticket->ticket->event->id == 7)
                                                         <a href="#" target="_blank">{{ $links[0] }}</a>
                                                    @elseif($ticket->ticket->event->id == 13)
                                                         <a href="#" target="_blank">{{ $links[1] }}</a>
                                                    @elseif($ticket->ticket->event->id == 14)
                                                         @if($ticket->status == 0)
                                                            Please Paid Your Ticket For Get Link
                                                         @else
                                                            <a href="#" target="_blank">{{ $links[2] }}</a>
                                                         @endif
                                                    @elseif($ticket->ticket->event->id == 16)
                                                         @if($ticket->status == 0)
                                                            Please Paid Your Ticket For Get Link
                                                         @else
                                                            <a href="#" target="_blank">{{ $links[3] }}</a>
                                                         @endif
                                                    @elseif($ticket->ticket->event->id == 19)
                                                         <a href="#" target="_blank">{{ $links[4] }}</a>
                                                    @elseif($ticket->ticket->event->id == 21)
                                                         <a href="#" target="_blank">{{ $links[5] }}</a>
                                                    @elseif($ticket->ticket->event->id == 23)
                                                         <a href="#" target="_blank">{{ $links[6] }}</a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!--<table class="table table-bordered">-->
                                <!--    <tbody>-->
                                <!--        <tr>-->
                                <!--            <td>Mau Nonton Dathon : </td>-->
                                <!--            <td><a href="https://www.youtube.com/" target="_blank">Tonton Danthon</a></td>-->
                                <!--        </tr>-->
                                <!--    </tbody>-->
                                <!--</table>-->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
        </div>
		<footer class="main-footer">
            <div class="auto-container">
                <div class="content">
                    <div id="custom_html-4" class="widget_text content footer-widget  widget_custom_html">
                        <div class="textwidget custom-html-widget">
                            <div id="footerLogo">
	                            <img src="{{ env('APP_URL') }}/wp-content/uploads/2020/10/dsw-logo-white.png" />
                            </div>
                        </div>
                    </div>
                    <div id="custom_html-3" class="widget_text content footer-widget  widget_custom_html">
                        <div class="textwidget custom-html-widget">
                            <div id="footerSocmedArea">
	                            <li><a href="https://www.facebook.com/DSWeekend/"><i class="fab fa-facebook"></i></a></li>
	                            <li><a href="https://www.instagram.com/datascienceweekends/"><i class="fab fa-instagram"></i></a></li>
	                            <li><a href="https://twitter.com/dsweekends"><i class="fab fa-twitter"></i></a></li>
	                            <li><a href="https://www.linkedin.com/in/data-science-indonesia/"><i class="fab fa-linkedin"></i></a></li>
                            </div>
                        </div>
                    </div>            
                </div>
            </div>    		
            <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="auto-container">
                <div class="copyright">
                    © 2020 Data Science Weekend. All rights reserved.            </div>
            </div>
        </div>
    </footer>
    <!-- End Main Footer -->

<!--Search Popup-->
<div id="search-popup" class="search-popup">
    <div class="close-search theme-btn"><span class="fas fa-window-close"></span></div>
    <div class="popup-inner">
        <div class="overlay-layer"></div>
        <div class="search-form">
            <form method="post" action="./index.html">
                <div class="form-group">
                    <fieldset>
                        <input type="search" class="form-control" name="s" value="" placeholder="Search Here" required>
                        <input type="submit" value="Search Now!" class="theme-btn">
                    </fieldset>
                </div>
            </form>
        </div>
    </div>
</div><div id="qlwapp" class="qlwapp-free qlwapp-bubble qlwapp-bottom-right qlwapp-all qlwapp-rounded">
  <div class="qlwapp-container">
            <div class="qlwapp-box">
                        <div class="qlwapp-header">
                <i class="qlwapp-close" data-action="close">&times;</i>
                <div class="qlwapp-description">
                  <h3>Hello!</h3>
<p>Ada yang bisa kami bantu?</p>
                </div>
              </div>
                    <div class="qlwapp-body">
                            <a class="qlwapp-account" 
                   data-action="open" 
                   data-phone="6281281646405" 
                   data-message="Halo! Bisa tolong jelaskan apa DSW itu ?" href="javascript:void(0);" target="_blank">
                                        <div class="qlwapp-avatar">
                        <div class="qlwapp-avatar-container">
                          <img alt="Nurul " src="https://www.gravatar.com/avatar/00000000000000000000000000000000">
                        </div>
                      </div>
                                    <div class="qlwapp-info">
                    <span class="qlwapp-label">Support</span>
                    <span class="qlwapp-name">Nurul </span>
                  </div>
                </a>
                      </div>
                  </div>
        <a class="qlwapp-toggle" 
       data-action="box" 
       data-phone="6281281646405" 
       data-message="Halo! Bisa tolong jelaskan apa DSW itu ?" href="javascript:void(0);" target="_blank">
                <i class="qlwapp-icon qlwapp-whatsapp-icon"></i>
            <i class="qlwapp-close" data-action="close">&times;</i>
          </a>
  </div>
</div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script type="text/javascript">
		var c = document.body.className;
		c = c.replace(/woocommerce-no-js/, 'woocommerce-js');
		document.body.className = c;
	</script>
	<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/plugins/miexpo-core/src/elementor-addons/assets/js/addons-script.js?ver=1' id='miexpo-charming-script-js'></script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/plugins/woocommerce/assets/js/jquery-blockui/jquery.blockUI.min.js?ver=2.70' id='jquery-blockui-js'></script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart.min.js?ver=4.5.2' id='wc-add-to-cart-js'></script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/plugins/woocommerce/assets/js/js-cookie/js.cookie.min.js?ver=2.1.4' id='js-cookie-js'></script>
<script type='text/javascript' id='woocommerce-js-extra'>
/* <![CDATA[ */
var woocommerce_params = {"ajax_url":"\/wp-admin\/admin-ajax.php","wc_ajax_url":"\/?wc-ajax=%%endpoint%%"};
/* ]]> */
</script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/plugins/woocommerce/assets/js/frontend/woocommerce.min.js?ver=4.5.2' id='woocommerce-js'></script>
<script type='text/javascript' id='wc-cart-fragments-js-extra'>
/* <![CDATA[ */
var wc_cart_fragments_params = {"ajax_url":"\/wp-admin\/admin-ajax.php","wc_ajax_url":"\/?wc-ajax=%%endpoint%%","cart_hash_key":"wc_cart_hash_ea3cd031c2f4814c4cc99f6a020a4750","fragment_name":"wc_fragments_ea3cd031c2f4814c4cc99f6a020a4750","request_timeout":"5000"};
/* ]]> */
</script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/plugins/woocommerce/assets/js/frontend/cart-fragments.min.js?ver=4.5.2' id='wc-cart-fragments-js'></script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/themes/miexpo/assets/js/popper.min.js?ver=5.5.3' id='popper-js'></script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/themes/miexpo/assets/js/bootstrap.min.js?ver=5.5.3' id='bootstrap-js'></script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/themes/miexpo/assets/js/parallax.min.js?ver=5.5.3' id='parallax-js'></script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/themes/miexpo/assets/js/jquery.scrollTo.js?ver=5.5.3' id='jquery-scrollto-js'></script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/themes/miexpo/assets/js/appear.js?ver=5.5.3' id='appear-js'></script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/themes/miexpo/assets/js/jquery.mCustomScrollbar.concat.min.js?ver=5.5.3' id='jquery-mCustomScrollbar-js'></script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/themes/miexpo/assets/js/jquery.fancybox.js?ver=5.5.3' id='jquery-fancybox-js'></script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/themes/miexpo/assets/js/owl.js?ver=5.5.3' id='owl-carousel-js'></script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/themes/miexpo/assets/js/wow.js?ver=5.5.3' id='wow-js'></script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/themes/miexpo/assets/js/magnific-popup.min.js?ver=5.5.3' id='magnific-popup-js'></script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/themes/miexpo/assets/js/jquery.countdown.js?ver=5.5.3' id='jquery-countdown-js'></script>
<script type='text/javascript' src='./wp-includes/js/jquery/ui/core.min.js?ver=1.11.4' id='jquery-ui-core-js'></script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/plugins/elementor/assets/lib/swiper/swiper.min.js?ver=5.3.6' id='swiper-js'></script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/themes/miexpo/assets/js/paroller.js?ver=5.5.3' id='paroller-js'></script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/themes/miexpo/assets/js/mixitup.js?ver=5.5.3' id='mixitup-js'></script>
<script type='text/javascript' id='miexpo-script-js-extra'>
/* <![CDATA[ */
var miexpo_love_post = {"nonce":"e2f5bcb368","ajaxurl":".\/wp-admin\/admin-ajax.php"};
/* ]]> */
</script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/themes/miexpo/assets/js/script.js?ver=5.5.3' id='miexpo-script-js'></script>
<script type='text/javascript' src='//maps.googleapis.com/maps/api/js?key=AIzaSyAaRCSDEP2nbcQ7eXVAdYTaQvwaVJ1Ge2E&#038;ver=5.5.3' id='miexpo-google-map-js'></script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/themes/miexpo/assets/js/map-script.js?ver=5.5.3' id='miexpo-map-script-js'></script>
<script type='text/javascript' id='tve-dash-frontend-js-extra'>
/* <![CDATA[ */
var tve_dash_front = {"ajaxurl":".\/wp-admin\/admin-ajax.php","force_ajax_send":"","is_crawler":"1"};
/* ]]> */
</script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/plugins/woocommerce/assets/js/selectWoo/selectWoo.full.min.js?ver=1.0.6' id='selectWoo-js'></script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/plugins/wp-whatsapp-chat/assets/frontend/js/qlwapp.min.js?ver=4.7.0' id='qlwapp-js'></script>
<script type='text/javascript' src='./wp-includes/js/jquery/ui/datepicker.min.js?ver=1.11.4' id='jquery-ui-datepicker-js'></script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/plugins/mage-eventpress/js/mixitup.min.js?ver=1' id='mep-mixitup-min-js-js'></script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/plugins/mage-eventpress/js/timeline.min.js?ver=1' id='mep-timeline-min-js'></script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/plugins/mage-eventpress/js/mkb-scripts.js?ver=1' id='mep-event-custom-scripts-js'></script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/plugins/mage-eventpress/js/owl.carousel.min.js?ver=1' id='mep-owl-carousel-min-js'></script>
<script type='text/javascript' src='./wp-includes/js/wp-embed.min.js?ver=5.5.3' id='wp-embed-js'></script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/plugins/elementor/assets/js/frontend-modules.min.js?ver=3.0.9' id='elementor-frontend-modules-js'></script>
<script type='text/javascript' src='./wp-includes/js/jquery/ui/position.min.js?ver=1.11.4' id='jquery-ui-position-js'></script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/plugins/elementor/assets/lib/dialog/dialog.min.js?ver=4.8.1' id='elementor-dialog-js'></script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/plugins/elementor/assets/lib/waypoints/waypoints.min.js?ver=4.0.2' id='elementor-waypoints-js'></script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/plugins/elementor/assets/lib/share-link/share-link.min.js?ver=3.0.9' id='share-link-js'></script>
<script type='text/javascript' id='elementor-frontend-js-before'>
var elementorFrontendConfig = {"environmentMode":{"edit":false,"wpPreview":false},"i18n":{"shareOnFacebook":"Share on Facebook","shareOnTwitter":"Share on Twitter","pinIt":"Pin it","download":"Download","downloadImage":"Download image","fullscreen":"Fullscreen","zoom":"Zoom","share":"Share","playVideo":"Play Video","previous":"Previous","next":"Next","close":"Close"},"is_rtl":false,"breakpoints":{"xs":0,"sm":480,"md":768,"lg":1025,"xl":1440,"xxl":1600},"version":"3.0.9","is_static":false,"legacyMode":{"elementWrappers":true},"urls":{"assets":".\/wp-content\/plugins\/elementor\/assets\/"},"settings":{"page":[],"editorPreferences":[]},"kit":{"global_image_lightbox":"yes","lightbox_enable_counter":"yes","lightbox_enable_fullscreen":"yes","lightbox_enable_zoom":"yes","lightbox_enable_share":"yes","lightbox_title_src":"title","lightbox_description_src":"description"},"post":{"id":2085,"title":"Data%20Science%20Weekend%20%E2%80%93%20Data%20Science%20Fair","excerpt":"","featuredImage":false}};
</script>
<script type='text/javascript' src='{{ env('APP_URL') }}/wp-content/plugins/elementor/assets/js/frontend.min.js?ver=3.0.9' id='elementor-frontend-js'></script>
<script type="text/javascript">var tcb_post_lists=JSON.parse('[]');</script>
<script src="{{ asset('js/base.js') }}"></script>
</div></body>
</html>