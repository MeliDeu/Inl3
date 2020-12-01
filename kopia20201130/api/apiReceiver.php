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
        $db = getDB();
        $json = json_encode($db);
        header("Content-Type: application/json");
        http_response_code(200);
        echo $json;
        exit();
    }

    //lägga till i databasen (under Palettes)
    if($httpMethod === "POST") {
        //hämta in datan som skickas med post
        //skriva till databasen med respektive nyckel
        $db = getDB();
        $json = json_decode($db);

        $data = $_POST;
        $json["palettes"][] = $data;

        setDB($json);
        header("Content-Type: application/json");
        http_response_code(203);
        exit();
    }

    //tar bort respektive palette från databasen (görs med hjälp av id:n)
    if($httpMethod === "DELETE") {

    }
?>