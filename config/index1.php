<?php
session_start();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Accueil | Logikom</title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Logikom">
    <meta name="author" content="p-themes">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="assets/images/favicon.png">
    <link rel="mask-icon" href="assets/images/icons/safari-pinned-tab.svg" color="#666666">
    <link rel="shortcut icon" href="assets/images/favicon.png">
    <meta name="apple-mobile-web-app-title" content="Logikom">
    <meta name="application-name" content="Logikom">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/plugins/jquery.countdown.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <link rel="stylesheet" href="assets/css/skins/skin-demo-3.css"> -->
    <link rel="stylesheet" href="assets/css/demos/demo-3.css">

    <link rel="stylesheet" href="assets/css/sweetalert/sweetalert.css">
    <link rel="stylesheet" href="assets/css/style_lock.css">

</head>

<?php

include_once('base/connexion_base_donne.php');
include_once('id_user.php');

include_once('fonction.php');


?>


<body>
    
    <div class="page-wrapper">
        <header class="header header-intro-clearance header-3">

            <div class="header-top" style="background-color:white;">
                <div class="container">
                    <div class="header-left">
                        <div class="header-dropdown">
                            <a style="font-size: 15px;" href="https://wa.me/+2290191939393"><i class="icon-phone"></i> <b style="color: #0077b6">+229 01 91 93 93 93</b> </a>
                            
                        </div>
                        
                    </div><!-- End .header-left -->

                    <div class="header-right">

                        <div class="header-dropdown">
                            <a style="font-size: 15px;" href="tel:<?php echo $para['Numero']; ?>"><i class="icon-phone"></i> <b style="color: #0077b6"> <?php echo $para['Numero']; ?> </b> </a>
                            
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
                    
                    <div class="header-center">
                        <nav class="main-nav">
                            <ul class="menu ">
                                <li class="active">
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
                                    <li><a href="categorie.php?index='.$cat['Id'].'&cat='.$cat['Grande'].'&token='.sha1($index_cat.time().$index_cat).'"><b>'.$cat['Nom'].'</b></a></li>
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

        <main class="main" style="background-image: url(image/fond.jpg);">
            <div class="intro-section pt-3 pb-3 mb-2">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="intro-slider-container slider-container-ratio mb-2 mb-lg-0">
                                <div class="intro-slider owl-carousel owl-simple owl-dark owl-nav-inside" data-toggle="owl" data-owl-options='{
                                        "nav": false, 
                                        "dots": true,
                                        "autoplay": true,
                                        "autoplayTimeout": 4000,
                                        "responsive": {
                                            "768": {
                                                "nav": true,
                                                "dots": false
                                            }
                                        }
                                    }'>
                                    <div class="intro-slide">
                                        <figure class="slide-image">
                                            <picture>
                                                <!-- <source media="(max-width: 480px)" srcset="image/banner1.png"> -->
                                                <img src="image/banner1.png" alt="Image Desc">
                                            </picture>
                                        </figure>

                                        <div class="intro-content">
                                            <h3 class="intro-subtitle text-primary">Affaire quotidienne</h3><!-- End .h3 intro-subtitle -->
                                            <h1 class="intro-title">
                                                Caméra <br>surveillance
                                            </h1>

                                            <!-- <div class="intro-price">
                                                <sup>Aujourd'hui:</sup>
                                                <span class="text-primary">
                                                    <?php echo convertir_devise("247", $para['Devise'] ); ?>
                                                    $247<sup>.99</sup>
                                                </span>
                                            </div> -->

                                            <a href="categorie.php?index=1&token=deyezjoazqjxdnckjw" class="btn btn-primary btn-round">
                                                <span>Clique ici</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="intro-slide">
                                        <figure class="slide-image">
                                            <picture>
                                                <!-- <source media="(max-width: 480px)" srcset="image/banner2.png"> -->
                                                <img src="image/banner2.png" alt="Image Desc">
                                            </picture>
                                        </figure>

                                        <div class="intro-content">
                                            <h3 class="intro-subtitle text-primary">Offres et promotions</h3>
                                            <h1 class="intro-title">
                                                Caméra <br>dernière Gen
                                            </h1>

                                            <!-- <div class="intro-price">
                                                <sup class="intro-old-price"><?php echo convertir_devise("49", $para['Devise'] ); ?></sup>
                                                <span class="text-primary">
                                                    <?php echo convertir_devise("29", $para['Devise'] ); ?>
                                                </span>
                                            </div> -->

                                            <a href="categorie.php?index=2&token=deyezjoazqjxdnckjw" class="btn btn-primary btn-round">
                                                <span>Clique ici</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                
                                <span class="slider-loader"></span>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="intro-banners">
                                <div class="banner mb-lg-1 mb-xl-2">
                                    <a href="product.php?id_product=&token=deyezjoazqjxdnckjw">
                                        <img src="assets/images/banners/banner-11.jpg" alt="Banner">
                                    </a>

                                    <div class="banner-content">
                                        <h4 class="banner-subtitle d-lg-none d-xl-block"><a href="service.php?id_product=&token=deyezjoazqjxdnckjw">Sécurisez vos</a></h4>

                                        <h3 class="banner-title"><a href="#">Systèmes <span> informatiques </span> </a></h3>
                                        <a href="service.php?id_product=&token=deyezjoazqjxdnckjw" class="banner-link">Voir<i class="icon-long-arrow-right"></i></a>
                                    </div>
                                </div>

                                <div class="banner mb-lg-1 mb-xl-2">
                                    <a href="product.php?id_product=&token=deyezjoazqjxdnckjw">
                                        <img src="assets/images/banners/banner-22.jpg" alt="Banner">
                                    </a>

                                    <div class="banner-content">
                                        <h4 class="banner-subtitle d-lg-none d-xl-block"><a href="product.php?id_product=&token=deyezjoazqjxdnckjw">Mettez en réseau</a></h4>

                                        <h3 class="banner-title"><a href="service.php?id_product=&token=deyezjoazqjxdnckjw">Tous vos appareils <span> informatiques </span> </a></h3>
                                        <a href="service.php?id_product=&token=deyezjoazqjxdnckjw" class="banner-link">Voir<i class="icon-long-arrow-right"></i></a>
                                    </div>
                                </div>

                                <div class="banner mb-0">
                                    <a href="product.php?id_product=&token=deyezjoazqjxdnckjw">
                                        <img src="assets/images/banners/banner-33.jpg" alt="Banner">
                                    </a>

                                    <div class="banner-content">
                                        <h4 class="banner-subtitle d-lg-none d-xl-block"><a href="product.php?id_product=&token=deyezjoazqjxdnckjw">Nous assurons</a></h4>

                                        <h3 class="banner-title"><a href="service.php">la gestion de <span>vos projets</span></a></h3>

                                        <a href="service.php" class="banner-link">Voir<i class="icon-long-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container featured">
                <ul class="nav nav-pills nav-border-anim nav-big justify-content-center mb-3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="products-featured-link" data-toggle="tab" href="#products-featured-tab" role="tab" aria-controls="products-featured-tab" aria-selected="true">Produits populaires</a>
                    </li>
                    
                </ul>

                <div class="tab-content tab-content-carousel">
                    <div class="tab-pane p-0 fade show active" id="products-featured-tab" role="tabpanel" aria-labelledby="products-featured-link">
                        <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                            data-owl-options='{
                                "nav": true, 
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "600": {
                                        "items":2
                                    },
                                    "992": {
                                        "items":3
                                    },
                                    "1200": {
                                        "items":4
                                    }
                                }
                            }'>


