<?php
session_start();


include_once('base/connexion_base_donne.php');

if (!isset($_SESSION['admin'])) {
    
    header('Location: index.php');
}



// Gestion de la modification
if (isset($_POST['valider'])) {

    
    $modifie = $lock->prepare('UPDATE service SET Titre = ?, Resume = ?, Description = ? WHERE Id = ? ');
    $modifie->execute(array( $_POST['titre'], $_POST['resume'], $_POST['description'], $_POST['id_service'] ));


    header('Location: service_detail.php?id_product='.$_POST['id_service']);

}


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
    <title> Modifier service | Logikom </title>
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


$para0 = $lock->query('SELECT * FROM commerce_parametre ');
$para = $para0->fetch();

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
                            <img src="assets/images/logo-footer.png" alt="Logikom" width="200">
                        </a>

                        <nav class="main-nav">
                            <ul class="menu sf-arrows">
                                <li class="">
                                    <a href="index.php">Accueil</a>   
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
                                    <a href="contact.php">Contact</a>
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
        			<h1 class="page-title">Modifier <span> <?php echo $selecte_produit['Titre']; ?> </span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Accueil</a></li>
                        <li class="breadcrumb-item"><a href="service.php">Service</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Mdification</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
            	<div class="checkout">
	                <div class="container">
            	
            			<form action="" method="post" id="form">
		                	<div class="row">
		                		<div class="col-lg-8 offset-lg-2" >
		                			<!-- <h2 class="checkout-title">Informations</h2> -->
		                				<div class="row">
		                					<div class="col-sm-6">
		                						<label>Titre *</label>
		                						<input type="text" id="titre" name="titre" class="form-control" value="<?php echo $selecte_produit['Titre']; ?>" required>
		                					</div><!-- End .col-sm-6 -->

                                            <div class="col-sm-6">
                                                <label>Résumé *</label>
                                                <input type="text" id="resume" name="resume" class="form-control" value="<?php echo $selecte_produit['Resume']; ?>" required>

                                                <input type="hidden" id="id_service" name="id_service" value="<?php echo $selecte_produit['Id']; ?>" required>

                                            </div><!-- End .col-sm-6 -->

		                				</div><!-- End .row -->

	            						<div class="row">
		                					<div class="col-sm-12">
		                						<label>Description</label>
		                						<textarea id="description" name="description" class="form-control" cols="30" rows="4" placeholder="Bref description de l'article" required> <?php echo $selecte_produit['Description']; ?> </textarea>
		                					</div><!-- End .col-sm-6 -->

		                				</div><!-- End .row -->

                                        <br>

                                        <button type="submit" name="valider" class="btn btn-outline-primary-2 btn-order btn-block">
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

        // // Envoie formulaire
        // $("#form").submit(function(e) {
        //     e.preventDefault();

        //     $('#envoie_en_cours').css('display', 'block');

        //     var titre = $('#titre').val();
        //     var categorie = $('#categorie').val();
        //     var prix = $('#prix').val();
        //     var pourcentage = $('#pourcentage').val();
        //     var resume = $('#resume').val();
        //     var description = $('#description').val();
        //     var form = $('#form')[0];
        //     var formData = new FormData(form);

      
        //         $.ajax({ 
        //             url : "addArticleTraitement.php",
        //             type : "POST", data : formData, dataType : 'html', processData: false, contentType: false, cache: false,

        //                 xhr : function (){

        //                     var jqXHR = null;
        //                     if (window.ActiveXObjet) {
        //                         jqXHR = new window.ActiveXObjet("Microsoft.XMLHTTP");
        //                     }else {
        //                         jqXHR = new window.XMLHttpRequest();
        //                     }

        //                     jqXHR.upload.addEventListener("progress", function(event){
        //                         if (event.lengthComputable) {
        //                             var percentComplete = Math.round((event.loaded*100)/event.total);

        //                             $('#patience0').show();
        //                             $('#patience1').show();

        //                             $('#progressBar').css("width", +percentComplete+"%");
        //                             $('#progressBar').text(percentComplete+"%");
                                    
        //                         }
        //                     }, false);

        //                     return jqXHR;
        //                 },

        //                 success : function(code_html, statut){ 

        //                     $('#patience0').hide();
        //                     $('#patience1').hide();

        //                     if (code_html == 1 ) {

        //                         $('#envoie_en_cours').css('display', 'none');
        //                         $('#titre').val('');
        //                         $('#categorie').val('');
        //                         $('#prix').val('');
        //                         $('#image').val('');
        //                         $('#pourcentage').val('');
        //                         $('#resume').val('');
        //                         $('#description').val('');

        //                     }else if(code_html == 0 ) {

        //                         $('#envoie_en_cours').css('display', 'none');

        //                         alert('Une erreur liée aux fichiers est survenue. Veuillez vérifier l\'extension des fichiers que vous tentez t\'envoyer !');
                            
        //                     }else {

        //                         alert(code_html);
        //                         $('#envoie_en_cours').css('display', 'none');
        //                     }                                

        //                 },
        //                 error : function(erreur){

        //                     $('#envoie_en_cours').css('display', 'none');
        //                     alert('une erreur est suvenue'); 
        //                 },
        //         });
            
        // });
        
    </script>
</body>


</html>