<?php
require_once "Model.php";
require_once "Livre.php";
class LivreManager extends Model
{
    private $livres; // Tableau de Livre

    public function __construct(){

    }

    /**
     * @param $livres
     */
    public function ajoutLivre($livre)
    {
        $this->livres[] = $livre;
    }

    /**
     * @return mixed
     */
    public function getLivres()
    {
        return $this->livres;
    }
    public function chargementLivres(){
        $req=$this->getbdd()->prepare("SELECT * FROM livres order by id  ");
        $req->execute();
        $meslivres=$req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        foreach($meslivres as $livre){
            $l = new Livre($livre["id"],$livre["titre"],$livre["nbPages"],$livre["image"]);
            $this->ajoutLivre($l);
        }
    }

    public function getLivreById($id){
        for($i=0;$i<count($this->livres);$i++){
            if($this->livres[$i]->getId() === $id){
                return $this->livres[$i];
            }
        }

    }

     public function ajoutLivreBD($titre,$nbPages,$image){
        $req=" insert into biblio.livres (titre, nbPages, image) VALUES (:titre, :nbPages, :image)";
        $stmt = $this->getbdd()->prepare($req);
        $stmt ->bindValue(':titre',$titre, PDO::PARAM_STR);
        $stmt ->bindValue(':nbPages',$nbPages, PDO::PARAM_INT);
        $stmt ->bindValue(':image',$image, PDO::PARAM_STR);
        $resultat =$stmt->execute();
        if($resultat >0){
            $livre = new Livre ($this->getbdd()->lastInsertId(),$titre,$nbPages,$image); // creation d'un livre
            $this->ajoutLivre($livre); // ajout du livre dans le tableau de livre
        }


     }

     public function suppressionLivreBD($id){
        $req='delete from biblio.livres where id=:idLivres';
        $stmt = $this->getbdd()->prepare($req);
        $stmt ->bindValue(":idLivres",$id, PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if($resultat >0){
            $livre = $this->getLivreById($id);
            unset($livre);
        }
     }

     public function modifierLivreBD($id,$titre,$nbPages,$image){
        $req='update biblio.livres  set titre = :titre, nbPages = :nbPages ,image = :image where id= :id';
        $stmt = $this->getbdd()->prepare($req);
        $stmt->bindValue(":id",$id,PDO::PARAM_INT);
        $stmt->bindValue(":titre",$titre,PDO::PARAM_STR);
        $stmt->bindValue(":nbPages",$nbPages,PDO::PARAM_INT);
        $stmt->bindValue(":image",$image,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if($resultat >0){
            $this->getLivreById($id)->setTitre($titre);
            $this->getLivreById($id)->setNbPages($nbPages);
            $this->getLivreById($id)->setImage($image);
        }

     }





}