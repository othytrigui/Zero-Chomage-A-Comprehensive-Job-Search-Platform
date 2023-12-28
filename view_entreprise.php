<?php
include "includes/functions.php";
if(isset($_GET["id"])) {
    $id_entreprise = $_GET["id"];
}
function getEntrepriseInfoById($info) {
    global $conn;
    global $id_entreprise;
    $query = "SELECT $info FROM entreprise_infos WHERE entreprise_id = ".$id_entreprise;
    if($info == "email") {
        $query = "SELECT $info FROM users WHERE id = ".$id_entreprise;
    }
    $rs = mysqli_query($conn, $query);
    $rs_get = mysqli_fetch_assoc($rs);
    return $rs_get[$info];
}
$page = getEntrepriseInfoById("name");
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
                            <div class="thumb d-flex align-items-center justify-content-center company_logo">
                                <img src="assets/images/companies_logos/<?= getEntrepriseInfoById("logo") ?>" class="img-fluid" alt="">
                            </div>
                            <div class="title-body">
                                <h4><?= getEntrepriseInfoById("name") ?></h4>
                                <div class="info">
                                    <span><i class="fal fa-phone"></i><?= getEntrepriseInfoById("phone") ?></span>
                                    <span><i class="far fa-map-marker-alt"></i><?= getEntrepriseInfoById("adresse") ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="candidate-infos">
                    <div class="row">
                        <div class="col-xl-7 col-lg-8">
                            <div class="details-section">
                                <h4 class="description_title mb-0"><i class="far fa-align-left"></i>À propos</h4>
                                <div class="job_description">
                                    <?= getEntrepriseInfoById("a_propos") ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 offset-xl-1 col-lg-4">
                            <div class="job-summary">
                                <h4>Informations</h4>
                                <ul class="m-0 p-0">
                                    <li><span>Categorie:</span><?= getEntrepriseInfoById("categorie") ?></li>
                                    <li><span>Téléphone:</span><?= getEntrepriseInfoById("phone") ?></li>
                                    <li><span>Email:</span><?= getEntrepriseInfoById("email") ?></li>
                                    <li><span>Adresse:</span><?= getEntrepriseInfoById("adresse") ?></li>
                                </ul>
                            </div>
                            <a href="mailto:<?= getEntrepriseInfoById("email") ?>" target="_blank" class="contact-button">Contactez nous</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "includes/footer.php" ?>
</html>