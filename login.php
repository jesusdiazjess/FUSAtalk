<?php require("inc/head.php"); ?>


<?php require("inc/nav2.php"); ?>

<?php 

if(isset($_COOKIE['user_id']) || isset($_COOKIE['user_email']) || isset($_SESSION['user_id']) || isset($_SESSION['email'])){
    header("location: ./index.php");
}

?>

<div class="section">
  <div class="forms">
    <div class="signup-form">
      <form action="./logic/login.php" method="post" class="form-group">
        <div class="head">
        <img src="FUSAtalk-webp/FUSAtalkC.webp" alt="Logo" class="logo">
          <h3>Welcome back</h3>

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

        </div>
        <?php if(isset($_GET['err'])){?>
            <div class="alert alert-danger" style="font-weight:450;"><small><?php echo $_GET['err']; ?></small></div>
        <?php }else if(isset($_GET['msg'])){?>
            <div class="alert alert-success acctcreated" style="font-weight:450;"><small><?php echo $_GET['msg']; ?></small></div>
        <?php }?>

        <input type="email" placeholder="Email" name="email" class="form-control inp-email mt-2">

        <!-- Add Font Awesome for Eye Icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Password Input and Eye Icon -->
<div class="input-group mt-2">
    <input type="password" placeholder="Password" name="pwd" class="form-control inp-pwd mt-2" id="password-input">
    <div class="input-group-append">
        <span class="input-group-text" id="eye-icon" style="cursor: pointer;">
            <i class="fas fa-eye"></i>
        </span>
    </div>
</div>

<script>
// Get the password input and eye icon
const passwordInput = document.getElementById('password-input');
const eyeIcon = document.getElementById('eye-icon');

// Toggle password visibility on eye icon click
eyeIcon.addEventListener('click', function() {
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';  // Show password
        eyeIcon.innerHTML = '<i class="fas fa-eye-slash"></i>';  // Change icon to eye-slash
    } else {
        passwordInput.type = 'password';  // Hide password
        eyeIcon.innerHTML = '<i class="fas fa-eye"></i>';  // Change icon back to eye
    }
});
</script>


<br>
        <input type="submit" name="loginbtn" class="btn btn-info mt-2 btn-block">

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
    Don't have an account? 
    <a href="signup.php" class="create-account-link" onclick="showLoader(event)">Sign Up</a>
</h3>



      </form>
    </div>
  </div>
</div>


<?php require("inc/footer2.php"); ?>
