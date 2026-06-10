@extends('admin.layouts.admin')

@section('content')
    <div class="page-content-wrapper m-3">
        <div class="row mb-3">
            <div class="col-12 my-2 justify-content-between">
                <h4 class="h4 mb-2 mb-sm-0">{{ __('dashboard.app_settings') }}</h4>
            </div>
        </div>

        <div class="card-body">
            <form class="row g-4" method="POST" id="setting_form" action="{{ route('admin.setting.update') }}" enctype="multipart/Fform-data">
                @csrf

                <div class="col-md-6">
                    <label class="form-label">{{ __('dashboard.title') }}</label>
                    <input type="text" name="title" class="form-control"
                        value="{{ isset($setting) ? $setting->title : old('title') }}" placeholder="Title">
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{ __('dashboard.description') }}</label>
                    <textarea name="description" class="form-control" placeholder="Description">{{ isset($setting) ? $setting->description : old('description') }}</textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label">{{ __('dashboard.logo') }}</label>
                    <input type="file" name="logoIcon" class="form-control" placeholder="Logo" accept="image/*">
                    @if (isset($setting))
                        <img src="{{ asset($setting->logo) }}" alt="logo" width="100px" height="100px">
                    @endif
                </div>

                <div class="col-md-6">
                    <label class="form-label">{{ __('dashboard.service_fee') }}</label>
                    <input type="text" name="service_fee" class="form-control"
                        value="{{ isset($setting) ? $setting->service_fee : old('service_fee') }}"
                        placeholder="Service Fee">
                </div>

                <div class="col-md-6">
                    <label class="form-label">{{ __('dashboard.tax') }}</label>
                    <input type="text" name="tax" class="form-control"
                        value="{{ isset($setting) ? $setting->tax : old('tax') }}" placeholder="Tax">
                </div>

                <div class="col-md-6">
                    <label class="form-label">{{ __('dashboard.server_key') }}</label>
                    <input type="text" name="server_key" class="form-control"
                        value="{{ isset($setting) ? $setting->server_key : old('server_key') }}" placeholder="Server Key">
                </div>
                
                <div class="form-group">
                    <label for="exampleInputName1">  {{ __('dashboard.terms') }}</label>
                    <div id="editor" style="height: 200px;">
                        @if(isset($setting) && $setting->terms)
                            {!! $setting->terms !!}
                        @endif
                    </div>
                </div>
                <textarea name="terms" id="hiddenInput" style="display: none;"></textarea>

                <!-- Save button -->
                <div class="d-sm-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mb-0">{{ __('dashboard.save_changes') }}</button>
                </div>
            </form>
        </div>

        @if (session('errors'))
            <div class="alert alert-danger">
                {{ session('errors') }}
            </div>
        @endif


    </div>
@endsection

@section('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<script>
    if ($('#editor').length > 0) {
        var quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{
                        'color': []
                    }],
                    ['bold', 'italic', 'underline'],
                ]
            }
        });

        var form = document.getElementById('setting_form');
        var hiddenInput = document.getElementById('hiddenInput');


        form.addEventListener('submit', function(e) {
            e.preventDefault();

            var content = quill.root.innerHTML;
            hiddenInput.value = content;

            this.submit();
        });
    }
</script>
@endsection
