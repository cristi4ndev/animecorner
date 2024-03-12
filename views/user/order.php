<div id="account-content">
    <?= require_once 'views/user/category-block.php';
    if (isset($_SESSION['error'])) echo "<p> {$_SESSION['error']} </p>"
    ?>

    <div id="main-content-account">

        <div id="order-container">
            <h1>Pedido Nº <?= $order['id'] ?> - realizado el <?= $order['created_at'] ?></h1>
            <div class="flex">
                <div id="delivery-address">
                    <div>
                        <h3>Dirección de envío</h3>
                        <div><?= $order['address'] ?></div>
                        <div><?= $order['postal_code'] ?></div>
                        <div><?= $order['locality'] ?></div>
                        <div><?= $order['province'] ?></div>
                        <div><?= $order['country'] ?></div>
                        <div><?= $order['phone'] ?></div>
                    </div>

                </div>
                <div>
                    <div>
                        <div>
                            <strong>Fecha</strong>
                        </div>
                        <div>
                            <?= $order['created_at'] ?>
                        </div>
                    </div>
                    <div>
                        <div>
                            <strong>Estado</strong>
                        </div>
                        <div>
                            <?php echo Utils::printOrderStatus($order['status']) ?>
                        </div>
                    </div>
                    <div>
                        <div>
                            <strong>Transportista</strong>
                        </div>
                        <div>
                            <?= $order['carrier_name'] ?>
                        </div>
                    </div>
                    <div>
                        <div>
                            <strong>Precio</strong>
                        </div>
                        <div>
                            <?= $order['carrier_price'] ?>
                        </div>
                    </div>
                </div>
                
            </div>
            <div>

                <div>
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
                        foreach ($products as $product) {
                            echo "
                                    <tr>
                                        <td>" . $product['ref'] . "</td>
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
                            <h3>Total Productos: </h3><?= $order['total_prods'] ?>€
                        </div>
                        <div class="flex">
                            <h3>Transporte: </h3><?= $order['carrier_price'] ?>€
                        </div>
                        <div class="flex">
                            <h2>Total: <?= $order['total'] ?>€</h2>
                        </div>

                    </div>
                </div>



            </div>

        </div>
    </div>