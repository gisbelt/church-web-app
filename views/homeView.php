<?php

/**  @var $this \content\core\View */

use content\enums\permisos;

$this->title = 'Home'
?>
<!-- small boxes  -->
<section class="container-fluid"> 
    <div class="row small-boxes">
        <div class="col-lg-3 col-6"> <!-- 1 -->
            <div class="bg-first-color">
                <div class="p-3">
                    <h3><?php echo $amigos?></h3>
                    <p>Amigos Registrados</p>
                </div>
                <div class="icon">
                    <i class="bx bx-smile"></i>
                </div>
                <a href="/amigos" class="small-box-footer">Más info <i class="bx bxs-right-arrow-circle"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6"><!-- 2 -->
            <div class="bg-success">
                <div class="p-3">
                    <h3><?php echo $miembrosAct?></h3>
                    <p>Miembros Activos</p>
                </div>
                <div class="icon">
                    <i class="bx bx-group"></i>
                </div>
                <a href="/miembros" class="small-box-footer">Más info <i class="bx bxs-right-arrow-circle"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6"><!-- 3 -->
            <div class="bg-warning">
                <div class="p-3">
                    <h3><?php echo $miembrosPas?></h3>
                    <p>Miembros Pasivos</p>
                </div>
                <div class="icon">
                    <i class="bx bx-group"></i>
                </div>
                <a href="/miembros" class="small-box-footer">Más info <i class="bx bxs-right-arrow-circle"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6"><!-- 4 -->
            <div class="bg-danger">
                <div class="p-3">
                    <h3><?php echo $donaciones?></h3>
                    <p>Donaciones</p>
                </div>
                <div class="icon">
                    <i class="bx bx-donate-heart"></i>
                </div>
                <a href="/donaciones" class="small-box-footer">Más info <i class="bx bxs-right-arrow-circle"></i></a>
            </div>
        </div>        
    </div><!-- row -->
</section>
<!-- small boxes  -->

<!-- últimas acciones / Calendario -->
<section class="container-fluid">
    <div class="row">   
        <?php if (in_array(permisos::$bitacora, $_SESSION['user_permisos'])) { ?>
        <!-- acciones -->
        <div class="col-lg-8 col-12">             
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title mt-2">Últimas acciones</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-responsive table-bordered table-striped table-hover table-modal w-100" id="bitacora-last" data-route="/home/bitacora-last">
                    <thead class="thead-primary">
                        <tr>
                            <th class="w-auto">Módulo</th>
                            <th class="w-auto">Usuario</th>
                            <th class="w-auto">Fecha</th>
                        </tr>
                    </thead>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>    
        </div>
        <?php } ?>

        <!-- Calendar -->
        <div class="col-lg-4 col-12">            
            <div class="card bg-first-color mb-3">
              <div class="card-header">
                <h3 class="mt-2">
                  <i class="bi bi-calendar-week"></i> Calendario
                </h3>
              </div>
              <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" ></div>
              </div>
            </div>  <!-- /.card -->           
        </div>

        <!-- actividades -->
        <div class="col-lg-8 col-12">             
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title mt-2">Próximas Actividades</h3>
                </div>
                <div class="card-body">
                    <table class="table table-responsive table-bordered table-striped table-hover table-modal w-100" id="prox-actividades" data-route="/home/proximas-actividades">
                    <thead class="thead-primary">
                        <tr>
                            <th class="w-auto">Nombre</th>
                            <th class="w-auto">Descripción</th>
                            <th class="w-auto">Tipo</th>
                            <th class="w-auto">Fecha y Hora</th>
                        </tr>
                    </thead>
                    </table>
                </div>                
            </div> <!-- /.card -->
        </div>
        
        <!-- Accesos rápidos  -->
        <div class="col-lg-3 col-12">            
            <div class="card bg-secondary mb-3">
                <div class="card-header">
                    <h3 class="mt-2">Accesos Rápidos</h3>
                </div>
                <div class="card-body">
                    <?php
                        if (in_array(permisos::$actualizar_actividades, $_SESSION['user_permisos'])) {
                            echo '<a class="btn btn-primary btn-lg w-100 mb-2" href="/usuarios/create" role="button" data-title="registrar usuario">Registrar Usuarios</a>';
                        }
                        if (in_array(permisos::$actualizar_actividades, $_SESSION['user_permisos'])) {
                            echo ' <a class="btn btn-info btn-lg w-100 mb-2" href="/usuarios" role="button" data-title="listado usuarios">Listado de Usuarios</a>';
                        }
                        if (in_array(permisos::$actualizar_actividades, $_SESSION['user_permisos'])) {
                            echo '<a class="btn btn-primary  btn-lg w-100 mb-2" href="/miembros/create" role="button" data-title="registrar miembro">Registrar Miembros</a>';
                        }
                        if (in_array(permisos::$actualizar_actividades, $_SESSION['user_permisos'])) {
                            echo ' <a class="btn btn-info btn-lg w-100 mb-2" href="/miembros" role="button" data-title="listado miembros">Listado de Miembros</a>';
                        }
                    ?>
                </div>
            </div><!-- /.card -->            
        </div>
    </div>
</section>
<!-- últimas acciones  -->
<br><br>

