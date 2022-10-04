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
        let tr = $(this).parents("tr");
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
                tr.remove();
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
                let html = '<ul class="list-group list-group-flush">';
                $.each(response.messages, function (index, value) {
                    html += '<li class="list-group-item">' + value + '</li>';
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
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        "initComplete": function () {
            let api = this.api();
            api.buttons().container()
                .appendTo($('#table-buttons'));
            eliminarDonacion();
            observacion_donacion();
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
            if (response.code == 422) {
                let html = '<ul class="list-group list-group-flush">';
                $.each(response.messages, function (index, value) {
                    html += '<li class="list-group-item">' + value + '</li>';
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
                $("#form-registrar-donacion")[0].reset();
                $button.disabled = false;
            }
        }).fail(function (json) {
            console.log(JSON.parse(json));
        });
    });
}

// Registrar donacion
const observacion_donacion = function () {
    let $button = $('#guardar_observacion_donacion');
    let $form = $('#form-registrar-observacion-donacion');
    let $modal = $('#observacion_donacion');

    $modal.on('show.bs.modal', function(event) {
        let $target = $(event.relatedTarget);
        $('#donacion_id').val($target.data('donacion'));
    })

    $button.click(function () {
        $('#guardar_observacion_donacion').disabled = true;
        $.ajax({
            url: $form.attr('action'),
            method: $form.attr('method'),
            data: $form.serialize(),
            dataType: 'json',
        }).done(function (response) {
            if (response.code == 422) {
                let html = '<ul class="list-group list-group-flush">';
                $.each(response.messages, function (index, value) {
                    html += '<li class="list-group-item">' + value + '</li>';
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
                $('#guardar_observacion_donacion').disabled = false;
            } else {
                swal.fire({
                    title: response.title,
                    html: response.messages,
                    icon: 'success',
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonText: 'close'
                });
                $("#form-registrar-observacion-donacion")[0].reset();
                $('#guardar_observacion_donacion').disabled = false;
            }
        }).fail(function (response) {
            console.log(JSON.parse(response));
        })
    });
}