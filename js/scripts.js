const form = document.getElementById('login-form');
const emailInput = document.getElementById('email');

let data = JSON.parse(sessionStorage.getItem('formData')) || [];

if (form){ 
form.addEventListener("submit",function (event) {
const email = emailInput.value;   
if(email){
const newData = email;
data.push(newData);
saveDataToLocalStorage();
window.location ="login.php";
}else{
alert('Todos los datos son obligatorios')
}
})
}

function saveDataToLocalStorage() {
sessionStorage.setItem('formData',JSON.stringify(data));
}

$(document).ready(function() {
    var table = $('#archivosTable').DataTable({
        "ajax": {
            "url": "php/publicaciones.php",
            "dataSrc": function(json) {
                return json.data || [];
            }
        },
        "columns": [
            { "data": "titulo" },
            { "data": "tamano" },
            { "data": "usuario" },
            { 
                "data": null,
                "render": function(data, type, row) {
                    // Comprobar si el ID del usuario que subió el archivo coincide con el ID del usuario en sesión
                    var deleteButton = (row.id_usuario === idUsuarioSesion) ? 
                        `<button class="btn btn-danger btn-sm delete-btn" data-id="${row.id_archivo}">Eliminar</button>` : 
                        '';

                    return `<a href="php/descargar.php?id=${row.id_archivo}" class="btn btn-primary btn-sm download-btn">Descargar</a>
                            <button class="btn btn-secondary btn-sm preview-btn" data-id="${row.id_archivo}">Previsualizar</button>
                            ${deleteButton}`;
                }
            }
        ]
    });


    $('#archivosTable_filter').hide();


    // Búsqueda personalizada
    $('#search-btn').on('click', function() {
        performSearch(table);
    });

    $('#search-input').on('keypress', function(e) {
        if (e.which == 13) { // Tecla Enter
            performSearch(table);
        }
    });

    // Pasar table como parámetro a la función
    function performSearch(dataTable) {
        var searchTerm = $('#search-input').val().toLowerCase();
        
        // Filtrar en todas las columnas
        dataTable.columns().every(function() {
            this.search('', true, false);
        });

        dataTable.search(searchTerm).draw();
    }

    // Manejador de eventos para descargas
    $(document).on('click', '.download-btn', function(e) {
        e.preventDefault();
        
        var url = $(this).attr('href');
        var id = $(this).data('id');
        var nombreArchivo = $(this).data('nombre');
        
        console.log("Descargando archivo:", {
            url: url,
            id: id,
            nombreArchivo: nombreArchivo
        });
        
        if (!id) {
            alert("ID de archivo no válido");
            return;
        }
        
        $.ajax({
            url: url,
            method: 'GET',
            xhrFields: {
                responseType: 'blob'
            },
            success: function(data, status, xhr) {
                console.log("Descarga exitosa");
                var filename = nombreArchivo || 'documento.pdf';
                var type = xhr.getResponseHeader('Content-Type') || 'application/pdf';
                var blob = new Blob([data], { type: type });
                
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = filename;
                link.click();
            },
            error: function(xhr, status, error) {
                console.error("Error al descargar:", {
                    status: status,
                    error: error,
                    responseText: xhr.responseText
                });
                alert("No se pudo descargar el archivo. Detalles: " + error);
            }
        });
    });
});
$('#clear-search-btn').on('click', function() {
    $('#search-input').val('');
    table.search('').draw();
});
$(document).on('click', '.preview-btn', function() {
    var id = $(this).data('id');
    var url = `php/descargar.php?id=${id}`; // Asegúrate de que esta URL sea correcta
    
    // Cargar el PDF en el iframe
    $('#pdfViewer').attr('src', url);
    
    // Mostrar el modal
    $('#pdfModal').modal('show');
});
$(document).on('click', '.delete-btn', function() {
    var id = $(this).data('id');
    
    // Usar SweetAlert2 para la confirmación
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Este cambio no puede deshacerse.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Si el usuario confirma, proceder a eliminar
            $.ajax({
                url: 'php/eliminar.php',
                method: 'POST',
                data: { id: id },
                dataType: 'json',
                success: function(response) {
                    // Manejar la respuesta del servidor
                    if (response.status === 'success') {
                        Swal.fire(
                            'Eliminado!',
                            'El archivo ha sido eliminado.',
                            'success'
                        );
                        location.reload();
                    } else {
                        Swal.fire(
                            'Error!',
                            'Error al eliminar el archivo: ' + response.message,
                            'error'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire(
                        'Error!',
                        'Error en la solicitud: ' + error,
                        'error'
                    );
                }
            });
        }
    });
});