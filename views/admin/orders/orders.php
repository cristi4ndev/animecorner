<div id="account-content">

    <?php require_once 'views/admin/category-block.php'; ?>
    <div id="main-content-account">

        <div id="orders-container">
            <div>
                <h1>Pedidos</h1>
            </div>

            <div id="orders-list">
                <table id="cart-table">
                    <tr>
                        <th>Nº Pedido</th>
                        <th>Fecha</th>
                        <th>Nº Productos</th>
                        <th>Forma de Pago</th>
                        <th>Estado</th>
                        <th>Total</th>
                    </tr>
                    <?php

                    foreach ($orders as $order) {


                        echo '
                    
                    <tr style="cursor:pointer" onClick="window.location=\'' . base_url . 'admin/order&id=' . $order['id'] . '\';">
                        
                        <td><a href=#>' . $order["id"] . '</a></td>
                        <td>' . $order["created_at"] . '</td>
                        <td>' . $order["prods"] . '</td>
                        <td>' . $order["payment_method"] . '</td>
                        <td>' . Utils::printOrderStatus($order["status"]) . '</td>
                        <td>' . number_format($order["total"], 2) . '€</td>
                        
                    </tr>
                    
                                        
                    ';
                    }

                    ?>
                </table>
            </div>
        </div>
    </div>
</div>