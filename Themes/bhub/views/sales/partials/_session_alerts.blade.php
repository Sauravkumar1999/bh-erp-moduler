@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            swal({
                position: 'center',
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true
            });
        });
    </script>
@endif
@if (session('failed'))
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            swal({
                position: 'center',
                icon: 'error',
                title: 'Error!',
                text: '{{ session('failed') }}',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true
            });
        });
    </script>
@endif 