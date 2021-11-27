<?php

    if(isset($_GET['connexion'])){

    }

    // Lors de l'inscription
    if(isset($_GET['email'])){

        // Cas où les deux mots de passes ne soient pas les mêmes
        if($_POST['password1'] != $_POST['password2'])
            header("location: compte.php?error=password");

        include_once("bdd.php");

        $insert = $bdd->prepare("INSERT INTO Clients(nom, prenom, email, motDePasse, vkey) VALUES(:nom, :prenom, :email, :motDePasse, :vkey)");

        // On 'crypte' le mot de passe afin de le sauvegarder dans la BDD
        $password = password_hash($_POST['password1'], PASSWORD_DEFAULT);

        // On génère une clé aleatoire
        $verifiedkey = md5(time());

        // On insère les données das la BDD
        $insert->execute(array(
            'nom' => $_GET['nom'],
            'prenom' => $_GET['prenom'],
            'email' => $_GET['email'],
            'motDePasse' => $password,
            'vkey' => $verifiedkey));

        $subject = "Email de vérification";
        $message = "<h3>Afin de pouvoir continuer vos achats sur notre site, veuilliez <a href='http://localhost:8888/ProjetFac/code/verify.php?vkey=$verifiedkey'>Valider votre compte</a></h3>";
        $headers = "From: baptiste.bronsin@outlook.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type:text/html; charset='UTF-8'\r\n";

        mail($_GET['email'], $subject, $message, $headers);
        header("location: compte.php?envoieMail");
    }

?>