@extends('admin.layouts.admin')

@section('content')
    <div class="page-content-wrapper m-3">
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-between">
                <h4 class="h4 mt-3 mx-3 mb-sm-0">{{ __('dashboard.manage_roles') }}</h4>
                <a href="{{ route('admin.manager.createRole') }}" class="btn btn-success mx-3 mt-3">
                    {{ __('dashboard.add_role') }}
                </a>
            </div>
        </div>

        <div class="card">
            <div class="p-3">
                <!-- Search and select START -->
                <div class="row g-3 align-items-center justify-content-between">
                    <!-- Search bar -->
                    <div class="col-md-8">
                        <form class="rounded position-relative">
                            <input class="form-control bg-body" type="search" placeholder="Search" aria-label="Search">
                            <button class="link text-gray px-3 py-0 position-absolute top-50 end-0 translate-middle-y"
                                type="submit">
                                <i class="fas fa-search fs-6 "></i>
                            </button>
                        </form>
                    </div>
                </div>
                <!-- Search and select END -->
            </div>

            <div class="card-body">
                <div class="table-responsive border-0">
                    <table class="table align-middle p-4 mb-0 table-hover">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="border-0">{{ __('dashboard.name') }}</th>
                                <th scope="col" class="border-0">{{ __('dashboard.permissions') }}</th>
                                <th scope="col" class="border-0">{{ __('dashboard.action') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td class="text-center">
                                        <h6 class="mb-0">
                                            {{ $role->role }}
                                        </h6>
                                    </td>
                                    <td>
                                        {{ $role->permission }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.manager.editRole', $role->id) }}" class="link">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a role_id="{{ $role->id }}" id="deleteRole" class="link text-red">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script>
            $(document).ready(function() {
                $(document).on('click', '#deleteRole', function(e) {
                    var role_id = $(this).attr('role_id');
                    var url = "{{ route('admin.manager.deleteRole', ':id') }}";
                    url = url.replace(':id', role_id);
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        okButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.value) {
                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    _method: 'POST'
                                },
                                success: function(response) {
                                    Swal.fire({
                                        title: 'Deleted!',
                                        text: 'Your file has been deleted.',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.value) {
                                            location.reload();
                                        }
                                    })
                                }
                            });
                        }
                    })
                });
            });
        </script>
    @endsection
