<div id="checkout-content">

    <div id="checkout">
    
        <div id="order-config">
        <h2>Configurar pedido</h2>
            <form >
                <fieldset>
                    <legend><i class="fa-solid fa-map-location-dot"></i>Dirección de envío</legend>
                    <select name="address">
                        <?php

                        if ($addresses) {
                            foreach ($addresses as $address) {
                                echo '<option value="' . $address['id'] . '">' . $address['alias'] . '</option>';
                            }
                        }

                        ?>

                    </select>
                    
                    <a style="color:#FF5757" href="<?=base_url?>user/addresses">Crear nueva dirección</a>
                </fieldset>
                <fieldset>
                    <legend><i class="fa-solid fa-truck"></i>Transportista</legend>
                    <?php
                    if ($carriers) {
                        
                        foreach ($carriers as $carrier) {
                            if (isset($_GET['id'])&&$_GET['id']==$carrier['id']) {
                                $checked = "checked";
                            }else $checked = "";
                            echo ' 
                            
                            <div onClick="window.location = ' .'\''. base_url . 'shoppingcart/checkout&carrier='. $carrier["price"] . '&id='.$carrier['id'].'\';">
                            
                                <input ' . $checked .' type="radio" id="' . $carrier['id'] . '" name="carrier" value="' . $carrier['id'] . '" />
                               
                                <label for="' . $carrier['name'] . '">' . $carrier['name'] . ' | PRECIO: ' . $carrier['price']  .'€</label>
                                
                            </div>
                           
                            ';
                        }
                    }
                    ?>


                </fieldset>
                <fieldset>
                    <legend><i class="fa-solid fa-bag-shopping"></i>Método de pago</legend>
                    <div>
                        <input type="radio" id="credit-card" name="credit-card" value="credit-card" />
                        <label for="credit-card"><i class="fa-solid fa-credit-card"></i> Tarjeta de Crédito</label>
                    </div>
                    <div>
                        <input type="radio" id="paypal" name="paypal" value="paypal" />
                        <label for="paypal"><i class="fa-brands fa-paypal"></i> Paypal</label>
                    </div>
                    <div>
                        <input type="radio" id="transfer" name="transfer" value="transfer" />
                        <label for="transfer"><i class="fa-solid fa-money-bill-transfer"></i> Transferencia</label>
                    </div>
                    <div>


                </fieldset>

            
        </div>
        <div id="order-summary">
            <?php require_once 'views/shopping-cart/order-summary.php'; ?>
        </div>
        </form>

    </div>

</div>