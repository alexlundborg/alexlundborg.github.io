<?php
require_once "Mail.php"; //Importera Pear Mail::factory bibloteket


$pickup = $_POST['pickup'];
$dropoff = $_POST['dropoff'];
$via = $_POST['via'];
$date = $_POST['date'];
$time = $_POST['time'];

$name = $_POST['name'];
$phone = $_POST['phone'];

$from = "testadress@jacobolsson.se"; //Ange avsändare här
$to = "alexander.lundborg@gmail.com"; //Ange mottagaren här
$subject = "Ny kundförfrågan (med mb_convert_encoding och Content-Transfer-Encoding: 8bit)"; //Ange titeln på meddelandet här
$subject = mb_convert_encoding($subject, "UTF-8");

$body = "Hej!\n\n $name önskar att bli upphämtad vid $pickup och avsläppt vid $dropoff. \n\n Datum: $date \n Tid: $time \n Telefon: $phone"; //Ditt meddelande
$body = mb_convert_encoding($body, "UTF-8");
	
$host = "smtp.fsdata.se"; //SMTP-server
$port = "26"; //Port för SMTP
$username = "testadress@jacobolsson.se"; //Ditt användarnamn för mailkontot
$password = "abc123"; //Ditt lösenord för mailkontot

/* Import av variabler till arrayer som används för att skicka iväg e-post */
$headers = array ('From' => $from,'To' => $to,'Subject' => $subject, "Content-Type: text/html;charset=utf-8", "Content-Transfer-Encoding: 8bit");
$smtp = Mail::factory('smtp',array ('host' => $host,'port' => $port,'auth' => true,'username' => $username,'password' => $password));
$mail = $smtp->send($to, $headers, $body);

/* Visa ett meddelande om mailet har gått iväg eller visa ett tekniskt felmeddelande om det uppstår problem */
if (PEAR::isError($mail)) {
echo("<p>" . $mail->getMessage() . "</p>");
} else {
    header('Location: thank-you.html');
}
?>