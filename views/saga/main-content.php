<div id="main-content-category">
    <?php 
    if ($products) {
        foreach ($products as $product) {
            echo '
            <article class="article-list">
                <img src="' . base_url . 'uploads/images/products/' . $product["image"] . '" class="article-list-image">
                <h3 class="article-list-name">' . $product["name"] . '</h3>
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
        echo "<h1 style='text-align:center; grid-column-start: span 5;'><strong>No existen</strong> productos para esta saga.</h1>";
    }
    
    ?>
</div>
