<?php
/**  @var $this \content\core\View */

$this->title = 'Registrar Actividades'
?>
<div class="container-fluid">
    <div class="row center">
        <div class="col-md-6">
            <?php require_once "./../views/actividades/registrarElement.php"; ?>
        </div> <!--col-md-12-->
    </div><!--row-->
</div><!--container-->

<script>
    function limpiar() {
        $("#form-registrarActividades")[0].reset();
    }
</script>