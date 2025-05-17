<?php 
  session_start();

  if (isset($_SESSION['username'])) {
  	# database connection file
  	include 'app/db.conn.php';

  	include 'app/helpers/user.php';
  	include 'app/helpers/chat.php';
  	include 'app/helpers/opened.php';

  	include 'app/helpers/timeAgo.php';

  	if (!isset($_GET['user'])) {
  		header("Location: home.php");
  		exit;
  	}

  	# Getting User data data
  	$chatWith = getUser($_GET['user'], $conn);

  	if (empty($chatWith)) {
  		header("Location: home.php");
  		exit;
  	}

  	$chats = getChats($_SESSION['user_id'], $chatWith['user_id'], $conn);

  	opened($chatWith['user_id'], $conn, $chats);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Chat App</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet" 
	      href="css/style.css">
	<link rel="icon" href="img/logo.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		/* Body styling */
		body {
			background-color:rgba(255, 255, 255, 0.65);
			font-family: Arial, sans-serif;
			padding: 20px;
		}

		.chat-container {
			background-color: white;
			border-radius: 8px;
			box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
			max-width: 600px;
			margin: auto;
			overflow: hidden;
		}

		.chat-header {
			display: flex;
			align-items: center;
			background-color: #007bff;
			color: white;
			padding: 15px;
			border-radius: 8px 8px 0 0;
		}

		.chat-header img {
			width: 50px;
			border-radius: 50%;
			margin-right: 15px;
		}

		.chat-header h3 {
			font-size: 1.2rem;
			margin: 0;
		}

		.chat-header .status {
			font-size: 0.9rem;
			color: #ddd;
		}

		.chat-box {
			padding: 20px;
			max-height: 400px;
			overflow-y: auto;
			background-color:rgb(62, 86, 152);
		}

		.message {
			max-width: 75%;
			margin-bottom: 15px;
			border-radius: 10px;
			padding: 12px;
			font-size: 1rem;
		}

		.message.self {
			background-color: #007bff;
			color: white;
			align-self: flex-end;
		}

		.message.other {
			background-color: #f1f1f1;
			color: #333;
			align-self: flex-start;
		}

		.message small {
			display: block;
			font-size: 0.8rem;
			color: #888;
			margin-top: 5px;
		}

		.input-group {
			display: flex;
			padding: 10px;
			background-color: white;
			border-radius: 0 0 8px 8px;
		}

		.input-group textarea {
			border: 1px solid #ddd;
			border-radius: 5px;
			padding: 10px;
			flex: 1;
			font-size: 1rem;
		}

		.input-group button {
			background-color: #007bff;
			border: none;
			color: white;
			padding: 10px;
			border-radius: 5px;
			margin-left: 10px;
			cursor: pointer;
		}

		.input-group button:hover {
			background-color: #0056b3;
		}

		.alert-info {
			text-align: center;
			font-size: 1.2rem;
			color: #555;
		}

		/* Online Status Indicator */
		.online {
			width: 10px;
			height: 10px;
			border-radius: 50%;
			background-color: #4CAF50; /* Green */
		}

		.offline {
			width: 10px;
			height: 10px;
			border-radius: 50%;
			background-color: #f44336; /* Red */
		}

		/* Scrollable Chat Box */
		#chatBox {
			overflow-y: auto;
			max-height: 400px;
		}

	</style>
</head>
<body class="d-flex
             justify-content-center
             align-items-center
             vh-100">
    <div class="w-400 shadow p-4 rounded">
    	<a href="home.php"
    	   class="fs-4 link-dark">&#8592;</a>

    	   <div class="d-flex align-items-center">
    	   	  <img src="uploads/<?=$chatWith['p_p']?>"
    	   	       class="w-15 rounded-circle">

               <h3 class="display-4 fs-sm m-2">
               	  <?=$chatWith['name']?> <br>
               	  <div class="d-flex
               	              align-items-center"
               	        title="online">
               	    <?php
                        if (last_seen($chatWith['last_seen']) == "Active") {
               	    ?>
               	        <div class="online"></div>
               	        <small class="d-block p-1">Online</small>
               	  	<?php }else{ ?>
               	         <small class="d-block p-1">
               	         	Last seen:
               	         	<?=last_seen($chatWith['last_seen'])?>
               	         </small>
               	  	<?php } ?>
               	  </div>
               </h3>
    	   </div>

    	   <div class="shadow p-4 rounded
    	               d-flex flex-column
    	               mt-2 chat-box"
    	        id="chatBox">
    	        <?php 
                     if (!empty($chats)) {
                     foreach($chats as $chat){
                     	if($chat['from_id'] == $_SESSION['user_id'])
                     	{ ?>
						<p class="rtext align-self-end
						        border rounded p-2 mb-1">
						    <?=$chat['message']?> 
						    <small class="d-block">
						    	<?=$chat['created_at']?>
						    </small>      	
						</p>
                    <?php }else{ ?>
					<p class="ltext border 
					         rounded p-2 mb-1">
					    <?=$chat['message']?> 
					    <small class="d-block">
					    	<?=$chat['created_at']?>
					    </small>      	
					</p>
                    <?php } 
                     }	
    	        }else{ ?>
               <div class="alert alert-info 
    				            text-center">
				   <i class="fa fa-comments d-block fs-big"></i>
	               No messages yet, Start the conversation
			   </div>
    	   	<?php } ?>
    	   </div>
    	   <div class="input-group mb-3">
    	   	   <textarea cols="3"
    	   	             id="message"
    	   	             class="form-control"></textarea>
    	   	   <button class="btn btn-primary"
    	   	           id="sendBtn">
    	   	   	  <i class="fa fa-paper-plane"></i>
    	   	   </button>
    	   </div>

    </div>
 

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
	var scrollDown = function(){
        let chatBox = document.getElementById('chatBox');
        chatBox.scrollTop = chatBox.scrollHeight;
	}

	scrollDown();

	$(document).ready(function(){
      
      $("#sendBtn").on('click', function(){
      	message = $("#message").val();
      	if (message == "") return;

      	$.post("app/ajax/insert.php",
      		   {
      		   	message: message,
      		   	to_id: <?=$chatWith['user_id']?>
      		   },
      		   function(data, status){
                  $("#message").val("");
                  $("#chatBox").append(data);
                  scrollDown();
      		   });
      });

      /** 
      auto update last seen 
      for logged in user
      **/
      let lastSeenUpdate = function(){
      	$.get("app/ajax/update_last_seen.php");
      }
      lastSeenUpdate();
      /** 
      auto update last seen 
      every 10 sec
      **/
      setInterval(lastSeenUpdate, 10000);



      // auto refresh / reload
      let fechData = function(){
      	$.post("app/ajax/getMessage.php", 
      		   {
      		   	id_2: <?=$chatWith['user_id']?>
      		   },
      		   function(data, status){
                  $("#chatBox").append(data);
                  if (data != "") scrollDown();
      		    });
      }

      fechData();
      /** 
      auto update last seen 
      every 0.5 sec
      **/
      setInterval(fechData, 500);
    
    });
</script>
 </body>
 </html>
<?php
  }else{
  	header("Location: index.php");
   	exit;
  }
 ?>