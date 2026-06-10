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
            <div class="col-12 d-flex justify-content-between">
                <h4 class="h4 mt-3 mx-3 mb-sm-0">
                    {{ __('dashboard.update_product') }}
                </h4>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form class="needs-validation row g-4" novalidate="" enctype="multipart/form-data"
                    action="{{ route('admin.product.update', $product) }}" method="post">
                    @csrf
                    <!-- picture -->
                    <div class="col-12 justify-content-center align-items-center">
                        <label class="form-label"> {{ __('dashboard.image') }}</label>
                        <div class="d-flex align-items-center">
                            <label class="position-relative me-4" for="uploadfile-1" title="Replace this pic">
                                <span class="">
                                    <img style="width: 150px; height:150px" id="uploadfile-1-preview"
                                        class=" border border-white border-3"
                                        src="{{ isset($product) ? asset($product->image) : 'https://via.placeholder.com/150' }}"
                                        alt="" accept="image/*">
                                </span>

                                <!-- Remove btn -->
                                <button type="button" class="uploadremove link text-red">
                                    <i class="bi bi-x"></i>
                                </button>
                            </label>
                            <!-- Upload button -->
                            <label class="btn btn-primary mb-0 mx-2" for="uploadfile-1">{{ __('dashboard.change') }}</label>
                            <input id="uploadfile-1" class="form-control d-none" name="photo" type="file"
                                accept="image/*">
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label">{{ __('dashboard.arabic_name') }}</label>
                        <div class="input-group">
                            <input required type="text" name="ar_name" class="form-control ar"
                                value="{{ isset($product) ? $product->ar_name : old('ar_name') }}"
                                placeholder="Arabic Name">
                        </div>
                    </div>
                    <br>

                    <div class="col-12">
                        <label class="form-label">{{ __('dashboard.english_name') }}</label>
                        <div class="input-group">
                            <input required type="text" name="en_name" class="form-control"
                                value="{{ isset($product) ? $product->en_name : old('en_name') }}"
                                placeholder="English Name">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('dashboard.product_brand') }}</label>
                        <select class="form-control" name="brand_id">
                            <option value="">{{ __('Select Brand') }}</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}"
                                    {{ isset($product) && $product->brand_id == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->en_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label"> {{ __('dashboard.category') }}</label>
                        <select class="form-control" id="category_id" name="category_id">
                            <option value="">{{ __('Select Category') }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ isset($product) && $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->en_title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label"> {{ __('dashboard.sub_category') }}</label>
                        <select class="form-control" id="subCategory_id" name="sub_category_id">
                            <option value="">{{ __('Select Sub Category') }}</option>
                            @foreach ($subCategories as $subCategory)
                                <option value="{{ $subCategory->id }}"
                                    {{ isset($product) && $product->sub_category_id == $subCategory->id ? 'selected' : '' }}>
                                    {{ $subCategory->en_title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label"> {{ __('dashboard.product_unit') }}</label>
                        <select class="form-control" name="unit_id">
                            <option value="">{{ __('Select Unit') }}</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}"
                                    {{ isset($product) && $product->unit_id == $unit->id ? 'selected' : '' }}>
                                    {{ $unit->en_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('dashboard.color') }}</label>
                        <select class="form-control" name="color_id">
                            <option value="">{{ __('Select Color') }}</option>
                            @foreach ($colors as $color)
                                <option value="{{ $color->id }}"
                                    {{ isset($product) && $product->color_id == $color->id ? 'selected' : '' }}>
                                    {{ $color->en_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-md-6 d-none">
                        <label class="form-label">{{ __('dashboard.product_cost') }}</label>
                        <div class="input-group">
                            <input type="number" name="cost" step="any" class="form-control"
                                value="{{ isset($product) ? $product->cost : old('cost') }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('dashboard.product_price') }}</label>
                        <div class="input-group">
                            <input required type="number" name="price" step="any" class="form-control"
                                value="{{ isset($product) ? $product->price : old('price') }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('dashboard.product_weight') }}</label>
                        <div class="input-group">
                            <input required type="number" name="weight" step="any" class="form-control"
                                value="{{ isset($product) ? $product->weight : old('weight') }}">
                        </div>
                    </div>


                    <div class="col-md-6 d-none">
                        <label class="form-label">{{ __('dashboard.product_stock') }}</label>
                        <div class="input-group">
                            <input type="number" name="stock" step="any" class="form-control"
                                value="{{ isset($product) ? $product->stock : old('stock') }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label"> {{ __('dashboard.tax') }}</label>
                        <div class="input-group">
                            <input required type="number" name="tax" step="any" class="form-control"
                                value="{{ isset($product) ? $product->tax : old('tax') }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('dashboard.offer') }}</label>
                        <select class="form-control" id="offer_id" name="offer_id">
                            <option value="">{{ __('Select offer') }}</option>
                            @foreach ($offers as $offer)
                                <option value="{{ $offer->id }}"
                                    {{ isset($product) && $product->offer_id == $offer->id ? 'selected' : '' }}>
                                    {{ $offer->en_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">{{ __('dashboard.arabic_description') }}</label>
                        <div class="input-group d-block">
                            <div id="ar_description_editor" class="quill-editor">{!! isset($product) ? $product->ar_description : old('ar_description') !!}</div>
                            <input type="hidden" name="ar_description" id="ar_description"
                                value="{{ isset($product) ? $product->ar_description : old('ar_description') }}">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">{{ __('dashboard.english_description') }}</label>
                        <div class="input-group d-block">
                            <div id="en_description_editor" class="quill-editor">{!! isset($product) ? $product->en_description : old('en_description') !!}</div>
                            <input type="hidden" name="en_description" id="en_description"
                                value="{{ isset($product) ? $product->en_description : old('en_description') }}">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="form-label">{{ __('dashboard.product_images') }}</label>
                        <input id="eventPhotos" type="file" name="photos[]" class="form-control"
                            placeholder="Photos" multiple accept="image/*">
                        @if (isset($product->images))
                            <div class="row  m-2">
                                @foreach ($product->images as $image)
                                    <div class="col-md-1">
                                        <img src="{{ asset($image->image) }}" class="img-fluid m-2">
                                        <div image_id={{ $image->id }} id="deleteImage"
                                            class="btn btn-sm btn-danger m-2">
                                            <i class="fa fa-trash"></i>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                {{ isset($product) && $product->free_shipping == 1 ? 'checked' : '' }} value="1"
                                name="free_shipping" id="free_shipping">
                            <label class="form-check-label" for="free_shipping">
                                {{ __('dashboard.free_shipping') }}
                            </label>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                {{ isset($product) && $product->special_offer == 1 ? 'checked' : '' }} value="1"
                                name="special_offer" id="special_offer">
                            <label class="form-check-label" for="special_offer">
                                {{ __('dashboard.special_offer') }}
                            </label>
                        </div>
                    </div>

                    <div class="d-sm-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mb-0">{{ __('dashboard.save') }}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // on image delete
        $(document).on('click', '#deleteImage', function() {
            var image_id = $(this).attr('image_id');
            var url = "{{ route('admin.product.deleteImage', ':id') }}";
            url = url.replace(':id', image_id);

            console.log(url);
            Swal.fire({
                title: '? Are you sure',
                text: " ! You won't be able to revert this",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                okButtonText: 'Yes, Approve it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-danger',
                cancelButtonClass: 'btn btn-success',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            _method: 'POST'
                        },
                        success: function(data) {
                            Swal.fire(
                                '{{ __('Deleted') }}!',
                                '{{ __('Your image has been deleted.') }}',
                                'success'
                            ).then(function() {
                                window.location.reload();
                            });
                        },
                        error: function(data) {
                            Swal.fire(
                                'Error!',
                                '{{ __('Your image has not been deleted.') }}',
                                'error'
                            ).then(function() {
                                window.location.reload();
                            });
                        }
                    });
                }
            });
        });
    </script>


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
