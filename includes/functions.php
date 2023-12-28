<?php

$website_url = "http://localhost/myproject2/";
session_start();

include "db.php";

function e($val) {
	global $conn;
	return mysqli_real_escape_string($conn, trim($val));
}

function getCitiesList() {
    global $conn;
    $query = "SELECT ville FROM cities";
    $rs = mysqli_query($conn, $query);
    if (mysqli_num_rows($rs) > 0) {
        while($row = mysqli_fetch_assoc($rs)) {
            echo "<option value='".$row['ville']."'>".$row['ville']."</option>";
        }
    }
}

function getCategoriesList() {
    global $conn;
    $query = "SELECT DISTINCT categorie FROM entreprise_infos";
    $rs = mysqli_query($conn, $query);
    if (mysqli_num_rows($rs) > 0) {
        while($row = mysqli_fetch_assoc($rs)) {
            echo "<option value='".$row['categorie']."'>".$row['categorie']."</option>";
        }
    }
}

function getUserByEmail($email) {
    global $conn;
    $query = "SELECT * FROM users WHERE email='$email';";
    $res = mysqli_query($conn,$query);
    if (mysqli_num_rows($res) > 0)
        return true;
}

function register() {
    global $conn;
    $account_type = e($_POST['acc_type']);
	$email       =  e($_POST['email']);
	$password_1  =  e($_POST['password']);
	$password_2  =  e($_POST['password2']);

    if (empty($email)) {
        $message = "Veuillez entrez votre email";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Format d'email invalide";
    } else {
        if (getUserByEmail($email) == true) {
            $message = "L'email dejà existe dans la base de données";
        } else {
            if (empty($password_1)) { 
                $message = "Veuillez entrez votre mot de passe";
            } else {
                if(strlen($password_1) < 8) {
                    $message = "Votre mot de passe doit comporter 8 caractères minimum";
                } else {
                    if ($password_1 != $password_2) {
                        $message = "Les deux mots de passes ne corresponds pas";
                    } else {
                        $query = "INSERT INTO users (account_type, email, password) 
                                        VALUES('$account_type', '$email', '$password_1')";
                        mysqli_query($conn, $query);
                        if($account_type == "Candidat") {
                            $query2 = "INSERT INTO candidat_infos(candidat_id) SELECT id FROM users WHERE email = '$email'";
                        } else if($account_type == "Entreprise") {
                            $query2 = "INSERT INTO entreprise_infos(entreprise_id) SELECT id FROM users WHERE email = '$email'";
                        }
                        mysqli_query($conn, $query2);
                        $message = "<script type='text/javascript'>window.location.href = 'connexion.php'</script>";
                    }
                }
            }
        }
    }
    echo "<script>
    $('#register_result').fadeIn('slow').delay(3000).fadeOut('slow');
    </script>
    <div class='error_msg'>".$message."</div>";  
}

if (isset($_POST['registerSubmit'])) {
    register();
}

function login() {
    $message = '';
	global $conn;
	$email = e($_POST['email']);
	$password = e($_POST['password']);
	if (empty($email)) {
		$message = "Veuillez entrez votre email";
	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Format d'email invalide";
    } else {
        if (empty($password)) {
            $message = "Veuillez entrez votre mot de passe";
        } else {
            $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
            $results = mysqli_query($conn, $query);
            if (mysqli_num_rows($results) > 0) {
                $logged_in_user = mysqli_fetch_assoc($results);
                if ($logged_in_user['account_type'] == 'Candidat') {
                    $_SESSION['user'] = $logged_in_user;
                    $redirect_url = "candidat/dashboard.php";
                } else if($logged_in_user['account_type'] == 'Entreprise') {
                    $_SESSION['user'] = $logged_in_user;
                    $redirect_url = "entreprise/dashboard.php";
                } else if($logged_in_user['account_type'] == 'Admin') {
                    $_SESSION['user'] = $logged_in_user;
                    $redirect_url = "admin/dashboard.php";
                }
                if($_POST['returnurl'] != "") {
                    $returnurl = $_POST['returnurl'];
                    $redirect_url = $returnurl;
                }
                $message = "<script type='text/javascript'>window.location.href = '".$redirect_url."'</script>";
            } else {
                $message = "Email ou / et mot de passe incorrectes";
            }
        }
    }
    echo "<script>
    $('#login_result').fadeIn('slow').delay(3000).fadeOut('slow');
    </script>
    <div class='error_msg'>".$message."</div>";
}

if (isset($_POST['loginSubmit'])) {
    login();
}

function isLoggedIn(){
	if (isset($_SESSION['user'])) {
		return true;
	} else {
		return false;
	}
}

if(isset($_POST["logout"])) {
    logout();
}

function logout() {
    global $website_url;
    session_destroy();
	unset($_SESSION['user']);
	header("Location: {$website_url}connexion.php");
}

function getEntrepriseInfo($info) {
    global $conn;
    $query = "SELECT $info FROM entreprise_infos WHERE entreprise_id = ".$_SESSION['user']['id'];
    if($info == "email" || $info == "password") {
        $query = "SELECT $info FROM users WHERE id = ".$_SESSION['user']['id'];
    }
    $rs = mysqli_query($conn, $query);
    $rs_get = mysqli_fetch_assoc($rs);
    return $rs_get[$info];
}

