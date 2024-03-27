<div id="div_crear_usuario" class="border border-2 rounded-4" style="border-color: #337AB7">
    <h4 class="border rounded-top text-white text-center p-2" style="background-color: #337AB7">Registrar Personas (Obligatorios * )</h4>

    <div class="row p-5" id="div_campos_usuarios">
        <div class="col-12 col-md-3">
            <div class="form-group d-flex flex-column">
                <label for="tipoPersona" class="form-label text-uppercase">Tipo persona <span class="text-danger">*</span></label>
                {{-- {!! Form::select('txtTipoPersona', collect(['' => 'Seleccionar...'])->union($tipo_persona), null, ['class' => 'form-control', 'id' => 'tipoPersona']) !!} --}}
                {!! Form::datetimeLocal('fecha_transaccion', null, ['class' => 'form-control', 'id' => 'tipoPersona', 'required' => 'true']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3">
            <div class="form-group d-flex flex-column">
                <label for="comprobante" class="form-label text-uppercase">Tipo de documento <span class="text-danger">*</span></label>
                {!! Form::text('comprobante', null, ['class' => 'form-control', 'id' => 'comprobante']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3">
            <div class="form-group d-flex flex-column">
                <label for="id_tipo_cuenta" class="form-label text-uppercase">Número de dpcumento <span class="text-danger">*</span></label>
                {{-- {!! Form::select('id_tipo_cuenta', collect(['' => 'Seleccionar...'])->union($tipo_cuentas), null, ['class' => 'form-control', 'id' => 'id_tipo_cuenta']) !!} --}}
                {!! Form::text('saldo', null, ['class' => 'form-control', 'id' => 'saldo']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3">
            <div class="form-group d-flex flex-column">
                <label for="id_cuenta_destino" class="form-label text-uppercase">Nombres <span class="text-danger">*</span></label>
                {{-- {!! Form::select('id_cuenta_destino', collect(['' => 'Seleccionar...'])->union($tipo_cuentas), null, ['class' => 'form-control', 'id' => 'id_cuenta_destino']) !!} --}}
                {!! Form::text('saldo', null, ['class' => 'form-control', 'id' => 'saldo']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3 mt-3">
            <div class="form-group d-flex flex-column">
                <label for="id_categoria" class="form-label text-uppercase">Apellidos <span class="text-danger">*</span></label>
                {{-- {!! Form::select('id_categoria', collect(['' => 'Seleccionar...'])->union($categorias), null, ['class' => 'form-control', 'id' => 'id_categoria']) !!} --}}
                {!! Form::text('saldo', null, ['class' => 'form-control', 'id' => 'saldo']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        
        <div class="col-12 col-md-3 mt-3">
            <div class="form-group d-flex flex-column">
                <label for="id_sub_categoria" class="form-label text-uppercase">Número de teléfono</label>
                {{-- {!! Form::select('id_sub_categoria', collect(['' => 'Seleccionar...'])->union($sub_categorias), null, ['class' => 'form-control', 'id' => 'id_sub_categoria']) !!} --}}
                {!! Form::text('saldo', null, ['class' => 'form-control', 'id' => 'saldo']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3 mt-3" id="">
            <div class="form-group d-flex flex-column">
                <label for="id_concepto" class="form-label text-uppercase">Número de Celular <span class="text-danger">*</span></label>
                {{-- {!! Form::select('id_concepto', collect(['' => 'Seleccionar...'])->union($conceptos), null, ['class' => 'form-control', 'id' => 'id_concepto']) !!} --}}
                {!! Form::text('saldo', null, ['class' => 'form-control', 'id' => 'saldo']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3 mt-3" id="">
            <div class="form-group d-flex flex-column">
                <label for="observaciones" class="form-label text-uppercase">Correo Electrónico <span class="text-danger">*</span></label>
                {!! Form::text('observaciones', null, ['class' => 'form-control', 'id' => 'observaciones']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3 mt-3">
            <div class="form-group d-flex flex-column">
                <label for="ingreso" class="form-label text-uppercase">Género <span class="text-danger">*</span></label>
                {!! Form::text('ingreso', null, ['class' => 'form-control', 'id' => 'ingreso']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3 mt-3" id="">
            <div class="form-group d-flex flex-column">
                <label for="egreso" class="form-label text-uppercase">Dirección</label>
                {!! Form::text('egreso', null, ['class' => 'form-control', 'id' => 'egreso']) !!}
            </div>
        </div>
    </div> {{-- FIN div_campos_usuarios --}}

    {{-- ========================================================= --}}
    {{-- ========================================================= --}}
    {{-- ========================================================= --}}
    {{-- ========================================================= --}}

    <div class="row mt-3">
        <div class="col-6 d-flex justify-content-center">
            <input class="btn btn-primary rounded-pill w-25" type="submit" value="Crear Usuario" id="btn_crear_usuario">
        </div>

        <div class="col-6 d-flex justify-content-center">
            <input class="btn btn-primary rounded-pill w-25" type="submit" value="Cancelar" id="btn_cancelar">
        </div>
    </div>
</div> {{-- FIN div_crear_usuario --}}
