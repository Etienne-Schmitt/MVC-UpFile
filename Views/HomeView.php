<?php

require_once("header.php");
?>

    <div class="container h-100 w-25">
        <div class="row h-100 justify-content-center align-items-center">
            <form method="post" action="" enctype="multipart/form-data" id="home-form" class="col border rounded p-2">
                <div class="form-group">
                    <label for="name">Name :</label>
                    <input id="name" required name="name" class="form-control" type="text" placeholder="Jean">
                </div>
                <div class="form-group">
                    <label for="email">Mail :</label>
                    <input id="email" required name="email" class="form-control" type="email" placeholder="jean@mail.fr">
                </div>
                <div class="form-group">
                    <label for="file">Files :</label>
                    <div class="custom-file">
                        <label for="file" class="custom-file-label text-left">Select your files</label>
                        <input id="file" multiple required name="file[]" class="custom-file-input" type="file"><?php $customFormFile = true; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="message">Message :</label>
                    <textarea name="message" id="message" class="form-control" cols="30" rows="10"
                              placeholder="Bonjour, voici vos fichiers."></textarea>
                </div>
                <div class="form-group form-check">
                    <input type="submit" class="btn btn-primary" value="Send">
                    <input type="reset" class="btn btn-secondary" value="Reset">
                </div>
            </form>
        </div>
    </div>


<?php
require_once("footer.php");