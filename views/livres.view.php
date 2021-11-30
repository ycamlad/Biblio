    <?php
        ob_start();
    ?>
    <table class="table text-center">

        <tr class="table-dark">
            <th>Image</th>
            <th>Titre</th>
            <th>Nombre de pages</th>
            <th colspan="2">Action</th>
        </tr>

    <?php

    for($i = 0; $i < count($livres); $i++) :

    ?>

        <tr>
            <td><img src="Public/images/<?php echo $livres[$i]->getImage();?> " width="130px"></td>
            <td class="align-middle"><a href="index.php?page=livres/l/<?= $livres[$i]->getId();?>"><?= $livres[$i]->getTitre()?></a></td>
            <td class="align-middle"><?=$livres[$i]->getNbPages()?></td>
            <td class="align-middle"><a href="index.php?page=livres/m/<?= $livres[$i]->getId();?>" class="btn btn-warning">Modifier</a></td>
            <td class="align-middle">
                <form method="POST" action="index.php?page=livres/s/<?= $livres[$i]->getId();?>" onsubmit="return confirm('voulez-vous vraiment Supprimer?');">
                    <button class="btn btn-danger" type="submit">Supprimer</button>
                </form>

            </td>
        </tr>
        <?php endfor;?>
    </table>
        <a href="index.php?page=livres/a/" class="btn btn-success d-block">Ajouter</a>
    <?php
        $content =ob_get_clean();
        $titre = "Les livres de la bibliothèque";
        require_once "views/Template.php";
    ?>