<h1>Carrito de Compras</h1>
<table id="cart-table">
    <tr>
        <th>Referencia</th>
        <th>Imagen</th>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Subtotal</th>
    </tr>

    <?php 
        foreach($_SESSION['cart'] as $product) {
            echo "
            <tr>
                <td>". $product['ref'] ."</td>
                <td><img src='". base_url . "uploads/images/products/" . $product['image'] ."'></td>
                <td>". $product['name'] ."</td>
                <td>". $product['quantity'] ."</td>
                <td>". $product['price'] ."</td>
                <td>". $product['subtotal']  ."</td>
            </tr>
            
            
            ";
        }
    ?>
    
</table>