<?php
session_start();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Valider commande | Logikom </title>
    <meta name="keywords" content="Logikom">
    <meta name="description" content="Logikom">
    <meta name="author" content="p-themes">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon.png">
    <link rel="manifest" href="assets/images/icons/site.html">
    <link rel="mask-icon" href="assets/images/icons/safari-pinned-tab.svg" color="#666666">
    <meta name="apple-mobile-web-app-title" content="Electronic Shop Express">
    <meta name="application-name" content="Electronic Shop Express">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#004f80e2">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/sweetalert/sweetalert.css">
</head>


<?php

include_once('base/connexion_base_donne.php');
include_once('fonction.php');

            
if (isset($_GET['id_product']) and $_GET['id_product'] != '') {
    
    $id_produit = htmlspecialchars(trim($_GET['id_product']));

    $selecte_produit0 = $lock->prepare('SELECT * FROM commerce_article WHERE Id = ? ');
    $selecte_produit0->execute(array($id_produit));
    $selecte_produit = $selecte_produit0->fetch();

    if (!isset($selecte_produit['Id'] ) or $selecte_produit['Id'] == '' ) {
        
        header('Location: index.php');
    }
}            

?>  


<body>
    <div class="page-wrapper">
        <header class="header header-intro-clearance header-3" style="background-color: white;">

            <div class="header-top" style="background-color:white;">
                <div class="container">
                    <div class="header-left">
                        <div class="header-dropdown">
                            <a style="font-size: 15px; color: #004f80e2;" href="https://wa.me/+2290191939393"><i class="icon-whatsapp"></i><b> +229 01 91 93 93 93 </b></a>

                            <a style="font-size: 15px; color: #004f80e2;" href="tel:<?php echo $para['Numero']; ?>"><i class="icon-phone"></i><b> <?php echo $para['Numero']; ?> </b> </a>
                            
                        </div>
                        
                    </div><!-- End .header-left -->

                    <div class="header-right">

                        <div class="header-dropdown">
                            <a style="font-size: 15px; color: #004f80e2;" href="mailto:<?php echo $para['Mail']; ?>"><i class="icon-envelope"></i> <b> <?php echo $para['Mail']; ?> </b> </a>

                            <a style="font-size: 15px; color: #004f80e2;" target="_blanc" href="https://maps.app.goo.gl/uYpBm5C98qdKbG5Y7"><i class="icon-map-marker"></i> <b> <?php echo $para['Location']; ?> </b> </a>
                            
                        </div>
                    </div><!-- End .header-right -->

                </div><!-- End .container -->
            </div><!-- End .header-top -->

            <div class="header-middle" style="background-color: #004f80e2;">
                <div class="container">
                    <div class="header-left">
                        <button class="mobile-menu-toggler">
                            <span class="sr-only">Toggle mobile menu</span>
                            <i class="icon-bars"></i>
                        </button>
                        
                        <a href="index.php" class="logo">
                            <img src="assets/images/logo.png" alt="Logikom" width="250">
                        </a>
                    </div>

                    <div class="header-center">
                        <div class="header-search header-search-extended header-search-visible d-none d-lg-block">
                            <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                            <form action="recherche.php" method="get" autocomplete="off">
                                <div class="header-search-wrapper search-wrapper-wide">
                                    <label for="q" class="sr-only">Recherche</label>
                                    <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                                    <input type="search" class="form-control" name="q" id="q" placeholder="Recherche de produits ou services" required>
                                </div>
                            </form>
                        </div>

                        <div class="dropdown cart-dropdown">
                            <a href="#signin-modal" class="dropdown-toggle" data-toggle="modal">
                                <div class="icon" style="font-size: 25px; ">
                                    <i class="icon-user"></i>
                                </div>
                                <p style="color: white;">Login</p>
                            </a>
                            
                        </div>

                        <div class="dropdown cart-dropdown">
                            <a href="contact.php" class="dropdown-toggle">
                                <div class="icon" style="font-size: 25px; ">
                                    <i class="icon-phone"></i>
                                </div>
                                <p style="color: white;">Contact</p>
                            </a>

                        </div>
                        
                    </div>

<?php

            include_once('panier_popup.php');

?>                          
                </div>
            </div>

            <div class="header-bottom sticky-header">
                <div class="container">
                    
                    <div class="header-center" style="text-align: center;">
                        <nav class="main-nav">
                            <ul class="menu ">
                                <li >
                                    <a href="index.php" class="">Accueil</a>

                                </li>

<?php

    $categorie0 = $lock->query('SELECT * FROM commerce_categorie_grande ORDER BY Id ');

    while ($categorie = $categorie0->fetch()) {

        echo '
                                <li>
                                    <a href="#" >'.$categorie['Nom'].'</a>
                                    <ul>
        ';


        $cat0 = $lock->prepare('SELECT * FROM commerce_categorie WHERE Grande = ? ORDER BY Id ');
        $cat0->execute(array($categorie['Id']));

        $index_cat = 0;
        while ($cat = $cat0->fetch()) {  

            echo '
                                    <li><a style="text-align: left;" href="categorie.php?index='.$cat['Id'].'&cat='.$cat['Grande'].'&token='.sha1($index_cat.time().$index_cat).'"><b>'.$cat['Nom'].'</b></a></li>
            '; 
            $index_cat++;
        }

        echo '
                                    </ul>
                                </li>
        ';
    }

