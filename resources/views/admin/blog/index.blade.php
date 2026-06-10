@extends('admin.layouts.admin')

@section('content')
<div class="page-content-wrapper m-3">
        <!-- Title -->
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between">
                <h4 class="h4 mt-3 mx-3 mb-sm-0">
                منشورات المدونه
                    </h4>
                <a href="{{ route('admin.blog.create') }}" class="btn btn-primary mx-3 mt-3">
                إضافة منشور جديد
                </a>
            </div>
        </div>



    <div class="card">
        <div class="card-body">
            <div class="table-responsive border-0">
                <table class="table align-middle p-4 mb-0 table-hover">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="border-0 ">Title</th>
                            <th scope="col" class="border-0 ">Photo</th>
                            <th scope="col" class="border-0 ">Published At</th>
                            <th scope="col" class="border-0 ">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td>
                                    <div class="avatar avatar-md mx-2">
                                        @if ($post->photo)
                                        <img src="{{ asset($post->photo) }}" alt="Post Photo" width=100px" class="avatar-img rounded-circle">
                                         @endif
                                    </div>
                                </td>   
                                
                                <td class="text-center">
                                    <div class="d-flex align-items-center justify-content-center position-relative gap-3">
                                        <h6 class="mb-0">
                                        {{ $post->created_at }}
                                        </h6>
                                    </div>
                                </td>

                                <td>
                                    <a href="{{ route('admin.blog.edit', $post->id) }}" class="link">
                            
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.blog.delete', $post->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="link text-red">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
