<?php error_reporting(-1);?>

<?php
    session_start();
    include_once "api/dbhandler.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Palettes</title> 
        <link rel="stylesheet" href="style.css">
        <link rel="icon shortcut" href="assetts/palette.png">
    </head>
    <body>
        <main>
            <header>
                <div>MY PALETTES</div>
                <div id="login">
                    <?php if(isset($_SESSION["username"])) {?>
                        Logged in as <?=$_SESSION["username"]?> (<a href="logout.php"></a>)
                    <?php } else { ?>
                        <form id="loginForm" action="admin/login.php" method="POST">
                            <input type="text" name="username" placeholder="Username">
                            <input type="password" name="password" placeholder="Password">
                            <button type="submit">login</button>
                        </form>
                    <?php } ?>
                </div>
            </header>
            <div id="palettes"></div>
        </main>
        <script src="scripts/jquery-3.4.1.min.js"></script>
        <script src="scripts/functions.js"></script>
        <script src="scripts/ajax.js"></script>
    </body>
</html>