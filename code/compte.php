<?php session_start(); ?>
<!doctype html>
<html lang="fr">
<head>
    <?php include_once("head/head.php"); ?>
    <link rel="stylesheet" href="style/styleNav.css">
    <link rel="stylesheet" href="style/mainStyle.css">
    <title>Mon compte</title>
    <script src="nav/nav.js"></script>
</head>
<body>
    <?php include_once("nav/nav.php"); ?>

    <?php
    $error = "";
    include_once("bdd.php");

        if(isset($_GET['error']) && $_GET['error'] == "password")
            $error = "<h3>Veuilliez vérifier que les deux mots de passes soient bien les mêmes.</h3>";
        if(isset($_GET['error']) && $_GET['error'] == "email")
            $error = "<h3>Cette adresse email est déjà utilisée.</h3>";
        if(isset($_GET['error']) && $_GET['error'] == "connexion")
            $error = "<h3>Votre adresse email ou votre mot de passe est incorrect</h3>";

        if(isset($_GET['inscription'])){
            $request = $bdd->query("SELECT email FROM Clients");
            while($donnees = $request->fetch()){
                if($_POST['email'] == $donnees['email'])
                    header('location: compte.php?error=email');
            }
            if($error == ""){
                ?>
                <h2>Création de compte</h2>
                <div class="account oneForm">
                    <?php $form = "comptePost.php?nom=".$_POST['firstname']."&prenom=".$_POST['surname']."&email=".$_POST['email'] ?>
                    <form action="<?= $form ?>" method="POST">
                        <label>Créer un mot  de passe : <input type="password" name="password1"></label><br>
                        <label>Confirmer le mot de passe : <input type="password" name="password2"></label>
                        <input type="submit" class="cache">
                    </form>
                </div>
                <center><?= $error ?></center>
                <?php
            }
        }
        else if(!empty($_SESSION['email'])){
            $request = $bdd->query("SELECT email, compteVerifie FROM Clients WHERE email='".$_SESSION['email']."'");
            $donnees = $request->fetch();
            if($donnees['email'] == $_SESSION['email'] && $donnees['compteVerifie'] == 0){
                ?>
                <center>
                    <i class='bx bx-mail-send' style="font-size: 50px"></i><br>
                    Veuilliez valider votre compte en cliquant sur le lien que vous avez reçu par mail.<br>
                    <a href="comptePost.php?renvoieEmail">Je n'ai pas reçu de mail</a>
                </center>
                <?php
            }
            else{
                ?>
                <h2>Mon compte</h2>
                <h5>Bonjour <?= $_SESSION['prenom'] ?></h5>
                <?php
            }
        }
        else{
            session_destroy();
            ?>
            <h2>Mon compte</h2>
            <div class="row account">
                <div class="col-sm-5 centre">
                    <h4 class="top">Connexion</h4>
                    <form action="comptePost.php?connexion" method="post">
                        <label>Email : <input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required/></label><br>
                        <label>Password : <input type="password" name="password" required/></label>
                        <input type="submit" class="cache"/>
                    </form>
                </div>
                <div class="col-sm-2">
                    <span class="separation"></span>
                </div>
                <div class="col-sm-5 centre">
                    <h4 class="top">Inscription</h4>
                    <form action="compte.php?inscription" method="post">
                        <label>Nom : <input type="text" name="firstname" required/></label><br>
                        <label>Prénom : <input type="text" name="surname" required/></label><br>
                        <label>Email : <input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required/></label>
                        <input type="submit" class="cache"/>
                    </form>
                </div>
            </div>
            <center><?= $error?></center>
            <?php
        }

    ?>


</body>
</html>