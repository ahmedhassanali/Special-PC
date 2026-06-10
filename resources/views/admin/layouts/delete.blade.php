@section('delete')
<script>
    $(document).ready(function() {
        $(document).on('click', '#deleteSubject', function(e) {
            var subject_id = $(this).attr('subject_id');
            var url = "{{ $route }}";
            url = url.replace(':id', subject_id);
            Swal.fire({
                title : 'هل أنت متأكد؟',
                text : 'لن تكون قادرًا على التراجع عن هذا',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                okButtonText: '! نعم، احذفه'
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
                                title: 'تم الحذف!',
                                text: 'تم حذف الملف الخاص بك',
                                icon: 'success',
                                confirmButtonText: 'موافق'
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
