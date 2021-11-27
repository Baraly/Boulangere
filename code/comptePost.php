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

        $to =  $_GET['email'];
        $subject = "Email de vérification";
        $message = "<a href='http://localhost:8888/ProjetFac/code/verify.php?vkey=$verifiedkey'>Valider mon compte</a>";
        $headers = "From: baptiste.bronsin@outlook.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";

        if(mail($to, $subject, $message))
            echo "<h3>L'email a bien été envoyé !</h3>";
        else
            echo "<h3>L'email n'a pas été envoyé !</h3>";
    }

?>