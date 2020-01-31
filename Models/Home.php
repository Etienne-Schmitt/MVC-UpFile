<?php
/**
 * Model containing all functions for HomeController
 */

/**
 * Contains the options for a PDO Object.
 */
$options = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

/**
 * New PDO Object.
 */
$bdd = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass, $options);


/**
 * Input the data into a new database row.
 * @param $pdo PDO A PDO object before prepare and send data to the data base.
 * @param $name string Source name in the form.
 * @param $mail string Destination email.
 * @param $message string Message written.
 * @param $zipPath string Zip path (don't need path sufix).
 * @param $uniq string A uniq string for uniq and secure uniq files upload.
 *
 * @throws Exception PDOException
 * @return bool <b>TRUE</b> for success or <b>FALSE</b> on failure.
 * @example setDBValue($pdoObjects, "John Cena", "john.cena@mail.com", "And this name is...", "john-cena.zip", "abc142857");
 */
function setDBValue($pdo, $name, $mail, $message, $zipPath, $uniq) {
    $sql = "INSERT INTO upfile_db.upfiles_files (name_source, mail_destination, message, zip_path, uniq) VALUES (:name, :mail, :message, :zip_path, :uniq)";

    $request = $pdo->prepare($sql);
    $request->bindParam(":name", $name);
    $request->bindParam(":mail", $mail);
    $request->bindParam(":message", $message);
    $request->bindParam(":zip_path", $zipPath);
    $request->bindParam(":uniq", $uniq);

    return $request->execute();
}


/**
 * Function showing Thanks page and stop php processing.
 */
function thanksPage() {

    $host = $_SERVER["HTTP_HOST"];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

    header("Location: http://$host$uri/Thanks");
    exit();
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