@extends('admin.layouts.admin')

@section('content')
    <div class="page-content-wrapper m-3">
        <div class="row mb-3">
            <div class="col-12">
                <h4 class="h4 mb-2 mb-sm-0">{{ __('dashboard.activity_log') }}</h4>
            </div>
        </div>
        <div class="card">
            <div class="p-3">
                <div class="row g-3 align-items-center justify-content-between">
                    <div class="col-md-8">
                        <form class="rounded position-relative">
                            <input class="form-control bg-body" type="search" placeholder="Search" aria-label="Search">
                            <button class="link text-gray px-3 py-0 position-absolute top-50 end-0 translate-middle-y"
                                type="submit">
                                <i class="fas fa-search fs-6"></i>
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
                                <th scope="col" class="border-0 ">{{ __('dashboard.date') }}</th>
                                <th scope="col" class="border-0 ">{{ __('dashboard.page') }}</th>
                                <th scope="col" class="border-0 ">{{ __('dashboard.data') }}</th>
                                <th scope="col" class="border-0 ">{{ __('dashboard.user') }}</th>
                                <th scope="col" class="border-0 ">{{ __('dashboard.role') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($logs as $log)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center position-relative">
                                            <div class="mb-0 ms-2">
                                                <h6>
                                                    <span
                                                        class="text-info">{{ '[ ' . $log->ConvertAr($log->created_at) . '] ' }}</span>
                                                    {{ $log->action }}
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $log->page }}
                                    </td>

                                    <td>
                                        @if ($log->data)
                                            <a href="#" id="view-data" class="nav-link text-info">
                                                {{ __('dashboard.view_data_change') }}
                                            </a>
                                            <ul style="display: none" id="toggler">
                                                @foreach (json_decode($log->data) as $key => $action)
                                                    <li> {{ $key . '= ' }}
                                                        @if (is_array($action))
                                                            @foreach ($action as $item)
                                                                {{ print_r($item) }}
                                                            @endforeach
                                                        @else
                                                            {{ print_r($action) }}
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </td>
                                    <td>
                                        <a
                                            href="{{ route('admin.manager.edit', $log->user->id) }}">{{ $log->user->name }}</a>
                                    </td>
                                    <td>
                                        {{ $log->user->user_role->role }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="m-3">
                {{ $logs->links() }}
            </div>
    @endsection

    @section('scripts')
        <script>
            $(document).ready(function() {
                $(document).on('click', '#view-data', function(e) {
                    $(this).next().toggle();
                });
            });
        </script>
    @endsection
