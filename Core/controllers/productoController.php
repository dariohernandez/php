<?php 

class ProductoController{

	public function __construct(){}

	public function index($busq = null){

	$productos = Producto::obtenerProductos($busq);

	include_once(DIR_HTML."producto/productoIndex.php");

	}
	public function create(){ // Muestra la vista de creación de producto

		include_once(DIR_HTML."producto/productoCreate.html");
	}

	public function create_exec(){	//Ejecuta el INSERT del nuevo producto. Funcionalidad requerida desde AJAX 

		// Variables con los campos del form
		$nombreProd=$_POST["txtNombreProd"];
		$descrip=$_POST["txtDescProd"];
		$garantia=$_POST["DListGarantia"];
		$precio=$_POST["txtPrecioProd"];

		$retorno = ""; //Informacion de retorno

		/* Funcionalidad para obtener y almacenar la imagen en el servidor.
		*Todas las validaciones respecto de si ha sido cargada o si su tipo esta aceptado se realizan del lado cliente con JQuery.
		En la BDs solo tendremos su URL */

		$nameImg = $_FILES["imagen-0"]["name"];   // Parseo de la información de la imagen
		$tmpImg = $_FILES["imagen-0"]["tmp_name"];
		$urlnueva = "images/".$nameImg;
		//Validar si la imagen ha sido subida correctamente al servidor
		    if(!move_uploaded_file($tmpImg, DIR_FOLDER_APP.$urlnueva)) {$urlnueva = "images/ProductoSinImagen.jpg"; //Sino asignar imagen por defecto
		    $retorno .= "<script> alert('Error al subir la imagen');</script>";
		}

		$db = new DBConexion();

		//Consulta SQL
		$query="INSERT INTO producto (NombreProducto, Descripcion, Garantia, Precio, Imagen_URL) VALUES ('".$nombreProd."', '".$descrip."', '".$garantia."',".$precio.", '".$urlnueva."')";  

		$sql = $db->ejecuta_query($query);

		// Aviso de resultado de operación y redireccion a la pagina de ProductosCreate		
		($db->filas_afectadas($sql) > 0) ? $msje = "Producto agregado correctamente" : $msje="Hubo un problema al crear el producto";
 		
 		$retorno .= "<script> alert('".$msje."');        
		 window.location='?view=producto&action=create';
		 </script>";

		 $db->cerrar($sql);
		 echo $retorno;

	}
	public function delete(){	//Muestra la vista de eliminación de producto
		include_once(DIR_HTML."producto/productoDelete.html");
	}
	public function delete_confirm(){	// Presenta al usuario la información del producto a eliminar para la confirmación

		$codigo=$_POST["txtDelCod"];

		$retorno="";

		$producto = Producto::getProducto($codigo); //Obtener el producto por ID

			if(!empty($producto)){

		        // Definir el texto en HTML que retornara como resultado de la consulta de eliminación.
		        // En este caso un contenedor con la información del articulo y un aviso de confirmacion
		        $retorno .= include_once(DIR_HTML."producto/productoDelete_confirm.php");

		    } else $retorno.= "<script> alert('Producto con condigo = ".$codigo.", NO ENCONTRADO. Intente nuevamente la busqueda');        
		 window.location='?view=producto&action=delete';</script>";

		echo $retorno;
	}
	public function delete_exec(){	//Ejecuta la eliminación del producto

		$codigo=$_POST["codHide"];

		$retorno="";

		if (Producto::deleteProducto($codigo)){	// Se llama a la función para eliminar articulos de la clase Producto. Si se ejecuta con exito retorna TRUE
			$retorno .= "<script> alert('Producto eliminado de manera exitosa');
		    location.reload();</script>";

		} else {
			$retorno .= "<script> alert('El producto no se ha encontrado. Por ende llevo a cabo la eliminación');
		         location.reload();</script>";
		}
 
		echo $retorno;

	}

	public function update(){ // Muestra la vista de actualización de producto

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
	
}

?>