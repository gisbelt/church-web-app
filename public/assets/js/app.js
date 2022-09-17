$(document).ready(function(){

    // Cuenta / perfil 
    $('.editar_perfil').click(function(e){
        var id = this.dataset['number'];
        $(".show_"+id).slideToggle(250);
        $(".show_"+id).removeClass("hidden");
    });
    
    const avatar = document.getElementById('avatar');
    const avatarLink = document.getElementById('avatar-link');
    avatar.addEventListener('mouseenter', (ev) => {
        avatarLink.style.display='block';
    });
    avatar.addEventListener('mouseleave', (ev) => {
        avatarLink.style.display='none';
    })
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
