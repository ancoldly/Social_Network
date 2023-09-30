<?php
require('../connectDB/connect.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['email'])) {
    header("Location: /index.php");
    exit;
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
    <title>Login Pushan</title>
</head>

<body class="bg-gray-200">
    <section class="flex flex-col gap-[50px] w-full h-[800px] items-center justify-center text-center">
        <div class="w-full">
            <h1 class="font-bold text-[32px] text-mainColors">Fushan</h1>
            <p class="text-[20px] font-semibold">Pushan helps you connect and share with people in your life.</p>
        </div>

        <div class="w-max grid justify-center items-center shadow-md h-max p-[50px] bg-white rounded-[10px]">
            <form method="post" action="/controller/LoginController.php">
                <h1 class="text-[20px] font-semibold">Login Account</h1>

                <div class="grid gap-[20px] my-[30px]">
                    <div class="w-[420px] border-b-[2px] border-black">
                        <input type="text" placeholder="Email address or phone number" name="email" value="<?php echo isset($email) ? $email : ''; ?>" class="outline-none py-[5px] w-full">
                    </div>
    
                    <div class="w-[420px] border-b-[2px] border-black">
                        <input type="password" placeholder="Password" name="password" value="<?php echo isset($password) ? $password : ''; ?>" class="outline-none py-[5px] w-full">
                    </div>

                    <?php if (!empty($err)): ?>
                        <div class="error-message">
                            <ul>
                                <?php foreach ($err as $error): ?>
                                    <li class="text-red-500"><?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <button type="submit" name="submit-login" method="post" accto class="font-semibold text-[20px] w-full h-[50px] text-center bg-mainColors rounded-[5px] text-white">Login</button>

                    <a href="" class="text-right">Forgotten password?</a>

                    <div class="w-full h-[1px] bg-gray-500"></div>

                    <a href="/pages/register.php" class="text-blue-400">If you don't have an account, Register.</a>
                </div>
            </form>
        </div>
    </section>
</body>

</html>