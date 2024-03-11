<div id="account-content">
    <?= require_once 'views/user/category-block.php' ;
    if (isset($_SESSION['error'])) echo "<p> {$_SESSION['error']} </p>"
    ?>

    <div id="main-content-account">
        
        <div id="orders-container">
            <div><h1>Mis direcciones</h1></div>
        
        <div id="orders-list">
            <table>
                <tr>
                    <th>Nº Pedido</th>
                    <th>Fecha</th>
                    <th>Nº Productos</th>
                    <th>Forma de Pagp</th>
                    <th>Total</th>
                </tr>
            <?php 
               
                foreach ($my_orders as $order) {
                   
                    echo '
                    <tr>
                        <td>'.$order["id"].'</td>
                        <td>'.$order["created_at"].'</td>
                        <td>'.$order["prods"].'</td>
                        <td>'.$order["payment_method"].'</td>
                        <td>'.number_format($order["total"],2).'</td>
                    </tr>
                                        
                    ';
                    
                }

            ?>
            </table>
        </div>
        </div>
    </div>
    </div>

    