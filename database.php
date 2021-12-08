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
    $restaurants = $db->query("select RID, name, category from restaurants");
    while ($entry = $restaurants->fetch()){
        ?>
        <div>
            <a href="detail.php?id="<?=$entry['RID']?>><?=$entry['name']?></a>
            <h4><?=$entry['category']?></h4>
        </div>
<?php
    }
}

function display_menu($db, $id){
    $menu = $db->query('select name, description, price from menu_items where RID = ' . $id);
    while($item = $menu ->fetch()){
        ?>
            <div>
                <h3><?=$item['name']?></h3>
                <p><?=$item['description']?></p>
                <p><?=$item['price']?></p>
            </div>
<?php
    }
}

function display_restaurant_detail($db, $id){
    $restaurant = $db->query('select name, category, AID from restaurants where RID = ' . $id);
    $r_temp = $restaurant->fetch();
    $r_address = $db->query('select street, city, state, zip, phone from address where AID = '.$r_temp['AID']);
    $temp[] = $r_address->fetch()
    ?>
    <div>
        <h1><?=$r_temp['name']?></h1>
        <h2><?=$r_temp['category']?></h2>
        <p><?=$temp['street']. ', '.$temp['city'].' '.$temp['state']. ', '.$temp['zip'].'. Phone Number= '.$temp['phone']?></p>
    </div>
<?php
}