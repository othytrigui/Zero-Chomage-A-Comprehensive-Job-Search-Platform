<?php
include "../includes/functions.php";
if (!isLoggedIn()) {
	header('location: ../connexion.php');
} else if($_SESSION['user']['account_type'] != 'Candidat') {
    header('location: ../index.php');
}
$page = "Vos offres favorites";
?>
<!DOCTYPE html>
<html>
    <?php include "../includes/header.php" ?>
    <div class="main-content">
        <div class="container">
            <div class="section-title">
                <h1>Vos offres favorites</h1>
            </div>
            <div class="dashboard-container d-flex">
                <?php include "../includes/candidat_dashboard_menu.php" ?>
                <div class="dashboard-content col-lg-9 col-sm-12 col-xs-12 p-4 pb-5 bg-white">
                    <div class="dashboard-bookmarked">
                    <h4 class="bookmark-title"><?= getBookmarkedJobsNumber() ?> offres sauvegardeés</h4>
                        <div class="bookmark-area">
                            <?php getBookmarkedJobs() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "../includes/footer.php" ?>
</html>