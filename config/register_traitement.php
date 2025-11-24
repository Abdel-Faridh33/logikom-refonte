
<?php
session_start();
?>


<?php

include_once('base/connexion_base_donne.php');



// On établie la connexion à la plate forme
if ( isset($_POST['admin_user'] )) {
	
	$admin = trim(htmlspecialchars($_POST['admin_user']));
	$password = sha1(trim(htmlspecialchars($_POST['password'])));

	$select0 = $lock->prepare('SELECT * FROM user WHERE Email = ? AND Pass = ? ');
	$select0->execute(array($admin, $password));
	$select = $select0->fetch();

	if ($select0->rowCount() == 1 ) {

		$_SESSION['admin'] = $select['Id'];
		$_SESSION['role'] = $select['Role'];
				
		echo 1;

	}else {

		echo 0;
	}
}


// Gestion des inscriptions
if ( isset($_POST['inscription']) AND $_POST['inscription'] == 'oui' ) {
	
	$nom_user = strtoupper(trim(htmlspecialchars($_POST['nom_user'])));
	$prenom_user = ucwords(trim(htmlspecialchars($_POST['prenom_user'])));
	$email_user = strtolower(trim(htmlspecialchars($_POST['email_user'])));
	$pass_user = sha1(trim(htmlspecialchars($_POST['pass_user'])));

	$select0 = $lock->prepare('SELECT * FROM user WHERE Email = ? ');
	$select0->execute(array($email_user));
	$select = $select0->fetch();

	if ($select0->rowCount() == 0 ) {

		$insert = $lock->prepare('INSERT INTO user (Nom, Prenom, Email, Pass, Role) VALUES (?, ?, ?, ?, ?) ');
		$insert->execute(array( $nom_user, $prenom_user, $email_user, $pass_user, 2 ));
				
		echo 1;

	}else {

		// L'adresse email est déjà occuppée
		echo 0;
	}
}


// Déconnexion
if ( isset($_GET['admin_user_deconnecter'] )) {
	
	session_destroy();

	echo 1;
}



// Gestion de mot de passe oublié
if (isset($_POST['mot_pass_oublie']) and $_POST['mot_pass_oublie'] == 'oui') {
	
	$email_user = strtolower(trim(htmlspecialchars($_POST['email_user'])));

	$verifie_email0 = $lock->prepare('SELECT * FROM user WHERE Email = ? ');
	$verifie_email0->execute(array( $email_user ));

	if ( $verifie_email0->rowCount() == 1 ) {

		$verifie_email = $verifie_email0->fetch();

		$diff = time() - $verifie_email['Last_update'];

		if ( $diff > 60 ) {
		
			$code = rand(100000, 999999);

			$update = $lock->prepare('UPDATE user SET Code = ?, Last_update = ? WHERE Id = ? ');
			$update->execute(array( $code, time(), $verifie_email['Id'] ));

			$to = $email_user;
            $from = "contact@groupelogikom.com";
            $fromName = 'GroupeLogikom';
            $subject = "Votre code est ".$code;
            $html = '<h1 style="font-family: times;">Votre code de confirmation pour mettre à jour votre mot de passe est <span style="color: purple;">'.$code.'</span></h1>';
            $headers = "From: $fromName"." <".$from.">\r\n". "Reply-To: $from\r\n"."Content-Type: text/html; charset=\"UTF-8\"\r\n";
            
            // Send email 
            $mail = @mail($to, $subject, $html, $headers); 
		
			echo 1;

		}else {

			echo 1;
		}

	}else {

		echo 0;
	}
}



// Confirmation du code pour gestion de mot de passe oublié
if (isset($_POST['confirmation_code']) and $_POST['confirmation_code'] == 'oui') {
	
	$email_user = strtolower(trim(htmlspecialchars($_POST['email_user'])));
	$new_password = trim(htmlspecialchars($_POST['new_password']));
	$code_confirmation = trim(htmlspecialchars($_POST['code_confirmation']));

	$verifie_email0 = $lock->prepare('SELECT * FROM user WHERE Email = ? AND Code = ? ');
	$verifie_email0->execute(array( $email_user, $code_confirmation ));

	if ( $verifie_email0->rowCount() == 1 ) {

		$verifie_email = $verifie_email0->fetch();

		$new_password = sha1($new_password);

		$update = $lock->prepare('UPDATE user SET Pass = ? WHERE Id = ? ');
		$update->execute(array( $new_password, $verifie_email['Id'] ));

		$_SESSION['admin'] = $verifie_email['Id'];
		$_SESSION['role'] = $verifie_email['Role'];
		
		echo 1;

	}else {

		echo $verifie_email0->rowCount();
	}
}


?>