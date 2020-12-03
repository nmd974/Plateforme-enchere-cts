<?php
    //Ici on va calculer le nombre de page qu'il y a pour un max de 10 par pages
    function pagination($encheres):int
    {
        if(!$encheres){
            return 0;
        }else{
            return $nb_elements = ceil(count($encheres)/10);
        }
        
    }
?>