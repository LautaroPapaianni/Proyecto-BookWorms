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
    // Declarar table en el ámbito correcto
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
                    return `<a href="php/descargar.php?id=${row.id_archivo}" 
                            class="btn btn-primary btn-sm download-btn" 
                            data-id="${row.id_archivo}" 
                            data-nombre="${row.titulo}">Descargar</a>`;
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