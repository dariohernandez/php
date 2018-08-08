                    <nav class="navbar navbar-inverse row">
                        <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
                            <span class="sr-only">Menu</span> <span class="icon-bar"></span><span class="icon-bar">
                            </span><span class="icon-bar"></span>
                        </button>
                        </div>
                        <div class="collapse navbar-collapse" id="myNavbar">
                            <ul class="nav navbar-nav">    
                            <li><a href="?view=home">Inicio</a></li>
                            <li><a href="?view=producto">Ver Productos</a></li>
                             <?php
                                // Validar si hay usuarios en el sistema y se ha establecido la sesion
                                 if($users && isset($_SESSION['user_id'])){
                                    if ($users[$_SESSION['user_id']]['IDPerfil'] == 0){
                                        echo '<li><a href="?view=producto&action=create">Agregar Producto</a></li>
                                    <li><a href="?view=producto&action=delete">Eliminar Producto</a></li>
                                    <li><a href="?view=producto&action=update">Modificar Producto</a></li>';
                                    }

                                 }
                            ?>
                            </ul>
                             <ul class="nav navbar-nav navbar-right">
                                 <?php
                                 if(!isset($_SESSION["user_id"])){
                                    echo '<li><button type="button" class="btnNav" id="myBtnLogin" data-target="#myModalLogin">Login</button></li><li><button type="button" class="btnNav" id="myBtnRegistro" data-target="#myModalRegistro">Registro</button></li>';

                                 } else{
                                    echo '<li class="no_enlace" ><span class="glyphicon glyphicon-user"></span> Bienvenido '.$users[$_SESSION["user_id"]]['NombreUsuario'].'</li><li><a href="?view=cuenta">Mi Cuenta</a></li>
                                    <li><a href="?view=user&action=logOut">Cerrar Sesión</a></li>';

                                 }
                                ?>
                            </ul>
 <?php
   if(!isset($_SESSION["user_id"])){
    include(DIR_HTML . "public/login.php");
    include(DIR_HTML . "public/registro.php");
   }  ?>                            

                        </div>
                    </nav>