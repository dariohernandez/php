<h4 class='text-info'>¿Estas seguro de querer eliminar?</h4>
	<div class='row'>
		<div class='col-xs-6'>
		<img class='pull-right' src='<?php echo DIR_FOLDER_APP.$producto->getImagen_URL();?>' width='90' height='90' />
		</div>
		<div class='col-xs-6'>
			<p id='pNombDelProd'><?php echo $producto->getNombreProducto();?></p>
		</div>
	</div>
<div class='row'>
	<form id='form_prodDel1' class='form-group prop_col'>
		<div class='botones_admProd'>
		<input type='hidden' name='codHide' id='codHide' value='<?php echo $codigo;?>' />
		<button type='submit' id='btnAceptDelProd' name='btnAceptDelProd' class='btn btn-success btn-sm pull-left' onclick="env_ajax('ajax.php?mode=producto', 'post', 'form_prodDel1',false);">Aceptar</button>
		<input type='submit' name='btnCancDelProd' value='Cancelar' id='btnCancDelProd' class='btn btn-sm  btn-danger pull-right' /></div>
	</form>
</div>