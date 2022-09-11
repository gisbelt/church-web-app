$(document).ready(function(){

    // Cuenta / perfil 
    $('.editar_perfil').click(function(e){
        var id = this.dataset['number'];
        $(".show_"+id).slideToggle(250);
        $(".show_"+id).removeClass("hidden");
    });
    // Not finish yet 
    $('.avatar').hover(function(){ 
        // $('#avatar-pencil').addClass('avatar-pencil');
        $('#avatar-link').css('display','block');
        
    }, function(){
        $('#avatar-link').css('display','none'); 
    });
    // Cuenta / perfil 

    // Filtro 
    $('.filtrar').click(function(e){
        var id = this.dataset['number'];
        $(".filtro"+id).toggle('slow')
        $(".filtro"+id).removeClass("hidden");
    });
    // Filtro 

// ********************************************************************************************************************

    //Grupo Familiar
    // Buscar miembro que no tenga grupo familiar 
    const buscarMiembroGrupoFamiliar = () =>{       
        $("#miembro").keyup(function () {
            const valorBusqueda = this.value;
            var v = $(this).val().length;
            if (v > 0) {
                obtener_registros(valorBusqueda);
            } else {
                $(".tabla_resultado").fadeOut(100);
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
                    for (const i of Object.keys(data)) {
                        const campoMiembro = document.getElementById('miembro'); 
                        const lista = document.querySelector('#tabla_resultado');
                        campoMiembro.setAttribute('data-id', data[i].id);
                        lista.innerHTML += `<li class='list-group-item bi bi-chevron-right pointer tabla_resultado'>${data[i].nombre} ${data[i].apellido}</li>`  
                    }
                    $('.tabla_resultado').click(function () {
                        document.getElementById('add-miembro').classList.remove("disabled"); 
                        $('#miembro').val($(this).text());                        
                        $('.tabla_resultado').fadeOut(100);
                    });
                },
                error: function(){} 
            })
        }        
    }
    buscarMiembroGrupoFamiliar();

    // Agregar miembro a grupo familiar   
    const nuevoMiembro = (addID, NewMiembro) =>{
        const add = document.getElementById(addID), 
        newMiembro = $(NewMiembro);
        newMiembro.empty;
        if(add, newMiembro){
            var i=0;
            $('.add').on('click', function (e){
                this.classList.add("disabled");
                const miembro = document.getElementById('miembro').value;
                const miembroID = document.getElementById('miembro').getAttribute('data-id');
                i++;
                var div = $("<div class='miembro-group"+i+" input-group'></div>");
                var input = $("<input type='text' required name='miembroId' class='form-control form-input mb-4 miembroId' id='integrante"+i+"' value='"+miembro+"' placeholder=' ' data-id='"+miembroID+"'> <label for='integrante"+i+"' class='form-label fw-bold' id='form-label'>Integrante:</label><span class='input-group-append'><span class='input-group-text bg-transparent border-0'><a id='"+i+"' class='btn btn-danger btn-remove'><i class='bi bi-trash'></i></a></span></span>");
                div.append(input);
                newMiembro.append(div);
                $('#miembro').val(''); 
            })
            //Agregar de la lista
            $('.addLista').on('click', function (e){
                const miembro = $(this).parents("tr").find("#miembroLista").text();
                const miembroID = $(this).parents("tr").attr("data-id");
                i++;
                var div = $("<div class='miembro-group"+i+" input-group'></div>");
                var input = $("<input type='text' required name='miembroId' class='form-control form-input mb-4' id='integrante"+i+"' value='"+miembro+"' placeholder=' ' data-id='"+miembroID+"'> <label for='integrante"+i+"' class='form-label fw-bold' id='form-label'>Integrante:</label><span class='input-group-append'><span class='input-group-text bg-transparent border-0'><a id='"+i+"' class='btn btn-danger btn-remove'><i class='bi bi-trash'></i></a></span></span>");
                div.append(input);
                newMiembro.append(div);
                $('#miembro').val('');
            })
            $(document).on('click', ".btn-remove", function(e){
                var button_id = $(this).attr("id"); 
                $(".miembro-group"+button_id).remove();
            });
        }
    }    
    nuevoMiembro('add-miembro','.new-miembro');       

    // Registrar GrupoFamiliar
    const registrarGrupoFamiliar = () =>{  
        const agregarGrupoFamiliar = document.getElementById('agregarGrupoFamiliar');
        agregarGrupoFamiliar.addEventListener('click', (ev) => {
            // Registramos el nombre del grupo 
            const nombreGrupoFamiliar = document.getElementById('nombreGrupoFamiliar').value;
            $.ajax({
                url: '/grupo-familiares/registrar-grupoFamiliar',
                data:{
                    'nombreGrupoFamiliar':nombreGrupoFamiliar
                },
                type: 'POST',
                dataType: 'json',
                success: function(data){
                    if(data.msj1) exito()                                                        
                },
                error: function(){} 
            })
            // Registramos cada miembro al nuevo grupo
            const exito = () => {
                const miembroId = document.getElementsByClassName('miembroId');
                const newMiembro = document.getElementById('new-miembro');    
                for (i = 0; i < miembroId.length; i++) {
                    $.ajax({
                        url: '/grupo-familiares/registrar-grupoFamiliar',
                        data:{
                            'miembroId': miembroId[i].getAttribute('data-id')
                        },
                        type: 'POST',
                        dataType: 'json',
                        success: function(data){
                            $("#tabla_exito").html("Registrado exitosamente").fadeIn(100);                                                       
                            setTimeout(function() {
                                $("#tabla_exito").html("Registrado exitosamente").slideUp('slow');
                                newMiembro.remove('slow');
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
    registrarGrupoFamiliar();
    //Grupo Familiar

// ********************************************************************************************************************

});
