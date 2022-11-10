<div id="body-pd" class="">
    <header class="header" id="header">
        <div class="header_toggle"><i class='bx bx-menu text-bdazzled-blue disabled' id="header-toggle"></i></div>
        <div class="header_img" id="logo"><img src="../../assets/img/logo.png" alt=""></div>
        <div class="header_tools">
            <!-- notificaciones  -->
            <div class="notificaciones">
                <i class="bi bi-bell" id="noti-i"></i>
                <span class="badge bg-danger notificaciones_badge">15</span>

                <div class="notificaciones_region">
                    <div class="region_header">
                        <p>Notificaciones</p>
                    </div>
                    <div class="region_content">
                        <div class="todas_notificaciones">
                            <div class="list-group list-group-flush todas_notificaciones_list" id="todas_notificaciones_lista">

                            </div>
                        </div>

                        <div class="empty_message d-none" id="empty_message">No tiene notificaciones</div>
                    </div>
                    <div class="region_footer center">
                        <a href="/notificaciones" class="btn btn-link region_footer_link">Ver todo</a>
                    </div>
                </div>
            </div>
            <!-- cuenta -->
            <div class="dropdown">
                <button class="btn dropdown-toggle center" type="button" id="triggerId"
                        data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                    <div class="header_img"><img src="https://i.imgur.com/hczKIze.jpg" alt=""></div>
                </button>
                <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="triggerId">
                    <h6 class="dropdown-header">Usuario: <?php echo $_SESSION['username'] ?> </h6>
                    <hr class="dropdown-devider my-0">
                    <a class="dropdown-item" href="/cuenta">Cuenta <i class="bi bi-person text-light"></i> </a>
                    <a class="dropdown-item" href="/preferencias">Preferencias</a>
                    <a class="dropdown-item" href="/logout">Cerrar Sesión</a>
                </div>
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
 <div class="page-breadcrumb ps-4 pt-3 column">
    <div class="w-100">
        <h3 class="page-title mb-0 p-0 text-first-color"><?php echo $this->title; ?></h3>
        <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="/home">Sistema</a></li>
            <i class="breadcrumb-item-icon bx bx-chevron-right"></i>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $this->title; ?></li>
            </ol>
        </nav>
        </div>
    </div>
</div>
<!-- breadcrumb -->

<!-- https://azmind.com/demo/bootstrap-4-sidebar-menu/  -->
<!-- https://bbbootstrap.com/snippets/bootstrap-5-sidebar-menu-toggle-button-34132202 -->