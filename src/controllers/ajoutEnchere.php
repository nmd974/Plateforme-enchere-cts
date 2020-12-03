<?php  
    require_once(__ROOT__.'/src/class/AjoutEnchere.php');
    require_once(__ROOT__.'/src/controllers/imageControl.php');
?>

<?php 
    function validationAjout($data, $image_upload):string
    {
    //Faire le contrôle des images
        if($image_upload['image_upload']['size'] !== 0){
            $dir_exist = verificationDossierImg();
            if($dir_exist){
                $validationImage = controleImage($image_upload);
                if(!$validationImage[0]){//Si le contrôle du type, taille est ok alors on poursuit
                    $obj = new AjoutEnchere (
                        $data['intitule'],
                        $data['prix_depart'],
                        $data['duree_enchere'],
                        $validationImage[1],//Correspond au nom de l'image lors de la validation de la fonction imagecontrol
                        $data['prix_clic'],
                        $data['augmentation_prix'],
                        $data['augmentation_duree']
                    );
                    return '<div class="alert alert-success"> Le produit a bien été ajouté !</div>';
                }else{
                    return $validationImage[1];
                };
            }
        }else{
            $obj = new AjoutEnchere (
                $data['intitule'],
                $data['prix_depart'],
                $data['duree_enchere'],
                null,//Correspond à rien si pas d'image ajoutee
                $data['prix_clic'],
                $data['augmentation_prix'],
                $data['augmentation_duree']
            );
            return '<div class="alert alert-success"> Le produit a bien été ajouté !</div>';
        }
    }

    function verificationDossierImg():bool
    {
        //On ajoute le dossier image si le dossier n'existe pas
        $dir = __ROOT__."/img";
        if (!is_dir($dir)){
            mkdir($dir, 0777, true);
        }
        return is_dir($dir);
    }

?>