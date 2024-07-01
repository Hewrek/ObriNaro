// agregar_al_carrito.js

function agregarAlCarrito(idProducto) {
    // Obtener el formulario y el ID del producto
    var form = document.getElementById('formAgregarCarrito_' + idProducto);
    var idProducto = form.querySelector('input[name="id_producto"]').value;


    // Crear una nueva instancia de XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Configurar la solicitud AJAX
    xhr.open('POST', form.action, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    // Manejar la respuesta
    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 400) {
            // Éxito en la solicitud
            console.log(xhr.responseText); // Puedes mostrar un mensaje de éxito si lo deseas

            // Mostrar notificación Toastify
            Toastify({
                text: "Producto agregado",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true, 
                style: {
                    background: "linear-gradient(to right, #4caf50, #c2e8b6)",
                    borderRadius: "2rem",
                    textTransform: "uppercase",
                    fontSize: ".75rem"
                },
                offset: {
                    x: '1.5rem', 
                    y: '1.5rem'
                },
                onClick: function(){}
            }).showToast();

            // Opcional: Actualizar el contenido del carrito o realizar otra acción necesaria

        } else {
            // Error en la solicitud
            console.error('Error al agregar al carrito');
        }
    };

    // Enviar la solicitud con los datos del formulario
    xhr.send('id_producto=' + encodeURIComponent(idProducto));
}
