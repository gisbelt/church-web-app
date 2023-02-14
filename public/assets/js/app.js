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
    $('#noti-i').click(function(e){
        $(".notificaciones_region").slideToggle(250);
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

    //Actividades Tabs
    const tab_active = document.querySelectorAll('.tabs-link')
    const tab_content = document.querySelectorAll('.tabs-content')
    function activeLink() {
        if(tab_active) {
            tab_active.forEach(l=> l.classList.remove('active'))
            this.classList.add('active')
            let id = this.id
            tab_content.forEach(t=> {
                if( t.id === id ) {
                    t.classList.add('active-tab')
                    t.classList.remove('hidden')
                } else {
                    t.classList.add('hidden')
                    t.classList.remove('active-tab')
                }
            })
           
        }
    }
    tab_active.forEach(l=> l.addEventListener('click', activeLink))
    //Actividades Tabs

// ********************************************************************************************************************
  
});
