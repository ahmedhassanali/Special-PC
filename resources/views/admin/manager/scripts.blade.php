@section('scripts')
<script>
    $(document).ready(function() {
        $(document).on('click', '#deleteUser', function(e) {
            var user_id = $(this).attr('user_id');
            var url = "{{ route('admin.manager.delete', ':id') }}";
            url = url.replace(':id', user_id);
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
        $(document).on('click', '#activeUser', function(e) {
            var user_id = $(this).attr('user_id');
            var url = "{{ route('admin.manager.approve', ':id') }}";
            url = url.replace(':id', user_id);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                okButtonText: 'Yes, active it!'
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
                                title: 'Activated!',
                                text: 'Your file has been activated.',
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

        $(document).on('click', '#desActiveUser', function(e) {
            var user_id = $(this).attr('user_id');
            var url = "{{ route('admin.manager.desactivate', ':id') }}";
            url = url.replace(':id', user_id);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                okButtonText: 'Yes, desactive it!'
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
                                title: 'Desactivated!',
                                text: 'Your file has been desactivated.',
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
