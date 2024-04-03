<div class="p-0" style="border: solid 1px #337AB7; border-radius: 5px 5px 0 0;">
    <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0" style="background-color: #337AB7">Registrar Productos (Obligatorios * )</h5>

    <div class="row m-0 p-3" id="div_campos_usuarios">
        <div class="col-12 col-md-3">
            <div class="form-group d-flex flex-column">
                <label for="nombre_producto" class="form-label">Nombre Producto <span class="text-danger">*</span></label>
                {!! Form::text('nombre_producto', null, ['class' => 'form-control', 'id' => 'nombre_producto']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3">
            <div class="form-group d-flex flex-column">
                <label for="categoria" class="form-label">Categoría <span class="text-danger">*</span></label>
                {!! Form::select('categoria', collect(['' => 'Seleccionar...'])->union(['1' => 'Hogar','2' => 'Papelería','3' => 'Aseo',]), null, ['class' => 'form-control', 'id' => 'categoria']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3">
            <div class="form-group d-flex flex-column">
                <label for="precio unitario" class="form-label">Precio Unitario <span class="text-danger">*</span></label>
                {!! Form::number('precio unitario', null, ['class' => 'form-control', 'id' => 'precio unitario', 'min' => 0, 'step' => 10, 'oninput' => 'validity.valid||(value=\'\');']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3">
            <div class="form-group d-flex flex-column">
                <label for="precio_detal" class="form-label">Precio al Detal <span class="text-danger">*</span></label>
                {!! Form::number('precio_detal', null, ['class' => 'form-control', 'id' => 'precio_detal', 'min' => 0, 'step' => 10, 'oninput' => 'validity.valid||(value=\'\');']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3 mt-3">
            <div class="form-group d-flex flex-column">
                <label for="precio_por_mayor" class="form-label">Precio al por Mayor <span class="text-danger">*</span></label>
                {!! Form::number('precio_por_mayor', null, ['class' => 'form-control', 'id' => 'precio_por_mayor', 'min' => 0, 'step' => 10, 'oninput' => 'validity.valid||(value=\'\');']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        
        <div class="col-12 col-md-3 mt-3">
            <div class="form-group d-flex flex-column">
                <label for="descripcion" class="form-label">Descripción</label>
                {!! Form::text('descripcion', null, ['class' => 'form-control', 'id' => 'descripcion']) !!}
            </div>
        </div>

        {{-- ======================= --}}
        
        <div class="col-12 col-md-3 mt-3" id="">
            <div class="form-group d-flex flex-column">
                <label for="stock_minimo" class="form-label">Stock Mínimo <span class="text-danger">*</span></label>
                {!! Form::number('stock_minimo', null, ['class' => 'form-control', 'id' => 'stock_minimo', 'min' => 1, 'max' => 50, 'oninput' => 'validity.valid||(value=\'\');']) !!}
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
    </div> {{-- FIN div_campos_productos --}}
</div> {{-- FIN div_crear_productos --}}