<?php

$select0 = $lock->query('SELECT art.*, cat.Nom AS Nom_cat FROM commerce_article AS art INNER JOIN commerce_categorie AS cat WHERE art.Categorie = cat.Id LIMIT 10 ');

$i = 0;
while ( $select = $select0->fetch()) {
    

    echo '
                            
                            <div class="product product-2">
                                <figure class="product-media">
                                    <span class="product-label label-circle label-new"> -'.$select['Reduction'].'%  </br></span>
                                    <a href="product.php?id_product='.$select['Id'].'&token='.sha1($i.time().$i).'">
                                        <img src="assets/images/article/'.$select['Image'].'" alt="Product image" class="product-image">
                                    </a>

                                    <div class="product-action product-action-dark">
                                        <a onclick="AjoutPanier('.$select['Id'].', 1)" class="btn-product btn-cart" title="Add to cart"><span> Ajouter au panier </span></a>
                                        
                                    </div>
                                </figure>

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="#">'.$select['Nom_cat'] .'</a>
                                    </div>
                                    <h3 class="product-title"><a href="product.php?id_product='.$select['Id'].'&token='.sha1($i.time().$i).'">'.$select['Titre'].'</a></h3>
                                    <div class="ratings-container">
                                        <div class="ratings">
                                            <div class="ratings-val" style="width: 100%;"></div>
                                        </div>
                                        <span class="ratings-text">( '.$select['Review'].' Vues )</span>
                                    </div>
                                    <div class="product-price">
                                        '.$select['Prix_reduction'].' CFA
                                    </div>
                                    
                                </div>
                            </div>
        ';

        $i++;                    
}



