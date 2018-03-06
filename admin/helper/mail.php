<?php
function send_mail($data,$recipie,$email)
{
require 'plugins/mailer/PHPMailerAutoload.php';
$mail = new PHPMailer;

//    $mail->SMTPDebug =  $email['smtp_timeout'];
$mail->CharSet = $email['charset'] ;
$mail->isSMTP();                                      // Đặt mailer để sử dụng SMTP
$mail->Host =  $email['smtp_host'];  					// Chỉ định máy chủ SMTP chính và sao lưu
$mail->SMTPAuth = true;                               // Kích hoạt xác thực SMTP
$mail->Username = $email['smtp_user'];                 // SMTP username
$mail->Password = $email['smtp_pass'];                           // SMTP password
$mail->SMTPSecure = 'tls';                             // Bật mã hóa TLS, `ssl` cũng chấp nhận
$mail->Port = $email['smtp_port'];                                    // cổng TCP để kết nối với

$mail->setFrom( $email['smtp_user'],  $email['smtp_user']);
$mail->addAddress($recipie['email'],$recipie['name']);     // Thêm người nhận    Tên là tùy chọn
$mail->addReplyTo( $email['smtp_user'],  $email['smtp_user']);
$mail->addCC('cc@example.com');
$mail->addBCC('bcc@example.com');

$mail->addAttachment('/var/tmp/file.tar.gz');         // Thêm tệp đính kèm
$mail->addAttachment('/tmp/image.jpg', 'new.jpg');      // Tên tùy chọn
$mail->isHTML(true);                                  // Thiết lập định dạng email sang HTML

$mail->Subject = $data['title'] ;
$mail->Body    = $data['content'] ;

if($mail->send()) {
return true ;
} else {
return false ;
}
}