<?php

session_start();

require('/Social_Network/connectDB/connect.php');
require('/Social_Network/model/AccountModel.php');
require('/Social_Network/model/PostModel.php');
require('/Social_Network/model/CommentModel.php');


if (!isset($_SESSION['email'])) {
    header("Location: /pages/login_view.php");
    exit();
}

$email = $_SESSION['email'];

date_default_timezone_set('Asia/Ho_Chi_Minh');

function displayNotification($message) {
    echo '<div id="notification" class="flex items-center w-[250px] h-max p-[20px] mt-[10px] bg-mainColors z-[9999999] fixed right-[50px] rounded-[10px] gap-[10px]">
            <i class="bx bxs-bell-ring text-[30px] text-red-500"></i>
            <p class="text-white">' . $message . '</p>
          </div>';
}

function returnView() {
    $returnTo = $_POST['return_to'];
    header("Location: ".$returnTo);
    exit();
}

function getUserData($conn, $email) {
    $select = "SELECT * FROM `account` WHERE `email` = '$email'";
    $data = $conn->query($select);

    while ($row = mysqli_fetch_assoc($data)) {
        $userId = $row["userId"];
        $username = $row["username"];
        $email = $row["email"];
        $birthdate = date('d-m-Y', strtotime($row["birth"]));
        $password = $row["password"];
        $gender = $row["gender"];
        $telephone = $row["telephone"];
        $address = $row["address"];
        $avatar = $row["avatar"];
        $biography = $row["biography"];
        $avatar_temp = "../avatar/user.png";
    }

    $userData = array(
        'userId' => $userId,
        'username' => $username,
        'email' => $email,
        'birthdate' => $birthdate,
        'password' => $password,
        'gender' => $gender,
        'telephone' => $telephone,
        'address' => $address,
        'avatar' => $avatar,
        'biography' => $biography,
        'avatar-temp' => $avatar_temp
    );

    return $userData;
}

$userData = getUserData($conn, $email);

function logout() {
    unset($_SESSION['email']);
    header("Location: /pages/login_view.php");
    exit();
}

function saveBiography($conn, $email, $biography) {
    $update = "UPDATE `account` SET `biography` = '$biography' WHERE `email` = '$email'";
    mysqli_query($conn, $update);
    returnView();
}

function uploadAvatar($conn, $email, $avatar) {
    $avatar_name = $_FILES["avatar"]["name"];
    $avatar_size = $_FILES["avatar"]["size"];
    $avatar_tmp = $_FILES["avatar"]["tmp_name"];
    $avatar_type = $_FILES["avatar"]["type"];
  
    $avatar_path = "../avatar/" . $avatar_name;

    $select_avatar = "SELECT `avatar` FROM `account` WHERE `email` = '$email'";

    $result = $conn->query($select_avatar);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $avatar = $row['avatar'];
    }
    
    if(move_uploaded_file($avatar_tmp, $avatar_path)) {
        $sql = "UPDATE `account` SET `avatar` = '$avatar_path' WHERE `email` = '$email'";
        $conn->query($sql);

        $filename = $avatar;
        if (file_exists($filename)) {
            unlink($filename);
        }

        returnView();
    }
}

function createPost($conn, $email) {
    $datePost = date('Y-m-d H:i:s');
    $contentPost = $_POST['create-post'];
    $imagePost = $_FILES["image-post"]["tmp_name"];
    $imageFileName = $_FILES["image-post"]["name"];
    $imageFile = "../imagePost/";
    $imagePath = $imageFile . $imageFileName;

    if (!empty($contentPost) || !empty($imageFileName)) {
        if (!empty($imageFileName) && move_uploaded_file($imagePost, $imagePath)) {
            $createPost = "INSERT INTO post (email_id, image_url, content, time_upload) VALUES ('$email', '$imagePath', '$contentPost', '$datePost')";
        } else {
            $createPost = "INSERT INTO post (email_id, content, time_upload) VALUES ('$email', '$contentPost', '$datePost')";
        }

        if ($conn->query($createPost) === TRUE) {
            $mess = "Post created successfully";
            $_SESSION['notification'] = $mess;
            returnView();
        } else {
            echo "Error: " . $createPost . "<br>" . $conn->error;
        }
    } else {
        $mess = "Content and image cannot be empty. Please provide at least one of them.";
        $_SESSION['notification'] = $mess;
        returnView();
    }
}

