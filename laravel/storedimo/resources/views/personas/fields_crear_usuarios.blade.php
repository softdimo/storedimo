<div class="p-0" style="border: solid 1px #337AB7; border-radius: 5px 5px 0 0;">
    <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0" style="background-color: #337AB7">Registrar Personas (Obligatorios * )</h5>

    <div class="row m-0 p-3" id="div_campos_usuarios">
        <div class="col-12 col-md-3">
            <div class="form-group d-flex flex-column">
                <label for="tipo_persona" class="form-label">Tipo persona <span class="text-danger">*</span></label>
                {!! Form::select('tipo_persona', collect(['' => 'Seleccionar...'])->union($tipo_persona), null, ['class' => 'form-control', 'id' => 'tipo_persona']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3">
            <div class="form-group d-flex flex-column">
                <label for="tipo_documento" class="form-label">Tipo de documento <span class="text-danger">*</span></label>
                {!! Form::select('tipo_documento', collect(['' => 'Seleccionar...'])->union($tipo_documento), null, ['class' => 'form-control', 'id' => 'tipo_documento']) !!}
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
                <label for="genero" class="form-label">Género<span class="text-danger">*</span></label>
                {!! Form::select('genero', collect(['' => 'Seleccionar...'])->union($generos), null, ['class' => 'form-control', 'id' => 'genero']) !!}
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

        <div class="col-12 col-md-3 mt-3 d-none" id="div_fecha_contrato">
            <div class="form-group d-flex flex-column">
                <label for="fecha_contrato" class="form-label">Fecha Contrato<span class="text-danger">*</span></label>
                {!! Form::date('fecha_contrato', null, ['class' => 'form-control', 'id' => 'fecha_contrato']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3 mt-3 d-none" id="div_rol">
            <div class="form-group d-flex flex-column">
                <label for="rol" class="form-label">Rol<span class="text-danger">*</span></label>
                {!! Form::select('rol', collect(['' => 'Seleccionar...'])->union(['1'=>'Administrador','2'=>'Vendedor']), null, ['class' => 'form-control', 'id' => 'rol']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3 mt-3 d-none" id="div_nombre_usuario">
            <div class="form-group d-flex flex-column">
                <label for="nombre_usuario" class="form-label">Nombre usuario<span class="text-danger">*</span></label>
                {!! Form::text('nombre_usuario', null, ['class' => 'form-control', 'id' => 'nombre_usuario']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3 mt-3 d-none" id="div_password">
            <div class="form-group d-flex flex-column">
                <label for="password" class="form-label">Contraseña<span class="text-danger">*</span></label>
                {{ Form::password('password', ['class' => 'form-control', 'id' => 'password', 'minlength' => 4, 'maxlength' => 7]) }}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3 mt-3 d-none" id="div_confirmar_password">
            <div class="form-group d-flex flex-column">
                <label for="confirmar_password" class="form-label">Confirmar contraseña
                    <span class="text-danger">*</span>
                </label>
                {{ Form::password('confirmar_password', ['class' => 'form-control', 'id' => 'confirmar_password', 'minlength' => 4, 'maxlength' => 7]) }}
            </div>
        </div>
        
        {{-- ======================= --}}
        
        <div class="col-12 col-md-3 mt-3 d-none" id="div_nit_empresa">
            <div class="form-group d-flex flex-column">
                <label for="nit_empresa" class="form-label">Nit Empresa
                    <span class="text-danger">*</span>
                </label>
                {{ Form::text('nit_empresa', null,['class' => 'form-control', 'id' => 'nit_empresa', 'minlength' => 6, 'maxlength' => 30]) }}
            </div>
        </div>
        
        {{-- ======================= --}}
        
        <div class="col-12 col-md-3 mt-3 d-none" id="div_nombre_empresa">
            <div class="form-group d-flex flex-column">
                <label for="nombre_empresa" class="form-label">Nombre Empresa
                    <span class="text-danger">*</span>
                </label>
                {{ Form::text('nombre_empresa', null,['class' => 'form-control', 'id' => 'nombre_empresa']) }}
            </div>
        </div>
        
        {{-- ======================= --}}
        
        <div class="col-12 col-md-3 mt-3 d-none" id="div_telefono_empresa">
            <div class="form-group d-flex flex-column">
                <label for="telefono_empresa" class="form-label">Teléfono Empresa
                    <span class="text-danger">*</span>
                </label>
                {{ Form::text('telefono_empresa', null,['class' => 'form-control', 'id' => 'telefono_empresa']) }}
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
