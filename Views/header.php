<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/bootstrap-grid.css">
    <link rel="stylesheet" href="assets/css/bootstrap-reboot.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand navbar-light bg-dark bg-transparent ">
            <a class="navbar-brand" href="<?php echo $baseUrl ?>">FileUp</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-toggle"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbar-toggle">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link<?php if ($page === "Home") { echo " active"; } ?>" href="<?php echo $baseUrl ?>">Home</a></li>
                    <?php if (isset($_SESSION["files"])) { ?>
                        <li class="nav-item"><a class="nav-link<?php if ($page === "Thanks") {
                                echo " active";
                            } ?>" href="<?php echo "$baseUrl/Thanks" ?>">Previous upload</a></li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
    </header>
