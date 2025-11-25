<?php
session_start();


include_once('base/connexion_base_donne.php');


if (isset($_GET['id_product']) and $_GET['id_product'] != '') {
    
    $id_produit = htmlspecialchars(trim($_GET['id_product']));

    $selecte_produit0 = $lock->prepare('SELECT * FROM commerce_article WHERE Id = ? ');
    $selecte_produit0->execute(array($id_produit));
    $selecte_produit = $selecte_produit0->fetch();

    if (!isset($selecte_produit['Id'] ) or $selecte_produit['Id'] == '' ) {
        
        header('Location: index.php');
    }else {

        // On incrément le nombre de vue

        $vue = $selecte_produit['Review']+1;
        $update_vue = $lock->prepare('UPDATE commerce_article SET Review = ? WHERE Id = ? ');
        $update_vue->execute(array($vue, $selecte_produit['Id']));
    }
}else {

    header('Location: index.php');
}


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Produit | Logikom </title>
    <meta name="keywords" content="Logikom">
    <meta name="description" content="Logikom">
    <meta name="author" content="p-themes">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="assets/images/favicon.png">
    <link rel="manifest" href="assets/images/icons/site.html">
    <link rel="mask-icon" href="assets/images/icons/safari-pinned-tab.svg" color="#666666">
    <link rel="shortcut icon" href="assets/images/favicon.png">
    <meta name="apple-mobile-web-app-title" content="Logikom">
    <meta name="application-name" content="Logikom">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#004f80e2">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup/magnific-popup.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/plugins/nouislider/nouislider.css">
    <link href="assets/css/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="assets/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <style>
        .btn_para:hover {
            color: red;
        }
    </style>
    
</head>

<?php


include_once('id_user.php');

