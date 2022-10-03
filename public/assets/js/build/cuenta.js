$(document).ready(function () {
    obtener_usuario();
    actualizarUsername();
});

const obtener_usuario = () =>{
    $.ajax({
        url: "/cuenta/obtener-usuario",
        type: "GET",
        dateType: "json",
    }).done(function (response) {
        let data = JSON.parse(response);
        $('#username').append(data.username);
        $('#nombre').append(data.nombre_completo);
        $('#telefono').append(data.telefono);
        $('#direccion').append(data.direccion);

        $('#username-input').val(data.username);
        $('#nombre-input').val(data.nombre_completo);
        $('#telefono-input').val(data.telefono);
        $('#direccion-input').val(data.direccion);
    }).fail(function (jqXHR, textStatus, errorThrown) {
        swal({
            title: 'Error',
            icon: 'error'
        })
    })
}

const actualizarUsername = function () {
    obtenerusername = function(response){
        const username = $('#username');
        const value = response.username;
        username.empty();         
        username.append(value);
    };
    let $button = $('#cambiar-username');
    $button.click(function (e) {
        let $form = $('#form-username');
        e.preventDefault();
        $button.disabled = true;
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
                $button.disabled = false;
            } else {
                swal.fire({
                    title: response.title,
                    html: response.messages,
                    icon: 'success',
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonText: 'close'
                });
                obtenerusername(response);
                $button.disabled = false;
            }
        }).fail(function (json) {
            console.log(json);
        });
    });
}
