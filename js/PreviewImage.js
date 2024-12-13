document.getElementById('formFile').addEventListener('change', function (event) {
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = ''; // Limpiar previsualizaciones anteriores
    const files = event.target.files;
    
    Array.from(files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function (e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.alt = file.name;
            img.className = 'img-thumbnail';
            img.style.width = '100px';
            img.style.height = '100px';
            preview.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
});


function cerrarYMostrarModal(tipo) {
    // Cierra el modal "Agregar Producto"
    $('#agregarProducto').modal('hide');

    if (tipo === 'exito') {
        $('#modalExito').modal('show');
    } else if (tipo === 'error') {
        $('#modalError').modal('show');
    }
}

