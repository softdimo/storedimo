<div class="col-md-3">
    <div class="form-group m-b-40">
        <label for="{{$name}}_select">{{$data->informe_descripcion}}</label>
        <select name="filtro[{{$data->informe_codigo}}]" id="{{$name}}_select" class="form-control select">
            @if($opciones->count() > 1)
                    @forelse($opciones as $opcion)
                        <option value="{{$opcion['key']}}">{{$opcion['value']}}</option>
                    @empty

                    @endforelse
                @else
                {!! nl2br($opciones->get('opcion')) !!}
            @endif
        </select>
    </div>
</div>
