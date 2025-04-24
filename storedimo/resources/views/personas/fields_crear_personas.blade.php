<div class="p-0" style="border: solid 1px #337AB7; border-radius: 5px 5px 0 0;">
    <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0" style="background-color: #337AB7">Registrar Clientes (Obligatorios * )</h5>

    <div class="m-0 p-3" id="div_campos_usuarios">
        <div class="row">
            <div class="col-12 col-md-3">
                <div class="form-group d-flex flex-column">
                    <label for="id_tipo_persona" class="form-label">Tipo Cliente <span class="text-danger">*</span></label>
                    {!! Form::select('id_tipo_persona', collect(['' => 'Seleccionar...'])->union($clientes), null, ['class' => 'form-select select2', 'id' => 'id_tipo_persona', 'required'=>'required']) !!}
                </div>
            </div>

            {{-- ======================= --}}
            
            <div class="col-12 col-md-3">
                <div class="form-group d-flex flex-column">
                    <label for="id_tipo_documento" class="form-label">Tipo de documento <span class="text-danger">*</span></label>
                    {!! Form::select('id_tipo_documento', collect(['' => 'Seleccionar...'])->union($tipos_documento), null, ['class' => 'form-select select2', 'id' => 'id_tipo_documento', 'required'=>'required']) !!}
                </div>
            </div>

            {{-- ======================= --}}
            
            <div class="col-12 col-md-3" id="div_identificacion">
                <div class="form-group d-flex flex-column">
                    <label for="identificacion" class="form-label">Número de documento <span class="text-danger">*</span></label>
                    {!! Form::text('identificacion', null, ['class' => 'form-control', 'id' => 'identificacion', 'minlength' => 6]) !!}
                </div>
            </div>

            {{-- ======================= --}}
            
            <div class="col-12 col-md-3" id="div_nombres_persona">
                <div class="form-group d-flex flex-column">
                    <label for="nombres_persona" class="form-label">Nombres <span class="text-danger">*</span></label>
                    {!! Form::text('nombres_persona', null, ['class' => 'form-control', 'id' => 'nombres_persona']) !!}
                </div>
            </div>

            {{-- ======================= --}}
            
            <div class="col-12 col-md-3 mt-3" id="div_apellidos_persona">
                <div class="form-group d-flex flex-column">
                    <label for="apellidos_persona" class="form-label">Apellidos <span class="text-danger">*</span></label>
                    {!! Form::text('apellidos_persona', null, ['class' => 'form-control', 'id' => 'apellidos_persona']) !!}
                </div>
            </div>

            {{-- ======================= --}}
            
            
            <div class="col-12 col-md-3 mt-3" id="div_numero_telefono">
                <div class="form-group d-flex flex-column">
                    <label for="numero_telefono" class="form-label">Número de teléfono</label>
                    {!! Form::text('numero_telefono', null, ['class' => 'form-control', 'id' => 'numero_telefono']) !!}
                </div>
            </div>

            {{-- ======================= --}}
            
            <div class="col-12 col-md-3 mt-3" id="div_celular">
                <div class="form-group d-flex flex-column">
                    <label for="celular" class="form-label">Número de Celular <span class="text-danger">*</span></label>
                    {!! Form::text('celular', null, ['class' => 'form-control', 'id' => 'celular']) !!}
                </div>
            </div>

            {{-- ======================= --}}
            
            <div class="col-12 col-md-3 mt-3" id="div_email">
                <div class="form-group d-flex flex-column">
                    <label for="email" class="form-label">Correo Electrónico <span class="text-danger">*</span></label>
                    {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
                </div>
            </div>

            {{-- ======================= --}}
            
            <div class="col-12 col-md-3 mt-3" id="div_direccion">
                <div class="form-group d-flex flex-column">
                    <label for="direccion" class="form-label">Dirección</label>
                    {!! Form::text('direccion', null, ['class' => 'form-control', 'id' => 'direccion']) !!}
                </div>
            </div>

            {{-- ======================= --}}
            
            <div class="col-12 col-md-3 mt-3" id="div_id_genero">
                <div class="form-group d-flex flex-column">
                    <label for="id_genero" class="form-label">Género<span class="text-danger">*</span></label>
                    {!! Form::select('id_genero', collect(['' => 'Seleccionar...'])->union($generos), null, ['class' => 'form-select select2', 'id' => 'id_genero']) !!}
                </div>
            </div>
        </div>

        {{-- ========================================================= --}}
        {{-- ========================================================= --}}
        {{-- ========================================================= --}}
        {{-- ========================================================= --}}

        <div class="row mt-5" id="div_proveedor_juridico">
            <div class="col-12 col-md-3">
                <div class="form-group d-flex flex-column">
                    <label for="nit_empresa" class="form-label">Nit Empresa<span class="text-danger">*</span></label>
                    {!! Form::text('nit_empresa', null, ['class' => 'form-control', 'id' => 'nit_empresa']) !!}
                </div>
            </div>

            {{-- ======================= --}}
            
            <div class="col-12 col-md-3">
                <div class="form-group d-flex flex-column">
                    <label for="nombre_empresa" class="form-label">Nombre Empresa<span class="text-danger">*</span></label>
                    {!! Form::text('nombre_empresa', null, ['class' => 'form-control', 'id' => 'nombre_empresa']) !!}
                </div>
            </div>

            {{-- ======================= --}}
            
            <div class="col-12 col-md-3">
                <div class="form-group d-flex flex-column">
                    <label for="telefono_empresa" class="form-label">Teléfono Empresa<span class="text-danger">*</span></label>
                    {!! Form::text('telefono_empresa', null, ['class' => 'form-control', 'id' => 'telefono_empresa']) !!}
                </div>
            </div>
        </div>

        {{-- ========================================================= --}}
        {{-- ========================================================= --}}
        {{-- ========================================================= --}}
        {{-- ========================================================= --}}
        
        <!-- Contenedor para el GIF -->
        <div id="loadingIndicatorPersonaStore" class="loadingIndicator">
            <img src="{{asset('imagenes/loading.gif')}}" alt="Procesando...">
        </div>

        {{-- ========================================================= --}}
        {{-- ========================================================= --}}

        <div class="mt-5 mb-2 d-flex justify-content-center">
            <button type="submit" class="btn btn-success rounded-2 me-3">
                <i class="fa fa-floppy-o"></i>
                Guardar
            </button>

            <button type="button" class="btn btn-danger rounded-2">
                <i class="fa fa-remove"></i>
                Cancelar
            </button>
        </div>
    </div> {{-- FIN div_campos_usuarios --}}
</div> {{-- FIN div_crear_usuario --}}
