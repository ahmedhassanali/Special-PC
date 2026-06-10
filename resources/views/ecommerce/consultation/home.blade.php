@extends('ecommerce.layouts.app')
<link rel="stylesheet" href="{{ asset('assets/ecommerce/css/consultation.css') }}">
@section('content')

    <header class="fixed-top">
        <div class="mid-header">
            <div class="container-md">
                <div class="row">
                    <div class="col-md-6 col-sm-8">
                        <a class="navbar-brand" href="home.html">
                            <img loading="lazy" src="{{asset('assets/ecommerce/img/special-pc-logo-dark.png')}}" class="">
                        </a>
                        <div class="d-flex sections">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a href="#worry" class="nav-link active">
                                        ماذا نقدم
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#help" class="nav-link">
                                        كيف نساعدك
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#consultant" class="nav-link">
                                        المستشارين
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#join" class="nav-link">
                                        انضم إلينا
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-4">
                        <a class="btn btn-primary" href="login.html">تسجيل الدخول</a>

                        <div class="buttons d-none">
                            <div class="btn-group">
                                <button type="button" class="circle dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <svg id="Profile" width="16px" height="16px" viewBox="0 0 24 24" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="Iconly/Light/Profile" stroke="none" stroke-width="1" fill="none"
                                            fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                            <g id="Profile" transform="translate(4.814286, 2.814476)" stroke="#000000">
                                                <path
                                                    d="M7.17047619,12.531714 C3.30285714,12.531714 -4.08562073e-14,13.1164759 -4.08562073e-14,15.4583807 C-4.08562073e-14,17.8002854 3.28190476,18.4059997 7.17047619,18.4059997 C11.0380952,18.4059997 14.34,17.8202854 14.34,15.479333 C14.34,13.1383807 11.0590476,12.531714 7.17047619,12.531714 Z"
                                                    id="Stroke-1" stroke-width="1.5"></path>
                                                <path
                                                    d="M7.17047634,9.19142857 C9.70857158,9.19142857 11.7657144,7.13333333 11.7657144,4.5952381 C11.7657144,2.05714286 9.70857158,-5.32907052e-15 7.17047634,-5.32907052e-15 C4.6323811,-5.32907052e-15 2.574259,2.05714286 2.574259,4.5952381 C2.56571443,7.1247619 4.60952396,9.18285714 7.13809539,9.19142857 L7.17047634,9.19142857 Z"
                                                    id="Stroke-3" stroke-width="1.42857143"></path>
                                            </g>
                                        </g>
                                    </svg>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="profile.html">
                                            <svg id="Profile" width="16px" height="16px" viewBox="0 0 24 24"
                                                version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <title>Iconly/Two-tone/Profile</title>
                                                <g id="Iconly/Two-tone/Profile" stroke="none" stroke-width="1"
                                                    fill="none" fill-rule="evenodd" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <g id="Profile" transform="translate(4.814286, 2.814476)"
                                                        stroke="#000000" stroke-width="1.5">
                                                        <path
                                                            d="M7.17047619,12.531714 C3.30285714,12.531714 -4.08562073e-14,13.1164759 -4.08562073e-14,15.4583807 C-4.08562073e-14,17.8002854 3.28190476,18.4059997 7.17047619,18.4059997 C11.0380952,18.4059997 14.34,17.8202854 14.34,15.479333 C14.34,13.1383807 11.0590476,12.531714 7.17047619,12.531714 Z"
                                                            id="Stroke-1"></path>
                                                        <path
                                                            d="M7.17047634,9.19142857 C9.70857158,9.19142857 11.7657144,7.13333333 11.7657144,4.5952381 C11.7657144,2.05714286 9.70857158,-5.32907052e-15 7.17047634,-5.32907052e-15 C4.6323811,-5.32907052e-15 2.574259,2.05714286 2.574259,4.5952381 C2.56571443,7.1247619 4.60952396,9.18285714 7.13809539,9.19142857 L7.17047634,9.19142857 Z"
                                                            id="Stroke-3" opacity="0.400000006"></path>
                                                    </g>
                                                </g>
                                            </svg>
                                            حسابي
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="" id="logout">
                                            <svg id="Logout" width="16px" height="16px" viewBox="0 0 24 24"
                                                version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <g id="Iconly/Two-tone/Logout" stroke="none" stroke-width="1"
                                                    fill="none" fill-rule="evenodd" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <g id="Logout" transform="translate(2.000000, 2.000000)"
                                                        stroke="#000000" stroke-width="1.5">
                                                        <path
                                                            d="M13.016,5.3895 L13.016,4.4565 C13.016,2.4215 11.366,0.7715 9.331,0.7715 L4.456,0.7715 C2.422,0.7715 0.772,2.4215 0.772,4.4565 L0.772,15.5865 C0.772,17.6215 2.422,19.2715 4.456,19.2715 L9.341,19.2715 C11.37,19.2715 13.016,17.6265 13.016,15.5975 L13.016,14.6545"
                                                            id="Stroke-1" opacity="0.400000006"></path>
                                                        <line x1="19.8095" y1="10.0214" x2="7.7685"
                                                            y2="10.0214" id="Stroke-3"></line>
                                                        <polyline id="Stroke-5"
                                                            points="16.8812 7.1063 19.8092 10.0213 16.8812 12.9373">
                                                        </polyline>
                                                    </g>
                                                </g>
                                            </svg>
                                            تسجيل الخروج
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <a class="circle" href="favorites.html">
                                <svg id="Heart" width="16px" height="16px" viewBox="0 0 24 24" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Iconly/Two-tone/Heart" stroke="none" stroke-width="1" fill="none"
                                        fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                        <g id="Heart" transform="translate(2.500000, 3.000000)" stroke="#000000"
                                            stroke-width="1.5">
                                            <path
                                                d="M0.371865331,8.59832177 C-0.701134669,5.24832177 0.552865331,1.41932177 4.06986533,0.28632177 C5.91986533,-0.31067823 7.96186533,0.0413217701 9.49986533,1.19832177 C10.9548653,0.0733217701 13.0718653,-0.30667823 14.9198653,0.28632177 C18.4368653,1.41932177 19.6988653,5.24832177 18.6268653,8.59832177 C16.9568653,13.9083218 9.49986533,17.9983218 9.49986533,17.9983218 C9.49986533,17.9983218 2.09786533,13.9703218 0.371865331,8.59832177 Z"
                                                id="Stroke-1"></path>
                                            <path d="M13.5,3.7 C14.57,4.046 15.326,5.001 15.417,6.122" id="Stroke-3"
                                                opacity="0.400000006"></path>
                                        </g>
                                    </g>
                                </svg>
                            </a>

                            <a class="circle" href="cart.html">
                                <svg id="Buy" width="16px" height="16px" viewBox="0 0 24 24" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Iconly/Two-tone/Buy" stroke="none" stroke-width="1" fill="none"
                                        fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                        <g id="Buy" transform="translate(2.000000, 2.500000)" stroke="#000000"
                                            stroke-width="1.5">
                                            <path
                                                d="M5.4223,17.3203 C5.8443,17.3203 6.1873,17.6633 6.1873,18.0853 C6.1873,18.5073 5.8443,18.8493 5.4223,18.8493 C5.0003,18.8493 4.6583,18.5073 4.6583,18.0853 C4.6583,17.6633 5.0003,17.3203 5.4223,17.3203 Z"
                                                id="Stroke-1" opacity="0.400000006"></path>
                                            <path
                                                d="M16.6747,17.3203 C17.0967,17.3203 17.4397,17.6633 17.4397,18.0853 C17.4397,18.5073 17.0967,18.8493 16.6747,18.8493 C16.2527,18.8493 15.9097,18.5073 15.9097,18.0853 C15.9097,17.6633 16.2527,17.3203 16.6747,17.3203 Z"
                                                id="Stroke-3" opacity="0.400000006"></path>
                                            <path
                                                d="M0.7499,0.75 L2.8299,1.11 L3.7929,12.583 C3.8709,13.518 4.6519,14.236 5.5899,14.236 L16.5019,14.236 C17.3979,14.236 18.1579,13.578 18.2869,12.69 L19.2359,6.132 C19.3529,5.323 18.7259,4.599 17.9089,4.599 L3.1639,4.599"
                                                id="Stroke-5"></path>
                                            <line x1="12.1254" y1="8.295" x2="14.8984" y2="8.295"
                                                id="Stroke-7" opacity="0.400000006"></line>
                                        </g>
                                    </g>
                                </svg>
                            </a>
                        </div>

                        <div class="btn-group">
                            <button type="button" class="btn btn-white dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                العربية
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="en" id="en">English</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <section class="worry page" id="worry">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info">
                            <h2 class="title-lg text-primary">
                                محتار من الاختيارات الكثيرة؟
                                <br>
                                ما يهمك
                            </h2>
                            <p class="text-default title-sm">
                                تحدث لأحد مستشارينا و سيساعدك في اتخاذ الاقرار
                            </p>
                            <div class="buttons">
                                <a class="btn btn-primary" href="#now">
                                    ابدأ استشارة
                                </a>
                                <a class="btn btn-secondary" href="#later">
                                    أحجز موعد استشارة
                                </a>
                            </div>
                        </div>
                        <div class="float-card">
                            <div class="consultant-card">
                                <div class="card-head">
                                    <img src="{{asset('assets/ecommerce/img/consultant-1.png')}}">
                                    <div class="consultant-info">
                                        <div class="d-flex align-items-center">
                                            <h6 class="text-dark title-xs">
                                                أحمد عبد الله
                                            </h6>
                                            <div class="rating">
                                                <ul class="list-inline">
                                                    <li class="list-inline-item m-0">
                                                        <i class="fas fa-star text-warning"></i>
                                                    </li>
                                                    <li class="list-inline-item m-0">
                                                        <i class="fas fa-star text-warning"></i>
                                                    </li>
                                                    <li class="list-inline-item m-0">
                                                        <i class="fas fa-star text-warning"></i>
                                                    </li>
                                                    <li class="list-inline-item m-0">
                                                        <i class="fas fa-star text-warning"></i>
                                                    </li>

                                                    <li class="list-inline-item m-0">
                                                        <i class="fas fa-star text-warning"></i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <p>
                                            هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة لقد تم توليد هذا النص من
                                            مولد
                                            النص العربى
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <a class="" href="meeting.html">
                                <img src="{{asset('assets/ecommerce/img/start.png')}}">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 confused">
                        <img class="img-fluid" src="{{asset('assets/ecommerce/img/Products.png')}}">
                    </div>
                </div>
            </div>
        </section>

        <section class="help" id="help">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-sm-10 col-12">
                        <h2 class="title-lg text-primary text-center">
                            كيف يساعدني المستشار؟
                        </h2>
                        <p class="text-default text-center">
                            هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
                            العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف
                            التى يولدها التطبيق.إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة
                            عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي
                            المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم
                            الموقع.
                        </p>
                        <img class="img-fluid" src="{{asset('assets/ecommerce/img/video-call.png')}}">
                    </div>
                </div>
            </div>
        </section>

        <section class="consultant" id="consultant">
            <div class="container" id="now">
                <h2 class="title-md text-primary text-center">
                    المستشارين المتاحين حاليا
                </h2>
                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <div class="consultant-card">
                            <div class="card-head">
                                <img src="assets/img/consultant-1.png">
                                <span class="active"></span>
                                <div class="consultant-info">
                                    <div class="d-flex align-items-center">
                                        <h6 class="text-dark title-xs">
                                            أحمد عبد الله
                                        </h6>
                                        <div class="rating">
                                            <ul class="list-inline">
                                                <li class="list-inline-item m-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item m-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item m-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item m-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>

                                                <li class="list-inline-item m-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <p>
                                        هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة لقد تم توليد هذا النص من مولد
                                        النص العربى
                                    </p>
                                </div>
                                <a class="btn btn-primary" href="meeting.html">
                                    بدأ استشارة
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="consultant-card">
                            <div class="card-head">
                                <img src="{{asset('assets/ecommerce/img/consultant-1.png')}}">
                                <span class="active"></span>
                                <div class="consultant-info">
                                    <div class="d-flex align-items-center">
                                        <h6 class="text-dark title-xs">
                                            أحمد عبد الله
                                        </h6>
                                        <div class="rating">
                                            <ul class="list-inline">
                                                <li class="list-inline-item m-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item m-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item m-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item m-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>

                                                <li class="list-inline-item m-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <p>
                                        هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة لقد تم توليد هذا النص من مولد
                                        النص العربى
                                    </p>
                                </div>
                                <a class="btn btn-primary" href="meeting.html">
                                    بدأ استشارة
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mt-4" id="later">
                <h2 class="title-md text-dark text-center">
                    جميع المستشارين
                </h2>
                <div class="row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="consultant-card">
                            <div class="card-head">
                                <img src="{{asset('assets/ecommerce/img/consultant-1.png')}}">
                                <div class="consultant-info">
                                    <div class="d-flex align-items-center">
                                        <h6 class="text-dark title-xs">
                                            أحمد عبد الله
                                        </h6>
                                        <div class="rating">
                                            <ul class="list-inline">
                                                <li class="list-inline-item m-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item m-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item m-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item m-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>

                                                <li class="list-inline-item m-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <p>
                                        هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة لقد تم توليد هذا النص من مولد
                                        النص العربى
                                    </p>
                                </div>
                            </div>
                            <div class="card-bot">
                                <h6 class="title-xs text-dark"> 10/8/2024</h6>
                                <ul class="list-unstyled d-flex">
                                    <li>
                                        <a class="time-slot btn" href="#">
                                            10:30 PM
                                        </a>
                                    </li>
                                    <li>
                                        <a class="time-slot btn" href="#">
                                            10:30 PM
                                        </a>
                                    </li>
                                    <li>
                                        <a class="time-slot btn" href="#">
                                            10:30 PM
                                        </a>
                                    </li>
                                    <li>
                                        <a class="time-slot btn" href="#">
                                            10:30 PM
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="consultant-card">
                            <div class="card-head">
                                <img src="{{asset('assets/ecommerce/img/consultant-1.png')}}">
                                <div class="consultant-info">
                                    <div class="d-flex align-items-center">
                                        <h6 class="text-dark title-xs">
                                            أحمد عبد الله
                                        </h6>
                                        <div class="rating">
                                            <ul class="list-inline">
                                                <li class="list-inline-item m-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item m-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item m-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item m-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>

                                                <li class="list-inline-item m-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <p>
                                        هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة لقد تم توليد هذا النص من مولد
                                        النص العربى
                                    </p>
                                </div>
                            </div>
                            <div class="card-bot">
                                <h6 class="title-xs text-dark"> 10/8/2024</h6>
                                <ul class="list-unstyled d-flex">
                                    <li>
                                        <a class="time-slot btn" href="#">
                                            10:30 PM
                                        </a>
                                    </li>
                                    <li>
                                        <a class="time-slot btn" href="#">
                                            10:30 PM
                                        </a>
                                    </li>
                                    <li>
                                        <a class="time-slot btn" href="#">
                                            10:30 PM
                                        </a>
                                    </li>
                                    <li>
                                        <a class="time-slot btn" href="#">
                                            10:30 PM
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="consultant-card">
                            <div class="card-head">
                                <img src="{{asset('assets/ecommerce/img/consultant-1.png')}}">
                                <div class="consultant-info">
                                    <div class="d-flex align-items-center">
                                        <h6 class="text-dark title-xs">
                                            أحمد عبد الله
                                        </h6>
                                        <div class="rating">
                                            <ul class="list-inline">
                                                <li class="list-inline-item m-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item m-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item m-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item m-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>

                                                <li class="list-inline-item m-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <p>
                                        هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة لقد تم توليد هذا النص من مولد
                                        النص العربى
                                    </p>
                                </div>
                            </div>
                            <div class="card-bot">
                                <h6 class="title-xs text-dark"> 10/8/2024</h6>
                                <ul class="list-unstyled d-flex">
                                    <li>
                                        <a class="time-slot btn" href="#">
                                            10:30 PM
                                        </a>
                                    </li>
                                    <li>
                                        <a class="time-slot btn" href="#">
                                            10:30 PM
                                        </a>
                                    </li>
                                    <li>
                                        <a class="time-slot btn" href="#">
                                            10:30 PM
                                        </a>
                                    </li>
                                    <li>
                                        <a class="time-slot btn" href="#">
                                            10:30 PM
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="join" id="join">
            <div class="d-flex">
                <h1 class="title-lg text-primary text-center">
                    انضم إلينا
                </h1>
                <h5 class="text-dark text-center title-md">
                    هل تجد لديك القدرات الملائمة
                    <br>
                    للانضمام إلينا؟
                </h5>
                <a href="join.html" class="btn btn-primary">
                    انضم إلينا
                </a>
            </div>
        </section>
    @endsection


    @section('scripts')
        

    @endsection
