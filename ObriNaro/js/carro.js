function confirmarVaciarCarrito(event) {
    event.preventDefault(); // Evita el envío automático del formulario

    Swal.fire({
        title: '¿Estás seguro?',
        text: "Esto vaciará todo tu carrito de compras",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, vaciar carrito',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('formVaciarCarrito').submit(); // Envía el formulario manualmente
        }
    });
}

