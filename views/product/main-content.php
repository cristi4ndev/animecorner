<div id="main-content-product">
    <?php if (!$product) show_error();?>

    <div class="product-image">
        <img src="<?=base_url?>uploads/images/products/<?=$product['image']?>">
    </div>
    <div class="product-info">
        <div><h1><?=$product['name']?></h1></div>
        <div><span>Ref: <?=$product['ref']?></span></div>
        <div>
            <h2>Descripción</h2>
            <p><?=$product['description']?> </p>
        </div>
        <div><span style="font-style: italic; font-size:50px;"><?=$product['price']?>€</span></div>
        <div><button style="font-size: 20px;" class="primary-button"><i class="fa-solid fa-cart-plus"></i>Añadir al carrito</button></div>
        <div class="details">
        <h2>Detalles</h2>
        <table class="details-table">
            <tbody>

            
            <tr>
                <th>SAGA</th>
                <th>PERSONAJES</th>
            </tr>
            <tr>
                <td><?=$product['saga_id']?></td>
                <td>Namie, Usuff, Luffy, Zoro</td>
            </tr>
            </tbody>
           

        </table>
    </div>
    </div>
    
</div>
