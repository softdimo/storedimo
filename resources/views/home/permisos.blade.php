@extends('layouts.app')
@section('title', 'Permisos')

@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> --}}
@stop

@section('content')
    <div class="d-flex p-0">
        <div class="p-0" style="width: 20%">
            @include('layouts.sidebarmenu')
        </div>

        <div class="p-3 d-flex flex-column" style="width: 80%">
            <div class="text-end">
                <a class="nav-link text-blue" href="">
                    <i class="fa fa-question-circle fa-2x" aria-hidden="true" title="Ayuda" style="color: #337AB7"></i>
                </a>
            </div>
            <h2 class="text-uppercase text-center" style="color: #337AB7">Permisos</h2>

            {!! Form::open(['method' => 'POST', 'route' => ['permisos.store'],
                'class' => 'mt-2', 'autocomplete' => 'off', 'id' => 'formAsignarPermisos']) !!}
            @csrf
        
            @include('permisos.fields')

        {!! Form::close() !!}
        </div>
    </div>
@stop

@section('scripts')
<script>
        $("#formAsignarPermisos").on("submit", function (e)
     {
            const form = $(this);
            const submitButton = form.find('button[type="submit"]');
            const cancelButton = form.find('button[type="button"]');
            const loadingIndicator = form.find("div[id^='loadingIndicatorStore']"); // Busca el GIF del form actual
    
            // Dessactivar Botones
            submitButton.prop("disabled", true).html("Procesando... <i class='fa fa-spinner fa-spin'></i>");
            cancelButton.prop("disabled", true);
            
            // Mostrar Spinner
            loadingIndicator.show();
    });

    document.getElementById('seleccionar_todos').addEventListener('change', function () {
        const checkboxes = document.querySelectorAll('.permiso-checkbox');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });
</script>
@stop


