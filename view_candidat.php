<?php
include "includes/functions.php";
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if(isset($_GET["id"])) {
    $id_candidat = $_GET["id"];
}
function getCandidatInfoById($info) {
    global $conn;
    global $id_candidat;
    $query = "SELECT $info FROM candidat_infos WHERE candidat_id = ".$id_candidat;
    if($info == "email") {
        $query = "SELECT $info FROM users WHERE id = ".$id_candidat;
    } elseif($info == "age") {
        $query = "SELECT (year(CURRENT_TIMESTAMP) - year(birthday)) as age FROM candidat_infos WHERE candidat_id = ".$id_candidat;
    }
    $rs = mysqli_query($conn, $query);
    $rs_get = mysqli_fetch_assoc($rs);
    return $rs_get[$info];
}
$page = getCandidatInfoById("full_name");
?>
<!DOCTYPE html>
<html>
    <?php include "includes/header.php" ?>
    <div class="main-content">
        <div class="container">
            <div class="candidate-details bg-white">
                <div class="candidate-info-socials">
                    <div class="candidate-title-and-info d-flex align-items-center justify-content-between">
                        <div class="title d-flex align-items-center flex-wrap">
                            <div class="thumb d-flex align-items-center justify-content-center">
                                <img src="assets/images/candidat_profiles/<?= getCandidatInfoById("profil_pic") ?>" class="img-fluid" alt="">
                            </div>
                            <div class="title-body">
                                <h4><?= getCandidatInfoById("full_name") ?></h4>
                                <div class="info">
                                    <span><i class="fal fa-phone"></i><?= getCandidatInfoById("phone") ?></a></span>
                                    <span><i class="far fa-map-marker-alt"></i><?= getCandidatInfoById("adresse") ?></a></span>
                                </div>
                            </div>
                        </div>
                        <div class="download-resume">
                            <a href="assets/CVs/<?= getCandidatInfoById("cv") ?>" target="_blank">Télécharger CV<i class="fal fa-arrow-to-bottom"></i></a>
                        </div>
                    </div>
                    <?php if(getCandidatInfoById("facebook") != "" || getCandidatInfoById("twitter") != "" || getCandidatInfoById("linkedin") != "") : ?>
                        <div class="social-links d-flex align-items-center">
                            <label>Réseaux sociaux:</label>
                            <?php if(getCandidatInfoById("facebook") != "") :?>
                                <a href="<?= getCandidatInfoById("facebook") ?>"><i class="fab fa-facebook-square"></i></a>
                            <?php endif;?>
                            <?php if(getCandidatInfoById("twitter") != "") :?>
                                <a href="<?= getCandidatInfoById("twitter") ?>"><i class="fab fa-twitter-square"></i></a>
                            <?php endif;?>
                            <?php if(getCandidatInfoById("linkedin") != "") :?>
                                <a href="<?= getCandidatInfoById("linkedin") ?>"><i class="fab fa-linkedin"></i></a>
                            <?php endif;?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="candidate-infos">
                    <div class="row">
                        <div class="col-xl-7 col-lg-8">
                            <div class="details-section">
                                <h4 class="description_title mb-0"><i class="far fa-align-left"></i>À propos</h4>
                                <div class="job_description">
                                    <?= getCandidatInfoById("a_propos") ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 offset-xl-1 col-lg-4">
                            <div class="job-summary">
                                <h4>Informations</h4>
                                <ul class="m-0 p-0">
                                    <li><span>Adresse:</span><?= getCandidatInfoById("adresse") ?></li>
                                    <li><span>Âge:</span><?= getCandidatInfoById("age") ?> Ans</li>
                                </ul>
                            </div>
                            <a href="mailto:<?= getCandidatInfoById("email") ?>" target="_blank" class="contact-button">Contactez moi </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "includes/footer.php" ?>
</html>