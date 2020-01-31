<?php

require_once("Models/Home.php");

$title = "Home";

if (isset($_POST) && !empty($_POST)) {


    /**
     * Actual date in the format YYYY-MM-DD.
     * @var string $date
     *
     * Source name send with POST on form page with special char escaped.
     * @var string $name
     *
     * Destination email send with POST on form page with special char escaped.
     * @var string $email
     *
     * Source message send with POST on form page with special char escaped.
     * @var string $message
     *
     * Nbr of file send with POST on form.
     * @var int $uploadFilesCount
     */
    $date = date("Y-m-d");
    $name = htmlentities($_POST["name"]);
    $email = htmlentities($_POST["email"]);
    $message = htmlentities($_POST["message"]);
    $uploadFilesCount = count($_FILES["file"]["name"]);


    /**
     * New object from class ZipArchive calling <i>ZipArchive->__constructor()<i>.
     */
    $zipArchive = new ZipArchive();

    /**
     * If random_bytes() fail exit safely and show 500 error pages.
     */
    try {
        /**
         * Get another $uniqID if a file already exists.
         */
        do {
            /**
             * Random bytes data converted to hexadecimal for pseudo uniq and safe name.
             * @var $uniqId string
             */
            $uniqId = bin2hex(random_bytes(8));
        } while (file_exists("Uploads/$date-$uniqId.zip"));
    } catch (Exception $error) {
        require_once("Controllers/500Controller.php");
        exit("Error 500 : uniqID generation error");
    }

    /**
     * Zip file name
     * @var string $zipFileName
     */
    $zipFileName = $date . "-" . $uniqId . ".zip";

    /**
     * If any function below return <b>FALSE</b> exit code and show error 500.
     */
    if (!$zipArchive->open("Uploads/$zipFileName", ZipArchive::CREATE)) {
        require_once("Controllers/500Controller.php");
        exit("Error 500 : zipArchive->open() failed.");
    }
    /**
     * Add all files in the archive.
     */
    for ($i = 0; $i < $uploadFilesCount; $i++) {
        $errorZip = $zipArchive->addFromString(
            $_FILES["file"]["name"][$i],
            file_get_contents($_FILES["file"]["tmp_name"][$i])
        );
        if (!$errorZip) {
            require_once("Controllers/500Controller.php");
            exit("Error 500 : zipArchive->addFromString($i) failed.");
        }
    }
    if (!$zipArchive->close()) {
        require_once("Controllers/500Controller.php");
        exit("Error 500 : zipArchive->close() failed.");
    }

    try {
        if (!setDBValue($bdd, $name, $email, $message, $zipFileName, $uniqId)) {
            require_once("Controllers/500Controller.php");
            exit("Error 500 : setDBValue() failed.");
        }
    } catch (Exception $e) {
        require_once("Controllers/500Controller.php");
        exit("Error 500 : setDBValue() failed.");
    }

    /**
     * Keep all useful variable in $_SESSION for ThanksPage and sendMail()
     */
    $_SESSION["name"] = $name;
    $_SESSION["mailDestination"] = $email;
    $_SESSION["message"] = $message;
    $_SESSION["uniqId"] = $uniqId;
    $_SESSION["zipFileName"] = $zipFileName;

    /**
     * Destroy $_SESSION["files"] values if exists.
     */
    unset($_SESSION["files"]);

    /**
     * Add all files names and size in $_SESSION["files"]
     */
    for ($i = 0; $i < $uploadFilesCount; $i++) {
        $_SESSION["files"][$_FILES["file"]["name"][$i]] = $_FILES["file"]["size"][$i];
    }

    /**
     * Go to Thanks page.
     */
    thanksPage();
}


require_once("Views/HomeView.php");