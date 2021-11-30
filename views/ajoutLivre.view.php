<?php ob_start(); ?>

<form enctype="multipart/form-data" method="post" action="index.php?page=livres/av/">
    <div class="form-group">
        <label for ="titre">Titre<</label>
        <input type="text" class ="form-control" id ="titre" name ="titre">
        </div>
    <div class="form-group">
        <label for ="nbPages">Nombre de pages</label>
        <input type="number" class ="form-control" id="nbPages" name ="nbPages">
        </div>
    <div class="form-group">
        <label for ="image"> Image</label>
        <input type="file" class ="form-control" id ="image" name ="image">
    </div>
    <button type="submit" class ="btn btn-primary">Valider</button>
</form>
<?php
    $titre="Ajout d'un livre";
    $content= ob_get_clean();
    require_once "Template.php";
