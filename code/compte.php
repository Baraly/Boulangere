<!doctype html>
<html lang="fr">
<head>
    <?php include_once("head/head.php"); ?>
    <link rel="stylesheet" href="style/styleNav.css">
    <link rel="stylesheet" href="style/mainStyle.css">
    <script src="nav/nav.js"></script>
</head>
<body>
    <?php include_once("nav/nav.php"); ?>
    <h2>Mon compte</h2>
    <div class="row account">
        <div class="col-sm-6 centre">
            <h4 class="top">Connexion</h4>
            <form action="comptePost.php?connexion" method="post">
                <label>Email : <input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"/></label><br>
                <label>Password : <input type="password" name="password"/></label>
                <input type="submit" class="cache"/>
            </form>
        </div>
        <div class="col-sm-6 centre">
            <h4 class="top">Inscription</h4>
            <form action="comptePost.php?inscription" method="post">
                <label>Nom : <input type="text" name="firstname"/></label><br>
                <label>Prénom : <input type="text" name="surname"/></label><br>
                <label>Email : <input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"/></label>
                <input type="submit" class="cache"/>
            </form>
        </div>
    </div>
</body>
</html>