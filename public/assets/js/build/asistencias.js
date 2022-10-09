$(document).ready(function () {
    registrarAsistencia()
    listaAsistencias()
    actualizarAsistencia()
});
          
// Registrar asistencia
const registrarAsistencia = function () {
    let $button = $('#agregar-asistencia');
    $button.click(function (e) {
        e.preventDefault();
        let $form = $('#form-registrar-asistencias');
        $button.disabled = true;
        $.ajax({
            url: $form.attr('action'),
            type: $form.attr('method'),
            data: $form.serialize(),            
            dataType: 'json',
            success: function(response){
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
                $("#form-registrar-asistencias")[0].reset();
                $button.disabled = false;
            }
            },
            error: function(json){console.log(JSON.stringify(json));} 
        })
    });
}

// Lista asistencias
const listaAsistencias = () =>{
    let api;
    let $table = $("#asistencias-table");
    $table.DataTable({
        "ajax": {
            "url": $table.data("route"),
            "dataSrc": "asistencias"
        },
        "columns": [
            {"data": "nombre"},
            {"data": "detalles"},
            {"data": "nombre_completo"},
            {"data": "actions", "className": "center"}
        ],
        "initComplete": function () {
            api = this.api();
            api.buttons().container().appendTo($('#table-buttons'));
            eliminarAsistencia();
        }
    })
}

// Actualizar asistencias
const actualizarAsistencia = function () {
    let $button = $('#actualizar-asistencia');
    $button.click(function (e) {
        e.preventDefault();
        let $form = $('#form-actualizar-asistencia');
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
            console.log(JSON.stringify(json));
        });
    });
}

const eliminarAsistencia = function () {
    $(document).on('click', '#eliminar-asistencia', function (e) {
        e.preventDefault();
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