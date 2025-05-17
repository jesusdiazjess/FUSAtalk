<?php 
  session_start();

  if (isset($_SESSION['username'])) {
  	# database connection file
  	include 'app/db.conn.php';

  	include 'app/helpers/user.php';
  	include 'app/helpers/conversations.php';
    include 'app/helpers/timeAgo.php';
    include 'app/helpers/last_chat.php';

  	# Getting User data data
  	$user = getUser($_SESSION['username'], $conn);

  	# Getting User conversations
  	$conversations = getConversation($user['user_id'], $conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Chat App - Home</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet" 
	      href="css/style.css">
	<link rel="icon" href="img/logo.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		body {
			background-color:rgb(121, 180, 216); /* Light background for the app */
			font-family: Arial, sans-serif;
		}

		.container {
			display: flex;
			justify-content: center;
			align-items: center;
			min-height: 100vh;
		}

		.chat-container {
			width: 100%;
			max-width: 500px;
			background-color: white;
			border-radius: 8px;
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
		}

		.header {
			display: flex;
			justify-content: space-between;
			align-items: center;
			background-color: #007bff;
			color: white;
			padding: 20px;
			border-radius: 8px 8px 0 0;
		}

		.header img {
			width: 40px;
			border-radius: 50%;
		}

		.header .user-name {
			font-size: 1.2rem;
			font-weight: bold;
		}

		.search-bar {
			padding: 10px;
			border-radius: 5px;
			border: 1px solid #ccc;
			width: calc(100% - 40px);
			margin: 10px;
			font-size: 1rem;
		}

		.search-btn {
			background-color: #007bff;
			color: white;
			border: none;
			border-radius: 5px;
			padding: 10px;
			cursor: pointer;
		}

		.search-btn:hover {
			background-color: #0056b3;
		}

		.chat-list {
			max-height: 400px;
			overflow-y: auto;
			padding: 10px;
		}

		.chat-item {
			display: flex;
			justify-content: space-between;
			align-items: center;
			background-color: #f9f9f9;
			padding: 12px;
			border-radius: 5px;
			margin-bottom: 10px;
			cursor: pointer;
		}

		.chat-item:hover {
			background-color: #e6f7ff;
		}

		.chat-item .user-details {
			display: flex;
			align-items: center;
		}

		.chat-item .user-details img {
			width: 40px;
			border-radius: 50%;
			margin-right: 10px;
		}

		.chat-item .user-name {
			font-size: 1rem;
			font-weight: bold;
		}

		.chat-item .last-message {
			font-size: 0.9rem;
			color: #777;
		}

		.chat-item .online-status {
			width: 10px;
			height: 10px;
			border-radius: 50%;
			background-color: #4CAF50; /* Green for online */
		}

		.chat-item .online-status.offline {
			background-color: #f44336; /* Red for offline */
		}

		.no-chat-msg {
			text-align: center;
			font-size: 1.2rem;
			color: #777;
			padding: 50px 0;
		}

		.logout-btn {
			background-color: #dc3545;
			color: white;
			border-radius: 5px;
			padding: 10px;
			text-decoration: none;
		}

		.logout-btn:hover {
			background-color: #c82333;
		}
	</style>
	
</head>
<body class="d-flex
             justify-content-center
             align-items-center
             vh-100">
    <div class="p-2 w-400
                rounded shadow">
    	<div>
    		<div class="d-flex
    		            mb-3 p-3 bg-light
			            justify-content-between
			            align-items-center">
    			<div class="d-flex
    			            align-items-center">
    			    <img src="uploads/<?=$user['p_p']?>"
    			         class="w-25 rounded-circle">
                    <h3 class="fs-xs m-2"><?=$user['name']?></h3> 
    			</div>
    			<a href="logout.php"
    			   class="btn btn-dark">Logout</a>
    		</div>

    		<div class="input-group mb-3">
    			<input type="text"
    			       placeholder="Search..."
    			       id="searchText"
    			       class="form-control">
    			<button class="btn btn-primary" 
    			        id="serachBtn">
    			        <i class="fa fa-search"></i>	
    			</button>       
    		</div>
    		<ul id="chatList"
    		    class="list-group mvh-50 overflow-auto">
    			<?php if (!empty($conversations)) { ?>
    			    <?php 

    			    foreach ($conversations as $conversation){ ?>
	    			<li class="list-group-item">
	    				<a href="chat.php?user=<?=$conversation['username']?>"
	    				   class="d-flex
	    				          justify-content-between
	    				          align-items-center p-2">
	    					<div class="d-flex
	    					            align-items-center">
	    					    <img src="uploads/<?=$conversation['p_p']?>"
	    					         class="w-10 rounded-circle">
	    					    <h3 class="fs-xs m-2">
	    					    	<?=$conversation['name']?><br>
                      <small>
                        <?php 
                          echo lastChat($_SESSION['user_id'], $conversation['user_id'], $conn);
                        ?>
                      </small>
	    					    </h3>            	
	    					</div>
	    					<?php if (last_seen($conversation['last_seen']) == "Active") { ?>
		    					<div title="online">
		    						<div class="online"></div>
		    					</div>
	    					<?php } ?>
	    				</a>
	    			</li>
    			    <?php } ?>
    			<?php }else{ ?>
    				<div class="alert alert-info 
    				            text-center">
					   <i class="fa fa-comments d-block fs-big"></i>
                       No messages yet, Start the conversation
					</div>
    			<?php } ?>
    		</ul>
    	</div>
    </div>
	  

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
	$(document).ready(function(){
      
      // Search
       $("#searchText").on("input", function(){
       	 var searchText = $(this).val();
         if(searchText == "") return;
         $.post('app/ajax/search.php', 
         	     {
         	     	key: searchText
         	     },
         	   function(data, status){
                  $("#chatList").html(data);
         	   });
       });

       // Search using the button
       $("#serachBtn").on("click", function(){
       	 var searchText = $("#searchText").val();
         if(searchText == "") return;
         $.post('app/ajax/search.php', 
         	     {
         	     	key: searchText
         	     },
         	   function(data, status){
                  $("#chatList").html(data);
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