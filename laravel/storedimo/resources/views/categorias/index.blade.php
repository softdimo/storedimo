@extends('layouts.app')
@section('title', 'Categorias')

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> --}}
    <style>
        .btn-circle {
            padding-left: 0.3rem !important;
            padding-right: 0.3rem !important;
            padding-top: 0.0rem !important;
            padding-bottom: 0.0rem !important;
        }
    </style>
@stop

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('content')
    <div class="d-flex p-0">
        <div class="p-0" style="width: 20%">
            @include('layouts.sidebarmenu')
        </div>

        {{-- ======================================================================= --}}
        {{-- ======================================================================= --}}

        <div class="p-3 d-flex flex-column" style="width: 80%">
            <div class="text-end">
                <a href="#" class="text-blue">
                    <i class="fa fa-question-circle fa-2x" aria-hidden="false" title="Ayuda" style="color: #337AB7"></i>
                </a>
            </div>

            {{-- =============================================================== --}}
            {{-- =============================================================== --}}

            <div class="p-0" style="border: solid 1px #337AB7; border-radius: 5px;">
                <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0" style="background-color: #337AB7">Gestionar Categorías</h5>

                <div class="d-flex justify-content-between p-3">
                    <div class="col-12 mb-auto" style="border: solid 1px #337AB7; border-radius: 5px; width:30%">
                        <h5 class="border rounded-top text-white p-2" style="background-color: #337AB7">Registrar Categoría</h5>

                        {!! Form::open(['method' => 'POST', 'route' => ['categorias.store'], 'class' => 'mt-2', 'autocomplete' => 'off', 'id' => 'form_crear_categorias']) !!}
                            @csrf

                            <div class="p-3 d-flex flex-column" style="height: 50%;">
                                <div>
                                    <label for="categoria">Nombre Categoría<span class="text-danger"> *</span></label>
                                    {!! Form::text('categoria', null, ['class' => 'form-control', 'id' => 'categoria']) !!}
                                </div>

                                <div class="d-flex justify-content-center mt-3 ">
                                    <button class="btn btn-success rounded-2 me-3" type="submit">
                                        <i class="fa fa-floppy-o"></i>
                                        Guardar
                                    </button>
                        
                                    <button class="btn btn-danger rounded-2" type="submit">
                                        <i class="fa fa-remove"></i>
                                        Cancelar
                                    </button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>

                    <div class="col-12" style="border: solid 1px #337AB7; border-radius: 5px;; width:68%">
                        <h5 class="border rounded-top text-white p-2 m-0" style="background-color: #337AB7">Listar Categorías</h5>

                        <div class="table-responsive p-3">
                            <table class="table table-striped table-bordered w-100 mb-0" id="tbl_categorias" aria-describedby="categorias">
                                <thead>
                                    <tr class="header-table text-center">
                                        <th>Código</th>
                                        <th>Nombre Categoría</th>
                                        <th>Modificar</th>
                                    </tr>
                                </thead>
                                {{-- ============================== --}}
                                <tbody>
                                    @foreach ($categorias as $categoria)
                                        <tr class="text-center">
                                            <td>{{$categoria['id_categoria']}}</td>
                                            <td>{{$categoria['categoria']}}</td>
                                            <td>
                                                <button type="button" class="btn btn-success rounded-circle btn-circle" id="btn_editar_{{$categoria['id_categoria']}}" title="Modificar" data-bs-toggle="modal" data-bs-target="#modal_editar_categoria_{{$categoria['id_categoria']}}">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </button>
                                            </td>

                                            {{-- =============================================================== --}}
                                            {{-- =============================================================== --}}
                                            {{-- =============================================================== --}}

                                            {{-- INICIO Modal EDITAR CATEGORÍA --}}
                                            <div class="modal fade" id="modal_editar_categoria_{{$categoria['id_categoria']}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content p-3 w-100">
                                                        {!! Form::open(['method' => 'POST', 'route' => ['editar_categoria'], 'class' => 'mt-2', 'autocomplete' => 'off', 'id' => 'form_editar_categorias']) !!}
                                                            @csrf
                                                            <div class="" style="border: solid 1px #337AB7;">
                                                                <div class="rounded-top text-white text-center" style="background-color: #337AB7; border: solid 1px #337AB7;">
                                                                    <h5>Modificar Categoría</h5>
                                                                </div>

                                                                {{-- ====================================================== --}}
                                                                {{-- ====================================================== --}}

                                                                <div class="modal-body p-0 m-0">
                                                                    <div class="row m-0 pt-4 pb-4">
                                                                            <div class="col-12 col-md-6">
                                                                                <div class="form-group d-flex flex-column">
                                                                                    <label for="id_categoria" class="" style="font-size: 15px">Código<span class="text-danger">*</span></label>
                                                                                    {{ Form::text('id_categoria', isset($categoria) ? $categoria['id_categoria'] : null, ['class'=>'form-control', 'id'=>'id_categoria', 'readonly']) }}
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-12 col-md-6">
                                                                                <div class="form-group d-flex flex-column">
                                                                                    <label for="categoria" class="" style="font-size: 15px">Nombre<span class="text-danger">*</span></label>
                                                                                    {{ Form::text('categoria', isset($categoria) ? $categoria['categoria'] : null, ['class' => 'form-control', 'id' => 'categoria']) }}
                                                                                </div>
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                            {{-- ====================================================== --}}
                                                            {{-- ====================================================== --}}

                                                            <div class="d-flex justify-content-center mt-5">
                                                                <button type="submit" class="btn btn-success" title="Guardar Configuración">
                                                                    <i class="fa fa-floppy-o" aria-hidden="true"> Modificar</i>
                                                                </button>
                                                                
                                                                
                                                                <button type="button" class="btn btn-secondary" title="Cancelar" data-bs-dismiss="modal">
                                                                    <i class="fa fa-times" aria-hidden="true"> Cancelar</i>
                                                                </button>
                                                            </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- FINAL Modal EDITAR CATEGORÍA --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> {{-- FIN div_ --}}
                </div>
            </div> {{-- FIN div_ --}}
        </div>
    </div>
