CREATE DATABASE animecorner;
use animecorner;
CREATE TABLE users(
    id int(255) auto_increment not null,
    name varchar(100) not null,
    surname varchar(255),
    email varchar(255) not null,
    password varchar(255) not null,
    rol varchar(20),
    dni varchar(9),
    CONSTRAINT user_id PRIMARY KEY(id),
    CONSTRAINT email UNIQUE(email)
) ENGINE = InnoDb;

////////////////////////////
insert into users ("Cristian","Argüeso","cristian@cr1stian.dev","1234","admin","76636049Z")
////////////////////////////



create TABLE categories (
    id int AUTO_INCREMENT PRIMARY KEY,
    name varchar(200),
    parent int,
    FOREIGN KEY (parent) REFERENCES categories(id)
) ENGINE = InnoDb;
;
create TABLE products (
    id int AUTO_INCREMENT primary KEY,
    image varchar(500),
    stock int,
    price double(10, 2),
    created_at timestamp,
    name varchar(50),
    description longtext,
    category_id int,
    FOREIGN KEY (category_id) REFERENCES categories(id)
) ENGINE = InnoDb;
;
CREATE TABLE carriers (
    id int AUTO_INCREMENT PRIMARY KEY,
    price double(10, 2),
    name varchar(200)
) ENGINE = InnoDb;
;
CREATE TABLE sagas (
    id int AUTO_INCREMENT PRIMARY KEY,
    name varchar(200)
) ENGINE = InnoDb;
;
CREATE TABLE characters (
    id int AUTO_INCREMENT PRIMARY KEY,
    name varchar(200)
) ENGINE = InnoDb;
CREATE TABLE product_characters (
    character_id int,
    product_id int,
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (character_id) REFERENCES characters(id),
    PRIMARY KEY(character_id, product_id)
) ENGINE = InnoDb;
;
CREATE TABLE addresses (
    id int AUTO_INCREMENT PRIMARY KEY,
    country varchar(200),
    province varchar(200),
    postal_code int(5),
    locality varchar(50),
    address varchar(300),
    phone int(9),
    user_id int,
    FOREIGN KEY (user_id) REFERENCES users(id),
) ENGINE = InnoDb;
;
create TABLE orders (
    id int AUTO_INCREMENT primary KEY,
    total double,
    created_at timestamp,
    product_id int,
    user_id int,
    carrier_id int,
    vat double,
    address_id int,
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (address_id) REFERENCES addresses(id)
) ENGINE = InnoDb;
;
create TABLE order_products(
    product_id int,
    order_id int,
    quantity int,
    subtotal double (10, 2),
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (order_id) REFERENCES orders(id),
    PRIMARY KEY(product_id, order_id)
) ENGINE = InnoDb;
;