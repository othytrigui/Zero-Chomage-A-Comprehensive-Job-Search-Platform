$(document).ready(function() {

    // Register form

    $('#register_result, #login_result').fadeOut('slow');
    
    $(".register").submit(function(e) {
        e.preventDefault();
        var acc_type = $(".register input[type=radio]:checked").val();
        var email = $(".register #email").val();
        var password = $(".register #password").val();
        var password2 = $(".register #password2").val();
        var registerSubmit = $(".register #submit").val();

        $("#register_result").load("includes/functions.php", {
            acc_type : acc_type,
            email : email,
            password : password,
            password2 : password2,
            registerSubmit : registerSubmit
        });
    });

    // Login form

    $(".login").submit(function(e) {
        e.preventDefault();

        var url_string = window.location.href;
        var url = new URL(url_string);
        var returnurl = url.searchParams.get("return");

        var email = $(".login #email").val();
        var password = $(".login #password").val();
        var loginSubmit = $(".login #submit").val();

        $("#login_result").load("includes/functions.php", {
            email : email,
            password : password,
            loginSubmit : loginSubmit,
            returnurl : returnurl
        });
    });

    // Get logo url

    $('.upload-profile-photo .file-upload input').on('change', function(){
        var curElement = $(this).parent().parent().find('img');
        var reader = new FileReader();
        reader.onload = function (e) {
            curElement.attr('src', e.target.result);
        };
        reader.readAsDataURL(this.files[0]);
    });

    tinymce.init({
        selector: 'textarea#offre_body'
    });

    // Delete job form

    $( ".delete_job" ).each(function(index) {
        var id = $(this).find("#id_job").val();
        $(this).find("#delete_job").click(function(e) {
            e.preventDefault();
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'custom',
                }
            });
            swalWithBootstrapButtons.fire({
                    title: "Êtes-vous sûr de supprimer cette offre?",
                    text: "Vous ne pourrez pas revenir en arrière!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "<form class='confirm_delete' method='post'><input type='text' name='idjob' class='d-none' value='"+id+"'><button type='submit' name='confirmDelete' class='bg-transparent p-0 border-0' style='color:inherit'>Oui</button></form>",
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "Annuler"
            });
        });
    });

    // Cv uploader

    document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
        const dropZoneElement = inputElement.closest(".drop-zone");
      
        dropZoneElement.addEventListener("click", (e) => {
          inputElement.click();
        });
        dropZoneElement.querySelector(".drop-zone__input").onclick = function () {
          this.value = null;
          dropZoneElement.querySelector(".drop-zone__thumb").remove();
        };

        inputElement.addEventListener("change", (e) => {

          if (inputElement.files.length) {
            updateThumbnail(dropZoneElement, inputElement.files[0]);
          }
        });
      
        dropZoneElement.addEventListener("dragover", (e) => {
          e.preventDefault();
          dropZoneElement.classList.add("drop-zone--over");
        });
      
        ["dragleave", "dragend"].forEach((type) => {
          dropZoneElement.addEventListener(type, (e) => {
            dropZoneElement.classList.remove("drop-zone--over");
          });
        });
      
        dropZoneElement.addEventListener("drop", (e) => {
          e.preventDefault();
      
          if (e.dataTransfer.files.length) {
            inputElement.files = e.dataTransfer.files;
            updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
          }
      
          dropZoneElement.classList.remove("drop-zone--over");
        });
    });
      
    function updateThumbnail(dropZoneElement, file) {
        let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");
      
        if (dropZoneElement.querySelector(".drop-zone__prompt")) {
          dropZoneElement.querySelector(".drop-zone__prompt").remove();
        }
      
        if (!thumbnailElement) {
          thumbnailElement = document.createElement("div");
          thumbnailElement.classList.add("drop-zone__thumb");
          dropZoneElement.appendChild(thumbnailElement);
        }
      
        thumbnailElement.dataset.label = file.name;
    }

    $('.save_cv').attr('disabled','true');
    $('.drop-zone__input').change(function(){
        if (this.files[0].size !== 0) {
            $('.save_cv').removeAttr('disabled'); 
        }
        else {
            $('.save_cv').attr('disabled','true');
        }
    });

    // Apply buttons

    $(".applyJobForm").submit(function(e) {
        e.preventDefault();
        var applysubmit = $(".applyJobForm .apply").val();
        var url = $(".applyJobForm #url").val();
        var jobid = $(".applyJobForm #jobid").val();

        $("#job_result").load("includes/functions.php", {
            applysubmit : applysubmit,
            url : url,
            jobid : jobid
        });
    });

    // Delete candidature

    $( ".delete_candidature" ).each(function(index) {
      var id = $(this).find("#id_job").val();
      $(this).find("#delete_candidature").click(function(e) {
          e.preventDefault();
          const swalWithBootstrapButtons = Swal.mixin({
              customClass: {
                  confirmButton: 'custom',
              }
          });
          swalWithBootstrapButtons.fire({
                  title: "Êtes-vous sûr de supprimer cette candidature?",
                  text: "Vous ne pourrez pas revenir en arrière!",
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonText: "<form class='confirm_delete_candidature' method='post'><input type='text' name='idjob' class='d-none' value='"+id+"'><button type='submit' name='confirmDeleteCandidature' class='bg-transparent p-0 border-0' style='color:inherit'>Oui</button></form>",
                  confirmButtonColor: "#3085d6",
                  cancelButtonColor: "#d33",
                  cancelButtonText: "Annuler"
          });
      });
    });

    // Bookmark buttons

    

    $(".saveJobForm").submit(function(e) {
      e.preventDefault();
      var savesubmit = $(".saveJobForm .save").val();
      var url = $(".saveJobForm #url").val();
      var jobid = $(".saveJobForm #jobid").val();
      
      $("#job_result").load("includes/functions.php", {
          savesubmit : savesubmit,
          url : url,
          jobid : jobid
      });
    });

});