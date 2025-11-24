
<?php

    
    include("base/connexion_base_donne.php");
    include("base/miniature_carre.php");


    if (isset($_POST['titre']) ) {

        $titre = trim(htmlspecialchars($_POST['titre']));

        $prix = trim(htmlspecialchars($_POST['prix']));
        $resume = trim(htmlspecialchars($_POST['resume']));
        $description = trim($_POST['description']);
        // $mot_cle = trim(htmlspecialchars($_POST['mot_cle']));
        // $description = trim($_POST['description']);


        $date_hache = sha1(date('d').date('H').date('i').date('s').time());


                $infosphoto = pathinfo($_FILES['image_min']['name']);
                $extension_image_min = $infosphoto['extension'];
                $nom_photo_min = $date_hache.'.'.$extension_image_min;

                move_uploaded_file($_FILES['image_min']['tmp_name'], 'assets/images/article/'.$nom_photo_min);

        $nbre_suivi = 0;

        $nom_photo = array();

        for ($i=0; $i <5; $i++) { 
            
            if (isset($_FILES['image']['name'][$i]) ) {
                
                
                $infosphoto1 = pathinfo($_FILES['image']['name'][$i]);
                $extension_image = $infosphoto1['extension'];
                $nom_photo[$i] = $date_hache.$i.'.'.$extension_image;

                move_uploaded_file($_FILES['image']['tmp_name'][$i], 'assets/images/article/' . $nom_photo[$i]);

            }else{

                $nom_photo[$i] = '';

            }

        }

            $nom_photo_mini = 'mini_'.$nom_photo_min;
            // On copie la première image pour en faire un miniature carrée
            copy('assets/images/article/'.$nom_photo_min, 'assets/images/article/'.$nom_photo_mini);

            // On redimentionne la miniature pour la mettre sous la forme carré
            $photo = 'assets/images/article/'.$nom_photo_mini;
            $save = 'assets/images/article/'.'mini.jpg';
            font($photo, $save);
            placement($save, $photo, $photo);
           
            
            if ( true) {
               

                $prix_reduction = $_POST['prix'] - (($_POST['prix']*$_POST['pourcentage'])/100);

                $insert = $lock->prepare('INSERT INTO commerce_article ( Categorie, Titre, Prix_norm, Reduction, Prix_reduction, Resume, Description, Review, Image, Image1, Image2, Image3, Image4, Image5 ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ) ');
                $insert->execute(array( $_POST['categorie'], $titre, $_POST['prix'], $_POST['pourcentage'], $prix_reduction, $resume, $description, $nbre_suivi, $nom_photo_mini, $nom_photo[0], $nom_photo[1], $nom_photo[2], $nom_photo[3], $nom_photo[4]));


                echo 1;

            }else{

                echo 0;
            }       

           
    }else {

        echo 2;
    }

        