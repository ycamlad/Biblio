<?php ob_start(); ?>

<form  enctype="multipart/form-data" method="POST" action="index.php?page=livres/mv/">
    <div class="form-group">
        <label for="titre"> Titre</label>
        <input type="text" class="form-control" id="titre"  name="titre" value="<?= $livre->getTitre(); ?>">
    </div>
    <div class="form-group">
        <label for="nbPages">Nombre de Pages</label>
        <input type="text" class="form-control" id="nbPages" name="nbPages" value="<?= $livre->getNbPages(); ?>">
    </div>
    <h2>Image : </h2>
    <img src = "<?= URL ?>Public/images/<?= $livre->getImage()?>">
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" class="form-control-file" id="image" name="image">
    </div>
    <input type="hidden" name="id" value="<?= $livre->getId() ?>">
    <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
    <?php
    $titre = "Modification d'un livre";
    $content = ob_get_clean();
    require_once "Template.php";


