<?php
session_start();
error_reporting(-1);
?>

<?php
    include_once "api/dbhandler.php";
    $db = "api/database.json";
    if(!file_exists($db)){
        createDB();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Palettes</title> 
        <link rel="stylesheet" href="style.css">
        <link rel="icon shortcut" href="assetts/palette.png">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    </head>
    <body>
        <header>
            <div id="rubrik">
                <h1>MY PALETTES</h1>
            </div>
            <div id="login">
                <?php if(isset($_SESSION["username"])) {?>
                    Logged in as <span class="loggedInUser" id="A<?=$_SESSION["userID"]?>"><?=$_SESSION["username"]?></span> (<a href="admin/logout.php">logout</a>)
                <?php } else {?>
                    <span id="message"></span>
                    <form id="loginForm" action="admin/login.php" method="POST">
                        <input type="text" id="username" name="username" placeholder="Username">
                        <input type="password" id="password" name="password" placeholder="Password">
                        <button type="submit">login</button>
                </form>
                <?php } ?>
            </div>
        </header>
        <div id="palettes">
            <div id="userPalettes">
                <div id="controls" class="controls">
                    <?php if(isset($_SESSION["username"])) {?>
                        <button id="addPalette"><img src="assetts/icons/add.svg">Add new Palette</button>
                        <div id="sortBtns">
                        <p><a id="byName" href="#">By Name</a> | <a id="byDate" href="#">By Date</a></p>
                    </div>
                    <?php } else {?>
                        <p>Log in to see your palettes</p>
                    <?php } ?>
                </div>
                <div id="ownPalettes"></div>
            </div>
            <div id="allPalettes">
                <div id="showAll" class="controls">
                    <p>Palettes by other users</p>
                </div>
                <div id="allUsersPalettes"></div>
            </div>
        </div>
        <script>
        var data = 
        <?php  
        if(isset($_GET["error"])){
            echo $_GET["error"];
        } else {
            echo 0;
        } ?>;
        var loggedIn = <?php
        if(isset($_SESSION["username"])){
            echo $_SESSION["userID"];
            
        } else {
            echo 0;
        }
        ?>;
        </script>
        <script src="scripts/jquery-3.4.1.min.js"></script>
        <script src="scripts/data.js"></script>
        <script src="scripts/eriksKod.js"></script>
        <script src="scripts/functions.js"></script>
        <script src="scripts/classes.js"></script>
        <script src="scripts/ajax.js"></script>
       
    </body>
</html>