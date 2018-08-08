<?php  
if (empty($productos)){

    echo "<h3 class='text-info'> No se encontraron productos para mostrar</h3>";
} else {

foreach($productos as $producto ) { ?>
    <div class='col-sm-6 col-xs-12 item_prod'>
    <div class='center_title_bar'>
        
        <span id='lblNombreProd_<?php echo $producto->getCodArticulo();?>'><?php echo $producto->getNombreProducto();?></span></div>
    <div class='row'>
        <div class='col-xs-12 col-sm-5'>
            <div class='container-fluid contImg'>
                <img id='imgProducto<?php echo $producto->getCodArticulo();?>' class='img_prod' src='<?php echo DIR_FOLDER_APP .$producto->getImagen_URL();?>' />
            </div>
        </div>
        <div class='col-xs-12 col-sm-7 prod_price_big'>
            <div class='contPrecios col-xs-12'>
                <div>
                    <span id='lblPrecio_<?php echo $producto->getCodArticulo();?>' class='price'><?php echo $producto->getPrecio();?></span>
                </div>
            </div>
            
        </div>
    </div>
    <div class='col-xs-12'>
        <div class='producto_descr'>
            <span id='lblDescripcrion_<?php echo $producto->getCodArticulo();?>'><?php echo $producto->getDescripcion();?></span></div>
    </div>
    
    <div class='clearfix'>
    </div>
    
    <div class='col-xs-12'>
        <div class='specifications'>
                Garantia:
                <span id='lblGarantia_<?php echo $producto->getCodArticulo();?>' class='blue'><?php echo $producto->getGarantia();?></span></div>
    </div>
</div>
<?php } //Final de foreach 
    } //Final de else

?>