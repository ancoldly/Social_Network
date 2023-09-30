<?php
session_start();
require('../connectDB/connect.php');
require('../model/AccountModel.php');

$err = [];

function loginUser($account, $conn) {
    $select = "SELECT * FROM `account` WHERE `email` = ? AND `password` = ?";
    $stmt = $conn->prepare($select);
    $stmt->bind_param("ss", $account->getEmail(), $account->getPassword());
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['email'] = $account->getEmail();

        header("Location: /index.php");
        exit;
    } else {
        $err['errLogin'] = 'Incorrect account or password!';
    }
}

if (isset($_SESSION['email'])) {
    header("Location: /index.php");
    exit;
}

if (isset($_POST['submit-login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($email)) {
        $err['errEmail'] = 'Please enter your email!';
    } else if (empty($password)) {
        $err['errPassword'] = 'Please enter a password!';
    } else {
        $account = new Account(null, null, $email, null, $password, null, null, null, null, null);

        loginUser($account, $conn);
    }
}

include '../pages/login_view.php';
?>