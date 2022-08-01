document.addEventListener("DOMContentLoaded", function(event) {
   
  const showNavbar = (toggleId, navId, bodyId, headerId, Body) =>{
  const toggle = document.getElementById(toggleId),
  nav = document.getElementById(navId),
  bodypd = document.getElementById(bodyId),
  headerpd = document.getElementById(headerId),
  // itemShow = document.getElementsByClassName("itemShow")
  body = document.getElementsByTagName(Body);
  
  // Validate that all variables exist
  if(toggle && nav && bodypd && headerpd && body){
  toggle.addEventListener('click', ()=>{
  // show navbar
  nav.classList.toggle('open')
  // change icon
  toggle.classList.toggle('bx-x')
  // add padding to body
  bodypd.classList.toggle('body-pd')
  // add padding to header
  headerpd.classList.toggle('body-pd')
// add padding to tag body
  body[0].classList.toggle('body')

  })
  }
  }
  
  showNavbar('header-toggle','nav-bar','body-pd','header','body')

//************************************************************

  /*===== HOVER ICON =====*/

  
//************************************************************

  /*===== LINK ACTIVE =====*/
  const linkColor = document.querySelectorAll('.nav_link')
  
  function colorLink(){
  if(linkColor){
  linkColor.forEach(l=> l.classList.remove('active'))
  this.classList.add('active')
  }
  }
  linkColor.forEach(l=> l.addEventListener('click', colorLink))
  
//************************************************************

  /*=====Show each nav_link's items=====*/
  $('.nav_link').click(function(e){
    var id = this.dataset['number'];
    $(".item_show_"+id).toggle('slow');
    $(".item_show_"+id).removeClass("hidden");
    $(".dropdown_icon_"+id).css("transform","rotate(180deg)"); //Cambiar al cerrar
  });

//************************************************************

  /*=====Hide itemShow when open or close the navbar=====*/
  $('.header_toggle').click(function(e){
    $(".itemShow").slideUp('');
  });

//************************************************************

  /*=====opening a sub menu close others=====*/
  

//************************************************************


});