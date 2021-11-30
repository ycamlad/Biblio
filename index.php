<?php
define("URL",str_replace("index.php","",(isset($_SERVER['HTTPS'])?"https":"http").
"://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));
require_once "Controllers/livres.controller.php";
    $livreController = new livreController;

    try {
        if (empty($_GET['page'])) {

            require "views/accueil.view.php";
        } else {
            $url = explode("/", filter_var($_GET['page']), FILTER_SANITIZE_URL);
            switch ($url[0]) {
                case "accueil":
                    require "views/accueil.view.php";

                    break;
// c'est ici que la connection avec les views est faite pour etre capable d'afficher les livres
                case "livres" :
                    if (empty($url[1])) {
                        for($i=0;$i<count($url);$i++) {
                            $livreController->afficherLivres();
                        }
                    } else if ($url[1] === "l") {
                       $livreController->afficherLivre($url[2]);

                    } else if ($url[1] === "a") {
                        $livreController->ajoutLivre();
                        require_once "views/ajoutLivre.view.php";

                    } else if ($url[1] === "m") {
                        $livreController->modificationLivre($url[2]);

                    } else if ($url[1] === "s") {
                      $livreController->suppressionLivre($url[2]);

                    } else if ($url[1] === "av") {
                        $livreController->ajoutLivreValidation();

                    }  else if ($url[1] === "mv") {
                        $livreController->modifierLivreValidation();

                    } else {
                        throw  new Exception("La page n'existe pas");
                    }
                    break;
                    default : throw  new Exception("La page n'existe pas");
            }
        }
    }catch (Exception $e){
        echo $e->getMessage();
    }



