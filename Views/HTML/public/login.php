<!--li><a data-toggle="modal" id="myBtn" href="#myModal">Login</a></li-->
<div class="modal fade" id="myModalLogin" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div id="ContentAJAX"></div>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4><span class="glyphicon glyphicon-lock"></span> Login</h4>
      </div>
      <div class="modal-body">
        <form role="form" id="formLogin">
          <div class="form-group">
            <label for="usuLogin"><span class="glyphicon glyphicon-user"></span> Usuario</label>
            <input type="text" class="form-control" id="usuLogin" name="usuLogin" placeholder="Ingrese correo">
          </div>
          <div class="form-group">
            <label for="passLogin"><span class="glyphicon glyphicon-eye-open"></span> Contrasena</label>
            <input type="password" class="form-control" id="passLogin" name="passLogin" placeholder="Ingrese Contraseña">
          </div>
          <div class="checkbox">
            <label><input type="checkbox" value="true" id="saveLogin" name="saveLogin" checked>Recordarme</label>
          </div>
          <div class="text-center form-group"> 
          <button type="button" class="btn btn-responsive btn-success" id="btnLogin" name="btnLogin">
          <span class="glyphicon glyphicon-off"></span> Login</button>
          </div>                                              
       </form>
      </div>
      <div class="modal-footer">
        
        <p><a href="#" class="btn btn-xs btn-default">Registrate</a></p>
        <p>No recuerdas<a id="myBtnRecvPass" style="cursor:pointer;" data-target="#myModalRecoverPass"> tu Contrase&ntildea?</a>

        <!--button type="button" class="btnNav" id="myBtnRecvPass" data-target="#myModalRecoverPass">tu Contrase&ntildea?</button--></p>
      </div>
    </div>
  </div>
</div> 
<?php include_once(DIR_HTML . "public/recoverPass.php"); ?>                                    
<script src="<?php echo DIR_FOLDER_APP?>js/login.js" ></script>