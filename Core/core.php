<?php

//Vistas validas y acciones
$controllers = array(
    'home' => ['index'],
    'producto' => ['index', 'update', 'create', 'delete'],
    'user' => ['logOut', 'activaCta', 'recoverPass']
);

// Vistas publicas
$rutas_publicas = array('?view=home&action=index','?view=producto&action=index');

// Constantes HTML
define("DIR_HTML","Views/HTML/");
define("DIR_FOLDER_APP","Views/app/");
define("NOMB_APP", "Mundo Electro");
define("DERECHO_COPY", "Copyright &copy; " . date('Y', time()) ." " . NOMB_APP);
define("DIR_APP","http://localhost/PHP/MVC_PHP/");

//Constantes de conexion SMTP

define("SMTP_HOST","smtp.gmail.com");
define("SMTP_EMAIL","mundoelectro.empresa@gmail.com");
define("SMTP_PASS", "mundoelectro_empresa");
define("SMTP_PORT", 465);

session_start(); //Iniciar una sesion para propiciar variables de usuario

require("vendor/autoload.php");
require("Core/bin/functions/encrypt.php"); //Funciones de encriptado
require("Core/bin/functions/userSession.php"); // Obtener los usuarios de la BDs
require("Core/bin/functions/mailUtils.php"); // Template de creacion de correo para activación de cuenta
require("Core/bin/functions/mostrarAlerta.php");
require("Core/bin/functions/validaRuta.php"); // Funcionalidad de validación de rutas para la navegación por perfiles


//require("Core/models/class.config.php"); // Clase de configuración basica
require("Core/models/class.DBConexion.php"); // Clase encargada de la conexion a la BDs
//require("Core/models/class.Conexion.php"); // Clase encargada de la conexion a la BDs
require("Core/models/class.Producto.php"); // Clase encargada del manejo de productos
require("Core/models/class.Usuario.php"); // Clase encargada del manejo de usuarios


$users=getUsers();
?>