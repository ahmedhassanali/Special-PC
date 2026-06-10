@php
    $cities = App\Models\City::get();
    $areas = App\Models\Area::get();
@endphp
<div class="modal fade edit" id="addAddress" tabindex="-1" data-bs-backdrop="static" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title-sm text-dark" id="editModalLabel">
                    {{ __('ecommerce.add_address') }}
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row" action="{{ route('customer.address.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="col-6 mb-3">
                        <label class="text-default">
                            {{ __('ecommerce.name') }}
                        </label>
                        <input type="text" name="title" class="form-control" id="" placeholder="عنوان 1"
                            required>
                    </div>

                    <div class="col-6 mb-3">
                        <label class="text-default">
                            {{ __('ecommerce.phone_number') }}
                        </label>
                        <input type="tel" class="form-control" id="" name="phone" placeholder="0500000"
                            required>
                    </div>

                    <div class="col-6 mb-3">
                        <label class="text-default">
                            {{ __('ecommerce.city') }}
                        </label>
                        <select class="form-select" aria-label="Default select example" name="city_id">
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" selected>
                                    {{ app()->getLocale() == 'ar' ? $city->ar_name : $city->en_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-6 mb-3">
                        <label class="text-default">
                            {{ __('ecommerce.area') }}
                        </label>
                        <select class="form-select" aria-label="Default select example" name="area_id">
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}" selected>
                                    {{ app()->getLocale() == 'ar' ? $area->ar_name : $area->en_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-12 mb-3">
                        <textarea rows="2" class="form-control" name="address" placeholder="{{ __('ecommerce.address') }}"></textarea>
                    </div>


                    <input hidden name="customer_id" value="{{ Auth::guard('ecommerce')->user()->id }}">

                    <div class="col-sm-12 mb-3">
                        <textarea rows="3" class="form-control" name="details" placeholder="{{ __('ecommerce.notes') }}"></textarea>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="default" role="switch"
                                id="defaultChecked">
                            <label class="form-check-label text-default" for="defaultChecked">
                                {{ __('ecommerce.default_address') }}
                            </label>
                        </div>
                    </div>

                    <div class="col-12 text-center">
                        <button type="submit" class="w-50 btn btn-primary borderless">{{ __('ecommerce.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
