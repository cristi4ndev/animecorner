<div class="edit-category-block" style="display: none;">
    <h3>Modificar Saga</h3>
    <form method="POST" action="<?= base_url . 'admin/edit&entity=saga' . '&id=' . $saga['id'] ?>" class="st2-form">
        
        <div class="st2-form-group">
            <label for="name">Nombre</label>
            <input value="<?=$saga['name']?>" type="text" name="name" required>
        </div>
        

        <button class="primary-button" type="submit"><i class="fa-solid fa-circle-plus"></i>Guardar</button>
    </form>
    <?php if (isset($_SESSION['error'])) echo $_SESSION['error']; ?>

</div>