<?php
    $title = "Enchère manager";
    require_once(dirname(__DIR__)."/include/header.php");
?>
<?php
    if(!$_SESSION['adminLogged']){
        header('Location: ./home.php');
    }
?>
<body>
<?php require_once(__ROOT__.'/src/include/formEnchere.php');?> 
<?php require_once(__ROOT__.'/src/include/footerscript.php');?>
</body>
</html>