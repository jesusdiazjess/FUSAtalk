<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Favicon -->
   <link rel="icon" href="FUSAtalk-webp/FUSAtalkC.webp" type="image/x-icon">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="Home Page" />
    <title>Conversation Room :: FUSAtalk</title>
    <!-- css and bootstrap -->
    <link rel="stylesheet" href="css/style.css" />
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

<?php 

require("config/db.php");

if(isset($_GET['uid'])){
  $user_email = $_COOKIE['email'];
  $user_id = $_COOKIE['user_id'];

  $chat_user_id = $_GET['uid'];
  // query user
  $query_user = mysqli_query($conn, "SELECT * FROM user_info WHERE userId='$chat_user_id'");

  if(mysqli_num_rows($query_user) > 0){
    $data = mysqli_fetch_assoc($query_user);
    $username = $data['username'];
    $userimg = $data['user_img'];
    $status = $data['status'];
    $date = $data['active_at'];
  }else{
    header("location: login.php");
    die;
  }
}else{
  header("location: login.php");
  die;
}

?>

<section class="chat-section">
    <div class="chat-card">
      <!-- chat header -->
      <div class="chat-card-head">
        <div class="user-info">
          <?php if($status === "On"){?>
            <a class="mr-2 p-0" href="index.php">
              <ion-icon name="arrow-back-outline" style="font-size:20px; color:#fff;"></ion-icon>
            </a>
            <div class="user-img" style="background: url(user_img_uploads/<?php echo $userimg; ?>); background-size:cover; background-position:center;"></div>
            <br>
            <p class="username"><?php echo $username; ?></p>
            <br>
            <br>
            <br>
            <sup><ion-icon class="online-circle ml-1" name="ellipse"></ion-icon></sup>
          <?php }else if($status === "Off"){?>
            <a class="mr-2 p-0" href="index.php">
              <ion-icon name="arrow-back-outline" style="font-size:20px; color:#fff;"></ion-icon>
            </a>
            <div class="user-img" style="background: url(user_img_uploads/<?php echo $userimg; ?>); background-size:cover; background-position:center;"></div>
            <br><br>
            <p class="username"><?php echo $username; ?></p>
            <br><br>
            <sup><ion-icon class="offline-circle ml-1" name="ellipse"></ion-icon></sup>
          <?php }?>
        </div>
      </div>

      <!-- chat body -->
      <div class="chat-body">
        <div class="chat-msg-ovl">
          <p>No messages yet. Start a conversation to connect!</p>
        </div>

        <style>
          .chat-msg-ovl {
    text-align: center;
    font-size: 16px;
    color: #555;
    margin-top: 20px;
    font-family: Arial, sans-serif;
}

.chat-msg-ovl p {
    margin: 0;
    padding: 10px;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 5px;
    display: inline-block;
}

        </style>

        <div class="chat-msg"></div>

        <!-- chat footer -->
       <!-- Chat Footer -->
<div class="chat-footer">
    <div class="form-inline mt-1 input-group p-1">
        <input 
            type="text" 
            class="send-msg form-control" 
            placeholder="Compose a message" 
            id="send-msg-inp"
        >

        <?php 
        require_once("config/db.php");
        $user_id = $_GET['uid'];

        $query = mysqli_query($conn, "SELECT * FROM user_info WHERE userId='$user_id'");

        $count = mysqli_fetch_assoc($query);
        if($count == 0){
            header("location: users.php");
            die;
        }else if($count > 0){?>
            <input type="hidden" value="<?php echo $user_id;?>" id="incoming_id_inp">
        <?php }?>

        <button class="send-btn btn btn-primary" type="button" id="send-btn">
            Send
        </button>
    </div>
</div>

<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sendInput = document.getElementById('send-msg-inp');
        const sendButton = document.getElementById('send-btn');

        // Trigger the send button click when the Enter key is pressed
        sendInput.addEventListener('keydown', (event) => {
            if (event.key === 'Enter') {
                event.preventDefault(); // Prevent form submission (if applicable)
                sendButton.click(); // Trigger the send button
            }
        });

        // Send button click handler (example)
        sendButton.addEventListener('click', () => {
            const message = sendInput.value.trim();
            const incomingId = document.getElementById('incoming_id_inp').value;

            if (message !== '') {
                // Perform AJAX or fetch call to send the message
                console.log(`Message sent: ${message}, to User ID: ${incomingId}`);

                // Clear the input after sending the message
                sendInput.value = '';
            } else {
                console.log('Message input is empty.');
            }
        });
    });
</script>

        
      </div>
    </div>
</section>

<script src="./js/fetch_msg.js"></script>
</body>
</html>
