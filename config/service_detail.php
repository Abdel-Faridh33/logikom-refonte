<?php
session_start();

include_once('base/connexion_base_donne.php');

if (isset($_GET['id_product']) and $_GET['id_product'] != '') {
    
    $id_produit = htmlspecialchars(trim($_GET['id_product']));

    $selecte_produit0 = $lock->prepare('SELECT * FROM service WHERE Id = ? ');
    $selecte_produit0->execute(array($id_produit));
    $selecte_produit = $selecte_produit0->fetch();

    if (!isset($selecte_produit['Id'] ) or $selecte_produit['Id'] == '' ) {
        
        header('Location: index.php');
    }else {

        // On incrément le nombre de vue

        $vue = $selecte_produit['Review']+1;
        $update_vue = $lock->prepare('UPDATE service SET Review = ? WHERE Id = ? ');
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
    <meta name="theme-color" content="#ffffff">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/plugins/jquery.countdown.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/plugins/nouislider/nouislider.css">
    <link href="assets/css/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="assets/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">

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
    <div class="page-wrapper" style="background-color: rgba(137, 247, 157, 0.2);">
        <header class="header">
            
            <div class="header-middle sticky-header">
                <div class="container">
                    <div class="header-left">
                        <button class="mobile-menu-toggler">
                            <span class="sr-only">Toggle mobile menu</span>
                            <i class="icon-bars"></i>
                        </button>

                        <a href="index.php" class="logo">
                            <img src="assets/images/logo-footer.png" alt="Logikom" width="200">
                        </a>

                        <nav class="main-nav" >
                            <ul class="menu sf-arrows" >
                                <li class="">
                                    <a href="index.php" >Accueil</a>   
                                </li>
                                <li>
                                    <a href="boutique.php" class="sf-with-ul">Boutique</a>
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
                                <li>
                                    <a href="service.php">Services</a>
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
                                            <img id="product-zoom" src="assets/images/service/'.$selecte_produit['Image'].'" data-zoom-image="assets/images/service/'.$selecte_produit['Image'].'" alt="Image produit">

                                            <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                                <i class="icon-arrows"></i>
                                            </a>
                                        </figure>';

        if ($selecte_produit['Image1'] != '') {
                                            
                echo '                         

                                        <div id="product-zoom-gallery" class="product-image-gallery">
                                            <a class="product-gallery-item active" href="#" data-image="assets/images/service/'.$selecte_produit['Image1'].'" data-zoom-image="assets/images/service/'.$selecte_produit['Image1'].'">
                                                <img src="assets/images/service/'.$selecte_produit['Image1'].'" alt="Image produit">
                                            </a>';

        }
        if ($selecte_produit['Image2'] != '') {
                                            
                echo '                                   

                                            <a class="product-gallery-item" href="#" data-image="assets/images/service/'.$selecte_produit['Image2'].'" data-zoom-image="assets/images/service/'.$selecte_produit['Image2'].'">
                                                <img src="assets/images/service/'.$selecte_produit['Image2'].'" alt="Image produit">
                                            </a>';

        }
        if ($selecte_produit['Image3'] != '') {
                                            
                echo '
                                            <a class="product-gallery-item" href="#" data-image="assets/images/service/'.$selecte_produit['Image3'].'" data-zoom-image="assets/images/service/'.$selecte_produit['Image3'].'">
                                                <img src="assets/images/service/'.$selecte_produit['Image3'].'" alt="Image produit">
                                            </a>';

        }
        if ($selecte_produit['Image4'] != '') {
                                            
                echo '

                                            <a class="product-gallery-item" href="#" data-image="assets/images/service/'.$selecte_produit['Image4'].'" data-zoom-image="assets/images/service/'.$selecte_produit['Image4'].'">
                                                <img src="assets/images/service/'.$selecte_produit['Image4'].'" alt="Image produit">
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
                                            <div class="ratings-val" style="width: 90%;"></div><!-- End .ratings-val -->
                                        </div><!-- End .ratings -->
                                        
                                    </div><!-- End .rating-container -->

                                    <?php echo '

                                            <input type="hidden" id="id_service" value="'.$selecte_produit['Id'].'" >';
                                            ?>

                                    <div class="product-content">
                                        <p style="font-family: arial black;">
                                            <?php echo substr($selecte_produit['Resume'], 0, 300); ?>
                                             <a class="ratings-text" href="#product-desc-link" id="review-link">Lire tout</a> 
                                         </p>
                                    </div><!-- End .product-content -->
<?php
    
    if (isset($_SESSION['admin']) AND $_SESSION['admin'] != "" ) {
        
        echo '              
                    <input id="id_produit" type="hidden" value="'.$selecte_produit['Id'].'"  >

                                    <div id="modifier_service" class="btn_para" style="background-color: #941cb3; width: 75px; padding: 10px 10px; text-align: center; border-radius: 20px; position: fixed; right: 20px; bottom : calc(50% + 30px); "><i class="fa fa-pencil" style="font-size: 25px; color: white;"></i></div>

                                    <div id="suppr_service" class="btn_para" style="background-color: #b31c1c; width: 75px; padding: 10px 10px; text-align: center; border-radius: 20px; position: fixed; right: 20px; bottom : calc(50% - 30px);"><i class="fa fa-trash" style="font-size: 25px; color: white;"></i></div>';
    }
?>
                                    

                                </div><!-- End .product-details -->
                            </div><!-- End .col-md-6 -->
                        </div><!-- End .row -->
                    </div><!-- End .product-details-top -->

                    <div class="product-details-tab">
                        <ul class="nav nav-pills justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                            </li>
                            
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                                <div class="product-desc-content">
                                    <h3>Information du produit</h3>
                                    <p>

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

$select0 = $lock->query('SELECT * FROM service ORDER BY RAND() LIMIT 4 ');


    $i = 0;
    while ( $select = $select0->fetch()) {
    

        echo '         
                    <div class="col-6 col-md-3 col-lg-3" >               
                        <div class="product product-2 text-center" style="border: 1px solid silver; border-radius: 20px; box-shadow: 3px 3px 3px silver;"> 
                            <figure class="product-media">
                                <span class="product-label label-top">Top</span>
                                <a href="service_detail.php?id_product='.$select['Id'].'&token='.sha1($i.time().$i).'">
                                    <img src="assets/images/service/'.$select['Image'].'" alt="Product image" class="product-image">
                                </a>

                            </figure>

                            <div class="product-body">
                                
                                <h3 class="product-title"><a href="service_detail.php?id_product='.$select['Id'].'&token='.sha1($i.time().$i).'">'.$select['Titre'].'</a></h3>
                                <div class="product-price">
                                    
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

  

    // Sticky Bar 

    echo '
     <div class="sticky-bar">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <figure class="product-media">
                        <a href="">
                            <img src="assets/images/article/'.$selecte_produit['Image'].'" alt="Product image">
                        </a>
                    </figure>
                    <h4 class="product-title"><a href="">'.$selecte_produit['Titre'].'</a></h4>
                </div>

                <div class="col-6 justify-content-end">
                    <div class="product-price">
                        '.$selecte_produit['Prix_reduction'].' CFA
                    </div>
                    <div class="product-details-quantity">
                        <input type="number" id="qty2" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required>
                    </div>

                    <div class="product-details-action">
                        <a href="#" id="AjoutPanier_bas" class="btn-product btn-cart"><span>Ajouter au panier</span></a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div> ';


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
    <script src="assets/js/bootstrap-input-spinner.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/jquery.plugin.min.js"></script>
    <script src="assets/js/jquery.countdown.min.js"></script>
    <script src="assets/js/jquery.sticky-kit.min.js"></script>

    <script src="assets/sweetalert/sweetalert.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

    <script type="text/javascript">




        // Modifier service
        $('#modifier_service').click(function(e){
            e.preventDefault();

            var id_service = $("#id_service").val();

            swal({
                title: "Attention !!!",
                text: "Voulez vous vraiment modifier ce service ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#145c16",
                confirmButtonText: "Oui",
                cancelButtonText: "Non",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            },
            function(){

                document.location.href='modifier_service.php?id_product='+id_service;

            });
        });

    

        // Supprimer service
        $('#suppr_service').click(function(e){
            e.preventDefault();

            var id_service = $("#id_service").val();

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
                    url : 'service_detail_traitement.php', 
                    type : "POST", 
                    data : {
                        supprimer_service : 'oui',
                        id_service: id_service,
                    }, 
                    dataType : 'html',
                    timeout: 20000,
                    success : function(code_html, statut){

                        if ( code_html == 1) {

                           swal("Super !!", "Service supprimé avec succès", "success");
                           document.location.href='service.php';

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