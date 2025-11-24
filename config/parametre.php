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
    <title>Logikom</title>
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
</head>



<?php

include_once('base/connexion_base_donne.php');

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

                        <a href="index.html" class="logo">
                            <img src="assets/images/logo.png" alt="Molla Logo" width="105" height="25">
                        </a>

                        <nav class="main-nav">
                            <ul class="menu sf-arrows">
                                <li class="">
                                    <a href="index.php" class="sf-with-ul">Home</a>   
                                </li>
                                <li>
                                    <a href="boutique.php" class="sf-with-ul">Collection</a>
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
        			<h1 class="page-title">Paramètre </h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Paramètre</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
            	<div class="checkout">
	                <div class="container">
            	
            			<form action="" method="post" autocomplete="off">
		                	<div class="row">
		                		<div class="col-lg-12">
		                			
<?php
    
    if (isset($_POST['valider'] )) {

        $titre = trim(htmlspecialchars($_POST['titre']));
        $devise = trim(htmlspecialchars($_POST['devise']));
        $location = trim(htmlspecialchars($_POST['location']));
        $numero = trim(htmlspecialchars($_POST['numero']));
        $email = trim(htmlspecialchars($_POST['email']));
        $user = trim(htmlspecialchars($_POST['user']));
        $password = trim(htmlspecialchars($_POST['password']));

        $update = $lock->prepare('UPDATE commerce_parametre SET Nom = ?, Location = ?, Numero = ?, Mail = ?, Devise = ?, Admin = ?, Password = ? WHERE Id = ? ');
        $update->execute(array($titre, $location, $numero, $email, $devise, $user, $password, 1));

        echo ' <div style="text-align: center;"> <h3 style="color: green;"> Mise à jour éffectuée avec succès </h3></div> ';
    }


    $select0 = $lock->query('SELECT * FROM kevin_commerce_parametre ');
    $select = $select0->fetch();

    
    $categorie0 = $lock->query('SELECT * FROM kevin_commerce_devise ');


    $elementCategorie = "";
    while ($categorie = $categorie0->fetch()) {

        if ($categorie['Id'] == $select['Devise']) {
            
            $selected = 'selected="selected"';
        }else{

            $selected = '';
        }
        
        $elementCategorie .= '<option '.$selected.' value="'.$categorie['Id'].'">'.$categorie['Nom'].'</option>';
    }
                                

            echo '
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Nom du site *</label>
                                                <input type="text" value="'.$select['Nom'].'" name="titre" class="form-control" required>
                                            </div>

		                					<div class="col-sm-6">
		                						<label>Devise *</label>
		                						<select id="categorie" name="devise" class="form-control" required="">
                                                    <option></option>

                                                     '.$elementCategorie.' 

                                                </select>
		                					</div>
		                				</div>

	            						<div class="row">
                                            <div class="col-sm-6">
                                                <label>Location *</label>
                                                <input type="text" value="'.$select['Location'].'" name="location" class="form-control" required>
                                            </div>

                                            <div class="col-sm-6">
                                                <label>Numero *</label>
                                                <input type="text" value="'.$select['Numero'].'" name="numero" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Mail *</label>
                                                <input type="email" value="'.$select['Mail'].'" name="email" class="form-control" required>
                                            </div>

                                            <div class="col-sm-6">
                                                <label>Nom d\'utilisateur *</label>
                                                <input type="text" value="'.$select['Admin'].'" name="user" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Mot de pass *</label>
                                                <input type="text" value="'.$select['Password'].'" name="password" class="form-control" required>
                                            </div>

                                            <div class="col-sm-6">
                                                <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block" name="valider">
                                                    <span class="btn-text">Valider</span>
                                                    <span class="btn-hover-text">Sauvegarder maintenant</span>
                                                </button>
                                            </div>
                                     </div>  

                                ';

?>                                
		                		</div><!-- End .col-lg-9 -->
		                		
		                	</div><!-- End .row -->
            			</form>
	                </div><!-- End .container -->
                </div><!-- End .checkout -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->
        
        <footer class="footer">
        	
        </footer><!-- End .footer -->
    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- Mobile Menu -->
    

    

    <!-- Plugins JS File -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.hoverIntent.min.js"></script>
    <script src="assets/js/jquery.waypoints.min.js"></script>
    <script src="assets/js/superfish.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>

    <script type="text/javascript">

        
        
    </script>
</body>

</html>