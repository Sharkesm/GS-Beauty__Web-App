/*


prompt BEGINING OF OUTPUT SECTION 
prompt DatabaseName : globalStyle_DB
prompt Company : GlobalStyling Inc.
prompt Student : Hussein 
prompt Created : 11.08.2015,  7:47
prompt Modified :


*/


/**
-------------------------------------------
----------- prompt Database-Relation  --------  **/


-- ONE CUSTOMER MAY create MANY APPOINTMENT 
-- ONE PRODUCT TYPE MAY be assigned to MANY PRODUCT 
-- ONE PRODUCT MAY be assigned to MANY STORE/PRODUCT 
-- ONE PRODUCT MUST have ONE PRODUCT TYPE
-- ONE STORE MAY contain MANY PRODUCT/STORE 
-- ONE PRODUCT/STORE MUST have ONE PRODUCT 
-- ONE PRODUCT/STORE MUST have ONE STORE 
-- ONE PRODUCT/STORE MAY have MANY APPOINTMENT 
-- ONE APPOINTMNET MUST have ONE Customer 
-- ONE APPOINTMENT MUST have ONE PRODUCT/STORE 






/**
--------------------------------------------
---------- prompt CREATE DATABASE --------*/ 

DROP DATABASE globalStyle_db;
CREATE DATABASE globalStyle_db;
USE globalStyle_db;








/**
--------------------------------------------
---------- prompt DROP ALL TABLES --------*/


/*
DROP TABLE APPOINTMENT;
DROP TABLE PRODUCT_STORE;
DROP TABLE PRODUCT;
DROP TABLE PRODUCT_TYPE;
DROP TABLE STORE; 
DROP TABLE CUSTOMER; 

*/


/**------------------------------------------
----------------CREATE ALL TABLES----------*/


CREATE TABLE CUSTOMER (
 cust_id int(6) AUTO_INCREMENT PRIMARY KEY,
 cust_name varchar(50) NOT NULL,
 cust_email varchar(50) NOT NULL,
 cust_password varchar(45) NOT NULL,
 priority int(1) DEFAULT 0 NOT NULL 
);



CREATE TABLE STORE (
    store_id int(6) AUTO_INCREMENT PRIMARY KEY,
    store_location varchar(50) NOT NULL,
    open_hour time NOT NULL
);



CREATE TABLE PRODUCT_TYPE (
  type_id int(6) AUTO_INCREMENT PRIMARY KEY,
  type_name varchar(50) NOT NULL    
);



CREATE TABLE PRODUCT (
  pro_id int(6) AUTO_INCREMENT,
  type_id int(6), 
  pro_name varchar(50) NOT NULL,
  pro_cost int(6) NOT NULL,
  status int(1) default '1' not null,
  CONSTRAINT pk_PRODUCT PRIMARY KEY (pro_id,type_id),
  CONSTRAINT fk_typeID FOREIGN KEY (type_id) REFERENCES PRODUCT_TYPE(type_id)    
);



CREATE TABLE PRODUCT_STORE (
  pro_id int(6),
  type_id int(6),
  store_id int(6),
  CONSTRAINT pk_PRODUCT_STORE PRIMARY KEY (pro_id,type_id,store_id),
  CONSTRAINT fk_STORE FOREIGN KEY (store_id) REFERENCES STORE(store_id),
  CONSTRAINT fk_PRODUCT FOREIGN KEY (pro_id,type_id) REFERENCES PRODUCT(pro_id,type_id) 
);



CREATE TABLE APPOINTMENT (
  cust_id int(6),
  pro_id int(6),
  type_id int(6),
  store_id int(6),
  appoint_date date,
  appoint_time time,
  CONSTRAINT pk_APPOINTMENT PRIMARY KEY (cust_id,pro_id,type_id,store_id,appoint_date,appoint_time),
  CONSTRAINT fk_CUSTOMER FOREIGN KEY (cust_id) REFERENCES CUSTOMER(cust_id),
  CONSTRAINT fk_PRODUCT_STORE FOREIGN KEY (pro_id,type_id,store_id) REFERENCES PRODUCT_STORE(pro_id,type_id,store_id)
);
