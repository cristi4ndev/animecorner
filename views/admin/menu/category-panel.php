<div id="category-panel">
    <div id="create-block">
        <h3>Crear nuevo transportista</h3>
        <form method="POST" action="<?= base_url ?>admin/create" class="st2-form">


           
                <div style="display: none;" class="st2-form-group">
                    <label for="entity">Entidad</label>
                    <input value="carrier" type="hidden" name="entity" required>
                </div>
                <div class="st2-form-group">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" required>
                </div>
                <div class="st2-form-group">
                    <label for="price">Precio</label>
                    <input type="number" name="price" required>
                </div>
                



                <button class="primary-button" type="submit"><i class="fa-solid fa-circle-plus"></i>Crear</button>
           
            



            
        </form>
        

    </div>

</div>