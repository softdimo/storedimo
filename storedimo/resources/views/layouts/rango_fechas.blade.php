<div class="col-md-3">
    <div class="form-group">
        <input type="text" name="filtro[{{$data->informe_codigo}}]"
                id="{{str_slug($data->informe_descripcion, '_')}}_{{$data->informe_codigo}}_date"
                class="form-control rango_fecha" autocomplete="off">
        <span class="bar"></span>
        <label for="{{str_slug($data->informe_descripcion, '_')}}_{{$data->informe_codigo}}_date">{{$data->informe_descripcion}} Inicial - Final</label>
    </div>
</div>
