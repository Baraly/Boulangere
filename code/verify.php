<!doctype html>
<html lang="fr">
<head>
    <?php include_once("head/head.php"); ?>
    <title>Verify</title>
</head>
<body>
<?php

$error = "";

    if(isset($_GET['error']))
        $error = "<h3>Veuillez vérifier que les deux mots de passes soient bien les mêmes.</h3>";

    if(isset($_GET['email']) && isset($_GET['vkey']) && isset($_GET['mdpOublie'])){
        include_once("bdd.php");
        $request = $bdd->query("SELECT email, vkey FROM Clients WHERE email='".$_GET['email']."'");
        $donnees = $request->fetch();
        if($donnees['vkey'] == $_GET['vkey']){
            include_once("nav/nav.php");
            ?>
            <h2>Modification du mot de passe</h2>
                 <div class="centre account changeMdp">
                       <?php echo "<form action='comptePost.php?verifieMdpOublie=true&email=".$_GET['email']."' method='POST' class='box'>"; ?>
                            <input type="password" name="mdpNew1" placeholder="Le nouveau mot de passe" required>
                            <input type="password" name="mdpNew2" placeholder="Confirmez le nouveau mot de pass" required>
                            <input type="submit" value="Soumettre">
                       </form>
                 </div>
                 <center style="margin-top: -40px"><?= $error ?></center>
            <?php
        }
    }
    else if(isset($_GET['email']) && isset($_GET['vkey'])){
        include_once("bdd.php");
        $request = $bdd->query("SELECT email, vkey FROM Clients WHERE email='".$_GET['email']."'");
        $donnees = $request->fetch();
        if($donnees['vkey'] == $_GET['vkey']){
            $bdd->exec("UPDATE Clients SET compteVerifie = 1 WHERE email='".$_GET['email']."'");
            ?>
            <center style="font-size:30px; margin-top: 50px">Votre compte est désormais vérifié !</center>
            <?php
        }
        else{
            ?>
            <center style="font-size:30px; margin-top: 50px">Une erreur est survenue !</center>
            <?php
        }
    }
    else{
        ?>
        <center style="font-size:30px; margin-top: 50px">Une erreur est survenue !</center>
        <?php
    }
$bdd = null;
?>
</body>
</html>