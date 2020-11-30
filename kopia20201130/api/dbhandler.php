<?php error_reporting(-1);?>

<?php
  // php-fil för all kommunikation med databasen, getdb(), setdb(), deletePalette(), getPaletteByUser()
  $database = "database.json";
  $base = [
      "users" => [
          ["id" => 1, "name" => "melanie", "password" => "12345"],
          ["id" => 2, "name" => "lolle", "password" => "12345"],
          ["id" => 3, "name" => "erbarnicus", "password" => "12345"]
      ],
      "palettes" => []
  ];

  if(!file_exists($database)){
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

    $json = json_decode($database, true);

    if ($json === null) {
        return $base;
    }
    // skicka php-arrays från databasen
    return $json;
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