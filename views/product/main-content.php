<div id="main-content-product">
    <?php if (!$product) show_error(); ?>

    <div class="product-image">
        <img src="<?= base_url ?>uploads/images/products/<?= $product[0]['image'] ?>">
    </div>
    <div class="product-info">
        <div>
            <h1><?= $product[0]['name'] ?></h1>
        </div>
        <div><span>Ref: <?= $product[0]['ref'] ?></span></div>
        <div>
            <h2>Descripción</h2>
            <p><?= $product[0]['description'] ?> </p>
        </div>
        <div><span style="font-style: italic; font-size:50px;"><?= $product[0]['price'] ?>€</span></div>
        <div>
            <a href="<?= base_url ?>shoppingcart/add&id=<?= $product[0]['id'] ?>&image=<?= $product[0]['image'] ?>&name=<?= $product[0]['name']?>&ref=<?=$product[0]['ref']?>&price=<?=$product[0]['price']?>">
                <button style="font-size: 20px;" class="primary-button">
                    <i class="fa-solid fa-cart-plus"></i>Añadir al carrito
                </button>
            </a>
        </div>
        <div class="details">
            <h2>Detalles</h2>
            <table class="details-table">
                <tbody>


                    <tr>
                        <th>SAGA</th>
                        <th>PERSONAJES</th>
                    </tr>
                    <tr>
                        <td><a href="<?= base_url ?>saga/&id=<?= $product[0]['saga_id'] ?>"><?= $product[0]['saga_name'] ?></a></td>
                        <td>
                            <ul>
                                <?php
                                foreach ($product as $char) {
                                    echo "<li><a href='" . base_url . "saga/&id=" . $char['saga_id'] . "&character=" . $char['char_id'] . "'>" . $char['char_name'] . "</a></li>";
                                }
                                ?>
                            </ul>
                        </td>
                    </tr>
                </tbody>


            </table>
        </div>
    </div>

</div>