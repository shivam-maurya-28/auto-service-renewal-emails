<?php 
date_default_timezone_set('Asia/kolkata');

include 'connection.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

$current_date = date('Y-m-d');

$query = "SELECT * FROM services WHERE 
    (DATE_SUB(`expiration_date`, INTERVAL 30 DAY) = '$current_date' AND `reminder_30days` = 0) OR
    (DATE_SUB(`expiration_date`, INTERVAL 15 DAY) = '$current_date' AND `reminder_15days` = 0) OR
    (DATE_SUB(`expiration_date`, INTERVAL 7 DAY) = '$current_date' AND `reminder_7days` = 0) OR
    (`expiration_date` = '$current_date' AND `reminder_on_expiry` = 0)";
    
$result = $conn->query($query);
if($result->num_rows == 0){
	echo "no row selected in table";
}
while ($row = $result->fetch_assoc()) {
    $email = $row['email'];
    $service_name = $row['service_name'];
    $expiration_date = $row['expiration_date'];
    $service_type = $row['service_type'];
    $sub = 'Renew Your '.$service_type.' Before it Expire';


    if (date('Y-m-d', strtotime($expiration_date . ' - 30 days')) == $current_date) 
    {
        $message = "Reminder: Your service $service_name will expire in 30 days.";
        $update_query = "UPDATE services SET reminder_30days = 1 WHERE id = {$row['id']}";
    } 
    elseif (date('Y-m-d', strtotime($expiration_date . ' - 15 days')) == $current_date) 
    {
        $message = "Reminder: Your service $service_name will expire in 15 days.";
        $update_query = "UPDATE services SET reminder_15days = 1 WHERE id = {$row['id']}";
    }
    elseif (date('Y-m-d', strtotime($expiration_date . ' - 7 days')) == $current_date) 
    {
        $message = "Reminder: Your service $service_name will expire in 7 days.";
        $update_query = "UPDATE services SET reminder_7days = 1 WHERE id = {$row['id']}";
    }
    elseif ($expiration_date == $current_date)
    {
        $message = "Reminder: Your service $service_name expires today!";
        $update_query = "UPDATE services SET reminder_on_expiry = 1 WHERE id = {$row['id']}";
    }
    $conn->query($update_query);
    echo "message is send to ".$email."<br>";
    SendMail($mail,$email,$sub,$message);
}




function SendMail($mail,$recipient,$sub,$message){
	try 
	{
	//Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP(); 
    $mail->SMTPAuth   = true;                            //Enable SMTP authentication   

    $mail->Host       = 'smtp.gmail.com';              //Set the SMTP server to send through
    $mail->Username   = 'loginsystem28@gmail.com';                     //SMTP username
    $mail->Password   = 'gcokixrecfjlexbr';                               //SMTP password
    
    //ENCRYPTION_SMTPS 465 port  `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;  //TCP port to connect to; use 587 if you have set 
    //Recipients
    $mail->setFrom('loginsystem28@gmail.com', 'Mailer');
    $mail->addAddress($recipient, 'User');     //Add a recipient

    

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $sub;
    $mail->Body    = '
    <b>Dear User,</b><br>
    	'.$message.'
    
    ';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->send();

	} 
	catch (Exception $e) 
	{
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}

}



?>