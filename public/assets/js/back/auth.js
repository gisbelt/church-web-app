$(document).ready(function () {
    $('#login-form').submit(function (e) {
        e.preventDefault();
        $button = $('#login');
        $button.disabled = true;
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
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
                $button.disabled = false;
            }
        }).fail(function (json) {
            console.log(JSON.parse(json));
        });
    });
});