<?php
include "includes/functions.php";
$page = "Entreprises";

?>
<!DOCTYPE html>
<html>
    <?php include "includes/header.php" ?>
    <div class="main-content">
        <div class="container">
            <div class="section-title">
                <h1>Liste d'entreprises</h1>
            </div>
            <div class="jobs-listing d-flex">
                <div class="jobs-listing-sidebar col-lg-3 col-sm-12 col-xs-12 p-4">
                    <form class="jobs-filtering" method="get" action="">
                        <select class="selectpicker w-100 filter-option" name="categorie">
                            <option value="">Categorie</option>
                            <?php getCategoriesList() ?>
                        </select>
                        <select class="selectpicker w-100 filter-option" data-live-search="true" name="localite">
                            <option value="">Localité</option>
                            <?php getCitiesList() ?>
                        </select>
                        <button id="filterButton" type="submit" class="btn btn-primary w-100 mt-3">Filtrer</button>
                    </form>
                </div>
                <div class="jobs-listing-content col-lg-9 col-sm-12 col-xs-12 p-4 pb-5 bg-white">
                    <div class="job-filter-result">
                        <?php getgetFilteredEntreprises() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "includes/footer.php" ?>
</html>