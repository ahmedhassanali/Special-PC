<div class="tab-pane fade show active" id="myinfo" role="tabpanel" aria-labelledby="list-myinfo">
    <h5 class="text-dark my-3">{{ __('ecommerce.my_info') }}</h5>
    <div class="bg-white">
        <form class="row" action="{{ route('ecommerce.customer.update' , Auth::guard('ecommerce')->user()->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-md-4 col-sm-6 mb-2">
                <label class="text-default">
                    {{ __('ecommerce.name') }}
                </label>
                <input type="text" class="form-control" value="{{ Auth::guard('ecommerce')->user()->name }} " id="" placeholder="البريد" name="name">
            </div>
            <div class="col-md-4 col-sm-6 mb-2">
                <label class="text-default">
                    {{ __('ecommerce.age') }}
                </label>
                <input type="text" class="form-control" value="{{ Auth::guard('ecommerce')->user()->age }} " id="" placeholder="العمر" name="age">
            </div>

            <div class="col-md-4 col-sm-6 mb-2">
                <label class="text-default">
                    {{ __('ecommerce.gender') }}
                </label>
                <div class="d-flex align-items-center justify-content-around">
                    <div>
                        <input type="radio" {{ Auth::guard('ecommerce')->user()->gender == '0' ? 'checked' : '' }}  name="gender" value = 0 >
                        <label class="text-dark">
                            {{ __('ecommerce.male') }}
                        </label>
                    </div>
                    <div>
                        <input type="radio" {{ Auth::guard('ecommerce')->user()->gender == '1' ? 'checked' : '' }}  name="gender" value = 1 >
                        <label class="text-dark">
                            {{ __('ecommerce.female') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 mb-2">
                <label class="text-default">
                    {{ __('ecommerce.email') }}
                </label>
                <input type="email" class="form-control"  value="{{ Auth::guard('ecommerce')->user()->email }}"   placeholder="البريد" name="email"
                    required>
            </div>

            <div class="col-md-4 col-sm-6 mb-2">
                <label class="text-default">
                    {{ __('ecommerce.phone') }}
                </label>
                <input type="tel" class="form-control" value="{{ Auth::guard('ecommerce')->user()->phone }}" name="phone"  required>
            </div>

            <div class="col-12">
                <div class="pos-ab">
                    <button type="submit" class="mt-1 btn btn-lg btn-primary borderless">{{ __('ecommerce.save_changes') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
