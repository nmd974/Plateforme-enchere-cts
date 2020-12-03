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
    public $active_enchere = 'Inactif';
    public $etat_enchere = 'Disponible';

    public function __construct(string $intitule, int $prix_depart, int $duree_enchere, string $image_nom, float $prix_clic, float $augmentation_prix, int $augmentation_duree)
    {
        $this->id = md5(uniqid(rand(), true));
        $this->intitule = htmlentities($intitule, ENT_QUOTES);
        $this->prix_depart = (int)htmlentities($prix_depart, ENT_QUOTES);
        $this->prix_clic = (float)htmlentities($prix_clic, ENT_QUOTES);
        $this->duree_enchere = (int)htmlentities($duree_enchere, ENT_QUOTES);
        $this->image_nom = htmlentities($image_nom, ENT_QUOTES);
        $this->augmentation_prix = (float)htmlentities($augmentation_prix, ENT_QUOTES);
        $this->augmentation_duree = (float)htmlentities($augmentation_duree, ENT_QUOTES);
        date_default_timezone_set("Indian/Reunion");//On definie la timezone à la reunion
        $this->date_fin = mktime(date("H")+ (int)$this->duree_enchere, date("i"), date("s"), date("m"), date("d"), date("Y"));//On ajoute une valeur de base meme si de base l'enchere ne sera pas activée
        $this->saveToArray();
    }

    public function saveToArray()
    {

        $enregistrementData = json_decode(file_get_contents(__ROOT__.'/src/data/data.json'), true); //On recupere le contenu de data.json
        //Si le tableau est vide alors on créé un tableau que l'on va ajouté la 1ere enchere sinon on ajoute à la suite la nouvelle enchere
        if($enregistrementData){
            array_push($enregistrementData, $this);//On ajoute le nouvel id
            file_put_contents(__ROOT__.'/src/data/data.json', json_encode($enregistrementData));
        }else{
            $enregistrementData = [];
            array_push($enregistrementData, $this);//On ajoute le nouvel id
            file_put_contents(__ROOT__.'/src/data/data.json', json_encode($enregistrementData));
        }

    }

}
?>