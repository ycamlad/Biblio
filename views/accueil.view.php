<?php ob_start(); ?>
<p>
    ici le contenu de ma page d'acceuil
</p>
<?php
    $content = ob_get_clean();
    $titre = "Bibliothèque MGA";
      require "Template.php";
      ?>