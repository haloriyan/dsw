<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DSW</title>
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
    <link rel='stylesheet' id='mep-event-style-css'  href='{{ env('APP_URL') }}/wp-content/plugins/mage-eventpress/css/style.css?ver=5.5.3' type='text/css' media='all' />
    <link rel='stylesheet' id='mep-event-timeline-min-style-css'  href='{{ env('APP_URL') }}/wp-content/plugins/mage-eventpress/css/timeline.min.css?ver=5.5.3' type='text/css' media='all' />
    <link rel='stylesheet' id='font-awesome-css-cdn-5.2.0-css'  href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.2.0/css/all.min.css?ver=1' type='text/css' media='all' />
    <link rel='stylesheet' id='font-awesome-css-cdn-css'  href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css?ver=1' type='text/css' media='all' />
    <link rel='stylesheet' id='mep-calendar-min-style-css'  href='{{ env('APP_URL') }}/wp-content/plugins/mage-eventpress/css/calendar.min.css?ver=5.5.3' type='text/css' media='all' />
    <link rel='stylesheet' id='mep-event-owl-carousal-main-style-css'  href='{{ env('APP_URL') }}/wp-content/plugins/mage-eventpress/css/owl.carousel.min.css?ver=5.5.3' type='text/css' media='all' />
    <link rel='stylesheet' id='mep-event-owl-carousal-default-style-css'  href='{{ env('APP_URL') }}/wp-content/plugins/mage-eventpress/css/owl.theme.default.min.css?ver=5.5.3' type='text/css' media='all' />
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css?family=Karla:400&#038;display=swap&#038;ver=1602406384" /><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karla:400&#038;display=swap&#038;ver=1602406384" media="print" onload="this.media='all'"><noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karla:400&#038;display=swap&#038;ver=1602406384" /></noscript><link rel='stylesheet' id='google-fonts-1-css'  href='https://fonts.googleapis.com/css?family=Roboto%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7CRoboto+Slab%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic&#038;ver=5.5.3' type='text/css' media='all' />
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
    </style>
    <style id='miexpo-style-inline-css' type='text/css'>
        .page-title{ background-image:url(); }
        .page-title.blog-title{
            background-image:url({{ env('APP_URL') }}/wp-content/uploads/2020/07/Wedding-virtual-expo.jpg);
        }
        .blog-newsletter { background-image:url(); }
    </style>
</head>
<body>

</body>
</html>