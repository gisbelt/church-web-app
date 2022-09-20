<?php

/**  @var $this \content\core\View */

$this->title = 'Reportes'
?>
<div class="container">
<h3 class="text-center mb-4">Reportes</h3>
<div class="row">
    <div class="col-md-12">
        <!-- 1 -->
        <section class="report">
            <div class="report-header">
                <h4 class="">Donaciones</h4>
                <div class="derecha">
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="collapse" data-bs-target="#report1" aria-expanded="false" aria-controls="collapseExample">Expandir</button>
                </div>                
                <p>Estadísticas</p>
            </div>
            <!-- put view here  -->
            <div class="report-content collapse" id="report1">
                <div class="card bg-transparent">
                    <div class="card-header bg-first-color">
                        <h5 class="card-title text-white m-0">Donaciones recibidas por mes</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </section>
       
        <!-- 2 -->
        <section class="report">
            <div class="report-header">
                <h4 class="">Reporte 2</h4>
                <div class="derecha">
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="collapse" data-bs-target="#report2">Expandir</button>
                </div>                
                <p>Set the default branch for this project. All merge requests and commits are made against this branch unless you specify a different one.</p>
            </div>
            <!-- put view here  -->
            <div class="report-content collapse" id="report2"><p>hola</p></div>
        </section>
       
        <!-- 3 -->
        <section class="report">
            <div class="report-header">
                <h4 class="">Reporte 3</h4>
                <div class="derecha">
                    <button type="button" class="btn btn-outline-success">Expandir</button>
                </div>                
                <p>Set the default branch for this project. All merge requests and commits are made against this branch unless you specify a different one.</p>
            </div>
            <!-- put view here  -->
            <div class="report-content"></div>
        </section>
       
        <!-- 4 -->
        <section class="report">
            <div class="report-header">
                <h4 class="">Reporte 4</h4>
                <div class="derecha">
                    <button type="button" class="btn btn-outline-success">Expandir</button>
                </div>                
                <p>Set the default branch for this project. All merge requests and commits are made against this branch unless you specify a different one.</p>
            </div>
            <!-- put view here  -->
            <div class="report-content"></div>
        </section>         
    </div>            
</div>
</div> <!--container-->
