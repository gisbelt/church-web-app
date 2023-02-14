$(document).ready(function () {
    listaActividades();
    listaActividadesCalendario();
    actualizarActividades();
    registrarActividades();
    registrarTipoActividades();
});

// Lista Actividades
const listaActividades = function () {
    let table = $("#actividad-table");
    table.DataTable({
        "ajax": {
            "url": table.data("route"),
            "dataSrc": "actividades"
        },
        "columns": [
            {"data": "nombre"},
            {"data": "descripcion"},
            {"data": "status"},
            {"data": "tipo"},
            {"data": "fecha"},
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
            // eliminarDonacion();
            // observacion_donacion();
        }
    })
}

// Lista Actividades Calendario
const listaActividadesCalendario = function () {
    $('#calendario').fullCalendar({
        header: {
            left: 'month,agendaWeek,agendaDay',
            center: 'title',
            right: 'prev,next today'
        },
        defaultView: 'month',
        editable: false,
        eventLimit: 3,
        timeFormat: 'HH:mm',
        events: {
            url: 'actividad/dataCalendario',
            type: 'GET',
            error: function() {
                alert('Error al cargar los eventos');
            }
        },
        locale: 'es',
        views: {
            // cambiar la vista móvil a una lista de eventos
            listMobile: {
                type: 'list',
                buttonText: 'Lista',
                duration: { days: 7 }, // mostrar eventos de una semana
            }
        },
        eventRender: function(event, element, view) {
            // Agregar un botón de edición
            var editButton = '<a href="/actividades/editar/' + event.id + '" class="btn btn-info me-2" target="_blank" data-title="editar"><i class="bi bi-pencil text-light"></i></a>'
            element.find('.fc-content').append(editButton);
        }
    });
}

const registrarActividades = function () {
    let $button = $('#agregar-actividad');
    $button.click(function (e) {
        e.preventDefault();
        let $form = $('#form-registrarActividades');
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

const actualizarActividades = function () {
    let $button = $('#actualizar-actividades');
    $button.click(function (e) {
        e.preventDefault();
        let $form = $('#form-actualizar-actividades');
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
                $("#form-registrar-permisos").reset();
                $button.disabled = false;
            }
        }).fail(function (json) {
            console.log(JSON.parse(json));
        });
    });
}

const registrarTipoActividades = function () {
    let $button = $('#agregar-tipo-actividad');
    $button.click(function (e) {
        e.preventDefault();
        let $form = $('#form-registrarTipoActividades');
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