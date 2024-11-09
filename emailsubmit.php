<?php
    require('vendor/autoload.php');

    // Get config info from hidden file
    $config_filepath = "../config.json";
    $config_raw = file_get_contents("../config.json");
    $config = json_decode($config_raw, true); // The "true" puts it in array mode

    echo "Starting up...<br>";
    
    // Parse POST data
    // The global $_POST variable allows you to access the data sent with the POST method by name
    // To access the data sent with the GET method, you can use $_GET
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $name = $firstname . " " . $lastname;

    $emailFrom = $_POST['email'];
    $request = $_POST['reason'];
    $message = $_POST['message'];
    
    // Create email
    $subject = "AUTOMESSAGE: " . $emailFrom;
    $body = "FROM: " . $name . "\nEMAIL: " . $emailFrom . "\nREQUEST: " . $request . "\nMESSAGE:\n" . $message;

    // Initialize PHPmail class
    echo "Loading mailer...<br>";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    $mail = new PHPMailer(true); // true = throw an exception if there is a problem.

    // Server settings 
    $mail->isSMTP();                            // Set mailer to use SMTP
    $mail->Host = $config["mail"]["smtp_server"]; // Specify main and backup SMTP servers 
    $mail->SMTPDebug = 2; // Debug level (uncomment to show network activity)
    
    $mail->SMTPAuth = true; // Enable SMTP authentication 
    $mail->Username = $config["mail"]["smtp_username"]; // This is SPECIFICALLY for logging into the SMTP server. This usually will match the address you're sending to, but it doesn't have to! You can set the destination address to anything you want.
    $mail->Password = $config["mail"]["smtp_password"]; // Again, this is for logging into the SMTP server. Your email will not send if your password is incorrect.
    
    $mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted 
    // ^ Try TLS encryption once I'm confident.
    
    $mail->Port = 465;                          // TCP port to connect to 
    $mail->addReplyTo($emailFrom, $name);       // The address that it should *look* like the email is coming from.
    $mail->setFrom($config["mail"]["smtp_username"]); // The address that you are ACTUALLY sending the email from.
    /* After further reading, it seems like the setFrom address must 
     * be within the SMTP server you are using. So, if you want to make 
     * it look like it came from someone else, you have to use addReplyTo. 
     * Otherwise it will be rejected with an error message like this:
     * 
     * Sender address rejected: not owned by user sample@email.com
     */

    $mail->addAddress($config["mail"]["destination"]); // This is where you set the destination for where the email is going

    // Email content
    $mail->isHTML(false); // Set true if email body uses HTML format
    $mail->Subject  = "AUTOMESSAGE: " . $emailFrom;
    $mail->Body     = $body;

    echo "Sending...<br>";

    // Send email 
    if(!$mail->send()) {
        echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
    } else {
        echo 'Message has been sent.'; 
    }
