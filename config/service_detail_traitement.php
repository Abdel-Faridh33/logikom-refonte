
<?php

include_once('base/connexion_base_donne.php');


if (isset($_POST['supprimer_service']) AND $_POST['supprimer_service'] == 'oui' ) {

    $id_service = htmlspecialchars(trim($_POST['id_service']));

    $selecte_produit0 = $lock->prepare('SELECT * FROM service WHERE Id = ? ');
    $selecte_produit0->execute(array($id_service));
    $selecte_produit = $selecte_produit0->fetch();


    if (is_file('assets/images/service/'.$selecte_produit['Image'])) {
        
        unlink('assets/images/service/'.$selecte_produit['Image']);
    }

    for ($i=1; $i <= 5; $i++) { 
        
        if (is_file('assets/images/service/'.$selecte_produit['Image'.$i])) {
            
            unlink('assets/images/service/'.$selecte_produit['Image'.$i]);
        }
    }


    $delete = $lock->prepare('DELETE FROM commerce_article WHERE Id = ? ');
    $delete->execute(array($id_service));

    echo 1;
}




?>