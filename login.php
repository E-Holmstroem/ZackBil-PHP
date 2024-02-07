<head>
    <link rel="stylesheet" href="css/style.css">
    <link href="validate/validateLogin.php" >
</head>


<?php 
    
?>



<h1 class="h1">Logga in</h1>

<form action="validate/validateLogin.php" target="" method="post">

  <div>

    <div class="imgcontainer">
      <img src="bilder/pfp.png" alt="Avatar" class="avatar">
    </div>
    
    <div class="container">
      <div class="cent-cont">   
        <label for="email"><b>Email</b></label>
          <br>
        <input type="text" placeholder="example@gmail.com" name="email" value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>" required> 
      </div>

      <div class="cent-cont">
        <label for="psw"><b>Lösenord</b></label>
          <br>
        <input type="password" placeholder="Lösenord" name="psw" required>
      </div>

      <button type="submit">Login</button>
      <p><a href="index.php">Avbryt</a> | Saknar du ett konto? <a href="register.php">Skapa ett här!</a></p>    
    </div>

  </div>

</form>

