<?php 
    require('/Social_Network/controller/ProfileController.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Reenie+Beanie&family=Work+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/build/tailwind.css">
    <link rel="stylesheet" href="/css/tailwind.css">    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="icon" href="/image/firebase-logo-24.png" type="image/x-icon">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        blackColors: "#333",
                        mainColors: "#1bbc9b",
                        whiteColors: "#fdfdfd",
                        shadowColors: "rgba(0,0,0, .2)"
                    },
                    fontFamily: {
                        reenieFonts: ["Reenie Beanie", "Sans-serif"]
                    }
                },
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <title>Profile</title>
</head>

<body class="overflow-x-hidden">
    <header class="w-full h-[100px] flex items-center justify-between py-[20px] px-[50px] fixed top-0 bg-white z-[1000]">
        <div class="flex items-center cursor-pointer">
            <i class='bx bxl-firebase text-mainColors text-[50px]'></i>
            <h1 class="text-[30px] font-bold text-blue-500">Fushan.</h1>
        </div>

        <div class="flex items-center gap-[30px] justify-center">
            <div class="w-[350px] flex h-[50px] px-[10px] items-center gap-[5px] bg-gray-200 rounded-[30px]">
                <i class='bx bx-search text-[22px] text-gray-500' ></i>
                <input type="text" placeholder="Start typing to search.." class="outline-none w-full bg-gray-200">
            </div>

            <div class="flex items-center justify-center gap-[15px]">
                <a href="/index.php">
                    <button class="w-[50px] h-[50px] bg-gray-200 rounded-full bx bx-home text-gray-500 text-[26px]"></button>
                </a>
                <button class="w-[50px] h-[50px] bg-gray-200 rounded-full bx bxs-zap text-gray-500 text-[26px]"></button>
                <button class="w-[50px] h-[50px] bg-gray-200 rounded-full text-gray-500 text-[26px] bx bx-camera-movie"></button>
                <button class="w-[50px] h-[50px] bg-gray-200 rounded-full text-gray-500 text-[26px] bx bx-user"></button>
                <button class="w-[50px] h-[50px] bg-gray-200 rounded-full text-gray-500 text-[26px] bx bx-cart"></button>
            </div>
        </div>

        <div class="flex items-center justify-center gap-[15px]">
            <button class="w-[50px] h-[50px] text-mainColors rounded-full bx bx-bell text-[30px]"></button>
            <button class="w-[50px] h-[50px] text-mainColors rounded-full bx bx-chat text-[30px]"></button>
            <button class="w-[50px] h-[50px] text-mainColors rounded-full bx bx-cog bx-spin text-[30px]"></button>
            <button class="w-[30px] h-[30px] text-mainColors rounded-full text-[30px] show-tools-profile">
                <img src="<?php echo (isset($userData['avatar'])) ? $userData['avatar'] : $userData['avatar-temp']; ?>" alt="" class="rounded-full w-[30px] h-[30px]">
            </button>
        </div>

        <div class="w-[20%] h-max p-[10px] fixed bg-blue-50 right-[50px] top-[110px] rounded-[10px] gap-[10px] cursor-pointer tools-profile hidden">
            <a href="/controller/ProfileController.php" class="flex items-center gap-[10px] border-b-2 border-gray-300 pb-[10px]">
                <div class="w-[40px] h-[40px] bg-gray-200 rounded-full text-gray-500 text-[26px]"><img class="rounded-full w-[40px] h-[40px]" src="<?php echo (isset($userData['avatar'])) ? $userData['avatar'] : $userData['avatar-temp']; ?>" alt=""></div>
                <p class="font-semibold text-gray-500 flex items-center gap-[5px]"><?php echo isset($userData['username']) ? $userData['username'] : ''; ?> <i class='bx bxs-check-circle text-blue-500'></i></p>
            </a>

            <a href="/pages/changeInfo.php" class="flex items-center gap-[10px] border-b-2 border-gray-300 pb-[10px]">
                <div class="w-[40px] h-[40px] bg-gray-300 rounded-full text-gray-500 text-[26px] bx bx-cog flex items-center justify-center"></div>
                <p class="font-semibold text-gray-500">Edit Infomation</p>
            </a>

            <form action="../controller/ProfileController.php" method="post">
                <button class="flex items-center gap-[10px]" name="logout" type="submit">
                    <div class="w-[40px] h-[40px] bg-gray-300 rounded-full text-gray-500 text-[26px] bx bx-log-out flex items-center justify-center"></div>
                    <p class="font-semibold text-gray-500">Logout</p>
                </button>
            </form>
        </div>
    </header>

    <main class="w-full h-max grid items-center mt-[100px] py-[10px] px-[150px] bg-gray-200 gap-[10px]">
        <div class="grid">
            <form method="post" action="../controller/ProfileController.php" enctype="multipart/form-data" class="pt-[auto] flex items-end justify-between w-full h-max bg-white p-[30px] rounded-t-[10px] border-b-[2px]">
                <input type="hidden" name="return_to" value="../pages/profile_view.php">
                <div class="flex items-center gap-[20px]">
                    <div class="border-[2px] border-blue-500 p-[3px] rounded-full">
                        <img id="avatar-preview" src="<?php echo (isset($userData['avatar'])) ? $userData['avatar'] : $userData['avatar-temp']; ?>" alt="" class="w-[150px] h-[150px] rounded-full">
                    </div>

                    <div class="grid">
                        <span class="font-semibold text-[22px] flex items-center gap-[5px]"><?php echo isset($userData['username']) ? $userData['username'] : ''; ?> <i class='bx bxs-check-circle text-blue-500'></i></span>
                        <p class="font-semibold text-[14px] text-gray-500">269 Friends</p>
                    </div>
                </div>

                <div class="flex items-center gap-[10px]">
                    <input type="file" id="avatar" name="avatar" accept="image/*" class="hidden" onchange="previewAvatar(event)">
                    <label for="avatar" class="font-semibold w-max px-[20px] rounded-[5px] h-[40px] text-blue-500 bg-gray-200 flex items-center gap-[10px] justify-center">Upload Avatar</label>
                    <button class="font-semibold w-max px-[20px] rounded-[5px] h-[40px] text-blue-500 bg-gray-200 flex items-center gap-[10px] justify-center" type="submit" name="submit">Save avatar</button>
                    <button class="font-semibold w-max px-[20px] rounded-[5px] h-[40px] text-blue-500 bg-gray-200 flex items-center gap-[10px] justify-center"><i class='bx bx-edit-alt'></i>Edit Information Profile</button>
                </div>
            </form>

            <div class="w-full h-max bg-white px-[30px] flex items-center justify-between py-[10px] rounded-b-[10px]">
                <div class="flex">
                    <button class="w-max h-[40px] p-[10px] font-semibold">Posts</button>
                    <button class="w-max h-[40px] p-[10px] font-semibold">Introduce</button>
                    <button class="w-max h-[40px] p-[10px] font-semibold">Friends</button>
                    <button class="w-max h-[40px] p-[10px] font-semibold">Image</button>
                </div>

                <div>
                    <button class="w-[40px] h-[40px] bx bx-menu bg-gray-200 text-[22px] font-semibold rounded-[5px]"></button>
                </div>
            </div>
        </div>

        <div class="flex items-start justify-between gap-[20px]">
            <div class="w-[45%] grid gap-[10px]">
                <div class="grid p-[20px] bg-white rounded-[10px]">
                    <div class="grid gap-[20px]">
                        <span class="font-semibold">Introduce</span>

                        <form class="grid gap-[10px]" method="post" action="../controller/ProfileController.php">
                            <input type="hidden" name="return_to" value="../pages/profile_view.php">
                            <div class="grid gap-[20px]">
                                <p class="text-center"><?php echo isset($userData['biography']) ? $userData['biography'] : ''; ?></p>
                                <div class="hidden edit-biography">
                                    <div class="w-full border-[2px] p-[10px] rounded-[5px]">
                                    <textarea name="biography" id="biography" class="outline-none text-center w-full h-[80px] resize-none"><?php echo isset($userData['biography']) ? $userData['biography'] : ''; ?></textarea>
                                    <p id="char-count" class="text-blue-500 font-semibold"></p>
                                    </div>
                                    
                                    <div class="text-right mt-[20px] flex gap-[10px]">
                                        <button class="w-[30%] h-[40px] bg-gray-200 rounded-[5px] font-semibold text-[14px] cancel-biography" type="button">Cancel</button>
                                        <button class="w-[30%] h-[40px] bg-gray-200 rounded-[5px] font-semibold text-[14px]" type="submit" name="save-biography">Save biography</button>
                                    </div>
                                </div>
                            </div>

                            <button class="w-full h-[40px] bg-gray-200 rounded-[5px] font-semibold text-[14px] btn-biography" type="button">Edit biography</button>
                        </form>

                        <div class="grid gap-[10px]">
                            <div class="flex items-center gap-[10px] justify-start">
                                <i class='bx bxs-home-smile text-[24px] text-gray-500'></i>
                                <p>
                                    <?php
                                        if (!empty($userData['address'])) {
                                            echo $userData['address'];
                                        } else {
                                            echo 'Not updated information.';
                                        }
                                    ?>
                                </p>
                            </div>

                            <div class="flex items-center gap-[10px] justify-start">
                                <i class='bx bxs-phone text-[24px] text-gray-500' ></i>
                                <p>
                                <?php
                                        if (!empty($userData['telephone'])) {
                                            echo $userData['telephone'];
                                        } else {
                                            echo 'Not updated information.';
                                        }
                                    ?>
                                </p>
                            </div>

                            
                            <div class="flex items-center gap-[10px] justify-start">
                                <i class='bx bxl-gmail text-[24px] text-gray-500' ></i>
                                <p><?php echo isset($userData['email']) ? $userData['email']: ''; ?></p>
                            </div>

                            <div class="flex items-center gap-[10px] justify-start">
                                <i class='bx bx-male-female text-[24px] text-gray-500' ></i>
                                <p><?php echo isset($userData['gender']) ? $userData['gender'] : ''; ?></p>
                            </div>

                            <div class="flex items-center gap-[10px] justify-start">
                                <i class='bx bx-cake text-[24px] text-gray-500' ></i>
                                <p><?php echo isset($userData['birthdate']) ? $userData['birthdate'] : ''; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid p-[20px] bg-white rounded-[10px] gap-[20px]">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold">Picture</span>
                        <a href="" class="font-semibold text-blue-500">See All Picture</a>
                    </div>

                    <div class="grid grid-cols-3 gap-[10px]">
                        <img src="/image/image-post.jpg" alt="" class="rounded-[5px]">
                        <img src="/image/image-post.jpg" alt="" class="rounded-[5px]">
                        <img src="/image/image-post.jpg" alt="" class="rounded-[5px]">
                    </div>
                </div>

                <div class="grid p-[20px] bg-white rounded-[10px] gap-[20px]">
                    <div class="flex items-center justify-between">
                        <span class="font-semibold">Friends</span>
                        <a href="" class="font-semibold text-blue-500">See All Friends</a>
                    </div>

                    <div class="grid grid-cols-3 gap-[20px]">
                        <div class="grid gap-[5px]">
                            <img src="/image/image-post.jpg" alt="" class="rounded-[5px]">
                            <span class="text-[14px] font-semibold">Ha Nhung</span>
                        </div>

                        <div class="grid gap-[5px]">
                            <img src="/image/image-post.jpg" alt="" class="rounded-[5px]">
                            <span class="text-[14px] font-semibold">Trinh Quang Thang</span>
                        </div>

                        <div class="grid gap-[5px]">
                            <img src="/image/image-post.jpg" alt="" class="rounded-[5px]">
                            <span class="text-[14px] font-semibold">Tran Ngoc Anh Dung</span>
                        </div>

                        <div class="grid gap-[5px]">
                            <img src="/image/image-post.jpg" alt="" class="rounded-[5px]">
                            <span class="text-[14px] font-semibold">Ba Hai</span>
                        </div>

                        <div class="grid gap-[5px]">
                            <img src="/image/image-post.jpg" alt="" class="rounded-[5px]">
                            <span class="text-[14px] font-semibold">Nguyen Van Hoa</span>
                        </div>

                        <div class="grid gap-[5px]">
                            <img src="/image/image-post.jpg" alt="" class="rounded-[5px]">
                            <span class="text-[14px] font-semibold">Bui Quoc Dat</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-[55%] grid gap-[10px] relative">
                <form action="../controller/ProfileController.php" class="grid justify-start items-center bg-white rounded-[10px] p-[20px] gap-[20px]" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="return_to" value="../pages/profile_view.php">

                    <div class="flex items-center gap-[10px] cursor-pointer">
                        <button class="w-[40px] h-[40px] bg-gray-200 rounded-full text-blue-500 text-[24px] bx bx-edit-alt"></button>
                        <span class="text-gray-500 font-semibold">Create Post</span>
                    </div>

                    <div class="w-full h-[120px] border-[2px] rounded-[10px] flex items-start justify-between p-[10px] gap-[10px]">
                        <img id="avatar-preview" src="<?php echo (isset($userData['avatar'])) ? $userData['avatar'] : $userData['avatar-temp']; ?>" alt="" class="w-[40px] h-[40px] rounded-full">
                        <textarea name="create-post" id="create-post" cols="100" rows="10" class="w-full h-full outline-none pr-[10px]" placeholder="What's on your mind?" class="create-post"></textarea>
                    </div>

                    <div class="relative">
                        <img id="imagePost-preview" src="" alt="" class="rounded-[10px]">
                        <button class="delete-imagePost-preview hidden w-[40px] h-[40px] bg-gray-200 rounded-full text-blue-500 text-[24px] bx bx-x absolute top-[10px] right-[10px]" type="button"></button>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-[10px] cursor-pointer">
                            <input type="file" id="image-post" name="image-post" accept="image/*" class="hidden" onchange="previewImagePost(event)" >
                            <label for="image-post" class="font-semibold w-max px-[20px] rounded-[5px] h-[40px] text-blue-500 bg-gray-200 flex items-center gap-[10px] justify-center"><i class='bx bx-image-add text-[24px]'></i>Photo/Video</label>
                        </div>

                        <div class="flex items-center gap-[10px] cursor-pointer">
                            <button id="" class="createPost font-semibold w-max px-[20px] rounded-[5px] h-[40px] text-mainColors bg-gray-200 flex items-center gap-[10px] justify-center" type="submit" name="submit-create-post"><i class='bx bx-edit text-[24px]'></i>Create Post</button>
                        </div>
                    </div>
                </form>

                <?php 
                    $select = "SELECT * FROM `post` WHERE `email_id` = '$email' ORDER BY `id` DESC";
                    $data = $conn->query($select);
                    
                    if (mysqli_num_rows($data) < 1) {
                        ?>
                            <span class="font-semibold text-center text-gray-500 text-[20px] mt-[20px]">There are no posts</span>
                        <?php
                    }
                    while ($rows = mysqli_fetch_assoc($data)) 
                    {
                        $conten_show = $rows["content"];
                        $image_show = $rows["image_url"];
                        $date_show = $rows["time_upload"];
                        $id_show = $rows["id"];
                        $email_id = $rows["email_id"];
                        if ($image_show !== null) {
                            $image_edit = str_replace('../imagePost/', '', $image_show);
                        } else {
                            $image_edit = ''; 
                        }

                        $slectUserPost = "SELECT * FROM `account` WHERE `email` = '$email_id'";
                        $dataResultUser = $conn->query($slectUserPost);

                        while ($rows = mysqli_fetch_assoc($dataResultUser)) 
                        {
                            $idUserPost = $rows["userId"];
                            $userNamePost = $rows["username"];
                            $avatarPost = $rows["avatar"];
                        }

                        $noInfoUser = "";

                        $selectLikeIndex = "SELECT email_id FROM `likepost` WHERE `post_id` = '$id_show' LIMIT 1";
                        $resultLikeIndex = $conn->query($selectLikeIndex);

                        if ($resultLikeIndex && $resultLikeIndex->num_rows > 0) {
                            $row = mysqli_fetch_assoc($resultLikeIndex);
                            $LikePostIndex = $row['email_id'];

                            $selectLikeInfo = "SELECT * FROM `account` WHERE `email` = '$LikePostIndex'";
                            $resultLikeInfo = $conn->query($selectLikeInfo);

                            if ($resultLikeInfo && $resultLikeInfo->num_rows > 0) {
                                $row = mysqli_fetch_assoc($resultLikeInfo);
                                $userNameInfo = $row['username'];
                            } else {
                                $userNameInfo = $noInfoUser;
                            }
                        } else {
                            $noInfoLike = "";
                        }
                    ?>
                    <div class="grid items-center bg-white rounded-[10px] p-[20px] gap-[20px] relative">
                        <div class="flex items-center justify-between">
                            <div class="flex gap-[20px] items-center">
                                <img src="<?php echo (isset($userData['avatar'])) ? $userData['avatar'] : $userData['avatar-temp']; ?>" alt="" class="w-[40px] h-[40px] rounded-full">
            
                                <div class="gird items-center">
                                    <span class="font-semibold flex items-center gap-[5px]"><?php echo isset($userData['username']) ? $userData['username'] : ''; ?><i class='bx bxs-check-circle text-blue-500'></i></span>
                                    <p class="text-gray-500 text-[14px]"><?php echo isset($date_show) ? $date_show : ''; ?></p>
                                </div>
                            </div>

                            <div class="relative">
                                <button class="w-[40px] h-[40px] text-[30px] rounded-full hover:bg-gray-200 transition-all show-cogPost"><i class='bx bx-dots-horizontal-rounded' ></i></button>

                                <div class="w-max h-max bg-gray-200 p-[20px] absolute top-[100%] right-[40px] rounded-[10px] rounded-tr-[0px] hidden gap-[20px] text-left justify-start cogPost">
                                    <form method="POST" action="../controller/ProfileController.php">
                                        <input type="hidden" name="return_to" value="../pages/profile_view.php">
                                        <input type="hidden" name="postId" value="<?php echo isset($id_show) ? $id_show : ''; ?>">
                                        <button type="submit" class="font-semibold flex items-center gap-[5px] text-blue-500 delete-post"><i class='bx bx-trash text-[24px]' ></i> Delete Post</button>
                                    </form>
                                    <button class="font-semibold flex items-center gap-[5px] text-blue-500 editPost"><i class='bx bx-edit text-[24px]' ></i> Edit Post</button>

                                    <form action="../controller/ProfileController.php" data-post-id="<?php echo isset($id_show) ? $id_show : ''; ?>" class="editPost-show absolute w-[430px] mr-[10px] right-[100%] top-[0] hidden justify-start items-center z-[999] bg-blue-200 rounded-[10px] p-[20px] gap-[20px]" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="return_to" value="../pages/profile_view.php">
                                        <div class="flex items-center gap-[10px] cursor-pointer">
                                            <button class="w-[40px] h-[40px] bg-gray-200 rounded-full text-blue-500 text-[24px] bx bx-edit-alt" type="button"></button>
                                            <span class="text-gray-500 font-semibold">Edit Post</span>
                                        </div>

                                        <div class="w-full h-[120px] border-[2px] rounded-[10px] flex items-start justify-between p-[10px] gap-[10px]">
                                            <img id="avatar-preview-<?php echo isset($id_show) ? $id_show : ''; ?>" src="<?php echo (isset($userData['avatar'])) ? $userData['avatar'] : $userData['avatar-temp']; ?>" alt="" class="w-[40px] h-[40px] rounded-full">
                                            <textarea name="edit-post" id="edit-post" cols="100" rows="10" class="w-full h-full outline-none bg-blue-200 pr-[10px]" placeholder="What's on your mind?" class="edit-post"><?php echo isset($conten_show) ? $conten_show : ''; ?></textarea>
                                        </div>

                                        <div class="relative">
                                            <input type="hidden" name="current-image" id="current-image-<?php echo isset($id_show) ? $id_show : ''; ?>" value="<?php echo isset($image_edit) ? $image_edit : ''; ?>">
                                            <img id="imageEditPost-preview-<?php echo isset($id_show) ? $id_show : ''; ?>" src="<?php echo isset($image_show) ? $image_show : ''; ?>" alt="" class="rounded-[10px] imageEditPost-preview">
                                            <button id="delete-imageEditPost-preview-<?php echo isset($id_show) ? $id_show : ''; ?>" class="delete-imageEditPost-preview w-[40px] h-[40px] bg-gray-200 rounded-full text-blue-500 text-[24px] bx bx-x absolute top-[10px] right-[10px]" type="button" data-post-id="<?php echo isset($id_show) ? $id_show : ''; ?>"></button>
                                        </div>

                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-[10px] cursor-pointer">
                                                <input type="file" id="imageEdit-post-<?php echo isset($id_show) ? $id_show : ''; ?>" name="imageEdit-post" value="<?php echo isset($image_edit) ? $image_edit : ''; ?>" accept="image/*" class="hidden" onchange="previewImageEditPost(event, '<?php echo isset($id_show) ? $id_show : ''; ?>')">
                                                <label for="imageEdit-post-<?php echo isset($id_show) ? $id_show : ''; ?>" class="font-semibold w-max px-[20px] rounded-[5px] h-[40px] text-blue-500 bg-gray-200 flex items-center gap-[10px] justify-center"><i class='bx bx-image-add text-[24px]'></i>Photo/Video</label>
                                            </div>

                                            <div class="flex items-center gap-[10px] cursor-pointer">
                                                <input type="hidden" name="postEdit-id" value="<?php echo isset($id_show) ? $id_show : ''; ?>">
                                                <button id="" class="EditPost font-semibold w-max px-[20px] rounded-[5px] h-[40px] text-mainColors bg-gray-200 flex items-center gap-[10px] justify-center" type="submit" name="submit-edit-post"><i class='bx bx-edit text-[24px]'></i>Edit Post</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <?php 
                            $selectComments = "SELECT COUNT(*) AS comment_count FROM `comment` WHERE `post_id` = '$id_show'";
                            $resultComments = $conn->query($selectComments);
                            $row = mysqli_fetch_assoc($resultComments);
                            $commentCount = $row['comment_count'];

                            $selectLikePost = "SELECT COUNT(*) AS likepost_count FROM `likepost` WHERE `post_id` = '$id_show'";
                            $resultLikePost = $conn->query($selectLikePost);
                            $row = mysqli_fetch_assoc($resultLikePost);
                            $LikePostCount = $row['likepost_count'];

                            $checkLikes = "SELECT * FROM `likepost` WHERE `email_id` = '$email'";
                            $resultCheckLikes = $conn->query($checkLikes);

                            $likes = array();

                            while ($row = mysqli_fetch_assoc($resultCheckLikes)) {
                                $postId = $row["post_id"];
                                $isliked = $row["isliked"];
                                $likes[$postId] = $isliked;
                            }
                        ?>
        
                        <div class="grid gap-[20px] border-[2px] p-[10px] rounded-[10px]">
                            <div>
                                <p>
                                    <?php echo isset($conten_show) ? $conten_show : ''; ?>
                                </p>
                            </div>
            
                            <div>
                                <img src="<?php echo isset($image_show) ? $image_show : ''; ?>" alt="" class="w-auto h-auto rounded-[10px]">
                            </div>
                        </div>
        
                        <div class="flex items-center justify-between border-b-[2px] pb-[10px]">
                            <p class="text-gray-500 text-[18px] font-semibold">
                                <?php
                                    echo isset($userNameInfo) ? $userNameInfo : $noInfoUser;
                                    echo isset($LikePostCount) && $LikePostCount > 1 ? " and " . ($LikePostCount - 1) . " others" : '';
                                    echo isset($LikePostCount) && $LikePostCount > 0 ? " have liked your post." : $noInfoLike;
                                ?>
                            </p>
                            <p class="text-gray-500 font-semibold"><?php echo isset($commentCount) ? $commentCount : ''; ?> Comments</p>
                        </div>
        
                        <div class="flex items-center justify-between border-b-[2px] pb-[10px]">
                            <form class="flex items-center gap-[20px]" action="../controller/ProfileController.php" method="post">
                                <input type="hidden" name="return_to" value="../pages/profile_view.php">
                                <input type="hidden" name="post_Id" value="<?php echo isset($id_show) ? $id_show : ''; ?>">
                                <?php
                                $isLikedClass = isset($likes[$id_show]) ? $likes[$id_show] : 'bg-gray-500';
                                ?>
                                <button onclick="likePost(<?php echo $postId; ?>)" class="w-[40px] h-[40px] <?php echo $isLikedClass; ?> rounded-full text-white text-[24px] bx bx-heart bx-tada" type="submit" name="likePost"></button>
                            </form>
                            <button class="w-[40px] h-[40px] bg-gray-500 rounded-full text-white text-[24px] bx bx-share"></button>
                        </div>

                        <form class="flex items-center" method="post" action="../controller/ProfileController.php"> 
                            <input type="hidden" name="return_to" value="../pages/profile_view.php">
                            <div class="w-[10%]">
                                <img src="<?php echo (isset($userData['avatar'])) ? $userData['avatar'] : $userData['avatar-temp']; ?>" alt="" class="w-[40px] h-[40px] rounded-full">
                            </div>

                            <div class="border-[2px] rounded-[10px] p-[10px] flex items-center w-[90%] gap-[20px]">
                                <textarea name="comments" id="comments" class="w-full h-[50px] outline-none resize-none" placeholder="Write a public comment..."></textarea>
                                <input type="hidden" name="post_Id" value="<?php echo isset($id_show) ? $id_show : ''; ?>">
                                <button type="submit" class="" name="submit-comments"><i class='bx bx-send text-[30px] text-blue-500'></i></button>
                            </div>
                        </form>

                        <?php
                        $selectComments = "SELECT * FROM `comment` WHERE `post_id` = '$id_show' ORDER BY `id` DESC";
                        $data_Comments = $conn->query($selectComments);

                        while ($rows = mysqli_fetch_assoc($data_Comments)) {
                            $content_comments = $rows["content"];
                            $email_id = $rows["email_id"];
                            $date_comments = $rows["time_upload"];
                            $id_comments = $rows["id"];

                            $selectUser = "SELECT * FROM `account` WHERE `email` = '$email_id'";
                            $dataUser = $conn->query($selectUser);

                            while ($rows = mysqli_fetch_assoc($dataUser)) {
                                $userName_comments = $rows["username"];
                                $avatar_Comments = $rows["avatar"];
                            }
                        ?>
                            <div class="flex items-center">
                                <div class="w-[10%]">
                                    <img src="<?php echo(isset($avatar_Comments)) ? $avatar_Comments : $avatar_temp ?>" alt="" class="w-[40px] h-[40px] rounded-full">
                                </div>

                                <div class="bg-gray-200 p-[10px] rounded-[10px] w-[90%]">
                                    <form action="../controller/ProfileController.php" data-edit-id="<?php echo isset($id_show) ? $id_show : ''; ?>" data-id-comments="<?php echo isset($id_comments) ? $id_comments : ''; ?>" class="hidden items-center form-EditComment rounded-[10px] my-[10px]" method="post">
                                        <input type="hidden" name="return_to" value="../pages/profile_view.php">
                                        <div class="border-[2px] border-blue-500 rounded-[10px] p-[10px] flex items-center w-full gap-[20px]">
                                            <textarea name="Editcomments" id="Editcomments" class="w-full h-[50px] outline-none resize-none bg-gray-200" placeholder="Write a public comment..."><?php echo isset($content_comments) ? $content_comments : ''; ?></textarea>
                                            <input type="hidden" name="commentsEditId" value="<?php echo isset($id_comments) ? $id_comments : ''; ?>">
                                            <button type="submit" class="" name="submitEdit-comments"><i class='bx bx-send text-[30px] text-blue-500'></i></button>
                                        </div>
                                    </form>
                                    <div class="flex items-center justify-between relative">
                                        <form action="../controller/ProfileController.php" data-edit-id="<?php echo isset($id_show) ? $id_show : ''; ?>" data-id-comments="<?php echo isset($id_comments) ? $id_comments : ''; ?>" class="hidden items-center form-EditComment rounded-[10px] my-[10px]" method="post">
                                            <input type="hidden" name="return_to" value="../pages/profile_view.php">
                                            <div class="border-[2px] border-blue-500 rounded-[10px] p-[10px] flex items-center w-full gap-[20px]">
                                                <textarea name="Editcomments" id="Editcomments" class="w-full h-[50px] outline-none resize-none bg-gray-200" placeholder="Write a public comment..."><?php echo isset($content_comments) ? $content_comments : ''; ?></textarea>
                                                <input type="hidden" name="commentsEditId" value="<?php echo isset($id_comments) ? $id_comments : ''; ?>">
                                                <button type="submit" class="" name="submitEdit-comments"><i class='bx bx-send text-[30px] text-blue-500'></i></button>
                                            </div>
                                        </form>
                                        <span class="font-semibold flex items-center gap-[5px]"><?php echo isset($userName_comments) ? $userName_comments : ''; ?><i class='bx bxs-check-circle text-blue-500'></i></span>
                                        <?php
                                        if($email_id == $email) {
                                            ?>
                                            <button class="show-cogComments bx bx-dots-horizontal-rounded transition-all text-[22px] font-semibold rounded-full"></button>
                                            <div class="cogComments hidden bg-blue-50 gap-[20px] p-[10px] text-left rounded-[10px] absolute top-[0] right-[30px]">
                                                <button data-edit-id="<?php echo isset($id_show) ? $id_show : ''; ?>" data-id-comments="<?php echo isset($id_comments) ? $id_comments : ''; ?>" class="show-form-EditComments flex items-center gap-[10px] font-semibold" type="button"><i class='bx bx-edit-alt text-[22px] text-mainColors' ></i> Edit Comments</button>
                                                <form action="../controller/ProfileController.php" method="post" >
                                                    <input type="hidden" name="return_to" value="../pages/profile_view.php">
                                                    <input type="hidden" name="commentsId" value="<?php echo isset($id_comments) ? $id_comments : ''; ?>">
                                                    <button type="submit" class="flex items-center gap-[10px] font-semibold"><i class='bx bx-trash text-[22px] text-mainColors' ></i> Delete Comments</button>
                                                </form>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <p class="contentComment">
                                        <?php echo isset($content_comments) ? $content_comments : ''; ?>
                                    </p>
                                    <span class="text-gray-500 text-[14px]"><?php echo isset($date_comments) ? $date_comments : ''; ?></span>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <?php
                    }
                ?>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="/script/home.js"></script>
</body>

</html>