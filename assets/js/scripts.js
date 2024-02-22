document.addEventListener("DOMContentLoaded", function () {
    // Selección de botones de edición de dirección
    var botonesEditar = document.querySelectorAll('.edit-address');
    botonesEditar.forEach(function (boton) {
        boton.addEventListener('click', function (event) {
            event.preventDefault();

            var formulario = boton.closest('form');
            var inputs = formulario.querySelectorAll('input');
            inputs.forEach(function (input) {
                input.disabled = !input.disabled;
            });

            var guardar = formulario.querySelector('.update-address');
            var editar = formulario.querySelector('.edit-address');
            toggleDisplay(guardar);
            toggleDisplay(editar);
        });
    });

    // Selección de botones de edición de categoría
    var editButtons = document.querySelectorAll('.edit-cat');

    editButtons.forEach(function (editButton) {
        editButton.addEventListener('click', function (event) {
            event.preventDefault();
            var editForm = editButton.closest('.table-rows').querySelector('.edit-category-block');
            editForm.style.display = 'block';
        });
    });

    // Función para alternar la visualización de un elemento
    function toggleDisplay(element) {
        if (element.style.display == 'block') {
            element.style.display = 'none';
        } else {
            element.style.display = 'block';
        }
    }

  
});
