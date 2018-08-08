<?php 

if(isset($_REQUEST["mode"]) && $_REQUEST["mode"] == 'producto') {

		require_once('Core/controllers/productoController.php');

		$prodController = new ProductoController();

				if ($_SERVER['REQUEST_METHOD'] === 'GET') {

			switch (true) {
				case isset($_GET["txtBuscar"]):

						$cadenaBusq = addslashes(htmlentities($_GET["txtBuscar"], ENT_QUOTES));
						echo "<script> changeURL('?view=producto&busq=".$cadenaBusq."');</script>";

						$prodController->index($cadenaBusq);

					break;

				default:

					break;
			}
		} else {
			switch (true) {
				case isset($_POST["txtUpdCod"]):

					$prodController->update_confirm();

					break;
				case isset($_POST["codHideUpd"]):

					$prodController->update_exec();

					break;
				case isset($_POST["txtNombreProd"]):

					$prodController->create_exec();

					break;
				case isset($_POST["txtDelCod"]):

					$prodController->delete_confirm();

					break;
				case isset($_POST["codHide"]):

					$prodController->delete_exec();

					break;
				default:

					break;
			}
		}
}

 ?>