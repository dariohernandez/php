<form enctype='multipart/form-data' id='form_prodUpd1'>
	<div class='row'>
		<div class='form_prodAdd'>
			<div class='row'>
				<div class='subt_prod'>
				<h4 class='text-success'>Datos articulo</h4>
				</div>
			</div>
		<div class='form-group prop_col'>
			<div class='col-xs-4 prop_labels'>
				<input type='hidden' name='codHideUpd' id='codHideUpd' value='<?php echo $producto->getCodArticulo();?>' />
				<span id='lblProdUpd' class='control-label'>Nombre Producto:</span>
			</div>
			<div class='col-xs-8'>
				<input name='txtProdUpd' type='text' id='txtProdUpd' class='form-control' value='<?php echo $producto->getNombreProducto();?>' />
			</div>
		</div>
		<div class='form-group prop_colTB'>
			<div class='col-xs-4 prop_labels'>
				<span id='lblDescProdUpd'>Descripcion:</span>
			</div>
			<div class='col-xs-8'>
				<textarea name='txtDescProdUpd' rows='3' cols='20' id='txtDescProdUpd' class='form-control'><?php echo $producto->getDescripcion();?></textarea>
			</div>
			<div class='clearfix'></div>
		</div>
<div class='form-group prop_col'>
	<div class='col-xs-6'>
		<div class='row'>
			<div class='col-xs-6 prop_labels'>
				<span id='lblPrecioProdUpd'>Precio:</span>
			</div>
			<div class='col-xs-6'>
				<input name='txtPrecioProdUpd' type='text' id='txtPrecioProdUpd' class='form-control' value='<?php echo $producto->getPrecio();?>'/>
			</div>
		</div>
	</div>
	<div class='col-xs-6'>
		<div class='row'>
			<div class='col-xs-6 prop_labels'>
				<span id='lblGarantiaUpd'>Garantia:</span>
			</div>
			<div class='col-xs-6'>
				<select name='DListGarantiaUpd' id='DListGarantiaUpd' class='control-label'>
					<option selected='selected' value='Sin Garantia'>N/A </option>
					<option value='1 mes'>1 mes </option><option value='3 meses'>3 meses </option>
					<option value='6 meses'>6 meses</option><option value='12 meses'>12 meses</option>
					<option value='24 meses'>24 meses</option>
				</select>
			</div>
		</div>
	</div>
</div>
<div class='form-group prop_col'>
	<div class='cont_imgUpdXS col-xs-3 prop_labels'>
		<span id='lblImagenUpd'>Imagen:</span>
	</div>
	<div class='col-xs-2'>
		<img src='<?php echo DIR_FOLDER_APP.$producto->getImagen_URL();?>' width='50px' height='50px'/>
	</div>
	<div class='col-xs-7'>
	<input type='file' name='imagenUpd' id='imagenUpd' />
	</div>
</div>
<div class='form-group prop_col'>
	<div class='botones_admProd'>
		<button type='submit' name='btnGuardarUpd' id='btnGuardarUpd' class='btn btn-success pull-left'>Modificar</button>
		<button type='submit' name='btnCancelarUpd'id='btnCancelarUpd' class='btn btn-danger pull-right'>Cancelar</button>
	</div>
   </div>
  </div>

 </div>
</form>

<script>$(document).ready(function(){$("#DListGarantiaUpd").val("<?php echo $producto->getGarantia();?>").change();});</script>
