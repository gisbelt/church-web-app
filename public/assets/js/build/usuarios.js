$(document).ready(function(){
    listaUsuarios();
    actualizarUsuario();
    registrarUsuario();
});

const listaUsuarios = () =>{
    let api;
    let $button = $('#busqueda_usuario');
    let $table = $("#usuarios-table");

    $table.DataTable({
        "ajax": {
            "url": $table.data("route"),
            "dataSrc": "usuarios"
        },
        "columns": [
            {"data": "nombre_completo"},
            {"data": "email"},
            {"data": "nombre"},
            {"data": "status"},
            {"data": "actions", "className": "center"},
        ],
        "initComplete": function () {
            api = this.api();
            api.buttons().container()
                .appendTo($('#table-buttons'));
            eliminarUsuario();
        }
    })

    $button.click(function () {
        let cargo = $('#cargo').val();
        let status = $('#status').val();
        let miembro = $('#miembro').val();
        let route = `${$table.data('route')}?cargo=${cargo}&status=${status}&miembro=${miembro}`;
        api.ajax.url(route).load();
        $table.on('draw.dt', function () {

        });
    });
}

// Eliminar usuario
const eliminarUsuario = () =>{
    $(document).on('click', '#eliminar-usuario', function (e) {
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
                tr.remove();
            }
        })
    });
}

// Actualizar usuario
const actualizarUsuario = function () {
    let $button = $('#actualizar-usuario');
    $button.click(function (e) {
        e.preventDefault();
        let $form = $('#form-actualizar-usuario');
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

// Registrar usuario
const registrarUsuario = function (){
    let $button = $('#agregar-usuario');
    $button.click(function (e) {
        e.preventDefault();
        let $form = $('#form-registrar-usuario');
        $('#agregar-usuario').disabled = true;
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
                $('#agregar-usuario').disabled = false;
            } else {
                swal.fire({
                    title: response.title,
                    html: response.messages,
                    icon: 'success',
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonText: 'close'
                });
                $("#form-registrar-usuario")[0].reset();
                $('#agregar-usuario').disabled = false;
            }
        }).fail(function (json) {
            console.log(JSON.parse(json));
        });
    });
}