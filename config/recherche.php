<?php
session_start();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Recherche | Logikom </title>
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
    <link rel="stylesheet" href="assets/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/plugins/nouislider/nouislider.css">
    <link href="assets/css/sweetalert/sweetalert.css" rel="stylesheet">
    <style >
        .more-container:hover { Color: white; }
    </style>
</head>


<?php

include_once('base/connexion_base_donne.php');
include_once('id_user.php');

include_once('fonction.php');



if (isset($_GET['q']) and $_GET['q'] != '') {
    
    $text_recherche = htmlspecialchars(trim($_GET['q']));

}else {

    header('Location: index.php');
}


?>

<body>
    <div class="page-wrapper" style="">
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
                    <h1 class="page-title"><?php echo $text_recherche; ?> </h1>
                </div><!-- End .container -->
            </div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Recherche</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content" style="background-image: url(image/fond.jpg);">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="products mb-3">
                                <div class="row justify-content-center">


<?php

echo '<div id="divTextRecherche" style="display:none;">'.$text_recherche.'</div>';

$text_recherche = "%".$text_recherche."%";


$select0 = $lock->prepare('SELECT * FROM commerce_article WHERE Titre LIKE ? OR Resume LIKE ? ORDER BY RAND() LIMIT 12 ');
$select0->execute(array($text_recherche, $text_recherche));

$i = 0;
while ( $select = $select0->fetch()) {

    $select_cat0 = $lock->prepare('SELECT Nom FROM commerce_categorie WHERE Id = ? ');
    $select_cat0->execute(array( $select['Categorie'] ));
    $select_cat = $select_cat0->fetch();
        
    echo '<input class="nombre_article_defaut" id="nombre_article_defaut'.$i.'" type="hidden" value="'.$select['Id'].'">';

    echo '                                    
                                    <div class="col-6 col-md-3 col-lg-3">
                                        <div class="product product-2 text-center">
                                            <figure class="product-media">
                                                <span class="product-label label-circle label-new"> -'.$select['Reduction'].'%  </br></span>
                                                <a href="product.php?id_product='.$select['Id'].'&token='.sha1($i.time().$i).'">
                                                    <img src="assets/images/article/'.$select['Image'].'" alt="Product image" class="product-image">
                                                </a>

                                                <div class="product-action product-action-dark">
                                                    <a onclick="AjoutPanier('.$select['Id'].', 1)" class="btn-product btn-cart" ><span> Ajouter au panier </span></a>
                                                </div>
                                            </figure>

                                            <div class="product-body">
                                                <div class="product-cat">
                                                    <a href="#">'.$select_cat['Nom'] .'</a>
                                                </div>
                                                <h3 class="product-title"><a href="product.php?id_product='.$select['Id'].'&token='.sha1($i.time().$i).'">'.$select['Titre'].'</a></h3>
                                                <div class="product-price">
                                                    <span class="new-price"> '.convertir_devise($select['Prix_reduction'], $para['Devise']).'</span>
                                                    <span class="old-price"> '.convertir_devise($select['Prix_norm'], $para['Devise']).'</span>
                                                </div>
                                                <div class="ratings-container">
                                                    <div class="ratings">
                                                        <div class="ratings-val" style="width: 90%;"></div>
                                                    </div>
                                                    <span class="ratings-text">( '.$select['Review'].' Vues )</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            ';

        $i++;
    }
    
?>            
                                    <div id="nouvelle_affiche"></div>
                                </div><!-- End .row -->
                            </div><!-- End .products -->

                <!-- Voir plus -->
                <div class="more-container text-center mt-3 mb-0 ">
                    <a id="voir_plus" class="btn btn-outline-primary-2 btn-round btn-more">  <span>Voir plus</span><i class="icon-long-arrow-right"></i> </a>
                </div>
                            
                        </div><!-- End .col-lg-9 -->
                        
                    </div><!-- End .row -->
                </div><!-- End .container -->
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
    <div style="position: relative; top: calc(50% - 25px); width: 100%; text-align: center; opacity: 1;"><img style="height: 50px; padding-left: calc(50% - 25px);" alt="AuxSommets" src="assets/images/patience.gif"></div>
</div>


    <!-- Plugins JS File -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.hoverIntent.min.js"></script>
    <script src="assets/js/jquery.waypoints.min.js"></script>
    <script src="assets/js/superfish.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/wNumb.js"></script>
    <script src="assets/js/bootstrap-input-spinner.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/nouislider.min.js"></script>

    <script src="assets/sweetalert/sweetalert.min.js"></script>
    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

<script type="text/javascript">
    
    $('#voir_plus').click(function(e){

        $('#patience0').show();
        $('#patience1').show();
        
        var id_deja_affiche_tableau = "000";
        var index_defaut = "";

        var text_recherche = $('#divTextRecherche').text();

        $('input.nombre_article_defaut').text(function(index, actuel){
            
            var id_deja_affiche = $('input#nombre_article_defaut'+index).val();
            id_deja_affiche_tableau = id_deja_affiche_tableau +','+ id_deja_affiche;

            index_defaut = index;
        });

        $.ajax({ 
            url : 'recherche_traitement.php', 
            method: "POST", 
            dataType : 'html',
            timeout: 15000,
            data: {
                voir_plus: "oui",
                index: index_defaut,
                id_deja_affiche_tableau: id_deja_affiche_tableau,
                text_recherche: text_recherche,
                
            },
                success : function(code_html, statut){

                    $('#patience0').hide();
                    $('#patience1').hide();
              
 
                },

                error : function(erreur){

                        sweetAlert("Oops...", "Problème de connexion, veuillez rééssayer !!", "error");  
                },
            });

        // alert(id_deja_affiche_tableau);
    });

</script>
</body>



</html>