<?php 
    include_once "../Controller/SignupContr.class.php";

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $pwd_first = $_POST['pwd_first'];
        $pwd_repeat = $_POST['pwd_repeat'];
        $birthday = $_POST['bd'];

        $reg_user = new SignupContr($username,$email,$pwd_first,$pwd_repeat,$birthday);
    }    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
    <form method='post' class='w-screen h-screen bg-slate-600 py-3 px-3 flex justify-center items-center flex-col'>
        <legend class='font-bold text-lg mb-4 text-white'>Registration form</legend>
        <div class='flex justify-center items-center flex-col gap-4'>
            <input class='py-1 px-2 rounded-md' type="text" name="username" placeholder="Enter your Username" required>        
            <input class='py-1 px-2 rounded-md' type="text" name="email" placeholder="Enter your Email" required>        
            <input class='py-1 px-2 rounded-md' type="date" name="bd" require>        
            <input class='py-1 px-2 rounded-md' type="password" name="pwd_first" placeholder="Enter your password" required>        
            <input class='py-1 px-2 rounded-md' type="password" name="pwd_repeat" placeholder="Confirm your password" required>        
        </div>
        <button class='bg-white flex justify-center items-center mt-3 rounded-md py-1 px-2' type="submit" name="submit">Sign up</button>
        <a class='bg-blue-500 flex justify-center items-center mt-3 rounded-md py-2 px-3 text-white' href='Login.php'>Log into you account</a>
    </form>
</body>
</html>