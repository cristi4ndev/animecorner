const base_url = "http://localhost/animecorner/";

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

    // Función para alternar la visualización y la disponibilidad de un elemento
    function toggleDisplay(element) {
        if (element.style.display !== 'inline-block') {
            element.style.display = 'inline-block';
            element.disabled = false; 
        } else {
            element.style.display = 'none';
            element.disabled = true; 
        }
    }  


    //cargar los personajes dinámicamente según el select seleccionado por el usuario
    if (document.getElementById('saga')) {
    document.getElementById('saga').addEventListener('change', function() {
       
        var sagaId = this.value;
        var xhr = new XMLHttpRequest();
        
        xhr.open('GET', base_url + 'ajax/getCharacterById&ajax=true&id=' + sagaId, true);
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 400) {
                var characters = JSON.parse(xhr.responseText);
                var charactersDiv = document.getElementById('characters-container');
                charactersDiv.innerHTML = ''; // Limpiar contenido anterior
                characters.forEach(function(character) {
                    var checkbox = document.createElement('input');
                    checkbox.type = 'checkbox';
                    checkbox.id = character.id;
                    checkbox.value = character.id;
                    checkbox.name = "characters[]";
                    var label = document.createElement('label');
                    label.htmlFor = character.name;
                    label.textContent = character.name;
                    var div = document.createElement('div');
                    div.appendChild(checkbox);
                    div.appendChild(label);
                    charactersDiv.appendChild(div);
                });
            }else console.log("No he entrado")
        };
        xhr.send();
    });
    }

    

  
});
