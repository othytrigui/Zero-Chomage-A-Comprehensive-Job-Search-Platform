<head>
    <title>Zero chomage - <?= $page ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8" />
    <!-- Css Includes -->
    <link href="<?= $website_url ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $website_url ?>assets/css/style.css" rel="stylesheet">
    <link href="<?= $website_url ?>assets/font-awesome/all.css" rel="stylesheet" type="text/css">
    <link href="<?= $website_url ?>assets/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
    <link href="<?= $website_url ?>assets/css/ion.rangeSlider.min.css" rel="stylesheet" type="text/css">
    <!-- Js Includes -->
    <script src="<?= $website_url ?>assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="<?= $website_url ?>assets/js/swal.js" type="text/javascript"></script>
    <script src="<?= $website_url ?>assets/js/tinymce.js" type="text/javascript"></script>
    <script src="<?= $website_url ?>assets/js/ion.rangeSlider.min.js" type="text/javascript"></script>
</head>
<body>
<nav class="navbar main-nav">
    <div class="container">
        <a class="navbar-brand" href="<?= $website_url ?>">
            Zero Chômage
        </a>
        <?php if(isset($_SESSION['user'])) : ?>
            <form method="post" action="">
                <button class="btn btn-danger logout_btn" type="submit" name="logout"><i class="fad fa-power-off"></i>Se déconnecter</button>
            </form>
        <?php endif; ?>
        <nav class="navbar navbar-expand-lg navbar-light w-100">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="nav nav_nav w-100 align-items-center pt-3">
                    <li><a href="<?= $website_url ?>">Accueil</a></li>
                    <li><a href="<?= $website_url ?>jobs.php">Offres</a></li>
                    <li><a href="<?= $website_url ?>candidats.php">Candidats</a></li>
                    <li><a href="<?= $website_url ?>entreprises.php">Entreprises</a></li>
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']['account_type'] == 'Entreprise') : ?>
                        <li class="post_job account-page-link border-0 ms-auto me-0"><a href="<?= $website_url ?>entreprise/add-job.php"><i class="fad fa-plus"></i>Publier une offre</a></li>
                    <?php elseif(isset($_SESSION['user']) && $_SESSION['user']['account_type'] == 'Candidat') : ?>
                        <li class="post_job account-page-link border-0 ms-auto me-0"><a href="<?= $website_url ?>candidat/dashboard.php"><i class="fad fa-user"></i><?= getCandidatInfo("full_name") ?></a></li>
                    <?php elseif(!isset($_SESSION['user'])): ?>
                        <li class="post_job account-page-link ms-auto me-0"><a href="<?= $website_url ?>connexion.php"><i class="fal fa-sign-in"></i>Se connecter</a></li>
                        <li class="post_job registerbtn account-page-link me-0"><a href="<?= $website_url ?>register.php"><i class="fal fa-user-plus"></i>S'inscrire</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </div>
</nav>