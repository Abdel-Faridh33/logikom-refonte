
<?php

session_start();

	
	include("base/connexion_base_donne.php");
    include("base/miniature_carre.php");


	if (isset($_POST['titre']) ) {

		$titre = trim(htmlspecialchars($_POST['titre']));
        $resume = trim(htmlspecialchars($_POST['resume']));
        $description = trim($_POST['description']);


        $nom_photo = array();

        for ($i=0; $i <=4; $i++) { 
            
            if (isset($_FILES['image']['name'][$i]) ) {
                
                $date_hache = sha1(date('d').date('H').date('i').date('s').time());

                $infosphoto1 = pathinfo($_FILES['image']['name'][$i]);
                $extension_image = $infosphoto1['extension'];
                $nom_photo[$i] = $date_hache.$i.'.'.$extension_image;

                move_uploaded_file($_FILES['image']['tmp_name'][$i], 'assets/images/service/' . $nom_photo[$i]);

            }else{

                $nom_photo[$i] = '';

            }

        }

            $nom_photo_mini = 'mini_'. $nom_photo[0];
            // On copie la première image pour en faire un miniature carrée
            copy('assets/images/service/' . $nom_photo[0], 'assets/images/service/'.$nom_photo_mini);

            // On redimentionne la miniature pour la mettre sous la forme carré
            $photo = 'assets/images/service/'.$nom_photo_mini;
            $save = 'assets/images/service/'.'mini.jpg';
            font($photo, $save);
            placement($save, $photo, $photo);
           
            
            if ( true ) {
                
                $nbre_suivi = rand(5000, 99999);

    		    $insert = $lock->prepare('INSERT INTO service (Titre, Resume, Description, Review, Image, Image1, Image2, Image3, Image4, Image5, Redateur ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ) ');
                $insert->execute(array( $titre, $resume, $description, $nbre_suivi, $nom_photo_mini, $nom_photo[0], $nom_photo[1], $nom_photo[2], $nom_photo[3], $nom_photo[4], $_SESSION['admin'] ));


                echo 1;

            }else{

                echo 0;
            }       

           
	}else {

        echo 2;
    }

		