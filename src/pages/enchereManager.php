<?php
    $title = "Enchère manager";
    require_once(dirname(__DIR__)."/include/header.php");
?>

<body>

<?php
    require_once(__ROOT__.'/src/include/formEnchere.php');
    require_once(__ROOT__.'/src/include/listeEnchereManager.php');
    require_once(__ROOT__.'/src/include/formModifEnchere.php');
?> 

<?php require_once(__ROOT__.'/src/include/footerscript.php');?>

</body>
</html>