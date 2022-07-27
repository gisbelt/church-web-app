<div id="body-pd" class="">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu text-bdazzled-blue' id="header-toggle"></i> </div>
        <div class="header_img"> <img src="asset/img/logo.png" alt=""> </div>
        <?php if(isset($user[0])){ ?>
        <div class="dropdown ">
            <button class="btn btn-light dropdown-toggle center" type="button" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
            </button>
            <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="triggerId">
                <a class="dropdown-item" href="?url=cuenta">Cuenta <i class="bi bi-person text-light"></i> </a>
                <a class="dropdown-item" href="?url=preferencias">Preferencias</a>
                <a class="dropdown-item" href="?url=logout">Cerrar Sesión</a> 
            </div>
        </div>
        <?php } ?>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div> 
                <a href="#" class="nav_logo"> 
                    <i class='bx bx-layer nav_logo-icon'></i> 
                    <span class="nav_logo-name">Sistema</span> 
                </a>
                <div class="nav_list"> 
                    <li> 
                        <a href="#" class="nav_link active" data-number="1">
                            <i class='bx bx-grid-alt nav_icon' data-number="1"></i> 
                            <span class="nav_name">Home</span>
                        </a>
                        <ul class="hidden item_show_1 itemShow ">
                            <li><a href="#">Home</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="nav_link" data-number="2"> 
                            <i class='bx bx-user nav_icon' data-number="2"></i> 
                            <span class="nav_name">Acceso</span> 
                        </a>
                        <ul class="hidden item_show_2 itemShow">
                            <li><a href="?url=consultarUsuarios">Usuarios</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="nav_link" data-number="3">
                            <i class='bx bx-message-square-detail nav_icon' data-number="3"></i> 
                            <span class="nav_name">Messages</span> 
                        </a>
                        <ul class="hidden item_show_3 itemShow">
                            <li><a href="#">App Design</a></li>
                            <li><a href="#">Web Design</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="nav_link" data-number="4"> 
                            <i class='bx bx-bookmark nav_icon' data-number="4"></i> 
                            <span class="nav_name">Bookmark</span> 
                        </a> 
                        <ul class="hidden item_show_4 itemShow">
                            <li><a href="#">App Design</a></li>
                            <li><a href="#">Web Design</a></li>
                        </ul> 
                    </li>
                    <li>
                        <a href="#" class="nav_link" data-number="5"> 
                            <i class='bx bx-folder nav_icon' data-number="5"></i> 
                            <span class="nav_name">Files</span> 
                        </a> 
                        <ul class="hidden item_show_5 itemShow">
                            <li><a href="#">App Design</a></li>
                            <li><a href="#">Web Design</a></li>
                        </ul> 
                    </li>
                    <li>
                        <a href="#" class="nav_link" data-number="6"> 
                            <i class='bx bx-bar-chart-alt-2 nav_icon' data-number="6"></i> 
                            <span class="nav_name">Stats</span> 
                        </a> 
                        <ul class="hidden item_show_6 itemShow">
                            <li><a href="#">App Design</a></li>
                            <li><a href="#">Web Design</a></li>
                        </ul> 
                    </li>
                </div>
            </div> 
            <div class="dropdown">
                <a href="?url=logout" class="nav_link" data-number="7" title="Cerrar sesión"> 
                    <i class='bx bx-log-out nav_icon'></i> 
                    <span class="nav_name">SignOut</span>
                </a>
            </div>
        </nav>
    </div>
</div>

<!-- https://azmind.com/demo/bootstrap-4-sidebar-menu/  -->