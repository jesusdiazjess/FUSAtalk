<!--<header class="header">
  <div class="main-cont">
    <div class="text">
      <h2>Fast. Unifying. Secure. Always connected.</h2>
      <br>
      <a href="signup.php" class="link">
        <button class="act-btn">
          Start Now
        </button>
      </a>
    </div>-->
    <!--<div class="img-cont"></div>-->
    <!--<div class="img-cont"><img src="FUSAtalk-webp/FUSAtalk-bdr.webp" alt="" style="width: 200px; height: 200px;"></div>
  </div>
</header>-->

<header class="header">
  <div class="main-cont">
    <div class="text">
      <h2>Fast. Unifying. Secure. Always connected.</h2>
      <br>
      

      <div class="auth-buttons">
  <a href="login.php" class="btn btn-primary">Log In</a>
  <a href="signup.php" class="btn btn-secondary">Sign Up</a>
</div>
<style>
  .auth-buttons {
  display: flex;
  gap: 1rem;
}

.btn {
  display: inline-block;
  padding: 0.50rem 1.9rem;
  font-size: 1rem;
  font-weight: bold;
  text-align: center;
  text-decoration: none;
  border: none;
  border-radius: 0.5rem;
  cursor: pointer;
  transition: background-color 0.3s ease, color 0.3s ease;
}

.btn-primary {
  background-color: #007bff;
  color: #fff;
}

.btn-secondary {
  background-color: #6c757d;
  color: #fff;
}

.btn:hover {
  opacity: 0.9;
}

</style>

    </div>

    
    <div class="img-cont">
    <img src="FUSAtalk-webp/FUSAtalk.webp" alt="FUSA Logo" style="width: 200px; height: 200px; border-radius: 0px;">

    </div>
  </div>
</header>
<style>
  /* Header styling */
.header {
  position: relative;
  width: 100%;
  height: 90vh;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  background-size: cover;
  background-position: center;
  animation: slideShow 15s infinite; /* Change images every 3 seconds */
}

/* Animations for background images */
@keyframes slideShow {
  0% {
    background-image: url('FUSAtalk-backg/serversides.webp');
  }
  20% {
    background-image: url('FUSAtalk-backg/serversides.webp');
  }
  25% {
    background-image: url('FUSAtalk-backg/serverside2.1.webp');
  }
  45% {
    background-image: url('FUSAtalk-backg/serverside2.1.webp');
  }
  50% {
    background-image: url('FUSAtalk-backg/serverside4.3.jpg');
  }
  70% {
    background-image: url('FUSAtalk-backg/serverside4.3.jpg');
  }
  75% {
    background-image: url('FUSAtalk-backg/serverside5.jpg');
  }
  95% {
    background-image: url('FUSAtalk-backg/serverside5.jpg');
  }
  100% {
    background-image: url('FUSAtalk-backg/serverside5.jpg');
  }
}


/* Main content styling */
.main-cont {
  position: relative;
  z-index: 2; /* Keeps content above the background */
}

.text {
  color: white;
  text-shadow: 0px 0px 5px rgba(0, 0, 0, 0.7);
}




/* Optional: dark overlay for better text visibility */
.header::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  z-index: 1;
}

</style>