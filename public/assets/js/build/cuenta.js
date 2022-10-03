$(document).ready(function () {
    actualizarUsername();
});

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
