<?php error_reporting(-1);?>

<?php
    include_once "dbhandler.php";
    $httpMethod = $_SERVER["REQUEST_METHOD"];
    $allowedMethods = ["GET", "POST", "DELETE"];

    if(!in_array($httpMethod, $allowedMethods)) {
        sendError(405, "Only the following methods are allowed: POST, GET & DELETE");
    }

    //get whole DB and push into local array in data.js
    if($httpMethod === "GET") {

    }

    //lägga till i databasen (under Palettes)
    if($httpMethod === "POST") {

    }

    //tar bort respektive palette från databasen (görs med hjälp av id:n)
    if($httpMethod === "DELETE") {

    }
?>