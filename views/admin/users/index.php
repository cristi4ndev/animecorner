<div id="account-content">
    <?php require_once 'views/admin/category-block.php' ?>

    <div id="main-content-account">
        <table id='cart-table'>
            <tr>
                <th>id</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Rol</th>
                <th>Total de pedidos</th>
                <th>Total gastado</th>
            </tr>

            <?php
            foreach ($user_list as $user) {
                echo "  
                                       
                        <tr onclick='window.location=\"" . base_url . "admin/users&id=". $user['id']."\";' style='cursor:pointer;'> 
                            <td>{$user['id']}</td>
                            <td>{$user['name']}</td>
                            <td>{$user['surname']}</td>
                            <td>{$user['role']}</td>
                            <td>{$user['num_orders']}</td>
                            <td>" . (isset($user['total']) ? $user['total'] : '0') . "€</td>

                        </tr>   
                                
                    ";
            }

            ?>


        </table>
    </div>
</div>