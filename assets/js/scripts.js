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

    // Referencia al carrusel
    var carousel = document.querySelector('.carousel');
    // Referencia al intervalo del carrusel
    var carouselInterval;

    // Función para iniciar el carrusel
    function startCarousel() {
        carouselInterval = setInterval(() => {
            carousel.scrollLeft += 1; // Cambia el valor de desplazamiento horizontal
        }, 10); // Ajusta la velocidad del carrusel
    }

    // Función para detener el carrusel
    function stopCarousel() {
        clearInterval(carouselInterval);
    }

    // Inicia el carrusel automáticamente cuando se carga la página
    startCarousel();

    // Detiene el carrusel cuando el ratón se coloca sobre él
    carousel.addEventListener('mouseenter', stopCarousel);

    // Reanuda el carrusel cuando el ratón se retira del elemento
    carousel.addEventListener('mouseleave', startCarousel);
});
