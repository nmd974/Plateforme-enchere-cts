<?php 

function encherir($id)
    {
        $poursuite = true;
        $data = json_decode(file_get_contents(__ROOT__.'/src/data/users.json'), true); //On recupere le contenu des users
        $enregistrementData = json_decode(file_get_contents(__ROOT__.'/src/data/data.json'), true); //On recupere le contenu de data.json
        foreach($enregistrementData as $key => $items){
            if ($items['id'] == $id){
                $enregistrementData[$key]['prix_depart'] = $enregistrementData[$key]['prix_depart'] + $enregistrementData[$key]['augmentation_prix'];
                $enregistrementData[$key]['date_fin'] = $enregistrementData[$key]['date_fin'] + $enregistrementData[$key]['augmentation_duree'];
                $prix_ajoute = $enregistrementData[$key]['prix_clic'] + $enregistrementData[$key]['augmentation_prix'];
            }
        }
        foreach($data as $key => $items){
            if ($items['id'] == $_SESSION['id']){
                $resultat = (float)$data[$key]['solde'] -  $prix_ajoute;
                if($data[$key]['solde'] == 0){
                    return '<div class="alert alert-success">Votre solde n\'est pas suffisant !</div>';
                    $poursuite = false;
                }
                if($resultat < 0 && $poursuite){
                    return '<div class="alert alert-success">Votre solde n\'est pas suffisant !</div>';
                    $poursuite = false;
                }else{
                    (float)$data[$key]['solde'] = (float)$data[$key]['solde'] - $prix_ajoute;
                }
            }
        }
        if($poursuite){
            file_put_contents(__ROOT__.'/src/data/users.json', json_encode($data));
            file_put_contents(__ROOT__.'/src/data/data.json', json_encode($enregistrementData));
            header('Location: ./home.php?page=1#'.$id);
        }
    }
?>