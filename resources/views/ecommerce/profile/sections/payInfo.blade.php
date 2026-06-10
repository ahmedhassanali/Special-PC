<div class="tab-pane fade" id="payInfo" role="tabpanel" aria-labelledby="list-payInfo">
    <div class="d-flex justify-content-between align-items-center my-3">
        <h5 class="text-dark">{{ __('ecommerce.saved_cards_title') }}</h5>
        <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#add-card">
            +{{ __('ecommerce.add_card') }}
        </a>
    </div>
    <div class="bg-white">
        @if (count($paymentCards) > 0)
            @foreach ($paymentCards as $card)
                <div class="address-card mb-3">
                    <h6 class="text-default">
                        {{ $card->name }}
                    </h6>
                    <p class="text-dark">
                        {{ $card->card_number }}
                    </p>
                    <div class="d-flex g-10">
                        <span class="text-default">
                            {{ __('ecommerce.exp_date') }} <span class="text-dark">{{ $card->expire_date }}</span>
                        </span>

                        <span class="text-default">
                            {{ __('ecommerce.cvv') }} <span class="text-dark">{{ $card->cvv }}</span>
                        </span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" {{ $card->default == 1 ? 'checked' : '' }}
                                role="switch" id="defaultChecked">
                            <label class="form-check-label text-primary" for="defaultChecked">
                                {{ __('ecommerce.virtual_payment_card') }}
                            </label>
                        </div>
                        <div class="d-flex g-10">
                            <a class="link text-red" href="{{ route('destroy.payment.card', $card->id) }}"
                                id="delete-btn">
                                {{ __('ecommerce.delete') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="empty"></div>
        @endif
    </div>
    <h5 class="text-dark mb-3">{{ __('ecommerce.wallet_title') }}</h5>
    <div class="bg-white">
        <div class="col-md-4 col-6 mb-3">
            <label class="text-default">
                {{ __('ecommerce.wallet_balance') }}
            </label>
            <input type="text" class="form-control" id=""
                value=" {{ Auth::guard('ecommerce')->user()->wallet }} ريال" disabled>
        </div>
    </div>
</div>
