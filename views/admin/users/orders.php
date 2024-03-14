<div id="account-content">
    <?= require_once 'views/admin/category-block.php' ;
    if (isset($_SESSION['error'])) echo "<p> {$_SESSION['error']} </p>"
    ?>

    <div id="main-content-account">
        
        <div id="orders-container">
            <div><h1>Pedidos del usuario</h1></div>
            <div id="orders-list">
        
            <?php 
                if ($my_orders) {
                    echo '
                    
                 
                        <table id="cart-table">
                            <tr>
                                <th>Nº Pedido</th>
                                <th>Fecha</th>
                                <th>Nº Productos</th>
                                <th>Forma de Pago</th>
                                <th>Estado</th>
                                <th>Total</th>
                            </tr>
                    
                    ';
                    foreach ($my_orders as $order) {
                                     
                   
                        echo '
                        
                        <tr style="cursor:pointer" onClick="window.location=\''. base_url . 'admin/order&id='. $order['id'] .'\';">
                            
                            <td><a href=#>'.$order["id"].'</a></td>
                            <td>'.$order["created_at"].'</td>
                            <td>'.$order["prods"].'</td>
                            <td>'.$order["payment_method"].'</td>
                            <td>'.Utils::printOrderStatus($order["status"]).'</td>
                            <td>'.number_format($order["total"],2).'€</td>
                            
                        </tr>
                        
                                            
                        ';
                    }
                } else {
                    echo "<h2>El usuario <strong>no tiene</strong> pedidos</h2>";
                }
                

            ?>
            </table>
        </div>
        </div>
    </div>
    </div>

    