?>

                        
                            
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="mb-7 mb-lg-11"></div>

            <div class="container">
                <div class="cta cta-border cta-border-image mb-5 mb-lg-7" style="background-image: url(assets/images/demos/demo-3/bg-1.jpg);">
                    <div class="cta-border-wrapper bg-white">
                        <div class="row justify-content-center">
                            <div class="col-md-11 col-xl-11">
                                <div class="cta-content">
                                    <div class="cta-heading">
                                        <h3 class="cta-title text-right"><span class="text-primary">Nouvelle promotion</span> <br>Acheter aujourd'hui et</h3>
                                    </div>
                                    
                                    <div class="cta-text">
                                        <p>Obtenez <span class="text-dark font-weight-normal"> une réduction de 5% en même temps que votre commande payée</p>
                                    </div>
                                    <a href="boutique.php?token=deyezjoazqjxdnckjw" class="btn btn-primary btn-round"><span>Maintenant</span><i class="icon-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container">
                <div class="owl-carousel mt-5 mb-5 owl-simple" data-toggle="owl" 
                        data-owl-options='{
                            "nav": false, 
                            "dots": false,
                            "margin": 30,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":2
                                },
                                "420": {
                                    "items":3
                                },
                                "600": {
                                    "items":4
                                },
                                "900": {
                                    "items":5
                                },
                                "1024": {
                                    "items":6
                                }
                            }
                        }'>
                        <a href="#" class="brand">
                            <img src="assets/images/brands/1.png" alt="Brand Name">
                        </a>

                        <a href="#" class="brand">
                            <img src="assets/images/brands/2.png" alt="Brand Name">
                        </a>

                        <a href="#" class="brand">
                            <img src="assets/images/brands/3.png" alt="Brand Name">
                        </a>

                        <a href="#" class="brand">
                            <img src="assets/images/brands/4.png" alt="Brand Name">
                        </a>

                        <a href="#" class="brand">
                            <img src="assets/images/brands/5.png" alt="Brand Name">
                        </a>

                        <a href="#" class="brand">
                            <img src="assets/images/brands/6.png" alt="Brand Name">
                        </a>
                    </div>
            </div>

            <div class="container">
                <hr class="mt-5 mb-6">
            </div>

            <div class="container top">
                <div class="heading heading-flex mb-3">
                    <div class="heading-left">
                        <h2 class="title">Les plus vendus</h2>
                    </div>

                   <div class="heading-right">
                        <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                            
<?php
        
    $select_cate0 = $lock->query('SELECT * FROM commerce_categorie ORDER BY RAND() LIMIT 5 ');


    $z = 0; $tableau = array();
    while( $select_cate = $select_cate0->fetch() ){

        if ($z == 0) { $active = "active"; } else { $active = ""; }

        echo '

                            <li class="nav-item">
                                <a class="nav-link '.$active.'" id="top-all-link" data-toggle="tab" href="#top-'.$select_cate['Id'].'-tab" role="tab" aria-controls="top-all-tab" aria-selected="true">'.$select_cate['Nom'] .'</a>
                            </li>
        ';

        $tableau[$z] = $select_cate['Id'];

        $z++;
    }

