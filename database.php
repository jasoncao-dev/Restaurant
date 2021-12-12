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


function display_restaurant_list($db) {
    $restaurants = $db->query("select RID, name, category, image from restaurants");
        while ($entry = $restaurants->fetch()) {
            $r_address = $db->query('select street, city, state, zip, phone from address where AID = '.$entry['RID']);
            $a_temp = $r_address->fetch();
            ?>
            <div class="col">
                <a href="detail.php?id=<?=$entry['RID']?>" class="text-decoration-none">
                    <div class="card h-100">
                        <img src="<?=$entry['image']?>" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title text-dark"><?=$entry['name']?></h5>
                            <button class="btn btn-sm btn-color rounded-pill text-light"><?=$entry['category']?></button>
                            <p class="card-text text-muted pt-1"><?=$a_temp['street']?>, <?=$a_temp['city']?>, <?=$a_temp['state']?>
                                <?=$a_temp['zip']?></p>
                        </div>
                    </div>
                </a>
            </div>
<?php
        }
}

function display_menu($db, $id){
    $menu = $db->query('select MID, name, description, price, image from menu_items where RID = ' . $id);
    if(session_status()) {
        while($item = $menu->fetch()) {?>
            <div class="card mb-2" style="">
                 <div class="row g-1">
                    <div class="col-md-4">
                        <img src="<?=$item['image']?>" class="img-fluid rounded-start menu-thumbnail" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?=$item['name']?></h5>
                            <p class="card-text mb-0"><?=$item['description']?></p>
                            <p class="card-text"><small class="text-muted"><?=$item['price']?></small></p>
                            <button class="btn btn-sm btn-color rounded-pill text-light">Add to order</button>
                        </div>
                    </div>
                </div>
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

function display_restaurant_detail($db, $id): array{
    $restaurant = $db->query('select name, category, AID, image from restaurants where RID = ' . $id);
    $r_temp = $restaurant->fetch();
    $r_address = $db->query('select street, city, state, zip, phone from address where AID = '.$r_temp['AID']);
    $a_temp = $r_address->fetch();
    $result = array();
    $result['name'] = $r_temp['name'];
    $result['category'] = $r_temp['category'];
    $result['image'] = $r_temp['image'];
    $result['street'] = $a_temp['street'];
    $result['city'] = $a_temp['city'];
    $result['state'] = $a_temp['state'];
    $result['zip'] = $a_temp['zip'];
    $result['phone'] = $a_temp['phone'];
    return $result;
}

function create_user($user_array, $db){
    $db->query($db->query("INSERT INTO address(AID, street, city, state, zip, phone) 
        VALUES (NULL, '".$user_array['street']."', '".$user_array['city']."', '".$user_array['state']."','".$user_array['zip']."', '".$user_array['phone']."'"));
    $AID = $db->lastInsertId();
    $db->query("insert into users(uid, aid, password, name, email, isauth) values(null, '".$AID."','".$user_array['password']."', '".$user_array['name']."', '".$user_array['email']."', null)");
}

function check_if_exists($db, $table, $element, $value): bool{
    $temp = $db->query("select count(1) from '".$table."' where '".$element."' = '".$value."'");
    if($temp > 0){return true;}
    else{return false;}
}

function check_password($db, $email, $pass): bool{
    $temp = $db->query("select password from users where email = '".$email."'");
    return ($temp == $pass);
}

function get_uid($db, $email): string {
    $uid = $db->query("select UID from users where email = '".$email."'");
    return $uid->fetch('UID');
}

function checks_for_order($db, $UID): bool{
    $order = $db->query("select count(1) from order_list where UID = '".$UID."' and is_complete = 0");
    return($order->fetch('count') > 0);
}

function get_oid($db, $UID):string {
    $oid = $db->query("select OID from order_list where where UID = '".$UID."' and is_complete = 0");
    return $oid->fetch('OID');
}
function add_to_order($db, $MID, $number){
    $db->query("insert into order_items(oid, mid, amount) VALUES ('".$_SESSION['OID']."', '".$MID."', '".$number."')");
}

function create_oid($db, $UID): int{
    $db->query("insert into order_list(oid, uid, is_complete) values (null, '".$UID."', 0)");
    return $db->lastInsertId();
}

function display_cart($db):array{
    $cart = $db->query("select name, price, amount from order_items join menu_items mi on
    order_items.MID = mi.MID and order_items.OID ='".$_SESSION['OID']."'");
    return (array) $cart;
}

function close_order($db, $oid){
    $db->query("update order_list set is_complete = 1 where OID = '".$oid."'");
    $_SESSION['OID'] = create_oid($db, $_SESSION['UID']);
}

function get_aid($db): string{
    $aid = $db->query("select AID from users where UID = '".$_SESSION['UID']."'");
    return $aid->fetch('AID');
}
function update_user_address($db, $array){
    $db->query("update address set street = '".$array['street']."', city = '".$array['city']."', state = '".$array['state']."',
     zip = '".$array['zip']."', phone = '".$array['phone']."' where AID = '".get_aid($db)."'");
}
