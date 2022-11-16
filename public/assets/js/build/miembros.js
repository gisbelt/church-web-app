$(document).ready(function () {
    actualizarMiembro();
    registrarMiembros();
    listaMiembros();
});

// Actualizar miembros
const actualizarMiembro = () => {
    let $button = $('#actualizar-miembros');
    $button.click(function (e) {
        e.preventDefault();
        let $form = $('#form-editar-miembro');
        $('#actualizar-miembros').disabled = true;
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
                $('#actualizar-miembros').disabled = false;
            } else {
                swal.fire({
                    title: response.title,
                    html: response.messages,
                    icon: 'success',
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonText: 'close'
                });
                setTimeout(() => window.location.href = '', 1500);
                $("#form-editar-miembro")[0].reset();
                $('#actualizar-miembros').disabled = false;
            }
        }).fail(function (json) {
            console.log(json);
        });
    });
}

// Registrar miembros
const registrarMiembros = () => {
    let $button = $('#agregar-miembros');
    $button.click(function (e) {
        e.preventDefault();
        let $form = $('#form-registrar-miembros');
        $('#agregar-miembros').disabled = true;
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
                $('#agregar-miembros').disabled = false;
            } else {
                swal.fire({
                    title: response.title,
                    html: response.messages,
                    icon: 'success',
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonText: 'close'
                });
                $("#form-registrar-miembros")[0].reset();
                $('#agregar-miembros').disabled = false;
            }
        }).fail(function (json) {
            console.log(json);
        });
    });
}

// Lista miembros
const listaMiembros = () => {
    let api;
    let $button = $('#busqueda_miembros');
    let $table = $("#miembros-table");

    $table.DataTable({
        "ajax": {
            "url": $table.data("route"),
            "dataSrc": "miembros"
        },
        "columns": [
            {"data": "cedula"},
            {"data": "nombre_completo"},
            {"data": "telefono"},
            {"data": "status"},
            {"data": "fecha_fe"},
            {"data": "fecha_bautismo"},
            {"data": "actions", "className": "center"}
        ],
        responsive: "true",
        dom: '<"table-tools"<"col-12 col-sm-12 col-md-12 col-lg-4 top mb-3"B><"col-12 col-sm-12 col-md-12 col-lg-2 mb-3"l><"col-12 col-sm-12 col-md-12 col-lg-6 mb-3"f>>rtip',
        buttons: [
            {
                extend: 'copy',
                text: '<i class="bx bx-copy"></i> Copy',
                titleAttr: 'Copiar',
                className: 'btn btn-secondary',
            },
            {
                extend: 'csv',
                text: '<i class="bi bi-filetype-csv"></i> CSV',
                titleAttr: 'Exportar a CSV',
                className: 'btn btn-info'
            },
            {
                extend: 'pdf',
                text: '<i class="bi bi-filetype-pdf"></i> PDF',
                titleAttr: 'Exportar a PDF',
                className: 'btn btn-danger'
            },
        ],
        "initComplete": function () {
            api = this.api();
            api.buttons().container()
                .appendTo($('#table-buttons'));
            eliminarMiembro();

            $button.click(function () {
                let nombre = $('#nombre').val();
                let sexo = $('#sexo').val();
                let fecha = $('#fecha').val();
                let tipo_fecha = $('#tipo_fecha').val();
                let route = `${$table.data('route')}?nombre=${nombre}&sexo=${sexo}&fecha=${fecha}&tipo_fecha=${tipo_fecha}`;
                api.ajax.url(route).load();
                $table.on('draw.dt', function () {

                });
            });
        }
    })
}

// Eliminar miembro
const eliminarMiembro = () => {
    $(document).on('click', '#eliminar-miembro', function (e) {
        e.preventDefault();
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