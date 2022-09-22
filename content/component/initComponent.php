<div id="body-pd" class="">
    <header class="header" id="header">
        <div class="header_toggle"><i class='bx bx-menu text-bdazzled-blue disabled' id="header-toggle"></i></div>
        <div class="header_img"><img src="../../assets/img/logo.png" alt=""></div>
        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle center" type="button" id="triggerId"
                    data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                <div class="header_img"><img src="https://i.imgur.com/hczKIze.jpg" alt=""></div>
            </button>
            <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="triggerId">
                <a class="dropdown-item" href="/cuenta">Cuenta <i class="bi bi-person text-light"></i> </a>
                <a class="dropdown-item" href="/preferencias">Preferencias</a>
                <a class="dropdown-item" href="/logout">Cerrar Sesión</a>
            </div>
        </div>
    </header>

    <!-- menu  -->
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="/home" class="nav_logo">
                    <i class='bx bx-layer nav_logo-icon'></i>
                    <span class="nav_logo-name">Sistema</span>
                </a>
                <div class="nav_list">
                    <?php echo \content\core\helperMenu::buildMenu() ?>
                    <!--li>
                        <div class="nav_link" data-number="2">
                            <i class='bx bx-user nav_icon' data-number="2"></i>
                            <span class="nav_name center">
                            Acceso
                            <i class='bx bx-chevron-down nav_dropdown_icon dropdown_icon_2' data-number="2"></i> 
                            </span>
                        </div>
                        <ul class="hidden item_show_2 itemShow">
                            <li><a href="/usuarios">Usuarios</a></li>
                        </ul>
                    </li>

                    <li>
                        <div class="nav_link" data-number="3">
                            <i class='bx bx-user-check nav_icon' data-number="3"></i>
                            <span class="nav_name center">
                            Miembros
                            <i class='bx bx-chevron-down nav_dropdown_icon dropdown_icon_3' data-number="3"></i>
                            </span>
                        </div>
                        <ul class="hidden item_show_3 itemShow">
                            <li><a href="/miembros/create">Registro</a></li>
                            <li><a href="/miembros">Listado</a></li>
                            <div class="nav_link" data-number="01">
                        <span class="nav_name center">
                        Amigos
                        <i class='bx bx-chevron-right nav_dropdown_icon'></i>
                        </span>
                            </div>
                            <ul class="hidden item_show_01 itemShow">
                                <li><a href="/amigos/create">Registro</a></li>
                                <li><a href="/amigos">Listado</a></li>
                            </ul>
                        </ul>
                    </li>

                    <li>
                        <div class="nav_link" data-number="4">
                            <i class='bx bx-donate-heart nav_icon' data-number="4"></i>
                            <span class="nav_name center">
                        Donaciones
                        <i class='bx bx-chevron-down nav_dropdown_icon dropdown_icon_4' data-number="4"></i>
                        </span>
                        </div>
                        <ul class="hidden item_show_4 itemShow">
                            <li><a href="/donaciones/create">Registro</a></li>
                            <li><a href="/donaciones">Listado</a></li>
                        </ul>
                    </li>

                    <li>
                        <div class="nav_link" data-number="5">
                            <i class='bx bx-briefcase-alt nav_icon' data-number="5"></i>
                            <span class="nav_name center">
                        Actividades
                        <i class='bx bx-chevron-down nav_dropdown_icon dropdown_icon_5' data-number="5"></i>
                        </span>
                        </div>
                        <ul class="hidden item_show_5 itemShow">
                            <li><a href="/actividades/create">Registro</a></li>
                            <li><a href="/actividades">Listado</a></li>
                            <div class="nav_link" data-number="02">
                        <span class="nav_name center">
                        Asistencias
                        <i class='bx bx-chevron-right nav_dropdown_icon'></i>
                        </span>
                            </div>
                            <ul class="hidden item_show_02 itemShow">
                                <li><a href="/asistencias/create">Registro</a></li>
                                <li><a href="/asistencias">Listado</a></li>
                            </ul>
                        </ul>
                    </li>

                    <li>
                        <div class="nav_link" data-number="6">
                            <i class='bx bx-group nav_icon' data-number="6"></i>
                            <span class="nav_name center"> Grupo Familiar <i
                                        class='bx bx-chevron-down nav_dropdown_icon dropdown_icon_6'
                                        data-number="6"></i>
                        </span>
                        </div>
                        <ul class="hidden item_show_6 itemShow">
                            <li><a href="/grupo-familiares/create">Registro</a></li>
                            <li><a href="#">Celulas</a></li>
                            <li><a href="#">Zonas</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="/reportes" class="nav_link" data-number="7">
                            <i class='bx bx-bar-chart-alt-2 nav_icon' data-number="7"></i>
                            <span class="nav_name center">Reportes</span>
                        </a>
                    </li>

                    <li>
                        <a href="/bitacora" class="nav_link" data-number="8">
                            <i class='bx bx-log-in-circle nav_icon' data-number="8"></i>
                            <span class="nav_name center">Bitacora</span>
                        </a>
                    </li>

                    <li>
                        <div class="nav_link" data-number="9">
                            <i class='bx bx-help-circle nav_icon' data-number="9"></i>
                            <span class="nav_name center">
                        Ayuda
                        <i class='bx bx-chevron-down nav_dropdown_icon dropdown_icon_9' data-number="9"></i>
                        </span>
                        </div>
                        <ul class="hidden item_show_9 itemShow">
                            <li><a href="/manual">Manual</a></li>
                            <li><a href="/mapa">Mapa</a></li>
                            <li><a href="/preguntas-frecuentes">FAQ</a></li>
                        </ul>
                    </li>-->
                </div>
            </div>
            <div class="dropdownss">
                <a href="/logout" class="nav_link" data-number="7" title="Cerrar sesión">
                    <i class='bx bx-log-out nav_icon'></i>
                    <span class="nav_name">Cerrar Sesión</span>
                </a>
            </div>
        </nav>
    </div>
</div>

 <!-- breadcrumb -->
 <div class="page-breadcrumb ps-4 pt-4">
    <h3 class="page-title mb-0 p-0 text-first-color"><?php echo $this->title; ?></h3>
    <div class="d-flex align-items-center">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Sistema</a></li>
        <i class="breadcrumb-item-icon bx bx-chevron-right"></i>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $this->title; ?></li>
        </ol>
    </nav>
    </div>
</div>
<!-- breadcrumb -->

<!-- https://azmind.com/demo/bootstrap-4-sidebar-menu/  -->
<!-- https://bbbootstrap.com/snippets/bootstrap-5-sidebar-menu-toggle-button-34132202 -->