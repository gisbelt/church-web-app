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

});
