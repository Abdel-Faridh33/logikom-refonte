

<?php

include_once('base/connexion_base_donne.php');

	
if (isset($_POST['supprime_commande']) and $_POST['supprime_commande'] == 'oui' ) {

	// On supprime la commande
	$delete = $lock->prepare('DELETE FROM commerce_commande WHERE Id_commande = ? ');
	$delete->execute(array( $_POST['id_commande'] ));

	// On supprime les articles liés à la commande
	$delete = $lock->prepare('DELETE FROM commerce_commande_article WHERE Id_commande = ? ');
	$delete->execute(array( $_POST['id_commande'] ));

	// On supprime la livraison liée à la commande
	$delete = $lock->prepare('DELETE FROM commerce_commande_livraison WHERE Id_commande = ? ');
	$delete->execute(array( $_POST['id_commande'] ));

	echo 1;
	
}