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

    //Grupo Familiar
    // Add a new input field (miembro)    
    const nuevoMiembro = (addID) =>{
        const add = document.getElementById(addID),
        newMiembro = $('.new-miembro')
        newMiembro.empty;
        // Validate that all variables exist
        if(add, newMiembro){
            var i=0;
            $('.add').on('click', function (e){
                const miembro = $('#miembro').val();
                i++;
                var div = $("<div class='miembro-group"+i+" input-group'></div>");
                var input = $("<input type='text' required name='miembro"+i+"' class='form-control form-input mb-4' id='integrante"+i+"' value='"+miembro+"' placeholder=' '> <label for='integrante"+i+"' class='form-label fw-bold' id='form-label'>Integrante:</label><span class='input-group-append'><span class='input-group-text bg-transparent border-0'><a id='"+i+"' class='btn btn-danger btn-remove'><i class='bi bi-trash'></i></a></span></span>");
                div.append(input);
                newMiembro.append(div);
                $('#miembro').val(''); 
            })
            $('.addLista').on('click', function (e){
                const miembro = $(this).parents("tr").find("#miembroLista").text();
                i++;
                var div = $("<div class='miembro-group"+i+" input-group'></div>");
                var input = $("<input type='text' required name='miembro"+i+"' class='form-control form-input mb-4' id='integrante"+i+"' value='"+miembro+"' placeholder=' '> <label for='integrante"+i+"' class='form-label fw-bold' id='form-label'>Integrante:</label><span class='input-group-append'><span class='input-group-text bg-transparent border-0'><a id='"+i+"' class='btn btn-danger btn-remove'><i class='bi bi-trash'></i></a></span></span>");
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
    nuevoMiembro('add');   
    //Grupo Familiar


});
