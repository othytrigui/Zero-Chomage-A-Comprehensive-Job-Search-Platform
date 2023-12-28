<?php
include "includes/functions.php";
$page = "Offres";

?>
<!DOCTYPE html>
<html>
    <?php include "includes/header.php" ?>
    <div class="main-content">
        <div class="container">
            <div class="section-title">
                <h1>Liste d'offres</h1>
            </div>
            <div class="jobs-listing d-flex">
                <div class="jobs-listing-sidebar col-lg-3 col-sm-12 col-xs-12 p-4">
                    <form class="jobs-filtering" method="get" action="">
                        <button id="filterButton" type="submit" class="btn btn-primary w-100 mb-3">Filtrer</button>
                        <input type="text" name="keywords" placeholder="Mots clés séparés par virgules" class="form-control filter-option keywords" value="<?php echo isset($_GET["keywords"]) ? $_GET["keywords"] : '';  ?>">
                        <select class="selectpicker w-100 filter-option" name="categorie">
                            <option value="">Categorie</option>
                            <?php getCategoriesList() ?>
                        </select>
                        <select class="selectpicker w-100 filter-option" data-live-search="true" name="localite">
                            <option value="">Localité</option>
                            <?php getCitiesList() ?>
                        </select>
                        <select class="selectpicker w-100 filter-option" name="type_contrat">
                            <option value="">Type de contrat</option>
                            <option value="CDI">CDI</option>
                            <option value="Contrat">Contrat</option>
                            <option value="CDD">CDD</option>
                            <option value="Stage">Stage</option>
                            <option value="Volontariat">Volontariat</option>
                        </select>
                        <select class="selectpicker w-100 filter-option" name="duree">
                            <option value="">Durée</option>
                            <option value="Temps-plein">Temps-plein</option>
                            <option value="Temps-partiel">Temps-partiel</option>
                        </select>
                        <select class="selectpicker w-100 filter-option" name="study_level">
                            <option value="">Niveau d'etude</option>
                            <option value="Bac">Bac</option>
                            <option value="Bac +2">Bac +2</option>
                            <option value="Bac +3">Bac +3</option>
                            <option value="Bac +4">Bac +4</option>
                            <option value="Bac +5 ou plus">Bac +5 ou plus</option>
                        </select>
                        <select class="selectpicker w-100 filter-option" name="experience">
                            <option value="">Niveau d'experience</option>
                            <option value="Débutant">Débutant</option>
                            <option value="Moins de 1 an">Moins de 1 an</option>
                            <option value="De 1 à 3 ans">De 1 à 3 ans</option>
                            <option value="De 3 à 5 ans">De 3 à 5 ans</option>
                            <option value="De 5 à 10 ans">De 5 à 10 ans</option>
                            <option value="De 10 à 20 ans">De 10 à 20 ans</option>
                        </select>
                        <div class="filter-option">
                            <h3 class="filter-title">Salaire</h3>
                            <input type="text" class="salaryRange" name="salaryRange" value="" />
                            <p id="salaryRangeSelected"></P>
                        </div>
                    </form>
                </div>
                <div class="jobs-listing-content col-lg-9 col-sm-12 col-xs-12 p-4 pb-5 bg-white">
                    <div class="job-filter-result">
                        <?php getFilteredJobs() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var salaryRange = $(".salaryRange");
        salaryRange.ionRangeSlider({
            skin: "round",
            type: "double",
            min: 0,
            max: 50000,
            postfix: " DH",
            step: 500
        });
        function getSalaryRange(e) {
            var salaryMINMAX = $(".irs-single").text();
            $("#salaryRangeSelected").text(salaryMINMAX);
        }
        $(document).ready(getSalaryRange);
        salaryRange.on("change", getSalaryRange);
    </script>
    <?php include "includes/footer.php" ?>
</html>