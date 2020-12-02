<?php
    //Fonction de desactivation d'une enchère
    function desactiverEnchere($id):string
    {
        $enregistrementData = json_decode(file_get_contents(__ROOT__.'/data/data.json'), true); //On recupere le contenu de data.json
        foreach($enregistrementData as $key => $items){
            if ($items['id'] == $id){
                $enregistrementData[$key]['active_enchere'] = 'Inactif';
            }
        }
        file_put_contents(__ROOT__.'/data/data.json', json_encode($enregistrementData));//On ecrase le tout avec les nouvelles données
        return '<div class="alert alert-success"> Le produit a bien été desactivé</div>';
    }

    //Fonction d'activation d'une enchère
    function activerEnchere($id):string
    {
        $enregistrementData = json_decode(file_get_contents(__ROOT__.'/data/data.json'), true); //On recupere le contenu de data.json
        foreach($enregistrementData as $key => $items){
            if ($items['id'] == $id){
                //On donne l'etat actif
                $enregistrementData[$key]['active_enchere'] = 'Actif';
                //On donne une nouvelle date de fin selon l'heure specifiée du time zone
                date_default_timezone_set("Indian/Reunion");//Time zone defini à la reunion
                $enregistrementData[$key]['date_fin'] = mktime(date("H")+ $enregistrementData[$key]['duree_enchere'], date("i"), date("s"), date("m"), date("d"), date("Y"));
            }
        }
        file_put_contents(__ROOT__.'/data/data.json', json_encode($enregistrementData));//On ecrase le tout avec les nouvelles données
        return '<div class="alert alert-success"> Le produit a bien été activé</div>';
    }
?>