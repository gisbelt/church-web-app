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
});