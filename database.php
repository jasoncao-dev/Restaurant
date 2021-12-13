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
    $restaurants = $db->query("select RID, name, category, AID, image from restaurants");
        while ($entry = $restaurants->fetch()) {
            $r_address = $db->query('select street, city, state, zip, phone from address where AID = '.$entry['AID']);
            $a_temp = $r_address->fetch();
            ?>
            <div class="col">
                <a href="detail.php?id=<?=$entry['RID']?>" class="text-decoration-none">
                    <div class="card h-100">
                        <img src="<?=$entry['image']?>" class="card-img-top">
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
                            <button value="<?=$item['MID']?>" class="add-to-order btn btn-sm btn-color rounded-pill text-light">Add to order</button>
                        </div>
                    </div>
                </div>
            </div>
<?php
    }
}

function display_menu_in_cart($db, $id){
    $menu = $db->query('select MID, name, description, price, image from menu_items where RID = ' . $id);
        while($item = $menu->fetch()) {?>
            <div id="<?=$item['MID']?>" class="card mb-2 d-none">
                 <div class="row g-1">
                    <div class="col-md-4">
                        <img src="<?=$item['image']?>" class="img-fluid rounded-start menu-thumbnail" style="width: 5rem; height: 5rem;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?=$item['name']?></h5>
                            <p class="card-text"><small class="text-muted"><?=$item['price']?></small></p>
                        </div>
                    </div>
                </div>
            </div>
<?php
    }
}

function display_restaurant_detail($db, $id) {
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
    echo '<pre>';
    print_r($user_array);
    echo '</pre>';
    echo "insert into address(AID, street, city, state, zip, phone) values(null, '".$user_array['street']."', '".$user_array['city']."', '".$user_array['state']."','".$user_array['zip']."', '".$user_array['phone']."')";
    $db->query($db->query("insert into address(AID, street, city, state, zip, phone) values(null, '".$user_array['street']."', '".$user_array['city']."', '".$user_array['state']."','".$user_array['zip']."', '".$user_array['phone']."')"));
    $AID = $db->lastInsertId();
    //$db->query("insert into auth(pid, password) values(null, '".$user_array['password']."')");
    //$PID = $db->lastInsertID();
    $db->query("insert into users(uid, aid, password, name, email, isAuth) values(null, '".$AID."','".$user_array['password']."', '".$user_array['name']."', '".$user_array['email']."', 0)");
}

function check_if_exists($db, $table, $element, $value): bool{
    //echo "select * from ".$table." where '".$element."' = '".$value."'";
    //die();
    $temp = $db->query("select * from ".$table." where ".$element." = '".$value."'");
    $result = $temp->fetch();
    return count($result) > 0;
}

function check_password($db, $email, $user_password): bool{
    $temp = $db->query("select password from users where email = '".$email."'");
    $password = $temp->fetch();
    print_r($password);
    if (password_verify($user_password, $password['password'])) {
        echo "Password is correct.";
    } else {
        echo "Password is not correct";
    }
    return password_verify($user_password, $password['password']);
}

function get_name_by_email($db, $email): string {
    $temp = $db->query("select name from users where email = '".$email."'");
    return $temp->fetch()['name'];
}

function get_uid($db, $email): string {
    $uid = $db->query("select UID from users where email = '".$email."'");
    return $uid->fetch()['UID'];
}

function get_user($db, $uid) {
    $temp = $db->query("select aid, name, email from users where uid = ".$uid."");
    $user = $temp->fetch();
    $temp = $db->query("select street, city, state, zip, phone from address where aid = ".$user['aid']."");
    $user_address = $temp->fetch();
    $user['street'] = $user_address['street'];
    $user['city'] = $user_address['city'];
    $user['state'] = $user_address['state'];
    $user['zip'] = $user_address['zip'];
    $user['phone'] = $user_address['phone'];
    return $user;
}

function check_is_admin($db, $uid): bool {
    $temp = $db->query("select isAuth from users where uid = ".$uid."");
    $user = $temp->fetch();
    if ($user['isAuth'] == 1) return true; else return false;
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

function add_menu_item($db, $menu_item) {
    echo "<pre>";
    print_r($menu_item);
    $db->query("insert into menu_items(mid, rid, name, description, price, image) values(null, ".$menu_item['rid'].",'".$menu_item['name']."', '".$menu_item['description']."', '".$menu_item['price']."', '".$menu_item['image']."')");
}

function add_restaurant($db, $restaurant) {
    echo "<pre>";
    $db->query("insert into address(AID, street, city, state, zip, phone) values(null, '".$restaurant['street']."', '".$restaurant['city']."', '".$restaurant['state']."','".$restaurant['zip']."', '".$restaurant['phone']."')");
    $aid = $db->lastInsertId();
    echo "insert into restaurants(rid, name, category, aid, image) values(null, '".$restaurant['name']."','".$restaurant['category']."', ".$aid.", '".$restaurant['image']."')";
    $db->query("insert into restaurants(rid, name, category, aid, image) values(null, '".$restaurant['name']."','".$restaurant['category']."', ".$aid.", '".$restaurant['image']."')");
}
