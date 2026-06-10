<div class="btn-group">
    <button class="btn btn-sm bd-gray dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="inside"
        aria-expanded="false">
        {{ __('ecommerce.arrange_by') }}
    </button>

    @if (isset($filteredProducts))
        @php
            $filtered = $filteredProducts->pluck('id')->toArray();
        @endphp
    @endif

    <ul class="dropdown-menu">
        @foreach (['price_low_to_high' => __('ecommerce.price_low_to_high'), 'price_high_to_low' => __('ecommerce.price_high_to_low'), 'highest_rated' => __('ecommerce.highest_rated'), 'no' => __('ecommerce.cancel')] as $dependOn => $label)

            <li>
                <form action="{{ route('ecommerce.product.arrange') }}" method="GET">
                    <input hidden name="depend_on" value="{{ $dependOn }}">
                    <input type="hidden" value="{{ json_encode($filtered) }}" name="products">
                    <input hidden name="category_id" value="{{ $category->id }}">
                    <button class="dropdown-item{{ $dependOn == 'no' ? ' text-danger' : '' }}"
                        type="submit">{{ $label }}</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
