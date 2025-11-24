

<?php

	$para0 = $lock->query('SELECT * FROM commerce_parametre ');
	$para = $para0->fetch();
	
	function convertir_nombre($lo){
		
	    $lo = strtr($lo, array(' ' => '' ,'.' => '', ',' => '', ';' => ''));
	    $taille = strlen($lo);
	    $inverse = strrev($lo);

	        $j = 1; $fin = null;
	    for ($i=0; $i < $taille; $i++) { 
	        if ($j%3 == 0) {
	            $fin .= $inverse[$i].' ';
	        }else {
	            $fin .= $inverse[$i];
	        }
	        
	        $j++;        
	    }

	    $fin = strrev($fin);
	    return $fin;
	}


	function convertir_devise($somme, $devise){

			
			$fin = '<b>'.convertir_nombre(round($somme)).' CFA</b>';

		return $fin;
	}

?>


<script type="text/javascript">
	

function AjoutPanier(idArticle, quantite){

	var id_user = localStorage.getItem("id_user");

	$.ajax({
        url : "fonction_traitement.php", 
        data: {
        	ajoutPanier: 'oui',
        	id_article: idArticle,
        	quantite: quantite,
        	id_user: id_user,
        },
        type : "POST",
        success : function(html){

            swal("Super !!", "Article ajouter au panier avec succès", "success");
        }, 
        error : function(error){

        	sweetAlert("Oops...", "Problème de connexion, veuillez ressayez !!", "error");
        },       
    });
};

// Gestion de connexion
    $('#form_register').submit(function(e){
        e.preventDefault();

        $('#connecter_fleche').css('display', 'none');
        $('#connexion_en_cours').css('display', 'block'); 

        $('#patience0').show();
        $('#patience1').show();

          var admin_user = $('#admin_user').val();  
          var password = $('#password').val();  

        $.ajax({
	        url : "register_traitement.php", 
	        type : "POST",
	        data: {
	        	admin_user: admin_user,
	        	password: password,
	        },
	        success : function(html){

	        	$('#patience0').hide();
                $('#patience1').hide();

	        	if (html == 1 ) {

	        		swal("Super !!", "Connexion établie avec succès", "success");
	        		location.reload(true);

	        	}else{

	        		sweetAlert("Oops...", "Adresse email ou mot de passe incorrect !!", "error");
	        		$('#connexion_en_cours').css('display', 'none');
	        		$('#connecter_fleche').css('display', 'block');

	        	}
	                               
	        },            
	    });   
    });



// Gestion des inscription
    $('#form_inscription').submit(function(e){
        e.preventDefault();

        $('#patience0').show();
        $('#patience1').show();

        $('#inscription_valider').css('display', 'none');
        $('#inscription_en_cours').css('display', 'block'); 

        var nom_user = $('#nom_user').val();  
        var prenom_user = $('#prenom_user').val();  
        var email_user = $('#email_user').val();  
        var pass_user = $('#pass_user').val();  

        $.ajax({
	        url : "register_traitement.php", 
	        type : "POST",
	        data: {
	        	inscription: 'oui',
	        	nom_user: nom_user,
	        	prenom_user: prenom_user,
	        	email_user: email_user,
	        	pass_user: pass_user,
	        },
	        success : function(html){

	        	$('#patience0').hide();
                $('#patience1').hide();

	        	if ( html == 1 ) {

	        		location.reload(true);
	        		swal("Super !!", "Le compte est créé avec succès", "success");
	        		$('#inscription_en_cours').css('display', 'none');
	        		$('#inscription_valider').css('display', 'block');

	        	}else if ( html == 0 ){

	        		sweetAlert("Oops...", "Cette adresse email était déjà utilisée !!", "error");
	        		$('#inscription_en_cours').css('display', 'none');
	        		$('#inscription_valider').css('display', 'block');

	        	}else {

	        		alert(html);
	        	}
	                               
	        },
	        error : function(error){

	        	$('#patience0').hide();
                $('#patience1').hide();

	        	sweetAlert("Oops...", "Problème de connexion, veuillez ressayez !!", "error");
	        },            
	    });   
    });


// Gestion de la déconnexion
    $('#form_register_deconnecter').click(function(e){
        
        $.ajax({
	        url : "register_traitement.php?admin_user_deconnecter", 
	        type : "GET",
	        success : function(html){

	        	if (html == 1 ) {

	        		location.reload(true);

	        	}
	                               
	        },            
	    });   
    });


// Gestion des mots de passe oubliés
    $('#lien_passe_oublie').click(function(e){
    	e.preventDefault();

    	$('#form_register').fadeOut();
    	$('#form_mot_passe').fadeIn();
    });


    $('#lien_connexion').click(function(e){
    	e.preventDefault();

    	$('#form_mot_passe').fadeOut();
    	$('#form_register').fadeIn();
    });

    // Envoie du mail pour le changement
    $('#form_mot_passe').submit(function(e){
    	e.preventDefault();

        $('#patience0').show();
        $('#patience1').show();
        var email_user = $('#adresse_oublie_user').val();
        
        $.ajax({
	        url : "register_traitement.php", 
	        type : "POST",
	        data: {
	        	mot_pass_oublie: 'oui',
	        	email_user: email_user,
	        },
	        success : function(html){

	        	$('#patience0').hide();
                $('#patience1').hide();

	        	if ( html == 1 ) {
	        		
	        		$('#form_mot_passe').fadeOut();
    				$('#form_confimartion_mot_passe').fadeIn();

	        	}else if ( html == 0 ){
	        		sweetAlert("Désolé", "Aucun compte n\'est associé à cette adresse !!", "error");
	        	}else {
	        		alert(html);
	        	}
	                               
	        },
	        error : function(error){
	        	sweetAlert("Oops...", "Problème de connexion, veuillez ressayez !!", "error");
	        },            
	    });   
    });



    // confirmation du changement
    $('#form_confimartion_mot_passe').submit(function(e){
        e.preventDefault();

        $('#patience0').show();
        $('#patience1').show();

        var email_user = $('#adresse_oublie_user').val();  
        var new_password = $('#new_password').val();  
        var code_confirmation = $('#code_confirmation').val();  

        $.ajax({
	        url : "register_traitement.php", 
	        type : "POST",
	        data: {
	        	confirmation_code: 'oui',
	        	email_user: email_user,
	        	new_password: new_password,
	        	code_confirmation: code_confirmation,
	        },
	        success : function(html){

	        	$('#patience0').hide();
                $('#patience1').hide();
// alert(html);
	        	if ( html == 1 ) {

	        		location.reload(true);
	        		swal("Super !!", "Mot de passe changé avec succès", "success");
	      
	        	}else{
	        		sweetAlert("Désolé", "Code de confirmation incorrect !!", "error");
	        	}
	                               
	        },
	        error : function(error){
	        	sweetAlert("Oops...", "Problème de connexion, veuillez ressayez !!", "error");
	        },            
	    });   
    });

</script>

