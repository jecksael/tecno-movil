
## TABLE CARGO #################

CREATE TABLE IF NOT EXISTS cargo(
    id int auto_increment PRIMARY KEY,
    cargo varchar(50) NOT NULL
)ENGINE=INNODB;

INSERT INTO cargo (id,cargo)VALUES (1 ,'Admin'), (2, 'Tecnico (a)'), (3, 'Vendedor (a)');
################TABLA USUARIOS ########################

CREATE TABLE IF NOT EXISTS tbl_usuarios(

    id int auto_increment PRIMARY KEY,
    nombre varchar (100) NOT NULL,
    apellido varchar (100),
    email varchar (100) UNIQUE NOT NULL,
    password varchar (100)  NOT NULL,
    direccion varchar (100) NOT NULL,
    telefono varchar(12),
    cargo_id int(2) NOT NULL,
    status int(2) NOT NULL,
    created_at datetime,
    update_at datetime,
    FOREIGN KEY (cargo_id)
        REFERENCES cargo(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
)ENGINE=INNODB;
INSERT INTO tbl_usuarios (id,nombre,apellido,email,password,direccion,telefono,cargo_id,status) VALUES
(null, 'Administrador', '','admin@email.com',md5(123),'El Piñal', '0000-00000', 1,1);

############ TABLA NACIONALIDAD ###################

CREATE TABLE IF NOT EXISTS nacionalidad(
    id int auto_increment PRIMARY KEY,
    nacionalidad varchar(20) NOT NULL
)ENGINE=INNODB;

INSERT INTO nacionalidad (id,nacionalidad) VALUES (null, 'V-'), (null, 'E-');

############### TABLA CLIENTES ##################

CREATE TABLE IF NOT EXISTS clientes (
    id int auto_increment PRIMARY KEY,
    nac_id int NOT NULL,
    ced_cli int(11) UNIQUE NOT NULL,
    nom_cli varchar(100)   NOT NULL,
    ape_cli varchar(100)   NOT NULL,
    gen_cli varchar(1)     NOT NULL,
    dir_cli varchar(100)   NOT NULL,
    telf_cli varchar(12),
    created_at datetime,
    update_at datetime,
    FOREIGN KEY (nac_id)
        REFERENCES nacionalidad(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
)ENGINE=INNODB;


########### TABLA EMPRESA ##############

CREATE TABLE IF NOT EXISTS empresa (
    id int auto_increment PRIMARY KEY,
    rif_emp varchar (20)    NOT NULL,
    nom_emp varchar (100)   NOT NULL,
    dir_emp varchar (100) NOT NULL,
    email_emp varchar (100),
    tlf_emp varchar (13),
    propietario varchar(100) NOT NULL,
    ced_pro varchar(20) NOT NULL,
    iva int NOT NULL,
    url_logo varchar(100)
)ENGINE=INNODB;


########## TABLA MARCA ############
CREATE TABLE IF NOT EXISTS marca (
    id int auto_increment PRIMARY KEY,
    marca varchar (50) NOT NULL
)ENGINE=INNODB;

##########TABLA PRODUCTO #############

CREATE TABLE IF NOT EXISTS producto (
    id int auto_increment PRIMARY KEY,
    cod_pro varchar (20) UNIQUE,
    des_pro varchar (100) NOT NULL,
    marca_id int (2) NOT NULL,
    stock int(4) NOT NULL,
    pre_com double (9,2) NOT NULL,
    porc_pro int(3) NOT NULL ,
    pre_ven double (9,2) NOT NULL,
    status int (2) NOT NULL,
    url_imagen varchar(50),
    created_at datetime,
    update_at datetime,
    FOREIGN KEY (marca_id)
        REFERENCES marca(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
)ENGINE=INNODB;

########## TABLA PROVEEDORES ###########

CREATE TABLE IF NOT EXISTS proveedor (
    id int auto_increment PRIMARY KEY,
    rif_pro varchar(15) UNIQUE NOT NULL,
    nom_pro varchar (100) NOT NULL,
    dir_pro varchar (100) NOT NULL,
    telf_pro varchar (13)
)ENGINE=INNODB;

######## TABLA TIPO DE PAGO ########

CREATE TABLE IF NOT EXISTS tipo_pago (
    id int auto_increment PRIMARY KEY,
    pago varchar(50) NOT NULL
)ENGINE=INNODB;
INSERT INTO tipo_pago (id,pago)VALUES
(NULL, 'EFECTIVO'),
(NULL, 'TARJETA DE DEBIDO / TARJETA DE CREDITO'),
(NULL, 'TRANSFERENCIA');


####### TABLA FACTURA COMPRA ###########

CREATE TABLE IF NOT EXISTS compra (
    id int auto_increment PRIMARY KEY,
    rif_id int NOT NULL,
    usu_id int NOT NULL,
    pago_id int NOT NULL,
    referencia varchar (50),
    iva double(9,2) NOT NULL,
    big double(9,2) NOT NULL,
    total double(9,2) NOT NULL,
    created_at datetime NOT NULL,
    FOREIGN KEY (rif_id)
        REFERENCES proveedor(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (usu_id)
        REFERENCES tbl_usuarios(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (pago_id)
        REFERENCES tipo_pago(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
)ENGINE=INNODB;

###### TABLA DETALLE DE COMPRA ##########

CREATE TABLE IF NOT EXISTS compra_detalle(
    id int auto_increment PRIMARY KEY,
    compra_id int NOT NULL,
    cod_pro_id varchar(20) NOT NULL,
    cant int NOT NULL,
    sub_total double(9,2) NOT NULL,
    FOREIGN KEY (compra_id)
        REFERENCES compra(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (cod_pro_id)
        REFERENCES producto(cod_pro)
        ON DELETE CASCADE
        ON UPDATE CASCADE
)ENGINE=INNODB;




######## TABLA FACTURA VENTA ######

CREATE TABLE IF NOT EXISTS venta (
    id int auto_increment PRIMARY KEY,
    ced_id int(10) NOT NULL,
    usu_id int NOT NULL,
    pago_id int NOT NULL,
    referencia varchar(50) ,
    iva double(9,2) NOT NULL,
    big double(9,2) NOT NULL,
    total double(9,2) NOT NULL,
    created_at datetime NOT NULL,
    FOREIGN KEY (ced_id)
        REFERENCES clientes(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (usu_id)
        REFERENCES tbl_usuarios(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY(pago_id)
        REFERENCES tipo_pago(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
)ENGINE=INNODB;


####### TABLA DETALLE VENTA ###########

CREATE TABLE IF NOT EXISTS venta_detalle(
    id int auto_increment PRIMARY KEY,
    venta_id int NOT NULL,
    cod_pro_id varchar(20) NOT NULL,
    cant int NOT NULL,
    sub_total double(9,2) NOT NULL,
    FOREIGN KEY (venta_id)
        REFERENCES venta(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (cod_pro_id)
        REFERENCES producto(cod_pro)
        ON DELETE CASCADE
        ON UPDATE CASCADE

)ENGINE=INNODB;



######## TABLA SERVICIOS ##########
CREATE TABLE IF NOT EXISTS servicio (
    id int auto_increment PRIMARY KEY,
    servicio varchar (80) NOT NULL
)ENGINE=INNODB;

INSERT INTO servicio (id, servicio) VALUES
(NULL, 'REPARACION Y MANTENIMIENTO'),
(NULL, 'ACTUALIZACION DE SOFTWARE'),
(NULL, 'LIBERACION DE BANDAS');

###### TABLA STATUS DE ENTREGA ########
 CREATE TABLE IF NOT EXISTS entrega (
    id int auto_increment PRIMARY KEY,
    entrega varchar (15) NOT NULL
)ENGINE=INNODB;
 INSERT INTO entrega (id, entrega) VALUES
 (NULL , 'Por Entregar'),
 (NULL, 'Entregado'),
 (NULL, 'Caducada');

###### TABLA STATUS DE REPARACION #####

CREATE TABLE IF NOT EXISTS status (
    id int auto_increment PRIMARY KEY,
    status varchar (20) NOT NULl
)ENGINE=INNODB;

INSERT INTO status (id, status)VALUES
(NULL, 'En Reparacion'),
(NULL, 'Reparado'),
(NULL, 'Sin Arreglo');

#### TABLA EQUIPO DE LA REPARACION ####

CREATE TABLE IF NOT EXISTS equipo(
    id int auto_increment PRIMARY KEY,
    equipo varchar(70) NOT NULL
)ENGINE=INNODB;

INSERT INTO equipo VALUES (NULL, 'Telefono'),(NULL, 'Tablet'), (NULL, 'Computadora');
##### TABLA REPARACIONES #########

CREATE TABLE IF NOT EXISTS reparaciones (
    id int auto_increment PRIMARY KEY,
    ced_id int (4) NOT NULL,
    usu_id int (2) NOT NULL,
    equipo_id int (3) NOT NULL,
    marca_id int NOT NULL,
    modelo varchar (40) NOT NULL,
    color varchar (40) NOT NULL,
    servicio varchar (100) NOT NULL,
    detalle_serv varchar (100),
    imei varchar (20) NOT NULL,
    acce_recb varchar (100),
    pago_id int NOT NULL,
    referencia varchar(10),
    status_id int NOT NULL,
    entrega_id int NOT NULL,
    tecnico_id int NOT NULL,
    monto_serv double (9,2) NOT NULL,
    monto_repu double (9,2) NOT NULL,
    total double (9,2) NOT NULL,
    created_at datetime,
    update_at datetime,
    FOREIGN KEY (ced_id)
        REFERENCES clientes(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (usu_id)
        REFERENCES tbl_usuarios(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (equipo_id)
        REFERENCES equipo(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (marca_id)
        REFERENCES marca(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (pago_id)
        REFERENCES tipo_pago(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (status_id)
        REFERENCES status(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (entrega_id)
        REFERENCES entrega(id),
    FOREIGN KEY (tecnico_id)
        REFERENCES tbl_usuarios(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS repuesto (
    id int auto_increment PRIMARY KEY,
    cod_pro_id varchar(20) NOT NULL,
    reparacion_id int NOT NULL,
    FOREIGN KEY (cod_pro_id)
        REFERENCES producto(cod_pro)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (reparacion_id)
        REFERENCES reparaciones(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
)ENGINE=INNODB;

