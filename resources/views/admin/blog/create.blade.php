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
            height: 200px; /* Adjust height as needed */
        }

</style>
@section('content')
<div class="page-content-wrapper m-3">
    <div class="row mb-3">
        <div class="col-12 my-2 d-flex justify-content-between">
            <h4 class="h4 mt-3 mx-3 mb-sm-0">
            Create Post
            </h4>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form class="row g-4" action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <!-- picture -->
                    <div class="col-12 justify-content-center align-items-center">
                        <label class="form-label">Post Photo</label>
                        <div class="d-flex align-items-center">
                            <label class="position-relative me-4" for="uploadfile-1" title="Replace this pic">
                                <!-- Avatar place holder -->
                                <span class="avatar avatar-xl">
                                    <img id="uploadfile-1-preview"
                                        class="avatar-img rounded-circle border border-white border-3"
                                        src="{{ isset($post) ? $post->photo() : 'https://via.placeholder.com/150' }}"
                                        alt="" style="width: 150px;height:150px">
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

                    <div class="col-md-12">
                        <label class="form-label">Title</label>
                        <div class="input-group">
                            <input required type="text" class="form-control ar" id="title" name="title" value="{{ old('title') }}">
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <label class="form-label">Content</label>
                        <div class="input-group d-block">
                            <div id="content_editor" style="height: 150px;"></div>
                            <input type="hidden" name="content" id="hidden-content">
                        </div>
                    </div>

                    <div class="d-sm-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mb-0 ar">Create</button>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        var quill = new Quill('#content_editor', {
            theme: 'snow'
        });
        var hiddenContent = document.querySelector('input[name=content]');
        quill.on('text-change', function(delta, oldDelta, source) {
            hiddenContent.value = quill.root.innerHTML;
        });
    })
    </script>
@endsection
