{!! Form::open([
    'method' => 'PUT',
    'route' => ['empresas.update', $empresa->id_empresa],
    'class' => 'mt-0',
    'autocomplete' => 'off',
    'id' => 'formEditarEmpresa_'.$empresa->id_empresa,
    ]) !!}
    @csrf

    {!! Form::hidden('id_empresa', isset($empresa) ? $empresa->id_empresa : null, ['class' => '', 'id' => 'id_empresa', 'required']) !!}

    <div class="rounded-top" style="border: solid 1px #337AB7;">
        <div class="rounded-top text-white text-center" style="background-color: #337AB7; border: solid 1px #337AB7;">
            <h5>Editar Empresa: {{$empresa->nombre_empresa}}</h5>
        </div>

        <div class="modal-body m-0">
            <div class="row m-0">
                <div class="col-12 col-md-6">
                    <label for="nit_empresa" class="fw-bold" style="font-size: 12px">Nit Empresa
                        <span class="text-danger">*</span>
                    </label>
                    {!! Form::text('nit_empresa', isset($empresa) ? $empresa->nit_empresa : null, ['class' => 'form-control', 'id' => 'nit_empresa', 'required']) !!}
                </div>

                <div class="col-12 col-md-6">
                    <label for="nombre_empresa" class="fw-bold" style="font-size: 12px">Nombre Empresa
                        <span class="text-danger">*</span>
                    </label>
                    {!! Form::text('nombre_empresa', isset($empresa) ? $empresa->nombre_empresa : null, ['class' => 'form-control', 'id' => 'nombre_empresa', 'required']) !!}
                </div>

                <div class="col-12 col-md-6 mt-3">
                    <label for="telefono_empresa" class="fw-bold" style="font-size: 12px">Teléfono Empresa
                        <span class="text-danger">*</span>
                    </label>
                    {!! Form::text('telefono_empresa', isset($empresa) ? $empresa->telefono_empresa : null, ['class' => 'form-control', 'id' => 'telefono_empresa', 'required']) !!}
                </div>

                <div class="col-12 col-md-6 mt-3">
                    <label for="celular_empresa" class="fw-bold" style="font-size: 12px">Celular Empresa
                        <span class="text-danger">*</span>
                    </label>
                    {!! Form::text('celular_empresa', isset($empresa) ? $empresa->celular_empresa : null, ['class' => 'form-control', 'id' => 'celular_empresa', 'required']) !!}
                </div>

                <div class="col-12 col-md-6 mt-3">
                    <label for="email_empresa" class="fw-bold" style="font-size: 12px">Email
                        <span class="text-danger">*</span>
                    </label>
                    {!! Form::email('email_empresa', isset($empresa) ? $empresa->email_empresa : null, ['class' => 'form-control', 'id' => 'email_empresa']) !!}
                </div>

                {{-- ======================= --}}
                
                <div class="col-12 col-md-6 mt-3">
                    <label for="id_estado" class="fw-bold" style="font-size: 12px">Estado
                        <span class="text-danger">*</span>
                    </label>
                    {!! Form::select('id_estado', collect(['' => 'Seleccionar...'])->union($estados), isset($empresa) ? $empresa->id_estado : null, ['class' => 'form-select select2', 'id' => 'id_estado']) !!}
                </div>
    
                {{-- ======================= --}}
                
                <div class="col-12 col-md-6 mt-3">
                    <label for="direccion_empresa" class="fw-bold" style="font-size: 12px">Dirección
                        <span class="text-danger">*</span>
                    </label>
                    {!! Form::text('direccion_empresa', isset($empresa) ? $empresa->direccion_empresa : null, ['class' => 'form-control', 'id' => 'direccion_empresa']) !!}
                </div>
                
            </div>
        </div> <!-- FIN modal-body -->
    </div> <!-- FIN rounded-top -->

    {{-- ====================================================== --}}
    {{-- ====================================================== --}}

    <!-- Contenedor para el GIF -->
    <div id="loadingIndicatorEditarEmpresa_{{$empresa->id_empresa}}" class="loadingIndicator">
        <img src="{{ asset('imagenes/loading.gif') }}" alt="Procesando...">
    </div>

    {{-- ====================================================== --}}
    {{-- ====================================================== --}}

    <div class="d-flex border-0 justify-content-center mt-2">
        <div class="">
            <button type="submit" class="btn btn-success me-3" id="btn_editar_empresa_{{$empresa->id_empresa}}">
                <i class="fa fa-floppy-o"> Editar</i>
            </button>
        </div>

        <div class="">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="btn_cancelar_empresa_{{$empresa->id_empresa}}">
                <i class="fa fa-remove">  Cancelar</i>
            </button>
        </div>
    </div>
{!! Form::close() !!}
