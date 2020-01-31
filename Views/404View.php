<?php

require_once("header.php");
?>

<div class="container">
    <div class="text-center">
        <p class="lead">Erreur 404, la page "<?php echo htmlentities($page) ?>" n'existe pas...</p>
    </div>
</div>

<?php
require("footer.php");