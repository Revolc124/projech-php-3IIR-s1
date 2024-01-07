<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="signup2.css">
    <title>Discord</title>
</head>
<body>
    <form action="" method="post">
        <h2>Create an account</h2>
        <div class="inputs">
            <div class="input-container">
                <label for="USERNAME">USERNAME</label>
                <input type="text" name="username">
                <span id="error-username" class="error"></span>
            </div>
            <div class="input-container">
                <label for="email">EMAIL</label>
                <input type="email" name="email">
                <span id="error-email" class="error"></span>
            </div>
            <div class="input-container">
                <label for="PASSWORD">PASSWORD</label>
                <input type="PASSWORD" name="password">
                <span id="error-password" class="error"></span>
            </div>
            <button  class="btn" name="submit">Create Account</button>
            <span id="server-statut"></span>
        </div>
    </form>
    
</body>
<style>
    body{
    background-image: url(Techscape-Chronicles-Immersive-4K-Gaming-Backgrounds-and-Futuristic-HUD-Interface.jpg);
    background-size: cover;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    margin: 0;
}

form{
    min-width: 390px;
    background-color: #010406;
    padding: 30px;
    border-radius: 5px;
    font-size: 15px;

    box-shadow: 0px 0px 27px 6px rgba(114,137,218,0.61);
-webkit-box-shadow: 0px 0px 27px 6px rgba(114,137,218,0.61);
-moz-box-shadow: 0px 0px 27px 6px rgba(114,137,218,0.61);
}
.input-container{
    display: flex;
	flex-direction: column;
    color: rgba(240, 248, 255, 0.716);
    font-size: 11px;
}
.input-container{
    margin-bottom: 10px;
}

.btn{
    border-radius: 2px;
    background-color: #7289da;
    height: 2rem;
    width: 100%;
    border: none;
    margin-top: 20px;
}
.btn:active {
	transform: scale(0.98);
    color: white;
}

.btn:hover{
    background-color: #8f9fda;
}

h2{
    text-align: center;
    color: white;
    
}
input{
    background-color: #1e2124;
    border: none;
    outline:none;
    height: 35px;
    border-radius: 2px;
    margin-top: 10px;
    color: white;
}
input:focus{
    border: solid 1px #7289da;
}



.error{
    top: 0;
    color: red;
    font-size: 0.6rem;
}
</style>
</html>


<?php
class User {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn; 
    }

    public function register($username, $email, $password) {
        $stmt = $this->conn->prepare("INSERT INTO user (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
}

session_start();
include("mySQLserver.php");
$user = new User($conn);

if (isset($_POST['submit'])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if(empty($username)){
        echo '<script>document.getElementById("error-username").innerHTML = "Veuillez entrer le username";</script>';
    }
    else if(empty($email)){
        echo '<script>document.getElementById("error-email").innerHTML = "Veuillez entrer votre email";</script>';
    }
    else if(empty($password)){
        echo '<script>document.getElementById("error-password").innerHTML = "Veuillez entrer votre mot de passe";</script>';
    }
    else if ($user->register($username, $email, $password)) { 
        header("Location: login.php");
        exit();
    }
}
?>



