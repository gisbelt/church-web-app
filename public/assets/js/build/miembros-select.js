$(document).ready(function () {
    $.ajax({
        url: "/miembros/select",
        type: "GET",
        dateType: "json",
    }).done(function (response) {
        $.each(JSON.parse(response), function (count, item) {
            $("#miembro_id").append('<option value="' + item['id'] + '">' + item['nombre'] + '</option>');
        });
    }).fail(function (jqXHR, textStatus, errorThrown) {
        swal({
            title: 'Error',
            icon: 'error'
        })
    })
});
