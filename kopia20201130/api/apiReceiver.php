<?php error_reporting(-1); ?>

<?php
    include_once "dbhandler.php";
    $httpMethod = $_SERVER["REQUEST_METHOD"];
    $allowedMethods = ["GET", "POST", "DELETE"];

    if(!in_array($httpMethod, $allowedMethods)) {
        sendError(405, "Only the following methods are allowed: POST, GET & DELETE");
    }

    //get whole DB and push into local array in data.js
    if($httpMethod === "GET") {
        // $db = getDB();
        // $json = json_encode($db);
        $file = "database.json";
        $data = file_get_contents($file);
  
        $database = json_decode($data, true); 

        http_response_code(200);
        //VI MÅSTE LISTA UT VARFÖR DET FUNGERAR NÄR VI TAR BORT HEADER. ENLIGT ERROR SKICKAS DET REDAN????
        // HMMMMMMMMmmdmkslc
        // header("Content-Type: application/json");
        $json = [
            "users" => $database["users"],
            "palettes" => $database["palettes"]
        ];
        echo json_encode($json);
        exit();
    }

    //lägga till i databasen (under Palettes)
    if($httpMethod === "POST") {
        //hämta in datan som skickas med post
        //skriva till databasen med respektive nyckel
        $file = "database.json";
        //läsa (getDB decodar databasen åt oss)
        // $db = getDB();
        //tror problem med getDB();

        //hämta databas
        $database = file_get_contents("database.json");
        $db = json_decode($database, true);

        $palettes = $db["palettes"];
        $users = $db["users"];

        //hämta datan som skickades
        $data = file_get_contents("php://input");
        $newPal = json_decode($data, true);
        $palettes[] = $newPal;

        $newDb = ["users" => $users, "palettes" => $palettes];
        $json = json_encode($newDb, JSON_PRETTY_PRINT);
        file_put_contents($file, $json);

        // setDB($palettes);

        // header("Content-Type: application/json");
        echo $json;
        http_response_code(203);
        exit(); 
    }

    //tar bort respektive palette från databasen (görs med hjälp av id:n)
    if($httpMethod === "DELETE") {
        //hämta databas och gör läsbar för PHP
        $file = "database.json";
        $database = file_get_contents($file);
        $db = json_decode($database, true);

        $palettes = $db["palettes"];
        $users = $db["users"];

        //hämta datan som skickats
        $data = file_get_contents("php://input");
        $delReq = json_decode($data, true);

        foreach ($palettes as $index => $palette) {
            if ($palette["id"] == $delReq["id"]) {
                array_splice($palettes, $index, 1);
            }
        }      

        $newDb = ["users" => $users, "palettes" => $palettes];
        $json = json_encode($newDb, JSON_PRETTY_PRINT);
        file_put_contents($file, $json);
        http_response_code(200);
        echo json_encode(["Remaining Palettes" => $palettes]);
        exit(); 
    }

?>
