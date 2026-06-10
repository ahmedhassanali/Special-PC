<div class="tab-pane fade" id="changePass" role="tabpanel" aria-labelledby="list-changePass">
    <h5 class="text-dark mb-3">{{ __('ecommerce.change_password_title') }}</h5>
    <div class="bg-white">
        <form class="row"
            action="{{ route('ecommerce.customer.change.password', Auth::guard('ecommerce')->user()->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-4 col-6 mb-2">
                <label class="text-default">
                    {{ __('ecommerce.current_password') }}
                </label>
                <input type="password" class="form-control " name="old_password" placeholder="XXXXXXXX" required>
            </div>


            <div class="col-md-4 col-6 mb-2">
                <label class="text-default">
                    {{ __('ecommerce.new_password') }}
                </label>
                <input type="password" class="form-control " name="password" placeholder="XXXXXXXX">
            </div>
            <div class="col-md-4 col-6 mb-2">
                <label class="text-default">
                    {{ __('ecommerce.confirm_password') }}
                </label>
                <input type="password" class="form-control " name="password_confirmation" placeholder="XXXXXXXX">
            </div>
            <div class="col-12">
                <div class="pos-ab">
                    <button type="submit" class="mt-1 btn btn-lg btn-primary borderless">{{ __('ecommerce.save_changes') }}</button>
                </div>
            </div>
        </form>

    </div>
</div>
