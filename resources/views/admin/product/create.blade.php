@extends('admin.layouts.admin')
<style>
    .quill-editor {
        background-color: #fff;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        padding: 10px;
    }

    .quill-editor .ql-toolbar {
        background-color: #e9ecef;
        border-bottom: 1px solid #ced4da;
    }

    .quill-editor .ql-container {
        height: 200px;
        /* Adjust height as needed */
    }
</style>
@section('content')
    <div class="page-content-wrapper m-3">
        @include('admin.layouts.error')
        <div class="row mb-3">
            <div class="col-12 my-2 d-flex justify-content-between">
                <h4 class="h4 mt-3 mx-3 mb-sm-0">
                    {{ __('dashboard.add_new_product') }}
                </h4>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form class="row g-4" action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="col-12 justify-content-center align-items-center">
                        <label class="form-label">{{ __('dashboard.product_picture') }}</label>
                        <div class="d-flex align-items-center">
                            <label class="position-relative me-4" for="uploadfile-1" title="Replace this pic">
                                <!-- Avatar place holder -->
                                <span class="avatar avatar-xl">
                                    <img id="uploadfile-1-preview"
                                        class="avatar-img rounded-circle border border-white border-3"
                                        src="{{ isset($product) ? $product->image() : 'https://via.placeholder.com/150' }}"
                                        alt="" style="width: 150px; height:150px">
                                </span>
                                <!-- Remove btn -->
                                <button type="button" class="uploadremove link text-red">
                                    <i class="bi bi-x"></i>
                                </button>
                            </label>
                            <!-- Upload button -->
                            <label class="btn btn-primary mb-0" for="uploadfile-1">{{ __('dashboard.change') }}</label>
                            <input id="uploadfile-1" class="form-control d-none" name="photo" type="file">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('dashboard.arabic_name') }}</label>
                        <div class="input-group">
                            <input required type="text" name="ar_name" class="form-control ar"
                                value="{{ old('ar_name') }}">
                        </div>
                    </div>
                    <br>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('dashboard.english_name') }}</label>
                        <div class="input-group">
                            <input required type="text" name="en_name" class="form-control" value="{{ old('en_name') }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('dashboard.product_brand') }}</label>
                        <select class="form-control" name="brand_id">
                            <option value="">{{ __('Select Brand') }}</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->en_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('dashboard.category') }}</label>
                        <select class="form-control" id="category_id" name="category_id">
                            <option value="">{{ __('Select Category') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->en_title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('dashboard.sub_category') }}</label>
                        <select class="form-control" id="subCategory_id" name="sub_category_id">
                            <option value="">{{ __('Select SubCategory') }}</option>
                            @foreach ($subCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->en_title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('dashboard.product_unit') }}</label>
                        <select class="form-control" name="unit_id">
                            <option value="">{{ __('Select Unit') }}</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->en_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('dashboard.color') }}</label>
                        <select class="form-control" name="color_id">
                            <option value="">{{ __('Select Color') }}</option>
                            @foreach ($colors as $color)
                                <option value="{{ $color->id }}">{{ $color->en_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 d-none">
                        <label class="form-label">{{ __('dashboard.product_cost') }}</label>
                        <div class="input-group">
                            <input type="number" step="any" name="cost" class="form-control"
                                value="{{ old('cost') }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label"> {{ __('dashboard.product_price') }}</label>
                        <div class="input-group">
                            <input required type="number" step="any" name="price" class="form-control"
                                value="{{ old('price') }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label"> {{ __('dashboard.product_weight') }}</label>
                        <div class="input-group">
                            <input required type="number" value="0" step="any" name="weight"
                                class="form-control" value="{{ old('weight') }}">
                        </div>
                    </div>



                    <div class="col-md-4 d-none">
                        <label class="form-label"> {{ __('dashboard.product_stock') }}</label>
                        <div class="input-group">
                            <input type="number" step="any" name="stock" class="form-control"
                                value="{{ old('stock') }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label"> {{ __('dashboard.tax') }}</label>
                        <div class="input-group">
                            <input required type="number" step="any" name="tax" class="form-control"
                                value="{{ old('tax') }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label"> {{ __('dashboard.offer') }}</label>
                        <select class="form-control" name="offer_id">
                            <option value="">{{ __('Select offer') }}</option>
                            @foreach ($offers as $offer)
                                <option value="{{ $offer->id }}">{{ $offer->en_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">{{ __('dashboard.arabic_description') }}</label>
                        <div class="input-group d-block">
                            <div id="ar_description_editor" style="height: 150px;">{!! old('ar_description') !!}</div>
                            <input type="hidden" name="ar_description" id="ar_description"
                                value="{{ old('ar_description') }}">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">{{ __('dashboard.english_description') }}</label>
                        <div class="input-group d-block">
                            <div id="en_description_editor" style="height: 150px;">{!! old('en_description') !!}</div>
                            <input type="hidden" name="en_description" id="en_description"
                                value="{{ old('en_description') }}">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">{{ __('dashboard.product_images') }}</label>
                        <input id="Photos" type="file" name="photos[]" class="form-control" placeholder="Photos"
                            multiple accept="image/*">
                    </div>

                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="free_shipping"
                                id="free_shipping">
                            <label class="form-check-label" for="free_shipping">
                                {{ __('dashboard.free_shipping') }}
                            </label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="special_offer"
                                id="special_offer">
                            <label class="form-check-label" for="special_offer">
                                {{ __('dashboard.special_offer') }}
                            </label>
                        </div>
                    </div>

                    <div class="d-sm-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mb-0 ar">{{ __('dashboard.save') }}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var quillAr = new Quill('#ar_description_editor', {
                theme: 'snow'
            });

            var quillEn = new Quill('#en_description_editor', {
                theme: 'snow'
            });

            quillAr.on('text-change', function() {
                document.getElementById('ar_description').value = quillAr.root.innerHTML;
            });

            quillEn.on('text-change', function() {
                document.getElementById('en_description').value = quillEn.root.innerHTML;
            });
        });
    </script>
@endsection
