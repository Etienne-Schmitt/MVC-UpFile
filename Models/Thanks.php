<?php

use PHPMailer\PHPMailer\PHPMailer;


/**
 * Function sending people on Home page
 */
function backHome()
{

    $host = $_SERVER["HTTP_HOST"];
    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

    header("Location: http://$host$uri/");
    exit();
}

/**
 * Send email to $email with information
 * @param $email string Destination Email.
 * @param $name string Source name.
 * @param $message string Message show on the page.
 * @param $zipLink string Zip link for download.
 * @throws \PHPMailer\PHPMailer\Exception
 */
function sendEmail($email, $name, $message, $zipLink)
{
    require_once 'vendor/autoload.php';

    $mail = new PHPMailer();
    $mailBody = getDynamicMail("Views/mail.php", $email, $name ,$message, $zipLink );

    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Username = '1858b8ed3b5e94';
    $mail->Password = 'b3254e35549499';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 2525;

    $mail->setFrom('noreply@upfiles.gg', 'UpFiles');
    $mail->addReplyTo('noreply@upfiles.gg', 'UpFiles');
    $mail->addAddress($email);

    $mail->Subject = "$name send you files !";
    $mail->isHTML(true);
    $mail->msgHTML($mailBody);
    $mail->send();
}




function getDynamicMail($mailFilePath, $email , $name, $message, $link) {
    if (is_file($mailFilePath)) {
        ob_start();
        include $mailFilePath;
        return ob_get_clean();
    } else {
        return false;
    }
}


/**
 * Function for throw error 500 and stop php processing.
 * @param $reason string The reason why the script ended.
 */
function error500($reason = "Unknown error")
{
    require_once("Controllers/500Controller.php");
    exit("Error 500 : $reason");
}