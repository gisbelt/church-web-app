<?php

/**  @var $this \content\core\View */

$this->title = 'Reportes'
?>
<div class="container" style="margin-bottom: 50px">
    <h3 class="text-center mb-4">Reportes</h3>
    <div class="row">
        <div class="col-md-12 mb-5">
            <!-- 1 -->
            <section class="report">
                <div class="report-header">
                    <h4 class="">Miembros</h4>
                    <div class="derecha">
                        <button type="button" class="btn btn-outline-success" data-bs-toggle="collapse"
                                data-bs-target="#report1" aria-expanded="false" aria-controls="collapseExample">Expandir
                        </button>
                    </div>
                    <p>Genero de miembro por fecha de nacimiento</p>
                </div>
                <!-- put view here  -->
                <div class="report-content collapse" id="report1">
                    <div class="card">
                        <div class="card-header bg-first-color">
                            <h5 class="card-title text-white m-0">Género</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" id="form-report-one"
                                  action="/reportes/donacion">
                                <div class="row">
                                    <div class="col-md-4 col-12 mb-2">
                                        <div class="form-group center">
                                            <div class="input-group input-daterange" id="datepicker">
                                            <span class="input-group-text">
                                                <i class="bi bi-calendar-date text-first-color"></i>
                                            </span>
                                            <input type="text" class="form-control" name="fecha" id="fecha" placeholder="Fecha de Nacimiento" autocomplete="off">
                                            <span class="input-group-btn">
                                                <button type="button" name="busqueda_reporte_one" id="busqueda_reporte_one" class="btn btn-secondary btn-block">
                                                    <i class="bi bi-search"></i> Buscar
                                                </button>
                                            </span>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                        <canvas id="report_one" width="764" height="250"></canvas>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div>
        </section>
       
        <!-- 2
        <section class="report">
            <div class="report-header">
                <h4 class="">Reporte 2</h4>
                <div class="derecha">
                    <button type="button" class="btn btn-outline-success" data-bs-toggle="collapse" data-bs-target="#report2">Expandir</button>
                </div>                
                <p>reportes</p>
            </div>-->
            <!-- put view here  -->
            <!-- <div class="report-content collapse" id="report2">
                 <div class="card bg-transparent">
                     <div class="card-header bg-first-color">
                         <h5 class="card-title text-white m-0">Donaciones</h5>
                     </div>
                     <div class="card-body">
                         <canvas id="report_two" width="764" height="250"></canvas>
                     </div><!-- /.card-body -->
            <!-- </div><!-- /.card -->
            <!--</div>
        </section>-->

            <!-- 3 -->
            <!--<section class="report">
                <div class="report-header">
                    <h4 class="">Reporte 3</h4>
                    <div class="derecha">
                        <button type="button" class="btn btn-outline-success" data-bs-toggle="collapse" data-bs-target="#report3">Expandir</button>
                    </div>
                    <p>reportes</p>
                </div>
                <!-- put view here  -->
            <!--<div class="report-content collapse" id="report3">
               <div class="card bg-transparent">
                   <div class="card-header bg-first-color">
                       <h5 class="card-title text-white m-0">Donaciones</h5>
                   </div>
                   <div class="card-body">
                       <canvas id="report_three" width="764" height="250"></canvas>
                   </div><!-- /.card-body -->
            <!--</div><!-- /.card -->
            <!-- </div>
         </section>-->

            <!-- 4 -->
            <!--<section class="report">
                <div class="report-header">
                    <h4 class="">Reporte 4</h4>
                    <div class="derecha">
                        <button type="button" class="btn btn-outline-success" data-bs-toggle="collapse" data-bs-target="#report4">Expandir</button>
                    </div>
                    <p>reportes</p>
                </div>-->
            <!-- put view here  -->
            <!--<div class="report-content collapse" id="report4">
                <div class="card bg-transparent">
                    <div class="card-header bg-first-color">
                        <h5 class="card-title text-white m-0">Donaciones</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="report_four" width="764" height="250"></canvas>
                    </div><!-- /.card-body -->
            <!--</div><!-- /.card -->
            <!--  </div>
          </section>   -->

            <!-- 5 -->
            <section class="report">
                <div class="report-header">
                    <h4 class="">Grupos Familiares</h4>
                    <div class="derecha">
                        <button type="button" class="btn btn-outline-success" data-bs-toggle="collapse"
                                data-bs-target="#report5">Expandir
                        </button>
                    </div>
                    <p>Reportes de Grupos Familiares</p>
                </div>
                <!-- put view here  -->
                <div class="report-content collapse" id="report5">
                    <!-- 1  -->
                    <div class="card bg-transparent">
                        <div class="card-header bg-first-color">
                            <h5 class="card-title text-white m-0">Cantidad de grupos familiares por mes</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="report_five" data-route="/reportes/grupos" width="764" height="250"></canvas>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div>
            </section>

            <!-- 6 -->
            <section class="report">
                <div class="report-header">
                    <h4 class="">Grupos Familiares</h4>
                    <div class="derecha">
                        <button type="button" class="btn btn-outline-success" data-bs-toggle="collapse"
                                data-bs-target="#report6">Expandir
                        </button>
                    </div>
                    <p>Cantidad de amigos por cada grupo familiar</p>
                </div>
                <!-- put view here  -->
                <div class="report-content collapse" id="report6">
                    <div class="card">
                        <div class="card-header bg-first-color">
                            <h5 class="card-title text-white m-0">Cantidad de amigos por cada grupo familiar</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" id="form-report-six"
                                  action="/reportes/gruposAmigos">
                                <div class="row">
                                    <div class="col-md-3 col-12 mb-2">
                                        <div class="form-group">
                                            <div class="input-group input-daterange" id="datepicker">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar-date text-first-color"></i>
                                        </span>
                                                <input type="text" class="form-control" name="fecha_inicial"
                                                       id="fecha_inicial" placeholder="Insertar Fecha Inicial"
                                                       autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12 mb-2">
                                        <div class="form-group">
                                            <div class="input-group input-daterange" id="datepicker">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar-date text-first-color"></i>
                                        </span>
                                                <input type="text" class="form-control" name="fecha_final"
                                                       id="fecha_final" placeholder="Insertar Fecha Final"
                                                       autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12 mb-2">
                                        <button type="button" name="busqueda_reporte_six" id="busqueda_reporte_six"
                                                class="btn btn-secondary">
                                            <i class="bi bi-search"></i> Buscar
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <canvas id="report_six" width="764" height="250"></canvas>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div>
            </section>

            <!-- 7 -->
            <section class="report">
                <div class="report-header">
                    <h4 class="">Grupos Familiares</h4>
                    <div class="derecha">
                        <button type="button" class="btn btn-outline-success" data-bs-toggle="collapse"
                                data-bs-target="#report7">Expandir
                        </button>
                    </div>
                    <p>Cantidad de grupos familiares ingresados en el mes</p>
                </div>
                <!-- put view here  -->
                <div class="report-content collapse" id="report7">
                    <div class="card">
                        <div class="card-header bg-first-color">
                            <h5 class="card-title text-white m-0">Cantidad de grupos familiares ingresados en el
                                mes</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" id="form-report-seven"
                                  action="/reportes/grupos-ingresados-mes">
                                <div class="row">
                                    <div class="col-md-3 col-12 mb-2">
                                        <div class="form-group">
                                            <div class="input-group input-daterange" id="datepicker">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar-date text-first-color"></i>
                                        </span>
                                                <input type="text" class="form-control" name="fecha_inicial"
                                                       id="fecha_inicial" placeholder="Insertar Fecha Inicial"
                                                       autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12 mb-2">
                                        <div class="form-group">
                                            <div class="input-group input-daterange" id="datepicker">
                                        <span class="input-group-text">
                                            <i class="bi bi-calendar-date text-first-color"></i>
                                        </span>
                                                <input type="text" class="form-control" name="fecha_final"
                                                       id="fecha_final" placeholder="Insertar Fecha Final"
                                                       autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12 mb-2">
                                        <button type="button" name="busqueda_reporte_seven" id="busqueda_reporte_seven"
                                                class="btn btn-secondary">
                                            <i class="bi bi-search"></i> Buscar
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <canvas id="report_seven" width="764" height="250"></canvas>
                        </div><!-- /.card-body -->
                    </div><!-- /.card -->
                </div>
            </section>
        </div>
    </div>
</div> <!--container-->
