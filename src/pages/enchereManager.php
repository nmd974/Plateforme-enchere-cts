<?php
    $title = "Enchère manager";
    require_once(dirname(__DIR__)."/include/header.php");
?>
<?php
    if(!$_SESSION['adminLogged']){
        header('Location: ./home.php?page=1');
    }
?>
<body>
<?php require_once(__ROOT__.'/src/include/listeEnchereManager.php');?> 
<?php require_once(__ROOT__.'/src/include/footerscript.php');?>
</body>
</html>