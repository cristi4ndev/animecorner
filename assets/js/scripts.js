document.addEventListener("DOMContentLoaded", function() {
    var botonesEditar = document.querySelectorAll('.edit-address');
    botonesEditar.forEach(function(boton) {
        boton.addEventListener('click', function(event) {
            // Evitar que el formulario se envíe al hacer clic en el botón
            event.preventDefault();
            
            // Obtener el formulario asociado al botón actual
            var formulario = boton.closest('form');
            
            // Obtener todos los inputs dentro del formulario
            var inputs = formulario.querySelectorAll('input');
            
            // Iterar sobre cada input y alternar el atributo 'disabled'
            inputs.forEach(function(input) {
                input.disabled = !input.disabled;
            });

            // Mostrar el botón de guardar
            var guardar = formulario.querySelector('#update-address');
            if (guardar.style.display=='block') {
                guardar.style.display = 'none';
            }
            else {
                guardar.style.display = 'block';
            }
            
        });
    });
});
