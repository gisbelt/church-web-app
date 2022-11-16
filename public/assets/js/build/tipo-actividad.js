$(document).ready(function () {
    $.ajax({
        url: "/actividad/tipos",
        type: "GET",
        dateType: "json",
    }).done(function (response) {
        var tipo = $("#tipo_actividad").val();
        $.each(JSON.parse(response), function (count, item) {
            if(tipo !== item['id']){
                $("#tipo_actividad").append('<option value="' + item['id'] + '">' + item['nombre'] + '</option>');
            }
        });
    }).fail(function (jqXHR, textStatus, errorThrown) {
        swal({
            title: 'Error',
            icon: 'error'
        })
    })
});
