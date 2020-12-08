<?php error_reporting(-1);?>

<!-- hejsan svejsan -->

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
                    Logged in as <?=$_SESSION["username"]?> (<a href="admin/logout.php">logout</a>)
                <?php } else {?>
                    <form id="loginForm">
                        <input type="text" id="username" placeholder="Username">
                        <input type="password" id="password" placeholder="Password">
                        <button id="submit">login</button>
                    </form>
                <?php } ?>
            </div>
        </header>
        <div id="palettes">
            <div id="userPalettes">
                <div id="controls">
                    <?php if(isset($_SESSION["username"])) {?>
                    <button>Add new Palette</button>
                    <div id="sortBtns">
                        <p><a href="#">By Name</a> | <a href="#">By Date</a></p>
                    </div>
                    <?php } else {?>
                        <p>Log in to see your palettes</p>
                    <?php } ?>
                </div>
            </div>
            <div id="allPalettes">
                <div id="showAll">
                    <p>Palettes by other users</p>
                </div>
                <div id="allUsersPalettes"></div>
            </div>
        </div>
        <script src="scripts/jquery-3.4.1.min.js"></script>
        <script src="scripts/data.js"></script>
        <script src="scripts/classes.js"></script>
        <script src="scripts/functions.js"></script>
        <script src="scripts/ajax.js"></script>
    </body>
</html>