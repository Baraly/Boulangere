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

        envoyerMailValidation($_SESSION['prenom'], $_SESSION['email'], $verifiedkey);
        header("location: compte.php");
    }
    else if(isset($_GET['renvoieEmail'])){
        $request = $bdd->query("SELECT email, vkey FROM Clients WHERE email='".$_SESSION['email']."'");
        $donnees = $request->fetch();
        envoyerMailValidation($_SESSION['prenom'], $_SESSION['email'], $donnees['vkey']);
        header("location: compte.php");
    }
    else if(isset($_GET['changeMdp'])){
        $request = $bdd->query("SELECT email, motDePasse FROM Clients WHERE email='".$_SESSION['email']."'");
        $donnees = $request->fetch();
        if(password_verify($_POST['mdpActuel'], $donnees['motDePasse'])){
            if($_POST['mdpNew1'] == $_POST['mdpNew2']){
                $password = password_hash($_POST['mdpNew1'], PASSWORD_DEFAULT);
                $bdd->exec("UPDATE Clients SET motDePasse='".$password."' WHERE email='".$_SESSION['email']."'");
                header("location: compte.php?changeMdp=&succes=true");
            }
            else
                header("location: compte.php?changeMdp=&error=mdpDiff");
        }
        else
            header("location: compte.php?changeMdp=&error=mdpActuel");
    }
    else if(isset($_GET['suppCompte'])){
        $request = $bdd->query("SELECT idCommande FROM Commandes WHERE email='".$_SESSION['email']."'");
        while($donnees = $request->fetch()){
            $bdd->exec("DELETE FROM LignesCommandes WHERE idCommande='".$donnees['idCommande']."'");
        }
        $bdd->exec("DELETE FROM Commandes WHERE email='".$_SESSION['email']."'");
        $bdd->exec("DELETE FROM Clients WHERE email='".$_SESSION['email']."'");
        session_destroy();
        header("location: compte.php?aurevoir");
    }
    else if(isset($_GET['mdpOublie'])){
        $request = $bdd->query("SELECT COUNT(*) AS estPresent FROM Clients WHERE email='".$_POST['email']."'");
        $donnees = $request->fetch();
        echo $donnees['estPresent'];
        if($donnees['estPresent'] == 0) {
            header("location: compte.php?mdpOublie=true&error=mdpOublie");
        }
        else {
            $request = $bdd->query("SELECT prenom, email, vkey FROM Clients WHERE email='" . $_POST['email'] . "'");
            $donnees = $request->fetch();
            $subject = "Réinitialisation du mot de passe";
            $message = "<h2>Bonjour " . $donnees['prenom'] . ",</h2>";
            $message .= "<h3>Si vous souhaitez réinitialiser votre mot de passe, veuillez cliquer sur ce <a href='http://Baraly.fr/code/verify.php?email=" . $_POST['email'] . "&vkey=" . $donnees['vkey'] . "&mdpOublie'>lien</a>.</h3>";
            $message .= "<p>Cordialement, Baptiste</p>";
            $headers = "From: NePasRepondre@baraly.fr\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type:text/html; charset='UTF-8'\r\n";

            mail($_POST['email'], $subject, $message, $headers);

            header("location: compte.php");
        }
    }
    else if(isset($_GET['verifieMdpOublie'])){
        if($_GET['mdpNew1'] == $_GET['mdpNew2']){
            $password = password_hash($_GET['mdpNew1'], PASSWORD_DEFAULT);
            $bdd->exec("UPDATE Clients SET motDePasse='".$password."' WHERE email='".$_GET['email']."'");
            $request = $bdd->query("SELECT prenom FROM Clients WHERE email='".$_GET['email']."'");
            $donnees = $request->fetch();
            $_SESSION['email'] = $_GET['email'];
            $_SESSION['prenom'] = $donnees['prenom'];
            header("location: compte.php");
        }
        else{
            header("location: verify.php?error");
        }
    }

    function envoyerMailValidation($prenom, $email, $vkey){
        $subject = "Email de vérification";
        $message = "<h2>Bonjour $prenom,</h2>";
        $message .= "<h3>Nous sommes heureux de vous compter parmis nous.<br>Afin de pouvoir continuer vos achats sur notre site, veuillez <a href='http://Baraly.fr/code/verify.php?email=$email&vkey=$vkey'>valider votre compte</a>.</h3>";
        $message .= "<p>Cordialement, Baptiste</p>";
        $headers = "From: NePasRepondre@baraly.fr\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type:text/html; charset='UTF-8'\r\n";

        mail($email, $subject, $message, $headers);
    }

?>