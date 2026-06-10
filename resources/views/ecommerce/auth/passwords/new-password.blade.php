@extends('ecommerce.layouts.app')
@section('content')
    <section class="login-form page">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7 col-12">
                    <div class="form">
                        <h4 class="text-dark mb-3 text-center">
                            {{ __('ecommerce.set_new_password_title') }}
                        </h4>
                        <p class="text-default text-center">
                            {{ __('ecommerce.set_new_password_description') }}
                        </p>
                        <form class="row" action="{{ route('ecommerce.newPassword') }}" method="POST" id="newPasswordForm"
                            enctype="multipart/form-data">
                            @csrf

                            @include('ecommerce.layouts.errors')
                            <input hidden name="email" value="{{ $email }}">

                            <div class="col-lg-6 mb-2">
                                <label class="text-default">
                                    {{ __('ecommerce.password') }}
                                </label>
                                <input type="password" name="password" class="form-control " id=""
                                    placeholder="XXXXXXXX" required>
                            </div>
                            <div class="col-lg-6 mb-2">
                                <label class="text-default">{{ __('ecommerce.confirm_password') }}</label>
                                <input type="password" name="password_confirmation" class="form-control " id=""
                                    placeholder="XXXXXXXX" required>
                            </div>
                            <div class="col-12">
                                <div class="pos-ab">
                                    <button type="submit" class="w-50 btn btn-primary">{{ __('ecommerce.save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade success" id="success" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <img class="img-fluid" src="{{ asset('assets/ecommerce/img/success.png') }}">
                    <h4 class="title-sm text-dark text-center" id="successModalLabel">
                        تم حفظ كلمة المرور الجديدة بنجاح
                    </h4>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    <p class="text-center text-default">
                        الآن يمكنك تسجيل الدخول باستخدام كلمة المرور الجديده
                        او يمكنك تغييرها من اعدادات حسابك
                    </p>
                </div>
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save </button> -->
            </div>
        </div>
    </div>
@endsection
