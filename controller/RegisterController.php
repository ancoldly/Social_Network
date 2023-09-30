<?php
require('../connectDB/connect.php');
require('../model/AccountModel.php');
$err = [];

function registerUser($account, $conn) {
    $insert = "INSERT INTO `account` (`username`, `email`, `birth`, `password`, `gender`, `userId`, `telephone`, `address`, `avatar`, `biography`) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert);
    $stmt->bind_param("ssssssssss", $account->getUsername(), $account->getEmail(), $account->getBirthdate(), $account->getPassword(), $account->getGender(), 
    $account->getUserId(), $account->getTelephone(), $account->getAddress(), $account->getAvatar(), $account->getBiography());
    $stmt->execute();
}

function validateEmail($email) {
    $patternEmail = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    return preg_match($patternEmail, $email);
}

function validatePassword($password) {
    $patternPassword = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,16}$/';
    return preg_match($patternPassword, $password);
}

function calculateAge($birthdate) {
    $birthday = new DateTime($birthdate);
    $minAge = new DateTime('-18 years');
    return ($birthday <= $minAge);
}

function checkExistingEmail($email, $conn) {
    $select = "SELECT * FROM `account` WHERE `email` = ?";
    $stmt = $conn->prepare($select);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return ($result->num_rows > 0);
}

function redirectToLogin() {
    header("Location: /pages/login.php");
    exit();
}

if (isset($_POST['submit-register'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    $birthdate = $_POST['birth'];
    $gender = $_POST['gender'];

    if (empty($username) || empty($email) || empty($password) || empty($birthdate) || empty($gender)) {
        $err['empty'] = 'Please enter all required information!';
    } else {
        if (!validateEmail($email)) {
            $err['email'] = 'Please enter a valid email address!';
        }

        if (!validatePassword($password)){
            $err['password'] = 'Password must be between 8 and 16 characters (with at least one special character, one uppercase letter, and one number)';
        }

        if(!calculateAge($birthdate)) {
            $err['birth'] = 'You must be at least 18 years old to create an account!';
        }

        if(checkExistingEmail($email, $conn)) {
            $err['email'] = 'Account already in use!';
        }
    }

    if (empty($err)) {
        $account = new Account(null, $username, $email, $birthdate, $password, $gender, null, null, null, null);

        registerUser($account, $conn);

        $email = '';
        $password = '';
        $username = '';
        $birthdate = '';
        $gender = '';

        $done_register = 'Registration successful!';

        redirectToLogin();
    }
}

include '../pages/register_view.php';

if (!isset($checkEmail)) {
    $checkEmail = 0;
}
?>