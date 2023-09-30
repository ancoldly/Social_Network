<?php
    require('/Social_Network/connectDB/connect.php');

    session_start();

    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];

        $select = "SELECT * FROM `account` WHERE `email` = '$email'";
        $data = $conn->query($select);
        while ($rows = mysqli_fetch_assoc($data)) {
            $userName = $rows["username"];
            $telePhone = $rows["telephone"];
            $birthDate = $rows["birth"];
            $Gender = $rows["gender"];
            $address = $rows["address"];
            $avatar = $rows["avatar"];
            $avatar_temp = "/image/man.png";
        }

        if (isset($_POST['logout'])) {

            unset($_SESSION['email']);

            header("Location: /pages/login.php");
            exit();
        }

        if(isset($_POST['editInfo'])) {
            $saveuserName = $_POST['username'];
            $savetelePhone = $_POST['telephone'];
            $savebirthDate = $_POST['birthdate'];
            $savegender = $_POST['gender'];
            $saveaddress = $_POST['address'];
    
            $update = "UPDATE `account` SET `username` = '$saveuserName', `telephone` = '$savetelePhone', 
            `birth` = '$savebirthDate', `gender` = '$savegender' , `address` = '$saveaddress' WHERE `email` = '$email'";
            mysqli_query($conn, $update);

            $select = "SELECT * FROM `account` WHERE `email` = '$email'";
            $data = $conn->query($select);
            while ($rows = mysqli_fetch_assoc($data)) {
                $userName = $rows["username"];
                $telePhone = $rows["telephone"];
                $birthDate = $rows["birth"];
                $Gender = $rows["gender"];
                $address = $rows["address"];
            }
        }

    } else {
        header("Location: /pages/login.php");
    }
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
    <title>Change Infomation</title>
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
                <img src="<?php echo(isset($avatar))? $avatar : $avatar_temp?>" alt="" class="rounded-full w-[30px] h-[30px]">
            </button>
        </div>

        <div class="w-[20%] h-max p-[10px] fixed bg-blue-50 right-[50px] top-[110px] rounded-[10px] gap-[10px] cursor-pointer tools-profile hidden">
            <a href="/pages/profile.php" class="flex items-center gap-[10px] border-b-2 border-gray-300 pb-[10px]">
                <div class="w-[40px] h-[40px] bg-gray-200 rounded-full text-gray-500 text-[26px]"><img src="<?php echo(isset($avatar))? $avatar : $avatar_temp?>" class="rounded-full w-[40px] h-[40px]" alt=""></div>
                <p class="font-semibold text-gray-500"><?php echo isset($userName) ? $userName : ''; ?></p>
            </a>

            <a href="/pages/changeInfo.php" class="flex items-center gap-[10px] border-b-2 border-gray-300 pb-[10px]">
                <div class="w-[40px] h-[40px] bg-gray-300 rounded-full text-gray-500 text-[26px] bx bx-cog flex items-center justify-center"></div>
                <p class="font-semibold text-gray-500">Edit Infomation</p>
            </a>

            <form action="" method="post">
                <button class="flex items-center gap-[10px]" name="logout" type="submit">
                    <div class="w-[40px] h-[40px] bg-gray-300 rounded-full text-gray-500 text-[26px] bx bx-log-out flex items-center justify-center"></div>
                    <p class="font-semibold text-gray-500">Logout</p>
                </button>
            </form>
        </div>
    </header>

    <main class="flex items-start justify-start gap-[20px] py-[10px] px-[150px] bg-gray-200 mt-[100px]">
        <div class="grid gap-[10px] w-[30%] py-[20px] bg-white rounded-[10px] px-[20px]">
            <div class="">
                <button class="w-full h-[40px] bg-gray-200 rounded-[10px] flex items-center gap-[10px] justify-between px-[10px] font-semibold">Edit Profile<i class='bx bx-chevron-right text-[30px]' ></i></button>
            </div>

            <div class="">
                <button class="w-full h-[40px] bg-gray-200 rounded-[10px] flex items-center gap-[10px] justify-between px-[10px] font-semibold">Change Password<i class='bx bx-chevron-right text-[30px]' ></i></button>
            </div>
        </div>

        <div class="grid gap-[10px] w-[70%] py-[20px] bg-white rounded-[10px] px-[20px]">
            <div class="border-[2px] w-full h-max px-[20px] rounded-[10px] grid gap-[10px] pt-[10px]">
                <span class="font-semibold">Infomation Profile</span>

                <form action="" class="border-t-[2px] py-[10px]" method="post">
                    <div class="flex items-center gap-[20px] justify-between border-b-[2px] pb-[10px]">
                        <span class="font-semibold text-gray-500 w-[25%]">Name User</span>
                        <div class="w-[50%] h-[40px] border-[2px] rounded-[5px] border-blue-200 flex items-center px-[10px]">
                            <input type="text" name="username" id="" class="outline-none ip-userName" readonly value="<?php echo isset($userName) ? $userName : ''; ?>">
                        </div>
                        <button class="w-[25%] h-[40px] bg-gray-200 font-semibold rounded-[5px] edit-username" type="button">Edit Name</button>
                    </div>

                    <div class="flex items-center gap-[20px] justify-between border-b-[2px] py-[10px]">
                        <span class="font-semibold text-gray-500 w-[25%]">Tele Phone</span>
                        <div class="w-[50%] h-[40px] border-[2px] rounded-[5px] border-blue-200 flex items-center px-[10px]">
                            <input type="text" name="telephone" id="" class="outline-none ip-telePhone" readonly value="<?php echo isset($telePhone) ? $telePhone : ''; ?>">
                        </div>
                        <button class="w-[25%] h-[40px] bg-gray-200 font-semibold rounded-[5px] edit-telePhone" type="button">Edit Tele Phone</button>
                    </div>

                    <div class="flex items-center gap-[20px] justify-between border-b-[2px] py-[10px]">
                        <span class="font-semibold text-gray-500 w-[25%]">Birth date</span>
                        <div class="w-[50%] h-[40px] border-[2px] rounded-[5px] border-blue-200 flex items-center px-[10px]">
                            <input type="date" name="birthdate" id="" class="outline-none ip-birthDate" readonly value="<?php echo isset($birthDate) ? $birthDate : ''; ?>">
                        </div>
                        <button class="w-[25%] h-[40px] bg-gray-200 font-semibold rounded-[5px] edit-birthDate" type="button">Edit Birth Date</button>
                    </div>

                    <div class="flex items-center gap-[20px] justify-between border-b-[2px] py-[10px]">
                        <span class="font-semibold text-gray-500 w-[25%]">Gender</span>
                        <div class="w-[50%] h-[40px] border-[2px] rounded-[5px] border-blue-200 flex items-center px-[10px]">
                            <input type="text" name="gender" class="gender outline-none ip-Gender" value="<?php echo isset($Gender) ? $Gender : ''; ?>" readonly>
                            <select name="gender-save" id="gender" class="outline-none">
                                <option value="1" disabled selected>Select Gender</option>
                                <option value="2">Male</option>
                                <option value="3">Female</option>
                                <option value="4">Other</option>
                            </select>
                        </div>
                        <button class="w-[25%] h-[40px] bg-gray-200 font-semibold rounded-[5px] edit-Gender" type="button">Edit Gender</button>
                    </div>

                    <div class="flex items-center gap-[20px] justify-between border-b-[2px] py-[10px]">
                        <span class="font-semibold text-gray-500 w-[25%]">Address</span>
                        <div class="w-[50%] h-[40px] border-[2px] rounded-[5px] border-blue-200 flex items-center px-[10px]">
                            <input type="text" name="address" id="" class="outline-none ip-address" readonly value="<?php echo isset($address) ? $address : ''; ?>">
                        </div>
                        <button class="w-[25%] h-[40px] bg-gray-200 font-semibold rounded-[5px] edit-address" type="button">Edit Address</button>
                    </div>

                    <div class="flex items-center gap-[20px] py-[10px]">
                        <button class="w-[40%] h-[50px] bg-blue-300 rounded-[5px] font-semibold" name="editInfo" type="submit">Save Infomation</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="/script/home.js"></script>
    <script src="/script/changeInfo.js"></script>
    <script src="/script/register.js"></script>
</body>

</html>