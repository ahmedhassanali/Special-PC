<div class="tab-pane fade" id="addresses" role="tabpanel" aria-labelledby="list-addresses">
    <div class="d-flex justify-content-between align-items-center my-3">
        <h5 class="text-dark">{{ __('ecommerce.addresses_title') }}</h5>
        <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addAddress">
            +{{ __('ecommerce.add_address') }}
        </a>
    </div>
    <div class="bg-white">
        @if (count($addresses) > 0)
            @foreach ($addresses as $address)
                <div class="address-card mb-3">
                    <h6 class="text-default">
                        {{ $address->title }}
                    </h6>
                    <p class="text-default">{{ $address->city->ar_name }}</p>
                    <p class="text-default">{{ $address->area->ar_name }}</p>
                    <p class="text-default">{{ $address->address }}</p>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="defaultChecked"
                                {{ $address->default == 1 ? 'checked' : '' }}>
                            <label class="form-check-label text-primary" for="defaultChecked">
                                {{ __('ecommerce.default_address') }}
                            </label>
                        </div>
                        <div class="d-flex g-10">
                            {{-- <a class="link text-default" data-bs-toggle="modal" data-bs-target="#editAddress" data-address-id="{{ $address->id }}">
                            تعديل
                        </a> --}}
                            <a class="link text-red" href="{{ route('customer.address.destroy', $address->id) }}"
                                id="delete-btn">
                                {{ __('ecommerce.delete_address') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="empty"></div>
        @endif
    </div>
</div>
