$(document).ready(function () {
    notificacionCrear();
});

const notificacionCrear = function () {
    let $button = $('#agregar-notificacion');
    $button.click(function (e) {
        e.preventDefault();
        let $form = $('#form-registrar-notificacion');
        $('#agregar-notificacion').disabled = true;
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
                $('#agregar-notificacion').disabled = false;
            } else {
                swal.fire({
                    title: response.title,
                    html: response.messages,
                    icon: 'success',
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonText: 'close'
                });
                $("#form-registrar-notificacion")[0].reset();
                $('#agregar-notificacion').disabled = false;
            }
        }).fail(function (json) {
            console.log(json);
        });
    });
}
