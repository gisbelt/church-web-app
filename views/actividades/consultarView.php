<?php
/**  @var $this \content\core\View */

$this->title = 'Actividades'
?>

<div class="container-fluid">
    <div class="row">
        <h1>Consultar actividades</h1>
    </div><!--row-->
</div><!--container-->
<!-- ********************************* -->

<script>
    function limpiar() {
        $("#form-registrarDonacion")[0].reset();
        $("#miembro").focus();
    }

    $(document).ready(function () {
        $("#miembro").focus();
    });
</script>
