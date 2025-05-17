<?php 
  session_start();

  if (!isset($_SESSION['username'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Chat App - Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link rel="stylesheet" 
	      href="css/style.css">
	<link rel="icon" href="img/logo.png">
	<style>
    body {
      background: linear-gradient(135deg,rgb(173, 68, 173), #3498db, #8e44ad); /* Smooth gradient background */
      font-family: 'Arial', sans-serif;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .form-container {
      background-color: rgba(255, 255, 255, 0.9); /* Light translucent background */
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      width: 400px;
    }

    .form-container h3 {
      font-size: 2rem;
      color: #333;
    }

    .form-container img {
      width: 100px;
      margin-bottom: 20px;
    }

    .btn-primary {
      width: 100%;
      padding: 10px;
      font-size: 1.1rem;
      background-color:rgb(85, 52, 219);
      border: none;
      cursor: pointer;
      border-radius: 5px;
    }

    .btn-primary:hover {
      background-color:rgb(46, 41, 185);
    }

    .alert-warning {
      background-color: #f39c12;
      color: white;
      font-weight: bold;
    }

    .alert-success {
      background-color: #2ecc71;
      color: white;
      font-weight: bold;
    }

    a {
      display: block;
      margin-top: 20px;
      text-align: center;
      color: #3498db;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
	
</head>
<body class="d-flex
             justify-content-center
             align-items-center
             vh-100">
	 <div class="w-400 p-5 shadow rounded">
	 	<form method="post" 
	 	      action="app/http/auth.php">
	 		<div class="d-flex
	 		            justify-content-center
	 		            align-items-center
	 		            flex-column">

	 		<img src="img/logo.png" 
	 		     class="w-25">
	 		<h3 class="display-4 fs-1 
	 		           text-center">
	 			       LOGIN</h3>   


	 		</div>
	 		<?php if (isset($_GET['error'])) { ?>
	 		<div class="alert alert-warning" role="alert">
			  <?php echo htmlspecialchars($_GET['error']);?>
			</div>
			<?php } ?>
			
	 		<?php if (isset($_GET['success'])) { ?>
	 		<div class="alert alert-success" role="alert">
			  <?php echo htmlspecialchars($_GET['success']);?>
			</div>
			<?php } ?>
		  <div class="mb-3">
		    <label class="form-label">
		           User name</label>
		    <input type="text" 
		           class="form-control"
		           name="username">
		  </div>

		  <div class="mb-3">
		    <label class="form-label">
		           Password</label>
		    <input type="password" 
		           class="form-control"
		           name="password">
		  </div>
		  
		  <button type="submit" 
		          class="btn btn-primary">
		          LOGIN</button>
		  <a href="signup.php">Sign Up</a>
		</form>
	 </div>
</body>
</html>
<?php
  }else{
  	header("Location: home.php");
   	exit;
  }
 ?>