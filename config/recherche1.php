<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Logikom</title>
    <meta name="keywords" content="Logikom">
    <meta name="description" content="Logikom">
    <meta name="author" content="p-themes">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="assets/images/favicon.png">
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
    <div class="page-wrapper">
        <header class="header">
            <div class="header-top">
                <div class="container">
                    <div class="header-left">
                        <div class="header-dropdown" style="color: transparent;">
                            <a href="#">Usd</a>
                            
                        </div><!-- End .header-dropdown -->

                        
                    </div><!-- End .header-left -->

                    <div class="header-right">
                        <ul class="top-menu">
                            <li>
                                <a href="#">Links</a>
                                <ul>
                                    <li><a href="tel:<?php echo $para['Numero']; ?>"><i class="icon-phone"></i> <?php echo $para['Numero']; ?> </a></li>
                            
                                    <li><a href="#signin-modal" data-toggle="modal"><i class="icon-user"></i>Login</a></li>
                                </ul>
                            </li>
                        </ul><!-- End .top-menu -->
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-top -->

            <div class="header-middle sticky-header">
                <div class="container">
                    <div class="header-left">
                        <button class="mobile-menu-toggler">
                            <span class="sr-only">Toggle mobile menu</span>
                            <i class="icon-bars"></i>
                        </button>

                        <a href="index.php" class="logo">
                            <img src="assets/images/logo.png" alt="Molla Logo" width="105" height="25">
                        </a>

                        <nav class="main-nav">
                            <ul class="menu sf-arrows">
                                <li class="">
                                    <a href="index.php" class="sf-with-ul">Home</a>   
                                </li>
                                <li>
                                    <a href="categorie.php" class="sf-with-ul">Collection</a>
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
                                    <a href="suivi-coli.php" class="sf-with-ul">Suivi coli</a>
                                </li>

                                <li>
                                    <a href="contact.php" class="sf-with-ul">Contact</a>
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
        	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        		<div class="container">
        			<h1 class="page-title"> <?php echo $text_recherche; ?> </h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Recherche</li>
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

$select0 = $lock->prepare('SELECT art.*, cat.Nom AS Nom_cat FROM commerce_article AS art INNER JOIN commerce_categorie AS cat WHERE art.Categorie = cat.Id AND ( cat.Nom LIKE ? OR Titre LIKE ? OR Description LIKE ? ) ');

$text_recherche = '%'.$text_recherche.'%';

$select0->execute(array($text_recherche, $text_recherche, $text_recherche));

$i = 0;
while ( $select = $select0->fetch()) {
    

    echo '                                    
                                    <div class="col-6 col-md-3 col-lg-3">
                                        <div class="product product-7 text-center">
                                            <figure class="product-media">
                                                <span class="product-label label-new"> '.$select['Reduction'].'%  </br> OFF</span>
                                                <a href="product.php?id_product='.$select['Id'].'&token='.sha1($i.time().$i).'">
                                                    <img src="assets/images/article/'.$select['Image'].'" alt="Product image" class="product-image">
                                                </a>

                                                <div class="product-action-vertical">
                                                    <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                                    
                                                </div>

                                                <div class="product-action">
                                                    <a onclick="AjoutPanier('.$select['Id'].', 1)" class="btn-product btn-cart" ><span> Ajouter au panier </span></a>
                                                </div>
                                            </figure>

                                            <div class="product-body">
                                                <div class="product-cat">
                                                    <a href="#">'.$select['Nom_cat'] .'</a>
                                                </div>
                                                <h3 class="product-title"><a href="product.php?id_product='.$select['Id'].'&token='.sha1($i.time().$i).'">'.$select['Titre'].'</a></h3>
                                                <div class="product-price">
                                                    '.convertir_devise($select['Prix_reduction'], $para['Devise']).'
                                                </div>
                                                <div class="ratings-container">
                                                    <div class="ratings">
                                                        <div class="ratings-val" style="width: 100%;"></div>
                                                    </div>
                                                    <span class="ratings-text">( '.$select['Review'].' Reviews )</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            ';

            $i++;
    }
    
?>            



                                </div><!-- End .row -->
                            </div><!-- End .products -->

                			
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
    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>
    
</body>


</html>