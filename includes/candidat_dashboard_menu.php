<div class="dashboard-sidebar col-lg-3 col-sm-12 col-xs-12 p-4">
    <div class="company-info mb-3 d-flex align-items-center">
        <div class="thumb position-relative">
            <img src="<?= $website_url ?>assets/images/candidat_profiles/<?= getCandidatInfo("profil_pic") ?>" class="img-fluid position-absolute top-50 start-50 translate-middle">
        </div>
        <div class="company-body">
            <h5 class="mb-0"><?= getCandidatInfo("full_name") ?></h5>
            <span>@<?= getCandidatInfo("username") ?></span>
        </div>
    </div>
    <div class="dashboard-menu">
        <ul class="m-0 p-0 pb-2">
            <li class="nav-item <?php echo ($page == "Tableau de bord" ? "active" : "")?>">
                <a href="dashboard.php"><i class="fad fa-home"></i>Tableau de bord</a>
            </li>
            <li class="nav-item <?php echo ($page == "Modifier votre profile" ? "active" : "")?>">
                <a href="edit-profile.php"><i class="fad fa-user-edit"></i>Modifier votre profile</a>
            </li>
            <li class="nav-item <?php echo ($page == "Votre CV" ? "active" : "")?>">
                <a href="cv.php"><i class="fad fa-file-alt"></i>Votre CV</a>
            </li>
            <li class="nav-item <?php echo ($page == "Vos candidatures" ? "active" : "")?>">
                <a href="candidatures.php"><i class="fad fa-briefcase"></i>Vos candidatures</a>
            </li>
            <li class="nav-item <?php echo ($page == "Vos offres favorites" ? "active" : "")?>">
                <a href="bookmarked.php"><i class="fad fa-bookmark"></i>Vos offres favorites</a>
            </li>
            <form method="post">   
                    <li class="nav-item logout">
                        <a><button name="logout" class="p-0 border-0 bg-transparent"><i class="fad fa-power-off"></i>Se déconnecter</button></a>
                    </li>
            </form>
        </ul>
    </div>
</div>