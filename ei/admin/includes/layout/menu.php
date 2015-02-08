<?php
require_once("includes/functions/config.php");
?>
  <nav>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<ul class="nav nav-tabs">
			<li<?php if($config["page"]["current"]==1) echo ' class="active"' ?>><a href="index.php">Inicio</a></li>
			<?php
			foreach ($config["scope"] as $page){
				echo '<li class="';
				if(!empty($page["submenu"])) echo "dropdown";
				if($page["current"]==$config["page"]["current"]) echo " active";
				echo '">';
					echo '<a';
					if(!empty($page["submenu"])) echo ' class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#"';
					echo ' href="'.$page["link"].'" rel="external">'.$page["nombre"];
					if(!empty($page["submenu"])) echo ' <b class="caret"></b>';
					echo '</a>';
					if(!empty($page["submenu"])){
						echo '<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">';
						foreach($page["submenu"] as $submenu){
							echo '<li><a href="'.$submenu["link"].'" rel="external">'.$submenu["nombre"].'</a></li>';
							echo "\n"; 
						}
						echo '</ul>';
					}
					echo "</li>";
					echo "\n";
			}
			?>
		</ul>
	</div>
  </nav>
  <div style="clear:both"></div>