?>
                                
                                <li>
                                    <a href="contact.php">Contact</a>
                                </li> 

<?php
    if (isset($_SESSION['admin'])) {

        include_once('lien-admin.php'); 
    } 

?>                                                  
                                
                            </ul>
                        </nav>
                    </div>

                    
                </div>
            </div>
        </header>

        <main class="main">
        	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        		<div class="container">
        			<h1 class="page-title">Validation<span>Commande</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Commande</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content" style="">
            	<div class="checkout">
	                <div class="container">
            			
            			<form action="#" method="POST" id="form_valide_commande">
		                	<div class="row">
		                		<div class="col-lg-9">
		                			<h2 class="checkout-title">Informations personnelles</h2><!-- End .checkout-title -->
		                				<div class="row">
		                					<div class="col-sm-6">
		                						<label>Nom *</label>
		                						<input type="text" name="nom" id="nom" class="form-control" required>
		                					</div><!-- End .col-sm-6 -->

		                					<div class="col-sm-6">
		                						<label>Prénoms *</label>
		                						<input type="text" name="prenom" id="prenom" class="form-control" required>
		                					</div><!-- End .col-sm-6 -->
		                				</div><!-- End .row -->

	            						<label>Lieu *</label>
	            						<input type="text" name="lieu" id="lieu" class="form-control" required>

		                				<div class="row">
		                					<div class="col-sm-6">
		                						<label>Numéro téléphone *</label>
		                						<input type="number" name="telephone" id="telephone" class="form-control" required>
		                					</div><!-- End .col-sm-6 -->
		                					<div class="col-sm-6">
		                						<label>Adresse email *</label>
	        									<input type="email" name="email" id="email" class="form-control" required>
		                					</div><!-- End .col-sm-6 -->
		                				</div><!-- End .row -->

	                					

		                		</div><!-- End .col-lg-9 -->
		                		<aside class="col-lg-3">
		                			<div class="summary">
		                				<h3 class="summary-title">Votre Commande</h3><!-- End .summary-title -->

		                				<table class="table table-summary">
		                					<thead>
		                						<tr>
		                							<th>Produits</th>
		                							<th>Total</th>
		                						</tr>
		                					</thead>

		                					<tbody id="resultat_chargement">
		                						
		                					</tbody>
		                				</table><!-- End .table table-summary -->

		                				<button type="submit" id="btn_valid_bottom" class="btn btn-outline-primary-2 btn-order btn-block">
		                					<span class="btn-text">Valider la commande</span>
		                					<span class="btn-hover-text">Cliquez pour valider</span>
		                				</button>
		                			</div><!-- End .summary -->
		                		</aside><!-- End .col-lg-3 -->
		                	</div><!-- End .row -->
            			</form>
	                </div><!-- End .container -->
                </div><!-- End .checkout -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->

        
    <?php

    include_once('footer.php');
    
    include_once('mobile_menu.php');

    include_once('register.php');

	?>

    <!-- Plugins JS File -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.hoverIntent.min.js"></script>
    <script src="assets/js/jquery.waypoints.min.js"></script>
    <script src="assets/js/superfish.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="assets/sweetalert/sweetalert.min.js"></script>

    <script type="text/javascript">
    	
    	$(document).ready(function(){
            
            var id_user = localStorage.getItem("id_user");

            $.ajax({
                url : "checkout_traitement.php?", 
                type : "POST",
                data : {
                    affiche_donne: 'oui',
                    id_user: id_user,
                },
                dataType : 'html',
                success : function(html){
                	var retour = html.split('@@@');

                	if (retour[1] == '0' ) { 
                		$('#btn_valid_bottom').css('display', 'none'); 
                	}

                    $('#resultat_chargement').replaceWith(retour[0]); 

                },            
            });
        });



        // Validation de la commande
    	$('#form_valide_commande').submit(function(e){
    		e.preventDefault();

    		var id_user = localStorage.getItem("id_user");

    		var nom = $('#nom').val();
    		var prenom = $('#prenom').val();
    		var lieu = $('#lieu').val();
    		var telephone = $('#telephone').val();
    		var email = $('#email').val();

    		$.ajax({
                url : "checkout_traitement.php", 
                type : "POST",
                data : {
                	valide_commande: 'oui',
                	nom: nom,
                	prenom: prenom,
                	lieu: lieu,
                	telephone: telephone,
                	email: email,
                	id_user: id_user,
                },
                dataType : 'html',
                success : function(html){

                    if (html == 1 ) {

                        swal("Super !!", "Votre commande a été envoyé avec succès", "success");

                        var nom = $('#nom').val('');
                        var prenom = $('#prenom').val('');
                        var lieu = $('#lieu').val('');
                        var telephone = $('#telephone').val('');
                        var email = $('#email').val('');

                        $('#btn_valid_bottom').hide();
                        $('#resultat_chargement').replaceWith(" ");
                         
                    }else {
                        alert(html);
                    }
                    

                },            
            });

    	});

    </script>
</body>



</html>