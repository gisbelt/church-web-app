$(document).ready(function () {
    //login
    iniciarSession();
    enviarCorreo();
    resetearContrasena();
});

const iniciarSession = function () {
    let $button = $('#login');
    $button.click(function (e) {
        e.preventDefault();
        $('#login').disabled = true;
        let $form = $('#login-form');
        $.ajax({
            type: "POST",
            url: $form.attr('action'),
            data: $form.serialize(),
            dataType: 'json',
        }).done(function (response) {
            // let response = JSON.parse(json);
            if (response.code == 422) {
                let html = '<ul>';
                $.each(response.messages, function (index, value) {
                    html += '<li>' + value + '</li>';
                });
                html += '</ul>';

                swal.fire({
                    title: response.titulo,
                    html: html,
                    icon: 'error',
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonText: 'close'
                });
                $button.disabled = false;
            } else if(response.code == 403) {
                let html = '<ul>';
                $.each(response.messages, function (index, value) {
                    html += '<li>' + value + '</li>';
                });
                html += '</ul>';
                swal.fire({
                    title: response.titulo,
                    html: html,
                    icon: 'error',
                    showConfirmButton: false,
                    showCancelButton: false,
                    cancelButtonText: 'close'
                });
                $button.disabled = false;

            } else {
                swal.fire({
                    title: response.titulo,
                    html: response.messages,
                    icon: 'success',
                    showConfirmButton: false,
                    showCancelButton: false,
                    cancelButtonText: 'close'
                });
                setTimeout(() => window.location.href = response.route, 1000);
                $button.disabled = false;
            }
        }).fail(function (json) {
            console.log(JSON.parse(json));
        });
    });

    $('#login-form').keypress(function (event) {
        if (event.keyCode === 13) {
            $button.click();
        }
    });
}

const enviarCorreo = function(){
    let $button = $('#recuperar');
    $button.click(function (e) {
        e.preventDefault();
        $('#recuperar').disabled = true;
        let $form = $('#enviar-correo-form');
        $.ajax({
            type: "POST",
            url: $form.attr('action'),
            data: $form.serialize(),
            dataType: 'json',
        }).done(function (response) {
            if (response.code == 422) {
                let html = '<ul>';
                $.each(response.messages, function (index, value) {
                    html += '<li>' + value + '</li>';
                });
                html += '</ul>';

                swal.fire({
                    title: response.title,
                    html: html,
                    icon: 'error',
                    showConfirmButton: false,
                    showCancelButton: cancel,
                    cancelButtonText: 'close'
                });
                $('#recuperar').disabled = false;
            } else if(response.code == 404) {
                swal.fire({
                    title: response.title,
                    html: response.messages,
                    icon: 'error',
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonText: 'close'
                });
                $('#recuperar').disabled = false;
            } else {
                swal.fire({
                    title: response.titulo,
                    html: response.messages,
                    icon: 'success',
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonText: 'close'
                });
                setTimeout(() => window.location.href = response.route, 1000);
                $('#recuperar').disabled = false;
            }
        }).fail(function (json) {
            console.log(JSON.parse(json));
        });
    });

    $('#enviar-correo-form').keypress(function (event) {
        if (event.keyCode === 13) {
            $button.click();
        }
    });
}

const resetearContrasena = function(){
    let $button = $('#resetear');
    $button.click(function (e) {
        e.preventDefault();
        $('#resetear').disabled = true;
        let $form = $('#resetear-contrasena-form');
        $.ajax({
            type: "POST",
            url: $form.attr('action'),
            data: $form.serialize(),
            dataType: 'json',
        }).done(function (response) {
            if (response.code == 422) {
                let html = '<ul>';
                $.each(response.messages, function (index, value) {
                    html += '<li>' + value + '</li>';
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
                $('#resetear').disabled = false;
            } else {
                swal.fire({
                    title: response.titulo,
                    html: response.messages,
                    icon: 'success',
                    showConfirmButton: false,
                    showCancelButton: false,
                    cancelButtonText: 'close'
                });
                setTimeout(() => window.location.href = response.route, 1000);
                $('#resetear').disabled = false;
            }
        }).fail(function (json) {
            console.log(JSON.parse(json));
        });
    });

    $('#resetear-contrasena-form').keypress(function (event) {
        if (event.keyCode === 13) {
            $button.click();
        }
    });
}