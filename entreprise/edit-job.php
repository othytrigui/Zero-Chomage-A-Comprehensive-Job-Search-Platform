<?php
include "../includes/functions.php";
if (!isLoggedIn()) {
	header('location: ../connexion.php');
} else if($_SESSION['user']['account_type'] != 'Entreprise') {
    header('location: ../index.php');
}
$page = "Modifier une offre";
if(isset($_GET["id"])) {
    $id_job = $_GET["id"];
}
function getJobInfo($info) {
    global $conn;
    global $id_job;
    $query = "SELECT $info FROM jobs WHERE id = ".$id_job;
    $rs = mysqli_query($conn, $query);
    $rs_get = mysqli_fetch_assoc($rs);
    return $rs_get[$info];
}
if(isset($_POST['edit-job'])) {
    global $conn;

    $title = e($_POST['offre_title']);
    $poste = e($_POST['poste']);
    $location = e($_POST['location']);
    $contrat = e($_POST['contrat']);
    $study_level = e($_POST['study_level']);
    $experience = e($_POST['experience']);
    $time = e($_POST['time']);
    $salary = e($_POST['salary']);
    $datefin = e($_POST['datefin']);
    $offre_body = e($_POST['offre_body']);

    if(empty($title)) {
        $_SESSION["error"] = "Veuillez entrer le titre de l\'offre.";
    } else {
        if(empty($poste)) {
            $_SESSION["error"] = "Veuillez spécifier la poste demandée dans l\'offre.";
        } else {
            if(empty($location)) {
                $_SESSION["error"] = "Veuillez entrer la location.";
            } else {
                if($contrat == "Type de contrat") {
                    $_SESSION["error"] = "Veuillez spécifier un type de contrat.";
                } else {
                    if($study_level == "Niveau d\'etude") {
                        $_SESSION["error"] = "Veuillez spécifier le niveau d\'etude demandé.";
                    } else {
                        if($experience == "Niveau d\'experience") {
                            $_SESSION["error"] = "Veuillez spécifier le niveau d\'experience demandé.";
                        } else {
                            if(empty($salary)) {
                                $_SESSION["error"] = "Veuillez entrer le salaire.";
                            } else {
                                if(empty($datefin)) {
                                    $_SESSION["error"] = "Veuillez entrer la date de fin de l\'offre.";
                                } else {
                                    if(empty($offre_body)) {
                                        $_SESSION["error"] = "Le descriptif de l\'offre ne peut pas être vide.";
                                    } else {
                                        $query= "UPDATE jobs SET titre = '$title', poste = '$poste', localite = '$location', type_contrat = '$contrat', duree = '$time', study_level = '$study_level', experience = '$experience', salaire = '$salary', datefin = '$datefin', descriptif = '$offre_body' WHERE id = ".$id_job;
                                        mysqli_query($conn, $query);
                                        $_SESSION["job_edited_success"] = "Les modifications ont été enregistrées avec succès.";
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <?php include "../includes/header.php" ?>
    <div class="main-content">
        <div class="container">
            <div class="section-title">
                <h1>Modifier cette offre</h1>
            </div>
            <div class="dashboard-container d-flex">
                <?php include "../includes/company_dashboard_menu.php" ?>
                <div class="dashboard-content col-lg-9 col-sm-12 col-xs-12 p-4 pb-5 bg-white">
                    <form method="post" action="" class="dashboard-form" enctype="multipart/form-data">
                        <div class="dashboard-section basic-info">
                            <h4 class="mb-4 text-uppercase"><i class="far fa-edit"></i>Modifier une offre</h4>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="offre_title">Titre de l'offre*</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Titre de l'offre" id="offre_title" name="offre_title" value='<?= getJobInfo("titre") ?>'>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="offre_details">À propos de l'offre</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-form-label" for="poste">Poste*</label>
                                            <input type="text" class="form-control" placeholder="e.g. Développeur Web" id="poste" name="poste" value='<?= getJobInfo("poste") ?>'>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-form-label" for="location">Localité*</label>
                                            <input type="text" class="form-control" placeholder="ex: Casablanca" id="location" name="location" value='<?= getJobInfo("localite") ?>'>
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
                                            <input type="number" class="form-control" placeholder="En dirhams" id="salary" name="salary" min=1 value='<?= getJobInfo("salaire") ?>'>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label class="col-form-label" for="datefin">Date de fin de l'offre*</label>
                                            <input type="date" class="form-control" id="datefin" name="datefin" value='<?= getJobInfo("datefin") ?>'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="offre_body">Descriptif de l'offre*</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="offre_body" name="offre_body"><?= getJobInfo("descriptif") ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <button id="submit" type="submit" name="edit-job" class="btn btn-primary">Sauvgarder les modifications</button>
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
                        <?php 
                            if(isset($_SESSION['job_edited_success'])) {
                                ?>
                                <script type="text/javascript">
                                    Swal.fire({
                                    title: 'Super!',
                                    text: '<?= $_SESSION["job_edited_success"] ?>',
                                    icon: 'success',
                                    confirmButtonText: 'Ok'
                                })
                                </script>
                                <?php
                                unset($_SESSION["job_edited_success"]);
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
                if(this.text == '<?= getJobInfo("type_contrat") ?>') {
                    $(this).attr('selected', 'selected');
                }
            });
            $("[data-id=contrat] .filter-option-inner-inner").text("<?= getJobInfo("type_contrat") ?>");
            $("#time > option").each(function() {
                if(this.text == '<?= getJobInfo("duree") ?>') {
                    $(this).attr('selected', 'selected');
                }
            });
            $("[data-id=time] .filter-option-inner-inner").text("<?= getJobInfo("duree") ?>");
            $("#study_level > option").each(function() {
                if(this.text == "<?= getJobInfo('study_level') ?>") {
                    $(this).attr('selected', 'selected');
                }
            });
            $("[data-id=study_level] .filter-option-inner-inner").text("<?= getJobInfo('study_level') ?>");
            $("#experience > option").each(function() {
                if(this.text == "<?= getJobInfo('experience') ?>") {
                    $(this).attr('selected', 'selected');
                }
            });
            $("[data-id=experience] .filter-option-inner-inner").text("<?= getJobInfo('experience') ?>");
        });
    </script>
</html>