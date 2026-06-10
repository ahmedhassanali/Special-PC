@php
    $cities = App\Models\City::get();
    $areas = App\Models\Area::get();
@endphp
<div class="modal fade edit" id="editAddress" tabindex="-1" data-bs-backdrop="static" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title-sm text-dark" id="editModalLabel">
                    {{ __('ecommerce.edit_address') }}
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row" action="{{ route('customer.address.update' , $address->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="col-6 mb-3">
                        <label class="text-default">
                            {{ __('ecommerce.full_name') }}
                        </label>
                        <input type="text" name="title" class="form-control" value="{{ isset($address->title) ? $address->title : '' }}" id="" placeholder="عنوان 1"
                            required>
                    </div>

                    <input type="hidden" id="editAddressId" value="{{ isset($address) ? $address->id : '' }}" name="address_id">


                    <div class="col-6 mb-3">
                        <label class="text-default">
                            {{ __('ecommerce.phone_number') }}
                        </label>
                        <input type="tel" class="form-control" value="{{ isset($address->phone) ? $address->phone : '' }}" name="phone" placeholder="0500000"
                            required>
                    </div>

                    <div class="col-6 mb-3">
                        <label class="text-default">
                            {{ __('ecommerce.city') }}
                        </label>
                        <select class="form-select" aria-label="Default select example" name="city_id">
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" {{ isset($address->city_id) && $address->city_id == $city->id   ? 'selected': '' }}>
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
                                <option value="{{ $area->id }}" {{ isset($address->area_id) && $address->area_id == $area->id   ? 'selected': '' }}>
                                    {{ app()->getLocale() == 'ar' ? $area->ar_name : $area->en_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-12 mb-3">
                        <textarea rows="2" class="form-control" name="address" value="{{ isset($address->address) ? $address->address : '' }}" placeholder="العنوان"></textarea>
                    </div>


                    <input hidden name="customer_id" value="{{ Auth::guard('ecommerce')->user()->id }}">

                    <div class="col-sm-12 mb-3">
                        <textarea rows="3" class="form-control" name="details" value="{{ isset($address->details) ? $address->details : '' }}" placeholder="ملاحظات"></textarea>
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
