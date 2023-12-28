<?php
include "../includes/functions.php";
if (!isLoggedIn()) {
	header('location: ../connexion.php');
} else if($_SESSION['user']['account_type'] != 'Entreprise') {
    header('location: ../index.php');
}
$page = "Publier une offre";
?>
<!DOCTYPE html>
<html>
    <?php include "../includes/header.php" ?>
    <div class="main-content">
        <div class="container">
            <div class="section-title">
                <h1>Publier une offre</h1>
            </div>
            <div class="dashboard-container d-flex">
                <?php include "../includes/company_dashboard_menu.php" ?>
                <div class="dashboard-content col-lg-9 col-sm-12 col-xs-12 p-4 pb-5 bg-white">
                    <form method="post" action="../includes/functions.php" class="dashboard-form" enctype="multipart/form-data">
                        <div class="dashboard-section basic-info">
                            <h4 class="mb-4 text-uppercase"><i class="fad fa-user-check"></i>Publier une offre</h4>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="offre_title">Titre de l'offre*</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Titre de l'offre" id="offre_title" name="offre_title" value='<?php echo isset($_SESSION['title']) ? $_SESSION['title'] : ''; unset($_SESSION["title"]); ?>'>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="offre_details">À propos de l'offre</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-form-label" for="poste">Poste*</label>
                                            <input type="text" class="form-control" placeholder="e.g. Développeur Web" id="poste" name="poste" value='<?php echo isset($_SESSION['poste']) ? $_SESSION['poste'] : ''; unset($_SESSION["poste"]); ?>'>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-form-label" for="location">Localité*</label>
                                            <input type="text" class="form-control" placeholder="ex: Casablanca" id="location" name="location" value='<?php echo isset($_SESSION['location']) ? $_SESSION['location'] : ''; unset($_SESSION["location"]); ?>'>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="col-form-label" for="contrat">Type de contrat*</label>
                                            <select class="selectpicker w-100" name="contrat" id="contrat">
                                                <option value="Type de contrat" selected>Type de contrat</option>
                                                <option value="CDI">CDI</option>
                                                <option value="Contrat">Contrat</option>
                                                <option value="CDD">CDD</option>
                                                <option value="Stage">Stage</option>
                                                <option value="Volontariat">Volontariat</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="col-form-label" for="time">Durée*</label>
                                            <select class="selectpicker w-100" name="time" id="time">
                                                <option value="Temps-plein">Temps-plein</option>
                                                <option value="Temps-partiel">Temps-partiel</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="col-form-label" for="study_level">Niveau d'etude*</label>
                                            <select class="selectpicker w-100" name="study_level" id="study_level">
                                                <option value="Niveau d'etude" selected>Niveau d'etude</option>
                                                <option value="Bac">Bac</option>
                                                <option value="Bac +2">Bac +2</option>
                                                <option value="Bac +3">Bac +3</option>
                                                <option value="Bac +4">Bac +4</option>
                                                <option value="Bac +5 ou plus">Bac +5 ou plus</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="col-form-label" for="experience">Niveau d'experience*</label>
                                            <select class="selectpicker w-100" name="experience" id="experience">
                                                <option value="Niveau d'experience" selected>Niveau d'experience</option>
                                                <option value="Débutant">Débutant</option>
                                                <option value="Moins de 1 an">Moins de 1 an</option>
                                                <option value="De 1 à 3 ans">De 1 à 3 ans</option>
                                                <option value="De 3 à 5 ans">De 3 à 5 ans</option>
                                                <option value="De 5 à 10 ans">De 5 à 10 ans</option>
                                                <option value="De 10 à 20 ans">De 10 à 20 ans</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="col-form-label" for="salary">Salaire ( Par mois )*</label>
                                            <input type="number" class="form-control" placeholder="En dirhams" id="salary" name="salary" min=1 value='<?php echo isset($_SESSION['salary']) ? $_SESSION['salary'] : ''; unset($_SESSION["salary"]); ?>'>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="col-form-label" for="datefin">Date de fin de l'offre*</label>
                                            <input type="date" class="form-control" id="datefin" name="datefin" value='<?php echo isset($_SESSION['datefin']) ? $_SESSION['datefin'] : ''; unset($_SESSION["datefin"]); ?>'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="offre_body">Descriptif de l'offre*</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="offre_body" name="offre_body"><?php echo isset($_SESSION['offre_body']) ? $_SESSION['offre_body'] : ''; unset($_SESSION["offre_body"]); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <button id="submit" type="submit" name="add-job" class="btn btn-primary">Publier cette offre</button>
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
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "../includes/footer.php" ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#contrat > option").each(function() {
                if(this.text == '<?php echo isset($_SESSION['contrat']) ? $_SESSION['contrat'] : '' ?>') {
                    $(this).attr('selected', 'selected');
                }
            });
            $("[data-id=contrat] .filter-option-inner-inner").text("<?php echo isset($_SESSION['contrat']) ? $_SESSION['contrat'] : 'Type de contrat' ?>");
            $("#time > option").each(function() {
                if(this.text == '<?php echo isset($_SESSION['time']) ? $_SESSION['time'] : '' ?>') {
                    $(this).attr('selected', 'selected');
                }
            });
            $("[data-id=time] .filter-option-inner-inner").text("<?php echo isset($_SESSION['time']) ? $_SESSION['time'] : 'Temps-plein' ?>");
            $("#study_level > option").each(function() {
                if(this.text == '<?php echo isset($_SESSION['study_level']) ? $_SESSION['study_level'] : '' ?>') {
                    $(this).attr('selected', 'selected');
                }
            });
            $("[data-id=study_level] .filter-option-inner-inner").text("<?php echo isset($_SESSION['study_level']) ? $_SESSION['study_level'] : 'Niveau d\'etude' ?>");
            $("#experience > option").each(function() {
                if(this.text == '<?php echo isset($_SESSION['experience']) ? $_SESSION['experience'] : '' ?>') {
                    $(this).attr('selected', 'selected');
                }
            });
            $("[data-id=experience] .filter-option-inner-inner").text("<?php echo isset($_SESSION['experience']) ? $_SESSION['experience'] : 'Niveau d\'experience' ?>");
            <?php unset($_SESSION["contrat"]); unset($_SESSION["time"]); unset($_SESSION["study_level"]); unset($_SESSION["experience"]); ?>
        });
    </script>
</html>