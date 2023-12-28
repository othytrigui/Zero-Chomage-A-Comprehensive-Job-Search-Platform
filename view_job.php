<?php
include "includes/functions.php";
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
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
function getJobsCompanyInfo($info) {
    global $conn;
    global $id_job;
    $query = "SELECT $info FROM entreprise_infos WHERE entreprise_id = (SELECT id_entreprise FROM jobs WHERE id = ".$id_job.")";
    if($info == "email") {
        $query = "SELECT $info FROM users WHERE id = (SELECT id_entreprise FROM jobs WHERE id = ".$id_job.")";
    }
    $rs = mysqli_query($conn, $query);
    $rs_get = mysqli_fetch_assoc($rs);
    return $rs_get[$info];
}
$page = getJobInfo("titre");
?>
<!DOCTYPE html>
<html>
    <?php include "includes/header.php" ?>
    <div class="main-content">
        <div class="container">
            <div class="job-listing-details bg-white">
                <div class="job-title-and-info d-flex align-items-center justify-content-between">
                    <div class="title d-flex align-items-center flex-wrap">
                        <div class="thumb d-flex align-items-center justify-content-center">
                            <img src="assets/images/companies_logos/<?= getJobsCompanyInfo("logo") ?>" class="img-fluid" alt="">
                        </div>
                        <div class="title-body">
                            <h4><?= getJobInfo("titre") ?></h4>
                            <div class="info">
                                <span class="company"><a href="view_entreprise.php?id=<?= getJobsCompanyInfo("entreprise_id") ?>" target="_blank"><i class="far fa-briefcase"></i><?= getJobsCompanyInfo("name") ?></a></span>
                                <span class="location"><a href="jobs.php?localite=<?= getJobInfo("localite") ?>" target="_blank"><i class="far fa-map-marker-alt"></i><?= getJobInfo("localite") ?></a></span>
                                <span class="job-type full-time"><a href="jobs.php?duree=<?= getJobInfo("duree") ?>" target="_blank"><i class="far fa-clock"></i><?= getJobInfo("duree") ?></a></span>
                            </div>
                        </div>
                    </div>
                    <?php if((isset($_SESSION['user']) && $_SESSION['user']['account_type'] == 'Candidat') || (!isset($_SESSION['user']))) : ?>
                        <div class="buttons">
                            <form method="post" action="includes/functions.php" class="d-inline saveJobForm">
                                <input type="hidden" id="url" value="<?=$actual_link?>" />
                                <input type="hidden" id="jobid" value="<?=getJobInfo("id")?>" />
                                <button type="submit" class="save"><i class="far fa-bookmark"></i></button>
                            </form>
                            <form method="post" action="includes/functions.php" class="d-inline applyJobForm">
                                <input type="hidden" id="url" value="<?=$actual_link?>" />
                                <input type="hidden" id="jobid" value="<?=getJobInfo("id")?>" />
                                <button type="submit" class="apply">Postulez maintenant</button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="job-details">
                    <div class="row">
                        <div class="col-xl-7 col-lg-8">
                            <div class="details-section">
                                <h4 class="description_title mb-0"><i class="far fa-align-left"></i>Description de l'offre</h4>
                                <div class="job_description">
                                    <?= getJobInfo("descriptif") ?>
                                </div>
                            </div>
                            <?php if((isset($_SESSION['user']) && $_SESSION['user']['account_type'] == 'Candidat') || (!isset($_SESSION['user']))) : ?>
                                <div class="job-apply-buttons">
                                    <form method="post" action="includes/functions.php" class="d-inline applyJobForm">
                                        <input type="hidden" id="url" value="<?=$actual_link?>" />
                                        <input type="hidden" id="jobid" value="<?=getJobInfo("id")?>" />
                                        <button type="submit" class="apply">Postulez maintenant</button>
                                    </form>
                                    <a href="mailto:<?= getJobsCompanyInfo("email") ?>" target="_blank" class="email"><i class="far fa-envelope"></i>Postuler par mail</a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-xl-4 offset-xl-1 col-lg-4">
                            <div class="job-summary">
                                <h4>Résumé de l'offre</h4>
                                <ul class="m-0 p-0">
                                    <li><span>Publiée le:</span><?= getJobInfo("publish_date") ?></li>
                                    <li><span>Localité:</span><?= getJobInfo("localite") ?></li>
                                    <li><span>Type de contrat:</span><?= getJobInfo("type_contrat") ?></li>
                                    <li><span>Dureé de travail:</span><?= getJobInfo("duree") ?></li>
                                    <li><span>Niveau d'etude demandé:</span><?= getJobInfo("study_level") ?></li>
                                    <li><span>Experience demandé:</span><?= getJobInfo("experience") ?></li>
                                    <li><span>Salaire:</span><?= getJobInfo("salaire") ?> DH</li>
                                    <li><span>Date limite de l'offre:</span><?= getJobInfo("datefin") ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-7 col-lg-8">
                        <div class="company-information">
                            <h4><i class="far fa-briefcase"></i>Profile d'entreprise</h4>
                            <ul class="m-0 p-0">
                                <li><span>Nom de l'entreprise:</span><?= getJobsCompanyInfo("name") ?></li>
                                <li><span>Adresse:</span><?= getJobsCompanyInfo("adresse") ?></li>
                                <li><span>Téléphone:</span><?= getJobsCompanyInfo("phone") ?></li>
                                <li><span>À propos de l'entreprise:</span></li>
                                <li><?= getJobsCompanyInfo("a_propos") ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="job_result"></div>
            </div>
        </div>
    </div>
    <?php include "includes/footer.php" ?>
    <?php
        if(checkIfJobAlreadySaved($id_job)) {
            echo "<script type='text/javascript'>
                $('.saveJobForm i').removeClass('far').addClass('fas');
                $('.saveJobForm .save').addClass('job-saved');
            </script>";
        }
    ?>
</html>