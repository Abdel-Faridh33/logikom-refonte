
<?php

include_once('base/connexion_base_donne.php');


if (isset($_POST['voir_plus']) AND $_POST['voir_plus'] == 'oui' ) {

	$id_deja_affiche_tableau = explode(',', $_POST['id_deja_affiche_tableau']);

	$i = 0; $long_tableau = count($id_deja_affiche_tableau); $tableau = "("; $key = "0000";

	while ( $i < $long_tableau ) {
		
		if ( $id_deja_affiche_tableau[$i] != 'undefined' ) {
			
			$key .= ','.$id_deja_affiche_tableau[$i];
		}

		$i++;
	}

	$tableau .= $key.")";

	
	$select0 = $lock->query("SELECT * FROM service WHERE Id NOT IN $tableau ORDER BY RAND() LIMIT 8 ");

	$dernier = $_POST['index'];

	while ( $select = $select0->fetch()) {
        
    	echo '<input class="nombre_article_defaut" id="nombre_article_defaut'.$dernier.'" type="hidden" value="'.$select['Id'].'">';

    	echo '                                    
                                    <div class="col-6 col-md-3 col-lg-3">
                                        <div class="product product-2 text-center">
                                            <figure class="product-media">
                                                <span class="product-label label-circle label-new"> -'.$select['Reduction'].'%  </br></span>
                                                <a href="service_detail.php?id_product='.$select['Id'].'&token='.sha1($i.time().$i).'">
                                                    <img src="assets/images/article/'.$select['Image'].'" alt="Product image" class="product-image">
                                                </a>

                                                <div class="product-action product-action-dark">
                                                    <a href="service_detail.php?id_product='.$select['Id'].'&token='.sha1($i.time().$i).'" class="btn-product btn-cart" ><span> Consulter </span></a>
                                                </div>
                                            </figure>

                                            <div class="product-body">
                                            
                                                <h3 class="product-title"><a href="service_detail.php?id_product='.$select['Id'].'&token='.sha1($i.time().$i).'">'.$select['Titre'].'</a></h3>
                        
                                                <div class="ratings-container">
                                                    <div class="ratings">
                                                        <div class="ratings-val" style="width: 90%;"></div>
                                                    </div>
                                                    <span class="ratings-text">( '.$select['Review'].' Vues )</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            ';

            $dernier++;
    }


    echo '<div id="nouvelle_affiche"></div>';
	
	
}




?>