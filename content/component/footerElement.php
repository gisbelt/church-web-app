<?php

namespace content\component;

class footerElement{

    static public function Footer(){
        echo (
        '          
       <!-- Section: Links  -->
       <section class="">
           <div class="container text-center text-md-start">
               <!-- Grid row -->
               <div class="row mt-4">
                   <!-- Grid column -->
                   <div class="col-md-12 col-lg-12 col-xl-12 mx-auto">
                       <!-- Links -->
                       <div class="background_img"> 
                        <img src="public/assets/img/logo.png" alt=""> 
                        <h6 class="text-uppercase text-center">Iglesia Evangélica La Gracia de Dios</h6>
                       </div>
                       <hr class="mt-0 d-inline-block mx-auto" style="width: 100%; background-color: #0191b3; height: 2px" />
                   </div>
                   <!-- Grid column -->
               </div>
               <!-- Grid row -->
           </div>
       </section>
       <!-- Section: Links  -->
       
       <!-- Copyright -->
       <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
           © 2022 Copyright: 
           <a class="text-white" href="http://upaebvirtual.edu.ve/web/"> Uptaeb</a>
       </div>
       <!-- Copyright -->
            
        '
        );
    }
}

?>