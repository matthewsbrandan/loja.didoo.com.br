<style>
    .footer_mobile {
        position: fixed;
        bottom: 0;
        width: 100%;
    }
</style>
<br><br><br>

 

<!---FOOTER MOBILE------>
    <footer class="continer-fluid footer_mobile d-lg-none"  style="background-color: #7800B4;">
	    <div class="card mx-3 p-2 px-2 fixed" style="border-radius:40px; margin-top:-35px">
	    	<div class="d-flex flex-wrap justify-content-between">
	    	    
        	  	<div class="col-2">
        	  	    <a target="_blank" href="https://www.google.com/maps/search/?api=1&query={{ urlencode($restorant->address) }}">
        	          <i class="ri-map-pin-2-line h5"></i> 
        	        </a>
        	   	</div>
        	   	<div class="col-2">
        	   	     <div data-toggle="modal" data-target="#modal-forms">
        	            <i class="ri-instagram-line h5"></i> 
        	         </div>
        	   	</div>
        	   	<div class="col-2">
        	   	    <div data-toggle="modal" data-target="#avaliar">
        	   	       <span class="" style="position:fixed; margin-top:-10px; margin-left:20px; border-radius:50%; background:#7800B4; padding:3px 6px 3px 6px; color:white; font-size:10px">
                        <span><?= count($avaliacoes); ?></span>
                      </span>
        	           <i class="ri-star-line  h5"></i>
        	       </div>
        	    </div>
        	   	<div class="col-2">
        	   	    <a href="#home">
        	            <i class="ri-home-5-line h5"></i> 
        	        </a>
        	   	</div>
        	   	<div class="col-2">
        	   	     <div onclick="openNav()">
        	          
        	         <span class=""> 
        	         <span class="" style="position:fixed; margin-top:-10px; margin-left:20px; border-radius:50%; background:#7800B4; padding:3px 6px 3px 6px; color:white; font-size:10px">
                        <span id="qtd-here">0</span>
                      </span>
        	         <i class="ri-shopping-cart-line h5"></i> 
                      
                     </span>
        	          
        	         </div>
        	    </div>
        	    
	        </div>
	    </div>
	    <div class="row text-white mx-2 mt-2" style="font-size:13px">
	         <div class="col">
	             LGPD 
	         </div>
	          <div class="col text-center">
	            Criado com:<br/> <h6 class="text-white">Didoo</h6>
	         </div>
	          <div class="col" style="text-align:right">
	             Privacidade
	         </div>
	    </div>
	 </footer>
@include('restorants.partials.modal_search')