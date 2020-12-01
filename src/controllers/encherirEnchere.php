<?php 
function encherir($id)
    {
        $enregistrementData = json_decode(file_get_contents(__ROOT__.'/src/data/data.json'), true); //On recupere le contenu de data.json
        foreach($enregistrementData as $key => $items){
            if ($items['id'] == $id){
                $enregistrementData[$key]['prix_depart'] = $enregistrementData[$key]['prix_depart'] + $enregistrementData[$key]['augmentation_prix'];
                $enregistrementData[$key]['date_fin'] = $enregistrementData[$key]['date_fin'] + $enregistrementData[$key]['augmentation_duree'];
            }
        }
        file_put_contents(__ROOT__.'/src/data/data.json', json_encode($enregistrementData));
    }
?>