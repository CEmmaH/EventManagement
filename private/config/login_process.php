<?php
require_once 'db_connection.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    if (empty($username) || empty($password)) {
        session_start();
        $_SESSION['error'] = "Please enter username and password.";
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header("Location: ../Login.php");
        exit();
    }

    try {
        checkLogin($username, $password);
        $conn->close();
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
function checkLogin($username,$password){
    global $conn;
    $sql = "SELECT * FROM user WHERE user_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);  
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $userid = $row['id'];
        $passwd = $row['password'];
        if($passwd == $password){
            session_start();
            $_SESSION['userid'] = $userid;
            header("Location: ../Plan.php");
        }else{
            session_start();
            $_SESSION['error'] = "Password is not correct.";
            $_SESSION['username'] = $username;
            header("Location: ../Login.php");
        }
    }else{
        session_start();
        $_SESSION['error'] = "User is not existed.";
        $_SESSION['username'] = $username;
        header("Location: ../Login.php");
    }
    $stmt -> close();
}
?>