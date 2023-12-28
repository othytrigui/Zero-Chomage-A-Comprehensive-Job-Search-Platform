<?php
include "../includes/functions.php";
if (!isLoggedIn()) {
	header('location: ../connexion.php');
} else if($_SESSION['user']['account_type'] != 'Candidat') {
    header('location: ../index.php');
}
$page = "Votre CV";
?>
<!DOCTYPE html>
<html>
    <?php include "../includes/header.php" ?>
    <div class="main-content">
        <div class="container">
            <div class="section-title">
                <h1>Votre CV</h1>
            </div>
            <div class="dashboard-container d-flex">
                <?php include "../includes/candidat_dashboard_menu.php" ?>
                <div class="dashboard-content col-lg-9 col-sm-12 col-xs-12 p-4 pb-5 bg-white">
                    <div class="dashboard-section basic-info">
                        <h4 class="mb-4 text-uppercase"><i class="fad fa-file-alt"></i>Télécharger votre CV</h4>
                        <form method="post" action="../includes/functions.php" class="dashboard-form" enctype="multipart/form-data">
                            <div class="drop-zone">
                                <div class="drop-zone__content">
                                    <i class="fal fa-cloud-upload d-block"></i>
                                    <span class="drop-zone__prompt">Faites glisser ou cliquez pour Télécharger le fichier</span>
                                    <p>(.doc, .docx, .pdf. Taille max. 2MB)</p>
                                </div>
                                <input type="file" name="cv" class="drop-zone__input" required>
                            </div>
                            <div class="row">
                                <div class="col-sm-9">
                                    <button id="submit" type="submit" name="save_cv" class="btn btn-primary mt-3 save_cv">Sauvegarder les modifications</button>
                                </div>
                            </div>
                        </form>
                        <?php if (getCandidatInfo("cv") !== "" && !is_null(getCandidatInfo("cv"))) { ?>
                            <h4 class="my-4 text-uppercase"><i class="fad fa-eye"></i>CV actuel</h4>
                            <div class="border p-3 d-inline-block w-100 actual-cv">
                                <span class="float-start">
                                    <a href="../assets/CVs/<?= getCandidatInfo("cv") ?>" target="_blank"><?= getCandidatInfo("cv") ?></a>
                                </span>
                                <form method="post" action="../includes/functions.php" class="float-end">
                                    <button type="submit" name="delete_cv" class="p-0 border-0 bg-transparent"><i class="fad fa-trash"></i></button>
                                </form>
                            </div>
                        <?php } ?>
                        <div id="dashboard_form_result">
                            <?php 
                                if(isset($_SESSION['error'])) {
                                    ?>
                                    <script type="text/javascript">
                                        Swal.fire({
                                            title: 'Error!',
                                            text: '<?= $_SESSION["error"] ?>',
                                            icon: 'error',
                                            confirmButtonText: 'Ok'
                                        })
                                    </script>
                                    <?php
                                    unset($_SESSION["error"]);
                                }
                                if(isset($_SESSION['success'])) {
                                    ?>
                                    <script type="text/javascript">
                                        Swal.fire({
                                            title: 'Super!',
                                            text: '<?= $_SESSION["success"] ?>',
                                            icon: 'success',
                                            confirmButtonText: 'Ok'
                                        })
                                    </script>
                                    <?php
                                    unset($_SESSION["success"]);
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "../includes/footer.php" ?>
</html>