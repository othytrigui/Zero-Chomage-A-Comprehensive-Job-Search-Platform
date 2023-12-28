<?php
include "../includes/functions.php";
if (!isLoggedIn()) {
	header('location: ../connexion.php');
} else if($_SESSION['user']['account_type'] != 'Entreprise') {
    header('location: ../index.php');
}
$page = "Gérer vos candidats";
?>
<!DOCTYPE html>
<html>
    <?php include "../includes/header.php" ?>
    <div class="main-content">
        <div class="container">
            <div class="section-title">
                <h1>Gérer vos candidats</h1>
            </div>
            <div class="dashboard-container d-flex">
                <?php include "../includes/company_dashboard_menu.php" ?>
                <div class="dashboard-content col-lg-9 col-sm-12 col-xs-12 p-4 pb-5 bg-white">
                    <div class="manage-candidate-container overflow-auto">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Candidat</th>
                                    <th>Titre de l'offre</th>
                                    <th class="action">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php getEntrepriseCandidats(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "../includes/footer.php" ?>
</html>