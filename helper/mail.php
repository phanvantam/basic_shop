<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

#Chức năng : Gửi mail 
#$data : Là một array chứa 'title','content' của mail 
#$recipie : Là một array chứa 'name','email' của người nhận
function send_mail($data,$recipie){
    require 'plugins/mailer/src/Exception.php';
    require 'plugins/mailer/src/PHPMailer.php';
    require 'plugins/mailer/src/SMTP.php';
    global $config ;
    $email = $config['email'] ;
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
    //    $mail->SMTPDebug = 4;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->CharSet = $email['charset'];
        $mail->Host = $email['smtp_host'];  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $email['smtp_user'];                 // SMTP username
        $mail->Password = $email['smtp_pass'];                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = $email['smtp_port'] ;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom($email['smtp_user']);
        $mail->addAddress($recipie['email'], $recipie['name']);     // Add a recipient
        $mail->addReplyTo($email['smtp_user']);
    //    $mail->addCC('cc@example.com');
    //    $mail->addBCC('bcc@example.com');

        //Attachments
    //    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $data['title'];
        $mail->Body    = $data['content'];

        $mail->send();
        return true ; 
    } catch (Exception $e) {
        return false ;
    }
}
