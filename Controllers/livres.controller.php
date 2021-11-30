<?php

require_once "Models/LivreManager.php";
    class LivreController {
        private LivreManager $livreManager;
        public function  __construct()
        {
            $this->livreManager = new LivreManager;
            $this->livreManager->chargementLivres();
        }

        public function afficherLivres(){
            $livres = $this->livreManager->getLivres();
            require_once "views/livres.view.php";
        }
        public function afficherLivre($id){
            $livre = $this->livreManager->getLivreById($id);

            // afficherLivre.view.php fait appel a la fonction afficheLivre
            require_once "views/afficherLivre.view.php";
        }

        public function ajoutLivre(){
            require_once "views/ajoutLivre.view.php";
        }

        public function ajoutLivreValidation(){
            $file = $_FILES['image'];

            print_r($file);

            $repertoire ="public/images/";
            $nomImage = $this->ajoutImage($file,$repertoire); //upload de l'image
            $this->livreManager->ajoutLivreBD($_POST["titre"],$_POST["nbPages"],$nomImage); // ajout en BD et MAJ de la liste des livres
            header('location:index.php?page=livres');
        }

        private function ajoutImage ($file, $dir)
        {
            if(!isset($file['name']) || empty($file['name']))
                throw new Exception("Vous devez indiquer une image");

            if (!empty($file_exists)) {
                if(!$file_exists($dir)) mkdir($dir,0777);
            }

            $extension = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
            $random = rand(0,99999);
            $target_file = $dir.$random."_".$file['name'];

            if(!getimagesize($file["tmp_name"]))
                throw new Exception("Le fichier n'est pas ume image");
            if($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif")
                throw new Exception("L'extension du fichier n'est pas reconnu");
            if(file_exists($target_file))
                throw new Exception("Le fichier existe deja");
            if($file['size'] > 500000)
                throw new Exception("Le fichier est trop gros");
            if(!move_uploaded_file($file['tmp_name'],$target_file))
                throw new Exception("l'ajout de l'image n'a pas fonctionne");
            else return ($random."_".$file['name']);

        }
        public function suppressionLivre($id){
            $nomImage = $this->livreManager->getLivreById($id)->getImage();
            unlink("public/images/".$nomImage); // suppression de l'image
            $this->livreManager->suppressionLivreBD($id); //suppression en BD
            header('location:index.php?page=livres');
        }

        public function modificationLivre($id){
            $livre = $this->livreManager->getLivreById($id);
            require_once "views/modifierLivre.view.php";
        }

        public function modifierLivreValidation(){
            $imageActuelle = $this->livreManager->getLivreById($_POST['id'])->getImage();
            $file = $_FILES['image'];
            // verification pour savoir si une nouvelle image a ete uploader
            if($file['size']>0){
                // suppression de l'image dans le repertoire public/images
                unlink("public/images/".$imageActuelle);
                // nouvelle image ajoute
                $repertoire = "public/images/";
                $nomImageToAdd = $this->ajoutImage($file,$repertoire); // upload de l'image

            }else{
                // sinon l'image reste pareille
                $nomImageToAdd = $imageActuelle;
            }
            // modification du livre dans la BD
            $this->livreManager->modifierLivreBD($_POST["id"],$_POST["titre"],$_POST["nbPages"],$nomImageToAdd);
            header('location:index.php?page=livres');
        }

    }


