<?php
 
class AjoutEnchere {
    
    public $id;
    public $intitule;
    public $prix_depart;
    public $duree_enchere;
    public $image_nom;
    public $prix_clic;
    public $augmentation_prix;
    public $augmentation_duree;
    public $date_fin;
    public $active_enchere = 'Actif';
    public $etat_enchere = 'Disponible';

    public function __construct(string $intitule, int $prix_depart, int $duree_enchere, string $image_nom, float $prix_clic, float $augmentation_prix, int $augmentation_duree)
    {
        $this->id = md5(uniqid(rand(), true));
        $this->intitule = htmlentities($intitule);
        $this->prix_depart = htmlentities($prix_depart);
        $this->duree_enchere = htmlentities($duree_enchere);
        $this->image_nom = htmlentities($image_nom);
        $this->augmentation_prix = htmlentities($augmentation_prix);
        $this->augmentation_duree = htmlentities($augmentation_duree);
        $this->date_fin = mktime(date("H")+ (int)$this->duree_enchere['duree'], date("i"), date("s"), date("m"), date("d"), date("Y"));
        $this->saveToArray();
    }

    public function saveToArray()
    {

        $enregistrementData = json_decode(file_get_contents(__ROOT__.'/data/data.json'), true); //On recupere le contenu de data.json
        if($enregistrementData){
            array_push($enregistrementData, $this);//On ajoute le nouvel id
            file_put_contents(__ROOT__.'/data/data.json', json_encode($enregistrementData),FILE_APPEND);
        }else{
            $enregistrementData = [];
            array_push($enregistrementData, $this);//On ajoute le nouvel id
            file_put_contents(__ROOT__.'/data/data.json', json_encode($enregistrementData, FILE_APPEND));
        }

    }

}
?>