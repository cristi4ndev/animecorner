<div id="main-content-category">
    <?php
    if ($products) {
        foreach ($products as $product) {
            echo '
            <article class="article-list">
                <a href="' . base_url . 'product/&id=' . $product['id'] . '"><img src="' . base_url . 'uploads/images/products/' .  $product["image"] . '" class="article-list-image"></a>
                <a href="' . base_url . 'product/&id=' . $product['id'] . '"><h3 class="article-list-name">' . $product["name"] . '</h3></a>
                <div class="article-list-price">
                    <span>' . $product["price"] . '</span><span class="currency">€</span>
                </div>
                <div>
                    <button class="primary-button"><i class="fa-solid fa-cart-plus"></i>Añadir al carrito</button>
                </div>
            </article>
            ';
        }
    } else {
        echo "<h1 style='text-align:center; grid-column-start: span 5;'><strong>No existen</strong> productos para esta categoría.</h1>";
    }

    ?>
</div>