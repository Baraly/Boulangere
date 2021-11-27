<?php

session_start();

include_once("bdd.php");

    // Lors de la connexion
    if(isset($_GET['connexion'])){
        $request = $bdd->query("SELECT email, motDePasse, prenom FROM Clients WHERE email='".$_POST['email']."'");
        $donnees = $request->fetch();
        if(password_verify($_POST['password'], $donnees['motDePasse'])){
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['prenom'] = $donnees['prenom'];
            header("location: compte.php");
        }
        else{
            header("location: compte.php?error=connexion");
        }
    }

    // Lors de l'inscription
    if(isset($_GET['email'])){

        // Cas où les deux mots de passes ne soient pas les mêmes
        if($_POST['password1'] != $_POST['password2'])
            header("location: compte.php?error=password");

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

        $_SESSION['email'] = $_GET['email'];
        $_SESSION['prenom'] = $_GET['prenom'];

        envoyerMailValidation($_SESSION['email'], $verifiedkey);
        header("location: compte.php");
    }
    else if(isset($_GET['renvoieEmail'])){
        $request = $bdd->query("SELECT email, vkey FROM Clients WHERE email='".$_SESSION['email']."'");
        $donnees = $request->fetch();
        envoyerMailValidation($_SESSION['email'], $donnees['vkey']);
        header("location: compte.php");
    }

    function envoyerMailValidation($email, $vkey){
        $subject = "Email de vérification";
        $message = "<h3>Afin de pouvoir continuer vos achats sur notre site, veuilliez <a href='http://Baraly.fr/code/verify.php?email=$email&vkey=$vkey'>valider votre compte</a></h3>";
        $headers = "From: NePasRepondre@baraly.fr\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type:text/html; charset='UTF-8'\r\n";

        mail($email, $subject, $message, $headers);
    }

?>