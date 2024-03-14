<div id="account-content">
    <?= require_once 'views/admin/category-block.php' ?>

    <div id="main-content-account">

        <div id="order-container">
            <h1>Pedido Nº <?= $order['id'] ?> - realizado el <?= $order['created_at'] ?></h1>
            <div class="flex" style="align-items: flex-start; gap:20px">
                <div style="width: 100%;">
                    <div >
                        <div>
                            <strong><i class="fa-solid fa-location-dot"></i>Dirección de envío</strong>
                            <hr>

                            <span><?= $order['address'] ?></span>
                            <span><?= $order['postal_code'] ?></span>
                            <br>
                            <span><?= $order['locality'] ?></span>
                            <span><?= $order['province'] ?></span>
                            <span><?= $order['country'] ?></span>
                            <br>
                            <span><?= $order['phone'] ?></span>
                        </div>
                    </div>
                    <div>
                        <div>
                            <strong><i class="fa-solid fa-user"></i></i>Datos de usuario</strong>
                            <hr>

                            <span><?= $order['user_name'] ?></span>
                            <span><?= $order['user_surname'] ?></span>
                            <br>
                            <span><?= $order['user_dni'] ?></span>
                            <br>
                            <span><?= $order['user_email'] ?></span>
                        </div>

                    </div>
                    <div id="head-info">
                        <div>
                            <div>
                                <strong><i class="fa-solid fa-calendar-days"></i>Fecha</strong>
                            </div>
                            <hr>
                            <div>
                                <?= $order['created_at'] ?>
                            </div>
                        </div>
                        <div>
                            <div>
                                <strong><i class="fa-solid fa-signs-post"></i>Estado</strong>
                            </div>
                            <hr>
                            <div>
                                <form method="POST" action="<?= base_url ?>admin/edit&entity=order&id=<?= $order['id'] ?>">
                                    <select name="status" id="status">
                                        <option <?= ($order['status'] == "pedido confirmado") ? "selected" : '' ?> value="pedido confirmado">Pedido Confirmado</option>
                                        <option <?= ($order['status'] == "enviado") ? "selected" : '' ?> value="enviado">Enviado</option>
                                        <option <?= ($order['status'] == "entregado") ? "selected" : '' ?> value="entregado">Entregado</option>
                                        <option <?= ($order['status'] == "cancelado") ? "selected" : '' ?> value="cancelado">Cancelado</option>
                                    </select>

                                    <button style="margin:0px;padding:0px;padding-right:5px;padding-left:5px" type="submit" class="primary-button">Cambiar</button>

                            </div>
                        </div>
                        <div>
                            <div>
                                <strong><i class="fa-solid fa-truck"></i>Transportista</strong>
                            </div>
                            <hr>
                            <div>
                                <?= $order['carrier_name'] ?>
                            </div>
                        </div>
                        <div>
                            <div>
                                <strong><i class="fa-solid fa-cart-shopping"></i>Productos Comprados</strong>
                            </div>
                            <hr>
                            <div>
                                <?= $order['prods'] ?>
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


    </div>