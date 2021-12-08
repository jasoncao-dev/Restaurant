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
                <a href="detail.php?id=<?=$entry['RID']?>"><?=$entry['name']?></a>
                <h4><?=$entry['category']?></h4>
            </div>
            <?php
        }
}

function display_menu($db, $id){
    $menu = $db->query('select MID, name, description, price from menu_items where RID = ' . $id);
    if(session_status()){
    while($item = $menu->fetch()){
        ?>
            <div>
                <h3><?=$item['name']?></h3>
                <p><?=$item['description']?></p>
                <p><?=$item['price']?></p>
                <a href="addorder.php?id=<?=$item['MID']?>" <button type="submit">ADD To Order</button>
            </div>
<?php
    }
}
    else{
        while($item = $menu->fetch()){
            ?>
            <div>
                <h3><?=$item['name']?></h3>
                <p><?=$item['description']?></p>
                <p><?=$item['price']?></p>
            </div>
            <?php
        }
    }
}

function display_restaurant_detail($db, $id){
    $restaurant = $db->query('select name, category, AID from restaurants where RID = ' . $id);
    $r_temp = $restaurant->fetch();
    $r_address = $db->query('select street, city, state, zip, phone from address where AID = '.$r_temp['AID']);
    $a_temp[] = $r_address->fetch();
    print_r($a_temp);
    print_r($r_temp);
    ?>
    <div>
        <h1><?=$r_temp['name']?></h1>
        <h2><?=$r_temp['category']?></h2>
        <p><?=$a_temp[0]['street'], ', ',$a_temp[0]['city'],' ',$a_temp[0]['state'], ', ',$a_temp[0]['zip'],'. Phone Number= ',$a_temp[0]['phone']?></p>
    </div>
<?php
}

function create_user($user_array, $db){
    $db->query($db->query("INSERT INTO address(AID, street, city, state, zip, phone) VALUES (NULL, '".$user_array['street']."', '".$user_array['city']."', '".$user_array['state']."','".$user_array['zip']."', '".$user_array['phone']."'"));
    $AID = $db->lastInsertId();
    $db->query("insert into auth(pid, password) values(null, '".$user_array['password']."')");
    $PID = $db->lastInsertID();
    $db->query("insert into users(uid, aid, pid, name, email, isauth) values(null, '".$AID."','".$PID."', '".$user_array['name']."', '".$user_array['email']."', null)");
}

function check_if_exists($db, $table, $element, $value): bool{
    $temp = $db->query("select count(1) from '".$table."' where '".$element."' = '".$value."'");
    if($temp > 0){return true;}
    else{return false;}
}

function check_password($db, $email, $pass): bool{
    $PID = $db->query("select PID from users where email = '".$email."'");
    $temp = $db->query("select password from auth where PID = '".$PID."'");
    return ($temp == $pass);
}