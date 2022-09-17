<?php
/** @var $exception \Exception */
$this->title = 'Error 403'
?>
<div class="p-5 bg-light text-center error_500">
    <div class="container">
        <h1 class="display-3">Sistema en mantenimiento</h1>
        <hr class="my-2">
        <p>Por favor sea paciente</p>
        <p class="lead">
        <h1 class="bi bi-emoji-frown"></h1>
         <h3><?php echo $exception->getCode() ?> - <?php echo $exception->getMessage() ?> </h3>
        </p>
    </div>
</div>