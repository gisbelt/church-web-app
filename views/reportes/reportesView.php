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
                <h4 class="">Miembros</h4>
                <div class="derecha">
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="collapse" data-bs-target="#report1" aria-expanded="false" aria-controls="collapseExample">Expandir</button>
                </div>                
                <p>Estadísticas</p>
            </div>
            <!-- put view here  -->
            <div class="report-content collapse" id="report1">
                <div class="card bg-transparent">
                    <div class="card-header bg-first-color">
                        <h5 class="card-title text-white m-0">Donaciones</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="report_one" data-route="/reportes/donacion"></canvas>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div>
        </section>
       
        <!-- 2 -->
        <section class="report">
            <div class="report-header">
                <h4 class="">Reporte 2</h4>
                <div class="derecha">
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="collapse" data-bs-target="#report2">Expandir</button>
                </div>                
                <p>reportes</p>
            </div>
            <!-- put view here  -->
            <div class="report-content collapse" id="report2">
                <div class="card bg-transparent">
                    <div class="card-header bg-first-color">
                        <h5 class="card-title text-white m-0">Donaciones</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="report_two" ></canvas>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div>
        </section>
       
        <!-- 3 -->
        <section class="report">
            <div class="report-header">
                <h4 class="">Reporte 3</h4>
                <div class="derecha">
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="collapse" data-bs-target="#report3">Expandir</button>
                </div>                
                <p>reportes</p>
            </div>
            <!-- put view here  -->
            <div class="report-content collapse" id="report3">
                <div class="card bg-transparent">
                    <div class="card-header bg-first-color">
                        <h5 class="card-title text-white m-0">Donaciones</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="report_three"></canvas>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div>
        </section>
       
        <!-- 4 -->
        <section class="report">
            <div class="report-header">
                <h4 class="">Reporte 4</h4>
                <div class="derecha">
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="collapse" data-bs-target="#report4">Expandir</button>
                </div>                
                <p>reportes</p>
            </div>
            <!-- put view here  -->
            <div class="report-content collapse" id="report4">
                <div class="card bg-transparent">
                    <div class="card-header bg-first-color">
                        <h5 class="card-title text-white m-0">Donaciones</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="report_four"></canvas>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div>
        </section>         
    </div>            
</div>
</div> <!--container-->
