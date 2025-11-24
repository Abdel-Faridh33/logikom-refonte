


<?php

include_once('base/connexion_base_donne.php');

if ( isset($_POST['ajoutPanier'] )) {

	// On verifie si l'utilisateur avait deja ajouter à son panier cet article
	$select0 = $lock->prepare('SELECT Quantite FROM commerce_panier WHERE Id_user = ? AND Id_article = ? ');
	$select0->execute(array($_POST['id_user'], $_POST['id_article']));
	$select = $select0->fetch();

	if ( $select['Quantite'] == 0 ) {

		$insert = $lock->prepare('INSERT INTO commerce_panier (Id_user, Id_article, Quantite) VALUES (?, ?, ?) ');
		$insert->execute(array($_POST['id_user'], $_POST['id_article'], $_POST['quantite']));
	
	}else {

		$new_quantite = $select['Quantite']+$_POST['quantite'];

		$insert = $lock->prepare('UPDATE commerce_panier SET Quantite=? WHERE Id_user = ? AND Id_article = ? ');
		$insert->execute(array( $new_quantite, $_POST['id_user'], $_POST['id_article']));
	}
		// echo '1';
}




?>