<?php
include "includes/functions.php";
$page = "Candidats";

?>
<!DOCTYPE html>
<html>
    <?php include "includes/header.php" ?>
    <div class="main-content">
        <div class="container">
            <div class="section-title">
                <h1>Liste des candidats</h1>
            </div>
            <div class="candidats-listing d-flex">
                <div class="candidats-listing-sidebar col-lg-3 col-sm-12 col-xs-12 p-4">
                    <form class="candidats-filtering" method="get" action="">
                        <input type="text" name="name" placeholder="Nom" class="form-control filter-option keywords" value="<?php echo isset($_GET["name"]) ? $_GET["name"] : '';  ?>">
                        <select class="selectpicker w-100 filter-option" name="age">
                            <option value="">Âge</option>
                            <option value="20;25">Entre 20 et 25</option>
                            <option value="25;30">Entre 25 et 30</option>
                            <option value="30;35">Entre 30 et 35</option>
                            <option value="35;40">Entre 35 et 40</option>
                        </select>
                        <button id="filterButton" type="submit" class="btn btn-primary w-100 mt-3">Filtrer</button>
                    </form>
                </div>
                <div class="jobs-listing-content col-lg-9 col-sm-12 col-xs-12 p-4 pb-5 bg-white">
                    <div class="candidate-filter-result">
                        <?php getFilteredCandidats() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "includes/footer.php" ?>
</html>