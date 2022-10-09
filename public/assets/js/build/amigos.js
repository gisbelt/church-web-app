$(document).ready(function(){
    registrarAmigos();
    amigosLista();
});

// lista amigos
const amigosLista = () =>{
    let api;
    let $button = $('#busqueda_amigos');
    let $table = $("#lista-amigos-table");

    $table.DataTable({
        "ajax": {
            "url": $table.data("route"),
            "dataSrc": "amigos"
        },
        "columns": [
            {"data": "cedula"},
            {"data": "nombre_completo"},
            {"data": "sexo"},
            {"data": "telefono"},
            {"data": "status"},
            {"data": "actions", "className": "center"},
        ],
        responsive: "true",
        dom: '<"table-tools"<"col-12 col-sm-12 col-md-12 col-lg-4 top mb-3"B><"col-12 col-sm-12 col-md-12 col-lg-2 mb-3"l><"col-12 col-sm-12 col-md-12 col-lg-6 mb-3"f>>rtip',
        buttons: [
            { extend: 'copy', text: '<i class="bx bx-copy"></i> Copy', titleAttr: 'Copiar', className: 'btn btn-secondary',  },
            { extend: 'csv', text: '<i class="bi bi-filetype-csv"></i> CSV', titleAttr: 'Exportar a CSV', className: 'btn btn-info' },
            { extend: 'pdf', text: '<i class="bi bi-filetype-pdf"></i> PDF', titleAttr: 'Exportar a PDF', className: 'btn btn-danger' },
        ],
        "initComplete": function () {
            api = this.api();
            $button.click(function () {
                console.log('click..')
                let sexo = $('#sexo').val();
                let status = $('#status').val();
                let cedula = $('#cedula').val();
                let fecha_nacimiento = $('#fecha_nacimiento').val();
                let route = `${$table.data('route')}?sexo=${sexo}&status=${status}&cedula=${cedula}&fecha_nacimiento=${fecha_nacimiento}`;
                api.ajax.url(route).load();
                $table.on('draw.dt', function () {

                });
            });

            eliminarAmigos();
        }
    })
}

// registrar amigos
const registrarAmigos = function ()
{
    let $button = $('#agregar-amigos');
    $button.click(function (e) {
        e.preventDefault();
        console.log('clic..')
        let $form = $('#form-registrar-amigos');
        $('#agregar-amigos').disabled = true;
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
                $('#agregar-amigos').disabled = false;
            } else {
                swal.fire({
                    title: response.title,
                    html: response.messages,
                    icon: 'success',
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonText: 'close'
                });
                $("#form-registrar-amigos").reset();
                $('#agregar-amigos').disabled = false;
            }
        }).fail(function (json) {
            console.log(JSON.parse(json));
        });
    });
}

// Eliminar amigo
const eliminarAmigos = () =>{
    $(document).on('click', '#eliminar-amigos', function (e) {
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
                setTimeout(() => window.location.href = '', 1000);
            }
        })
    });
}