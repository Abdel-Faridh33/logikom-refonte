<?php
session_start();


if (!isset($_SESSION['admin'])) {
    
    header('Location: index.php');
}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Les commandes | Logikom </title>
    <meta name="keywords" content="Logikom">
    <meta name="description" content="Logikom">
    <meta name="author" content="p-themes">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon.png">
    <link rel="manifest" href="assets/images/icons/site.html">
    <link rel="mask-icon" href="assets/images/icons/safari-pinned-tab.svg" color="#666666">
    <meta name="apple-mobile-web-app-title" content="Logikom">
    <meta name="application-name" content="Logikom">
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

?>

<body>
    <div class="page-wrapper" >
        <header class="header header-intro-clearance header-3" style="background-color: white;">

            <div class="header-top" style="background-color:white;">
                <div class="container">
                    <div class="header-left">
                        <div class="header-dropdown">
                            <a style="font-size: 15px; color: #004f80e2;" href="https://wa.me/+33621412011"><i class="icon-whatsapp"></i><b> +33 6 21 41 20 11 </b></a>

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
        			<h1 class="page-title">Commande en attente</h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Commande en attente</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
            	<div class="cart">
	                <div class="container">
	                	<div class="row" id="resultat_chargement">

<?php


    // Si il y a une demande de suppression, on l'execute
        if (isset($_GET['id_execute_commande']) and $_GET['id_execute_commande'] != '' ) {
            

            $update = $lock->prepare('UPDATE commerce_commande SET Statut = ? WHERE Id_commande = ? ');
            $update->execute(array( 1, $_GET['id_execute_commande'] ));
        }


                    
                echo '

                        <div class="col-lg-12" >
                                <table class="table  ">
                                    <thead>
                                        <tr>
                                            <th>Nom et Prenom </th>
                                            <th>Lieu</th>
                                            <th>Numero</th>
                                            <th>Email</th>
                                            <th>Date</th>
                                            <th>Suppr</th>
                                        </tr>
                                    </thead>

                                    <tbody>';

        $select0 = $lock->prepare('SELECT * FROM commerce_commande WHERE Statut = ? ');
        $select0->execute(array( 0 ));

        $total = 0; $i = 1;

        while ($select = $select0->fetch()) {

           
            
            echo  '

                                    <tr id="tr_panier'.$i.'">
                                            <td class="product-col" style="color: #0077b6">
                                                <a href="#modal_modifie'.$i.'" id="modal_modifie_popup'.$i.'"  data-toggle="modal">'.$select['Nom'].' '.$select['Prenom'].'</a>
                                            



    <div class="modal fade" id="modal_modifie'.$i.'" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill" role="tablist">
                                <li class="nav-item">
                                    <span class="nav-link active" data-toggle="tab" >'.$select['Nom'].' '.$select['Prenom'].'</span>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab-content-5">
                                <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="signin-tab">
                                    
                                    <table>
                                        <thead>
                                            <tr>
                                                <td>Article</td>
                                                <td>Qté</td>
                                                <td style="text-align: right;">Prix</td>
                                            </tr>
                                        </thead>
                                        <tbody>';

        $article0 = $lock->prepare('SELECT cmd.Quantite, cmd.Montant, art.Id, Titre, Image FROM commerce_commande_article AS cmd INNER JOIN commerce_article AS art ON art.Id = cmd.Article WHERE Id_commande = ? ');
        $article0->execute(array( $select['Id_commande'] ));

                    $total = 0;

                    while ( $article = $article0->fetch() ) {
                        

                        $total += $article['Montant'];

                            echo '

                                    <tr>
                                        <td>
                                            <div class="product">
                                                    <figure class="product-media">
                                                        <a target="_blanc" href="product.php?id_product='.$article['Id'].'">
                                                            <img src="assets/images/article/'.$article['Image'].'" alt="Image article">
                                                        </a>
                                                    </figure>

                                                    <h3 class="product-title">
                                                        <a target="_blanc" href="product.php?id_product='.$article['Id'].'">'.$article['Titre'].'</a>
                                                    </h3>
                                                </div>
                                        </td>
                                        <td style="color: indigo;">'.$article['Quantite'].'</td>
                                        <td style="color: indigo; text-align: right;">'.$article['Montant'].'</td>
                                    </tr>';

                    }

                    
                $sel_livr0 = $lock->prepare('SELECT * FROM commerce_commande_livraison WHERE Id_commande = ? ');
                $sel_livr0->execute(array( $select['Id_commande'] ));
                $sel_livr = $sel_livr0->fetch();

                        $total += $sel_livr['Montant'];

                            echo '

                                <tr>
                                    <td colspan="2"> <h5>Livraison </h5> </td>
                                    <td style="text-align: right;"> <h5> '.$sel_livr['Montant'].' </h5> <td>
                                </tr>

                                <tr style="color: red;">
                                    <td colspan="2"> <h3>Total</h3> </td>
                                    <td style="text-align: right;"> <h3> '.$total.' </h3> <td>
                                </tr>


                                        </tbody>

                                    </table>

                                    <div style="text-align: center;">
                                        <a href="?id_execute_commande='.$select['Id_commande'].'" style="width: 100%;" class="btn btn-outline-primary-2"><span ><div style="width:5cm;">Executer</div></span><i class="icon-long-arrow-right"></i></a>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>       

                                                </td>
                                                <td class="price-col">'.$select['Lieu'].'</td>
                                                <td class="quantity-col">
                                                    '.$select['Numero'].'
                                                </td>
                                                <td class="" >'.$select['Mail'].'</td>
                                                <td class="" >'.$select['Date'].'</td>
                                                <td style="color:red; text-align: right;" > <div onclick="supprimer_commande('.$select['Id_commande'].')" > <i class="icon-close" > </i> </div> </td>
                                            </tr>                   

            ';

            $i++;
        }


        echo '

                                    </tbody>
                                </table>

                            </div>';






