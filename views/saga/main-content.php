<div id="main-content-category">
    <?php 
    if ($products) {
        foreach ($products as $product) {
            echo '
            <article class="article-list">
                <img src="' . $product["image"] . '" class="article-list-image">
                <h3 class="article-list-name">' . $product["name"] . '</h3>
                <div class="article-list-price">
                    <span>' . $product["price"] . '</span><span class="currency">€</span>
                </div>
            </article>
            ';
        }
    } else {
        echo "<p>No existen productos para esta saga.</p>";
    }
    
    ?>
</div>
