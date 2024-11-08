<?php
    require('vendor/autoload.php');

    // Get config info from hidden file
    $config_filepath = "../config.json";
    $config_raw = file_get_contents("../config.json");
    $config = json_decode($config_raw, true); // The "true" puts it in array mode


    // Initialize PHPmail class

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    $mail = new PHPMailer(true); // true = throw an exception if there is a problem.

    // Set up SMTP
    $mail->isSMTP();
    $mail->SMTPAuth = true; // You don't always need this, only if auth is required (not sure when that is)

    // TODO: I'll need to do some gmail settings configuration to get this working.
    // Something on the billsbusbenches gmail account.

//    https://mailtrap.io/blog/phpmailer-gmail/

    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = 

    // continue the tutorial from this point
    // https://www.mailslurp.com/blog/phpmailer-tutorial

    // Server settings 
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;    //Enable verbose debug output 
    $mail->isSMTP();                            // Set mailer to use SMTP 
    $mail->Host = $config["mail_gmail"]["server_address"];           // Specify main and backup SMTP servers 
    $mail->SMTPAuth = true;                     // Enable SMTP authentication 
    $mail->Username = $config["mail_gmail"]["emailDestination"];       // SMTP username 
    $mail->Password = $config["mail_gmail"]["password"];         // SMTP password 
    $mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted 
    $mail->Port = 465;                          // TCP port to connect to 
 
    $mail->setFrom($_POST["email"]);
    //echo $config["mail_gmail"]["emailDestination"];
    $mail->addAddress($config["mail_gmail"]["emailDestination"]);

// GMAIL info
// smtp server: smtp.gmail.com
// SMTP name: your full name
// SMTP username: your full username
// SMTP password: password for gmail


    // The global $_POST variable allows you to access the data sent with the POST method by name
    // To access the data sent with the GET method, you can use $_GET

    // Parse POST data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $name = $firstname . " " . $lastname;

    $emailFrom = $_POST['email'];
    $request = $_POST['reason'];
    $message = $_POST['message'];

    //$subject = "AUTOMESSAGE: " . $emailFrom;
    $mail->Subject = "AUTOMESSAGE: " . $emailFrom;

// Mail body content 
$bodyContent = '<h1>How to Send Email from Localhost using PHP by CodexWorld</h1>'; 
$bodyContent .= '<p>This HTML email is sent from the localhost server using PHP by <b>CodexWorld</b></p>'; 
$mail->Body    = $bodyContent; 

    $body = "FROM: " . $name . "\nEMAIL: " . $emailFrom . "\nREQUEST: " . $request . "\nMESSAGE:\n" . $message;

    $body = wordwrap($body, 70);

    // //if($_POST['message']) {
    // //    mail(
    // //        "billsbusbenches@gmail.com",
    // //        $subject,
    // //        $body
    // //    );
    // //}
// 
    // $headers = "From: " . $emailFrom;
// 
    // mail($config->emailDestination, $subject, $body, $headers); // this won't work on localhost
// 
    // // Probably should use PHPMailer in the future instead of mail(). Future todo.
    // header("Location: index.php?mailsend");
// 
    // // echo $body;



    // Send email 
if(!$mail->send()) { 
    echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
} else { 
    echo 'Message has been sent.'; 
}
