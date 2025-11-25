<?php
session_start();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Contact | Logikom </title>
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
        .input_focus:focus {border: 1px solid #0077b6; }
    </style>
</head>


<?php

include_once('base/connexion_base_donne.php');
include_once('id_user.php');

include_once('fonction.php');



// Selection des coordonnées du site
$para0 = $lock->query('SELECT * FROM commerce_parametre ');
$para = $para0->fetch();

?>

<body>
    <div class="page-wrapper" style="background-image: url(image/fond.jpg);">
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
                                
                                <li class="active">
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
            
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
 
                            <div class="form-box">
                                <div class="form-tab">
                                    <ul class="nav nav-pills nav-fill nav-border-anim" role="tablist">
                                        <li class="nav-item" >
                                            <a style="color: #e81dc3" class="nav-link active" id="signin-tab" data-toggle="tab" href="" role="tab" aria-controls="signin" aria-selected="true"><h3 style="font-family: Tahoma;">Ecrivez-nous un message</h3></a>
                                        </li>
                                
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">

                                            <form action="" id="form_contact" autocomplete="off">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="nom">Votre Nom *</label>
                                                            <input type="text" class="form-control input_focus" id="nom" name="nom" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="objet">Objet *</label>
                                                            <input type="text" class="form-control input_focus" id="objet" name="objet" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="email">Votre Email *</label>
                                                            <input type="email" class="form-control input_focus" id="email" name="email" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="numero">Votre Numero *</label>
                                                            <input type="tel" class="form-control input_focus" id="numero" name="numero" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="">Votre Message *</label>
                                                            <textarea name="message" id="message" class="form-control input_focus" placeholder="" required></textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-footer">
                                                    <button type="submit" class="btn btn-outline-primary-2" style="height: 50px; width: 5cm;">
                                                        <span>ENVOYER</span>

                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>    
                                </div><!-- End .form-tab -->
                            </div><!-- End .form-box -->
                                                
                        </div><!-- End .col-lg-8 -->


                        <div class="col-lg-4">
 
                            <div class="form-box">
                                <div class="form-tab">
                        
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">

                                            
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <span style="background: green; color: white; padding: 12px; font-size: 20px; border-radius: 5px;"><i class="icon-phone"></i></span><br><br>
                                                            
                                                            <h5>Appelez-nous maintenant </h5>

                                                            <?php echo '<a style="color: #0b577ded;" href="tel:'.$para['Numero'].'"><b>'.$para['Numero'].'</b></a>'; ?>
                                                            
                                                        </div><br>

                                                        <div class="form-group">
                                                            <span style="background: green; color: white; padding: 12px; font-size: 20px; border-radius: 5px;"><i class="icon-whatsapp"></i></span><br><br>
                                                            
                                                            <h5>Contact WhatsApp </h5>

                                                            <?php echo '<a style="color: #0b577ded;" href="https://wa.me/22997170427"><b> +229 97 17 04 27</b></a>'; ?>
                                                            
                                                        </div><br>

                                                        <div class="form-group">
                                                            <span style="background: violet; color: white; padding: 12px; font-size: 20px; border-radius: 5px;"><i class="icon-envelope"></i></span><br><br>
                                                            
                                                            <h5>Email :</h5>

                                                            <?php echo '<a style="color: #0b577ded;" href="mailto:'.$para['Mail'].'"><b>'.$para['Mail'].'</b></a>'; ?>
                                                            
                                                        </div><br>

                                                        <div class="form-group">
                                                            <span style="background: green; color: white; padding: 12px; font-size: 20px; border-radius: 5px;"><i class="icon-map-marker"></i></span><br><br>
                                                            
                                                            <h5>Notre Adresse </h5>

                                                            <?php echo '<a target="_blanc" style="color: #0b577ded;" href="https://maps.app.goo.gl/uYpBm5C98qdKbG5Y7"><span style="color: #0b577ded;"><b>'.$para['Location'].'</b></span> <span style="font-size: 12px; color: silver;"> (Cliquez pour voir l\'itinéraire)</span></a>'; ?>
                                                            
                                                        </div>

                                                    </div>
                                                </div>
                                                
                                            

                                        </div>
                                    </div>    
                                </div><!-- End .form-tab -->
                            </div><!-- End .form-box -->
                                                
                        </div><!-- End .col-lg-8 -->
                        
                    </div><!-- End .row -->


                    <div class="row">

                        <div class="col-lg-12"><br><br>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1982.5800836490578!2d2.4064142871481384!3d6.373313288572356!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sfr!2sbj!4v1723890372893!5m2!1sfr!2sbj" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        
                    </div>
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
    
    $('#form_contact').submit(function(e){
        e.preventDefault();

        $('#patience0').show();
        $('#patience1').show();
        
        // var tab = $('#form_contact').serialize();
            var nom = $('#nom').val();
            var objet = $('#objet').val();
            var numero = $('#numero').val();
            var email = $('#email').val();
            var message = $('#message').val();

        $.ajax({ 
            url : "contact_traitement.php", 
            method: "POST", 
            timeout: 15000,
            data: {
                nom: nom,
                objet: objet,
                numero: numero,
                email: email,
                message: message,
            },
                
                success : function(code_html, statut){

                    if (code_html == 1) {

                        var nom = $('#nom').val('');
                        var objet = $('#objet').val('');
                        var numero = $('#numero').val('');
                        var email = $('#email').val('');
                        var message = $('#message').val('');

                        sweetAlert("Super", "Votre message a été envoyé avec succès, une réponse vous sera envoyée dans peu de temps !!", "success"); 
                    }else {

                        alert(code_html);
                    }
 
                },
                error : function(erreur){

                        sweetAlert("Oops...", "Problème de connexion, veuillez rééssayer !!", "error");  
                },
        });
    
    });

</script>
</body>



</html>