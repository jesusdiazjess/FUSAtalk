<?php require("inc/head.php"); ?>

<?php 

session_start();

// if(isset($_COOKIE['user_id'])){
//     header("location: index.php");
// }else{
//     echo "nOT set";
// }
if(isset($_COOKIE['user_id']) || isset($_COOKIE['user_email']) || isset($_SESSION['user_id']) || isset($_SESSION['email'])){
    header("location: ./index.php");
}

?>

<?php require("inc/nav2.php"); ?>


<div class="section">
  <div class="forms">
    <div class="signup-form">

   <!-- Include Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<form action="./logic/signup.php" method="post" class="form-group" enctype="multipart/form-data">
<div class="head">
    <img src="FUSAtalk-webp/FUSAtalkC.webp" alt="Logo" class="logo">
    <h3>Create Account</h3>
</div>
<style>
  .head {
    text-align: center; /* Centers both logo and heading */
    margin-bottom: 20px; /* Adds space below the heading */
}

.logo {
    width: 150px; /* Adjust logo size */
    height: 150px;
    display: block; /* Ensures logo is centered above the heading */
    margin: 0 auto; /* Centers the logo horizontally */
}

h3 {
    font-size: 24px; /* Adjust the size of the heading */
    margin-top: 10px; /* Adds space above the heading */
}

</style>

    <?php if(isset($_GET['err'])){?>
        <div class="alert alert-danger" style="font-weight:450;"><small><?php echo $_GET['err']; ?></small></div>
    <?php }else if(isset($_GET['msg'])){?>
        <div class="alert alert-success acctcreated" style="font-weight:450;"><small><?php echo $_GET['msg']; ?></small></div>
    <?php }?>
    
    <!-- Profile Picture Upload -->
    <div class="profile-pic-upload mt-2">
        <label for="fileupload">Upload a Profile Picture:</label>
        <input type="file" name="fileupload" class="fileupload form-control" id="fileupload" onchange="previewImage();">
        <!-- Preview Image -->
        <div id="preview-container" style="margin-top: 10px; display:none; text-align: center;">
            <img id="preview" src="" alt="Profile Picture Preview" style="max-width: 100px; max-height: 100px; border-radius: 50%; display: inline-block;">
        </div>
    </div>

    <input type="text" placeholder="Username" name="username" class="form-control inp-username mt-2">

    <input type="email" placeholder="Email Address" name="email" class="form-control inp-email mt-2">

    <!-- Password Input with Eye Icon -->
    <div class="password-container mt-2" style="position: relative;">
    <input type="password" placeholder="Password" name="pwd" class="form-control inp-pwd" id="password" oninput="toggleEyeIcon();">
    <span id="eye-icon" class="fas fa-eye" onclick="togglePassword();" style="cursor: pointer; position: absolute; right: 15px; top: 12px; color: black; display: none;"></span>
</div>

<script>
    // Function to toggle the visibility of the eye icon based on input in the password field
    function toggleEyeIcon() {
        const passwordField = document.getElementById("password");
        const eyeIcon = document.getElementById("eye-icon");

        // Show the eye icon if the password field is not empty
        if (passwordField.value !== "") {
            eyeIcon.style.display = "block";
        } else {
            eyeIcon.style.display = "none";
        }
    }

    // Function to toggle the password visibility when the eye icon is clicked
    function togglePassword() {
        const passwordField = document.getElementById("password");
        const eyeIcon = document.getElementById("eye-icon");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    }
</script>


    <br>
    <input type="submit" name="signupbtn" class="btn btn-info mt-2 btn-block signupbtn">

    <style>
    .create-account-link {
        text-decoration: underline;
        color: white;
        text-underline-offset: 3px;
        text-decoration-color: white;
        transition: all 0.3s ease-in-out;
    }
    .create-account-link:hover {
        color: white; /* Changes the text color on hover */
        text-decoration-color: white; /* Changes the underline color on hover */
    }
</style>

<h3 style="font-size: 14px; text-align: center;">
Already have an account? 
    <a href="login.php" class="create-account-link" onclick="showLoader(event)">Log In</a>
</h3>

</form>

<script>
function previewImage() {
    const file = document.getElementById("fileupload").files[0];
    const reader = new FileReader();

    reader.onload = function (e) {
        const preview = document.getElementById("preview");
        const previewContainer = document.getElementById("preview-container");

        previewContainer.style.display = "block"; // Show the preview container
        preview.src = e.target.result; // Set the preview image source to the uploaded file
    };

    if (file) {
        reader.readAsDataURL(file); // Read the file as a Data URL
    }
}

function togglePassword() {
    const passwordField = document.getElementById("password");
    const eyeIcon = document.getElementById("eye-icon");

    if (passwordField.type === "password") {
        passwordField.type = "text";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
    } else {
        passwordField.type = "password";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
    }
}
</script>


<script>
function previewImage() {
    const file = document.getElementById("fileupload").files[0];
    const reader = new FileReader();

    reader.onload = function (e) {
        const preview = document.getElementById("preview");
        const previewContainer = document.getElementById("preview-container");

        previewContainer.style.display = "block"; // Show the preview container
        preview.src = e.target.result; // Set the preview image source to the uploaded file
    };

    if (file) {
        reader.readAsDataURL(file); // Read the file as a Data URL
    }
}
</script>


    </div>
  </div>
</div>

<script>
    setTimeout(() => {
        let alertmsg = document.querySelector(".acctcreated");
        alertmsg.style.display = "none";
        window.location = "login.php";
    }, 2000);
</script>

<!-- <script src="./js/jquery.js"></script> -->
<!-- <script src="./js/insert_data.js"></script> -->
<?php require("inc/footer2.php"); ?>
