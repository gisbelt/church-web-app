$(document).ready(function () {
    listaPermisos();


    // Registrar rol o permisos
    $('#form-registrar-permisos').submit(function (e) {
        e.preventDefault();
        $button = $('#agregar-permisos-rol');
        $button.disabled = true;
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
        }).done(function (response) {
            if (response.code == 422) {
                let html = '<ul>';
                $.each(response.messages, function (index, value) {
                    html += '<li>' + value + '</li>';
                });
                html += '</ul>';

                swal.fire({
                    title: response.title,
                    html: html,
                    icon: 'error',
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonText: 'close'
                });
                $button.disabled = false;
            } else {
                swal.fire({
                    title: response.title,
                    html: response.messages,
                    icon: 'success',
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonText: 'close'
                });
                $("#form-registrar-permisos")[0].reset();
                $button.disabled = false;
            }
        }).fail(function (json) {
            console.log(JSON.parse(json));
        });
    });
});

const listaPermisos = function (){
    let $table = $("#permisos-table");
    $table.DataTable({
        "ajax": {
            "url": $table.data("route"),
            "dataSrc": "permisos"
        },
        "columns": [
            {"data": "permiso_nombre"},
            {"data": "actions", "className": "text-right"},
        ]
    })
}