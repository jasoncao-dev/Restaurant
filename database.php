<?php

$host='us-cdbr-east-04.cleardb.com';
$dbname='heroku_a794d8c2b9b962d';
$user='b28c7b4922770e';
$pass='1dc7b872';
$charset='utf8mb4';

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
$db = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . ';charset=' . $charset, $user, $pass, $options);


function display_restaurant_list($db){
    $restaurants = $db->query("select name, category from restaurants");
    while ($entry = $restaurants->fetch()){
        ?>
        <div>
            <h2><?=$entry['name']?></h2>
            <h4><?=$entry['category']?></h4>
        </div>
<?php
    }
}