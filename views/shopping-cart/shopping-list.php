<h1>Carrito de Compras</h1>
<div style="display: flex; justify-content:flex-end; width:100%; margin-bottom:10px;">
    <a href="<?=base_url?>shoppingcart/delete">
        <button id="checkout-button" class="secondary-button"><i class="fa-solid fa-eraser"></i>Vaciar carrito</button>
    </a>
</div>
<table id="cart-table">
    <tr>
        <th>Referencia</th>
        <th>Imagen</th>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Subtotal</th>
        <th>Borrar</th>
    </tr>

    <?php
    foreach ($_SESSION['cart'] as $product) {
        echo "
            <tr>
                <td>" . $product['ref'] . "</td>
                <td><img src='" . base_url . "uploads/images/products/" . $product['image'] . "'></td>
                <td>" . $product['name'] . "</td>
                <td>
                    <a href='" . base_url . "shoppingcart/remove&id=" . $product['id'] . "'>
                        <button class='delete-button'><i class='fa-solid fa-minus'></i></button>
                    </a>"
            . $product['quantity'] .
            "<a href='" . base_url . "shoppingcart/add&id=" . $product['id'] . "'>
                        <button class='delete-button'><i class='fa-solid fa-plus'></i></button>
                    </a>
                    
                </td>
                <td>" . $product['price'] . "</td>
                <td>" . $product['subtotal']  . "</td>
                <td><a href='" . base_url . "shoppingcart/delete&id=" . $product['id'] . "' class'button delete-button'><i class='fa-solid fa-trash-can'></i></a></td>
            </tr>
            
            
            ";
    }
    ?>

</table>
<div id="summary-cart">
    <div id="cart-total">
        <h3>Total: </h3><?= ShoppingCartController::total() ?>€
    </div>
    <div style="display: flex; justify-content:flex-end; width:100%;align-items: center;">
    
    </div>
    <div style="display: flex; justify-content:flex-end; width:100%">
    <a href="<?=base_url?>shoppingcart/checkout">
        <button id="checkout-button" class="primary-button"><i class="fa-solid fa-credit-card"></i> Realizar pedido</button>
    </a>
        
    </div>
</div>