
                                <!--li><a data-toggle="modal" id="myBtn" href="#myModal">Login</a></li-->
                                    <div class="modal fade" id="myModalRecoverPass" role="dialog">
                                        <div class="modal-dialog">

                                          <!-- Modal content-->
                                          <div class="modal-content">
                                            <div id="ContentAJAX_RcvPass"></div>
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h4><span class="glyphicon glyphicon-asterisk"></span> Recupera tu clave</h4>
                                            </div>
                                            <div class="modal-body">
    <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3 class="text-center">Olvidaste tu contraseña?</h3>
                  <p>Puedes reseatear tu clave aquí.</p>
                  <div class="panel-body">   
                    <form id="formResetPass" role="form">   
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input id="emailRst" name="emailRst" placeholder="Dirección de correo" class="form-control"  type="email">
                        </div>
                      </div>
                      <div class="form-group">
                        <button name="btnRecover" id="btnRecover" class="btn btn-lg btn-primary btn-block" type="button">Recuperar</button>
                      </div>
                      
                      <input type="hidden" class="hide" name="token" id="token" value=""> 
                    </form>
    
                  </div>
                </div>
              </div>
            </div>
          </div>

                                            </div>
                                            <div class="modal-footer">
                                            </div>
                                          </div>
                                        </div>
                                      </div> 
 <script src="<?php echo DIR_FOLDER_APP?>js/recoverPass.js" ></script>