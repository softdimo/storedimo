<!-- Modal Crear Categoría -->
<div class="modal fade" id="modal_crear_umd" tabindex="-1" aria-labelledby="modalCrearUMDLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #337AB7">
                    <h5 class="modal-title" id="modalCrearUMDLabel">Crear Nueva Unidad De Medida</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formCrearUmd" method="POST" action="{{ route('umd') }}">
                        @csrf
                        <div class="p-3 d-flex flex-column">
                            <div>
                                <label for="umd">Unidad de Medida<span class="text-danger"> *</span></label>
                                <input type="text" name="umd" id="umd" class="form-control" required
                                    minlength="3" maxlength="100" pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s'-]{3,100}$"
                                    title="Debe contener solo letras, espacios, guiones o apóstrofes (mínimo 3 caracteres)"
                                    placeholder="Ingrese Unidad de Medida">
                            </div>

                            <div class="mt-3">
                                <label for="abreviatura_umd">Abreviatura Unidad de Medida<span class="text-danger"> *</span></label>
                                <input type="text" name="abreviatura_umd" id="abreviatura_umd" class="form-control" required
                                    minlength="3" maxlength="100" pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s'-]{3,100}$"
                                    title="Debe contener solo letras, espacios, guiones o apóstrofes (mínimo 3 caracteres)"
                                    placeholder="Ingrese Abreviatura Unidad de Medida">
                            </div>

                            <!-- Contenedor para el GIF -->
                            <div id="loadingIndicatorCrearUmd" class="loadingIndicator" style="display: none;">
                                <img src="{{ asset('imagenes/loading.gif') }}" alt="Procesando...">
                            </div>

                            <div class="d-flex justify-content-center mt-3">
                                <button type="submit" class="btn btn-success rounded-2 me-3">
                                    <i class="fa fa-floppy-o"></i>
                                    Guardar
                                </button>
                                {{-- <button type="button" class="btn btn-danger rounded-2" data-bs-dismiss="modal">
                                    <i class="fa fa-remove"></i>
                                    Cancelar
                                </button> --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Modal Crear Categoría -->