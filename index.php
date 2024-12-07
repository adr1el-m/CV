<?php
session_start(); 

include_once("header.php");

$conn = mysqli_connect("localhost", "root", "", "loan");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = '<h3>Please enter username and/or password</h3>'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);


        $sql = "SELECT user_id FROM tblUser WHERE username = ? AND password = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header('Location: loanAmountMagalonaAdriel.php');
            exit(); 
        } else {
            
            $message = '<h3>Username and/or password does not match...</h3>';
        }
    } else {

        $message = '<h3>Please enter both username and password...</h3>';
    }
}
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        #login {
            text-align: center;
        }

        h2 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        div {
            margin: 10px 0;
        }
    </style>
</head>
<body>
<div id="login">
    <h2>USER NAME & PASSWORD ENTRY:</h2>

    <form action="" method="post">
        <div>
            <label for="username">User name:</label>
            <input type="text" name="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <input type="submit" value="Accept">
            <input type="reset" value="Reset">
        </div>
    </form>
    <?php echo $message;?>
</div>
</body>
</html>