function editPost($conn, $postId) {
    $contentEditPost = $_POST['edit-post'];
    $imageEditPost = $_FILES["imageEdit-post"]["tmp_name"];
    $imageEditFileName = $_FILES["imageEdit-post"]["name"];
    $imageEditFile = "../imagePost/";
    $imageEditPath = $imageEditFile . $imageEditFileName;
    $imageTemp = $_POST['current-image'];

    $getImageOld = "SELECT `image_url` FROM `post` WHERE `id` = '$postId'";
    $dataImageOld = $conn->query($getImageOld);

    while ($rows = mysqli_fetch_assoc($dataImageOld)) {
        $imageOld = $rows['image_url'];
    }

    if (!empty($contentEditPost) || !empty($imageEditFileName)) {
        if (!empty($imageEditFileName) && move_uploaded_file($imageEditPost, $imageEditPath)) {
            if (!empty($imageOld)) {
                unlink($imageOld); 
            }
            $eidtPost = "UPDATE `post` SET `content` = '$contentEditPost', `image_url` = '$imageEditPath' WHERE `id` = '$postId'";
        } elseif (!empty($contentEditPost) && empty($imageTemp)) {
            $imageEditPath = '';
            if (!empty($imageOld)) {
                unlink($imageOld); 
            }
            $eidtPost = "UPDATE `post` SET `content` = '$contentEditPost', `image_url` = '$imageEditPath' WHERE `id` = '$postId'";
        } else if (!empty($imageTemp)) {
            $imageEditFileName = $imageTemp;
            $imageEditPath = $imageEditFile . $imageEditFileName;
            $eidtPost = "UPDATE `post` SET `content` = '$contentEditPost', `image_url` = '$imageEditPath' WHERE `id` = '$postId'";
        }

        if ($conn->query($eidtPost) === TRUE) {
            $mess = "Post Edit successfully";
            $_SESSION['notification'] = $mess;
            returnView();
        } else {
            echo "Error: " . $eidtPost . "<br>" . $conn->error;
        }
    } else {
        $mess = "Content and image cannot be empty. Please provide at least one of them.";
        $_SESSION['notification'] = $mess;
        returnView();
    }
}

function deletePost($conn, $postId) {
    $deleteComments = "DELETE FROM comment WHERE post_id = '$postId'";
    $conn->query($deleteComments);

    $deleteLike = "DELETE FROM likepost WHERE post_id = '$postId'";
    $conn->query($deleteLike);
    if (is_numeric($postId)) {
        $getPostQuery = "SELECT image_url FROM post WHERE id = '$postId'";
        $getPostResult = $conn->query($getPostQuery);
        if ($getPostResult->num_rows > 0) {
            $post = $getPostResult->fetch_assoc();
            $imagePath = $post['image_url'];

            if (!empty($imagePath)) {
                unlink($imagePath);
            }
        }

        $deletePost = "DELETE FROM post WHERE id = '$postId'";
        if ($conn->query($deletePost)) {
            $mess = "Post deletion successful!";
            $_SESSION['notification'] = $mess;
            returnView();
        } else {
            $mess = "Post deletion failed!";
            $_SESSION['notification'] = $mess;
            returnView();
        }
    }
}

function createComment($conn, $email, $postId) {
    $dateComments = date('Y-m-d H:i:s');
    $commentContent = $_POST['comments'];
    $postId = $_POST['post_Id'];

    $createComments = "INSERT INTO comment (post_id, email_id, content, time_upload) VALUES ('$postId', '$email', '$commentContent', '$dateComments')";
    if($conn->query($createComments)) {
        returnView();
    }
}