function updateEntrepriseInfo() {
    global $conn;
    $allowed = array('gif', 'png', 'jpg');

    $company_logo = $_FILES["company_logo"]["name"];
    $temp_company_logo = $_FILES["company_logo"]["tmp_name"];
    $folder = "../assets/images/companies_logos/".$company_logo;
    $ext = pathinfo($company_logo, PATHINFO_EXTENSION);

    $company_name = e($_POST['company_name']);
    $username = e($_POST['username']);
    $phone = e($_POST['phone']);
    $address = e($_POST['address']);
    $category = e($_POST['category']);
    $about_us = e($_POST['about_us']);
    $current_password = e($_POST['current_password']);
    $new_password = e($_POST['new_password']);
    $new_password2 = e($_POST['new_password2']);
    
    if(!in_array($ext, $allowed) && $_FILES['company_logo']['size'] != 0) {
        $_SESSION["error"] = "Veuillez sélectionner une image valide. seuls les types gif, jpg, png sont autorisés.";
    } else {
        move_uploaded_file($temp_company_logo, $folder);
        if(empty($company_name)) {
            $_SESSION["error"] = "Veuillez entrer le nom de l'entreprise.";
        } else {
            if(!empty($phone) && !preg_match('/^[0-9]{10}+$/', $phone)) {
                $_SESSION["error"] = "Veuillez entrer un numéro de téléphone valide";
            } else {
                if(empty($address)) {
                    $_SESSION["error"] = "Veuillez entrer votre adresse.";
                } else {
                    if(empty($category)) {
                        $_SESSION["error"] = "Veuillez entrer la categorie de votre entreprise.";
                    } else {
                        if(empty($current_password) && (!empty($new_password) || !empty($new_password2))) {
                            $_SESSION["error"] = "Vous devez saisir l\'ancien mot de passe pour changer votre mot de passe.";
                        } else {
                            if(!empty($current_password) && ($current_password != getEntrepriseInfo("password"))) {
                                $_SESSION["error"] = "Mot de passe actuel incorrect.";
                            } else {
                                if(!empty($current_password) && (empty($new_password) && empty($new_password2))) {
                                    $_SESSION["error"] = "Le nouveau mot de passe ne peut pas être vide.";
                                } else {
                                    if(($new_password != $new_password2)) {
                                        $_SESSION["error"] = "Les deux mots de passes ne corresponds pas.";
                                    } else {
                                        $query = "UPDATE entreprise_infos SET name = '$company_name', username = '$username', phone = '$phone', adresse = '$address', categorie = '$category', a_propos = '$about_us' WHERE entreprise_id = ".$_SESSION['user']['id'];
                                        if(!empty($company_logo)) {
                                            $query = "UPDATE entreprise_infos SET logo = '$company_logo', name = '$company_name', username = '$username', phone = '$phone', adresse = '$address', categorie = '$category', a_propos = '$about_us' WHERE entreprise_id = ".$_SESSION['user']['id'];
                                        }
                                        mysqli_query($conn, $query);
                                        if(!empty($current_password) && !empty($new_password) && !empty($new_password2)) {
                                            $query2 = "UPDATE users SET password = '$new_password' WHERE id = ".$_SESSION['user']['id'];
                                            mysqli_query($conn, $query2);
                                        }
                                        $_SESSION["success"] = "Les modifications ont été enregistrées avec succès";
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    header("Location: ../entreprise/edit-profile.php");
}

if(isset($_POST["save_infos"])) {
    updateEntrepriseInfo();
}

function addJob() {
    global $conn;

    $_SESSION["title"] = e($_POST['offre_title']);
    $_SESSION["poste"] = e($_POST['poste']);
    $_SESSION["location"] = e($_POST['location']);
    $_SESSION["contrat"] = e($_POST['contrat']);
    $_SESSION["time"] = e($_POST['time']);
    $_SESSION["study_level"] = e($_POST['study_level']);
    $_SESSION["experience"] = e($_POST['experience']);
    $_SESSION["salary"] = e($_POST['salary']);
    $_SESSION["datefin"] = e($_POST['datefin']);
    $_SESSION["offre_body"] = e($_POST['offre_body']);
    $id = getEntrepriseInfo('entreprise_id');

    if(empty($_SESSION["title"])) {
        $_SESSION["error"] = "Veuillez entrer le titre de l\'offre.";
    } else {
        if(empty($_SESSION["poste"])) {
            $_SESSION["error"] = "Veuillez spécifier la poste demandée dans l\'offre.";
        } else {
            if(empty($_SESSION["location"])) {
                $_SESSION["error"] = "Veuillez entrer la location.";
            } else {
                if($_SESSION["contrat"] == "Type de contrat") {
                    $_SESSION["error"] = "Veuillez spécifier un type de contrat.";
                } else {
                    if($_SESSION["study_level"] == "Niveau d\'etude") {
                        $_SESSION["error"] = "Veuillez spécifier le niveau d\'etude demandé.";
                    } else {
                        if($_SESSION["experience"] == "Niveau d\'experience") {
                            $_SESSION["error"] = "Veuillez spécifier le niveau d\'experience demandé.";
                        } else {
                            if(empty($_SESSION["salary"])) {
                                $_SESSION["error"] = "Veuillez entrer le salaire.";
                            } else {
                                if(empty($_SESSION["datefin"])) {
                                    $_SESSION["error"] = "Veuillez entrer la date de fin de l\'offre.";
                                } else {
                                    if(empty($_SESSION["offre_body"])) {
                                        $_SESSION["error"] = "Le descriptif de l\'offre ne peut pas être vide.";
                                    } else {
                                        $query= "INSERT INTO jobs(titre, poste, localite, type_contrat, duree, study_level, experience, salaire, datefin, descriptif, status, publish_date, id_entreprise) VALUES('".$_SESSION['title']."', '".$_SESSION['poste']."', '".$_SESSION['location']."', '".$_SESSION['contrat']."', '".$_SESSION['time']."', '".$_SESSION['study_level']."', '".$_SESSION['experience']."', '".$_SESSION['salary']."', '".$_SESSION['datefin']."', '".$_SESSION['offre_body']."', 'En cours de validation', CURRENT_DATE(), $id)";
                                        mysqli_query($conn, $query);
                                        $_SESSION["job_added_success"] = "Votre offre a été sauvegarder avec succès et elle est en cours de validation.";
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    header("Location: ../entreprise/add-job.php");
    if(isset($_SESSION['job_added_success'])) {
        header("Location: ../entreprise/manage-jobs.php");
    }
}

if(isset($_POST["add-job"])) {
    addJob();
}

function getJobsByEntreprise() {
    global $conn;
    $id = getEntrepriseInfo('entreprise_id');
    $sql = "SELECT * FROM jobs WHERE id_entreprise = $id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo '
            <tr class="job-items">
                <td class="title">
                    <h5><a target="_blank" href="../view_job.php?id='.$row['id'].'">'.$row['titre'].'</a></h5>
                    <div class="info">
                        <span class="office-location"><a target="_blank" href="../jobs.php?localite='.$row['localite'].'"><i class="far fa-map-marker-alt"></i>'.$row['localite'].'</a></span>
                        <span class="job-type full-time"><a target="_blank" href="../jobs.php?duree='.$row['duree'].'"><i class="far fa-clock"></i>'.$row['duree'].'</a></span>
                    </div>
                </td>
                <td class="poste">'.$row['poste'].'</td>
                <td class="deadline">'.$row['datefin'].'</td>
                <td class="status">'.$row['status'].'</td>
                <td class="action">
                    <a target="_blank" href="../view_job.php?id='.$row['id'].'" class="preview" title="Preview"><i class="far fa-eye"></i></a>
                    <a href="edit-job.php?id='.$row['id'].'" class="edit" title="Edit"><i class="far fa-edit"></i></a>
                    <form class="delete_job" method="post"><input id="id_job" class="d-none" value="'.$row['id'].'"><a class="remove" title="Delete"><button id="delete_job" type="submit"><i class="far fa-trash-alt"></i></button></a></form>
                </td>
            </tr>
            ';
        }
    } else {
        echo '<tr><td colspan="5">Vous n\'avez pas encore d\'offres.</td></tr>';
    }
}

if(isset($_POST['confirmDelete'])) {
    $id = e($_POST['idjob']);
    $query= "DELETE FROM jobs WHERE id = $id";
    mysqli_query($conn, $query);
    $_SESSION["job_deleted"] = "L\'offre a été supprimée avec succès.";
}

function getJobsNumberById() {
    global $conn;
    $query = "SELECT count(*) as num FROM jobs WHERE id_entreprise = ".$_SESSION['user']['id'];
    $rs = mysqli_query($conn, $query);
    $rs_get = mysqli_fetch_assoc($rs);
    return $rs_get["num"];
}

function getTotalJobsNumber() {
    global $conn;
    $query = "SELECT count(*) as num FROM jobs";
    $rs = mysqli_query($conn, $query);
    $rs_get = mysqli_fetch_assoc($rs);
    return $rs_get["num"];
}

function getCandidatInfo($info) {
    global $conn;
    $query = "SELECT $info FROM candidat_infos WHERE candidat_id = ".$_SESSION['user']['id'];
    if($info == "email" || $info == "password") {
        $query = "SELECT $info FROM users WHERE id = ".$_SESSION['user']['id'];
    }
    $rs = mysqli_query($conn, $query);
    $rs_get = mysqli_fetch_assoc($rs);
    return $rs_get[$info];
}

function updateCandidatInfo() {
    global $conn;
    $allowed = array('gif', 'png', 'jpg');

    $profile_pic = $_FILES["profile_pic"]["name"];
    $temp_profile_pic = $_FILES["profile_pic"]["tmp_name"];
    $folder = "../assets/images/candidat_profiles/".$profile_pic;
    $ext = pathinfo($profile_pic, PATHINFO_EXTENSION);

    $full_name = e($_POST['full_name']);
    $username = e($_POST['username']);
    $phone = e($_POST['phone']);
    $address = e($_POST['address']);
    $birthday = e($_POST['birthday']);
    $a_propos = e($_POST['a_propos']);
    $facebook = e($_POST['facebook']);
    $twitter = e($_POST['twitter']);
    $linkedin = e($_POST['linkedin']);
    $current_password = e($_POST['current_password']);
    $new_password = e($_POST['new_password']);
    $new_password2 = e($_POST['new_password2']);
    
    if(!in_array($ext, $allowed) && $_FILES['profile_pic']['size'] != 0) {
        $_SESSION["error"] = "Veuillez sélectionner une photo de profile valide. seuls les types gif, jpg, png sont autorisés.";
    } else {
        move_uploaded_file($temp_profile_pic, $folder);
        if(empty($full_name)) {
            $_SESSION["error"] = "Veuillez entrer votre nom.";
        } else {
            if(!empty($phone) && !preg_match('/^[0-9]{10}+$/', $phone)) {
                $_SESSION["error"] = "Veuillez entrer un numéro de téléphone valide";
            } else {
                if(empty($birthday)) {
                    $_SESSION["error"] = "Veuillez entrer votre date de naissance.";
                } else {
                    if(empty($address)) {
                        $_SESSION["error"] = "Veuillez entrer votre adresse.";
                    } else {
                        if(empty($current_password) && (!empty($new_password) || !empty($new_password2))) {
                            $_SESSION["error"] = "Vous devez saisir l\'ancien mot de passe pour changer votre mot de passe.";
                        } else {
                            if(!empty($current_password) && ($current_password != getCandidatInfo("password"))) {
                                $_SESSION["error"] = "Mot de passe actuel incorrect.";
                            } else {
                                if(!empty($current_password) && (empty($new_password) && empty($new_password2))) {
                                    $_SESSION["error"] = "Le nouveau mot de passe ne peut pas être vide.";
                                } else {
                                    if(($new_password != $new_password2)) {
                                        $_SESSION["error"] = "Les deux mots de passes ne corresponds pas.";
                                    } else {
                                        $query = "UPDATE candidat_infos SET full_name = '$full_name', username = '$username', phone = '$phone', adresse = '$address', birthday = '$birthday', facebook = '$facebook', twitter = '$twitter', linkedin = '$linkedin', a_propos = '$a_propos' WHERE candidat_id = ".$_SESSION['user']['id'];
                                        if(!empty($profile_pic)) {
                                            $query = "UPDATE candidat_infos SET profil_pic = '$profile_pic', full_name = '$full_name', username = '$username', phone = '$phone', adresse = '$address', birthday = '$birthday', facebook = '$facebook', twitter = '$twitter', linkedin = '$linkedin', a_propos = '$a_propos' WHERE candidat_id = ".$_SESSION['user']['id'];
                                        }
                                        mysqli_query($conn, $query);
                                        if(!empty($current_password) && !empty($new_password) && !empty($new_password2)) {
                                            $query2 = "UPDATE users SET password = '$new_password' WHERE id = ".$_SESSION['user']['id'];
                                            mysqli_query($conn, $query2);
                                        }
                                        $_SESSION["success"] = "Les modifications ont été enregistrées avec succès";
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    header("Location: ../candidat/edit-profile.php");
}

if(isset($_POST["save_infos_can"])) {
    updateCandidatInfo();
}

function UploadCV() {
    global $conn;
    $allowed = array('doc', 'docx', 'pdf');

    $cv = $_FILES["cv"]["name"];
    $temp_cv = $_FILES["cv"]["tmp_name"];
    $folder = "../assets/CVs/".$cv;
    $ext = pathinfo($cv, PATHINFO_EXTENSION);

    if(!in_array($ext, $allowed) && $_FILES['cv']['size'] != 0) {
        $_SESSION["error"] = "Veuillez sélectionner un cv de format valide. seuls les types doc, docx et pdf sont autorisés.";
    } else {
        if($_FILES['cv']['size'] > 2097152) {
            $_SESSION["error"] = "Le téléchargement a échoué en raison d\'une limite de taille (2MB max)";
        } else {
            if(!empty($cv)) {
                move_uploaded_file($temp_cv, $folder);
                $query = "UPDATE candidat_infos SET cv = '$cv' WHERE candidat_id = ".$_SESSION['user']['id'];
                mysqli_query($conn, $query);
                $_SESSION["success"] = "Votre cv a été téléchargé avec succès.";
            } 
        }
    }
    header("Location: ../candidat/cv.php");
}

if (isset($_POST["save_cv"])) {
    UploadCV();
}

if (isset($_POST["delete_cv"])) {
    global $conn;
    $query = "UPDATE candidat_infos SET cv = '' WHERE candidat_id = ".$_SESSION['user']['id'];
    mysqli_query($conn, $query);
    $_SESSION["success"] = "Votre cv a été supprimé avec succès.";
    header("Location: ../candidat/cv.php");
}

if(isset($_POST["applysubmit"])) {
    $url = e($_POST['url']);
    if(!isset($_SESSION['user'])) {
        $result = "<script type='text/javascript'>window.location.href = '".$website_url."connexion.php?return=".$url."'</script>";
    } elseif((isset($_SESSION['user']) && $_SESSION['user']['account_type'] == 'Candidat')) {
        $user_id = getCandidatInfo("candidat_id");
        $job_id = e($_POST["jobid"]);
        $checkIfAlreadyApplied = mysqli_query($conn , "SELECT * FROM candidatures WHERE id_job = $job_id AND id_candidat = $user_id");
        $checkIfLimitPassed = mysqli_query($conn , "SELECT * FROM `jobs` WHERE `datefin`<CURDATE() AND id = $job_id");
        if(mysqli_num_rows($checkIfAlreadyApplied) > 0) {
            $result = "<script type='text/javascript'>Swal.fire(
                'Error!',
                'Vous avez déjà postulé pour cette offre.',
                'error'
            );</script>";
        } elseif(mysqli_num_rows($checkIfLimitPassed) > 0) {
            $result = "<script type='text/javascript'>Swal.fire(
                'Error!',
                'Cette offre est dèjà exprirée.',
                'error'
            );</script>";
        } else {
            $query = "INSERT INTO candidatures VALUES($job_id, $user_id)";
            mysqli_query($conn, $query);
            $result = "<script type='text/javascript'>Swal.fire(
                'Félicitations!',
                'Votre candidature a été envoyée avec succès.',
                'success'
            );</script>";
        }
    }
    echo $result;
}

function getCandidaturesByCandidat() {
    global $conn;
    $id = getCandidatInfo("candidat_id");
    $query = "SELECT * FROM entreprise_infos a JOIN (SELECT id_entreprise FROM jobs WHERE id IN (SELECT id_job FROM candidatures WHERE id_candidat = $id)) b ON entreprise_id = id_entreprise";
    $rs = mysqli_query($conn, $query);
    $query2 = "SELECT * FROM jobs WHERE id IN (SELECT id_job FROM candidatures WHERE id_candidat = $id)";
    $rs2 = mysqli_query($conn, $query2);
    if (mysqli_num_rows($rs) > 0) {
        while($rs_get_entreprise_info = mysqli_fetch_assoc($rs) and $rs_get_job_info = mysqli_fetch_assoc($rs2)) {
            echo '<div class="job-list">
                <div class="thumb">
                    <a href="../view_entreprise.php?id='.$rs_get_entreprise_info['entreprise_id'].'" target="_blank">
                        <img src="../assets/images/companies_logos/'.$rs_get_entreprise_info['logo'].'" class="img-fluid">
                    </a>
                </div>
                <div class="body">
                    <div class="content">
                    <h4><a href="../view_job.php?id='.$rs_get_job_info['id'].'" target="_blank">'.$rs_get_job_info['titre'].'</a></h4>
                        <div class="info">
                            <span class="company"><a href="../view_entreprise.php?id='.$rs_get_entreprise_info['entreprise_id'].'" target="_blank"><i class="far fa-briefcase"></i>'.$rs_get_entreprise_info['name'].'</a></span>
                            <span class="office-location"><a href="../jobs.php?localite='.$rs_get_job_info['localite'].'" target="_blank"><i class="far fa-map-marker-alt"></i>'.$rs_get_job_info['localite'].'</a></span>
                            <span class="job-type full-time"><a href="../jobs.php?duree='.$rs_get_job_info['duree'].'" target="_blank"><i class="far fa-clock"></i>'.$rs_get_job_info['duree'].'</a></span>
                        </div>
                    </div>
                    <div class="more">
                        <form class="delete_candidature" method="post"><input id="id_job" class="d-none" value="'.$rs_get_job_info['id'].'"><button id="delete_candidature" type="submit"><a class="bookmark-remove"><i class="far fa-times"></i></a></button></form>
                        <p class="deadline">Date fin d\'offre: '.$rs_get_job_info['datefin'].'</p>
                    </div>
                </div>
            </div>';
        }
    } else {
        echo '<tr><td colspan="5">Vous n\'avez pas encore de candidatures.</td></tr>';
    }
}

function getCandidaturesNumberByCandidat() {
    global $conn;
    $query = "SELECT count(*) as num FROM candidatures WHERE id_candidat = ".$_SESSION['user']['id'];
    $rs = mysqli_query($conn, $query);
    $rs_get = mysqli_fetch_assoc($rs);
    return $rs_get["num"];
}

if(isset($_POST['confirmDeleteCandidature'])) {
    $id_job = e($_POST['idjob']);
    $id_candidat = getCandidatInfo("candidat_id");
    $query= "DELETE FROM candidatures WHERE id_job = $id_job AND id_candidat = $id_candidat";
    mysqli_query($conn, $query);
    $_SESSION["candidature_deleted"] = "La candidature a été supprimée avec succès.";
}

function checkIfJobAlreadySaved($job_id) {
    if(isset($_SESSION['user']) && $_SESSION['user']['account_type'] == 'Candidat') {
        global $conn;
        $user_id = getCandidatInfo("candidat_id");
        $checkIfAlreadySaved = mysqli_query($conn , "SELECT * FROM bookmarked WHERE id_job = $job_id AND id_candidat = $user_id");
        if(mysqli_num_rows($checkIfAlreadySaved) > 0) {
            return true;
        } else {
            return false;
        }
    }
}

if(isset($_POST["savesubmit"])) {
    $url = e($_POST['url']);
    if(!isset($_SESSION['user'])) {
        $result = "<script type='text/javascript'>window.location.href = '".$website_url."connexion.php?return=".$url."'</script>";
    } elseif((isset($_SESSION['user']) && $_SESSION['user']['account_type'] == 'Candidat')) {
        $user_id = getCandidatInfo("candidat_id");
        $job_id = e($_POST["jobid"]);
        if(checkIfJobAlreadySaved($job_id)) {
            $query = "DELETE FROM bookmarked WHERE id_job = $job_id AND id_candidat = $user_id";
            mysqli_query($conn, $query);
            $result = "<script type='text/javascript'>
            $('.saveJobForm i').removeClass('fas').addClass('far');
            $('.saveJobForm .save').removeClass('job-saved');
            </script>";
        } else {
            $query = "INSERT INTO bookmarked VALUES($job_id, $user_id)";
            mysqli_query($conn, $query);
            $result = "<script type='text/javascript'>
            $('.saveJobForm i').removeClass('far').addClass('fas');
            $('.saveJobForm .save').addClass('job-saved');
            </script>";
        }
    }
    echo $result;
}

function getBookmarkedJobsNumber() {
    global $conn;
    $query = "SELECT count(*) as num FROM bookmarked WHERE id_candidat = ".$_SESSION['user']['id'];
    $rs = mysqli_query($conn, $query);
    $rs_get = mysqli_fetch_assoc($rs);
    return $rs_get["num"];
}

function getBookmarkedJobs() {
    global $conn;
    $id = getCandidatInfo("candidat_id");
    $query = "SELECT * FROM entreprise_infos a JOIN (SELECT id_entreprise FROM jobs WHERE id IN (SELECT id_job FROM bookmarked WHERE id_candidat = $id)) b ON entreprise_id = id_entreprise";
    $rs = mysqli_query($conn, $query);
    $query2 = "SELECT * FROM jobs WHERE id IN (SELECT id_job FROM bookmarked WHERE id_candidat = $id)";
    $rs2 = mysqli_query($conn, $query2);
    if (mysqli_num_rows($rs) > 0) {
        while($rs_get_entreprise_info = mysqli_fetch_assoc($rs) and $rs_get_job_info = mysqli_fetch_assoc($rs2)) {
            echo '<div class="job-list">
                <div class="thumb">
                    <a href="../view_entreprise.php?id='.$rs_get_entreprise_info['entreprise_id'].'" target="_blank">
                        <img src="../assets/images/companies_logos/'.$rs_get_entreprise_info['logo'].'" class="img-fluid">
                    </a>
                </div>
                <div class="body">
                    <div class="content">
                    <h4><a href="../view_job.php?id='.$rs_get_job_info['id'].'" target="_blank">'.$rs_get_job_info['titre'].'</a></h4>
                        <div class="info">
                            <span class="company"><a href="../view_entreprise.php?id='.$rs_get_entreprise_info['entreprise_id'].'" target="_blank"><i class="far fa-briefcase"></i>'.$rs_get_entreprise_info['name'].'</a></span>
                            <span class="office-location"><a href="../jobs.php?localite='.$rs_get_job_info['localite'].'" target="_blank"><i class="far fa-map-marker-alt"></i>'.$rs_get_job_info['localite'].'</a></span>
                            <span class="job-type full-time"><a href="../jobs.php?duree='.$rs_get_job_info['duree'].'" target="_blank"><i class="far fa-clock"></i>'.$rs_get_job_info['duree'].'</a></span>
                        </div>
                    </div>
                    <div class="more">
                        <p class="deadline">Date fin d\'offre: '.$rs_get_job_info['datefin'].'</p>
                    </div>
                </div>
            </div>';
        }
    } else {
        echo '<tr><td colspan="5">Vous n\'avez pas encore d\'offres sauvegardeés.</td></tr>';
    }
}

function getTotalCandidatsNumber() {
    global $conn;
    $query = "SELECT count(*) as num FROM candidat_infos";
    $rs = mysqli_query($conn, $query);
    $rs_get = mysqli_fetch_assoc($rs);
    return $rs_get["num"];
}

function getEntrepriseCandidats() {
    global $conn;
    $id = getEntrepriseInfo('entreprise_id');
    $query = "select * from candidat_infos a JOIN (select id_candidat from candidatures where id_job IN (SELECT id from jobs where id_entreprise = $id)) b ON candidat_id = id_candidat";
    $rs = mysqli_query($conn, $query);
    $query2 = "SELECT id, titre FROM jobs a JOIN (select id_job from candidatures) b on id = id_job where id_entreprise = $id";
    $rs2 = mysqli_query($conn, $query2);
    $query3 = "select * from users a JOIN (select id_candidat from candidatures where id_job IN (SELECT id from jobs where id_entreprise = $id)) b ON id = id_candidat ORDER BY id DESC";
    $rs3 = mysqli_query($conn, $query3);
    if (mysqli_num_rows($rs) > 0) {
        while($rs_get_candidat_info = mysqli_fetch_assoc($rs) and $rs_get_job_info = mysqli_fetch_assoc($rs2) and $rs_get_candidat_email = mysqli_fetch_assoc($rs3)) {
            echo '
            <tr class="candidates-list">
                <td class="title">
                    <div class="thumb">
                        <img src="../assets/images/candidat_profiles/'.$rs_get_candidat_info['profil_pic'].'" class="img-fluid" alt="">
                    </div>
                    <div class="body">
                        <h5><a target="_blank" href="../view_candidat.php?id='.$rs_get_candidat_info['candidat_id'].'">'.$rs_get_candidat_info['full_name'].'</a></h5>
                        <div class="info">
                            <span><a target="_blank" href="tel:'.$rs_get_candidat_info['phone'].'"><i class="fal fa-phone"></i>'.$rs_get_candidat_info['phone'].'</a></span>
                            <span><i class="fal fa-map-marker-alt"></i>'.$rs_get_candidat_info['adresse'].'</span>
                        </div>
                    </div>
                </td>
                <td class="titre-job"><a target="_blank" href="../view_job.php?id='.$rs_get_job_info['id'].'">'.$rs_get_job_info['titre'].'</a></td>
                <td class="action">
                    <a target="_blank" href="../assets/CVs/'.$rs_get_candidat_info['cv'].'" class="download-cv" title="Télécharger CV"><i class="far fa-cloud-download"></i></a>
                    <a target="_blank" href="mailto:'.$rs_get_candidat_email['email'].'?subject=Offre d\'emploi:'.$rs_get_job_info['titre'].'" class="email" title="Envoyer un mail"><i class="far fa-envelope"></i></a>
                </td>
            </tr>
            ';
        }
    } else {
        echo '<tr><td colspan="5">Vous n\'avez pas encore de candidats.</td></tr>';
    }
}

function getEntrepriseCandidatsNumber() {
    global $conn;
    $query = "SELECT count(*) as num FROM (SELECT *, ROW_NUMBER() OVER(PARTITION BY id_candidat) rn FROM candidatures where id_job IN (SELECT id from jobs where id_entreprise = ".$_SESSION['user']['id'].")) a WHERE rn = 1";
    $rs = mysqli_query($conn, $query);
    $rs_get = mysqli_fetch_assoc($rs);
    return $rs_get["num"];
}

function getFilteredJobs() {
    global $conn;
    $filters = array();
    if (!empty($_GET['categorie'])) {
        $category = $_GET['categorie'];
        $filter[] = 'id_entreprise IN ( SELECT entreprise_id from entreprise_infos where categorie = "'.$category.'" )';
    }
    if (!empty($_GET['localite'])) {
        $localite = $_GET['localite'];
        $filters[] = 'localite = "'.$localite.'"';
    }
    if (!empty($_GET['type_contrat'])) {
        $type_contrat = $_GET['type_contrat'];
        $filters[] = 'type_contrat = "'.$type_contrat.'"';
    }
    if (!empty($_GET['duree'])) {
        $duree = $_GET['duree'];
        $filters[] = 'duree = "'.$duree.'"';
    }
    if (!empty($_GET['study_level'])) {
        $study_level = $_GET['study_level'];
        $filters[] = 'study_level = "'.$study_level.'"';
    }
    if (!empty($_GET['experience'])) {
        $experience = $_GET['experience'];
        $filters[] = 'experience = "'.$experience.'"';
    }
    if (!empty($_GET['salaryRange'])) {
        $salaryRange = explode(";", $_GET['salaryRange']);
        $min = $salaryRange[0];
        $max = $salaryRange[1];
        $filters[] = 'salaire between '.$min.' and '.$max;
    }
    $keywordsquery = "descriptif LIKE '%%'";
    if (!empty($_GET['keywords'])) {
        $queried = e($_GET['keywords']);
        $keys = explode(",", $queried);
        $keywords = array();
        foreach($keys as $k) {
            $keywords[] = "descriptif LIKE '%$k%'";
        }
        $keywordsquery = implode(' OR ', $keywords);
    }
    $filter = implode(' AND ', $filters);
    $query = "SELECT * FROM jobs WHERE ( $keywordsquery )";
    $query2 = "SELECT * FROM entreprise_infos a JOIN (SELECT id_entreprise FROM jobs WHERE ( $keywordsquery )) b ON entreprise_id = id_entreprise";
    if(count($filters) > 0) {
        $query = "SELECT * FROM jobs WHERE $filter AND ( $keywordsquery )";
        $query2 = "SELECT * FROM entreprise_infos a JOIN (SELECT id_entreprise FROM jobs WHERE $filter AND ( $keywordsquery )) b ON entreprise_id = id_entreprise";
    }
    $rs = mysqli_query($conn, $query);
    $rs2 = mysqli_query($conn, $query2);
    if (mysqli_num_rows($rs) > 0) {
        if(mysqli_num_rows($rs) == 1) {
            echo "<h4 class='jobs-listing-title'>Une offre trouvée</h4>";
        } else {
            echo "<h4 class='jobs-listing-title'>".mysqli_num_rows($rs)." offres trouvées</h4>";
        }
        while($rs_get_job_info = mysqli_fetch_assoc($rs) and $rs_get_entreprise_info = mysqli_fetch_assoc($rs2)) {
            echo '<div class="job-list">
            <div class="thumb">
                <a href="view_entreprise.php?id='.$rs_get_entreprise_info['entreprise_id'].'">
                    <img src="assets/images/companies_logos/'.$rs_get_entreprise_info["logo"].'" class="img-fluid">
                </a>
            </div>
            <div class="body">
                <div class="content">
                    <h4><a href="view_job.php?id='.$rs_get_job_info['id'].'">'.$rs_get_job_info['titre'].'</a></h4>
                    <div class="info">
                        <span class="company"><a href="view_entreprise.php?id='.$rs_get_entreprise_info['entreprise_id'].'"><i class="far fa-briefcase"></i>'.$rs_get_entreprise_info['name'].'</a></span>
                        <span class="office-location"><a href="jobs.php?localite='.$rs_get_job_info['localite'].'"><i class="far fa-map-marker-alt"></i>'.$rs_get_job_info['localite'].'</a></span>
                        <span class="job-type"><a href="jobs.php?duree='.$rs_get_job_info['duree'].'"><i class="far fa-clock"></i>'.$rs_get_job_info['duree'].'</a></span>
                    </div>
                </div>
                <div class="more">
                    <p class="deadline">Date fin d\'offre: '.$rs_get_job_info['datefin'].'</p>
                </div>
            </div> 
        </div>';
        }
    } else {
        echo 'Désolé, il n\'y a pas encore d\'offres avec ce filtrage. <a href="jobs.php">Voir toutes les offres.</a>';
    }
}

function getFilteredCandidats() {
    global $conn;
    $filters = array();
    if (!empty($_GET['age'])) {
        $age = explode(";", $_GET['age']);
        $min = $age[0];
        $max = $age[1];
        $filters[] = '(year(CURRENT_TIMESTAMP) - year(birthday) BETWEEN '.$min.' and '.$max.')';
    }
    if (!empty($_GET['name'])) {
        $name = $_GET['name'];
        $filters[] = 'full_name LIKE "%'.$name.'%"';
    }
    $filter = implode(' AND ', $filters);
    $query = "SELECT * FROM candidat_infos";
    if(count($filters) > 0) {
        $query = "SELECT * FROM candidat_infos WHERE $filter";
    }
    $rs = mysqli_query($conn, $query);
    if (mysqli_num_rows($rs) > 0) {
        if(mysqli_num_rows($rs) == 1) {
            echo "<h4 class='candidats-listing-title'>Un candidat trouvé</h4>";
        } else {
            echo "<h4 class='candidats-listing-title'>".mysqli_num_rows($rs)." candidats trouvés</h4>";
        }
        while($rs_get_candidat_info = mysqli_fetch_assoc($rs)) {
            echo '<div class="candidate">
            <div class="thumb">
                <a href="view_candidat.php?id='.$rs_get_candidat_info["candidat_id"].'">
                    <img src="assets/images/candidat_profiles/'.$rs_get_candidat_info["profil_pic"].'" class="img-fluid">
                </a>
            </div>
            <div class="body">
                <div class="content">
                    <h4><a href="view_candidat.php?id='.$rs_get_candidat_info["candidat_id"].'">'.$rs_get_candidat_info["full_name"].'</a></h4>
                    <div class="info">
                        <span><i class="fal fa-phone"></i>'.$rs_get_candidat_info["phone"].'</a></span>
                        <span><i class="far fa-map-marker-alt"></i>'.$rs_get_candidat_info["adresse"].'</span>
                    </div>
                </div>
                <div class="button-area">
                    <a href="view_candidat.php?id='.$rs_get_candidat_info["candidat_id"].'">Voir le profil</a>
                </div>
            </div>
        </div>';
        }
    } else {
        echo 'Désolé, il n\'y a pas encore de candidats avec ce filtrage. <a href="candidats.php">Voir toutes les candidats.</a>';
    }
}

function getgetFilteredEntreprises() {
    global $conn;
    $filters = array();
    if (!empty($_GET['categorie'])) {
        $category = $_GET['categorie'];
        $filters[] = 'categorie = "'.$category.'"';
    }
    if (!empty($_GET['localite'])) {
        $localite = $_GET['localite'];
        $filters[] = 'adresse LIKE "%'.$localite.'%"';
    }
    $filter = implode(' AND ', $filters);
    $query = "SELECT * FROM entreprise_infos";
    if(count($filters) > 0) {
        $query = "SELECT * FROM entreprise_infos WHERE $filter";
    }
    $rs = mysqli_query($conn, $query);
    if (mysqli_num_rows($rs) > 0) {
        if(mysqli_num_rows($rs) == 1) {
            echo "<h4 class='jobs-listing-title'>Une entreprise trouvée</h4>";
        } else {
            echo "<h4 class='jobs-listing-title'>".mysqli_num_rows($rs)." entreprises trouvées</h4>";
        }
        while($rs_get_entreprise_info = mysqli_fetch_assoc($rs)) {
            echo '<div class="job-list">
            <div class="thumb">
                <a href="view_entreprise.php?id='.$rs_get_entreprise_info['entreprise_id'].'">
                    <img src="assets/images/companies_logos/'.$rs_get_entreprise_info["logo"].'" class="img-fluid">
                </a>
            </div>
            <div class="body">
                <div class="content">
                    <h4><a href="view_entreprise.php?id='.$rs_get_entreprise_info['entreprise_id'].'">'.$rs_get_entreprise_info['name'].'</a></h4>
                    <div class="info">
                        <span><a href="entreprises.php?categorie='.$rs_get_entreprise_info['categorie'].'"><i class="far fa-tag"></i>'.$rs_get_entreprise_info['categorie'].'</a></span>
                        <span><i class="far fa-map-marker-alt"></i>'.$rs_get_entreprise_info['adresse'].'</span>
                    </div>
                </div>
            </div> 
        </div>';
        }
    } else {
        echo 'Désolé, il n\'y a pas encore d\'entreprises avec ce filtrage. <a href="entreprises.php">Voir toutes les entreprises.</a>';
    }
}