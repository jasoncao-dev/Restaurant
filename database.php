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
    $db->query("insert into users(uid, aid, password, name, email, isAuth) values(null, '".$AID."','".$user_array['password']."', '".$user_array['name']."', '".$user_array['email']."', null)");
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