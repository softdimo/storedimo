<div class="p-0" style="border: solid 1px #337AB7; border-radius: 5px 5px 0 0;">
    <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0" style="background-color: #337AB7">Registrar
        Empresas (Obligatorios * )</h5>

    <div class="m-0 p-3" id="div_campos_empresas">
        <div class="row">
            <div class="col-12 col-md-3">
                <div class="form-group d-flex flex-column">
                    <label for="nit_empresa" class="form-label">Nit Empresa<span class="text-danger">*</span></label>
                    {!! Form::text('nit_empresa', old('nit_empresa'), [
                        'class' => 'form-control',
                        'id' => 'nit_empresa',
                        'required' => 'required',
                        'pattern' => '^\d{5,10}$',
                        'title' => 'Ingrese un NIT válido de 5 a 10 dígitos, sin guion ni dígito verificador',
                    ]) !!}
                </div>
            </div>

            {{-- ======================= --}}

            <div class="col-12 col-md-3">
                <div class="form-group d-flex flex-column">
                    <label for="nombre_empresa" class="form-label">Nombre Empresa<span
                            class="text-danger">*</span></label>
                    {!! Form::text('nombre_empresa', old('nombre_empresa'), [
                        'class' => 'form-control',
                        'id' => 'nombre_empresa',
                        'required' => 'required',
                        'pattern' => '^[a-zA-ZÁÉÍÓÚÑáéíóúñ0-9\s\.,&\-]{2,100}$',
                        'title' => 'El nombre puede incluir letras, números, espacios y algunos caracteres como ., - &',
                        'maxlength' => 100,
                    ]) !!}
                </div>
            </div>

            {{-- ======================= --}}

            <div class="col-12 col-md-3">
                <div class="form-group d-flex flex-column">
                    <label for="telefono_empresa" class="form-label">Teléfono Empresa<span
                            class="text-danger">*</span></label>
                    {!! Form::text('telefono_empresa', old('telefono_empresa'), [
                        'class' => 'form-control',
                        'id' => 'telefono_empresa',
                        'required' => 'required',
                        'pattern' => '^\d{7,10}$',
                        'title' => 'Debe tener entre 7 y 10 dígitos.',
                        'maxlength' => 10,
                        'minlength' => 7,
                    ]) !!}
                </div>
            </div>

            {{-- ======================= --}}

            <div class="col-12 col-md-3" id="div_celular">
                <div class="form-group d-flex flex-column">
                    <label for="celular_empresa" class="form-label">Número de Celular <span
                            class="text-danger">*</span></label>
                    {!! Form::text('celular_empresa', old('celular_empresa'), [
                        'class' => 'form-control',
                        'id' => 'celular_empresa',
                        'required' => 'required',
                        'pattern' => '^\d{7,15}$',
                        'title' => 'Debe ser un número de celular válido, sin indicativos, entre 7 y 15 dígitos.',
                        'maxlength' => 15,
                        'minlength' => 7,
                    ]) !!}
                </div>
            </div>

            {{-- ======================= --}}

            <div class="col-12 col-md-3 mt-3" id="div_email">
                <div class="form-group d-flex flex-column">
                    <label for="email_empresa" class="form-label">Correo Electrónico <span
                            class="text-danger">*</span></label>
                    {!! Form::email('email_empresa', old('email_empresa'), [
                        'class' => 'form-control', 
                        'id' => 'email_empresa',
                        'required' => 'required',
                        'pattern' => '^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$',
                        'title' => 'Por favor, ingresa un correo electrónico válido',
                    ]) !!}
                </div>
            </div>

            {{-- ======================= --}}

            <div class="col-12 col-md-3 mt-3" id="div_direccion">
                <div class="form-group d-flex flex-column">
                    <label for="direccion_empresa" class="form-label">Dirección</label>
                    {!! Form::text('direccion_empresa', old('direccion_empresa'), [
                        'class' => 'form-control',
                        'id' => 'direccion_empresa',
                        'pattern' => '^[a-zA-Z0-9\s\#\-\.\,\/]{5,100}$',
                        'title' => 'Ingrese una dirección válida (solo letras, números y caracteres como # - . , /). Mínimo 5 y máximo 100                                                  caracteres.',
                        'maxlength' => 100,
                        'minlength' => 5,
                    ]) !!}
                </div>
            </div>

            {{-- ======================= --}}

            <div class="col-12 col-md-3 mt-3" id="div_direccion">
                <div class="form-group d-flex flex-column">
                    <label for="id_estado" class="form-label">Estado</label>
                    {!! Form::select('id_estado', collect(['' => 'Seleccionar...'])->union($estados), 1, [
                        'class' => 'form-select select2',
                        'id' => 'id_estado',
                    ]) !!}
                </div>
            </div>
        </div>

    </div> {{-- FIN div_campos_usuarios --}}
</div> {{-- FIN div_crear_usuario --}}
