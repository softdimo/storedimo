
<?php $__env->startSection('title', 'Productos stock Mínimo'); ?>





<?php $__env->startSection('css'); ?>
    
    <style>
        .btn-circle {
            padding-left: 0.3rem !important;
            padding-right: 0.3rem !important;
            padding-top: 0.0rem !important;
            padding-bottom: 0.0rem !important;
        }
    </style>
<?php $__env->stopSection(); ?>





<?php $__env->startSection('content'); ?>
    <div class="d-flex p-0">
        <div class="p-0" style="width: 20%">
            <?php echo $__env->make('layouts.sidebarmenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        
        

        <div class="p-3 d-flex flex-column" style="width: 80%">
            <div class="p-0" style="border: solid 1px #337AB7; border-radius: 5px;">
                <h5 class="border rounded-top text-white text-center pt-2 pb-2 m-0" style="background-color: #337AB7">Productos en Stock Mínimo</h5>
            
                <div class="col-12 p-3" id="">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered w-100 mb-0" id="tbl_stock_minimo" aria-describedby="stock_minimo">
                            <thead>
                                <tr class="header-table text-center">
                                    <th>Código</th>
                                    <th>Nombre Producto</th>
                                    <th>Categoría</th>
                                    <th>Descripción</th>
                                    <th>Cantidad</th>
                                    <th>Stock Mínimo</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php $__currentLoopData = $stockMinimoIndex; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stockMinimo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="text-center">
                                        <td><?php echo e($stockMinimo->id_producto); ?></td>
                                        <td><?php echo e($stockMinimo->nombre_producto); ?></td>
                                        <td><?php echo e($stockMinimo->categoria); ?></td>
                                        <td><?php echo e($stockMinimo->descripcion); ?></td>
                                        <td><?php echo e($stockMinimo->cantidad); ?></td>
                                        <td><?php echo e($stockMinimo->stock_minimo); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="d-flex justify-content-center mt-3 mb-3">
                    <button class="btn btn-success generar-pdf" style="background-color: #337AB7">
                        <i class="fa fa-file-pdf-o"></i> Reporte stock Mínimo
                    </button>
                </div>
            </div> 
        </div>
    </div>
<?php $__env->stopSection(); ?>





<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('DataTables/datatables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('DataTables/Buttons-2.3.4/js/buttons.html5.min.js')); ?>"></script>

    <script>
        $( document ).ready(function() {
            // INICIO DataTable stock Mínimo
            $("#tbl_stock_minimo").DataTable({
                dom: 'Blfrtip',
                "infoEmpty": "No hay registros",
                stripe: true,
                "bSort": false,
                "buttons": [
                    {
                        extend: 'copyHtml5',
                        text: 'Copiar',
                        className: 'waves-effect waves-light btn-rounded btn-sm btn-primary',
                        init: function(api, node, config) {
                            $(node).removeClass('dt-button')
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Excel',
                        className: 'waves-effect waves-light btn-rounded btn-sm btn-primary mr-3',
                        customize: function( xlsx ) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
                            $('row:first c', sheet).attr( 's', '42' );
                        }
                    }
                ],
                "pageLength": 10,
                "scrollX": true,
            });
            // CIERRE DataTable stock Mínimo

            // =========================================================================
            // =========================================================================
            // =========================================================================

            document.querySelector(".generar-pdf").addEventListener("click", function () {
                let productos = [];

                document.querySelectorAll("#tbl_stock_minimo tbody tr").forEach(row => {
                    let producto = {
                        id: row.cells[0].textContent,
                        producto: row.cells[1].textContent,
                        categoria: row.cells[2].textContent,
                        descripcion: row.cells[3].textContent,
                        cantidad: row.cells[4].textContent,
                        stock_minimo: row.cells[5].textContent
                    };
                    productos.push(producto);
                });

                fetch("/stock_minimo_pdf", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                    },
                    body: JSON.stringify({ productos }) // Enviamos un array de productos
                })
                .then(response => response.blob())
                .then(blob => {
                    let url = window.URL.createObjectURL(blob);
                    window.open(url, "_blank");
                })
                .catch(error => console.error("Error al generar PDF:", error));
            });
        }); // FIN document.ready
    </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/existencias/stock_minimo.blade.php ENDPATH**/ ?>