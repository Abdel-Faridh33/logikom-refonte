

<?php




use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'assets/PHPMailer/src/Exception.php';
require 'assets/PHPMailer/src/PHPMailer.php';
require 'assets/PHPMailer/src/SMTP.php';


if ( isset($_POST['email']) and $_POST['email'] != "" ) {

	$nom = trim(htmlspecialchars($_POST['nom']));
	$objet = trim(htmlspecialchars($_POST['objet']));
	$numero = trim(htmlspecialchars($_POST['numero']));
	$email = trim(htmlspecialchars($_POST['email']));
	$message = trim(htmlspecialchars($_POST['message']));


			$to = "contact@groupelogikom.com";
            $from = $email;
            $fromName = 'Contact client';
            $subject = $nom.' '.$numero;

            $html = '<h1 style="font-family: times;"> '.$message.' </h1><br><br><div style="font-size: 12px; color: silver;"><span style="color: purple;">Ce message a été envoyé par '.$nom.' dont le numero de téléphone est <a href="tel:'.$numero.'">'.$numero.'</a></span></div>';

            	$mail = new PHPMailer(true);
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
	           	$mail->addAddress('contact@groupelogikom.com', "Groupe Logikom");
	            $mail->addReplyTo($email, $nom);
	            $mail->isHTML(true);
	            $mail->Subject = $objet;
	            $mail->Body    = $html;
	            $mail->send();

       
            	
            	echo 1;


}


?>