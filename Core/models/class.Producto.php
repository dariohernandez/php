<?php 

class Producto{

	private $CodArticulo;
	private $NombreProducto;
	private $Descripcion;
	private $Imagen_URL;
	private $Garantia;
	private $Precio;

	public function __construct($codigoProd,$nombreProd, $descripcionProd, $imgProd, $garantiaProd, $precioProd ){

	$this->CodArticulo = $codigoProd;
	$this->NombreProducto = $nombreProd;
	$this->Descripcion = $descripcionProd;
	$this->Imagen_URL = $imgProd;
	$this->Garantia = $garantiaProd;
	$this->Precio = $precioProd;

	}
	public function getCodArticulo(){
		return $this->CodArticulo;
	}
	public function getNombreProducto(){
		return $this->NombreProducto;
	}
	public function getDescripcion(){
		return $this->Descripcion;
	}
	public function getImagen_URL(){
		return $this->Imagen_URL;
	}
	public function getGarantia(){
		return $this->Garantia;
	}
	public function getPrecio(){
		return $this->Precio;
	}

	public static function obtenerProductos($condicion){

		$db = new  DBConexion();

		(!$condicion) ? $consulta="SELECT * FROM producto;" : $consulta="SELECT * FROM producto WHERE NombreProducto LIKE '%$condicion%';";

		$sql_statement = $db->ejecuta_query($consulta);

		$listProd = [];

		if ($db->filas_afectadas($sql_statement) > 0){

			foreach ( $db->retorna_resultado($sql_statement) as $prod) {

				$listProd[] = new Producto($prod["CodArticulo"],$prod["NombreProducto"],$prod["Descripcion"],$prod["Imagen_URL"],$prod["Garantia"],$prod["Precio"]);
			}

		}
		
		$db->cerrar($sql_statement);

		return $listProd;

	}
		public static function getProducto($id){

		$db = new  DBConexion();

		$producto = "";

		$sql_statement = $db->ejecuta_query("SELECT * FROM producto WHERE CodArticulo=$id LIMIT 1;");

		if ($db->filas_afectadas($sql_statement) > 0){

			foreach ( $db->retorna_resultado($sql_statement) as $prod) {

				$producto = new Producto($prod["CodArticulo"],$prod["NombreProducto"],$prod["Descripcion"],$prod["Imagen_URL"],$prod["Garantia"],$prod["Precio"]);
			}

		}
		
		$db->cerrar($sql_statement);

		return $producto;

	}

	public static function deleteProducto($id){

		$db = new  DBConexion();

		$retorno = false;

		$sql_statement = $db->ejecuta_query("DELETE FROM producto WHERE CodArticulo=$id;");

		if($db->filas_afectadas($sql_statement) > 0) $retorno= true; 
		
		$db->cerrar($sql_statement);

		return $retorno;

	}

}

 ?>