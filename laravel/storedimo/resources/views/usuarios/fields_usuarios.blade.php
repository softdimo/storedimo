<div class="p-0" style="border: solid 1px #337AB7; border-radius: 5px 5px 0 0;">
    <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0" style="background-color: #337AB7">Registrar Usuarios (Obligatorios * )</h5>

    <div class="row m-0 p-3" id="div_campos_usuarios">
        {!! Form::hidden('id_usuario', isset($usuario) ? $usuario->id_usuario : null, ['class' => '', 'id' => 'id_usuario']) !!}

        <div class="col-12 col-md-3">
            <div class="form-group d-flex flex-column">
                <label for="nombre_usuario" class="form-label">Nombres <span class="text-danger">*</span></label>
                {!! Form::text('nombre_usuario',  isset($usuario) ? $usuario->nombre_usuario : null, ['class' => 'form-control', 'id' => 'nombre_usuario']) !!}
            </div>
        </div>

        {{-- ======================= --}}

        <div class="col-12 col-md-3">
            <div class="form-group d-flex flex-column">
                <label for="apellido_usuario" class="form-label">Apellidos <span class="text-danger">*</span></label>
                {!! Form::text('apellido_usuario', isset($usuario) ? $usuario->apellido_usuario : null, ['class' => 'form-control', 'id' => 'apellido_usuario']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        
        <div class="col-12 col-md-3">
            <div class="form-group d-flex flex-column">
                <label for="identificacion" class="form-label">Número de documento <span class="text-danger">*</span></label>
                {!! Form::text('identificacion',  isset($usuario) ? $usuario->identificacion : null, ['class' => 'form-control', 'id' => 'identificacion']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3" id="">
            <div class="form-group d-flex flex-column">
                <label for="email" class="form-label">Correo Electrónico <span class="text-danger">*</span></label>
                {!! Form::text('email', isset($usuario) ? $usuario->email : null, ['class' => 'form-control', 'id' => 'email']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3 mt-3">
            <div class="form-group d-flex flex-column">
                <label for="id_rol" class="form-label">Rol<span class="text-danger">*</span></label>
                {!! Form::select('id_rol', collect(['' => 'Seleccionar...'])->union($roles), isset($usuario) ? $usuario->id_rol : null, ['class' => 'form-control', 'id' => 'id_rol']) !!}
            </div>
        </div>

        {{-- ======================= --}}


        <div class="col-12 col-md-3 mt-3">
            <div class="form-group d-flex flex-column">
                <label for="id_estado" class="form-label">Estado<span class="text-danger">*</span></label>
                {!! Form::select('id_estado', collect(['' => 'Seleccionar...'])->union($estados), isset($usuario) ? $usuario->id_estado : 1, ['class' => 'form-control', 'id' => 'id_estado']) !!}
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
            </button>

            <button class="btn btn-danger rounded-2" type="submit">
                <i class="fa fa-remove"></i>
                Cancelar
            </button>
        </div>
    </div> {{-- FIN div_campos_usuarios --}}
</div> {{-- FIN div_crear_usuario --}}
