$(document).ready(function () {
    listaProxActividades();
    listaBitacoraLastActions();
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