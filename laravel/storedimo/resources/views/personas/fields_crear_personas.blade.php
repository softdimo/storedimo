<div class="p-0" style="border: solid 1px #337AB7; border-radius: 5px 5px 0 0;">
    <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0" style="background-color: #337AB7">Registrar Personas (Obligatorios * )</h5>

    <div class="row m-0 p-3" id="div_campos_usuarios">
        <div class="col-12 col-md-3">
            <div class="form-group d-flex flex-column">
                <label for="id_tipo_persona" class="form-label">Tipo persona <span class="text-danger">*</span></label>
                {!! Form::select('id_tipo_persona', collect(['' => 'Seleccionar...'])->union($tipos_persona), null, ['class' => 'form-control', 'id' => 'id_tipo_persona']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3">
            <div class="form-group d-flex flex-column">
                <label for="id_tipo_documento" class="form-label">Tipo de documento <span class="text-danger">*</span></label>
                {!! Form::select('id_tipo_documento', collect(['' => 'Seleccionar...'])->union($tipos_documento), null, ['class' => 'form-control', 'id' => 'id_tipo_documento']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3">
            <div class="form-group d-flex flex-column">
                <label for="identificacion" class="form-label">Número de documento <span class="text-danger">*</span></label>
                {!! Form::text('identificacion', null, ['class' => 'form-control', 'id' => 'identificacion', 'minlength' => 6]) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3">
            <div class="form-group d-flex flex-column">
                <label for="nombres_persona" class="form-label">Nombres <span class="text-danger">*</span></label>
                {!! Form::text('nombres_persona', null, ['class' => 'form-control', 'id' => 'nombres_persona']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3 mt-3">
            <div class="form-group d-flex flex-column">
                <label for="apellidos_persona" class="form-label">Apellidos <span class="text-danger">*</span></label>
                {!! Form::text('apellidos_persona', null, ['class' => 'form-control', 'id' => 'apellidos_persona']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        
        <div class="col-12 col-md-3 mt-3">
            <div class="form-group d-flex flex-column">
                <label for="numero_telefono" class="form-label">Número de teléfono</label>
                {!! Form::text('numero_telefono', null, ['class' => 'form-control', 'id' => 'numero_telefono']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3 mt-3" id="">
            <div class="form-group d-flex flex-column">
                <label for="celular" class="form-label">Número de Celular <span class="text-danger">*</span></label>
                {!! Form::text('celular', null, ['class' => 'form-control', 'id' => 'celular']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3 mt-3" id="">
            <div class="form-group d-flex flex-column">
                <label for="email" class="form-label">Correo Electrónico <span class="text-danger">*</span></label>
                {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3 mt-3">
            <div class="form-group d-flex flex-column">
                <label for="id_genero" class="form-label">Género<span class="text-danger">*</span></label>
                {!! Form::select('id_genero', collect(['' => 'Seleccionar...'])->union($generos), null, ['class' => 'form-control', 'id' => 'id_genero']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3 mt-3" id="">
            <div class="form-group d-flex flex-column">
                <label for="direccion" class="form-label">Dirección</label>
                {!! Form::text('direccion', null, ['class' => 'form-control', 'id' => 'direccion']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3 mt-3">
            <div class="form-group d-flex flex-column">
                <label for="id_estado" class="form-label">Estado<span class="text-danger">*</span></label>
                {!! Form::select('id_estado', collect(['' => 'Seleccionar...'])->union($estados), 1, ['class' => 'form-control', 'id' => 'id_estado']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3 mt-3">
            <div class="form-group d-flex flex-column">
                <label for="fecha_contrato" class="form-label">Fecha contrato<span class="text-danger">*</span></label>
                {!! Form::date('fecha_contrato', null, ['class' => 'form-control', 'id' => 'fecha_contrato']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3 mt-3">
            <div class="form-group d-flex flex-column">
                <label for="fecha_terminacion_contrato" class="form-label">Fecha terminación contrato<span class="text-danger">*</span></label>
                {!! Form::date('fecha_terminacion_contrato', null, ['class' => 'form-control', 'id' => 'fecha_terminacion_contrato']) !!}
            </div>
        </div>

        {{-- ========================================================= --}}
        {{-- ========================================================= --}}
        {{-- ========================================================= --}}
        {{-- ========================================================= --}}

        <div class="mt-5 mb-2 d-flex justify-content-center">
            <button class="btn btn-success rounded-2 me-3" type="submit">
                <i class="fa fa-floppy-o"></i>
                Guardar
                {{-- <input class="btn btn-success rounded-2 me-3" type="submit" value="Guardar" id="btn_crear_usuario"> --}}
            </button>

            <button class="btn btn-danger rounded-2" type="submit">
                <i class="fa fa-remove"></i>
                Cancelar
            </button>
        </div>
    </div> {{-- FIN div_campos_usuarios --}}
</div> {{-- FIN div_crear_usuario --}} 
