

<?php

include_once('base/connexion_base_donne.php');

	
	if (isset($_GET['suppr_donne'])) {
		

		$delect = $lock->prepare('DELETE FROM commerce_panier WHERE Id = ? ');
		$delect->execute(array( $_GET['id_panier'] ));

	}

	if (isset($_GET['modifie_donne'])) {
		

		$delect = $lock->prepare('UPDATE commerce_panier SET Quantite = ? WHERE Id = ? ');
		$delect->execute(array( $_GET['quantite'], $_GET['id_panier'] ));

		echo 1;
	}



	// Enregistrement de choix de livraison du client
	if (isset($_POST['choix_livraison'])) {
		
		$select0 = $lock->prepare('SELECT * FROM commerce_frais_livraison_panier WHERE Id_user = ? ');
		$select0->execute(array( $_POST['id_user'] ));

		if ( $select0->rowCount() == 0 ) {
			
			$insert = $lock->prepare('INSERT INTO commerce_frais_livraison_panier (Id_user, Id_ville) VALUES (?, ?) ');
			$insert->execute(array( $_POST['id_user'], $_POST['id_choix'] ));
		
		}else if ($select0->rowCount() == 1) {
			
			$select = $select0->fetch();

			$update = $lock->prepare('UPDATE commerce_frais_livraison_panier SET Id_ville = ? WHERE Id_user = ? ');
			$update->execute(array( $_POST['id_choix'], $_POST['id_user'] ));
		}

		echo $_POST['id_user'];
	}


	
	if (isset($_GET['affiche_donne'])) {
		

		$select0 = $lock->prepare('SELECT a.*, Quantite, p.Id AS Id_panier FROM commerce_panier AS p INNER JOIN commerce_article AS a ON p.Id_article = a.Id WHERE p.Id_user = ? ');
		$select0->execute(array($_GET['id_user']));



		$resultat = '	<div class="row" id="resultat_chargement">
							<div class="col-lg-9" >
	                			<table class="table table-cart table-mobile">
									<thead>
										<tr>
											<th>Produit</th>
											<th>Prix</th>
											<th>Quantité</th>
											<th>Total</th>
											<th></th>
										</tr>
									</thead>

									<tbody>';

		$total = 0; $i = 1;

		while ($select = $select0->fetch()) {

			$total_sous = $select['Quantite']*$select['Prix_reduction'];

			$total += $total_sous;
			
			$resultat .= '

									<tr id="tr_panier'.$i.'">
											<td class="product-col">
												<div class="product">
													<figure class="product-media">
														<a href="#">
															<img src="assets/images/article/'.$select['Image'].'" alt="Product image">
														</a>
													</figure>

													<h3 class="product-title">
														<a href="#">'.$select['Titre'].'</a>
													</h3>
												</div>
											</td>
											<td class="price-col">'.$select['Prix_reduction'].' CFA</td>
											<td class="quantity-col">
                                                <div class="cart-product-quantity">
                                                    <div onclick="ouvre_modal_modifie('.$i.')" id="input_article'.$i.'" class="form-control"> '.$select['Quantite'].'</div>

                                                    <a href="#modal_modifie'.$i.'" id="modal_modifie_popup'.$i.'" style="display: none;" data-toggle="modal"></a>

                                                </div>
                                            </td>
											<td class="total-col" style="color: #0077b6">'.$total_sous.' CFA</td>
											<td class="remove-col">
												<button onclick="delect_panier('.$select['Id_panier'].', '.$i.')" class="btn-remove"><i class="icon-close" > </i> </button> </td>
										</tr>



	<div class="modal fade" id="modal_modifie'.$i.'" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill" role="tablist">
                                <li class="nav-item">
                                    <span class="nav-link active" data-toggle="tab" >Modification</span>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab-content-5">
                                <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="signin-tab">
                                    <form action="#">
                                        <div class="form-group">
                                            <label for="singin-email">Quantité</label>
                                            <input type="number" class="form-control" id="modifie_quantite'.$i.'"  value="'.$select['Quantite'].'" min="1" max="100" required>
                                        </div>

                                        <div class="form-footer">
                                            <button onclick="modifie_quantite('.$select['Id_panier'].', '.$i.')" type="" class="btn btn-outline-primary-2">
                                                <span>Valider</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>
                                            
                                        </div>
                                    </form>
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>							

			';

			$i++;
		}


		$resultat .= '

									</tbody>
								</table>

	                		</div>
	                		<aside class="col-lg-3">
	                			<div class="summary summary-cart">
	                				<h3 class="summary-title">Point total</h3>

	                				<table class="table table-summary">
	                					<tbody>
	                						<tr class="summary-subtotal">
	                							<td>Total produit:</td>
	                							<td>'.$total.' CFA</td>
	                						</tr>
	                						<tr class="summary-shipping">
	                							<td>Livraison:</td>
	                							<td>&nbsp;</td>
	                						</tr>';


// Option de livraison disponible
	
	$select_option0 = $lock->query('SELECT * FROM commerce_frais_livraison ');

		while ($option = $select_option0->fetch()) {

			$p0 = $lock->prepare('SELECT Id_ville FROM commerce_frais_livraison_panier WHERE Id_user = ? ');
	    	$p0->execute(array($_GET['id_user']));
	    	$p = $p0->fetch();

	    	if (isset($p['Id_ville']) AND $p['Id_ville'] == $option['Id']) { $checked = "checked";}
	    	else { $checked = ""; }
		 	
		 	$resultat .= '
	                						<tr class="summary-shipping-row">
	                							<td>
	                								<div class="custom-control custom-radio">
														<input type="radio" id="livraison_'.$option['Id'].'" name="shipping" class="custom-control-input" '.$checked.'>
														<label class="custom-control-label" for="livraison_'.$option['Id'].'" onclick="choix_livraison('.$option['Id'].')">'.$option['Nom_ville'].':</label>
													</div>
	                							</td>
	                							<td> '.$option['Montant'].' CFA </td>
	                						</tr>';
	    }


	    // On additionne le montant du frais de livraison
	    $frais0 = $lock->prepare('SELECT Montant FROM commerce_frais_livraison AS cfl INNER JOIN commerce_frais_livraison_panier AS cflp ON cflp.Id_ville = cfl.Id WHERE Id_user = ? ');
	    $frais0->execute(array($_GET['id_user']));

	    if ($frais0->rowCount() > 0 ) {

	    	$frais = $frais0->fetch();
	    	
	    	$total += $frais['Montant'];
	    }

	    		$resultat .= '

	                						<tr class="summary-total">
	                							<td>Total:</td>
	                							<td style="color: red;">'.$total.' CFA</td>
	                						</tr>
	                					</tbody>
	                				</table>

	                				<a href="checkout.php" class="btn btn-outline-primary-2 btn-order btn-block">VALIDER LA COMMANDE</a>
	                			</div>

		            			<a href="boutique.php" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUER L\'ACHAT</span><i class="icon-refresh"></i></a>
	                		</aside>
	        </div>
		';


		echo $resultat;
	}


		
