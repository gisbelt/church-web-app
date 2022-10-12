$(document).ready(function () {
    obtener_usuario();
    actualizarUsername();
    actualizarNombre();
    actualizarTelefono();
    actualizarDireccion();
});

const obtener_usuario = () =>{
    $.ajax({
        url: "/cuenta/obtener-usuario",
        type: "GET",
        dateType: "json",
    }).done(function (response) {
        let data = JSON.parse(response);
        $('#username').append(data.username);
        $('#nombre').append(data.nombre+' '+data.apellido);
        $('#telefono').append(data.telefono);
        $('#direccion').append(data.direccion);

        $('#username-input').val(data.username);
        $('#nombre-input').val(data.nombre);
        $('#apellido-input').val(data.apellido);
        $('#telefono-input').val(data.telefono);
        $('#direccion-input').val(data.direccion);
    }).fail(function (jqXHR, textStatus, errorThrown) {
        swal.fire({
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

const actualizarNombre = function () {
    obtenernombre = function(response){
        let data = JSON.parse(response.nombre_completo);
        const nombre = $('#nombre');
        const value = `${data.nombre+' '+data.apellido}`;
        nombre.empty();         
        nombre.append(value);
    };
    let $button = $('#cambiar-nombre');
    $button.click(function (e) {
        let $form = $('#form-nombre');
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
                obtenernombre(response);
                $button.disabled = false;
            }
        }).fail(function (json) {
            console.log(json);
        });
    });
}

const actualizarTelefono = function () {
    obtenertelefono = function(response){
        const telefono = $('#telefono');
        const value = response.telefono;
        telefono.empty();         
        telefono.append(value);
    };
    let $button = $('#cambiar-telefono');
    $button.click(function (e) {
        let $form = $('#form-telefono');
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
                obtenertelefono(response);
                $button.disabled = false;
            }
        }).fail(function (json) {
            console.log(json);
        });
    });
}

const actualizarDireccion = function () {
    obtenerdireccion = function(response){
        const direccion = $('#direccion');
        const value = response.direccion;
        direccion.empty();         
        direccion.append(value);
    };
    let $button = $('#cambiar-direccion');
    $button.click(function (e) {
        let $form = $('#form-direccion');
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
                obtenerdireccion(response);
                $button.disabled = false;
            }
        }).fail(function (json) {
            console.log(json);
        });
    });
}
