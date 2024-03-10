<div id="checkout-content">

    <div id="checkout">

        <div id="order-config">
            <h2>Configurar pedido</h2>
            <form method="POST" action="<?= base_url ?>order/create">
                <!-- Serializamos lo que tenemos el carrito para poder enviar por POST el array de productos de manera invisible -->
                <input required type="hidden" name="cart" value="<?php echo  base64_encode(serialize($_SESSION['cart'])); ?>">
                <fieldset>
                    <legend><i class="fa-solid fa-map-location-dot"></i>Dirección de envío</legend>
                    <select required name="address">
                        <?php

                        if ($addresses) {
                            foreach ($addresses as $address) {
                                if (isset($_GET['address']) && $_GET['address'] == $address['id']) {
                                    $selected = "selected";
                                } else $selected = "";
                                echo '<option ' . $selected . ' value="' . $address['id'] . '">' . $address['alias'] . '</option>';
                            }
                        }

                        ?>

                    </select>

                    <a style="color:#FF5757" href="<?= base_url ?>user/addresses">Crear nueva dirección</a>
                </fieldset>
                <fieldset>
                    <legend><i class="fa-solid fa-truck"></i>Transportista</legend>
                    <script>
                        function reload(carrier, id) {
                            addressValue = document.getElementsByName("address");
                            address = (addressValue[0].value)
                            paymentMethod = document.getElementsByName("payment-method");
                            payment = '';
                            for (i=0; i<paymentMethod.length;i++){
                                if (paymentMethod[i].checked){
                                    payment = paymentMethod[i].value;
                                    console.log(paymentMethod[i]);
                                }
                            }
                            
                            window.location = "<?= base_url ?>shoppingcart/checkout&carrier=" + carrier + "&id=" + id + "&address=" + address + "&payment=" + payment;
                        }
                    </script>
                    <?php
                    if ($carriers) {

                        foreach ($carriers as $carrier) {
                            if (isset($_GET['id']) && $_GET['id'] == $carrier['id']) {
                                $checked = "checked";
                            } else $checked = "";
                            echo ' 
                            
                            <div onClick="reload(' . $carrier["price"] . ',' . $carrier["id"] . ')">
                            
                                <input required ' . $checked . ' type="radio" id="' . $carrier['id'] . '" name="carrier" value="' . $carrier['id'] . '" />
                               
                                <label for="' . $carrier['name'] . '">' . $carrier['name'] . ' : ' . $carrier['price']  . '€</label>
                                
                            </div>
                           
                            ';
                        }
                    }
                    ?>


                </fieldset>
                <fieldset>
                    <legend><i class="fa-solid fa-bag-shopping"></i>Método de pago</legend>
                    <?php
                    $creditcard = '';
                    $paypal = '';
                    $transfer = '';
                    if (isset($_GET['payment']) && ($_GET['payment'])=='credit-card') {

                        $creditcard = 'checked';
                    }
                    if (isset($_GET['payment']) && ($_GET['payment'])=='transfer') {

                        $transfer = 'checked';
                    }
                    if (isset($_GET['payment']) && ($_GET['payment'])=='paypal') {

                        $paypal = 'checked';
                    }

                    ?>
                    <div>

                        <input <?= $creditcard ?> required type="radio" id="credit-card" name="payment-method" value="credit-card" />

                        <label for="credit-card"><i class="fa-solid fa-credit-card"></i> Tarjeta de Crédito</label>

                    </div>
                    <div>
                        <input <?= $paypal ?> type="radio" id="paypal" name="payment-method" value="paypal" />
                        <label for="paypal"><i class="fa-brands fa-paypal"></i> Paypal</label>
                    </div>
                    <div>
                        <input <?= $transfer ?> type="radio" id="transfer" name="payment-method" value="transfer" />
                        <label for="transfer"><i class="fa-solid fa-money-bill-transfer"></i> Transferencia</label>
                    </div>



                </fieldset>


        </div>
        <div id="order-summary">
            <?php require_once 'views/shopping-cart/order-summary.php'; ?>
        </div>
        </form>

    </div>

</div>