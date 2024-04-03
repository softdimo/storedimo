@extends('layouts.app')
@section('title', 'Productos stock Mínimo')

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
                <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0" style="background-color: #337AB7">Productos en Stock Mínimo</h5>
            
                <div class="col-12 p-3" id="">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered w-100 mb-0" id="tbl_stock_minimo" aria-describedby="stock_minimo">
                            <thead>
                                <tr class="header-table text-center">
                                    <th>Código</th>
                                    <th>Nombre Producto</th>
                                    <th>Categoría</th>
                                    <th>Descripción</th>
                                    <th>Cantidad</th>
                                    <th>Stock Mínimo</th>
                                </tr>
                            </thead>
                            {{-- ============================== --}}
                            <tbody>
                                    <tr class="text-center">
                                        <td>Código</td>
                                        <td>Nombre Producto</td>
                                        <td>Categoría</td>
                                        <td>Descripción</td>
                                        <td>Cantidad</td>
                                        <td>Stock Mínimo</td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div> {{-- FIN div_campos_usuarios --}}
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
            $("#tbl_stock_minimo").DataTable({
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
            // CIERRE DataTable Lista Usuarios
        });
    </script>
@stop


