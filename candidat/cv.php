<?php
include "../includes/functions.php";
if (!isLoggedIn()) {
    header('location: ../connexion.php');
} else if ($_SESSION['user']['account_type'] != 'Candidat') {
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
                    <?php if (getCandidatInfo("cv") !== "" && !is_null(getCandidatInfo("cv"))) { ?>
                        <div class="mb-4">
                            <h4 class="mb-4 text-uppercase" style="color: #626262; font-size: 16px;"><i class="fad fa-eye" style="margin-right: 7px;"></i>CV actuel</h4>
                            <div class="border p-3 d-inline-block w-100 actual-cv">
                                <span class="float-start">
                                    <a href="../assets/CVs/<?= getCandidatInfo("cv") ?>" target="_blank"><?= getCandidatInfo("cv") ?></a>
                                </span>
                                <form method="post" action="../includes/functions.php" class="float-end">
                                    <button type="submit" name="delete_cv" class="p-0 border-0 bg-transparent"><i class="fad fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    <?php } ?>
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

                            <!-- Autofill Form -->
                            <h4 class="my-4 text-uppercase"><i class="fad fa-user-cog"></i>Informations extraites du CV</h4>

                            <!-- Personal Information -->
                            <div class="dashboard-section basic-info">
                                <h5>Informations Personnelles</h5>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="full_name">Nom complet*</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="full_name" name="full_name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="email">Email*</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="email" name="email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="phone">Téléphone*</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="phone" name="phone">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="address">Adresse</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="address" name="address">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="linkedin">LinkedIn</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="linkedin" name="linkedin">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label" for="github">GitHub</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="github" name="github">
                                    </div>
                                </div>
                            </div>

                            <!-- Work Experience -->
                            <div class="dashboard-section work-experience">
                                <h5>Expérience professionnelle</h5>
                                <div id="work-experience-wrapper">
                                    <div class="work-experience-item card mb-3">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <span>Expérience professionnelle</span>
                                            <button type="button" class="btn btn-link toggle-section" data-toggle="collapse" data-target="#work-experience-content-1" aria-expanded="true" aria-controls="work-experience-content-1">Toggle</button>
                                        </div>
                                        <div id="work-experience-content-1" class="collapse show card-body">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="job_title">Intitulé du poste</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="job_title" name="job_title[]">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="company">Entreprise</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="company" name="company[]">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="start_date">Date de début</label>
                                                <div class="col-sm-4">
                                                    <input type="date" class="form-control" id="start_date" name="start_date[]">
                                                </div>
                                                <label class="col-sm-1 col-form-label text-center" for="end_date">à</label>
                                                <div class="col-sm-4">
                                                    <input type="date" class="form-control" id="end_date" name="end_date[]">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="location">Lieu</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="location" name="location[]">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="responsibilities">Responsabilités</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" id="responsibilities" name="responsibilities[]"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" id="add-work-experience" class="btn btn-secondary mt-3">Ajouter une autre expérience</button>
                            </div>

                            <!-- Education -->
                            <div class="dashboard-section education">
                                <h5>Éducation</h5>
                                <div id="education-wrapper">
                                    <div class="education-item card mb-3">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <span>Éducation</span>
                                            <button type="button" class="btn btn-link toggle-section" data-toggle="collapse" data-target="#education-content-1" aria-expanded="true" aria-controls="education-content-1">Toggle</button>
                                        </div>
                                        <div id="education-content-1" class="collapse show card-body">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="degree">Diplôme</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="degree" name="degree[]">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="school">École</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="school" name="school[]">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="edu_start_date">Date de début</label>
                                                <div class="col-sm-4">
                                                    <input type="date" class="form-control" id="edu_start_date" name="edu_start_date[]">
                                                </div>
                                                <label class="col-sm-1 col-form-label text-center" for="edu_end_date">à</label>
                                                <div class="col-sm-4">
                                                    <input type="date" class="form-control" id="edu_end_date" name="edu_end_date[]">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" id="add-education" class="btn btn-secondary mt-3">Ajouter une autre éducation</button>
                            </div>

                            <!-- Projects -->
                            <div class="dashboard-section projects">
                                <h5>Projets</h5>
                                <div id="projects-wrapper">
                                    <div class="project-item card mb-3">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <span>Projet</span>
                                            <button type="button" class="btn btn-link toggle-section" data-toggle="collapse" data-target="#project-content-1" aria-expanded="true" aria-controls="project-content-1">Toggle</button>
                                        </div>
                                        <div id="project-content-1" class="collapse show card-body">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="project_name">Nom du projet</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="project_name" name="project_name[]">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="project_description">Description du projet</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" id="project_description" name="project_description[]"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="project_link">Lien du projet</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="project_link" name="project_link[]">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" id="add-project" class="btn btn-secondary mt-3">Ajouter un autre projet</button>
                            </div>

                            <!-- Save Button -->
                            <div class="row">
                                <div class="col-sm-9">
                                    <button id="submit" type="submit" name="save_cv" class="btn btn-primary mt-3 save_cv">Sauvegarder les modifications</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "../includes/footer.php" ?>

    <!-- Custom JavaScript for Dynamic Form Functionality -->
    <script>
        $(document).ready(function() {
            // Add new Work Experience
            $('#add-work-experience').click(function() {
                let experienceHtml = `
                    <div class="work-experience-item card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Expérience professionnelle</span>
                            <button type="button" class="btn btn-link toggle-section" data-toggle="collapse" data-target="#work-experience-content-new" aria-expanded="true" aria-controls="work-experience-content-new">Toggle</button>
                        </div>
                        <div id="work-experience-content-new" class="collapse show card-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="job_title">Intitulé du poste</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="job_title" name="job_title[]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="company">Entreprise</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="company" name="company[]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="start_date">Date de début</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" id="start_date" name="start_date[]">
                                </div>
                                <label class="col-sm-1 col-form-label text-center" for="end_date">à</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" id="end_date" name="end_date[]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="location">Lieu</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="location" name="location[]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="responsibilities">Responsabilités</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="responsibilities" name="responsibilities[]"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>`;
                $('#work-experience-wrapper').append(experienceHtml);
            });

            // Add new Education
            $('#add-education').click(function() {
                let educationHtml = `
                    <div class="education-item card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Éducation</span>
                            <button type="button" class="btn btn-link toggle-section" data-toggle="collapse" data-target="#education-content-new" aria-expanded="true" aria-controls="education-content-new">Toggle</button>
                        </div>
                        <div id="education-content-new" class="collapse show card-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="degree">Diplôme</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="degree" name="degree[]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="school">École</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="school" name="school[]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="edu_start_date">Date de début</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" id="edu_start_date" name="edu_start_date[]">
                                </div>
                                <label class="col-sm-1 col-form-label text-center" for="edu_end_date">à</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" id="edu_end_date" name="edu_end_date[]">
                                </div>
                            </div>
                        </div>
                    </div>`;
                $('#education-wrapper').append(educationHtml);
            });

            // Add new Project
            $('#add-project').click(function() {
                let projectHtml = `
                    <div class="project-item card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Projet</span>
                            <button type="button" class="btn btn-link toggle-section" data-toggle="collapse" data-target="#project-content-new" aria-expanded="true" aria-controls="project-content-new">Toggle</button>
                        </div>
                        <div id="project-content-new" class="collapse show card-body">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="project_name">Nom du projet</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="project_name" name="project_name[]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="project_description">Description du projet</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="project_description" name="project_description[]"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" for="project_link">Lien du projet</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="project_link" name="project_link[]">
                                </div>
                            </div>
                        </div>
                    </div>`;
                $('#projects-wrapper').append(projectHtml);
            });

            // Toggle Section Visibility
            $(document).on('click', '.toggle-section', function() {
                let target = $(this).data('target');
                $(target).collapse('toggle');
            });
        });
    </script>
</html>
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