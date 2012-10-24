<?php

	//If the form is submitted
	if(isset($_POST['submitted'])) {
		
		global $shortname;
		$theme_options = get_option( $shortname.'_theme_options' );
		
		//Check to see if the honeypot captcha field was filled in
		if(trim($_POST['checking']) !== '') {
		
			$captchaError = true;
			
		} else {
		
			//Check to make sure that the name field is not empty
			if(trim($_POST['contactName']) === '') {
				$nameError = __('You forgot to enter your name.', 'raw_theme');
				$hasError = true;
			} else {
				$name = trim($_POST['contactName']);
			}
			
			//Check to make sure sure that a valid email address is submitted
			if(trim($_POST['email']) === '')  {
				$emailError = __('You forgot to enter your email address.', 'raw_theme');
				$hasError = true;
			} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
				$emailError = __('You entered an invalid email address.', 'raw_theme');
				$hasError = true;
			} else {
				$email = trim($_POST['email']);
			}
				
			//Check to make sure comments were entered	
			if(trim($_POST['comments']) === '') {
				$commentError = __('You forgot to enter your message.', 'raw_theme');
				$hasError = true;
			} else {
				$comments = trim($_POST['comments']);
			}
			
			//If there is no error, send the email
			if(!isset($hasError)) {

				$emailTo = $theme_options[$shortname.'_address'];
				$subject = get_bloginfo('name').' contact form submission';
				$sendCopy = trim($_POST['sendCopy']);
				
				$name = stripslashes($name);
				$email = stripslashes($email);
				$comments = stripslashes($comments);
				
				$body = $comments."\r\n\r\n";
				$body .= $name;
				
				// Email headers
				$headers = "Content-Type: text/plain; charset=utf-8\r\n";
				$headers .= "From: ".$name." <".$email.">";
				
				mail($emailTo, $subject, $body, $headers);

				if($sendCopy == true) {
				
					$subject = "You emailed ".get_bloginfo('name');
					
					// Email headers
					$receipt_headers = "Content-Type: text/plain; charset=utf-8\r\n";
					$receipt_headers .= "From: ".get_bloginfo('name')." <".$emailTo.">";
					
					mail($email, $subject, $body, $receipt_headers);
					
				}

				$emailSent = true;

			}
		}
	}


?>