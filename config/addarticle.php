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
    <title> Nouveaux produit | Logikom </title>
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
    
    <link rel="stylesheet" href="assets/js/summernote-0.8.20-dist/summernote-bs4.css" />

  

</head>



<?php

include_once('base/connexion_base_donne.php');

$para0 = $lock->query('SELECT * FROM commerce_parametre ');
$para = $para0->fetch();

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
                    
                    <div class="header-center">
                        <nav class="main-nav">
                            <ul class="menu ">
                                <li >
                                    <a href="index.php" class="">Accueil</a>

                                </li>

<?php

    $categorie0 = $lock->query('SELECT * FROM commerce_categorie_grande ORDER BY Id ');

    while ($categorie = $categorie0->fetch()) {

        echo '
                                <li class="">
                                    <a href="#">'.$categorie['Nom'].'</a>
                                    <ul>
        ';


        $cat0 = $lock->prepare('SELECT * FROM commerce_categorie WHERE Grande = ? ORDER BY Id ');
        $cat0->execute(array($categorie['Id']));

        $index_cat = 0;
        while ($cat = $cat0->fetch()) {  

            echo '
                                    <li class="" ><a href="categorie.php?index='.$cat['Id'].'&cat='.$cat['Grande'].'&token='.sha1($index_cat.time().$index_cat).'"><b>'.$cat['Nom'].'</b></a></li>
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
                    <h1 class="page-title">Nouveau <span>Article</span></h1>
                </div><!-- End .container -->
            </div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
                        <li class="breadcrumb-item"><a href="boutique.php">Boutique</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Nouveau article</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content" style="background-image: url(image/fond.jpg);">
                <div class="checkout">
                    <div class="container">
                
                        <form action="" method="post" id="form">
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2" >
                                    <!-- <h2 class="checkout-title">Informations</h2> -->
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Titre *</label>
                                                <input type="text" id="titre" name="titre" class="form-control" required>
                                            </div><!-- End .col-sm-6 -->

<?php
    
    $categorie0 = $lock->query('SELECT * FROM commerce_categorie ORDER BY Nom');


    $elementCategorie = "";
    while ($categorie = $categorie0->fetch()) {
        
        $elementCategorie .= '<option value="'.$categorie['Id'].'">'.$categorie['Nom'].'</option>';
    }
                                

?>
                                            <div class="col-sm-6">
                                                <label>Catégorie *</label>
                                                <select id="categorie" name="categorie" class="form-control" required="">
                                                    <option></option>

                                                    <?php echo $elementCategorie; ?>

                                                </select>
                                            </div><!-- End .col-sm-6 -->
                                        </div><!-- End .row -->

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Prix normal *</label>
                                                <input type="number" id="prix" name="prix" class="form-control" required>
                                            </div><!-- End .col-sm-6 -->

                                            <div class="col-sm-6">
                                                <label>Pourcentage de réduction *</label>
                                                <input type="number" id="pourcentage" name="pourcentage" class="form-control" required>
                                            </div><!-- End .col-sm-6 -->
                                        </div><!-- End .row -->

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Résumé *</label>
                                                <input type="text" id="resume" name="resume" class="form-control" required>
                                            </div><!-- End .col-sm-6 -->
                                        </div><!-- End .row -->

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>Description</label>
                                                <textarea id="description" name="description" class="form-control" cols="30" rows="4" placeholder="Bref description de l'article" required></textarea>
                                            </div><!-- End .col-sm-6 -->

                                        </div><!-- End .row -->

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Image Présentation *</label>
                                                <input type="File" id="image_min" name="image_min" class="form-control" accept=".png, .jpg, .jpeg" required>
                                            </div><!-- End .col-sm-6 -->

                                            <div class="col-sm-6">
                                                <label>Image *</label>
                                                <input type="File" id="image" name="image[]" class="form-control" accept=".png, .jpg, .jpeg" max="5" multiple required>
                                            </div><!-- End .col-sm-6 -->

                                        </div><!-- End .row -->

                                        <br>

                                        <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                            <span class="btn-text">Valider</span>
                                            <span class="btn-hover-text">Valider l'article maintenant</span>

                                            <span class="spinner-grow" id="envoie_en_cours" style="display: none;"> </span>
                                        </button>
        
                                </div><!-- End .col-lg-9 -->
                                
                            </div><!-- End .row -->
                        </form>
                    </div><!-- End .container -->
                </div><!-- End .checkout -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->

<!-- Page de traitement d'envoie d'image en cours -->
    <div id="patience0" style="position: fixed; background: black; opacity: 70%; top: 0px; left: 0px; width: 100%; height: 100%; z-index: 1; display: none;"></div>
    <div id="patience1" style="position: fixed;  top: 0px; left: 0px; width: 100%; height: 100%; z-index: 10; display: none; ">
        <div style="position: relative; top: calc(50% - 25px); width: 100%; text-align: center; opacity: 1;">
            <em>Envoie en cours...</em>
            <div class="progress mb-2" style="height: 20px;">
                <div id="progressBar" class="progress-bar" role="progressbar" style="width: 0%; height: 20px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>        

        
    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- Mobile Menu -->
    
    <?php

    include_once('footer.php');
    
    include_once('mobile_menu.php');

    include_once('register.php');

?>
    

    <!-- Plugins JS File -->
    <!-- <script src="assets/js/jquery.min.js"></script> -->
    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.hoverIntent.min.js"></script>
    <script src="assets/js/jquery.waypoints.min.js"></script>
    <script src="assets/js/superfish.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

    <script src="assets/js/summernote-0.8.20-dist/summernote-bs4.js"></script>
    <script src="assets/js/summernote-0.8.20-dist/lang/summernote-fr-FR.js"></script>


    <script type="text/javascript">

        $(document).ready(function(){
            $('#description').summernote({
                lang:'fr-FR',
                height: 300,
                editing:true,
                textareaAutoSync:true,

                toolbar: [['style', ['style']], ['font', ['bold','underline','clear']], ['fontname', ['fontname']], ['color', ['color']], ['paragraph', ['paragraph']], ['table', ['table']], ['view', ['fullscreen','codeview','help']]],


            });

        });

        // Envoie formulaire
        $("#form").submit(function(e) {
            e.preventDefault();

            $('#envoie_en_cours').css('display', 'block');

            var titre = $('#titre').val();
            var categorie = $('#categorie').val();
            var prix = $('#prix').val();
            var pourcentage = $('#pourcentage').val();
            var resume = $('#resume').val();
            var description = $('#description').val();
            var form = $('#form')[0];
            var formData = new FormData(form);

      
                $.ajax({ 
                    url : "addArticleTraitement.php",
                    type : "POST", data : formData, dataType : 'html', processData: false, contentType: false, cache: false,

                        xhr : function (){

                            var jqXHR = null;
                            if (window.ActiveXObjet) {
                                jqXHR = new window.ActiveXObjet("Microsoft.XMLHTTP");
                            }else {
                                jqXHR = new window.XMLHttpRequest();
                            }

                            jqXHR.upload.addEventListener("progress", function(event){
                                if (event.lengthComputable) {
                                    var percentComplete = Math.round((event.loaded*100)/event.total);

                                    $('#patience0').show();
                                    $('#patience1').show();

                                    $('#progressBar').css("width", +percentComplete+"%");
                                    $('#progressBar').text(percentComplete+"%");
                                    
                                }
                            }, false);

                            return jqXHR;
                        },

                        success : function(code_html, statut){ 

                            $('#patience0').hide();
                            $('#patience1').hide();

                            if (code_html == 1 ) {

                                $('#envoie_en_cours').css('display', 'none');
                                $('#titre').val('');
                                $('#categorie').val('');
                                $('#prix').val('');
                                $('#image').val('');
                                $('#pourcentage').val('');
                                $('#resume').val('');
                                $('#description').val('');

                            }else if(code_html == 0 ) {

                                $('#envoie_en_cours').css('display', 'none');

                                alert('Une erreur liée aux fichiers est survenue. Veuillez vérifier l\'extension des fichiers que vous tentez t\'envoyer !');
                            
                            }else {

                                alert(code_html);
                                $('#envoie_en_cours').css('display', 'none');
                            }                                

                        },
                        error : function(erreur){

                            $('#envoie_en_cours').css('display', 'none');
                            alert('une erreur est suvenue'); 
                        },
                });
            
        });
        
    </script>
</body>


</html>