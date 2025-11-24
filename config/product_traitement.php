
<?php

include_once('base/connexion_base_donne.php');


if (isset($_POST['supprimer_article']) AND $_POST['supprimer_article'] == 'oui' ) {

    $id_produit = htmlspecialchars(trim($_POST['id_produit']));

    $selecte_produit0 = $lock->prepare('SELECT * FROM commerce_article WHERE Id = ? ');
    $selecte_produit0->execute(array($id_produit));
    $selecte_produit = $selecte_produit0->fetch();


    if (is_file('assets/images/article/'.$selecte_produit['Image'])) {
        
        unlink('assets/images/article/'.$selecte_produit['Image']);
    }

    for ($i=1; $i <= 5; $i++) { 
        
        if (is_file('assets/images/article/'.$selecte_produit['Image'.$i])) {
            
            unlink('assets/images/article/'.$selecte_produit['Image'.$i]);
        }
    }


    $delete = $lock->prepare('DELETE FROM commerce_article WHERE Id = ? ');
    $delete->execute(array($id_produit));

    echo 1;
}




?>