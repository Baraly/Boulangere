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
            $error = "<h3>Votre adresse email ou votre mot de passe est incorrect.</h3>";
        if(isset($_GET['deconnexion'])) {
            session_destroy();
            header("location: compte.php");
        }

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
                        <label>Créez un mot  de passe : <input type="password" name="password1"></label><br>
                        <label>Confirmez le mot de passe : <input type="password" name="password2"></label>
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

            // Cas où le compte n'a pas encore été validé
            if($donnees['email'] == $_SESSION['email'] && $donnees['compteVerifie'] == 0){
                ?>
                <center>
                    <i class='bx bx-mail-send' style="font-size: 50px"></i><br>
                    Veuilliez valider votre compte en cliquant sur le lien que vous avez reçu par mail.<br>
                    <a href="comptePost.php?renvoieEmail">Je n'ai pas reçu de mail</a>
                </center>
                <?php
            }
            else if(isset($_GET['changeMdp'])){
                if(isset($_GET['error']) && $_GET['error']=="mdpActuel")
                    $error = "Vous n'avez pas saisi correctement votre mot de passe actuel !";
                if(isset($_GET['error']) && $_GET['error']=="mdpDiff")
                    $error = "Vous n'avez pas saisi correctement votre nouveau mot de passe !";
                if(isset($_GET['succes']))
                    $error = "Votre mot de passe à bien été mis à jour !";
                ?>
                <h2>Modification du mot de passe</h2>
                <a href="compte.php" class="right button">Retour</a>
                <div class="centre account changeMdp">
                    <form action="comptePost.php?changeMdp" method="POST">
                        <label>Votre mot de passe actuel : <input type="password" name="mdpActuel" required></label><br>
                        <label>Le nouveau mot de passe : <input type="password" name="mdpNew1" required></label><br>
                        <label>Confirmez le nouveau mot de passe : <input type="password" name="mdpNew2" required></label>
                        <input type="submit" class="cache">
                    </form>
                </div>
                <center><?= $error ?></center>
                <?php
            }
            else if(isset($_GET['infos'])){

            }
            else if(isset($_GET['suppCompte'])){
                ?>
                <h2>Suppession du compte</h2>
                <div class="centre account">
                    <h4 class="top">Voulez-vous vraiment supprimer votre compte ?</h4>
                    <p>En supprimant votre compte, vos commandes seront annulées et votre panier sera effacé.<br>
                    Vous pourrez toute fois vous réinscrire plus tard sur notre site.</p>
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="compte.php" class="button">Annuler</a>
                        </div>
                        <div class="col-sm-6">
                            <a href="comptePost.php?suppCompte" class="button supprimer">Supprimer</a>
                        </div>
                    </div>
                    <p></p>
                </div>
                <?php
            }
            else{
                ?>
                <h2>Mon compte</h2>
                <div class="listeActionArticle right">
                    <ul>
                        <li><a href="compte.php?deconnexion">Déconnexion</a></li>
                        <li><a href="compte.php?changeMdp">Modifier mon mot de passe</a></li>
                        <li><a href="compte.php?infos">Modifier mes informations</a></li>
                        <li><a href="compte.php?suppCompte">Supprimer mon compte</a></li>
                    </ul>
                </div>
                <h3>Bonjour <?= $_SESSION['prenom'] ?></h3><br>
                <h5 class="underline">Récapitulatif :</h5>
                <?php
                    $request = $bdd->query("SELECT COUNT(*) AS nbCommande FROM Commandes WHERE email='".$_SESSION['email']."' and etat='validee'");
                    $donnees = $request->fetch();
                    if($donnees['nbCommande'] == 0){
                        echo "<p>Vous n'avez aucune commande en cours et";
                    }
                    else if($donnees['nbCommande'] == 1){
                        echo "<p>Vous avez 1 commande en cours et";
                    }
                    else{
                        echo "<p>Vous avez ".$donnees['nbCommande']." commandes en cours et";
                    }

                    $request = $bdd->query("SELECT COUNT(*) AS nbCommande FROM Commandes WHERE email='".$_SESSION['email']."' and etat='enCours'");
                    $donnees = $request->fetch();
                    if($donnees['nbCommande'] == 0){
                        echo " aucun produit dans votre panier</p>";
                        echo "<p>Pourquoi ne pas commencer à le remplir dès maintenant ? ^^<br>
                        Rendez-vous vite sur <a href='index.php'>la page d'accueil</a> afin de découvrir nos promotions !</p>";
                    }
                    else if($donnees['nbCommande'] == 1){
                        echo " 1 produit dans votre panier</p>";
                    }
                    else{
                        echo " ".$donnees['nbCommande']." produits dans votre panier</p>";
                    }
                ?>

                <?php
            }
        }
        else{
            ?>
            <h2>Mon compte</h2>
            <div class="row account">
                <div class="col-sm-5 centre">
                    <h4 class="top">Connexion</h4>
                    <form action="comptePost.php?connexion" method="post">
                        <label>Email : <input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required/></label><br>
                        <label>Mot de passe : <input type="password" name="password" required/></label>
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
            if(isset($_GET['aurevoir'])){
                echo "<center><h3>Nous espérons vous revoir très bientôt.</h3></center>";
            }
        }

    ?>


</body>
</html>