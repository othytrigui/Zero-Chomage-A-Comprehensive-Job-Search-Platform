<?php
include "includes/functions.php";
$page = "Accueil";
?>
<!DOCTYPE html>
<html>
    <?php include "includes/header.php" ?>
    <div class="home-page">
        <div class="container">
            <div class="home-banner">
                <h4 class="num_jobs_home"><span><?= getTotalJobsNumber() ?></span> offres d'emploi publiées</h4>
                <p>Créez un compte gratuit pour trouver des milliers d'emplois et d'opportunités de carrière autour de vous!</p>
                <a href="jobs.php" class="button">Consultez nos offres</a>
            </div>
            <form action="jobs.php" method="GET" class="row home-filter">
                    <input type="text" name="keywords" placeholder="Mots clés séparés par virgules" class="form-control">
                    <select class="selectpicker" name="categorie">
                        <option value="">Categorie</option>
                        <?php getCategoriesList() ?>
                    </select>
                    <select class="selectpicker" data-live-search="true" name="localite">
                        <option value="">Localité</option>
                        <?php getCitiesList() ?>
                    </select>
                    <button class="search-btn"><i class="far fa-search"></i>Rechercher</button>
            </form>
        </div>
    </div>
    <!-- Register section -->
    <?php if(!isLoggedIn()) : ?>
        <div class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="call-to-action-box candidate-box">
                            <div class="icon">
                                <img src="assets/images/candidat-register.png" alt="">
                            </div>
                            <span>Êtes-vous un?</span>
                            <h3>Candidat?</h3>
                            <a href="register.php">S'inscrire maintenant <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="call-to-action-box employer-register">
                            <div class="icon">
                                <img src="assets/images/employe-register.png" alt="">
                            </div>
                            <span>Êtes-vous une?</span>
                            <h3>Entreprise?</h3>
                            <a href="register.php">S'inscrire maintenant <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php include "includes/footer.php" ?>
</html>