<?php
    require_once(__ROOT__.'/src/controllers/imageControl.php');
    //Fonction de modification d'une enchère
    //Verifier d'abord si l'image a changé
    //Si elle n'a pas change on ne verifie pas l'image sinon on modifie l'image
    function modificationEnchere($content, $image, $nomOldImage):string
    {
        $inputsRequired=["intitule", "prix_depart","duree_enchere","prix_clic","augmentation_prix","augmentation_duree"];
        $inputsNumbers = ["prix_depart","duree_enchere","prix_clic","augmentation_prix","augmentation_duree"];
        $validationForms = false;
        foreach($inputsRequired as $input){
            if($data["$input"] == ""){
                $validationForms = false;
            }else{
                $validationForms = true;
            }
        };
        foreach($inputsNumbers as $input){
            if($data["$input"] <= 0){
                $validationForms = false;
            }else{
                $validationForms = true;
            }
        };
        if($validationForms){
            if($image['image_upload']['size'] !== 0)//S'il y a un nom d'image c'est que l'utilisateur souhaite changer l'image et a ajouté une nouvelle image
            {
                //On supprime l'ancienne image attribuée si ce n'est pas egal à null
                if($nomOldImage !== ""){
                    $oldFilename = __ROOT__."/img/" . $nomOldImage;
                    unlink($oldFilename);
                }
                //On lance cette fonction pour pouvoir gérer l'image ajoutée
                $image_upload = controleImage($image);
    
                $enregistrementData = json_decode(file_get_contents(__ROOT__.'/src/data/data.json'), true); //On recupere le contenu de data.json
                foreach($enregistrementData as $key => $items){
                    if ($items['id'] == $content['id']){
                        $enregistrementData[$key]['intitule'] = $content['intitule'];
                        $enregistrementData[$key]['prix_depart'] = $content['prix_depart'];
                        $enregistrementData[$key]['image_nom'] = $image_upload[1];
                        $enregistrementData[$key]['duree_enchere'] = $content['duree_enchere'];
                        $enregistrementData[$key]['prix_clic'] = $content['prix_clic'];
                        $enregistrementData[$key]['augmentation_prix'] = $content['augmentation_prix'];
                        $enregistrementData[$key]['augmentation_duree'] = $content['augmentation_duree'];
                    }
                }
                file_put_contents(__ROOT__.'/src/data/data.json', json_encode($enregistrementData));
                return 
                '<div class="col-12 d-flex justify-content-center">
                <div class="alert alert-success">Le produit a bien été modifié !</div>
                </div>'; 
            }
            else
            {
                $enregistrementData = json_decode(file_get_contents(__ROOT__.'/src/data/data.json'), true); //On recupere le contenu de data.json
                foreach($enregistrementData as $key => $items){
                    if ($items['id'] == $content['id']){
                        $enregistrementData[$key]['intitule'] = $content['intitule'];
                        $enregistrementData[$key]['prix_depart'] = $content['prix_depart'];
                        $enregistrementData[$key]['duree_enchere'] = $content['duree_enchere'];
                        $enregistrementData[$key]['prix_clic'] = $content['prix_clic'];
                        $enregistrementData[$key]['augmentation_prix'] = $content['augmentation_prix'];
                        $enregistrementData[$key]['augmentation_duree'] = $content['augmentation_duree'];
                    }
                }
                file_put_contents(__ROOT__.'/src/data/data.json', json_encode($enregistrementData));
                        return 
                        '<div class="col-12 d-flex justify-content-center">
                        <div class="alert alert-success">Le produit a bien été modifié !</div>
                        </div>';  
                }
        }
        
    }
?>