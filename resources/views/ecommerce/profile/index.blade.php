@extends('ecommerce.layouts.app')

@section('content')
    <section class="profile page bg-light-blue">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="bg-white">
                        <div class="d-flex align-items-center mb-3 g-4">
                            <h5 class="text-dark">{{ Auth::guard('ecommerce')->user()->name }}</h5>
                            <small class="badge primary-light">
                                {{ __('ecommerce.verified') }}
                            </small>
                        </div>

                        <div class="list-group" id="list-tab" role="tablist">

                            <a class="list-group-item list-group-item-action active" id="list-myinfo" data-bs-toggle="list"
                                href="#myinfo" role="tab" aria-controls="myinfo">
                                <svg id="Profile" width="20px" height="20px" viewBox="0 0 24 24" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Iconly/Two-tone/Profile" stroke="none" stroke-width="1" fill="none"
                                        fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                        <g id="Profile" transform="translate(4.814286, 2.814476)" stroke="#000000"
                                            stroke-width="1.5">
                                            <path
                                                d="M7.17047619,12.531714 C3.30285714,12.531714 -4.08562073e-14,13.1164759 -4.08562073e-14,15.4583807 C-4.08562073e-14,17.8002854 3.28190476,18.4059997 7.17047619,18.4059997 C11.0380952,18.4059997 14.34,17.8202854 14.34,15.479333 C14.34,13.1383807 11.0590476,12.531714 7.17047619,12.531714 Z"
                                                id="Stroke-1"></path>
                                            <path
                                                d="M7.17047634,9.19142857 C9.70857158,9.19142857 11.7657144,7.13333333 11.7657144,4.5952381 C11.7657144,2.05714286 9.70857158,-5.32907052e-15 7.17047634,-5.32907052e-15 C4.6323811,-5.32907052e-15 2.574259,2.05714286 2.574259,4.5952381 C2.56571443,7.1247619 4.60952396,9.18285714 7.13809539,9.19142857 L7.17047634,9.19142857 Z"
                                                id="Stroke-3" opacity="0.400000006"></path>
                                        </g>
                                    </g>
                                </svg>
                                {{ __('ecommerce.my_info') }}
                            </a>

                            <a class="list-group-item list-group-item-action" id="list-orders" data-bs-toggle="list"
                                href="#orders" role="tab" aria-controls="orders">
                                <svg id="Buy" width="20px" height="20px" viewBox="0 0 24 24" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Iconly/Light/Buy" stroke="none" stroke-width="1" fill="none"
                                        fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                        <g id="Buy" transform="translate(2.000000, 2.500000)" stroke="#000000"
                                            stroke-width="1.5">
                                            <path
                                                d="M0.7501,0.7499 L2.8301,1.1099 L3.7931,12.5829 C3.8701,13.5199 4.6531,14.2389 5.5931,14.2359094 L16.5021,14.2359094 C17.3991,14.2379 18.1601,13.5779 18.2871,12.6899 L19.2361,6.1319 C19.3421,5.3989 18.8331,4.7189 18.1011,4.6129 C18.0371,4.6039 3.1641,4.5989 3.1641,4.5989"
                                                id="Stroke-1"></path>
                                            <line x1="12.1251" y1="8.2948" x2="14.8981" y2="8.2948"
                                                id="Stroke-3">
                                            </line>
                                            <path
                                                d="M5.1544,17.7025 C5.4554,17.7025 5.6984,17.9465 5.6984,18.2465 C5.6984,18.5475 5.4554,18.7915 5.1544,18.7915 C4.8534,18.7915 4.6104,18.5475 4.6104,18.2465 C4.6104,17.9465 4.8534,17.7025 5.1544,17.7025 Z"
                                                id="Stroke-5" fill="#000000"></path>
                                            <path
                                                d="M16.4347,17.7025 C16.7357,17.7025 16.9797,17.9465 16.9797,18.2465 C16.9797,18.5475 16.7357,18.7915 16.4347,18.7915 C16.1337,18.7915 15.8907,18.5475 15.8907,18.2465 C15.8907,17.9465 16.1337,17.7025 16.4347,17.7025 Z"
                                                id="Stroke-7" fill="#000000"></path>
                                        </g>
                                    </g>
                                </svg>
                                {{ __('ecommerce.orders') }}
                            </a>

                            <a class="list-group-item list-group-item-action" id="list-addresses" data-bs-toggle="list"
                                href="#addresses" role="tab" aria-controls="addresses">
                                <svg id="Location" width="20px" height="20px" viewBox="0 0 24 24" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Iconly/Two-tone/Location" stroke="none" stroke-width="1" fill="none"
                                        fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                        <g id="Location" transform="translate(3.500000, 2.000000)" stroke="#000000"
                                            stroke-width="1.5">
                                            <path
                                                d="M0.739130438,8.39130439 C0.753537867,4.15071799 4.2028919,0.72472301 8.4434783,0.739085164 C12.6840647,0.753537867 16.1100597,4.2028919 16.0956975,8.4434783 L16.0956975,8.53043483 C16.0434783,11.2869566 14.5043479,13.8347827 12.6173914,15.826087 C11.5382412,16.9467164 10.3331375,17.9388114 9.026087,18.7826088 C8.67659293,19.0849173 8.15818976,19.0849173 7.80869569,18.7826088 C5.86019813,17.5143538 4.15006533,15.9131279 2.75652175,14.052174 C1.51448066,12.4293903 0.809295599,10.4597355 0.739130438,8.41739135 L0.739130438,8.39130439 Z"
                                                id="Path_33958"></path>
                                            <circle id="Ellipse_740" opacity="0.400000006" cx="8.41739135" cy="8.53913048"
                                                r="2.46086958"></circle>
                                        </g>
                                    </g>
                                </svg>
                                {{ __('ecommerce.addresses') }}
                            </a>

                            <a class="list-group-item list-group-item-action" id="list-payInfo" data-bs-toggle="list"
                                href="#payInfo" role="tab" aria-controls="payInfo">
                                <svg id="Wallet" width="20px" height="20px" viewBox="0 0 24 24" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Iconly/Two-tone/Wallet" stroke="none" stroke-width="1" fill="none"
                                        fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                        <g id="Wallet" transform="translate(2.500000, 3.000000)" stroke="#000000"
                                            stroke-width="1.5">
                                            <path
                                                d="M19.1389383,11.3957621 L15.0906357,11.3957621 C13.6041923,11.3948508 12.399362,10.1909319 12.3984507,8.70448849 C12.3984507,7.21804511 13.6041923,6.01412622 15.0906357,6.01321486 L19.1389383,6.01321486"
                                                id="Stroke-1"></path>
                                            <line x1="15.5485988" y1="8.64287993" x2="15.2369105" y2="8.64287993"
                                                id="Stroke-3"></line>
                                            <path
                                                d="M5.24766462,1.52259158e-14 L13.8910914,1.52259158e-14 C16.7892458,1.52259158e-14 19.138756,2.34951014 19.138756,5.24766462 L19.138756,12.4246981 C19.138756,15.3228526 16.7892458,17.6723627 13.8910914,17.6723627 L5.24766462,17.6723627 C2.34951014,17.6723627 1.69176842e-15,15.3228526 1.69176842e-15,12.4246981 L1.69176842e-15,5.24766462 C1.69176842e-15,2.34951014 2.34951014,1.52259158e-14 5.24766462,1.52259158e-14 Z"
                                                id="Stroke-5"></path>
                                            <line x1="4.53561176" y1="4.53816359" x2="9.93456368" y2="4.53816359"
                                                id="Stroke-7" opacity="0.400000006"></line>
                                        </g>
                                    </g>
                                </svg>
                                {{ __('ecommerce.pay_info') }}
                            </a>

                            <a class="list-group-item list-group-item-action" id="list-changePass" data-bs-toggle="list"
                                href="#changePass" role="tab" aria-controls="changePass">
                                <svg id="Lock" width="20px" height="20px" viewBox="0 0 24 24" version="1.1"
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g id="Iconly/Two-tone/Lock" stroke="none" stroke-width="1" fill="none"
                                        fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                                        <g id="Lock" transform="translate(3.500000, 2.000000)" stroke="#000000"
                                            stroke-width="1.5">
                                            <path
                                                d="M12.9234,7.4478 L12.9234,5.3008 C12.9234,2.7878 10.8854,0.749755462 8.3724,0.749755462 C5.8594,0.7388 3.8134,2.7668 3.8024,5.2808 L3.8024,5.3008 L3.8024,7.4478"
                                                id="Stroke-1" opacity="0.400000006"></path>
                                            <path
                                                d="M12.1832,19.2496 L4.5422,19.2496 C2.4482,19.2496 0.7502,17.5526 0.7502,15.4576 L0.7502,11.1686 C0.7502,9.0736 2.4482,7.3766 4.5422,7.3766 L12.1832,7.3766 C14.2772,7.3766 15.9752,9.0736 15.9752,11.1686 L15.9752,15.4576 C15.9752,17.5526 14.2772,19.2496 12.1832,19.2496 Z"
                                                id="Stroke-3"></path>
                                            <line x1="8.3629" y1="12.2027" x2="8.3629" y2="14.4237"
                                                id="Stroke-5">
                                            </line>
                                        </g>
                                    </g>
                                </svg>
                                {{ __('ecommerce.change_pass') }}
                            </a>

                            <a class="list-group-item list-group-item-action" id="list-delete" data-bs-toggle="modal"
                                data-bs-target="#delete">
                                <svg id="Delete" width="20" height="20" viewBox="0 0 25 25" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.4"
                                        d="M18.8892 9.95007C18.8892 17.9691 20.0435 21.5939 12.2797 21.5939C4.5149 21.5939 5.693 17.9691 5.693 9.95007"
                                        stroke="black" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M20.3652 6.87585H4.21472" stroke="black" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M15.7149 6.87582C15.7149 6.87582 16.2435 3.11011 12.2892 3.11011C8.3359 3.11011 8.86447 6.87582 8.86447 6.87582"
                                        stroke="black" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                {{ __('ecommerce.delete') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="tab-content" id="nav-tabContent">

                        @include('ecommerce.profile.sections.update')

                        @include('ecommerce.profile.sections.orders')

                        @include('ecommerce.profile.sections.addresses')

                        @include('ecommerce.profile.sections.payInfo')

                        @include('ecommerce.profile.sections.change-password')

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- حذف الحساب -->
    @include('ecommerce.profile.models.delete')
    <!-- إضافة عنوان  -->
    @include('ecommerce.profile.models.add-address')
    <!-- تعديل عنوان  -->
    {{-- @include('ecommerce.profile.models.edit-address') --}}
    <!-- إضافة بطاقة -->
    @include('ecommerce.profile.models.add-card')

@endsection