?>
	                

	                	</div><!-- End .row -->
	                </div><!-- End .container -->
                </div><!-- End .cart -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->

    
<?php

    include_once('footer.php');
    
    include_once('mobile_menu.php');

    include_once('register.php');

?>


    <!-- Page de traitement en cours -->
<div id="patience0" style="position: fixed; background: black; opacity: 70%; top: 0px; left: 0px; width: 100%; height: 100%; z-index: 9995; display: none;"></div>
<div id="patience1" style="position: fixed;  top: 0px; left: 0px; width: 100%; height: 100%; z-index: 9995; display: none; ">
    <div style="position: relative; top: calc(50% - 25px); width: 100%; text-align: center; opacity: 1;"><img style="height: 50px; " alt="AuxSommets" src="patience.gif"></div>
</div>

    <!-- Plugins JS File -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.hoverIntent.min.js"></script>
    <script src="assets/js/jquery.waypoints.min.js"></script>
    <script src="assets/js/superfish.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/bootstrap-input-spinner.js"></script>
    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

    <script src="assets/sweetalert/sweetalert.min.js"></script>


    <script type="text/javascript">
        
        
    

        function supprimer_commande(id_commande){


            swal({
            title: "Sûr de vouloir supprimer la commande ?",
            text: "La suppression est irréversible !!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Oui ",
            cancelButtonText: "Non",
            closeOnConfirm: true,
            closeOnCancel: true
            },
            function(){

                $('#patience0').show();
                $('#patience1').show();

                $.ajax({
                    url: 'commande_traitement.php',
                    method: 'POST',
                    timeout: 15000,
                    data: {
                        supprime_commande: "oui",
                        id_commande: id_commande,
                    },
                    success: function(html){
                        
                        if (html == 1 ) {

                            location.reload(true);
                        
                        }
                         
                    },
                    error : function(erreur){


                        sweetAlert("Oops...", "Problème de connexion, veuillez rééssayer !!", "error");  
                    },  
                    
                }); 

            });
  
        }


    </script>
</body>



</html>