@extends('admin.layouts.admin')

@section('content')
<div class="page-content-wrapper m-3">
    <div class="row mb-3">
        <div class="col-12 my-2 d-flex justify-content-between">
            <h4 class="h4 mt-3 mx-3 mb-sm-0">
            Edit Post
            </h4>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form class="row g-4" action="{{ route('admin.blog.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Use PUT method for editing -->

                <!-- picture -->
                <div class="col-12 justify-content-center align-items-center">
                    <label class="form-label">Post Photo</label>
                    <div class="d-flex align-items-center">
                        <label class="position-relative me-4" for="uploadfile-1" title="Replace this pic">
                            <!-- Avatar place holder -->
                            <span class="avatar avatar-xl">
                            @if ($post->photo)
                                <img id="uploadfile-1-preview"
                                    class="avatar-img rounded-circle border border-white border-3"
                                    src="{{ isset($post) ? asset($post->photo) : 'https://via.placeholder.com/150' }}"
                                    alt="" style="width: 150px; height:150px">
                            @endif
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
                        <input required type="text" class="form-control ar" id="title" name="title" value="{{ $post->title }}">
                    </div>
                </div>
                    

                <div class="col-md-12">
                    <label class="form-label">Content</label>
                    <div class="input-group d-block">
                        <div id="edit_content" style="height: 150px;">{!! $post->content !!}</div>
                        <input type="hidden" name="content" id="hidden-content" value="{!! $post->content !!}">
                    </div>
                </div>
                
                <div class="d-sm-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mb-0 ar">Update</button>
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
        var quill = new Quill('#edit_content', {
            theme: 'snow',
        });

        var hiddenContent = document.querySelector('input[name=content]');

        quill.on('text-change', function(delta, oldDelta, source) {
            hiddenContent.value = quill.root.innerHTML;
        });
    })
    </script>
@endsection
