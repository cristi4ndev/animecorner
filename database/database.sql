CREATE DATABASE animecorner;
use animecorner;
CREATE TABLE users(
    id int(255) auto_increment,
    name varchar(100) not null,
    surname varchar(255),
    email varchar(255) not null,
    password varchar(255) not null,
    role varchar(20) not null,
    dni varchar(9) not null,
    CONSTRAINT user_id PRIMARY KEY(id),
    CONSTRAINT email UNIQUE(email)
) ENGINE = InnoDb;

////////////////////////////
insert into users ("Cristian","Argüeso","cristian@cr1stian.dev","1234","admin","76636049Z")
////////////////////////////



create TABLE categories (
    id int AUTO_INCREMENT PRIMARY KEY,
    name varchar(200) not null,
    parent int,
    FOREIGN KEY (parent) REFERENCES categories(id)
) ENGINE = InnoDb;
;
create TABLE products (
    id int AUTO_INCREMENT primary KEY,
    image varchar(500) not null,
    stock int NOT NULL,
    price double(10, 2) not null,
    created_at timestamp NOT NULL,
    name varchar(50) NOT NULL,
    description longtext NOT NULL,
    category_id int NOT NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id)
) ENGINE = InnoDb;
;
CREATE TABLE carriers (
    id int AUTO_INCREMENT PRIMARY KEY,
    price double(10, 2) NOT NULL,
    name varchar(200) NOT NULL
) ENGINE = InnoDb;
;
CREATE TABLE sagas (
    id int AUTO_INCREMENT PRIMARY KEY,
    name varchar(200) NOT NULL
) ENGINE = InnoDb;
;
CREATE TABLE characters (
    id int AUTO_INCREMENT PRIMARY KEY,
    name varchar(200) NOT NULL
) ENGINE = InnoDb;
CREATE TABLE product_characters (
    character_id int AUTO_INCREMENT,
    product_id int NOT NULL,
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (character_id) REFERENCES characters(id),
    PRIMARY KEY(character_id, product_id)
) ENGINE = InnoDb;
;
CREATE TABLE addresses (
    id int AUTO_INCREMENT PRIMARY KEY,
    country varchar(200) NOT NULL,
    province varchar(200) NOT NULL,
    postal_code int(5) NOT NULL,
    locality varchar(50) NOT NULL,
    address varchar(300) NOT NULL,
    phone int(9) NOT NULL,
    user_id int NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
) ENGINE = InnoDb;
;
create TABLE orders (
    id int AUTO_INCREMENT primary KEY,
    total double NOT NULL,
    created_at timestamp NOT NULL,
    product_id int NOT NULL,
    user_id int NOT NULL,
    carrier_id int NOT NULL,
    vat double NOT NULL,
    address_id int NOT NULL,
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (address_id) REFERENCES addresses(id)
) ENGINE = InnoDb;
;
create TABLE order_products(
    product_id int NOT NULL,
    order_id int NOT NULL,
    quantity int NOT NULL,
    subtotal double (10, 2) NOT NULL,
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (order_id) REFERENCES orders(id),
    PRIMARY KEY(product_id, order_id)
) ENGINE = InnoDb;
;