$(document).ready(function () {
    //permisos
    listaDonaciones();
    eliminarDonacion();
    registrarDonacion();
    actualizarDonacion();

});

const eliminarDonacion = function (){

}

const actualizarDonacion = function (){

}

const listaDonaciones = function (){

}

// Registrar donacion
const registrarDonacion = function (){
    // Registrar permisos
    let $button = $('#guardar_donacion');
    $button.click(function (e) {
        e.preventDefault();
        let $form = $('#form-registrar-donacion');
        console.log('click...')
        $button.disabled = true;
        $.ajax({
            type: $form.attr('method'),
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
                $("#form-registrar-permisos")[0].reset();
                $button.disabled = false;
            }
        }).fail(function (json) {
            console.log(JSON.parse(json));
        });
    });
}