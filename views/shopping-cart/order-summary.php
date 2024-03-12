<h2>Resumen</h2>

<table id="cart-table">
    <tr>
        <th>Imagen</th>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Subtotal</th>
    </tr>

    <?php
    foreach ($_SESSION['cart'] as $product) {
        echo "
            <tr>
                <td><img src='" . base_url . "uploads/images/products/" . $product['image'] . "'></td>
                <td>" . $product['name'] . "</td>
                <td>" . $product['quantity'] . "</td>
                <td>" . $product['price'] . "</td>
                <td>" . $product['subtotal']  . "</td>                
            </tr>
            
            
            ";
    }
    ?>

</table>
<div id="summary-cart">

    <div id="cart-total">
        <h3>Total Productos: </h3><?= ShoppingCartController::total() ?>€
    </div>
    <?php
    if (isset($_GET['carrier'])) {
        echo '
            <div class="flex">
                <h3>Transporte: </h3>' . $_GET["carrier"] . '€
            </div>';
    }
    ?>
    
    <div class="flex">
        <h2>Total: <?= $total ?>€</h2>
    </div>
    <div style="display: flex; justify-content:flex-end; width:100%;align-items: center;">

    </div>
    <div style="display: flex; justify-content:flex-end; width:100%">
        
            <button type="submit" id="checkout-button" class="primary-button"><i class="fa-solid fa-circle-check"></i> Proceder al pago</button>
        
    </div>
</div>