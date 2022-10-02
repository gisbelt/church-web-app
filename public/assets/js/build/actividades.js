$(document).ready(function () {
    //permisos
    console.log('entrando')
    listaActividades();
});
// Lista Actividades
const listaActividades = function () {
    let table = $("#actividad-table");
    console.log(table.val())
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
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        "initComplete": function () {
            api = this.api();
            api.buttons().container().appendTo($('#table-buttons'));
            // eliminarDonacion();
            // observacion_donacion();
        }
    })
}