?>

                            
                        </ul>
                   </div>
                </div>



                <div class="tab-content tab-content-carousel just-action-icons-sm">

<?php

    for ($j=0; $j < $z; $j++) {

        if ($j == 0) { $active = "active"; } else { $active = ""; }
?>                 
                    <div class="tab-pane p-0 fade show <?php echo $active ?>" id="<?php echo 'top-'.$tableau[$j].'-tab'; ?>" role="tabpanel" aria-labelledby="top-2-link">
                        <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                            data-owl-options='{
                                "nav": true, 
                                "dots": false,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "480": {
                                        "items":2
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    },
                                    "1200": {
                                        "items":5
                                    }
                                }
                            }'>
                            
<?php

$select0 = $lock->prepare('SELECT art.*, cat.Nom AS Nom_cat FROM commerce_article AS art INNER JOIN commerce_categorie AS cat WHERE art.Categorie = cat.Id AND art.Categorie = ? ');

$select0->execute(array($tableau[$j]));

$i = 0;
while ( $select = $select0->fetch()) {
    

    echo '                                    
                                    
                                        <div class="product product-2 text-center">
                                            <figure class="product-media">
                                                <span class="product-label label-circle label-top">Top</span>
                                                <a href="product.php?id_product='.$select['Id'].'&token='.sha1($i.time().$i).'">
                                                    <img src="assets/images/article/'.$select['Image'].'" alt="Product image" class="product-image">
                                                </a>

                                                <div class="product-action product-action-dark">
                                                    <a onclick="AjoutPanier('.$select['Id'].', 1)" class="btn-product btn-cart" title="Add to cart"><span> Ajouter au panier </span></a>
                                                </div>
                                            </figure>

                                            <div class="product-body">
                                                <div class="product-cat">
                                                    <a href="#">'.$select['Nom_cat'] .'</a>
                                                </div>
                                                <h3 class="product-title"><a href="product.php?id_product='.$select['Id'].'&token='.sha1($i.time().$i).'">'.$select['Titre'].'</a></h3>
                                                <div class="product-price">
                                                    <span class="new-price"> '.convertir_devise($select['Prix_reduction'], $para['Devise']).'</span>
                                                    <span class="old-price"> <s>'.convertir_devise($select['Prix_norm'], $para['Devise']).'</s></span>
                                                </div>
                                                <div class="ratings-container">
                                                    <div class="ratings">
                                                        <div class="ratings-val" style="width: 100%;"></div>
                                                    </div>
                                                    <span class="ratings-text">( '.$select['Review'].' Vues )</span>
                                                </div>
                                            </div>
                                        </div>
                                    
            ';

            $i++;
    }
    
?>                               
                            
                        </div>
                    </div>
                

<?php


}

