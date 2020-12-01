<?php  
    require_once(__ROOT__.'/class/AjoutEnchere.php');
    require_once(__ROOT__.'/controllers/imageControl.php');
?>

<?php 
    function validationAjout($data, $image_upload):string
    {
    //Faire le contrôle des images
        if($image_upload['name'] !== ""){
            $validationImage = controleImage($image_upload);
        }
        if($validationImage){//Si le contrôle du type, taille est ok alors on poursuit
            $obj = new AjoutEnchere (
                $data['intitule'],
                $data['prix_depart'],
                $data['duree_enchere'],
                $validationImage,
                $data['prix_clic'],
                $data['augmentation_prix'],
                $data['augmentation_duree']
            );
            return '<div class="alert alert-success"> Le produit a bien été ajouté !</div>';
        }
    }

?>