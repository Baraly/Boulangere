<!doctype html>
<html lang="fr">
<head>
    <?php include_once("head/head.php"); ?>
</head>
<body>
<?php

    if(isset($_GET['email']) && isset($_GET['vkey'])){
        include_once("bdd.php");
        $request = $bdd->query("SELECT email, vkey FROM Clients WHERE email='".$_GET['email']."'");
        $donnees = $request->fetch();
        if($donnees['vkey'] == $_GET['vkey']){
            $bdd->exec("UPDATE Clients SET compteVerifie = 1 WHERE email='".$_GET['email']."'");
            ?>
            <center>Votre compte est désormais vérifié !</center>
            <?php
        }
        else{
            ?>
            <center>Une erreur est survenue !</center>
            <?php
        }
    }
    else{
        ?>
        <center>Une erreur est survenue !</center>
        <?php
    }
?>
</body>
</html>