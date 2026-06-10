<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-M4R93M6F');</script>
    <!-- End Google Tag Manager -->
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/bootstrap-5.2.3-dist/css/bootstrap.rtl.min.css')}}">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/swiper-bundle.min.css')  }}" />
    <meta property="og:title" content="">
    <meta property="og:description" content="">
    <meta property="og:type" content="website">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="171">
    <meta property="og:image" content="{{ asset('assets/img/special-pc-logo-white.png') }}">
    <link href="{{ asset('assets/img/special-pc-logo-dark.png') }}" rel="icon">

    @if (app()->getLocale() === 'ar')
        <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/style.css')}}" media="all">
    @else
        <link rel="stylesheet" href="{{ asset('assets/ecommerce/css/ltr-style.css')}}" media="all">
    @endif
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>

    <style>
        /* Custom SweetAlert2 Styles */
.swal2-popup {
    background-color: white !important;  /* White background */
    color: black !important;            /* Black font color */
    border-radius: 8px !important;      /* Rounded corners */
    font-family: 'Arial', sans-serif;   /* Custom font */
}

.swal2-title {
    color: black !important;            /* Title font color */
}

.swal2-html-container {
    color: black !important;            /* Content font color */
}

.swal2-confirm {
    background-color: #0CC1E0 !important; /* Confirm button background */
    color: black !important;              /* Confirm button text color */
    border: none !important;              /* Remove border */
    border-radius: 4px !important;        /* Rounded button */
}

.swal2-cancel {
    background-color: white !important;  /* Cancel button background */
    color: black !important;             /* Cancel button text color */
    border: 1px solid black !important;  /* Border for cancel button */
    border-radius: 4px !important;       /* Rounded button */
}

    </style>

    <title>  Special pc </title>
</head>