include_once('fonction.php');

    
    $categorie0 = $lock->query('SELECT * FROM commerce_categorie ORDER BY Nom ');


    $elementCategorie = ""; $index_cat = 0;
    while ($categorie = $categorie0->fetch()) {
        
        $elementCategorie .= '<li><a href="categorie.php?index='.$categorie['Id'].'&token='.sha1($index_cat.time().$index_cat).'">'.$categorie['Nom'].'</a></li>';
            $index_cat++;                        
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
            <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
                <div class="container d-flex align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Produit</li>
                    </ol>

                    
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="container">
                    <div class="product-details-top">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product-gallery product-gallery-vertical">
                                    <div class="row">

<?php

        echo '                                        
                                        <figure class="product-main-image">
                                            <img id="product-zoom" src="assets/images/article/'.$selecte_produit['Image1'].'" data-zoom-image="assets/images/article/'.$selecte_produit['Image1'].'" alt="Image produit">

                                            <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                                <i class="icon-arrows"></i>
                                            </a>
                                        </figure>';

        if ($selecte_produit['Image1'] != '') {
                                            
                echo '                         

                                        <div id="product-zoom-gallery" class="product-image-gallery">
                                            <a class="product-gallery-item active" href="#" data-image="assets/images/article/'.$selecte_produit['Image1'].'" data-zoom-image="assets/images/article/'.$selecte_produit['Image1'].'">
                                                <img src="assets/images/article/'.$selecte_produit['Image1'].'" alt="Image produit">
                                            </a>';

        }
        if ($selecte_produit['Image2'] != '') {
                                            
                echo '                                   

                                            <a class="product-gallery-item" href="#" data-image="assets/images/article/'.$selecte_produit['Image2'].'" data-zoom-image="assets/images/article/'.$selecte_produit['Image2'].'">
                                                <img src="assets/images/article/'.$selecte_produit['Image2'].'" alt="Image produit">
                                            </a>';

        }
        if ($selecte_produit['Image3'] != '') {
                                            
                echo '
                                            <a class="product-gallery-item" href="#" data-image="assets/images/article/'.$selecte_produit['Image3'].'" data-zoom-image="assets/images/article/'.$selecte_produit['Image3'].'">
                                                <img src="assets/images/article/'.$selecte_produit['Image3'].'" alt="Image produit">
                                            </a>';

        }
        if ($selecte_produit['Image4'] != '') {
                                            
                echo '

                                            <a class="product-gallery-item" href="#" data-image="assets/images/article/'.$selecte_produit['Image4'].'" data-zoom-image="assets/images/article/'.$selecte_produit['Image4'].'">
                                                <img src="assets/images/article/'.$selecte_produit['Image4'].'" alt="Image produit">
                                            </a>
             ';
        }   
        if ($selecte_produit['Image5'] != '') {
                                            
                echo '

                                            <a class="product-gallery-item" href="#" data-image="assets/images/article/'.$selecte_produit['Image5'].'" data-zoom-image="assets/images/article/'.$selecte_produit['Image5'].'">
                                                <img src="assets/images/article/'.$selecte_produit['Image5'].'" alt="Image produit">
                                            </a>
             ';
        }     
?>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="product-details sticky-content">
                                    <h1 class="product-title" style="color: #004f80e2;"> <?php echo $selecte_produit['Titre']; ?> </h1><!-- End .product-title -->

                                    <div class="ratings-container">
                                        <div class="ratings">
                                            <div class="ratings-val" style="width: 90%;"></div>
                                        </div>
                                        <span class="ratings-text" style="color: #941cb3;"><b>( <?php echo $selecte_produit['Review']; ?> Vues )</b></span>
                                    </div><!-- End .rating-container -->

                                    <div class="product-price">
                                        <span class="new-price" style="color:red"> <?php echo convertir_devise($selecte_produit['Prix_reduction'], $para['Devise'] ); ?> </span>
                                        <span class="old-price"><?php echo convertir_devise($selecte_produit['Prix_norm'], $para['Devise'] ); ?></span>
                                    </div><!-- End .product-price -->

                                    <div class="product-content">
                                        <p style="font-family: arial black;">
                                            <?php echo substr($selecte_produit['Resume'], 0, 250); ?>
                                             <a class="ratings-text" href="#product-desc-link" id="review-link">Lire tout</a> 
                                         </p>
                                    </div><!-- End .product-content -->

                                    <div class="details-filter-row details-row-size">
                                        <label for="qty">Quantité:</label>
                                        <div class="product-details-quantity">
                                            <input type="number" id="qty" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required>

                                            <?php echo '

                                            <input type="hidden" id="id_article" value="'.$selecte_produit['Id'].'" >

                                            ';

                                            ?>


                                        </div><!-- End .product-details-quantity -->
                                    </div><!-- End .details-filter-row -->

                                    <div class="product-details-action">
                                        <a href="#" id="AjoutPanier" class="btn-product btn-cart"><span>Ajouter au panier</span></a>

                                    </div><!-- End .product-details-action -->


<?php
    
    if (isset($_SESSION['admin']) AND $_SESSION['admin'] != "" ) {
        
        echo '              
                    <input id="id_produit" type="hidden" value="'.$selecte_produit['Id'].'"  >

                                    <div class="btn_para" style="background-color: #941cb3; width: 75px; padding: 10px 10px; text-align: center; border-radius: 20px; position: fixed; right: 20px; bottom : calc(50% + 30px); "><a href="modifier_article.php?id_product='.$selecte_produit['Id'].'"><i class="fa fa-pencil" style="font-size: 25px; color: white;"></i></a></div>

                                    <div id="suppr_article" class="btn_para" style="background-color: #b31c1c; width: 75px; padding: 10px 10px; text-align: center; border-radius: 20px; position: fixed; right: 20px; bottom : calc(50% - 30px);"><i class="fa fa-trash" style="font-size: 25px; color: white;"></i></div>';
    }
?>



                                </div><!-- End .product-details -->
                            </div><!-- End .col-md-6 -->
                        </div><!-- End .row -->
                    </div><!-- End .product-details-top -->

                    <div class="product-details-tab">
                        <ul class="nav nav-pills justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true" style="font-family: 'Bodoni MT Black';"><span style="font-size: 25px; color: #004f80e2;">Description</span></a>
                            </li>
                            
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                                <div class="product-desc-content">
                                    <h3 style="font-family: Bodoni MT Black; font-size: 30px;">Information du produit</h3>
                                    <p style="font-size: 16px;">

                                        <?php echo $selecte_produit['Description']; ?>

                                    </p>
                                </div><!-- End .product-desc-content -->
                            </div><!-- .End .tab-pane -->
                            
                        </div><!-- End .tab-content -->
                    </div><!-- End .product-details-tab -->

                    <h2 class="title text-center mb-4">Vous pouvez aimer aussi</h2><!-- End .title text-center -->

                    <div class="page-content" style="padding-bottom: 0px;">
                <div class="container">
                    <div class="row">
                    <div class="col-lg-12">
                    <div class="products mb-3">
                        <div class="row justify-content-center">


<?php

$select0 = $lock->prepare('SELECT art.*, cat.Nom AS Nom_cat FROM commerce_article AS art INNER JOIN commerce_categorie AS cat WHERE art.Categorie = cat.Id AND art.Categorie = ? ORDER BY RAND() LIMIT 4 ');

$select0->execute(array($selecte_produit['Categorie']));

    $i = 0;
    while ( $select = $select0->fetch()) {


        if ( $select['Reduction'] != 0  ) {
        
            $reduct = '<span class="product-label label-circle label-new"> -'.$select['Reduction'].'%  </br></span>';

            $prix = '<span class="new-price"> '.convertir_devise($select['Prix_reduction'], $para['Devise']).'</span>
                <span class="old-price"> '.convertir_devise($select['Prix_norm'], $para['Devise']).'</span>';
        }else {
            $reduct = "";

            $prix = '<span class="new-price"> '.convertir_devise($select['Prix_norm'], $para['Devise']).'</span>';
        }
    

        echo '         
                    <div class="col-6 col-md-3 col-lg-3" >               
                        <div class="product product-2 text-center" style="border: 1px solid silver; border-radius: 20px; box-shadow: 3px 3px 3px silver;"> 
                            <figure class="product-media">
                                <span class="product-label label-top">Top</span>
                                <a href="product.php?id_product='.$select['Id'].'&token='.sha1($i.time().$i).'">
                                    <img src="assets/images/article/'.$select['Image'].'" alt="Product image" class="product-image">
                                </a>


                                <div class="product-action product-action-dark">
                                    <a onclick="AjoutPanier('.$select['Id'].', 1)" class="btn-product btn-cart"><span>Ajouter au panier</span></a>
                                </div>
                            </figure>

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">'.$select['Nom_cat'] .'</a>
                                </div>
                                <h3 class="product-title"><a href="product.php?id_product='.$select['Id'].'&token='.sha1($i.time().$i).'">'.$select['Titre'].'</a></h3>
                                <div class="product-price">
                                    '.$prix.'
                                </div>
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 90%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    
        ';

        $i++;
    }

?>
                        
                    </div>
                    </div></div></div></div></div>

                </div><!-- End .container -->
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
    <script src="assets/js/bootstrap-input-spinner.js"></script>
    <script src="assets/js/jquery.elevateZoom.min.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/jquery.plugin.min.js"></script>
    <script src="assets/js/jquery.sticky-kit.min.js"></script>

    <script src="assets/sweetalert/sweetalert.min.js"></script>
    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

    <script type="text/javascript">

        $('#AjoutPanier').click(function(e){
            e.preventDefault();
        
            var id_user = localStorage.getItem("id_user");
            var id_article = $('#id_article').val();
            var quantite = $('#qty').val();

            $.ajax({
                url : "fonction_traitement.php", 
                data: {
                    ajoutPanier: 'oui',
                    id_article: id_article,
                    quantite: quantite,
                    id_user: id_user,
                },
                type : "POST",
                success : function(html){

                    swal("Super !!", "Article ajouter au panier avec succès", "success");
                }, 
                error : function(error){

                    sweetAlert("Oops...", "Problème de connexion, veuillez ressayez !!", "error");
                },       
            });
        });


        // Supprimer l'article
        $('#suppr_article').click(function(e){
            e.preventDefault();

            var id_produit = $("#id_produit").val();

            swal({
                title: "Sûr de vouloir supprimer ?",
                text: "Cette action est irréversible",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Oui",
                cancelButtonText: "Non",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            },
            function(){

                $.ajax({ 
                    url : 'product_traitement.php', 
                    type : "POST", 
                    data : {
                        supprimer_article : 'oui',
                        id_produit: id_produit,
                    }, 
                    dataType : 'html',
                    timeout: 20000,
                    success : function(code_html, statut){

                        if ( code_html == 1) {

                           swal("Super !!", "Article supprimé avec succès", "success");
                           document.location.href='index.php';

                        }else {

                            swal("Oops...", "Une erreur est survenue", "error");
                        }
                            
                    },

                    error : function(erreur){

                        sweetAlert("Oops...", "Problème de connexion, veuillez ressayez !!", "error");
                            
                    },
                });

            });
        });   


    </script>
</body>



</html>