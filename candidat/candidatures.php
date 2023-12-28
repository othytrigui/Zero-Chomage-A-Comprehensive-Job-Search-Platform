<?php
include "../includes/functions.php";
if (!isLoggedIn()) {
	header('location: ../connexion.php');
} else if($_SESSION['user']['account_type'] != 'Candidat') {
    header('location: ../index.php');
}
$page = "Vos candidatures";
?>
<!DOCTYPE html>
<html>
    <?php include "../includes/header.php" ?>
    <div class="main-content">
        <div class="container">
            <div class="section-title">
                <h1>Vos candidatures</h1>
            </div>
            <div class="dashboard-container d-flex">
                <?php include "../includes/candidat_dashboard_menu.php" ?>
                <div class="dashboard-content col-lg-9 col-sm-12 col-xs-12 p-4 pb-5 bg-white">
                    <div class="dashboard-applied">
                    <h4 class="apply-title"><?= getCandidaturesNumberByCandidat() ?> candidatures envoyeés</h4>
                        <div class="dashboard-apply-area">
                            <?php getCandidaturesByCandidat() ?>
                        </div>
                    </div>
                    <div id="dashboard_form_result">
                        <?php
                            if(isset($_SESSION['candidature_deleted'])) {
                                ?>
                                <script type="text/javascript">
                                    Swal.fire({
                                        title: 'Super!',
                                        text: '<?= $_SESSION["candidature_deleted"] ?>',
                                        icon: 'success',
                                        confirmButtonText: 'Ok'
                                    })
                                </script>
                                <?php
                                unset($_SESSION["candidature_deleted"]);
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "../includes/footer.php" ?>
</html>