$(document).ready(function () {
   //permisos
    listaPermisos();
    eliminarPermiso();
    registrarPermiso();
    actualizarPermiso();

    obtenerUsuarios()
    obtenerRolUser()

    //roles
    listaRoles();
    eliminarRol();
    registrarRol();
    actualizarRol();

});

const obtenerUsuarios = function () {
    $.ajax({
        url: "/seguridad/permisos/obtener_usuarios",
        type: "GET",
        dateType: "json",
    }).done(function (response) {
        var usuario = $("#usuario").val();
        let data = JSON.parse(response);
        $.each(data.usuarios, function (count, item) {
            if(usuario !== item.user){
                $("#usuario").append('<option value="' + item.user + '" data-route="' + item.route + '" class="lista-users">' + item.nombre_completo + '</option>');
            }
        });
    }).fail(function (jqXHR, textStatus, errorThrown) {
        swal({
            title: 'Error',
            icon: 'error'
        })
    })
}

//Registrar permiso
const registrarPermiso = function (){
    // Registrar permisos
    $('#form-registrar-permisos').submit(function (e) {
        e.preventDefault();
        $button = $('#agregar-permisos');
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
                $("#form-registrar-permisos").reset();
                $button.disabled = false;
            }
        }).fail(function (json) {
            console.log(JSON.parse(json));
        });
    });
}

//Actualizar permiso
const actualizarPermiso = function (){
    // Registrar rol o permisos
    $('#form-actualizar-permisos').submit(function (e) {
        e.preventDefault();
        $button = $('#actualizar-permisos');
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
                $("#form-registrar-permisos").reset();
                $button.disabled = false;
            }
        }).fail(function (json) {
            console.log(JSON.parse(json));
        });
    });
}

//Lista permiso
const listaPermisos = function (){
    let $table = $("#permisos-table");
    $table.DataTable({
        "ajax": {
            "url": $table.data("route"),
            "dataSrc": "permisos"
        },
        "columns": [
            {"data": "permiso_nombre"},
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
                eliminarPermiso();
        }
    })
}

//Eliminar permiso
const eliminarPermiso = function(){
    $(document).on('click', '#eliminar-permiso', function (e) {
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

// Registrar rol
const registrarRol = function (){
    $('#form-registrar-rol').submit(function (e) {
        e.preventDefault();
        $button = $('#agregar-rol');
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
                $("#agregar-rol")[0].reset();
                $button.disabled = false;
            }
        }).fail(function (json) {
            console.log(JSON.parse(json));
        });
    });
}

// Actualizar rol
const actualizarRol = function (){
    // actualiar rol
    $('#form-actualizar-rol').submit(function (e) {
        e.preventDefault();
        $button = $('#actualizar-rol');
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
            } else {
                swal.fire({
                    title: response.title,
                    html: response.messages,
                    icon: 'success',
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonText: 'close'
                });
                $("#form-registrar-permisos").reset();
            }
            $button.disabled = false;
        }).fail(function (json) {
            console.log(JSON.parse(json));
        });
    });
}

// Lista roles
const listaRoles = function (){
    let $table = $("#roles-table");
    $table.DataTable({
        "ajax": {
            "url": $table.data("route"),
            "dataSrc": "roles"
        },
        "columns": [
            {"data": "role_nombre"},
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
            eliminarRol();
        }
    })
}

// Eliminar rol
const eliminarRol = function(){
    $(document).on('click', '#eliminar-rol', function (e) {
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