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
    <title>Register Pushan</title>
</head>

<body class="bg-gray-200">
    <section class="flex w-full h-[800px] items-center justify-center text-center">

        <div class="w-max grid justify-center items-center shadow-md h-max p-[50px] bg-white rounded-[10px]">
            <form action="/controller/RegisterController.php" method="post">
                <h1 class="text-[20px] font-semibold">Register Account</h1> 
                <p class="text-gray-500 text-left">It's quick and easy.</p>

                <div class="grid gap-[20px] my-[30px]">
                    <div class="w-[420px] border-b-[2px] border-black">
                        <input type="text" name="email"placeholder="Email address or phone number" value="<?php echo isset($email) ? $email : ''; ?>" class="outline-none py-[5px] w-full">
                    </div>
    
                    <div class="w-[420px] border-b-[2px] border-black flex items-center">
                        <input type="password" name="password" placeholder="Password" value="<?php echo isset($password) ? $password : ''; ?>" class="outline-none py-[5px] w-full pr-[10px] password">
                        <i class='bx bx-low-vision'></i>
                    </div>
                    
                    <div class="w-[420px] border-b-[2px] border-black">
                        <input type="text" name="username" placeholder="User Name" value="<?php echo isset($username) ? $username : ''; ?>" class="outline-none py-[5px] w-full">
                    </div>

                    <div class="w-[420px] border-b-[2px] border-black">
                        <input type="date" name="birth" value="<?php echo isset($birthdate) ? $birthdate : ''; ?>" class="outline-none py-[5px] w-full">
                    </div>

                    <div class="w-[420px] border-b-[2px] border-black flex items-center justify-between">
                        <input type="text" name="gender" class="gender outline-none" value="<?php echo isset($gender) ? $gender : ''; ?>" readonly placeholder="Gender">
                        <select name="gender-save" id="gender" class="outline-none">
                            <option value="1" disabled selected>Select Gender</option>
                            <option value="2">Male</option>
                            <option value="3">Female</option>
                            <option value="4">Other</option>
                        </select>
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

                    <button type="submit" name="submit-register" class="font-semibold text-[20px] w-full h-[50px] text-center bg-mainColors rounded-[5px] text-white">Register</button>

                    <a href="" class="text-right">Forgotten password?</a>

                    <div class="w-full h-[1px] bg-gray-500"></div>

                    <a href="/pages/login.php" class="text-blue-400">If you have an account, Login.</a>
                </div>
            </form>
        </div>
    </section>

    <script src="/script/register.js"></script>
</body>

</html>