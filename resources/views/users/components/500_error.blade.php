@if (session('server_error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                position: "top-end",
                icon: "failed",
                title: "{{ session('server_error') }}",
                showConfirmButton: false,
                timer: 1500
            });
        });
    </script>
@endif
