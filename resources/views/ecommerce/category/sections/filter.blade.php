@php
    $brands = App\Models\Brand::get();
    $subCategories = App\Models\SubCategory::where('category_id', $category->id)->get();

@endphp

<form class="filter-col d-lg-block d-none" action="{{ route('ecommerce.product.filters') }}" method="GET"
    enctype="multipart/form-data">

    <h4 class="title-xs mb-2 text-dark">
        {{ __('ecommerce.filter_results') }}
    </h4>

    <div class="accordion filter-accordion" id="filter-accordion">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#price"
                    aria-expanded="true" aria-controls="price">
                    {{ __('ecommerce.price') }}
                </button>
            </h2>
            <div id="price" class="accordion-collapse collapse show">
                <div class="accordion-body row-list">
                    <label>
                        {{ __('ecommerce.from') }}
                    </label>
                    <input type="number" value="{{ isset($startPrice) ? $startPrice : '' }}" class="form-control"
                        name="priceFrom">
                    <label>
                        {{ __('ecommerce.to') }}
                    </label>
                    <input type="number" value="{{ isset($endPrice) ? $endPrice : '' }}" class="form-control md"
                        name="priceTo">
                </div>
            </div>
        </div>

        <input hidden name="category_id" value="{{ $category->id }}">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#brand" aria-expanded="false" aria-controls="brand">
                    {{ __('ecommerce.brand') }}
                </button>
            </h2>
            <div id="brand" class="accordion-collapse collapse show">
                <div class="accordion-body">
                    <ul>
                        @foreach ($brands as $brand)
                            <li><input type="checkbox"
                                    {{ isset($brandsSelected) && in_array($brand->id, $brandsSelected) ? 'checked' : '' }}
                                    name="brands[]"
                                    value="{{ $brand->id }}">{{ app()->getLocale() == 'ar' ? $brand->ar_name : $brand->en_name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Subcategories Filter -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#subcategories" aria-expanded="false" aria-controls="subcategories">
                    {{ __('ecommerce.breadcrumb_subcategory') }}
                </button>
            </h2>
            <div id="subcategories" class="accordion-collapse collapse show">
                <div class="accordion-body">
                    <ul>
                        @foreach ($subCategories as $subCategory)
                            <li>
                                <input type="checkbox"
                                    {{ is_array(request('subcategories')) && in_array($subCategory->id, request('subcategories')) ? 'checked' : '' }}
                                    name="subcategories[]" value="{{ $subCategory->id }}">
                                {{ app()->getLocale() == 'ar' ? $subCategory->ar_title : $subCategory->en_title }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- التقييم -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#rate" aria-expanded="false" aria-controls="rate">
                    {{ __('ecommerce.rating') }}
                </button>
            </h2>
            <div id="rate" class="accordion-collapse collapse show">
                <div class="accordion-body">
                    <ul>
                        <li class="d-flex align-items-center">
                            <input type="radio" name="rate" {{ isset($rate) && $rate == 4 ? 'checked' : '' }}
                                value="4">
                            <ul class="list-inline mx-1">
                                @for ($i = 1; $i <= 4; $i++)
                                    @if ($i <= 4)
                                        <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                                    @else
                                        <li class="list-inline-item m-0"><i class="far fa-star text-warning"></i></li>
                                    @endif
                                @endfor
                            </ul>
                            <label>
                                4 {{ __('ecommerce.stars_and_more') }}
                            </label>
                        </li>

                        <li class="d-flex align-items-center">
                            <input type="radio" name="rate" {{ isset($rate) && $rate == 3 ? 'checked' : '' }}
                                value="3">
                            <ul class="list-inline mx-1">
                                @for ($i = 1; $i <= 4; $i++)
                                    @if ($i <= 3)
                                        <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                                    @else
                                        <li class="list-inline-item m-0"><i class="far fa-star text-warning"></i></li>
                                    @endif
                                @endfor
                            </ul>
                            <label>
                                3 {{ __('ecommerce.stars_and_more') }}
                            </label>
                        </li>

                        <li class="d-flex align-items-center">
                            <input type="radio" name="rate" {{ isset($rate) && $rate == 2 ? 'checked' : '' }}
                                value="2">
                            <ul class="list-inline mx-1">
                                @for ($i = 1; $i <= 4; $i++)
                                    @if ($i <= 2)
                                        <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                                    @else
                                        <li class="list-inline-item m-0"><i class="far fa-star text-warning"></i></li>
                                    @endif
                                @endfor
                            </ul>
                            <label>
                                2 {{ __('ecommerce.stars_and_more') }}
                            </label>
                        </li>

                        <li class="d-flex align-items-center">
                            <input type="radio" name="rate" {{ isset($rate) && $rate == 1 ? 'checked' : '' }}
                                value="1">
                            <ul class="list-inline mx-1">
                                @for ($i = 1; $i <= 4; $i++)
                                    @if ($i <= 1)
                                        <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i></li>
                                    @else
                                        <li class="list-inline-item m-0"><i class="far fa-star text-warning"></i></li>
                                    @endif
                                @endfor
                            </ul>
                            <label>
                                1 {{ __('ecommerce.stars_and_more') }}
                            </label>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="buttons">
        <button type="submit" class="btn btn-lg btn-primary borderless">
            {{ __('ecommerce.apply') }}
        </button>
        <a type="" class="link text-gray" href="{{ route('ecommerce.category.show', $category->id) }}">
            <svg id="Close Square" width="20px" height="20px" viewBox="0 0 24 24" version="1.1"
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <g id="Iconly/Light/Close-Square" stroke="none" stroke-width="1" fill="none"
                    fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round">
                    <g id="Close-Square" transform="translate(2.000000, 2.000000)" stroke="#000000"
                        stroke-width="1.5">
                        <line x1="12.3955" y1="7.5949" x2="7.6035" y2="12.3869" id="Stroke-1">
                        </line>
                        <line x1="12.397" y1="12.3898" x2="7.601" y2="7.5928" id="Stroke-2">
                        </line>
                        <path
                            d="M14.3345,0.7502 L5.6655,0.7502 C2.6445,0.7502 0.7505,2.8892 0.7505,5.9162 L0.7505,14.0842 C0.7505,17.1112 2.6355,19.2502 5.6655,19.2502 L14.3335,19.2502 C17.3645,19.2502 19.2505,17.1112 19.2505,14.0842 L19.2505,5.9162 C19.2505,2.8892 17.3645,0.7502 14.3345,0.7502 Z"
                            id="Stroke-3"></path>
                    </g>
                </g>
            </svg>
            {{ __('ecommerce.cancel') }}
        </a>
    </div>

</form>
