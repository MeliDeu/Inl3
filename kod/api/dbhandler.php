<?php error_reporting(-1);?>
// id, name, password
// id, name, creatorID, date, colors
<?php
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
      $json = json_encode($base);
      file_put_contents($databs)
    }
?>