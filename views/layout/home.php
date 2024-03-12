<div id="content-home">
    <div id="carrousel" class="image-slider">
        <img  src="./uploads/images/home/image-slider/onepiece.png" />
        <img  src="./uploads/images/home/image-slider/naruto.png" />
        <img  src="./uploads/images/home/image-slider/goku.png" />
       
    </div>
    
    <h2 class="h2-block">Categorías <strong>destacadas</strong> </h2>
    <div class="homepage-grid">
        <div id="figuras">
            <img src="./uploads/images/home/figuras.jpg">
        </div>
        <div id="goku">
            <img src="./uploads/images/home/goku.png">

        </div>
        <div id="onepiece">
            <img src="./uploads/images/home/onepiece.png">
        </div>
        <div id="mochilas">
            <img src="./uploads/images/home/mochilas.png">
        </div>
        <div id="funkos">
            <img src="./uploads/images/home/funkos.png">
        </div>
        <div id="alfombrillas">
            <img src="./uploads/images/home/alfombrillas.png">
        </div>
        <div id="camisetas">
            <img src="./uploads/images/home/camisetas.jpg">
        </div>
        <div id="sudaderas">
            <img src="./uploads/images/home/sudaderas.png">
        </div>
        <div id="gorras">
            <img src="./uploads/images/home/gorras.jpg">
        </div>
        <div id="disfraces">
            <img src="./uploads/images/home/cosplay.jpg">
        </div>
        <div id="tazas">
            <img src="./uploads/images/home/tazas.jpg">
        </div>
        <div id="posters">
            <img src="./uploads/images/home/posters.jpg">
        </div>
        
        <div></div>
    </div>


    <h2 class="h2-block">Últimos <strong>productos añadidos</strong> </h2>
    <section class="products-list" id="last-added-products">

        <div class="product-listing">
            <?php foreach ($products as $product) 
            
            echo '
            <div>
                <article class="article-list">
                    <img src="' .base_url . 'uploads/images/products/'. $product['image'] .'" class="article-list-image">
                    <h3 class="article-list-name">'.$product['name'].'</h3>
                    <div class="article-list-price">
                        <span>'.$product['price'].'€</span>
                    </div>
                </article>
            </div>
            
            
            '
            
            ?>
            
            

        </div>


    </section>




</div>