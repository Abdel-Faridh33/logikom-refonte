

<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'assets/PHPMailer/src/Exception.php';
require 'assets/PHPMailer/src/PHPMailer.php';
require 'assets/PHPMailer/src/SMTP.php';



include_once('base/connexion_base_donne.php');


// Validation de la commande
if (isset($_POST['nom'])) {

	$id_commande = $_POST['id_user'].'_'.time();

	$nom = htmlspecialchars(trim($_POST['nom']));
	$prenom = htmlspecialchars(trim($_POST['prenom']));
	$lieu = htmlspecialchars(trim($_POST['lieu']));
	$telephone = htmlspecialchars(trim($_POST['telephone']));
	$email = htmlspecialchars(trim($_POST['email']));

	// On sauvegarde les infos du client
	$insert_info = $lock->prepare('INSERT INTO commerce_commande (Id_commande, Nom, Prenom, Numero, Mail, Lieu ) VALUES (?, ?, ?, ?, ?, ?) ');
	$insert_info->execute(array( $id_commande, $nom, $prenom, $telephone, $email, $lieu ));

	
	// On ajoute les articles dans la table de commande
	$select0 = $lock->prepare('SELECT p.*, Prix_reduction, Titre FROM commerce_panier AS p INNER JOIN commerce_article AS a ON a.Id = p.Id_article WHERE Id_user = ? ');
	$select0->execute(array( $_POST['id_user'] )); 

	$tr = ''; $total = 0;

	$i = 0;
	while ($select = $select0->fetch()) {

		$montant = $select['Quantite']*$select['Prix_reduction'];
		
		$insert_art = $lock->prepare('INSERT INTO commerce_commande_article (Id_commande, Article, Quantite, Montant ) VALUES (?, ?, ?, ?) ');
		$insert_art->execute(array($id_commande, $select['Id_article'], $select['Quantite'], $montant));

		$style = "";
		if ($i%2 == 0) {
			
			$style = "background-color: #f2f2f2;";
		}

		$tr .= '<tr style="'.$style.' border-bottom: 1px solid silver;"><td><b>'.$select['Titre'].'</b></td><td>'.$select['Quantite'].'</td><td>'.$montant.'</td></tr>';

		$total += $montant;
	}



	// On sauvegarde les infos de livraison
	$select0 = $lock->prepare('SELECT Montant FROM commerce_frais_livraison_panier AS p INNER JOIN commerce_frais_livraison AS a ON a.Id = p.Id_ville WHERE Id_user = ? ');
	$select0->execute(array( $_POST['id_user'] )); 
	$select = $select0->fetch();
	
	$frais_transport = 0;
	if ( $select0->rowCount() > 0 ) {
		
		$insert_livr = $lock->prepare('INSERT INTO commerce_commande_livraison (Id_commande, Montant ) VALUES (?, ?) ');
		$insert_livr->execute(array($id_commande, $select['Montant']));

		$frais_transport = $select['Montant'];
	
	}else{

		$insert_livr = $lock->prepare('INSERT INTO commerce_commande_livraison (Id_commande, Montant ) VALUES (?, ?) ');
		$insert_livr->execute(array($id_commande, 0));
	}


	$total += $frais_transport;



	// On supprime toutes les informations du panier
	$delete_panier = $lock->prepare('DELETE FROM commerce_panier WHERE Id_user = ? ');
	$delete_panier->execute(array( $_POST['id_user'] ));

	$delete_panier_livraison = $lock->prepare('DELETE FROM commerce_frais_livraison_panier WHERE Id_user = ? ');
	$delete_panier_livraison->execute(array( $_POST['id_user'] ));

	// On envoie les messages emails

		$text_mail = '<div style="font-family: times;"> <h2 style="color: violet">Cher(e) '.$prenom.' '.$nom.' </h2> <br><br> Votre commande a été enregistrée avec succès. <br><br> Nous allons vous contacter dans quelques instants ! </div>';

		$text_mail2 =  '<div style="font-family: times;"> <h2 style="color: black">'.$prenom.' '.$nom.' </h2> vient de valider une commande <br><br> 

			Numero : '.$telephone.' <br>
			Lieu : '.$lieu.' <br>
			Email : '.$email.' <br><br>

			<table style="width: 100%; height: 30px">
				<tr style="background-color: #0077b6; color: white; text-align: center; border-bottom: 1px solid silver;">
					<td><h3><b>Article</b></h3></td>
					<td><h3><b>Nombre</b></h3></td>
					<td><h3><b>Montant</b></h3></td>
				</tr>
				'.$tr.'
				<tr>
					<td><b>Tranport</b></td>
					<td></td>
					<td>'.$frais_transport.'</td>
				</tr>
				<tr>
					<td><h3><b>Total</b></h3></td>
					<td></td>
					<td><b style="color: green;">'.$total.' Fcfa </b></td>
				</tr>
				</table>
		 </div>';

			$mail = new PHPMailer(true);

            //Server settings
            $mail->isSMTP();        
            $mail->SMTPDebug = 0;                                   
            $mail->SMTPSecure = 'ssl';
            $mail->Host       = 'mail.groupelogikom.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'contact@groupelogikom.com';
            $mail->Password   = 'Logikom229@';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465; 

            // Envoie du mail à l'acheteur
            $mail->setFrom('contact@groupelogikom.com', 'Groupe Logikom');
            $mail->addAddress($email, $prenom.' '.$nom);
            $mail->addReplyTo('contact@groupelogikom.com', "Groupe Logikom");
            $mail->isHTML(true);
            $mail->Subject = 'Commande';
            $mail->Body    = $text_mail;
            $mail->send();

            // // Envoie du mail aux vendeurs
            // $mail2 = new PHPMailer(true);

            // //Server settings
            // $mail2->isSMTP();        
            // $mail2->SMTPDebug = 0;                                   
            // $mail2->SMTPSecure = 'ssl';
            // $mail2->Host       = 'mail.groupelogikom.com';
            // $mail2->SMTPAuth   = true;
            // $mail2->Username   = 'contact@groupelogikom.com';
            // $mail2->Password   = 'Logikom229@';
            // $mail2->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            // $mail2->Port       = 465;

            // $mail2->setFrom('contact@groupelogikom.com', 'Groupe Logikom');
            // $mail2->addAddress('contact@groupelogikom.com', "Groupe Logikom");
            // $mail2->addReplyTo($email, $prenom.' '.$nom);
            // $mail2->isHTML(true);
            // $mail2->Subject = 'Nouvelle commande';
            // $mail2->Body    = $text_mail2;
            // $mail2->send();




	echo 1;


} 

	


