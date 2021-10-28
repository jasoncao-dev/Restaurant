create table restaurants (
    RID varchar(25) primary key,
    name varchar(25),
    category varchar(25),
    street varchar(30),
    city varchar(20),
    zip varchar(10),
    phone varchar(10)
);
create table users(
    UID varchar(25) primary key,
    AID varchar(25) unique,
    name varchar(25),
    email varchar(50),
    street varchar(30),
    city varchar(20),
    zip varchar(10),
    phone varchar(10)
);
create table menu_items(
    MID varchar(25) primary key,
    RID varchar(25) references Restaurant_list,
    name varchar(30),
    description varchar(60),
    price int
);
create table order_list(
    OID varchar(25) primary key,
    RID varchar(25) references Restaurant_list,
    UID varchar(25) references users
);
create table order_items(
    OID varchar(25) references order_list,
    MID varchar(25) references menu_items,
    amount int,
    alterations varchar(60)
);
create table auth(
    AID varchar(25) references users,
    password varchar(30)
);
create table is_admin(
    AID varchar(25) references users,
    admin boolean
);
