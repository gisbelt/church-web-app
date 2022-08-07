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
        newMiembro = $('.new-miembro');    
        newMiembro.empty;
        // Validate that all variables exist
        if(add && newMiembro){
            $('.add').on('click', function (e){
                const miembro = $('#miembro').val();
                const miembroLista = $('#miembroLista').text();
                for (let i = 0; i < 1; i++) {
                    var div = $("<div class='miembro-group"+i+" form-group'></div>");
                    var input = $("<input type='text' required name='miembro"+i+"' class='form-control form-input mb-4' id='integrante"+i+"' value='"+miembro+"' placeholder=' '> <label for='integrante"+i+"' class='form-label fw-bold' id='form-label'>Integrante:</label> ");
                    div.append(input);
                    newMiembro.append(div);
                }
                $('#miembro').val(''); 
            })
            $('.addLista').on('click', function (e){
                const miembro = $(this).parents("tr").find("#miembroLista").text();
                for (let i = 0; i < 1; i++) {
                    var div = $("<div class='miembro-group"+i+" form-group'></div>");
                    var input = $("<input type='text' required name='miembro"+i+"' class='form-control form-input mb-4' id='integrante"+i+"' value='"+miembro+"' placeholder=' '> <label for='integrante"+i+"' class='form-label fw-bold' id='form-label'>Integrante:</label> ");
                    div.append(input);
                    newMiembro.append(div);
                }
                $('#miembro').val('');
            })
        }
    }
    nuevoMiembro('add');
    //Grupo Familiar


});
