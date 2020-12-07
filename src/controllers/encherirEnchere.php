<?php 
session_start();
function encherir($id)
    {
        $enregistrementData = json_decode(file_get_contents(__ROOT__.'/src/data/data.json'), true); //On recupere le contenu de data.json
        foreach($enregistrementData as $key => $items){
            if ($items['id'] == $id){
                $enregistrementData[$key]['prix_depart'] = $enregistrementData[$key]['prix_depart'] + $enregistrementData[$key]['augmentation_prix'];
                $enregistrementData[$key]['date_fin'] = $enregistrementData[$key]['date_fin'] + $enregistrementData[$key]['augmentation_duree'];
                $prix_ajoute = $enregistrementData[$key]['prix_clic'] + $enregistrementData[$key]['augmentation_prix'];
            }
        }
        file_put_contents(__ROOT__.'/src/data/data.json', json_encode($enregistrementData));

        $data = json_decode(file_get_contents(__ROOT__.'/src/data/users.json'), true); //On recupere le contenu des users
        var_dump($data);
        foreach($data as $key => $items){
            if ($items['id'] == $_SESSION['id']){
                $data[$key]['solde'] = $prix_ajoute;
            }
        }
        file_put_contents(__ROOT__.'/src/data/users.json', json_encode($data));
    }
?>