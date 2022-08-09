<div id="body-pd" class="">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu text-bdazzled-blue disabled' id="header-toggle"></i> </div>
        <div class="header_img"> <img src="asset/img/logo.png" alt=""> </div>
        <?php if(isset($user[0])){ ?>
        <div class="dropdown ">
            <button class="btn btn-light dropdown-toggle center" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
            </button>
            <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="triggerId">
                <a class="dropdown-item" href="?url=perfil">Cuenta <i class="bi bi-person text-light"></i> </a>
                <a class="dropdown-item" href="?url=perfil&action=preferencias">Preferencias</a>
                <a class="dropdown-item" href="?url=login&action=cerrarSesion">Cerrar Sesión</a> 
            </div>
        </div>
        <?php } ?>
    </header>
    <div class="l-navbar" id="nav-bar" data-value="">
        <nav class="nav">
            <div> 
                <a href="#" class="nav_logo"> 
                    <i class='bx bx-layer nav_logo-icon'></i> 
                    <span class="nav_logo-name">Sistema</span> 
                </a>
                <div class="nav_list"> 
                    <li> 
                        <a href="?url=home" class="nav_link active" data-number="1">
                            <i class='bx bx-grid-alt nav_icon' data-number="1"></i> 
                            <span class="nav_name">Inicio</span>
                        </a>
                    </li>
                    <li>
                        <div class="nav_link" data-number="2"> 
                            <i class='bx bx-user nav_icon' data-number="2"></i> 
                            <span class="nav_name center">
                            Acceso
                            <i class='bx bx-chevron-down nav_dropdown_icon dropdown_icon_2' data-number="2"></i> 
                            </span>                            
                        </div>
                        <ul class="hidden item_show_2 itemShow">
                            <li><a href="?url=usuarios&action=consultar">Usuarios</a></li>
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
                            <li><a href="?url=miembros&action=registrar">Registro</a></li>
                            <li><a href="?url=miembros&action=consultar">Listado</a></li>
                            <!-- submenu 2  -->
                            <div class="nav_link" data-number="01">
                                <span class="nav_name center">
                                Amigos
                                <i class='bx bx-chevron-right nav_dropdown_icon'></i>
                                </span>   
                            </div>
                            <ul class="hidden item_show_01 itemShow">
                                <li><a href="?url=amigos&action=registrar">Registro</a></li>
                                <li><a href="?url=amigos&action=registrar">Listado</a></li>
                            </ul>
                            <!-- submenu 2  -->
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
                            <li><a href="?url=donaciones&action=registrar">Registro</a></li>
                            <li><a href="?url=donaciones&action=consultar">Listado</a></li>
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
                            <li><a href="#">Registro</a></li>
                            <li><a href="#">Listado</a></li>
                            <!-- submenu 2  -->
                            <div class="nav_link" data-number="02">
                                <span class="nav_name center">
                                Asistencias
                                <i class='bx bx-chevron-right nav_dropdown_icon'></i>
                                </span>   
                            </div>
                            <ul class="hidden item_show_02 itemShow">
                                <li><a href="#">Registro</a></li>
                                <li><a href="#">Listado</a></li>
                            </ul>
                            <!-- submenu 2  -->
                        </ul> 
                    </li>
                    <li>
                        <div class="nav_link" data-number="6"> 
                            <i class='bx bx-group nav_icon' data-number="6"></i> 
                            <span class="nav_name center">
                            Grupo Familiar
                            <i class='bx bx-chevron-down nav_dropdown_icon dropdown_icon_6' data-number="6"></i> 
                            </span>
                        </div> 
                        <ul class="hidden item_show_6 itemShow">
                            <li><a href="?url=grupoFamiliar&action=registrar">Registro</a></li>
                            <li><a href="#">Celulas</a></li>
                            <li><a href="#">Zonas</a></li>
                        </ul> 
                    </li>
                    <li>
                        <a href="?url=reportes" class="nav_link" data-number="7"> 
                            <i class='bx bx-bar-chart-alt-2 nav_icon' data-number="7"></i> 
                            <span class="nav_name center">Reportes</span> 
                        </a> 
                    </li>
                    <li>
                        <div class="nav_link" data-number="8"> 
                            <i class='bx bx-log-in-circle nav_icon' data-number="8"></i> 
                            <span class="nav_name center">Bitacora</span> 
                        </div> 
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
                            <li><a href="#">Manual</a></li>
                            <li><a href="#">Mapa</a></li>
                            <li><a href="#">FAQ</a></li>
                        </ul> 
                    </li>
                </div>
            </div> 
            <div class="dropdownss">
                <a href="?url=login&action=cerrarSesion" class="nav_link" data-number="7" title="Cerrar sesión"> 
                    <i class='bx bx-log-out nav_icon'></i> 
                    <span class="nav_name">SignOut</span>
                </a>
            </div>
        </nav>
    </div>
</div>

<!-- https://azmind.com/demo/bootstrap-4-sidebar-menu/  -->