<?php 

class Usuario{

	private $ID_Usuario;
	private $NombreUsuario;
	private $Password;
	private $CorreoElectronico;
	private $IDPerfil;
	private $Activo;
	private $KeyRegistro;
	private $RecoverPassword;
	private $KeyRCV;

	public function __construct($idUsuario,$nombreUsuario, $correo, $passUsuario= null, $perfil= null, $activo= null, $keyReg = null, $rcvPass = null, $keyRCV = null){

	$this->ID_Usuario = $idUsuario;
	$this->NombreUsuario = $nombreUsuario;
	$this->CorreoElectronico = $correo;
	$this->Password = $passUsuario;
	$this->IDPerfil = $perfil;
	$this->Activo = $activo;
	$this->KeyRegistro = $keyReg;
	$this->RecoverPassword = $rcvPass;
	$this->KeyRCV = $keyRCV;

	}
	/*public function __construct(){

	$this->ID_Usuario = func_get_arg(0);
	$this->NombreUsuario = func_get_arg(1);
	$this->CorreoElectronico = func_get_arg(2);

		if(func_num_args() > 3){
			$this->Password = func_get_arg(3);
			$this->IDPerfil = func_get_arg(4);
			$this->Activo = func_get_arg(5);
			$this->KeyRegistro = func_get_arg(6);
			$this->RecoverPassword = func_get_arg(7);
			$this->KeyRCV = func_get_arg(8);
		}
	}*/

	public function getID_Usuario(){
		return $this->ID_Usuario;
	}
	public function getNombreUsuario(){
		return $this->NombreUsuario;
	}
	public function getPassword(){
		return $this->Password;
	}
	public function getCorreoElectronico(){
		return $this->CorreoElectronico;
	}
	public function getIDPerfil(){
		return $this->IDPerfil;
	}
	public function getActivo(){
		return $this->Activo;
	}
	public function getKeyRegistro(){
		return $this->KeyRegistro;
	}
	public function getRecoverPassword(){
		return $this->RecoverPassword;
	}
	public function getKeyRCV(){
		return $this->KeyRCV;
	}
	

	public static function existeUsuario(&$name, &$mail){	//Recibe los parametros por referencia para retornar las variables limpias (escapando caracteres extraños)

		$db = new DBConexion(); 
		$consulta = "SELECT ID_Usuario, NombreUsuario, CorreoElectronico FROM usuario WHERE (NombreUsuario='$name' OR CorreoElectronico='$mail') LIMIT 1;";

		if ($sql_statement= $db->ejecuta_query($consulta)){

			if ($db->filas_afectadas($sql_statement) > 0) { // Si existe alguna fila se retorna información del usuario
				
				$resultado = $db->retorna_resultado($sql_statement);
				$dataUser = new Usuario($resultado[0]["ID_Usuario"],$resultado[0]["NombreUsuario"],$resultado[0]["CorreoElectronico"]);

			} else $dataUser= false;
		
		$db->cerrar($sql_statement); // Se cierra el cursor asignado a la consulta
		}

		return $dataUser;

	}

	public static function addUsuario($name, $pass, $mail, $key){

		$db = new DBConexion();

		$consulta="INSERT INTO usuario (NombreUsuario,Password, CorreoElectronico, KeyRegistro) values('$name','$pass','$mail','$key');";

		$sql_insert= $db->ejecuta_query($consulta);

		$id = -1; // Si no se concreta el insert se retorna un ID_Usuario negativo

		if ($db->filas_afectadas($sql_insert)> 0) {
			$sql_idUser= $db->ejecuta_query("SELECT MAX(ID_Usuario) AS id FROM usuario;"); //Obtener el ID del usuario recientemente creado
			$id = $db->retorna_resultado($sql_idUser)[0]['id'];
		}

		$db->cerrar($sql_idUser);

		return $id;

	}

	public static function activaCtaUsuario($key){


		$db = new DBConexion();

		$activacion = FALSE;

		$sql= $db->ejecuta_query("SELECT ID_Usuario FROM usuario WHERE KeyRegistro='".$key."';");

		if ($db->filas_afectadas($sql) > 0){
			// Si hay un usuario con la key de registro se ejcuta el UPDATE
			if($db->ejecuta_query("UPDATE usuario SET Activo=1 WHERE ID_Usuario='".$db->retorna_resultado($sql)[0]["ID_Usuario"]."';")) $activacion= TRUE;
		}

	return $activacion;

	}

	public static function login($data, $pass){

		$base = new DBConexion();
		$query="SELECT ID_Usuario FROM usuario WHERE (NombreUsuario='$data' OR CorreoElectronico='$data') AND Password='$pass' LIMIT 1;";

		if($sql = $base->ejecuta_query($query)){

			($base->filas_afectadas($sql)> 0) ? $id = $base->retorna_resultado($sql)[0]["ID_Usuario"] : $id= -1;
			$base->cerrar($sql);	//Cierre de conexion

		} else return -1; //Si hay un problema al ejecutar la consulta se retorna un id -1

		return $id;
	}

	public static function createRCVPasword($id, $key){	// Creación de la contraseña de recuperación y actualización de la BDs

		$db = new DBConexion();

		$rcvPass= strtoupper(substr(sha1(time()), 0, 8)); // Se genera una nueva contraseña para el usuario de 8 caracteres en mayusculas con el algoritmo SHA1 y el tiempo del sistema

		$sql_update = $db->ejecuta_query("UPDATE usuario SET RecoverPassword='$rcvPass', KeyRCV='$key' WHERE ID_Usuario ='$id';");
		return $db->filas_afectadas($sql_update); // Retorna 1 si la consulta se ejecuto con exito y modifico la fila
	}

	public static function updateRCVPassword($key){
		
		$db = new DBConexion();

		$sql = $db->ejecuta_query("SELECT ID_Usuario, RecoverPassword FROM usuario WHERE KeyRCV='$key' LIMIT 1;");
		
		$data = null; //Iniciamos la data de retorno

		if ($db->filas_afectadas($sql) > 0){ 
			
			$data = $db->retorna_resultado($sql)[0];// Obtener la información resultante de la consulta
			
			$user= $data["ID_Usuario"];
			$pass = encriptar($data["RecoverPassword"]); //Encriptar la nueva password

			$sql= $db->ejecuta_query("UPDATE usuario SET KeyRCV='',RecoverPassword='', Password='$pass' WHERE ID_Usuario=$user;");

			if ($db->filas_afectadas($sql) == 0) $data= null;
		}

		$db->cerrar($sql);

		return $data; //Retorna la información basica del usuario o NULL si hubo algun error


	}
}

 ?>