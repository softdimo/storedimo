<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <title><?php echo $__env->yieldContent('title'); ?></title>
        <?php echo $__env->yieldContent('css'); ?>

        
        <link rel="shortcut icon" href="<?php echo e(asset('imagenes/favicon.png')); ?>" type="image/x-icon">

        
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.css" />

        <!-- Bootstrap CSS 5.3.2 -->
        <link rel="stylesheet" href="<?php echo e(asset('bootstrap/bootstrap.5.3.2.min.css')); ?>" >

        <!-- SELECT2 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
        

        

        <!-- Styles -->
        <link rel="stylesheet" href="<?php echo e(asset('font-awesome-4.5.0/css/font-awesome.min.css')); ?>"> 
        <link rel="stylesheet" href="<?php echo e(asset('css/custom.css')); ?>">


        

        
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/sweetalert2.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/sweetalert2.min.css')); ?>">

        <!--  Js -->
        <script src="<?php echo e(asset('js/jquery-3.6.0.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/jquery-1.19.1.validate.min.js')); ?>"></script>
    </head>

    
    

    <body>
        <div class="">
            <?php if(
                Request()->path() == '/' ||
                Request()->path() == 'login' ||
                Request()->path() == 'logout' ||
                Request()->path() == 'recuperar_clave' ||
                Request()->is('recuperar_clave_link*')
            ): ?>
                <?php echo $__env->make('layouts.topbar_login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php else: ?>
                <?php echo $__env->make('layouts.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>

            
        </div>

        
        

        <?php echo $__env->yieldContent('scripts'); ?>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>

        <!-- Bootstrap Bundle JS 5.3.2 -->
        <script src="<?php echo e(asset('bootstrap/bootstrap5.3.2.bundle.min.js')); ?>"></script>

        

        <!-- SELECT2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
        

        

        
        <script src="<?php echo e(asset('js/sweetalert2.all.js')); ?>"></script>
        <script src="<?php echo e(asset('js/sweetalert2.min.js')); ?>"></script>
        
        <!-- SCRIPTS -->
        <?php echo $__env->make('sweetalert::alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </body>
</html>
<?php /**PATH /var/www/html/resources/views/layouts/app.blade.php ENDPATH**/ ?>