// Voir le tableau bilan de la commande
	if (isset($_POST['affiche_donne'])) {
		

		$select0 = $lock->prepare('SELECT a.*, Quantite, p.Id AS Id_panier FROM commerce_panier AS p INNER JOIN commerce_article AS a ON p.Id_article = a.Id WHERE p.Id_user = ? ');
		$select0->execute(array($_POST['id_user']));



		$resultat = '<tbody id="resultat_chargement">';

		$total = 0; $i = 1; $total_produit = 0;

		while ($select = $select0->fetch()) {

			$total_sous = $select['Quantite']*$select['Prix_reduction'];

			$total += $total_sous;

			$total_produit += $total_sous;
			
				$resultat .= '
					<tr>
						<td>
							<a href="#">'.$select['Titre'].'</a>
						</td>
						<td>
							'.$total_sous.' CFA
						</td>
					</tr>';
		}


		$resultat .= '
					<tr class="summary-subtotal">
		                <td>Sous total:</td>
		                <td>'.$total.' CFA</td>
		            </tr>';

		// On additionne le montant du frais de livraison
	    $frais0 = $lock->prepare('SELECT Montant FROM commerce_frais_livraison AS cfl INNER JOIN commerce_frais_livraison_panier AS cflp ON cflp.Id_ville = cfl.Id WHERE Id_user = ? ');
	    $frais0->execute(array($_POST['id_user']));

	    if ($frais0->rowCount() > 0 ) {

	    	$frais = $frais0->fetch();

	    	$total += $frais['Montant'];
	    	
	    	$resultat .= '
					<tr>
		                <td>Livraison:</td>
		                <td>'.$frais['Montant'].' CFA</td>
		            </tr>';
	    }else {

	    	$resultat .= '
					<tr>
		                <td>Livraison:</td>
		                <td>0 CFA</td>
		            </tr>';
	    }


	    $resultat .= '
					<tr class="summary-total">
		                <td>Total:</td>
		                <td>'.$total.' CFA</td>
		            </tr>';


		echo $resultat.'@@@'.$total_produit;
	}

	
