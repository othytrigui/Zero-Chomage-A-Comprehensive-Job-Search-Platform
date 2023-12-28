<?php
include "../includes/functions.php";
if (!isLoggedIn()) {
	header('location: ../connexion.php');
} else if($_SESSION['user']['account_type'] != 'Entreprise') {
    header('location: ../index.php');
}
$page = "Gérer vos offres";
?>
<!DOCTYPE html>
<html>
    <?php include "../includes/header.php" ?>
    <div class="main-content">
        <div class="container">
            <div class="section-title">
                <h1>Gérer vos offres</h1>
            </div>
            <div class="dashboard-container d-flex">
                <?php include "../includes/company_dashboard_menu.php" ?>
                <div class="dashboard-content col-lg-9 col-sm-12 col-xs-12 p-4 pb-5 bg-white">
                    <div class="manage-job-container overflow-auto">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Titre de l'offre</th>
                                    <th>Poste</th>
                                    <th>Date limite</th>
                                    <th>Status</th>
                                    <th class="action">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php getJobsByEntreprise(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="dashboard_form_result">
                        <?php
                            if(isset($_SESSION['job_added_success'])) {
                                ?>
                                <script type="text/javascript">
                                    Swal.fire({
                                    title: 'Super!',
                                    text: '<?= $_SESSION["job_added_success"] ?>',
                                    icon: 'success',
                                    confirmButtonText: 'Ok'
                                })
                                </script>
                                <?php
                                unset($_SESSION["job_added_success"]);
                            }
                            if(isset($_SESSION['job_deleted'])) {
                                ?>
                                <script type="text/javascript">
                                    Swal.fire({
                                    title: 'Super!',
                                    text: '<?= $_SESSION["job_deleted"] ?>',
                                    icon: 'success',
                                    confirmButtonText: 'Ok'
                                })
                                </script>
                                <?php
                                unset($_SESSION["job_deleted"]);
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "../includes/footer.php" ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".job-items .status").each(function() {
                if($(this).text == "Active") {
                    $(this).addClass("active");
                }
            });
        });
    </script>
</html>