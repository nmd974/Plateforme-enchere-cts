<?php

class Enchere {
    
    public $intitule;
    public $prix_depart;
    public $duree_enchere;
    public $image_nom;
    public $prix_clic;
    public $augmentation_prix;
    public $augmentation_duree;
    public $date_fin;
    public $active_enchere;
    public $etat_enchere;

    public function __construct(string $id, string $intitule, float $prix_depart, int $duree_enchere, ?string $image_nom, float $prix_clic, float $augmentation_prix, int $augmentation_duree, int $date_fin, string $active_enchere, string $etat_enchere)
    {
        $this->id = $id;
        $this->intitule = $intitule;
        $this->prix_depart = $prix_depart;
        $this->duree_enchere = $duree_enchere;
        $this->image_nom = $image_nom;
        $this->prix_clic = $prix_clic;
        $this->augmentation_prix = $augmentation_prix;
        $this->augmentation_duree = $augmentation_duree;
        $this->date_fin = $date_fin;
        $this->active_enchere = $active_enchere;
        $this->etat_enchere = $etat_enchere;
    }

    public function toHTML():string
    {
        $id = $this->id;
        $intitule = htmlentities($this->intitule, ENT_QUOTES);
        $image_nom = $this->image_nom;
        $prix_depart = htmlentities(round($this->prix_depart,2), ENT_QUOTES);
        $prix_clic = htmlentities($this->prix_clic, ENT_QUOTES);
        $augmentation_prix = htmlentities($this->augmentation_prix, ENT_QUOTES);
        $date_actuelle = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
        $expire = $this->date_fin - $date_actuelle;

        if($expire <= 0 || $_SESSION['adminLogged']){
            $disabled = "disabled";
        }

        //Ici on determine si l'image existe ou non et en fonction on affiche le code html correspondant
        if($image_nom !== ""){
            return <<<HTML
            <div class="card  shadow m-lg-4" style="width: 18rem;">
                    <div class="duree d-flex position-absolute w-50 justify-content-center align-items-center font-weight-bold" id={$id}></div>
                    <img src="../../img/{$image_nom}" class="card-img-top img-fluid" style="height:230px;" alt="...">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">{$intitule}</h5>
                        <h4 class="display-6 font-weight-bold">{$prix_depart} €</h4>
                        <p class="card-text m-0">Prix du clic : {$prix_clic} cts</p>
                        <p class="card-text mb-4">Prix de l'enchère : {$augmentation_prix} cts/clic</p>
                        <div class="text-center">
                            <form method="POST" action=#{$id}>
                                <input name="indice" value={$id} {$expire} style="display:none;">
                                <button class="btn btn-primary btn-listEnchere p-0" name="submit">Enchérir</button>
                            </form>
                        </div>
                    </div>
                </div>

HTML;
        }else{
            return <<<HTML
            <div class="card  shadow m-lg-4" style="width: 18rem;">
                    <div class="duree d-flex position-absolute w-50 justify-content-center align-items-center font-weight-bold" id={$id}></div>
                    <div class="d-flex justify-content-center align-items-center" style="height:230px;">
                            <i class="fa fa-file-image-o fa-5x" aria-hidden="true"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">{$intitule}</h5>
                        <h4 class="display-6 font-weight-bold">{$prix_depart} €</h4>
                        <p class="card-text m-0">Prix du clic : {$prix_clic} cts</p>
                        <p class="card-text mb-4">Prix de l'enchère : {$augmentation_prix} cts/clic</p>
                        <div class="text-center">
                            <form method="POST" action="">
                                <input name="indice" value={$id} {$expire} style="display:none;">
                                <button class="btn btn-primary btn-listEnchere p-0" name="submit">Enchérir</button>
                            </form>
                        </div>
                    </div>
                </div>

HTML;
        }
    }

    public function timerSCRIPT():string
    {
        $date_fin = $this->date_fin;
        $id = $this->id;
        return <<<HTML
            <script>
                    var timer = setInterval(function countDown() {
                        var tempAct = new Date();
                        var heure = Math.floor(tempAct.getTime() / 1000);
                        var timeRemaining = {$date_fin} - heure;
                        var hoursRemaining = parseInt(timeRemaining / 3600); // conversion en heures
                        var minutesRemaining = parseInt((timeRemaining % 3600) / 60); // conversion en minutes
                        var secondsRemaining = parseInt((timeRemaining % 3600) % 60); // conversion en secondes
                        document.getElementById(`{$id}`).innerHTML = hoursRemaining + ' h : ' + minutesRemaining + ' m : ' + secondsRemaining + ' s ';
                        if (timeRemaining <= 0) {
                            document.getElementById(`{$id}`).innerHTML = "EXPIRE";
                        }
                    }, 1000); // répéte la fonction toutes les 1 seconde
            </script>
HTML;
    }

}
?>