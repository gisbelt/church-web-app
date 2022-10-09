$(document).ready(function () {
    listaActividades();
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
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copy', className: 'btn btn-secondary glyphicon glyphicon-duplicate' },
            { extend: 'csv', className: 'btn btn-secondary glyphicon glyphicon-save-file' },
            { extend: 'pdf', className: 'btn btn-secondary glyphicon glyphicon-file' },
        ],
        "initComplete": function () {
            api = this.api();
            // eliminarDonacion();
            // observacion_donacion();
        }
    })
}