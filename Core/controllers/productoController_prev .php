<?php 

class ProductoController{

	public function __construct(){}

	public function index($busq = null){

	$productos = Producto::obtenerProductos($busq);

	include_once(DIR_HTML."producto/productoIndex.php");

	}
	public function create(){

		include_once(DIR_HTML."producto/productoCreate.html");
	}

	public function update(){

	include_once(DIR_HTML."producto/productoUpdate.html");
	}

	public function update_confirm(){ // Funcionalidad de Busqueda de articulo, previo a la modificacion

			// Variable con el codigo de articulo
			$codigo=$_POST["txtUpdCod"];

			$producto = Producto::getProducto($codigo); //Obtener un objeto producto por su codigo, si existe

			$retorno=""; 

			if(!empty($producto)){	//Si no se ha encontrado el articulo devuelve una variable vacia

			    // Incluir el texto en HTML que retornara como resultado de la consulta de eliminación.
			    // En este caso un contenedor con la información del articulo para la confirmación de operación
			        
			        $retorno .= include_once(DIR_HTML."producto/productoUpdate_confirm.php");

			            // <script>$(document).ready(function(){$("#DListGarantiaUpd").val("'.$fila['Garantia'].'").change();});</script>; -> Es el Script JQuery que selecciona del objeto SELECT la opcion correspondiente a la garantia del producto

			  } else $retorno .= "<script> alert('Producto con codigo = ".$codigo.", NO ENCONTRADO. Intente nuevamente la busqueda'); window.location='".$_SERVER['PHP_SELF']."';</script>";

			echo $retorno;

	} 

	public function update_exec(){	//Ejecución del Update con los campos modificados del articulo

				// Variables obtenidas
		$codigo=$_POST["codHideUpd"];
		$nombreProd=$_POST["txtProdUpd"];
		$descrip=$_POST["txtDescProdUpd"];
		$garantia=$_POST["DListGarantiaUpd"];
		$precio=$_POST["txtPrecioProdUpd"];

		//Consulta SQL
		$producto = Producto::getProducto($codigo); //Obtener la información del articulo por su codigo

		$retorno=""; // Informacion de retorno

		$query="UPDATE producto SET "; //query del UPDATE

		    if(!empty($producto)){  //Existe resultado
		    
		        // Utilizar una variable para validar que alguno de los campos haya sido realmente modificado
		        $modificacion = false;

		        $valores = array(); // Vector que contendra los valores para el UPDATE (si los hay)

		        // Evaluar que campos se han modificado para ponerlos en la query
		        if($producto->getNombreProducto() != $nombreProd){
		            $query .= "NombreProducto =:NombreProducto, ";
		            $valores["NombreProducto"] = $nombreProd;
		            $modificacion= true;
		        }
		        if($producto->getDescripcion() != $descrip){
		            $query .= "Descripcion =:Descripcion, ";
		            $valores["Descripcion"] = $descrip;
		            $modificacion= true;
		        } 
		        if($producto->getGarantia() != $garantia){
		            $query .= "Garantia =:Garantia, ";
		            $valores["Garantia"] = $garantia;
		            $modificacion=true;
		        }
		        if($producto->getPrecio() != $precio){
		            $query .= "Precio =:Precio, ";
		            $valores["Precio"] = $precio;
		            $modificacion=true;
		        }


		        if(isset($_FILES["imagen-0"]["name"]) && is_uploaded_file($_FILES["imagen-0"]["tmp_name"])){  // Hacer la operacion solo si estuviese cargada y seteada una nueva imagen

		        // Obtener nombre de la imagen
		        $nameImg = $_FILES["imagen-0"]["name"];   // Parseo de la información de la imagen
		        $tmpImg = $_FILES["imagen-0"]["tmp_name"];
		        $url = "images/".$nameImg;

		            if($producto->getImagen_URL() != $url){
		                //Validar si la imagen ha sido subida correctamente al servidor
		                if(move_uploaded_file($tmpImg, DIR_FOLDER_APP.$url)) {
		                    $query.= "Imagen_URL =:Imagen_URL, ";
		                    $valores["Imagen_URL"] = $url;
		                    $modificacion=true;
		                } 
		                else $retorno .= "<script> alert('Error al subir la imagen');</script>";
		            }
		        }


		    }

		    if ($modificacion){ // Si hubo modificacion finalizar la consulta y ejecutarla

		        $query=substr($query, 0, -2); //Obtener un string sin los ultimos caracteres ', '
		        $query.= " WHERE CodArticulo =:CodArticulo;";

		        $valores["CodArticulo"] = $codigo;

		        $db = new DBConexion();

		        $sql = $db->ejecuta_query($query, $valores);

		        // Se ejecuto la actualizacion
		        if($db->filas_afectadas($sql) == 1) $retorno .= "<script> alert('Actualizacion realizada correctamente'); window.location='?view=producto&action=update';</script>";
		        else $retorno .= "<script> alert('No se ha encontrado el articulo para actualizar'); window.location='".$_SERVER['PHP_SELF']."';</script>";

		    } else $retorno .= "<script> alert('Ninguna información esta siendo modificada'); window.location='".$_SERVER['PHP_SELF']."';</script>";

		echo $retorno;

	} //Fin update_exec()

	public function define_functionAJAX(){ // Función utilizada para definir el metodo a ejecutar en el request

		if ($_SERVER['REQUEST_METHOD'] === 'GET') {

			switch (true) {
				case isset($_GET["txtBuscar"]):

						$cadenaBusq = addslashes(htmlentities($_GET["txtBuscar"], ENT_QUOTES));
						echo "<script> changeURL('?view=producto&busq=".$cadenaBusq."');</script>";

						$this->index($cadenaBusq);

					break;

				default:

					break;
			}
		} else {
			switch (true) {
				case isset($_POST["txtUpdCod"]):

					$this->update_confirm();

					break;
				case isset($_POST["codHideUpd"]):

					$this->update_exec();

					break;
				default:

					break;
			}
		}


	}// Fin define_functionAJAX()
}

// Validar si la solicitud es una llamada por AJAX. En ese caso hay que crear la clase controladora y definir el metodo a ejecutar
if(isset($_REQUEST["mode"])) {

		$prodController = new ProductoController();

		$prodController->define_functionAJAX();
}

 ?>