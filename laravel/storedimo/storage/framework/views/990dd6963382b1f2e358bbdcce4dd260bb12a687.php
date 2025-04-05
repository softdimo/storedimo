
<?php $__env->startSection('title', 'Registrar Bajas'); ?>





<?php $__env->startSection('css'); ?>
    
<?php $__env->stopSection(); ?>





<?php $__env->startSection('content'); ?>
    <div class="d-flex p-0">
        <div class="p-0" style="width: 20%">
            <?php echo $__env->make('layouts.sidebarmenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        
        

        <div class="p-3" style="width: 80%">
            <div class="text-end">
                <a href="#" role="button" title="Ayuda" class="text-blue" data-bs-toggle="modal" data-bs-target="#modalAyudaRegistrarBajas">
                    <i class="fa fa-question-circle fa-2x" aria-hidden="false" title="Ayuda" style="color: #337AB7"></i>
                </a>
            </div>

            <div class="modal fade h-auto modal-gral p-3" id="modalAyudaRegistrarBajas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static" style="max-width: 55%;">
                <div class="modal-dialog m-0 mw-100">
                    <div class="modal-content border-0">
                        <div class="modal-body p-0 rounded-top" style="border: solid 1px #337AB7; mw-50">
                            <div class="row">
                                <div class="col-12">
                                    <div class="rounded-top text-white text-center p-2" style="background-color: #337AB7; border: solid 1px #337AB7;">
                                        <span class="modal-title fs-4"><strong>Ayuda de Registrar Bajas</strong></span>
                                    </div>
                                    
                                    <div class="p-3">
                                        <p class="text-justify">Tener en cuenta para el registro de la baja lo siguiente:</p>
    
                                        <ol>
                                            <li class="text-justify">Todos los campos que tienen el asterisco (*) son obligatorios, por lo tanto si no se diligencian el sistema no le dejará seguir.</li>
                                            <li class="text-justify">En el campo de producto, para una mayor agilidad se recomienda usar la pistola para leer el código del producto y así asociarlo mas fácil y rápido.</li>
                                            <li class="text-justify">En caso de que se haya equivocado en una cantidad o en un producto en el momento de agregar, con el icono de color rojo con forma de basurero, se puede quitar la selección inicial.</li>
                                        </ol>
                                    </div> 
                                </div> 
                            </div> 
                        </div> 
                        
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="button" class="btn btn-primary btn-md active pull-right" data-bs-dismiss="modal" style="background-color: #337AB7;">
                                    <i class="fa fa-check-circle" aria-hidden="true">&nbsp;Aceptar</i>
                                </button>
                            </div>
                        </div>
                    </div> 
                </div> 
            </div> 

            
            

            <div class="p-0" style="border: solid 1px #337AB7; border-radius: 5px;">
                <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0" style="background-color: #337AB7">Registar Bajas</h5>

                <?php echo Form::open(['method' => 'POST',
                    'route' => ['baja_store'],
                    'class' => '', 'autocomplete' => 'off',
                    'id' => 'formRegistrarBajas'
                    ]); ?>

                    <?php echo csrf_field(); ?>

                    <div class="d-flex flex-column flex-md-row justify-content-between p-3">
                        <div class="w-100-div w-48 mb-auto" style="border: solid 1px #337AB7; border-radius: 5px;">
                            <h5 class="border rounded-top text-white p-2" style="background-color: #337AB7">Información de la Baja</h5>

                            <div class="p-3 d-flex flex-column" id="form_bajas" style="height: 50%;">
                                <div>
                                    <label for="tipo_baja" class="form-label">Tipo de Baja <span class="text-danger">*</span></label>
                                    <?php echo e(Form::select('tipo_baja', collect(['' => 'Seleccionar...'])->union($tipos_baja), null, ['class' => 'form-select', 'id' => 'tipo_baja'])); ?>

                                </div>

                                <div class="mt-3">
                                    <label for="producto" class="form-label">Producto <span class="text-danger">*</span></label>
                                    <?php echo e(Form::select('producto', collect(['' => 'Seleccionar...'])->union($productos), null, ['class' => 'form-select', 'id' => 'producto'])); ?>

                                </div>

                                <div class="mt-3">
                                    <label for="cantidad" class="form-label">Cantidad <span class="text-danger">*</span></label>
                                    <?php echo Form::text('cantidad', null, ['class' => 'form-control', 'id' => 'cantidad']); ?>

                                </div>

                                <div class="d-flex justify-content-end mt-3">
                                    <button type="button" class="btn rounded-2 me-3 text-white" style="background-color: #337AB7" id="btn_add_baja">
                                        <i class="fa fa-plus plus"></i>
                                        Agregar
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="w-100-div w-48 mt-5 mt-md-0" style="border: solid 1px #337AB7; border-radius: 5px;">
                            <h5 class="border rounded-top text-white p-2 m-0" style="background-color: #337AB7">Verificación</h5>

                            <div class="table-responsive p-3 d-flex flex-column justify-content-between h-100" style="">
                                <table class="table table-striped table-bordered w-100 mb-0" id="tbl_bajas" aria-describedby="categorias">
                                    <thead>
                                        <tr class="header-table text-center">
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Tipo de Baja</th>
                                            <th>Opción</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                            <tr class="text-center"></tr>
                                    </tbody>
                                </table>
                                
                                <div id="loadingIndicatorRegistrarBajas" class="loadingIndicator">
                                    <img src="<?php echo e(asset('imagenes/loading.gif')); ?>" alt="Procesando...">
                                </div>

                                <div class="d-flex justify-content-end mb-5" style="">
                                    <button type="submit" class="btn btn-success rounded-2 me-3" id="guardarBajas">
                                        <i class="fa fa-floppy-o"></i>
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </div> 
                    </div> 
                <?php echo Form::close(); ?>

            </div> 
        </div>
    </div>
<?php $__env->stopSection(); ?>





<?php $__env->startSection('scripts'); ?>
    <script>
        $( document ).ready(function() {
            // INICIO - Función para agregar fila x fila cada producto para dar de baja
            $("#btn_add_baja").click(function() {

                let idtipoBaja = $('#tipo_baja').val();
                let tipoBaja = $('#tipo_baja option:selected').text();
                let idProducto = $('#producto').val();
                let producto = $('#producto option:selected').text();
                let cantidad = $('#cantidad').val();

                console.log(idtipoBaja);
                console.log(tipoBaja);
                console.log(idProducto);
                console.log(producto);
                console.log(cantidad);

                if (tipoBaja == '' || producto == '' || cantidad == '' ) {
                    Swal.fire(
                        'Cuidado!',
                        'Todos los campos son obligatorios!',
                        'error'
                    );
                } else {
                    var indiceSiguienteFila = $('#tbl_bajas tr').length;

                    // Crear una fila para la tabla
                    let fila = `
                        <tr class="" name="row_${indiceSiguienteFila}">
                            <td class="text-center">${producto}</td>
                            <td class="text-center">${cantidad}</td>
                            <td class="text-center">${tipoBaja}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger rounded-circle btn-delete-baja" data-id="${indiceSiguienteFila}" title="Eliminar" style="background-color:red;">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `;

                    $('#tbl_bajas').append(fila);

                    // Agregar inputs hidden dentro del formulario
                    let hiddenInputs = `
                        <div id="input_group_${indiceSiguienteFila}">
                            <input type="hidden" name="id_producto[]" value="${idProducto}">
                            <input type="hidden" name="cantidad_baja[]" value="${cantidad}">
                            <input type="hidden" name="id_tipo_baja[]" value="${idtipoBaja}">
                        </div>
                    `;

                    $("#formRegistrarBajas").append(hiddenInputs);

                    $('#tipo_baja').val('');
                    $('#producto').val('');
                    $('#cantidad').val('');
                }
            });
            // FIN - Función para agregar fila x fila cada producto para dar de baja

            // ===================================================================================
            // ===================================================================================

            // Capturar cualquier intento de envío del formulario y evitarlo si no es manual
            $("#formRegistrarBajas").on("submit", function(event) {
                // Si el submit no fue activado por el botón "Guardar", lo prevenimos
                if (!event.originalEvent || event.originalEvent.submitter.id !== "guardarBajas") {
                    console.log("Submit bloqueado porque no se hizo clic en 'Guardar'");
                    event.preventDefault();
                    return;
                }

                console.log("Formulario enviado correctamente");
            });

            $("#guardarBajas").click(function() {
                console.log("Clic en 'Guardar', enviando formulario...");
                $("#formRegistrarBajas").off("submit").submit(); // Forzar el envío del formulario
            });

            // Delegación de eventos para eliminar fila y evitar submit
            $(document).on('click', '.btn-delete-baja', function(event) {
                event.preventDefault(); // Evita el submit
                event.stopPropagation(); // Detiene propagación

                let idBaja = $(this).data('id'); // Obtiene el ID de la fila
                $(`tr[name="row_${idBaja}"]`).remove(); // Elimina la fila de la tabla
                $(`#input_group_${idBaja}`).remove(); // Elimina los inputs hidden
            });

            // ===================================================================================
            // ===================================================================================

            // formRegistrarBajas para cargar gif en el submit
            $(document).on("submit", "form[id^='formRegistrarBajas']", function(e) {
                const form = $(this);
                const submitButton = form.find('button[type="submit"]');
                const loadingIndicator = form.find("div[id^='loadingIndicatorRegistrarBajas']"); // Busca el GIF del form actual

                // Dessactivar Submit y Cancel
                submitButton.prop("disabled", true).html("Procesando... <i class='fa fa-spinner fa-spin'></i>");

                // Mostrar Spinner
                loadingIndicator.show();
            });

            // =========================================================================
            // =========================================================================
            // =========================================================================

        }); // FIN document.ready
    </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/existencias/create.blade.php ENDPATH**/ ?>