<?php 
    include_once "../Controller/LoginContr.class.php";

    session_start();

    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];

        $user_obj = new LoginContr($email,$pwd);
        $user_info = $user_obj->passedUser();
        if($user_info){
            session_start();
            $_SESSION['user_info'] = $user_info;
            header("Location: http://localhost/authentication/View/index.php");
            exit();
        }else{
            print_r($user_info);
            echo "<div class='absolute w-screen text-center py-1 bg-slate-100 text-red-500 text-md font-bold'>Log in failed</div>";
        }

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
        <legend class='font-bold text-lg mb-4 text-white'>Login form</legend>
        <div class='flex justify-center items-center flex-col gap-4'>
            <input class='py-1 px-2 rounded-md' type="text" name="email" placeholder="Enter your Email" required>        
            <input class='py-1 px-2 rounded-md' type="password" name="pwd" placeholder="Ennter your password" required>        
        </div>
        <button class='bg-white flex justify-center items-center mt-3 rounded-md py-1 px-2' type="submit" name="submit">Log in</button>
        <a class='bg-green-500 flex justify-center items-center mt-3 rounded-md py-2 px-3 text-white' href='Signup.php'>Register new account</a>
    </form>
</body>
</html>