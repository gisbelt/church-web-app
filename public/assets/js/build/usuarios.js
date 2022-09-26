$(document).ready(function(){
    //Usuarios
    // Buscar miembro
    const buscarUsuario = () =>{       
        $("#buscarMiembro").keyup(function () {
            const valorBusqueda = this.value;
            var v = $(this).val().length;
            if (v > 0) {
                obtener_registros(valorBusqueda);
            } else {
                $(".tabla_resultado").fadeOut(100);
            }
        });              
        const obtener_registros = (miembros) => {
            const buscarMiembro = document.getElementById('buscarMiembro').value;
            $.ajax({
                url: '/usuarios/buscar-usuario',
                data:{
                    'buscarMiembro':buscarMiembro
                },
                type: 'POST',
                dataType: 'json',
                success: function(data){
                    const lista = document.querySelector('#tabla_resultado_usuarios');
                    const campoMiembro = document.getElementById('nombreMiembro'); 
                    const buscarMiembro = document.getElementById('buscarMiembro');

                    //Filtramos los resultados según el valor que ha insertado el usuario
                    const datos = data.filter (results => {
                       return [results]
                    });                    
                    
                    // Recorremos con el map los resultados filtrados para crear cada elemento
                    lista.innerHTML = datos
                    .map((result, index) => {
                        const isSelected = index === 1;
                        return `
                        <li 
                        class='list-group-item bi bi-chevron-right pointer tabla_resultado' 
                        data-id='${result.id }'
                        >${result.cedula} - <span>${result.nombre} ${result.apellido}</span></li>
                        `                        
                    })
                    .join("");

                    // Rellenar campo al hacer click en el elemento creado 
                    $('.tabla_resultado').click(function (e) {                        
                        const id = $(this).attr("data-id");
                        const texto = $(this).children().text();
                        campoMiembro.setAttribute('data-id', id);
                        campoMiembro.id = id;
                        campoMiembro.value = texto;
                        campoMiembro.focus();
                        buscarMiembro.value = '';
                        $('.tabla_resultado').fadeOut(100);
                    });
                },
                error: function(){} 
            })
        }        
    }
    buscarUsuario();
    //Usuarios

    listaUsuarios();
    actualizarUsuario();
    registrarUsuario();
});

const listaUsuarios = () =>{
    let api;
    let $button = $('#busqueda_usuario');
    let $form = $('#form-usuarios-table');
    let $table = $("#usuarios-table");

    $table.DataTable({
        "ajax": {
            "url": $table.data("route"),
            "dataSrc": "usuarios"
        },
        "columns": [
            {"data": "nombre_completo"},
            {"data": "email"},
            {"data": "nombre"},
            {"data": "status"},
            {"data": "actions", "className": "center"},
        ],
        "initComplete": function () {
            api = this.api();
            api.buttons().container()
                .appendTo($('#table-buttons'));
            eliminarUsuario();
        }
    })

    $button.click(function () {
        $button.button('loading');
        let cargo = $('#cargo').val();
        let status = $('#status').val();
        let miembro = $('#miembro').val();
        let route = `${$table.data('route')}?cargo=${cargo}&status=${status}&miembro=${miembro}`;
        api.ajax.url(route).load();
        $table.on('draw.dt', function () {
            $button.button('reset');
        });
    });
}

// Eliminar usuario
const eliminarUsuario = () =>{

}

// Actualizar usuario
const actualizarUsuario = function () {
    let $button = $('#actualizar-usuario');
    $button.click(function (e) {
        e.preventDefault();
        let $form = $('#form-actualizar-usuario');
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
                $("#form-registrar-permisos")[0].reset();
                $button.disabled = false;
            }
        }).fail(function (json) {
            console.log(JSON.parse(json));
        });
    });
}

// Registrar usuario
const registrarUsuario = function (){
    let $button = $('#agregar-usuario');
    $button.click(function (e) {
        e.preventDefault();
        let $form = $('#form-registrar-usuario');
        $('#agregar-usuario').disabled = true;
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
                $('#agregar-usuario').disabled = false;
            } else {
                swal.fire({
                    title: response.title,
                    html: response.messages,
                    icon: 'success',
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonText: 'close'
                });
                $("#form-registrar-usuario")[0].reset();
                $('#agregar-usuario').disabled = false;
            }
        }).fail(function (json) {
            console.log(JSON.parse(json));
        });
    });
}