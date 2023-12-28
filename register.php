<?php
include "includes/functions.php";
if(isLoggedIn()) {
    header("Location: ".$website_url."index.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Inscription</title>
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
                <a class="account-page-link" href="<?= $website_url ?>connexion.php">Se connecter</a>
            </div>
        </nav>
        <div class="container">
            <div class="connexion-container">
                <div class="row">
                    <div class="col-xl-5 col-sm-6 connexion-form"> 
                        <h5><i class="far fa-edit"></i>S'inscrire</h5>
                        <form method="POST" action="<?= $website_url ?>includes/functions.php" class="mb-3 register">  
                            <div class="form-result" id="register_result"></div>
                            <div class="form-group mb-3 account-type">
                                <input type="radio" class="btn-check btn btn-light" name="acc_type" value="Candidat" id="candidat" checked>
                                <label class="btn btn-secondary" for="candidat">Candidat</label>
                                <input type="radio" class="btn-check btn btn-light" name="acc_type" value="Entreprise" id="entreprise">
                                <label class="btn btn-secondary" for="entreprise">Entreprise</label>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" id="email" class="form-control" name="email" placeholder="Email">
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" id="password" class="form-control" name="password" placeholder="Mot de passe">
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" id="password2" class="form-control" name="password2" placeholder="Confirmer mot de passe">
                            </div>
                            <button type="submit" id="submit" name="submit" class="btn btn-primary w-100">S'inscrire</button>
                        </form>
                        <span>Vous avez deja un compte? <a href="<?= $website_url ?>connexion.php">Connectez vous maintenant!</a></span>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?= $website_url ?>assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="<?= $website_url ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?= $website_url ?>assets/js/main.js" type="text/javascript"></script>
        <script src="<?= $website_url ?>assets/js/popper.min.js" type="text/javascript"></script>  
        
</body>
</html>