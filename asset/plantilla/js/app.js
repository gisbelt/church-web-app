document.addEventListener("DOMContentLoaded", function(event) {
   
  const showNavbar = (toggleId, navId, bodyId, headerId) =>{
  const toggle = document.getElementById(toggleId),
  nav = document.getElementById(navId),
  bodypd = document.getElementById(bodyId),
  headerpd = document.getElementById(headerId),
  itemShow = document.getElementsByClassName("itemShow")
  
  // Validate that all variables exist
  if(toggle && nav && bodypd && headerpd){
  toggle.addEventListener('click', ()=>{
  // show navbar
  nav.classList.toggle('open')
  // change icon
  toggle.classList.toggle('bx-x')
  // add padding to body
  bodypd.classList.toggle('body-pd')
  // add padding to header
  headerpd.classList.toggle('body-pd')

  })
  }
  }
  
  showNavbar('header-toggle','nav-bar','body-pd','header')
  
  /*===== LINK ACTIVE =====*/
  const linkColor = document.querySelectorAll('.nav_link')
  
  function colorLink(){
  if(linkColor){
  linkColor.forEach(l=> l.classList.remove('active'))
  this.classList.add('active')
  }
  }
  linkColor.forEach(l=> l.addEventListener('click', colorLink))
  
  // Your code to run since DOM is loaded and ready
  $('.nav_link').click(function(e){
    var id = this.dataset['number'];
    $(".item_show_"+id).toggle('slow')
    $(".item_show_"+id).removeClass("hidden");
  });

  $('.header_toggle').click(function(e){
    $(".itemShow").slideUp('');
    // $(".itemShow").addClass("hidden");
  });

  // Error 
  const lnavbar = document.getElementById("nav-bar");
  if(lnavbar.style.width == '52px;'){
    $(".itemShow").slideUp('');
  }

});