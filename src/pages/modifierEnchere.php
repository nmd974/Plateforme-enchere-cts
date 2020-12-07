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
    <?php //On recupere l'id du produit à modifier
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        };
    ?>
    <?php require_once(__ROOT__.'/src/include/formModifEnchere.php');?> 
    <?php require_once(__ROOT__.'/src/include/footerscript.php');?>
</body>
</html>