<?php 
/* form UI-kit 03/2020 */

// settings
	$recipient = trim($infoMuseo['email']);
	$subject = "Sistema Museale Valtellina - Web Form";
	$notSent = "<p>Messaggio non inviato, prego riprovare o contattare l'amministratore del sito.</p>";
	$multilanguage = "lingua: ".$user->language->name;

//1 required field
	$nome = "";
	$cognome = "";
	$email = "";
	$messaggio = "";
	$errori = "";

	//optional
	$oggetto = "";

//2 minifunction
	function errormessage($fieldname){
		return  "<p>Campo <strong>$fieldname</strong> mancante o non corretto, prego controllare</p>";
	}

// honeypot, usually is "citta" // qui e' telefono

	if ($input->post->invia) {
		
		/*spam check*/
		//honeypot 1
		if ($input->post->password) { 
			$session->redirect($homepage->url);
			$errori = 1;
		}
		// heneypot 2 (submission time)
		if ($input->post->crbcode) { 
			$past = (base64_decode($input->post->crbcode)) + 8 ; //timestamp in the past + add  seconds 
			$now = time();
			if ($past > $now) { 
				$session->redirect($pages->get('/')->url, false);
				$errori = 1;
				exit;
			}
		}

		if(!$errori){
			$emailMessage = "";
			foreach ($input->post() as $postKey => $postItem) {
			if ($postKey == "password" ) continue; // honeypot1
			if ($postKey == "crbcode" ) continue; // honeypot2
			if ($postKey == "invia" ) continue; 
			if ($postKey == "ppolicy" ) continue; 
			if ($postKey == "messaggio" ) {
				$$postKey = $sanitizer->textArea($postItem); // questo l'ho spostato sotto
			}else{
				$$postKey = $sanitizer->text($postItem);
			} 
			$emailMessage .= $postKey .": ". $postItem. "<br>";
			}

			//check if empy values		
			if (!$nome) 	$errori .= errormessage('nome');
			if (!$cognome) 	$errori .= errormessage('cognome');
			if (!$email) 	$errori .= errormessage('email');
			if (!$messaggio) $errori .= errormessage('messaggio');

			//further checks
			if (!$sanitizer->email($email)) 		$errori .= errormessage('email');
			if (!$sanitizer->checkbox($input->post->ppolicy)) 	$errori .= errormessage('Privacy Policy');

		}

		// if all OK, send ///////////////////////////////////////////////
		if (!$errori) {

			// aggiungi lingua
			$emailMessage .= $multilanguage;

			$mail = wireMail(); 
			$mail->to($recipient); // activate on line
			$mail->header('Reply-To', $email); // da controllare (procache)
			$mail->subject($subject);
			$mail->bodyHTML($emailMessage);
			$mail->addSignature(true);
			if ($mail->send()) {

				// GDPR
				$timestamp = time();
				$shaEmail = sha1($email);
				wire('log')->save('forms_gdpr', "$shaEmail; $timestamp" );

				// redirect
				$session->redirect($page->child->url);
			}else{
				$errori .= $notSent;
			}
		}

	}
