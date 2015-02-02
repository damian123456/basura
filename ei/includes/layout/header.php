<div class="well header-well">
    <h1>
        <a href="/"><?=$nombre_sitio?></a> - Panel de administración
    </h1>

    <div class="btn-group">
        <button class="btn<? if($_SESSION["panel"]["first"]==1) echo " btn-danger" ?>"><? echo ucwords($_SESSION["panel"]["name"]); ?></button>
        <button class="btn<? if($_SESSION["panel"]["first"]==1) echo " btn-danger" ?> dropdown-toggle" data-toggle="dropdown">
        <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="index.php?action=password">Cambiar contraseña<? if($_SESSION["panel"]["first"]==1){ ?> <span style="color: #BD362F;">(requerido)</span><? } ?></a></li>
            <li class="divider"></li>
          <li><a href="login.php?action=logout">Cerrar sesión</a></li>
        </ul>
    </div>
</div>

<div class="well hidden-sm hidden-md hidden-lg toggle_nav_custom">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Ocultar / Mostrar menú</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
</div>
