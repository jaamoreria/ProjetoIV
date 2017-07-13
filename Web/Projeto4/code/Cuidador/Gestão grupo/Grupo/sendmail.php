<?php

//Define the $_POST variables...
$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$message = $_REQUEST['message'];
//Ensure all fields are completed...
if (empty($name) || empty($email) || empty($message)) {
    echo('Please fill in all fields.');
}else{
//Send the email and print sender confirmation...
mail( "samysilva@ipvc.pt", "Email Form", $message, "From: $name <$email>"); //Edit the email address you wish messages to be sent to
echo('Your message was sent successfully!');
}

?>