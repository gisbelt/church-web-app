$(document).ready(function(){
    registrarAmigos();
    amigosLista();
    actualizarAmigo();
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
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copy', className: 'btn btn-secondary glyphicon glyphicon-duplicate' },
            { extend: 'csv', className: 'btn btn-secondary glyphicon glyphicon-save-file' },
            { extend: 'pdf', className: 'btn btn-secondary glyphicon glyphicon-file' },
        ],
        "initComplete": function () {
            api = this.api();
            $button.click(function () {

                let sexo = $('#sexo').val();
                let cedula = $('#cedula').val();
                let fecha_nacimiento = $('#fecha_nacimiento').val();
                let route = `${$table.data('route')}?sexo=${sexo}&cedula=${cedula}&fecha_nacimiento=${fecha_nacimiento}`;
                api.ajax.url(route).load();
                $table.on('draw.dt', function () {

                });
            });

            eliminarAmigos();
            convertirMiembro();
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
                setTimeout(() => window.location.href = '', 1000);
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

// Actualizar amigo
const actualizarAmigo = function () {
    let $button = $('#actualizar-amigos');
    $button.click(function (e) {
        e.preventDefault();
        let $form = $('#form-actualizar-amigos');
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
                setTimeout(() => window.location.href = '', 1000);
                $button.disabled = false;
            }
        }).fail(function (json) {
            console.log(JSON.parse(json));
        });
    });
}

const convertirMiembro = function () {
    let $button = $('#amigo-miembro-guardar');
    let $form = $('#form-amigo-miembro');
    let $modal = $('#convertir-miembro');

    $modal.on('show.bs.modal', function(event) {
        let $target = $(event.relatedTarget);
        console.log($target.data())

    $button.click(function () {
        $('#migo-miembro-guardar').disabled = true;
        $.ajax({
            url: $form.attr('action') ,
            method: $form.attr('method'),
            data: $form.serialize() + '&amigo_id=' + $target.data('amigo'),
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
                $('#migo-miembro-guardar').disabled = false;
            } else {
                swal.fire({
                    title: response.title,
                    html: response.messages,
                    icon: 'success',
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonText: 'close'
                });
                let $table = $("#lista-amigos-table");
                let sexo = $('#sexo').val();
                let cedula = $('#cedula').val();
                let fecha_nacimiento = $('#fecha_nacimiento').val();
                let route = `${$table.data('route')}?sexo=${sexo}&cedula=${cedula}&fecha_nacimiento=${fecha_nacimiento}`;
                api.ajax.url(route).load();
                setTimeout(() => window.location.href = '', 1000);
                $('#migo-miembro-guardar').disabled = false;
            }
        }).fail(function (response) {
            console.log(JSON.parse(response));
        })
    });
    })
}