$(document).ready(function () {
    listaBitacora();
});

// Lista bitacora
const listaBitacora = function () {
    let table = $("#bitacora-table");
    let api;
    let $button = $('#busqueda_bitacora');
    table.DataTable({
        "ajax": {
            "url": table.data("route"),
            "dataSrc": "bitacora"
        },
        "columns": [
            {"data": "descripcion"},
            {"data": "modulo"},
            {"data": "usuario"},
            {"data": "fecha"}
        ],
        responsive: "true",
        dom: '<"table-tools"<"col-12 col-sm-12 col-md-12 col-lg-4 top mb-3"B><"col-12 col-sm-12 col-md-12 col-lg-2 mb-3"l><"col-12 col-sm-12 col-md-12 col-lg-6 mb-3"f>>rtip',
        buttons: [
            { extend: 'copy', text: '<i class="bx bx-copy"></i> Copy', titleAttr: 'Copiar', className: 'btn btn-secondary',  },
            { extend: 'csv', text: '<i class="bi bi-filetype-csv"></i> CSV', titleAttr: 'Exportar a CSV', className: 'btn btn-info' },
            { extend: 'pdf', text: '<i class="bi bi-filetype-pdf"></i> PDF', titleAttr: 'Exportar a PDF', className: 'btn btn-danger' },
        ],
        "initComplete": function () {
            let api = this.api();
            $button.click(function () {

                let user = $('#usuario').val();
                let fecha_inicial = $('#fecha_inicial').val();
                let fecha_final = $('#fecha_final').val();
                let route = `${$table.data('route')}?user=${user}&fecha_inicial=${fecha_inicial}&fecha_final=${fecha_final}`;
                api.ajax.url(route).load();
                $table.on('draw.dt', function () {

                });
            });
        }
    })
}