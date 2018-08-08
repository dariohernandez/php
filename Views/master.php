<?php
ob_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo NOMB_APP?></title>
    <base href="<?php echo DIR_APP?>" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <!--jquery-->
    <script type="text/javascript" src="<?php echo DIR_FOLDER_APP?>js/jquery-2.2.3.min.js"></script>
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="yes" />
    <meta name="mobile-web-app-capable" content="yes" />
    <!-- bootstrap -->
    <script type="text/javascript" src="<?php echo DIR_FOLDER_APP?>js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo DIR_FOLDER_APP?>bootstrap/bootstrap.min.css" />
    <!--Estilo General -->
    <link rel="stylesheet" type="text/css" href="<?php echo DIR_FOLDER_APP?>css/Estilo.css" />
    
</head>
<body>

<?php 


include_once(DIR_HTML . "general/header.php");

?>
        <!-- end of menu tab -->
        <div id="contenido_central" class="container">


            <div id="content_dinamico" class="center_content col-xs-12 col-md-10 col-md-offset-1 col-lg-offset-1">

            <?php

            
            //Mostrar el contenido dinamico de la página maestra

            require_once("routes.php");

            ?>
              
            </div>
                
        </div>

<?php 

include_once(DIR_HTML . "general/footer.php");


?>

</body>
</html>

<?php
ob_end_flush();
?>