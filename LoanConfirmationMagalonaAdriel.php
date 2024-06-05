<?php
session_start(); 
include_once("header.php");

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Not set';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <style>
        .thankYou {
            margin-top: 16vh;
        }
    </style>
</head>
<body>
    <p class="thankYou">Thank you <b><?php echo htmlspecialchars($username); ?></b><br>
    Your loan will be processed within three (3) working days.</p>

    <div class="backToLogin">
        <button type="button" name="backToLogin" onclick="goBack()">Back to Login Page</button>
    </div>

    <script>
        function goBack() {
            window.location.href = 'LoginMagalonaAdriel.php';
        }
    </script>
</body>
</html>
