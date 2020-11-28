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
?>