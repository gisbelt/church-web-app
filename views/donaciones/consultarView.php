<?php
/**  @var $this \content\core\View */

$this->title = 'Donaciones'
?>

<div class="container-fluid">
    <div class="row">
        <h1>Consultar donaciones</h1>
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
