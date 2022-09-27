$(document).ready(function () {
    $.ajax({
        url: "/actividad/tipos",
        type: "GET",
    }).done(function (data) {
        $.each(data, function (count, item) {
            $("#tipo_actividad").append('<option value="' + item['id'] + '">' + item['nombre'] + '</option>');
        });
    }).fail(function (jqXHR, textStatus, errorThrown) {
        swal({
            title: 'Error',
            icon: 'error'
        })})
});
