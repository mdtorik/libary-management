create database if not exists libary;
use libary;
drop table if exists lib_books;
create table lib_books(
   id int(20) primary key auto_increment,
   barcode int(50),
   title varchar(100),
   author varchar(20),
   catagory_id varchar(20),
   uom int(20),
   img_name varchar(50),
   price float
);
insert into lib_books(barcode,title,author,catagory_id,uom,img_name,price)values(5254,'Story of a programar','Milon sarkar','1','1','5.jpg',400);
insert into lib_books(barcode,title,author,catagory_id,uom,img_name,price)values(5255,'Fairy tales stories','samsurjaman','2','1','6.jpg',500);
insert into lib_books(barcode,title,author,catagory_id,uom,img_name,price)values(5256,'Bible story','karen jones','1','1','7.jpg',300);



drop table if exists lib_uom;
create table lib_uom(
  id int(20) primary key auto_increment,
  name varchar(20)
);
insert into lib_uom(name)values('pice');



drop table if exists lib_catagory;
create table lib_catagory(
id int(10) primary key auto_increment,
name varchar(20) not null,
created_at timestamp
);
insert into lib_catagory(name)values('Story');
insert into lib_catagory(name)values('Motivation');
insert into lib_catagory(name)values('History');




drop table if exists lib_roles;
create table lib_roles(
  id int(10) primary key auto_increment,
  name varchar(20) not null
);
insert into lib_roles(name)values('Admin');
insert into lib_roles(name)values('Editor');
insert into lib_roles(name)values('NetH');



drop table if exists lib_users;
create table lib_users(
  id int(10) primary key auto_increment,
  username varchar(20) not null,
  role_id int(10),
  password varchar(50),
  inactive float(10)
);
insert into lib_users(username,password,role_id,inactive)values('milon',md5('12345'),1,0);
insert into lib_users(username,password,role_id,inactive)values('toufik',md5('11111'),2,0);
insert into lib_users(username,password,role_id,inactive)values('thamid',md5('22222'),3,0);




drop table if exists lib_publishers;
create table lib_publishers(
id int(10) primary key auto_increment,
name varchar(50)
);
insert into lib_publishers(name)values('Random House');
insert into lib_publishers(name)values('Oxford University press');
insert into lib_publishers(name)values('informa');



drop table if exists lib_publishers_details;
create table lib_publishers_details(
  id int(50) primary key auto_increment,
  publishers_id int(20),
  name varchar(50),
  phone text,
  email text,
  address text
);
insert into lib_publishers_details(publishers_id,name,phone,email,address)values(1,'karim','01792456985','milon@gmail.com','tajgone,Dhaka');
insert into lib_publishers_details(publishers_id,name,phone,email,address)values(2,'kamal','01796794989','jaman@gmail.com','Bonosre Rampura');
insert into lib_publishers_details(publishers_id,name,phone,email,address)values(3,'jahid','01796712456','bakar@gmail.com','Dhanmondi dhaka');




drop table if exists lib_parchases;
create table lib_parchases(
  id int(20) primary key auto_increment,
  publishers_id int(50),
  parchases_date date,
  ref_no int(50),
  order_id int(20),
  payment_due date,
  account int(20)
);

insert into lib_parchases(publishers_id,parchases_date,ref_no,order_id,payment_due,account)values(1,'2020-11-20',1260,1230,'2020-11-23',33552266);
insert into lib_parchases(publishers_id,parchases_date,ref_no,order_id,payment_due,account)values(2,'2020-10-20',1560,1231,'2020-11-24',33552267);
insert into lib_parchases(publishers_id,parchases_date,ref_no,order_id,payment_due,account)values(3,'2020-09-10',1450,1232,'2020-11-25',33552268);



drop table if exists lib_parchase_details;
create table lib_parchase_details(
  id int(20) primary key auto_increment,
  publishers_id int(20),
  product_id int(20),
  parchases_id int(20),
  Quentity int(20),
  cost float,
  total float
);
insert into lib_parchase_details(publishers_id,product_id,parchases_id,Quentity,cost,total)values(1,1,1,1,250,250);
insert into lib_parchase_details(publishers_id,product_id,parchases_id,Quentity,cost,total)values(2,2,2,1,130,130);
insert into lib_parchase_details(publishers_id,product_id,parchases_id,Quentity,cost,total)values(3,3,3,1,200,200);



drop table if exists lib_products;
create table lib_products(
  id int(20) primary key auto_increment,
  name varchar(50)
);
insert into lib_products(name)values('story of a programar');
insert into lib_products(name)values('Fairy tales stories');
insert into lib_products(name)values('Bible story');

drop table if exists lib_product_details;
create table lib_product_details(
  id int(20) primary key auto_increment,
  uom_id int(5),
  price float,
  product_id int(20)
);
insert into lib_product_details(uom_id,price,product_id)values(1,250,1);
insert into lib_product_details(uom_id,price,product_id)values(1,350,2);
insert into lib_product_details(uom_id,price,product_id)values(1,300,3);