document.addEventListener("DOMContentLoaded", function(event) {
   
  var shouldHover = true;
  /*===== CLICK NAVBAR  =====*/
  const showNavbar = (toggleId, navId, bodyId, headerId, Body) =>{
  const toggle = document.getElementById(toggleId),
  nav = document.getElementById(navId),
  bodypd = document.getElementById(bodyId),
  headerpd = document.getElementById(headerId),
  body = document.getElementsByTagName(Body);
    // Validate that all variables exist
    if(toggle && nav && bodypd && headerpd && body){
      toggle.addEventListener('click', ()=>{
        // turn off hover
        if(shouldHover){
          shouldHover = false;
        }else{
          shouldHover = !shouldHover;
        }        
        // show navbar
        nav.classList.toggle('open')  
        // change icon
        toggle.classList.toggle('bx-x')
        // add padding to body-pd
        bodypd.classList.toggle('body-pd')
        // add padding to header
        headerpd.classList.toggle('body-pd')
        // add padding to tag body
        body[0].classList.toggle('body')
        // display and hide nav_dropdown_icon
        if(nav.classList.toggle('true')){
          $(".nav_dropdown_icon").css("display","block"); 
        }else{
          $(".nav_dropdown_icon").css("display","none");
          $(".nav_dropdown_icon").removeClass('rotate-icon');            
        }
        
      })
    }
  }
  
  showNavbar('header-toggle','nav-bar','body-pd','header','body');

//************************************************************

  /*===== HOVER NAVBAR  =====*/
  const showNavbarHover = () =>{
  const navBar= document.getElementById("nav-bar"),
  toggle = document.getElementById('header-toggle'),
  bodypd = document.getElementById('body-pd'),
  headerpd = document.getElementById('header'),
  body = document.getElementsByTagName('body'),
  nav_dropdown_icon = document.querySelectorAll("nav_dropdown_icon");
  $("#nav-bar").hover(function(){
    if (shouldHover) {
      // toggle navbar
      navBar.classList.toggle('open');
      // change icon
      toggle.classList.toggle('bx-x')
      // add padding to body-pd
      bodypd.classList.toggle('body-pd')
      // add padding to header
      headerpd.classList.toggle('body-pd')
      // add padding to tag body
      body[0].classList.toggle('body')
      // Hide itemShow when open or close the navba 
      $(".itemShow").slideUp('');
      // display and hide nav_dropdown_icon
      if(navBar.classList.toggle('true')){
        $(".nav_dropdown_icon").css("display","block"); 
      }else{
        $(".nav_dropdown_icon").css("display","none");
        $(".nav_dropdown_icon").removeClass('rotate-icon');            
      }
    }   
    }) 
  }
  showNavbarHover();
  
//************************************************************

  /*===== LINK ACTIVE =====*/
  const linkColor = document.querySelectorAll('.nav_link')
  
  function colorLink(){
  if(linkColor){
  linkColor.forEach(l=> l.classList.remove('activo'))
  this.classList.add('activo')
  }
  }
  linkColor.forEach(l=> l.addEventListener('click', colorLink))
  
//************************************************************

  /*=====Show each nav_link's items=====*/
  $('.nav_link').click(function(e){
    var id = this.dataset['number'];
    var nav_dropdown_icon = document.querySelectorAll(".dropdown_icon_"+id);
    $(".item_show_"+id).toggle('slow');
    $(".item_show_"+id).removeClass("hidden");
    nav_dropdown_icon[0].classList.toggle('rotate-icon'); 
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