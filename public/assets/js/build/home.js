$(document).ready(function () {
    listaProxActividades();
    listaBitacoraLastActions();
    notificacionNavBar();
    notificacionLeida();
});

// lista Proximas Actividades
const listaProxActividades = function () {
    let $table = $("#prox-actividades");
    let api;
    $table.DataTable({
        "ajax": {
            "url": $table.data("route"),
            "dataSrc": "actividades"
        },
        dom: 'rt',
        "columns": [
            {"data": "nombre"},
            {"data": "descripcion"},
            {"data": "tipo"},
            {"data": "fecha"}
        ],
        "initComplete": function () {
            api = this.api();
        }
    })
}

// lista Ultimas Acciones Bitacora
const listaBitacoraLastActions = function () {
    let $table = $("#bitacora-last");
    let api;
    $table.DataTable({
        "ajax": {
            "url": $table.data("route"),
            "dataSrc": "bitacora"
        },
        dom: 'rt',
        "columns": [
            {"data": "descripcion"},
            {"data": "user"},
            {"data": "fecha"}
        ],
        "initComplete": function () {
            api = this.api();
        }
    })
}

const notificacionNavBar = function () {
    $.ajax({
        url: "/notificaciones/navbar",
        type: "GET",
        dateType: "json",
    }).done(function (response) {
        let dataNotificacion = JSON.parse(response);
        if (dataNotificacion.notificaciones.length === 0) {
            $('#empty_message').removeClass('d-none');
            $('.empty-text').removeClass('d-none');
            $(".lista-notifi").remove();
            $('.cantidad_notificaciones').remove();
        } else {
            $(".lista-notifi").remove();
            $('#empty_message').addClass('d-none');
            $('.empty-text').addClass('d-none');
            $.each(dataNotificacion.notificaciones, function (count, item) {
                $(".todas_notificaciones_list").append("<a href='#' data-route=" + item.route + " class='list-group-item px-0 fw-bold lista-notifi'>" + item.fecha_creada + " - " + item.mesanje + "</a>");
                $(".noti-header").append("<a href='#' data-route=" + item.route + " class='list-group-item px-0 fw-bold lista-notifi'>" + item.fecha_creada + " - " + item.mesanje + "</a>");
            });
            $('.cantidad_notificaciones').append(dataNotificacion.cantidad);
        }

    }).fail(function (jqXHR, textStatus, errorThrown) {
        swal({
            title: 'Error',
            icon: 'error'
        })
    })
}

const notificacionLeida = function () {
    $(document).on('click', '.lista-notifi',function () {
        let route = $(this).data('route');
        $.ajax({
            url: route,
            type: "GET",
            dateType: "json",
        }).done(function (response) {
            let dataStatus = JSON.parse(response);
           if(dataStatus.status == 'ok'){
               $.ajax({
                   url: "/notificaciones/navbar",
                   type: "GET",
                   dateType: "json",
               }).done(function (response) {
                   let dataNotificacion = JSON.parse(response);
                   if (dataNotificacion.notificaciones.length === 0) {
                       $('#empty_message').removeClass('d-none');
                       $(".lista-notifi").remove();
                       $('.cantidad_notificaciones').remove();
                   } else {
                       $(".lista-notifi").remove();
                    //    $('.cantidad_notificaciones').remove();
                       $('#empty_message').addClass('d-none');
                       $.each(dataNotificacion.notificaciones, function (count, item) {
                           $(".todas_notificaciones_list").append("<a href='#' data-route=" + item.route + " class='list-group-item px-0 fw-bold lista-notifi'>" + item.fecha_creada + " - " + item.mesanje + "</a>");
                       });
                       $('.cantidad_notificaciones').append(dataNotificacion.cantidad);
                   }

               })
           }
        }).fail(function (jqXHR, textStatus, errorThrown) {
            swal({
                title: 'Error',
                icon: 'error'
            })
        })
    })
}