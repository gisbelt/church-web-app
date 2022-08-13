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
        if(shouldHover == true){
          shouldHover = false
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
        //change data-value
        nav.dataset.value = "inactivo"
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
  body = document.getElementsByTagName('body');
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
      //change data-value
      navBar.dataset.value = "inactivo"
      
      $(".itemShow").slideUp('');
    }   
    }) 
  }
  showNavbarHover();
  
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
  var open = false;
  $('.nav_link').click(function(e){
    var id = this.dataset['number'];
    $(".item_show_"+id).toggle('slow');
    $(".item_show_"+id).removeClass("hidden");
    if(open){
      $(".dropdown_icon_"+id).css("transform","rotate(0deg)"); 
    } else{
      $(".dropdown_icon_"+id).css("transform","rotate(180deg)");
    }
    open = !open;
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