function editComment($conn, $commentId) {
    $commentId = $_POST['commentsEditId'];
    $contentEditComment = $_POST['Editcomments'];

    if (!empty($contentEditComment)) {
        $updateComment = "UPDATE `comment` SET `content` = '$contentEditComment' WHERE `id` = '$commentId'";

        if ($conn->query($updateComment) === TRUE) {
            $mess = "Comment updated successfully";
            $_SESSION['notification'] = $mess;
            returnView();

        } else {
            echo "Error: " . $updateComment . "<br>" . $conn->error;
        }
    } else {
        $mess = "Comment cannot be empty. Please enter your comment.";
        $_SESSION['notification'] = $mess;
        returnView();
    }
}

function deleteComment($conn, $commentId) {
    $commentId = $_POST['commentsId'];
    $deleteComments = "DELETE FROM comment WHERE id = '$commentId'";
    $conn->query($deleteComments);
    returnView();
}

function likePost($conn, $email, $postId) {
    $checkLike = "SELECT * FROM `likepost` WHERE `email_id` = '$email' AND `post_id` = '$postId'";
    $result = $conn->query($checkLike);
    $isliked = 'bg-red-500';

    if (mysqli_num_rows($result) == 0) {
        $likePost = "INSERT INTO `likepost` (`email_id`, `post_id`, `isliked`) VALUES ('$email', '$postId', '$isliked')";

        if ($conn->query($likePost) === TRUE) {
            $mess = "Post liked successfully";
            $_SESSION['notification'] = $mess;
            returnView();
        } else {
            echo "Error: " . $likePost . "<br>" . $conn->error;
        }
    } else {
        unlikePost($conn, $email, $postId);
    }
}

function unlikePost($conn, $email, $postId) {
    $unlikePost = "DELETE FROM `likepost` WHERE `email_id` = '$email' AND `post_id` = '$postId'";

    if ($conn->query($unlikePost) === TRUE) {
        $mess = "Post unliked successfully";
        $_SESSION['notification'] = $mess;
        returnView();

    } else {
        echo "Error: " . $unlikePost . "<br>" . $conn->error;
    }
}

function checkIfLiked($conn, $email, $postId) {
    $checkLike = "SELECT * FROM `likepost` WHERE `email_id` = '$email' AND `post_id` = '$postId'";
    $resultcheckLike = $conn->query($checkLike);

    return mysqli_num_rows($resultcheckLike) > 0;
}

if (isset($_POST['logout'])) {
    logout();
}

if (isset($_POST['save-biography'])) {
    $biography = $_POST['biography'];
    saveBiography($conn, $email, $biography);
}

if (isset($_FILES["avatar"]) && $_FILES["avatar"]["error"] == 0) {
    uploadAvatar($conn, $email, $avatar);
}

if (isset($_POST['submit-create-post'])) {
    createPost($conn, $email);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit-edit-post'])) {
    $postId = $_POST['postEdit-id'];
    editPost($conn, $postId);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['postId'])) {
    $postId = $_POST['postId'];
    deletePost($conn, $postId);
}

if (isset($_POST['submit-comments'])) {
    $postId = $_POST['post_Id'];
    createComment($conn, $email, $postId);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['commentsId'])) {
    $commentId = $_POST['commentsId'];
    deleteComment($conn, $commentId);
}

if(isset($_POST["submitEdit-comments"])) {
    $commentId = $_POST['commentsId'];
    editComment($conn, $commentId);
}


if (isset($_POST['likePost'])) {
    $postId = $_POST['post_Id'];

    likePost($conn, $email, $postId);
}


if (isset($_SESSION['notification'])) {
    displayNotification($_SESSION['notification']);
    unset($_SESSION['notification']);
}

?>