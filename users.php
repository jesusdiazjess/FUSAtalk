<?php require("./config/db.php"); 

if(isset($_COOKIE['email']) && isset($_COOKIE['user_id'])){
    // normal codes run
    $email = $_COOKIE['email'];
    $user_id = $_COOKIE['user_id'];

}else{
    header("location: index.php");
    die;
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>

   <!-- Favicon -->
   <link rel="icon" href="FUSAtalk-webp/FUSAtalkC.webp" type="image/x-icon">

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="Home Page" />
    <title>My Account :: FUSAtalk</title>
    <!-- css and bootstrap -->
    <link rel="stylesheet" href="css/chat.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- boostrap js and jqouery -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- chart.css -->
    <!-- js files -->
    <script src="./js/jquery.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <!-- icon script -->
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
  </head>
<body>


<div class="users-container">
  <div class="logged-in-user">
    <?php  
        if (isset($_COOKIE['email']) && isset($_COOKIE['user_id'])) {
            $query_user = mysqli_query($conn, "SELECT * FROM user_info WHERE email='$email' AND userId='$user_id'");
            $data = mysqli_fetch_assoc($query_user);
    ?>
    <!-- User Image Section -->
    <div class="user-img-container">
        <div class="user-img" style="background: url('user_img_uploads/<?php echo $data['user_img']; ?>') no-repeat center center / cover;"></div>

        <div class="status-indicator">
                <span class="online-circle"><ion-icon name="ellipse"></ion-icon> Online</span>
            </div>

        <p class="username"><?php echo htmlspecialchars($data['username'], ENT_QUOTES, 'UTF-8'); ?></p>

        
        
    </div>

    <!-- User Info and Actions -->
    <div class="user-info-container">
        
        
        <!-- User Status -->
        <?php if ($data['status'] === "On") { ?>
            
        <?php } ?>
        
        <!-- Actions -->
        <div class="actions">
            <button class="upload-btn" id="formuploadbtn">
                <ion-icon name="cloud-upload-outline"></ion-icon> Upload
            </button>
        </div>
        
        <!-- Logout -->
        <div class="logout-container">
            <a href="logic/user_logout.php?uid=<?php echo $data['userId']; ?>" class="logout-btn">
                <ion-icon name="lock-open"></ion-icon> Logout
            </a>
        </div>
    </div>
    <?php } ?>
</div>

<style>
.logged-in-user {
    display: flex;
    flex-direction: column;
    align-items: center;
    max-width: 175px;
    margin: 20px auto;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 20px;
    font-family: Arial, sans-serif;
    box-sizing: border-box; /* Ensures padding fits within max-width */
}

.user-info-container {
  height: 100%;
    width: 100%; /* Match the container width */
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.username {
    font-size: 18px;
    font-weight: bold;
    color: #fff;
    margin: 10px 0; /* Space around the username */
    text-align: center;
}

.status-indicator {
    font-size: 14px;
    color: #4caf50;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 15px;
}

.actions {
    margin-bottom: 15px;
    width: 100%; /* Center button within container */
    display: flex;
    justify-content: center;
}

.upload-btn {
    background: #4caf50;
    color: white;
    border: none;
    border-radius: 4px;
    padding: 8px 15px;
    cursor: pointer;
    font-size: 14px;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    transition: background 0.3s ease;
}

.logout-btn {
    color: #f44336; /* Initial color */
    text-decoration: none; /* No underline */
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 5px;
    cursor: pointer;
    transition: color 0.3s ease; /* Smooth transition for color */
}

.logout-btn:hover {
    color: #d32f2f; /* Slightly darker red for better contrast */
    text-decoration: underline; /* Add underline for hover effect */
}


</style>


  <div class="users-fields mt-2">
    <div class="searchbar">
      <p>Search for available users</p>
        <form class="form form-group" id="form-upload-cont">
            <!-- input -->
            <input type="text" placeholder="Search available user" id="searchinp" class="searchinp mr-2">

            <button class="searchbtn" type="button">
                <ion-icon name="search"></ion-icon>
            </button>
        </form>
    </div>
    <!-- users cont -->
    <div class="users-container-section">
      <p id="search-error" class="ml-3"></p>
      <div class="users-cont" id="users-cont"></div>
    </div>
  </div>
  
</div>


<!--form upload modal-->
<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <p>Upload Profile Pics</p>
      <br>
      <span class="close">&times;</span>
    </div>
    <div class="modal-body">
        <div class="img-preview">
            <img id="img-preview" alt="">
        </div>

        <p class="text-danger upload_err text-center"></p>
        
        <form id="upload_form">
            <input type="file" name="file" id="hidden_file">

            <!-- <button id="file_choose_btn"><ion-icon name="cloud-upload-outline"></ion-icon> Choose file</button> -->
            <!-- <label class="fileval">No file choosen</label> -->

            <button id="file_upload_btn" class="mt-1"><ion-icon name="cloud-upload-outline" type="submit"></ion-icon>Upload file</button>
        </form>
      <hr>
    </div>
  </div>
</div>

<script>
  let searchbtn = document.querySelector(".searchbtn");
  let searchinp = document.querySelector(".searchinp")
  let isclicked = false;

  searchbtn.addEventListener("click", (e)=>{
    e.preventDefault();
    if(isclicked == false){
      searchinp.style.visibility = "visible";
      isclicked = true;
      searchbtn.innerHTML = `<ion-icon name="close-outline"></ion-icon>`;
    }else{
      searchinp.style.visibility = "hidden";
      searchbtn.innerHTML = `<ion-icon name=""></ion-icon>`;
      isclicked = false;
    }  
  });

  let usersSectionCont = document.querySelector(".users-container-section");

  usersSectionCont.style.height = "50vh";
  if(usersSectionCont.style.height == "50vh"){
    usersSectionCont.style.overflowY = "scroll";
  }
</script>

<script src="./js/insert_data.js"></script>
<script src="./js/fetch_user.js"></script>
