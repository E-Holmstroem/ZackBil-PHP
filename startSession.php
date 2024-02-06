<?php
session_start();
    $_SESSION['user_email'] = $email;
    $_SESSION['user_pfp'] = $userRow['pfp'];
    $_SESSION['user_name'] = $userRow['name'];

    header("Location: index.php");
    exit();