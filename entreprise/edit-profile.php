<?php
include "../includes/functions.php";
if (!isLoggedIn()) {
	header('location: ../connexion.php');
} else if($_SESSION['user']['account_type'] != 'Entreprise') {
    header('location: ../index.php');
}
$page = "Modifier votre profile";
?>
<!DOCTYPE html>
<html>
    <?php include "../includes/header.php" ?>
    <div class="main-content">
        <div class="container">
            <div class="section-title">
                <h1>Modifier votre profile</h1>
            </div>
            <div class="dashboard-container d-flex">
                <?php include "../includes/company_dashboard_menu.php" ?>
                <div class="dashboard-content col-lg-9 col-sm-12 col-xs-12 p-4 pb-5 bg-white">
                    <form method="post" action="../includes/functions.php" class="dashboard-form" enctype="multipart/form-data">
                        <div class="dashboard-section upload-profile-photo position-relative">
                            <div class="update-photo rounded m-0 position-relative">
                                <img class="position-absolute top-50 start-50 translate-middle" src="../assets/images/companies_logos/<?= getEntrepriseInfo("logo") ?>">
                            </div>
                            <div class="file-upload position-absolute border-0 bottom-0 start-0 text-center rounded-bottom">            
                                <input type="file" class="position-absolute top-0 end-0 m-0 p-0" name="company_logo" id="company_logo">Modifier l'avatar
                            </div>
                        </div>
                        <div class="dashboard-section basic-info">
                            <h4 class="mb-4 text-uppercase"><i class="fad fa-user-cog"></i>Informations basiques</h4>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="company_name">Nom de l'entreprise*</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Nom de l'entreprise" id="company_name" name="company_name" value="<?= getEntrepriseInfo("name") ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="username">Nom d'utilisateur</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="username" id="username" name="username" value="<?= getEntrepriseInfo("username") ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="email">Adresse e-mail</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="email@example.com" id="email" name="email" value="<?= getEntrepriseInfo("email") ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="phone">Téléphone*</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="0611111111" id="phone" name="phone" value="<?= getEntrepriseInfo("phone") ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="address">Adresse*</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Adresse de l'entreprise" id="address" name="address" value="<?= getEntrepriseInfo("adresse") ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="category">Catégorie*</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Ex. Informatique" id="category" name="category" value="<?= getEntrepriseInfo("categorie") ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="about_us">À propos de nous</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="about_us" name="about_us" placeholder="Quelques lignes à propos de vous" max="400"><?= getEntrepriseInfo("a_propos") ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard-section basic-info">
                            <h4 class="mb-4 text-uppercase"><i class="fad fa-lock"></i>Modifier votre mot de passe</h4>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="current_password">Mot de passe actuel</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" placeholder="Mot de passe actuel" id="current_password" name="current_password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="new_password">Nouveau mot de passe</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" placeholder="Nouveau mot de passe" id="new_password" name="new_password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="new_password2">Confirmation</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" placeholder="Confirmer votre nouveau mot de passe" id="new_password2" name="new_password2">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <button id="submit" type="submit" name="save_infos" class="btn btn-primary">Sauvegarder les modifications</button>
                            </div>
                        </div>
                    </form>
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
    <?php include "../includes/footer.php" ?>
</html>