

					<div class="header-right">

						<!-- <div class="dropdown cart-dropdown">
                            <a href="tel:<?php echo $para['Numero']; ?>" class="dropdown-toggle">
                                <div class="icon" style="font-size: 25px; ">
                                    <i class="icon-phone"></i> <b><?php echo $para['Numero']; ?></b>
                                </div>
                            </a>
                        </div> -->

                        <!-- <div class="dropdown cart-dropdown">
                            <a href="#signin-modal" class="dropdown-toggle" data-toggle="modal">
                                <div class="icon" style="font-size: 25px; ">
                                    <i class="icon-user"></i>
                                </div>
                            </a>
                        </div> -->

                        <div class="dropdown cart-dropdown">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                <div class="icon">
                                    <i class="icon-shopping-cart"></i>
                                    <span class="cart-count" style="color: white; background-color: red;"> <span id="nombre_produit_panier"></span> </span>
                                </div>
                                <p style="color: white;">Panier</p>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                                

                                <span id="produit_panier"></span>

                                <div style="text-align: center;">
                                    <!-- <a href="panier.php" class="btn btn-primary">Voir panier</a> -->
                                    <a href="panier.php" class="btn btn-outline-primary-2"><span ><div style="width:5cm;">Voir panier</div></span><i class="icon-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
					</div> 



<script type="text/javascript">
    
    // Nombre d'article dans le panier
    setInterval( function(){

        var id_user = localStorage.getItem("id_user");
        
        $.ajax({
        url : "panier_popup_traitement.php?nombre&id_user="+id_user,
        type : "GET",
            success : function(donne){
            $('#nombre_produit_panier').replaceWith(donne);
            },
        });

    }, 2000);

    // Les articles qui sont dans le panier
    setInterval( function(){

        var id_user = localStorage.getItem("id_user");
        
        $.ajax({
        url : "panier_popup_traitement.php?article&id_user="+id_user,
        type : "GET",
            success : function(donne){
            $('#produit_panier').replaceWith(donne);
            },
        });

    }, 2000);
</script>                                           