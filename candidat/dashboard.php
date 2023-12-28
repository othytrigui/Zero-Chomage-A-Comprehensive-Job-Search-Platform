<?php
include "../includes/functions.php";
if (!isLoggedIn()) {
	header('location: ../connexion.php');
} else if($_SESSION['user']['account_type'] != 'Candidat') {
    header('location: ../index.php');
}
$page = "Tableau de bord";
?>
<!DOCTYPE html>
<html>
    <?php include "../includes/header.php" ?>
    <div class="main-content">
        <div class="container">
            <div class="section-title">
                <h1>Tableau de bord</h1>
            </div>
            <div class="dashboard-container d-flex">
                <?php include "../includes/candidat_dashboard_menu.php" ?>
                <div class="dashboard-content col-lg-9 col-sm-12 col-xs-12 p-4 pb-5 bg-white">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-xs-12">
                            <a class="dashboard-stat" href="candidatures.php">
                                <div class="visual">
                                    <i class="fad fa-briefcase"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span><?= getCandidaturesNumberByCandidat() ?></span>
                                    </div>
                                    <div class="desc">
                                        <?php if(getCandidaturesNumberByCandidat() == 1) : ?>
                                            Candidature
                                        <?php else : ?>
                                            Candidatures
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-xs-12">
                            <a class="dashboard-stat" href="bookmarked.php">
                                <div class="visual">
                                    <i class="fad fa-bookmark"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span><?= getBookmarkedJobsNumber() ?></span>
                                    </div>
                                    <div class="desc">
                                        <?php if(getBookmarkedJobsNumber() == 1) : ?>
                                            Offre sauvegardeé
                                        <?php else : ?>
                                            Offres sauvegardeés
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-xs-12">
                            <a class="dashboard-stat" href="../jobs.php">
                                <div class="visual">
                                    <i class="fad fa-clipboard-check"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span><?= getTotalJobsNumber() ?></span>
                                    </div>
                                    <div class="desc">Offres publiées</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "../includes/footer.php" ?>
</html>