$(document).ready(function(){

    // Cuenta / perfil 
    const myNodePencil = document.getElementsByClassName('pencil');
    const div = document.getElementsByClassName("tools");    
    if(myNodePencil){        
        for (i = 0; i < myNodePencil.length; i++) {            
            for (i = 0; i < div.length; i++) {
                div[i].id = ("show_"+i); //add id
                div[i].classList.add('hidden'); //add class hidden                
                myNodePencil[i].setAttribute("data-number", +i); //add data-number
            }
        }
    }       
    $('.pencil').click(function(e){
        var id = this.dataset['number'];
        $("#show_"+id).slideToggle(250);
        $("#show_"+id).removeClass("hidden");
    });

    // Not finish yet 
    $('.avatar').hover(function(){ 
        // $('#avatar-pencil').addClass('avatar-pencil');
        $('#avatar-link').css('display','block');
        
    }, function(){
        $('#avatar-link').css('display','none'); 
    });
    // Cuenta / perfil 

    // Notificaciones
    $('.notificaciones').click(function(e){
        $(".notificaciones_region").slideToggle(550);
    });
    $('.region_footer_link').click(function(e){
        $(".notificaciones_region").slideUp(250);
    });
    // Notificaciones

    // Filtro 
    $('.filtrar').click(function(e){
        var id = this.dataset['number'];
        $(".filtro"+id).toggle('slow')
        $(".filtro"+id).removeClass("hidden");
    });
    // Filtro 

// ********************************************************************************************************************
  

});