?>
                </div>
            </div>
                    

            <div class="page-content">
                <div class="container">  
                    <hr class="mt-5 mb-5">
                    <h2 class="title text-center mb-3">Nos clients nous rendent hommagent et témoignent</h2>
                    
                    <div class="owl-carousel owl-theme owl-testimonials" data-toggle="owl" 
                        data-owl-options='{
                            "nav": false, 
                            "dots": true,
                            "autoplay": true,
                            "autoplayTimeout": 4000,
                            "margin": 20,
                            "loop": true,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "768": {
                                    "items":2
                                },
                                "992": {
                                    "items":3
                                },
                                "1200": {
                                    "items":3,
                                    "nav": true
                                }
                            }
                        }'>
                        <blockquote class="testimonial testimonial-icon text-center">
                            <p>“ Après avoir fait l'expérience pour la première fois, j'ai pris l'habitude de toujours me tourner vers vous. Je suis heureux. ”</p>
                            <cite>
                                Lock
                                <span>Client</span>
                            </cite>
                        </blockquote>

                        <blockquote class="testimonial testimonial-icon text-center">
                            <p>“ Une expérience exeptionnelle, une livraison rapide, je suis très contente de vous. ”</p>

                            <cite>
                                Faridath
                                <span>Client</span>
                            </cite>
                        </blockquote>

                        <blockquote class="testimonial testimonial-icon text-center">
                            <p>“ La rapidité et la sécurité sont des qualités très remarquables ici. Le service client répond et satisfait dans les meilleurs délais. J'ai aimé. ”</p>

                            <cite>
                                Julien
                                <span>Client</span>
                            </cite>
                        </blockquote>

                        <blockquote class="testimonial testimonial-icon text-center">
                            <p>“ Une exellente architecture qui assure l'achat et la livraison dans quelques jours. Je suis étonné de recevoir ma commande 5H seulement après paiement. Bien de chose à vous. ”</p>

                            <cite>
                                Marc
                                <span>Client</span>
                            </cite>
                        </blockquote>
                    </div>
                </div>
                </div>    

            <div class="container">
                <hr class="mt-5 mb-0">
            </div>

            <div class="icon-boxes-container mt-2 mb-2 bg-transparent">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-lg-3">
                            <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-rocket"></i>
                                </span>
                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Livraison offerte</h3>
                                    <p>Vous économisez</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-rotate-left"></i>
                                </span>

                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Service après vente gratuit</h3>

                                    <p>Pendant 30 jours</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-info-circle"></i>
                                </span>

                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Obtenez 10% de réduction au premier achat</h3>

                                    <p>Valable aujourd'hui seulement</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-life-ring"></i>
                                </span>

                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Support client</h3>
                                    <p>Fonctionne 24/7</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="cta cta-separator cta-border-image cta-half mb-0" style="background-image: url(assets/images/demos/demo-3/bg-2.jpg);">
                    <div class="cta-border-wrapper bg-white">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="cta-wrapper cta-text text-center">
                                    <h3 class="cta-title">Réseaux sociaux</h3>
                                    <p class="cta-desc">Nous sommes présent sur tous les médias sociaux. Veuillez cliquer sur ces liens ci-dessous pour nous joindre. </p>
                            
                                    <div class="social-icons social-icons-colored justify-content-center">

                                        <a href="https://www.facebook.com/profile.php?id=61559178477106&mibextid=LQQJ4d" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>

                                        <a href="https://wa.me/22997170427" class="social-icon social-whatsapp" title="Whatsapp" target="_blank"><i class="icon-whatsapp"></i></a>

                                        <a href="tel:+22997170427" class="social-icon social-instagram" title="Appel direct" target="_blank"><i class="icon-phone"></i></a>

                                        <a href="mailto:contact@logikom.com" class="social-icon social-youtube" title="Boite mail" target="_blank"><i class="icon-comment-o"></i></a>

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="cta-wrapper text-center">
                                    <h3 class="cta-title">Obtenez nos nouvelles offres</h3>
                                    <p class="cta-desc">et <br>recevez <span class="text-primary">5%</span> de réduction au premier achat</p>
                            
                                    <form action="#">
                                        <div class="input-group">
                                            <input type="email" class="form-control" placeholder="Entrez votre adresse mail" aria-label="Email Adress" required>
                                            <div class="input-group-append">
                                                <button class="btn btn-primary btn-rounded" type="submit"><i class="icon-long-arrow-right"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        


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
    <!-- <script src="assets/js/jquery.hoverIntent.min.js"></script> -->
    <script src="assets/js/jquery.waypoints.min.js"></script>
    <!-- <script src="assets/js/superfish.min.js"></script> -->
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/bootstrap-input-spinner.js"></script>
    <!-- <script src="assets/js/jquery.plugin.min.js"></script> -->
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <!-- <script src="assets/js/jquery.countdown.min.js"></script> -->
    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/demos/demo-3.js"></script>


    <script src="assets/sweetalert/sweetalert.min.js"></script>


    <!-- <script src="base/lock.js"></script> -->

    <script type="text/javascript">
        

        // // Gestion d'afficharge du popup de réduction
        // $('#desactiveInfoReduction').click(function(e){

        //     var desactiveInfoReduction = localStorage.getItem("desactiveInfoReduction");

        //     if (desactiveInfoReduction == null) {
        //         localStorage.setItem("desactiveInfoReduction", "Désactivé");
        //         alert('rien');
        //     }else{
        //         alert(desactiveInfoReduction);
        //     }

            
        // });

    </script>
</body>


</html>