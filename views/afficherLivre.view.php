<?php ob_start(); ?>
<!--affiche ce qu'il y a a l'interieur des colonnes -->
<div class="row">
    <div class="col-6">
<!--        Affiche l'image -->
         <img src="<?= URL ?>Public/images/<?= $livre->getImage()?>">
</div>
<div class="col-6">
    <!--        Affiche le titre -->
    <p>Titre : <?= $livre->getTitre()?></p>
    <!--        Affiche le nombre de pages -->
    <p>Nombre de pages : <?=$livre->getNbPages()?></p>
</div>
</div>

<?php
    $titre =$livre->getTitre();
    $content = ob_get_clean();
    require_once "Template.php";
    ?>