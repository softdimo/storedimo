@extends('layouts.app')
@section('title', 'Registrar Usuarios')

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('css/custom.css') }}"> --}}
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

        <div class="p-3" style="width: 80%">

            
            <div id="div_crear_usuario" class="border border-1 rounded-4" style="border-color: #337AB7">
                <h2 class="border rounded-top" style="background-color: #337AB7">Registrar Personas (Obligatorios * )</h2>

                <div class="row mb-1" id="div_campos_transacciones">
                    <div class="col-12 col-md-3">
                        <div class="form-group d-flex flex-column">
                            <label for="fecha_transaccion" class="form-label text-uppercase">fecha transacción <span class="text-danger">*</span></label>
                            {!! Form::datetimeLocal('fecha_transaccion', null, ['class' => 'form-control', 'id' => 'fecha_transaccion', 'required' => 'true', 'step' => '1']) !!}
                        </div>
                    </div>
        
                    {{-- ======================= --}}
                    
                    <div class="col-12 col-md-3">
                        <div class="form-group d-flex flex-column">
                            <label for="comprobante" class="form-label text-uppercase">Comprobante</label>
                            {!! Form::text('comprobante', null, ['class' => 'form-control', 'id' => 'comprobante']) !!}
                        </div>
                    </div>
        
                    {{-- ======================= --}}
                    
                    <div class="col-12 col-md-3">
                        <div class="form-group d-flex flex-column">
                            <label for="id_tipo_cuenta" class="form-label text-uppercase">tipo cuenta</label>
                            {{-- {!! Form::select('id_tipo_cuenta', collect(['' => 'Seleccionar...'])->union($tipo_cuentas), null, ['class' => 'form-control', 'id' => 'id_tipo_cuenta']) !!} --}}
                            {!! Form::text('saldo', null, ['class' => 'form-control', 'id' => 'saldo']) !!}
                        </div>
                    </div>
        
                    {{-- ======================= --}}
                    
                    <div class="col-12 col-md-3">
                        <div class="form-group d-flex flex-column">
                            <label for="id_cuenta_destino" class="form-label text-uppercase">Cuenta Destino</label>
                            {{-- {!! Form::select('id_cuenta_destino', collect(['' => 'Seleccionar...'])->union($tipo_cuentas), null, ['class' => 'form-control', 'id' => 'id_cuenta_destino']) !!} --}}
                            {!! Form::text('saldo', null, ['class' => 'form-control', 'id' => 'saldo']) !!}
                        </div>
                    </div>
        
                    {{-- ======================= --}}
                    
                    <div class="col-12 col-md-3 mt-3">
                        <div class="form-group d-flex flex-column">
                            <label for="id_categoria" class="form-label text-uppercase">categoria</label>
                            {{-- {!! Form::select('id_categoria', collect(['' => 'Seleccionar...'])->union($categorias), null, ['class' => 'form-control', 'id' => 'id_categoria']) !!} --}}
                            {!! Form::text('saldo', null, ['class' => 'form-control', 'id' => 'saldo']) !!}
                        </div>
                    </div>
        
                    {{-- ======================= --}}
                    
                    
                    <div class="col-12 col-md-3 mt-3">
                        <div class="form-group d-flex flex-column">
                            <label for="id_sub_categoria" class="form-label text-uppercase">sub categoria</label>
                            {{-- {!! Form::select('id_sub_categoria', collect(['' => 'Seleccionar...'])->union($sub_categorias), null, ['class' => 'form-control', 'id' => 'id_sub_categoria']) !!} --}}
                            {!! Form::text('saldo', null, ['class' => 'form-control', 'id' => 'saldo']) !!}
                        </div>
                    </div>
        
                    {{-- ======================= --}}
                    
                    <div class="col-12 col-md-3 mt-3" id="">
                        <div class="form-group d-flex flex-column">
                            <label for="id_concepto" class="form-label text-uppercase">concepto</label>
                            {{-- {!! Form::select('id_concepto', collect(['' => 'Seleccionar...'])->union($conceptos), null, ['class' => 'form-control', 'id' => 'id_concepto']) !!} --}}
                            {!! Form::text('saldo', null, ['class' => 'form-control', 'id' => 'saldo']) !!}
                        </div>
                    </div>
        
                    {{-- ======================= --}}
                    
                    <div class="col-12 col-md-3 mt-3" id="">
                        <div class="form-group d-flex flex-column">
                            <label for="observaciones" class="form-label text-uppercase">observaciones</label>
                            {!! Form::text('observaciones', null, ['class' => 'form-control', 'id' => 'observaciones']) !!}
                        </div>
                    </div>
        
                    {{-- ======================= --}}
                    
                    <div class="col-12 col-md-3 mt-3">
                        <div class="form-group d-flex flex-column">
                            <label for="ingreso" class="form-label text-uppercase">Ingreso</label>
                            {!! Form::text('ingreso', null, ['class' => 'form-control', 'id' => 'ingreso']) !!}
                        </div>
                    </div>
        
                    {{-- ======================= --}}
                    
                    <div class="col-12 col-md-3 mt-3" id="">
                        <div class="form-group d-flex flex-column">
                            <label for="egreso" class="form-label text-uppercase">Egreso</label>
                            {!! Form::text('egreso', null, ['class' => 'form-control', 'id' => 'egreso']) !!}
                        </div>
                    </div>
        
                    {{-- ======================= --}}
                    
                    <div class="col-12 col-md-3 mt-3" id="">
                        <div class="form-group d-flex flex-column">
                            <label for="saldo" class="form-label text-uppercase">Saldo</label>
                            {!! Form::text('saldo', null, ['class' => 'form-control', 'id' => 'saldo']) !!}
                        </div>
                    </div>
                </div> {{-- FIN div_campos_transacciones --}}
        
                {{-- ========================================================= --}}
                {{-- ========================================================= --}}
                {{-- ========================================================= --}}
                {{-- ========================================================= --}}
        
                <div class="row mt-3">
                    <div class="col-12 d-flex justify-content-center">
                        <input class="btn btn-primary rounded-pill w-25" type="submit" value="Crear Transacción" id="btn_crear_tx">
                    </div>
                </div>
            </div> {{-- FIN div_crear_transaccion --}}

        </div>
    </div>
@stop

{{-- =============================================================== --}}
{{-- =============================================================== --}}
{{-- =============================================================== --}}

@section('scripts')
    <script>
        $( document ).ready(function() {
            // $("#username").trigger('focus');
        });
    </script>
@stop


