 @if (session('error'))
           <script>
         Swal.fire({
             title: "{{ session('error') }}",
             position: 'top-end',
             icon: 'error',
             showConfirmButton: false,
             timer: 1500
         });
      </script>
 @endif
 @if (session('success'))
     <script>
         Swal.fire({
             title: "{{ session('success') }}",
             position: 'top-end',
             icon: 'success',
             showConfirmButton: false,
             timer: 1500
         });
     </script>
 @endif
