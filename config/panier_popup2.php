

					<div class="header-right">

                        <div class="header-search">
                            <a href="#" class="search-toggle" role="button" title="Recherche"><i class="icon-search"></i></a>
                            <form action="recherche.php" method="get">
                                <div class="header-search-wrapper">
                                    <label for="q" class="sr-only">Recherche</label>
                                    <input type="search" class="form-control" name="q" id="q" placeholder="Recherchez ici..." required>
                                </div><!-- End .header-search-wrapper -->
                            </form>
                        </div><!-- End .header-search -->

						<div class="dropdown cart-dropdown">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                <i class="icon-shopping-cart"></i>
                                <span class="cart-count" style="background-color: red;"> <span id="nombre_produit_panier"></span> </span> </span>
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