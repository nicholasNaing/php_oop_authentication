<?php 
    include_once "../includeClass.php";

    session_start();

    // Check if user is not logged in, redirect to login page
    if (!$_SESSION['user_info']) {
        header("Location: Login.php");
    } else { 

    // Create UserContr instance for user-related operations
    $users_object = new UserContr;

    // Get all users for display
    $all_users_data = $users_object->getAllUsers();

    // Initialize variables
    $method;
    $select_user_data = NULL;
    $db_queries_first = "
    <div class='flex justify-center items-center'>
        <form action='' method='post' class='flex justify-center items-center gap-3'>
            <input type='hidden' name='user-key' value=";
    $db_queries_second = ">
                <button class='bg-green-400 py-1 px-2 rounded-md' type='submit' name='view'>view</button>
                <button class='bg-orange-400 py-1 px-2 rounded-md' type='submit' name='edit'>edit</button>
                <button class='bg-red-400 py-1 px-2 rounded-md' type='submit' name='delete'>delete</button>
            </form>
        </div>";
    // Check if 'view', 'edit', or 'delete' is submitted
    if (isset($_POST['view'])) {
        $method = 'view';
        $select_user_data = $users_object->showUser($_POST['user-key']);
        $_SESSION['user_email'] = $_POST['user-key'];
    } else if (isset($_POST['edit'])) {
        $method = 'edit';
        $select_user_data = $users_object->showUser($_POST['user-key']);
        $_SESSION['user_email'] = $_POST['user-key'];
    } else if (isset($_POST['delete'])) {
        $method = 'delete';
        $_SESSION['user_email'] = $_POST['user-key'];

        // Confirmation form for delete
        $confirm_delete = "
        <form method='post' class='fixed flex flex-col justify-center items-center p-3 bg-slate-500 gap-3 rounded-md left-[50%] top-[50%] translate-x-[-50%] translate-y-[-50%]'>
            <div>Are you sure you want to remove ".$_SESSION['user_email']."?</div>
            <div class='flex p-3 gap-3'>
                <button class='bg-slate-200 py-1 px-2 rounded-md' type='submit' name='cancel'>cancel</button>
                <button class='bg-blue-400 py-1 px-2 rounded-md' type='submit' name='confirm'>confirm</button>
            </div>
        </form>";
        echo $confirm_delete;
    }

    // Process confirmation and remove user
    if (isset($_POST['confirm'])) {
        $users_object->removeUser($_SESSION['user_email']);
        header("Location: {$_SERVER['PHP_SELF']}");
    }

    // Process form submission for user update
    if (isset($_POST['submit'])) {
        $update_user_obj = new UpdateInfo($_POST['username'],$_POST['email'],$_POST['pwd_first'],$_POST['pwd_repeat'],$_POST['bd'],$_SESSION['user_email']);
        header("Location: {$_SERVER['PHP_SELF']}"); // Refresh the page to show changes
        exit();
    }

    // Logout functionality
    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: {$_SERVER['PHP_SELF']}");
    }

    // HTML and Tailwind CSS styles start here
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
    <!-- Navigation bar displaying username and logout button -->
    <div class='w-screen h-[50px] bg-slate-400 flex justify-end items-center pr-4 gap-3'>
        <div><?php echo $_SESSION['user_info']['Username']?></div>
        <form method='post'><button type='submit' class='bg-blue-600 py-1 px-2 rounded-md' name='logout'>Log out</button></form>
    </div>

    <!-- Welcome message -->
    <div class='text-xl font-bold my-5 text-center'>Welcome from the Admin Dashboard</div>

    <!-- Table header -->
    <div class='border border-black border-width-3 grid grid-cols-3 grid-row-1 py-3'>
        <div class='flex justify-center items-center'>Username</div>
        <div class='flex justify-center items-center'>Email</div>
        <div class='flex justify-center items-center'>Options</div>
    </div>

    <?php 
        // Display user data in a grid
        for($i=0; $i<count($all_users_data); $i++){
            echo "<div class='grid grid-cols-3 py-3'>";
                echo "<div class='flex justify-center items-center'>".$all_users_data[$i]['Username']."</div>";
                echo "<div class='flex justify-center items-center'>".$all_users_data[$i]['Email']."</div>";
                echo $db_queries_first.$all_users_data[$i]['Email'].$db_queries_second;
            echo "</div>";
        }

        // Display user details if 'view' is selected
        if($select_user_data && $method=='view'){
            echo "<div class='bg-slate-700 text-slate-200 text-center font-bold text-lg py-2'>User details</div>";
            echo "<div class='bg-slate-700 text-slate-200 text-center py-3'><b>Username - </b>".$select_user_data['Username']."</div>";
            echo "<div class='bg-slate-700 text-slate-200 text-center py-3'><b>Email - </b>".$select_user_data['Email']."</div>";
            echo "<div class='bg-slate-700 text-slate-200 text-center py-3'><b>Birthday - </b>".$select_user_data['Birthday']."</div>";
            echo "<div class='bg-slate-700 text-slate-200 text-center py-3'><b>Password - </b>".$select_user_data['Password']."</div>";
        }

        // Display form for user edit if 'edit' is selected
        if($select_user_data && $method=='edit'){ ?>
            <form method='post' class='flex justify-center items-center gap-2 flex-col bg-slate-600 py-3 rounded-lg'>
                <legend class='text-xl font-bold'>Edit your data</legend>
                <div class='w-screen text-center'>
                    <input class='p-1 rounded-md' type="text" name="username" value=<?php echo $select_user_data['Username'] ?> required>        
                </div>
                <div class='w-screen text-center'>
                    <input class='p-1 rounded-md' type="text" name="email" value=<?php echo $select_user_data['Email'] ?> require>        
                </div>
                <div class='w-screen text-center'>
                    <input class='p-1 rounded-md' type="date" value=<?php echo $select_user_data['Birthday'] ?> name="bd" require>        
                </div>
                <div class='w-screen text-center'>
                    <input class='p-1 rounded-md' type="text" name="pwd_first" value=<?php echo $select_user_data['Password'] ?> required>        
                </div>
                <div class='w-screen text-center'>
                    <input class='p-1 rounded-md' type="text" name="pwd_repeat" value=<?php echo $select_user_data['Password'] ?> required>        
                </div>
                <button class='bg-blue-700 rounded-md py-1 px-2 text-white' type="submit" name="submit">Submit</button>
            </form>
        <?php }
    ?>
</body>
</html>
<?php } ?>
