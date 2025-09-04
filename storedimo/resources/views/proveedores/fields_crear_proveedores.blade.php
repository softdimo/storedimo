<div class="p-0" style="border: solid 1px #337AB7; border-radius: 5px 5px 0 0;">
    <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0" style="background-color: #337AB7">Registrar
        Proveedores (Obligatorios * )</h5>

    <div class="m-0 p-3" id="div_campos_usuarios">
        <div class="row">
            <div class="col-12 col-md-3">
                <div class="form-group d-flex flex-column">
                    <label for="id_tipo_persona" class="form-label">Tipo persona <span
                            class="text-danger">*</span></label>
                    {!! Form::select(
                        'id_tipo_persona',
                        collect(['' => 'Seleccionar...'])->union($tipos_proveedor),
                        old('id_tipo_persona'),
                        ['class' => 'form-select select2', 'id' => 'id_tipo_persona', 'required' => 'required'],
                    ) !!}
                </div>
            </div>

            {{-- ======================= --}}

            <div class="col-12 col-md-3">
                <div class="form-group d-flex flex-column">
                    <label for="id_tipo_documento" class="form-label">Tipo de documento <span
                            class="text-danger">*</span></label>
                    {!! Form::select(
                        'id_tipo_documento',
                        collect(['' => 'Seleccionar...'])->union($tipos_documento),
                        old('id_tipo_documento'),
                        ['class' => 'form-select select2', 'id' => 'id_tipo_documento', 'required' => 'required'],
                    ) !!}
                </div>
            </div>

            {{-- ======================= --}}

            <div class="col-12 col-md-3" id="div_identificacion">
                <div class="form-group d-flex flex-column">
                    <label for="identificacion" class="form-label">Número de documento <span
                            class="text-danger">*</span></label>
                    {!! Form::text('identificacion', old('identificacion'), [
                        'class' => 'form-control',
                        'id' => 'identificacion',
                        'minlength' => 6,
                        'maxlength' => 10,
                        'required' => 'required',
                    ]) !!}
                </div>
            </div>

            {{-- ======================= --}}

            <div class="col-12 col-md-3" id="div_nombres_persona">
                <div class="form-group d-flex flex-column">
                    <label for="nombres_persona" class="form-label">Nombres <span class="text-danger">*</span></label>
                    {!! Form::text('nombres_proveedor', old('nombres_proveedor'), [
                        'class' => 'form-control',
                        'id' => 'nombres_persona',
                        'required' => 'required',
                        'pattern' => '^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]{2,50}$',
                        'title' => 'Solo letras y espacios. Mínimo 2 y máximo 50 caracteres.',
                        'maxlength' => 50,
                    ]) !!}
                </div>
            </div>

            {{-- ======================= --}}

            <div class="col-12 col-md-3 mt-3" id="div_apellidos_persona">
                <div class="form-group d-flex flex-column">
                    <label for="apellidos_persona" class="form-label">Apellidos <span
                            class="text-danger">*</span></label>
                    {!! Form::text('apellidos_proveedor', old('apellidos_proveedor'), [
                        'class' => 'form-control',
                        'id' => 'apellidos_persona',
                        'required' => 'required',
                        'pattern' => '^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]{2,50}$',
                        'title' => 'Solo letras y espacios. Mínimo 2 y máximo 50 caracteres.',
                        'maxlength' => 50,
                    ]) !!}
                </div>
            </div>

            {{-- ======================= --}}

            <div class="col-12 col-md-3 mt-3" id="div_numero_telefono">
                <div class="form-group d-flex flex-column">
                    <label for="numero_telefono" class="form-label">Teléfono Fijo</label>
                    {!! Form::text('telefono_proveedor', old('telefono_proveedor'), [
                        'class' => 'form-control',
                        'id' => 'numero_telefono',
                        'title' => 'Debe tener entre 7 y 10 dígitos.',
                        'minlength' => 7,
                        'maxlength' => 10,
                        'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57'
                    ]) !!}
                <span id="telefono-error" class="text-danger d-none mt-1"></span>
                </div>
            </div>

            {{-- ======================= --}}

            <div class="col-12 col-md-3 mt-3" id="div_celular">
                <div class="form-group d-flex flex-column">
                    <label for="celular" class="form-label">Celular <span class="text-danger">*</span></label>
                    {!! Form::text('celular_proveedor', old('celular_proveedor'), [
                        'class' => 'form-control',
                        'id' => 'celular',
                        'required' => 'required',
                        'title' => 'El número de celular debe contener exactamente 10 dígitos numéricos',
                        'maxlength' => '10',
                        'minlength' => '10',
                        'onkeypress' => 'return event.charCode >= 48 && event.charCode <= 57'
                    ]) !!}
                </div>
            </div>

            {{-- ======================= --}}

            <div class="col-12 col-md-3 mt-3" id="div_email">
                <div class="form-group d-flex flex-column">
                    <label for="email" class="form-label">Correo Electrónico
                        <span class="text-danger"> *</span>
                    </label>
                    {!! Form::email('email_proveedor', old('email_proveedor'), [
                        'class' => 'form-control',
                        'id' => 'email',
                        'pattern' => '^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$',
                        'required' =>'required',
                        'title' => 'Debe ser una dirección de correo electrónico válida.',
                        'maxlength' => 100,
                    ]) !!}
                </div>
            </div>

            {{-- ======================= --}}

            <div class="col-12 col-md-3 mt-3" id="div_direccion">
                <div class="form-group d-flex flex-column">
                    <label for="direccion" class="form-label">Dirección</label>
                    {!! Form::text('direccion_proveedor', old('direccion_proveedor'), [
                        'class' => 'form-control',
                        'id' => 'direccion',
                        'pattern' => '^[a-zA-Z0-9\s.,-]{5,100}$',
                        'title' => 'Debe contener entre 5 y 100 caracteres, permitidos letras, números, espacios, puntos, comas y guiones.',
                       'maxlength' => 100,
                       'minlength' => 5,
                    ]) !!}
                </div>
            </div>

            {{-- ======================= --}}

            <div class="col-12 col-md-3 mt-3" id="div_id_genero">
                <div class="form-group d-flex flex-column">
                    <label for="id_genero" class="form-label">Género<span class="text-danger">*</span></label>
                    {!! Form::select('id_genero', collect(['' => 'Seleccionar...'])->union($generos), old('id_genero'), [
                        'class' => 'form-select select2',
                        'id' => 'id_genero',
                    ]) !!}
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
                    <label for="nit_proveedor" class="form-label">Nit Proveedor<span class="text-danger">*</span></label>
                    {!! Form::text('nit_proveedor', old('nit_proveedor'), [
                        'class' => 'form-control',
                        'id' => 'nit_empresa',
                        // 'required' => 'required',
                        'pattern' => '^\d{5,10}$',
                        'minlength' => '7',
                        'maxlength' => '10',
                        'title' => 'Ingrese un NIT válido de 7 a 10 dígitos, sin guion ni dígito verificador',
                    ]) !!}
                </div>
            </div>

            {{-- ======================= --}}

            <div class="col-12 col-md-3">
                <div class="form-group d-flex flex-column">
                    <label for="proveedor_juridico" class="form-label">Nombre Proveedor
                        <span class="text-danger">*</span>
                    </label>
                    {!! Form::text('proveedor_juridico', old('proveedor_juridico'), [
                        'class' => 'form-control',
                        'id' => 'nombre_empresa',
                        // 'required' => 'required',
                        'pattern' => '^[a-zA-ZÁÉÍÓÚÑáéíóúñ0-9\s\.,&\-]{2,100}$',
                        'title' => 'El nombre puede incluir letras, números, espacios y algunos caracteres como ., - &',
                        'maxlength' => 100,
                    ]) !!}
                </div>
            </div>

            {{-- ======================= --}}

            <div class="col-12 col-md-3">
                <div class="form-group d-flex flex-column">
                    <label for="telefono_empresa" class="form-label">Teléfono Proveedor
                        <span class="text-danger">*</span>
                    </label>
                    {!! Form::text('telefono_juridico', old('telefono_juridico'), [
                        'class' => 'form-control',
                        'id' => 'telefono_empresa',
                        // 'required' => 'required',
                        'pattern' => '^\d{7,10}$',
                        'title' => 'Debe tener entre 7 y 10 dígitos.',
                        'minlength' => 7,
                        'maxlength' => 10,
                    ]) !!}
                </div>
            </div>
        </div>

        {{-- ========================================================= --}}
        {{-- ========================================================= --}}
        {{-- ========================================================= --}}
        {{-- ========================================================= --}}

        <!-- Contenedor para el GIF -->
        <div id="loadingIndicatorPersonaStore" class="loadingIndicator">
            <img src="{{ asset('imagenes/loading.gif') }}" alt="Procesando...">
        </div>

        {{-- ========================================================= --}}
        {{-- ========================================================= --}}

        <div class="mt-5 mb-2 d-flex justify-content-center">
            <button type="submit" class="btn btn-success rounded-2 ms-3">
                <i class="fa fa-floppy-o"></i>
                Guardar
            </button>
        </div>
    </div> {{-- FIN div_s --}}
</div> {{-- FIN div_ --}}
