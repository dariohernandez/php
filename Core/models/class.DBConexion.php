<?php 

require("Core/models/class.config.php"); // Clase de configuración basica

	class DBConexion extends config{

		private $conexion;

		public function __construct(){

			return $this->conexion = parent::conexion(); //creación de la variable de conexion
		}

		public function ejecuta_query($consulta, $valores=array()){ //Prepara y ejecuta la operación sobre la base de datos

			try{

				if($statement = $this->conexion->prepare($consulta)){	//Prepara la consulta
					if(preg_match_all("/(:\w+)/", $consulta, $campo, PREG_PATTERN_ORDER)){ //tomo los nombres de los campos iniciados con :xxxxx
						$campo = array_pop($campo); //inserto en un arreglo
						foreach ($campo as $parametro) {
							$statement->bindValue($parametro, $valores[substr($parametro, 1)]);
						}
					}

					if(!$statement->execute()) return false;
			
				} return $statement;

			} catch (PDOException $e){
				echo "Error de ejecución ".$e->getMessage();
			}
		} // Fin ejecuta_query
		public function filas_afectadas(PDOStatement $statement){
			return $statement->rowCount();		
		}
		public function retorna_resultado(PDOStatement $statement){ //Retorna un array asociativo con los resultados de la consulta
			return $statement->fetchAll(PDO::FETCH_ASSOC);
			
		}
		public function cerrar(PDOStatement $statement){
			$statement->closeCursor();
		}

	}

 ?>