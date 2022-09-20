$(document).ready(function () {
    listaPermisos();
    eliminarPermiso();


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
        ],
        "initComplete": function () {
            api = this.api();
            api.buttons().container()
                .appendTo($('#table-buttons'));
                eliminarPermiso();
        }
    })
}

const eliminarPermiso = function(){
    $(document).on('click', '#eliminar-permiso', function (e) {
        e.preventDefault();
        //route = `${$table.data('route')}?currency=${currency}&provider=${provider}`;
        //let id = $(this).data('id');
        let route = $(this).data('route');
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esto.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar',
            preConfirm: () => {
                return fetch(route)
                    .then(response => {
                        if (!response.ok) {
                            response.json().then(json => {
                                swal.fire({
                                    title: json.title,
                                    text: json.message,
                                    type: 'error',
                                    showConfirmButton: false,
                                    showCancelButton: true,
                                    cancelButtonText: '<i class="hs-admin-close"></i> ' + json.data.close
                                });
                            });
                        }
                        return response.json();
                    });
            },
        }).then((result) => {
            if (result.value.code == 200) {
                Swal.fire(
                    result.value.title,
                    result.value.messages,
                    'success'
                )
            }
        })
    });
}