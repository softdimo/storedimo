{{-- INICIO Modal EDITAR PROVEEDOR --}}
{!! Form::model($proveedorEdit, [
    'method' => 'PUT',
    'route' => ['proveedores.update', $proveedorEdit->id_proveedor],
    'class' => 'mt-2',
    'autocomplete' => 'off',
    'id' => 'formEditarProveedor_' . $proveedorEdit->id_proveedor]) !!}
    @csrf

    <div class="rounded-top text-white text-center"
        style="background-color: #337AB7; border: solid 1px #337AB7;">
        <h5 class="m-0 pt-1 pb-1">Editar Proveedor</h5>
    </div>

    {{ Form::hidden('id_proveedor', isset($proveedorEdit) ? $proveedorEdit->id_proveedor : null, ['class' => '', 'id' => 'id_proveedor']) }}

    {{-- ====================================================== --}}
    {{-- ====================================================== --}}

    <div class="modal-body p-0 m-0" style="border: solid 1px #337AB7;">
        <div class="row m-4">
            <div class="col-12 col-md-4">
                <div class="form-group d-flex flex-column">
                    <label for="id_tipo_persona" class=""
                        style="font-size: 15px">Tipo Proveedor
                        <span class="text-danger">*</span></label>
                    {{ Form::select(
                        'id_tipo_persona',
                        collect(['' => 'Seleccionar...'])->union($tipos_proveedor),
                        isset($proveedorEdit) ? $proveedorEdit->id_tipo_persona : null,
                        ['class' => 'form-select select2', 'id' => 'id_tipo_persona_' . $proveedorEdit->id_tipo_persona, 'required' => 'required'],
                    ) }}
                </div>
            </div>
            {{-- ======================= --}}
            <div class="col-12 col-md-4">
                <div class="form-group d-flex flex-column">
                    <label for="id_tipo_documento" class=""
                        style="font-size: 15px">Tipo de documento
                        <span class="text-danger">*</span></label>
                    {!! Form::select(
                        'id_tipo_documento',
                        collect(['' => 'Seleccionar...'])->union($tipos_documento),
                        isset($proveedorEdit) ? $proveedorEdit->id_tipo_documento : null,
                        [
                            'class' => 'form-select select2',
                            'id' => 'id_tipo_documento',
                            'required' => 'required',
                        ],
                    ) !!}
                </div>
            </div>
            {{-- ======================= --}}
            <div class="col-12 col-md-4" id="div_identificacion">
                <div class="form-group d-flex flex-column">
                    <label for="identificacion" class=""
                        style="font-size: 15px">Número de documento</label>
                    {{ Form::text('identificacion', isset($proveedorEdit) ? $proveedorEdit->identificacion : null, [
                        'class' => 'form-control',
                        'id' => 'identificacion',
                    ]) }}
                </div>
            </div>
            {{-- ======================= --}}
            <div class="col-12 col-md-4 mt-4" id="div_nombres_persona">
                <div class="form-group d-flex flex-column">
                    <label for="nombre_usuario" class=""
                        style="font-size: 15px">Nombres
                        <span class="text-danger">*</span></label>
                    {{ Form::text('nombres_proveedor', isset($proveedorEdit) ? $proveedorEdit->nombres_proveedor : null, [
                        'class' => 'form-control',
                        'id' => 'nombres_persona',
                    ]) }}
                </div>
            </div>
            {{-- ======================= --}}
            <div class="col-12 col-md-4 mt-4" id="div_apellidos_persona">
                <div class="form-group d-flex flex-column">
                    <label for="apellidos_persona" class=""
                        style="font-size: 15px">Apellidos
                        <span class="text-danger">*</span>
                    </label>
                    {{ Form::text('apellidos_proveedor', isset($proveedorEdit) ? $proveedorEdit->apellidos_proveedor : null, [
                        'class' => 'form-control',
                        'id' => 'apellidos_persona',
                    ]) }}
                </div>
            </div>
            {{-- ======================= --}}
            <div class="col-12 col-md-4 mt-4" id="div_numero_telefono">
                <div class="form-group d-flex flex-column">
                    <label for="numero_telefono" class=""
                        style="font-size: 15px">Número Teléfono</label>
                    {{ Form::text('telefono_proveedor', isset($proveedorEdit) ? $proveedorEdit->telefono_proveedor : null, [
                        'class' => 'form-control',
                        'id' => 'numero_telefono',
                    ]) }}
                </div>
            </div>
            {{-- ======================= --}}
            <div class="col-12 col-md-4 mt-4" id="div_celular">
                <div class="form-group d-flex flex-column">
                    <label for="celular" class=""
                        style="font-size: 15px">Celular
                        <span class="text-danger">*</span>
                    </label>
                    {{ Form::text('celular_proveedor', isset($proveedorEdit) ? $proveedorEdit->celular_proveedor : null, [
                        'class' => 'form-control',
                        'id' => 'celular',
                        'required' => 'required',
                    ]) }}
                </div>
            </div>
            {{-- ======================= --}}
            <div class="col-12 col-md-4 mt-4" id="div_email">
                <div class="form-group d-flex flex-column">
                    <label for="email" class=""
                        style="font-size: 15px">Correo
                        <span class="text-danger">*</span></label>
                    {{ Form::email('email_proveedor', isset($proveedorEdit) ? $proveedorEdit->email_proveedor : null, [
                        'class' => 'form-control',
                        'id' => 'email',
                        'required' => 'required',
                    ]) }}
                </div>
            </div>
            {{-- ======================= --}}
            <div class="col-12 col-md-4 mt-4" id="div_id_genero">
                <div class="form-group d-flex flex-column">
                    <label for="id_genero" class=""
                        style="font-size: 15px">Género
                        <span class="text-danger">*</span></label>
                    {!! Form::select(
                        'id_genero',
                        collect(['' => 'Seleccionar...'])->union($generos),
                        isset($proveedorEdit) ? $proveedorEdit->id_genero : null,
                        ['class' => 'form-select select2', 'id' => 'id_genero'],
                    ) !!}
                </div>
            </div>
            {{-- ======================= --}}
            <div class="col-12 col-md-4 mt-4" id="div_direccion">
                <div class="form-group d-flex flex-column">
                    <label for="direccion" class=""
                        style="font-size: 15px">Dirección</label>
                    {{ Form::text('direccion_proveedor', isset($proveedorEdit) ? $proveedorEdit->direccion_proveedor : null, [
                        'class' => 'form-control',
                        'id' => 'direccion',
                    ]) }}
                </div>
            </div>
            {{-- ======================= --}}
            <div class="col-12 col-md-4 mt-4" id="div_id_estado">
                <div class="form-group d-flex flex-column">
                    <label for="id_estado" class=""
                        style="font-size: 15px">Estado
                        <span class="text-danger">*</span>
                    </label>
                    {!! Form::select(
                        'id_estado',
                        collect(['' => 'Seleccionar...'])->union($estados),
                        isset($proveedorEdit) ? $proveedorEdit->id_estado : null,
                        [
                            'class' => 'form-select select2',
                            'id' => 'id_estado_' . $proveedorEdit->id_estado,
                        ],
                    ) !!}
                </div>
            </div>
        </div>

        {{-- ============================================== --}}

        <div class="row m-4" id="div_proveedor_juridico">
            <div class="col-12 col-md-4">
                <div class="form-group d-flex flex-column">
                    <label for="nit_empresa" class="form-label">Nit
                        Proveedor<span class="text-danger">*</span></label>
                    {!! Form::text('nit_proveedor', isset($proveedorEdit) ? $proveedorEdit->nit_proveedor : null, [
                        'class' => 'form-control',
                        'id' => 'nit_empresa',
                    ]) !!}
                </div>
            </div>

            {{-- ======================= --}}

            <div class="col-12 col-md-4">
                <div class="form-group d-flex flex-column">
                    <label for="nombre_empresa" class="form-label">Nombre
                        Proveedor<span class="text-danger">*</span></label>
                    {!! Form::text('proveedor_juridico', isset($proveedorEdit) ? $proveedorEdit->proveedor_juridico : null, [
                        'class' => 'form-control',
                        'id' => 'nombre_empresa',
                    ]) !!}
                </div>
            </div>

            {{-- ======================= --}}

            <div class="col-12 col-md-4">
                <div class="form-group d-flex flex-column">
                    <label for="telefono_empresa"
                        class="form-label">Teléfono Proveedor<span
                            class="text-danger">*</span></label>
                    {!! Form::text('telefono_juridico', isset($proveedorEdit) ? $proveedorEdit->telefono_juridico : null, [
                        'class' => 'form-control',
                        'id' => 'telefono_empresa',
                    ]) !!}
                </div>
            </div>
        </div>
    </div> {{-- FIN modal-body --}}

    {{-- ====================================================== --}}
    {{-- ====================================================== --}}

    <div class="modal-footer d-block mt-0 border border-0">
        <!-- Contenedor para el GIF -->
        <div id="loadingIndicatorEditProveedor_{{ $proveedorEdit->id_proveedor }}"
            class="loadingIndicator">
            <img src="{{ asset('imagenes/loading.gif') }}"
                alt="Procesando...">
        </div>

        {{-- ====================================================== --}}
        {{-- ====================================================== --}}

        <div class="d-flex justify-content-center mt-3">
            <button
                id="btn_cancelar_proveedor_{{ $proveedorEdit->id_proveedor }}"
                type="button" class="btn btn-secondary me-3"
                data-bs-dismiss="modal">
                <i class="fa fa-times" aria-hidden="true"> Cancelar</i>
            </button>

            <button type="submit"
                id="btn_editar_proveedor_{{ $proveedorEdit->id_proveedor }}"
                class="btn btn-success">
                <i class="fa fa-floppy-o" aria-hidden="true">
                    Modificar</i>
            </button>
        </div>
    </div> {{-- modal-footer --}}
{!! Form::close() !!}
{{-- FINAL Modal EDITAR PROVEEDOR  --}}
