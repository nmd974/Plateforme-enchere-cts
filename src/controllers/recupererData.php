<?php
    //Fonction qui va recuperer le contenu du fichier data.json
    function recupererData()
    {
        $data = json_decode(file_get_contents(__ROOT__.'/src/data/data.json'), true);
        if($data){
            return $data;
        }else{
            return null;
        }

    }
        //Fonction qui va recuperer le contenu du fichier user.json
    function recupererUser()
    {
        $data = json_decode(file_get_contents(__ROOT__.'/src/data/users.json'), true);
        if($data){
            return $data;
        }else{
            return null;
        }

    }

?>