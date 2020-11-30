<?php error_reporting(-1);?>

<?php
  // php-fil för all kommunikation med databasen, getdb(), setdb(), deletePalette(), getPaletteByUser()
  // $database = "./inl3/api/database.json";
  $database = "../api/database.json";
  $base = [
      "users" => [
          ["id" => 1, "name" => "melanie", "password" => "12345"],
          ["id" => 2, "name" => "lolle", "password" => "12345"],
          ["id" => 3, "name" => "erbarnicus", "password" => "12345"]
      ],
      "palettes" => []
  ];

  function createDB(){
      global $base;
      $database = "api/database.json";
      $json = json_encode($base, JSON_PRETTY_PRINT);
      file_put_contents($database, $json);
  }

  function getDB(){
    //hämta in globala variabler
    global $database;
    global $base;
    // hämta filinnehåll
    $data = file_get_contents($database);

    //kontrollera innehåll..
    if ($data === false) {
        return $base;
    }

    $data = json_decode($database, true);

    if ($data === null) {
        return $base;
    }
    // skicka php-arrays från databasen
    return $data;
  }

  function sendError($statusCode = 400, $error = "Something went wrong. Call Melanie.") {
    //placera rätt error-code
    http_response_code($statusCode);
    //berätta det är json
    header("Content-Type: application/json");
    //encoda till json så vi inte ljuger
    $json = json_encode(["error" => $error]);
    // skicka vår lilla brevduva (som är ett error-meddelande som vi sedan kan ta emot i JS)
    echo $json;
    exit();
  }
?>