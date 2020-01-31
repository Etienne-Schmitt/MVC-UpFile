<?php
require_once("Models/Thanks.php");

$title = "Thanks";

/**
 * Test if Home correctly have been set or return to Home page.
 */
if (isset($_SESSION["uniqId"]) && !empty($_SESSION["uniqId"])) {

    /**
     * Server HOST.
     * @var string $host
     *
     * Uri asked by the client
     * @var string $uri
     */
    $host = $_SERVER["HTTP_HOST"];
    $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

    /**
     * Get all info from session var
     */
    $zipName = $_SESSION["zipFileName"];
    $name = $_SESSION["name"];
    $mail = $_SESSION["mailDestination"];
    $message = $_SESSION["message"];
    $uniqId = $_SESSION["uniqId"];
    $files = $_SESSION["files"];

    /**
     * Link for downloading the zip file
     * @var string $zipLink
     */
    $zipLink = "http://$host$uri/Uploads/$zipName";

    /**
     * Require all regex.
     */
    require_once "assets/regex.php";

    /**
     * If $mail is a valid email (tested with regex) send $email or throw 500 page.
     */
    if (preg_match($regexMail, $mail)) {
        try {
            sendEmail(html_entity_decode($mail), $name, $message, $zipLink);
        } catch (Exception $e) {
            if (!unlink("Uploads/$zipName")) {
                require_once("Controllers/500Controller.php");
                exit("Error 500 : Can't remove file $zipName");
            }
            require_once("Controllers/500Controller.php");
            exit("Error 500 : sendEmail() failed.");
        }
    } else {
        if (!unlink("Uploads/$zipName")) {
            require_once("Controllers/500Controller.php");
            exit("Error 500 : Can't remove file $zipName");
        }

        require_once("Controllers/500Controller.php");
        exit("Error 500 : Email regex test failed.");
    }
}

require_once "Views/ThanksView.php";