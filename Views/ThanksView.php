<?php

require_once("header.php");
?>

    <main role="main" class="container h-100 w-50">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col border rounded p-2">
                <p class="lead text-center">Thanks for trusting us <?php
                    /** @var string $name */
                    echo $name ?> !</p>
                <p class="text-center">Your files will be sent to <span
                            class="text-primary font-weight-bold"><?php
                        /** @var string $mail */
                        echo $mail ?></span> shortly !</p>
                <div class="d-flex p-0">
                    <div class="w-75">
                        <p class="lead text-center">Message :</p>
                        <p class="p-1 text-justify"><?php
                            /** @var string $message */
                            echo $message;
                            ?></p>
                    </div>
                    <div class="w-50">
                        <p class="lead text-center">Files :</p>
                        <ul class="list-unstyled p-1"><?php

                            define('KB', 1024);
                            define('MB', 1048576);
                            define('GB', 1073741824);
                            define('TB', 1099511627776);

                            /** @var array $files */
                            foreach ($files as $fileIndex => $fileSize) {

                                echo "<li class='d-flex justify-content-between'><span class='text-primary'>";
                                echo "$fileIndex";


                                echo "</span><span class='font-italic'>";
                                $fileSizeText = number_format($fileSize / TB, 2) . "TB";
                                if ($fileSize <= TB) {
                                    $fileSizeText = number_format($fileSize / GB, 2) . " GB";
                                    if ($fileSize <= GB) {
                                        $fileSizeText = number_format($fileSize / MB, 2) . " MB";
                                        if ($fileSize <= MB) {
                                            $fileSizeText = number_format($fileSize / KB, 2) . " KB";
                                            if ($fileSize <= KB) {
                                                $fileSizeText = number_format($fileSize, 2) . " Bytes";
                                            }
                                        }
                                    }
                                }

                                echo $fileSizeText;
                                echo "</span></li>";

                            }
                            ?></ul>
                    </div>
                </div>
                <a href="<?php echo $baseUrl ?>" class="btn btn-primary w-100 mt-2">Back</a>
            </div>
        </div>
    </main>


<?php
require("footer.php");