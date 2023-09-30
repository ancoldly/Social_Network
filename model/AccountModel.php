<?php 
class Account {
    private $userId;
    private $username;
    private $email;
    private $birthdate;
    private $password;
    private $gender;
    private $telephone;
    private $address;
    private $avatar;
    private $biography;

    public function __construct($userId, $username, $email, $birthdate, $password, $gender, $telephone, $address, $avatar, $biography) {
        $this->userId = $userId;
        $this->username = $username;
        $this->email = $email;
        $this->birthdate = $birthdate;
        $this->password = $password;
        $this->gender = $gender;
        $this->telephone = $telephone;
        $this->address = $address;
        $this->avatar = $avatar;
        $this->biography = $biography;
    }
    
    public function getUserId() {
        return $this->userId;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getBirthdate() {
        return $this->birthdate;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getGender() {
        return $this->gender;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getAvatar() {
        return $this->avatar;
    }

    public function getBiography() {
        return $this->biography;
    }
}
?>