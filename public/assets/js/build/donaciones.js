$(document).ready(function () {
    //permisos
    listaDonaciones();
    eliminarDonacion();
    registrarDonacion();
    actualizarDonacion();

});

const eliminarDonacion = function () {
    $(document).on('click', '#eliminar-donacion', function (e) {
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

const actualizarDonacion = function () {
    let $button = $('#actualizar-donacion');
    $button.click(function (e) {
        e.preventDefault();
        let $form = $('#form-actualizar-donacion');
        $button.disabled = true;
        $.ajax({
            type: $form.attr('method'),
            url: $form.attr('action'),
            data: $form.serialize(),
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
}

const listaDonaciones = function () {
    let $table = $("#donaciones-table");
    $table.DataTable({
        "ajax": {
            "url": $table.data("route"),
            "dataSrc": "donaciones"
        },
        "columns": [
            {"data": "detalles"},
            {"data": "nombre_completo"},
            {"data": "cantidad"},
            {"data": "disponible"},
            {"data": "actions", "className": "center"},
        ],
        "initComplete": function () {
            api = this.api();
            api.buttons().container()
                .appendTo($('#table-buttons'));
            eliminarDonacion();
        }
    })
}

// Registrar donacion
const registrarDonacion = function () {
    let $button = $('#guardar_donacion');
    $button.click(function (e) {
        e.preventDefault();
        let $form = $('#form-registrar-donacion');
        $button.disabled = true;
        $.ajax({
            type: $form.attr('method'),
            url: $form.attr('action'),
            data: $form.serialize(),
            dataType: 'json',
        }).done(function (response) {
            console.log(response)
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
}