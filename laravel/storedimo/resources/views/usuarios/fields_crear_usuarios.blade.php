<div class="p-0" style="border: solid 1px #337AB7; border-radius: 5px 5px 0 0;">
    <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0" style="background-color: #337AB7">Registrar Personas (Obligatorios * )</h5>

    <div class="row m-0 p-3" id="div_campos_usuarios">
        <div class="col-12 col-md-3">
            <div class="form-group d-flex flex-column">
                <label for="tipo_persona" class="form-label">Tipo persona <span class="text-danger">*</span></label>
                {{-- {!! Form::select('tipo_persona', collect(['' => 'Seleccionar...'])->union($tipo_persona), null, ['class' => 'form-control', 'id' => 'tipo_persona']) !!} --}}
                {!! Form::text('tipo_persona', null, ['class' => 'form-control', 'id' => 'tipo_persona']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3">
            <div class="form-group d-flex flex-column">
                <label for="tipo_documento" class="form-label">Tipo de documento <span class="text-danger">*</span></label>
                {{-- {!! Form::select('tipo_documento', collect(['' => 'Seleccionar...'])->union($tipo_documento), null, ['class' => 'form-control', 'id' => 'tipo_documento']) !!} --}}
                {!! Form::text('tipo_documento', null, ['class' => 'form-control', 'id' => 'tipo_documento']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3">
            <div class="form-group d-flex flex-column">
                <label for="numero_documento" class="form-label">Número de documento <span class="text-danger">*</span></label>
                {!! Form::text('numero_documento', null, ['class' => 'form-control', 'id' => 'numero_documento']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3">
            <div class="form-group d-flex flex-column">
                <label for="nombres" class="form-label">Nombres <span class="text-danger">*</span></label>
                {!! Form::text('nombres', null, ['class' => 'form-control', 'id' => 'nombres']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3 mt-3">
            <div class="form-group d-flex flex-column">
                <label for="apellidos" class="form-label">Apellidos <span class="text-danger">*</span></label>
                {!! Form::text('apellidos', null, ['class' => 'form-control', 'id' => 'apellidos']) !!}
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
                <label for="numero_celular" class="form-label">Número de Celular <span class="text-danger">*</span></label>
                {!! Form::text('numero_celular', null, ['class' => 'form-control', 'id' => 'numero_celular']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3 mt-3" id="">
            <div class="form-group d-flex flex-column">
                <label for="correo_electronico" class="form-label">Correo Electrónico <span class="text-danger">*</span></label>
                {!! Form::text('correo_electronico', null, ['class' => 'form-control', 'id' => 'correo_electronico']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3 mt-3">
            <div class="form-group d-flex flex-column">
                <label for="genero" class="form-label">Género <span class="text-danger">*</span></label>
                {{-- {!! Form::select('genero', collect(['' => 'Seleccionar...'])->union($genero), null, ['class' => 'form-control', 'id' => 'genero']) !!} --}}
                {!! Form::text('genero', null, ['class' => 'form-control', 'id' => 'genero']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3 mt-3" id="">
            <div class="form-group d-flex flex-column">
                <label for="direccion" class="form-label">Dirección</label>
                {!! Form::text('direccion', null, ['class' => 'form-control', 'id' => 'direccion']) !!}
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
