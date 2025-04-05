
<?php $__env->startSection('title', 'Crear Usuarios'); ?>





<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>





<?php $__env->startSection('content'); ?>
    <div class="d-flex p-0">
        <div class="p-0" style="width: 20%">
            <?php echo $__env->make('layouts.sidebarmenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        
        

        <div class="p-3" style="width: 80%">
            <div class="d-flex justify-content-between pe-3 mt-3">
                <div class="">
                    <a href="<?php echo e(route('usuarios.index')); ?>" class="btn text-white" style="background-color:#337AB7">Usuarios</a>
                </div>

                <div class="text-end">
                    <a href="#" role="button" title="Ayuda" class="text-blue" data-bs-toggle="modal" data-bs-target="#modalAyudaCrearUsuarios">
                        <i class="fa fa-question-circle fa-2x" aria-hidden="false" title="Ayuda" style="color: #337AB7"></i>
                    </a>
                </div>
            </div>

            
            
            
            <div class="modal fade h-auto modal-gral p-3" id="modalAyudaCrearUsuarios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-keyboard ="false" data-backdrop = "static" style="max-width: 55%;">
                <div class="modal-dialog m-0 mw-100">
                    <div class="modal-content border-0">
                        <div class="modal-body p-0 rounded-top" style="border: solid 1px #337AB7; mw-50">
                            <div class="row">
                                <div class="col-12">
                                    <div class="rounded-top text-white text-center p-2" style="background-color: #337AB7; border: solid 1px #337AB7;">
                                        <span class="modal-title fs-5"><strong>Ayuda Registrar Usuarios</strong></span>
                                    </div>
                                    
                                    <div class="p-3">
                                        <p class="text-justify">Señor usuario a la hora de realizar un registro tener en cuenta las siguientes recomendaciones:</p>

                                        <ol>
                                            <li class="text-justify">Todos los campos que poseen el asterisco (*) son obligatorios, por lo tanto sino se diligencian, el sistema no le dejará seguir.</li>
                                            <li class="text-justify">El campo número de documento, su logitud debe ser mayor a los 7 caracteres.</li>
                                            <li class="text-justify">En el momento del registro no se debe ingresar un número de documento ya existente en la base de datos.</li>
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

            
            

            <?php echo Form::open(['method' => 'POST', 'route' => ['usuarios.store'], 'class' => 'mt-2', 'autocomplete' => 'off', 'id' => 'formCrearUsuarios']); ?>

                <?php echo csrf_field(); ?>
            
                <?php echo $__env->make('usuarios.fields_usuarios', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                
                

                <!-- Contenedor para el GIF -->
                <div id="loadingIndicatorStore" class="loadingIndicator">
                    <img src="<?php echo e(asset('imagenes/loading.gif')); ?>" alt="Procesando...">
                </div>

                
                

                <div class="mt-4 mb-0 d-flex justify-content-center">
                    <button type="submit" class="btn btn-success rounded-2 me-3">
                        <i class="fa fa-floppy-o"></i>
                        Guardar
                    </button>

                    <button type="button" class="btn btn-danger rounded-2">
                        <i class="fa fa-remove"></i>
                        Cancelar
                    </button>
                </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>





<?php $__env->startSection('scripts'); ?>
    <script>
        $( document ).ready(function() {
            let idEstado = $('#id_estado').val();
            console.log(idEstado);

            if (idEstado == 1 || idEstado == '') {
                $('#div_fecha_terminacion_contrato').hide();
                $('#fecha_terminacion_contrato').removeAttr('required');
            }

            $('#id_estado').change(function () {
                let idEstado = $('#id_estado').val();
                console.log(idEstado);

                if (idEstado == 1) { // Activo
                    $('#div_fecha_terminacion_contrato').hide();
                    $('#fecha_terminacion_contrato').removeAttr('required');
                } else if (idEstado == 2) { // Inactivo
                    $('#div_fecha_terminacion_contrato').show('slow');
                    $('#fecha_terminacion_contrato').attr('required');
                } else { // Seleccionar...
                    $('#div_fecha_terminacion_contrato').hide();
                    $('#fecha_terminacion_contrato').removeAttr('required');
                }
            });

            // ===================================================================================
            // ===================================================================================

            // formCrearUsuario para cargar gif en el submit
            $("form").on("submit", function (e) {
                const form = $(this);
                const submitButton = form.find('button[type="submit"]');
                const cancelButton = form.find('button[type="button"]');
                const loadingIndicator = form.find("div[id^='loadingIndicatorStore']"); // Busca el GIF del form actual

                // Dessactivar Botones
                submitButton.prop("disabled", true).html("Procesando... <i class='fa fa-spinner fa-spin'></i>");
                cancelButton.prop("disabled", true);
                
                // Mostrar Spinner
                loadingIndicator.show();
            });
        }); // FIN document.readey
    </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/usuarios/create.blade.php ENDPATH**/ ?>