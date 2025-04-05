
<?php $__env->startSection('title', 'Recovery Password'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
    <form class="border border-dark-subtle p-5 shadow-lg rounded-4 bg-white text-center" method="post" action="<?php echo e(route('recuperar_clave_email')); ?>" autocomplete="off">
        <?php echo csrf_field(); ?>
        <h3 class="mb-4 fw-bold text-primary">Recuperar Clave</h3>

        <div class="mb-4">
            <input class="w-100 form-control p-3" type="email" name="email" id="email" placeholder="Email" required>
        </div>

        <div class="mb-4">
            <input class="w-100 form-control p-3" type="text" name="identificacion" id="identificacion" placeholder="Identificación" required>
        </div>

        <div class="mt-4 d-flex flex-column gap-3">
            <button class="btn btn-primary btn-lg w-100" type="submit">Enviar Correo</button>
            <a class="btn btn-outline-primary btn-lg w-100" href="<?php echo e(route('login')); ?>">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Volver al Login
            </a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        $( document ).ready(function() {
            $("#email").trigger('focus');
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/inicio_sesion/recuperar_clave.blade.php ENDPATH**/ ?>