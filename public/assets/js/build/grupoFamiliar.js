$(document).ready(function(){
    const button = document.getElementById('agregarGrupoFamiliar');

    // Buscar miembro que no tenga grupo familiar 
    const buscarMiembroGrupoFamiliar = () =>{       
        $("#miembro").keyup(function () {
            const valorBusqueda = this.value;
            var v = $(this).val().length;
            if (v > 0) {
                obtener_registros(valorBusqueda);
            } else {
                $(".tabla_resultado").fadeOut(100);
                document.getElementById('add-miembro').classList.add("disabled"); 
            }
        });              
        const obtener_registros = (miembros) => {
            const nombreMiembro = document.getElementById('miembro').value;
            $.ajax({
                url: '/grupo-familiares/buscar-miembro',
                data:{
                    'nombreMiembro':nombreMiembro
                },
                type: 'POST',
                dataType: 'json',
                success: function(data){
                    const lista = document.querySelector('#tabla_resultado');
                    const campoMiembro = document.getElementById('miembro'); 
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
                        document.getElementById('add-miembro').classList.remove("disabled"); 
                        $('.tabla_resultado').fadeOut(100);
                    });
                },
                error: function(){} 
            })
        }        
    }
    buscarMiembroGrupoFamiliar();

    // Agregar item buscado    
    const nuevoMiembro = (addID, NewMiembro) =>{
        const add = document.getElementById(addID), 
        newMiembro = $(NewMiembro);
        if(add, newMiembro){
            var i=0;
            $('.add').on('click', function (e){
                button.disabled = false;
                this.classList.add("disabled");
                const miembro = document.getElementById('miembro').value;
                const miembroID = document.getElementById('miembro').getAttribute('data-id');
                i++;
                var div = $("<div class='miembro-numero"+i+" input-group'></div>");
                var input = $("<input type='text' required name='miembroId' class='form-control form-input mb-4 miembroId' id='integrante"+i+"' value='"+miembro+"' placeholder=' ' data-id='"+miembroID+"' disabled> <label for='integrante"+i+"' class='form-label fw-bold' id='form-label'>Integrante:</label><span class='input-group-append'><span class='input-group-text bg-transparent border-0'><a id='"+i+"' class='btn btn-danger btn-remove'><i class='bi bi-trash'></i></a></span></span>");
                div.append(input);
                newMiembro.append(div);
                $('#miembro').val(''); 
            })
            //Agregar de la lista
            $('.addLista').on('click', function (e){
                const miembro = $(this).parents("tr").find("#miembroLista").text();
                const miembroID = $(this).parents("tr").attr("data-id");
                i++;
                var div = $("<div class='miembro-numero"+i+" input-group'></div>");
                var input = $("<input type='text' required name='miembroId' class='form-control form-input mb-4 miembroId' id='integrante"+i+"' value='"+miembro+"' placeholder=' ' data-id='"+miembroID+"' disabled> <label for='integrante"+i+"' class='form-label fw-bold' id='form-label'>Integrante:</label><span class='input-group-append'><span class='input-group-text bg-transparent border-0'><a id='"+i+"' class='btn btn-danger btn-remove'><i class='bi bi-trash'></i></a></span></span>");
                div.append(input);
                newMiembro.append(div);
                $('#miembro').val('');
            })
            $(document).on('click', ".btn-remove", function(e){
                var button_id = $(this).attr("id"); 
                $(".miembro-numero"+button_id).remove();
                if(newMiembro.html() == ""){
                    button.disabled = true;
                }
            });
        }
    }    
    nuevoMiembro('add-miembro','.new-miembro');       

    // Registrar GrupoFamiliar
    const registrarGrupoFamiliar = () =>{  
        const newMiembro = document.getElementById('new-miembro');  
        console.log('click....')
        if(button !== null){
        button.addEventListener('click', (ev) => {
            // Registramos el nombre del grupo 
            const nombreGrupoFamiliar = document.getElementById('nombreGrupoFamiliar').value;
            $.ajax({
                url: '/grupo-familiares/registrar-grupoFamiliar',
                data:{
                    'nombre':nombreGrupoFamiliar,
                },
                type: 'POST',
                dataType: 'json',
                success: function(response){
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
                    } else {
                        exito();
                    }
                },
                error: function(){} 
            })
            // Registramos cada miembro al nuevo grupo
            const exito = () => {
                const miembroId = document.getElementsByClassName('miembroId');
                for (i = 0; i < miembroId.length; i++) {
                    $.ajax({
                        url: '/grupo-familiares/registrar-grupoFamiliar',
                        data:{
                            'miembroId': miembroId[i].getAttribute('data-id')
                        },
                        type: 'POST',
                        dataType: 'json',
                        success: function(response){
                            swal.fire({
                                title: response[1].title,
                                html: response[1].messages,
                                icon: 'success',
                                showConfirmButton: false,
                                showCancelButton: true,
                                cancelButtonText: 'close'
                            });
                            $("#form-registrarGrupo")[0].reset();
                            button.disabled = true; 
                            setTimeout(function() {
                                newMiembro.innerHTML = "";
                                $("#nombreGrupoFamiliar").val(''); 
                                $("#nombreGrupoFamiliar").focus(); 
                            },1000); 
                        },
                        error: function(){} 
                    })
                }
            }
        }, false);
        }
    }      
    registrarGrupoFamiliar();
});