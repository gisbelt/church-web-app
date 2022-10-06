$(document).ready(function(){
    registrarMiembros();
});

// Registrar miembros
const registrarMiembros = () => {
    let $button = $('#agregar-miembros');
    $button.click(function (e) {
        e.preventDefault();
        let $form = $('#form-registrar-miembros');
        $('#agregar-miembros').disabled = true;
        $.ajax({
            type: $form.attr('method'),
            url: $form.attr('action'),
            data: $form.serialize(),
            dataType: 'json',
        }).done(function (response) {
            console.log(response)
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
                $('#agregar-miembros').disabled = false;
            } else {
                swal.fire({
                    title: response.title,
                    html: response.messages,
                    icon: 'success',
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonText: 'close'
                });
                $("#form-registrar-miembros")[0].reset();
                $('#agregar-miembros').disabled = false;
            }
        }).fail(function (json) {
            console.log(JSON.parse(json));
        });
    });
}