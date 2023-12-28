<?php
include "../includes/functions.php";
if (!isLoggedIn()) {
	header('location: ../connexion.php');
} else if($_SESSION['user']['account_type'] != 'Entreprise') {
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
                <?php include "../includes/company_dashboard_menu.php" ?>
                <div class="dashboard-content col-lg-9 col-sm-12 col-xs-12 p-4 pb-5 bg-white">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-xs-12">
                            <a class="dashboard-stat" href="manage-jobs.php">
                                <div class="visual">
                                    <i class="fad fa-briefcase"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span><?= getJobsNumberById() ?></span>
                                    </div>
                                    <div class="desc">
                                        <?php if(getJobsNumberById() == 1) : ?>
                                            Offre
                                        <?php else : ?>
                                            Offres
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-xs-12">
                            <a class="dashboard-stat" href="manage-candidats.php">
                                <div class="visual">
                                    <i class="fad fa-users"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span><?= getEntrepriseCandidatsNumber() ?></span>
                                    </div>
                                    <div class="desc">
                                    <?php if(getEntrepriseCandidatsNumber() == 1) : ?>
                                            Candidat 
                                        <?php else : ?>
                                            Candidats 
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-xs-12">
                            <a class="dashboard-stat" href="../candidats.php">
                                <div class="visual">
                                    <i class="fad fa-file-alt"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span><?= getTotalCandidatsNumber() ?></span>
                                    </div>
                                    <div class="desc">
                                        <?php if(getTotalCandidatsNumber() == 1) : ?>
                                            Candidat inscrit 
                                        <?php else : ?>
                                            Candidats inscrits 
                                        <?php endif; ?>
                                    </div>
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