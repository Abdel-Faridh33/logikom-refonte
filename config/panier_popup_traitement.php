



<?php

include_once('base/connexion_base_donne.php');
include_once('fonction.php');



// Le nombre d'articles dans le painer
if ( isset($_GET['nombre'] )) {
	
	// On verifie si l'utilisateur avait deja ajouter à son panier cet article
	$select0 = $lock->prepare('SELECT COUNT(Id) AS nbre FROM commerce_panier WHERE Id_user = ? ');
	$select0->execute(array($_GET['id_user']));
	$select = $select0->fetch();

	echo '<span id="nombre_produit_panier">'.$select['nbre'].'</span> </span>';
}

// Les articles qui y sont
if ( isset($_GET['article'] )) {
	

	$select0 = $lock->prepare('SELECT a.*, Quantite FROM commerce_panier AS p INNER JOIN commerce_article AS a ON p.Id_article = a.Id WHERE p.Id_user = ? ');
	$select0->execute(array($_GET['id_user']));


	$total = 0; $i = 0;
	$resultat = '<div class="dropdown-cart-products">';

	while ($select = $select0->fetch()) {

		$total += $select['Quantite']*$select['Prix_reduction'];
		

		$resultat .= '
								
                                    <div class="product">
                                        <div class="product-cart-details">
                                            <h4 class="product-title">
                                                <a target="_blanc" href="product.php?id_product='.$select['Id'].'&token='.sha1($i.time().$i).'">'.$select['Titre'].'</a>
                                            </h4>

                                            <span class="cart-product-info">
                                                <span class="cart-product-qty">'.$select['Quantite'].'</span>
                                                x '.convertir_devise($select['Prix_reduction'], $para['Devise']).'
                                            </span>
                                        </div>

                                        <figure class="product-image-container">
                                            <a target="_blanc" href="product.php?id_product='.$select['Id'].'&token='.sha1($i.time().$i).'" class="product-image">
                                                <img src="assets/images/article/'.$select['Image'].'" alt="product">
                                            </a>
                                        </figure>
                                        
                                    </div>
		';

		$i++;
	}

	$resultat .= '				
								</div>
								<div class="dropdown-cart-total">
                                    <span>Total</span>

                                    <span class="cart-total-price"> '.convertir_devise($total, $para['Devise']).'</span>
                                </div>
    ';
	

	echo '<span id="produit_panier">'.$resultat.'</span> </span>';
}


?>