<?php
include "includes/functions.php";
if(isLoggedIn()) {
    header("Location: ".$website_url."index.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Connexion</title>
        <meta name="viewport" content="width=device-width, initial-" charset="utf-8" />
        <link href="<?= $website_url ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= $website_url ?>assets/css/style.css" rel="stylesheet">
        <link href="<?= $website_url ?>assets/font-awesome/all.css" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar main-nav form-nav">
            <div class="container">
                <a class="navbar-brand" href="<?= $website_url ?>">
                    Zero Chômage
                </a> 
                <a class="account-page-link" href="<?= $website_url ?>register.php">S'inscrire</a>
            </div>
        </nav>
        <div class="container">
            <div class="connexion-container">
                <div class="row">
                    <div class="col-xl-5 col-md-6 connexion-form"> 
                        <h5><i class="fad fa-user"></i>Connexion</h5>
                        <form method="POST" action="<?= $website_url ?>includes/functions.php" class="mb-3 login">
                            <div class="form-result" id="login_result"></div>
                            <div class="form-group mb-3">
                                <input type="email" id="email" class="form-control" name="email" placeholder="Email">
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" id="password" class="form-control" name="password" placeholder="Mot de passe">
                            </div>
                            <button id="submit" type="submit" name="login" class="btn btn-primary w-100">Connecter</button>
                        </form>
                        <span>Vous avez pas de compte? <a href="<?= $website_url ?>register.php">Inscrivez vous maintenant!</a></span>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?= $website_url ?>assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="<?= $website_url ?>assets/js/main.js" type="text/javascript"></script>
        <script src="<?= $website_url ?>assets/js/popper.min.js" type="text/javascript"></script>
        <script src="<?= $website_url ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
        
</body>
</html>