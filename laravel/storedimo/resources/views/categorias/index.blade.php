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
                <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0" style="background-color: #337AB7">Gestionar Categorias</h5>

                <div class="d-flex justify-content-between p-3">
                    <div class="col-12 mb-auto" style="border: solid 1px #337AB7; border-radius: 5px; width:30%">
                        <h5 class="border rounded-top text-white p-2" style="background-color: #337AB7">Registrar Categorias</h5>

                        <div class="p-3 d-flex flex-column" style="height: 50%;">
                            <div>
                                <label for="">Nombre Categoría<span class="text-danger"> *</span></label>
                                <input type="text" class="form-control">
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
                    </div>

                    <div class="col-12" style="border: solid 1px #337AB7; border-radius: 5px;; width:68%">
                        <h5 class="border rounded-top text-white p-2 m-0" style="background-color: #337AB7">Listar Categorias</h5>

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
                                        <tr class="text-center">
                                            <td>Código</td>
                                            <td>Nombre Categoría</td>
                                            <td>
                                                <a href="#" role="button" class="btn btn-success rounded-circle btn-circle" title="Modificar">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> {{-- FIN div_campos_usuarios --}}
                </div>
            </div> {{-- FIN div_crear_usuario --}}
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
            // INICIO DataTable Lista Usuarios
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
                "pageLength": 25,
                "scrollX": true,
            });
            // CIERRE DataTable Lista Usuarios
        });
    </script>
@stop


