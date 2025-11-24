<?php
session_start();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Services | Logikom </title>
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
    <meta name="theme-color" content="#ffffff">
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
        .product:hover {border: 1px solid silver; border-radius: 20px; box-shadow: 3px 3px 3px silver;}
    </style>
</head>


<?php

include_once('base/connexion_base_donne.php');
include_once('id_user.php');

include_once('fonction.php');


?>

<body>
    <div class="page-wrapper">
        <header class="header">
            <div class="header-middle sticky-header">
                <div class="container">
                    <div class="header-left">
                        <button class="mobile-menu-toggler">
                            <span class="sr-only">Toggle mobile menu</span>
                            <i class="icon-bars"></i>
                        </button>

                        <a href="index.php" class="logo">
                            <img src="assets/images/logo-footer.png" alt="Logo" width="200">
                        </a>

                        <nav class="main-nav">
                            <ul class="menu sf-arrows">
                                <li class="">
                                    <a href="index.php" >Accueil</a>   
                                </li>
                                <li>
                                    <a href="boutique.php" class="sf-with-ul">Boutique <i class="fa fa-eye"></i></a>
                                    <ul>
<?php
    
    $categorie0 = $lock->query('SELECT * FROM commerce_categorie ORDER BY Nom ');


    $elementCategorie = ""; $index_cat = 0;
    while ($categorie = $categorie0->fetch()) {
        
                                    $elementCategorie .= '<li><a href="categorie.php?index='.$categorie['Id'].'&token='.sha1($index_cat.time().$index_cat).'">'.$categorie['Nom'].'</a></li>';

        $index_cat++;                            
    }
                                echo $elementCategorie;

?>
                                    </ul>
                                </li>
                                <li class="active">
                                    <a href="service.php" >Services</a>
                                </li>

                                <li>
                                    <a href="contact.php" >Contact</a>
                                </li> 

<?php
    if (isset($_SESSION['admin'])) {

        include_once('lien-admin.php'); 
    } 

?>                              
                                
                            </ul><!-- End .menu -->
                        </nav><!-- End .main-nav -->
                    </div><!-- End .header-left -->

<?php

            include_once('panier_popup2.php');



?>
                    
                </div><!-- End .container -->
            </div><!-- End .header-middle -->
        </header><!-- End .header -->

        <main class="main" style="background-image: url(image/fond.jpg);">
        	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        		<div class="container">
        			<h1 class="page-title"> Services </h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Services</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="container">
                	<div class="row">
                		<div class="col-lg-12">

                            <div class="products mb-3">
                                <div class="row justify-content-center">


<?php

$select0 = $lock->query('SELECT * FROM service ORDER BY RAND() LIMIT 8 ');

$i = 0;
while ( $select = $select0->fetch()) {
        
    echo '<input class="nombre_article_defaut" id="nombre_article_defaut'.$i.'" type="hidden" value="'.$select['Id'].'">';

    echo '                                    
                                    <div class="col-6 col-md-3 col-lg-3">
                                        <div class="product product-2 text-center">
                                            <figure class="product-media">
                                                
                                                <a href="service_detail.php?id_product='.$select['Id'].'&token='.sha1($i.time().$i).'">
                                                    <img src="assets/images/service/'.$select['Image'].'" alt="Product image" class="product-image">
                                                </a>

                                                <div class="product-action product-action-dark">
                                                    <a href="service_detail.php?id_product='.$select['Id'].'&token='.sha1($i.time().$i).'" class="btn-product btn-cart" ><span> Consulter </span></a>
                                                </div>
                                            </figure>

                                            <div class="product-body">
                                        
                                                <h3 class="product-title"><a href="service_detail.php?id_product='.$select['Id'].'&token='.sha1($i.time().$i).'">'.$select['Titre'].'</a></h3>
                                                
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

        $('input.nombre_article_defaut').text(function(index, actuel){
            
            var id_deja_affiche = $('input#nombre_article_defaut'+index).val();
            id_deja_affiche_tableau = id_deja_affiche_tableau +','+ id_deja_affiche;

            index_defaut = index;
        });

        $.ajax({ 
            url : 'service_traitement.php', 
            method: "POST", 
            dataType : 'html',
            timeout: 15000,
            data: {
                voir_plus: "oui",
                index: index_defaut,
                id_deja_affiche_tableau: id_deja_affiche_tableau,
            },
                success : function(code_html, statut){

                    $('#patience0').hide();
                    $('#patience1').hide();
                    $('#nouvelle_affiche').replaceWith(code_html);
                    // alert(code_html);
 
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