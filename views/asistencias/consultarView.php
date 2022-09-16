<?php
/**  @var $this \content\core\View */

$this->title = 'Asistencias'
?>

<div class="container-fluid">
    <div class="row">
        <h1>Consultar asistencias</h1>
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