@stop

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('scripts')
    <script src="{{asset('DataTables/datatables.min.js')}}"></script>
    <script src="{{asset('DataTables/Buttons-2.3.4/js/buttons.html5.min.js')}}"></script>

    <script>
        $( document ).ready(function() {
            // INICIO DataTable Lista Categorías
            $("#tbl_categorias").DataTable({
                dom: 'Blfrtip',
                "infoEmpty": "No hay registros",
                stripe: true,
                "bSort": false,
                "buttons": [
                    {
                        extend: 'copyHtml5',
                        text: 'Copiar',
                        className: 'waves-effect waves-light btn-rounded btn-sm btn-primary',
                        init: function(api, node, config) {
                            $(node).removeClass('dt-button')
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Excel',
                        className: 'waves-effect waves-light btn-rounded btn-sm btn-primary mr-3',
                        customize: function( xlsx ) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
                            $('row:first c', sheet).attr( 's', '42' );
                        }
                    }
                ],
                "pageLength": 10,
                "scrollX": true,
            });
            // CIERRE DataTable Lista Categorías

            // ======================================================
            // ======================================================

        });

        // function editarCategoria(idCategoria) {

        //     $.ajax({
        //         type: "POST",
        //         dataType: "JSON",
        //         data: {
        //             '_token': "{{ csrf_token() }}",
        //             'id_categoria': idCategoria,
        //             'categoria': categoria,
        //         },
        //         success: function (respuesta) {
        //             console.log(respuesta);

        //             if (respuesta == "categoria_editada") {
        //                 Swal.fire(
        //                     'Bien!',
        //                     'Categoría Editada!',
        //                     'success'
        //                 )
        //             }

        //             if (respuesta == "error_exception") {
        //                 Swal.fire(
        //                     'Error!',
        //                     'Categoría no Editada!',
        //                     'error'
        //                 )
        //             }
        //         }
        //     });

        // }
    </script>
@stop


