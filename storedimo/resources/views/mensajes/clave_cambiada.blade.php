@extends('layouts.app')

@section('scripts')
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Bien',
            text: 'Clave cambiada. Por seguridad, será desconectado y debe volver a iniciar sesión.',
            showConfirmButton: false,
            timer: 3000
        });

        setTimeout(function () {
            window.location.href = "{{ route('logout') }}";
        }, 3000);
    </script>
@endsection
