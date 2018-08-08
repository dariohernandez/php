<div class="modal fade" id="myModalRegistro" role="dialog">
  <div class="modal-dialog">	
	<div class="modal-content">
                 <div id="ContentAJAX_Reg"></div>
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4><span class="glyphicon glyphicon-user"></span> Registro de cuenta</h4>
                 </div>
                 <div class="modal-body">
				  <form class="form-horizontal" role="form" id="formRegCuenta">
					<div class="form-group">
						<div class="col-xs-4 text-right">
							<label for="txtRegUsu" class="control-label">Nombre de Usuario</label>
						</div>
						<div class="col-xs-8">
							<input type="text" id="txtRegUsu" name="txtRegUsu" class="form-control" placeholder="Ingrese Nombre de Usuario">
						</div>
						<div class="col-xs-10 pull-right">
							<span class="help-block">El usuario puede tener maximo 10 caracteres, sin iniciar por un numero, ni contener simbolos extraños (solo guion bajo).</span>	
						</div>
						
					</div>
					<div class="form-group">
						<div class="col-xs-4 text-right">
							<label for="txtRegPass" class="control-label">Contraseña</label>
						</div>
						<div class="col-xs-8">
							<input type="password" id="txtRegPass" name="txtRegPass" class="form-control" placeholder="Ingrese Contraseña">	
						</div>	
						<div class="col-xs-10 pull-right">
							<span class="help-block">La contraseña debera tener entre 8 y 20 caracteres.</span>	
						</div>
						
					</div>
					<div class="form-group">
						<div class="col-xs-4 text-right">
							<label for="txtRegPass2" class="control-label">Repita Contraseña</label>
						</div>
						<div class="col-xs-8">
							<input type="password" id="txtRegPass2" name="txtRegPass2" class="form-control" placeholder="Ingrese de nuevo la Contraseña">	
						</div>							
					</div>
					<div class="form-group">
						<div class="col-xs-4 text-right">
							<label for="txtRegCorreo" class="control-label">Correo Electronico</label>
						</div>
						<div class="col-xs-8">
							<input type="email" id="txtRegCorreo" name="txtRegCorreo" class="form-control" placeholder="Ingrese Cuenta de correo electronico">
						</div>
					</div>
					<div class="form-group">
						<div id="centrado">
							<button type="button" id="btnRegCuenta" name="btnRegCuenta" class="btn btn-info btn-block">Registrarse</button>
						</div>
					</div>

				</form>
              </div>
              <div class="modal-footer"></div>
   </div>
  </div>
 </div>
 <script src="<?php echo DIR_FOLDER_APP?>js/registro.js" ></script>