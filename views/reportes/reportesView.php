<?php

/**  @var $this \content\core\View */

$this->title = 'Reportes'
?>
<div class="container-fluid px-4" style="margin-bottom: 50px">
    <div class="row g-4 reportes">
        <!-- 1  -->
        <div class="col-12 col-md-12 col-lg-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title m-0">Género</h5>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" id="form-report-one"
                            action="/reportes/donacion">
                        <div class="form-group center">
                            <div class="input-group input-daterange" id="datepicker">
                                <span class="input-group-text">
                                    <i class="bi bi-calendar-date text-first-color"></i>
                                </span>
                                <input type="text" class="form-control" name="fecha" id="fecha" placeholder="Fecha de Nacimiento" autocomplete="off">
                                <span class="input-group-btn">
                                    <button type="button" name="busqueda_reporte_one" id="busqueda_reporte_one" class="btn btn-secondary">
                                        Buscar <i class="bi bi-search mx-1"></i> 
                                    </button>
                                </span>
                            </div>                                        
                        </div>
                    </form>
                    <canvas id="report_one" width="764" height="350"></canvas>
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div>
        <!-- 2  -->
        <div class="col-12 col-md-12 col-lg-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title m-0">Cantidad de grupos familiares por mes</h5>
                </div>
                <div class="card-body">
                    <canvas id="report_five" data-route="/reportes/grupos" width="764" height="350"></canvas>
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div>
        <!-- 3  -->
        <div class="col-12 col-md-12 col-lg-6">
            <div class="card h-100">
                <div class="card-header ">
                    <h5 class="card-title m-0">Cantidad de amigos por cada grupo familiar</h5>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" id="form-report-six"
                            action="/reportes/gruposAmigos">
                        <div class="row">
                            <div class="col-sm-4 col-lg-4 mb-2">
                                <div class="form-group">
                                    <div class="input-group input-daterange" id="datepicker">
                                <span class="input-group-text">
                                    <i class="bi bi-calendar-date text-first-color"></i>
                                </span>
                                        <input type="text" class="form-control" name="fecha_inicial"
                                                id="fecha_inicial" placeholder="Fecha Inicial"
                                                autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-lg-4 mb-2">
                                <div class="form-group">
                                    <div class="input-group input-daterange" id="datepicker">
                                <span class="input-group-text">
                                    <i class="bi bi-calendar-date text-first-color"></i>
                                </span>
                                        <input type="text" class="form-control" name="fecha_final"
                                                id="fecha_final" placeholder="Fecha Final"
                                                autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-12 mb-2">
                                <button type="button" name="busqueda_reporte_six" id="busqueda_reporte_six" class="btn btn-secondary">
                                    Buscar <i class="bi bi-search mx-1"></i> 
                                </button>
                            </div>
                        </div>
                    </form>
                    <canvas id="report_six" width="764" height="350"></canvas>
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div>
        <!-- 4  -->
        <div class="col-12 col-md-12 col-lg-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title m-0">Cantidad de grupos familiares ingresados en el mes</h5>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" id="form-report-seven"
                            action="/reportes/grupos-ingresados-mes">
                        <div class="row">
                            <div class="col-sm-4 col-lg-4 mb-2">
                                <div class="form-group">
                                    <div class="input-group input-daterange" id="datepicker">
                                <span class="input-group-text">
                                    <i class="bi bi-calendar-date text-first-color"></i>
                                </span>
                                        <input type="text" class="form-control" name="fecha_inicial"
                                                id="fecha_inicial" placeholder="Fecha Inicial"
                                                autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 col-lg-4 mb-2">
                                <div class="form-group">
                                    <div class="input-group input-daterange" id="datepicker">
                                <span class="input-group-text">
                                    <i class="bi bi-calendar-date text-first-color"></i>
                                </span>
                                        <input type="text" class="form-control" name="fecha_final"
                                                id="fecha_final" placeholder="Fecha Final"
                                                autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-12 mb-2">
                                <button type="button" name="busqueda_reporte_seven" id="busqueda_reporte_seven"
                                        class="btn btn-secondary">
                                    Buscar <i class="bi bi-search mx-1"></i> 
                                </button>
                            </div>
                        </div>
                    </form>
                    <div><canvas id="report_seven" width="764" height="350"></canvas></div>
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div>

    </div> <!-- row -->
</div> <!--container-->
