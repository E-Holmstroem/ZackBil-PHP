
<head>
    <link rel="stylesheet" href="css/register.css">
    <link href="validate/validateRegister.php" >
    <script src="register.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>


<?php 
    
?>



<h1 class="h1">Skapa Konto</h1>

<form action="validate/validateRegister.php" target="" method="post">

  <div>
    
    <div class="container">
      <div class="cent-cont">   
        <?php  
        if(isset($_GET['error'])) {
            $errorMessage = urldecode($_GET['error']);
            // Now $errorMessage contains the error message passed in the URL
            echo "<p class=\"errormsg\">$errorMessage</p>";
            } else {
              echo "<br>";
            }
        ?>
        <label for="email"><b>Email</b></label>
          <br>
        <input type="text" placeholder="example@gmail.com" name="email" value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>" required> 
      </div>

      <div class="cent-cont">
        <label for="anvNamn"><b>Användarnamn</b></label>
          <br>
        <input type="text" placeholder="Användarnamn" name="anvNamn" required>
      </div>

      <div class="cent-cont">
        <label for="psw"><b>Lösenord</b></label>
          <br>
        <input type="password" placeholder="Lösenord" name="psw" required>
      </div>

      

      <button type="submit">Skapa</button>
      <p><a href="index.php">Avbryt</a> | Har du ett konto? <a href="login.php">Logga in här!</a></p>    
    </div>

  </div>

</form>

