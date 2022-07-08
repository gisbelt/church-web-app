$(document).ready(function(){

    // ************************************************ 

    // Eliminar artículo por id sin actualizar página 
    var borrar_articulo = $('.borrar_articulo');
    borrar_articulo.on('click',function( ){
        // Obtenemos el id del botón quitar_carrito
        var id = $(this).attr('id');
        var dataString = 'id='+id;

        var ajax = $.ajax({
            // La direccion del servidor, peticion al fichecero mysql 
            url: "?url=borrarArticulos",
            type: 'POST',
            data: dataString,
            success: function(data){
                $("#articulo" + id).remove();
                // $('.fila_tienda').css("margin-bottom","0px");
            },
            // para capturar el error 
            error: function(data, status, error){
                alert("no encontrado");
            }
        })
    })

});