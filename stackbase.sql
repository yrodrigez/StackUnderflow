CREATE TABLE USUARIO
(
	IDUSUARIO INTEGER PRIMARY KEY AUTO_INCREMENT,
	USERNAME VARCHAR(20),
	PASSWORD VARCHAR(50) NOT NULL,
	EMAIL VARCHAR(255) NOT NULL,
	FOTO VARCHAR(255),
	DESCRIPCION TEXT,
	TIPO SMALLINT NOT NULL
);
CREATE TABLE POST
(
	IDPOST INTEGER PRIMARY KEY AUTO_INCREMENT,
	IDUSUARIO INTEGER NOT NULL,
	CUERPO TEXT NOT NULL,
	NUMVISITAS INTEGER NOT NULL,
	FECHA_CREACION DATE NOT NULL,
	CONTESTADA SMALLINT NOT NULL,
	FOREIGN KEY (IDUSUARIO) REFERENCES USUARIO(IDUSUARIO)
);
CREATE TABLE RESPUESTA
(
	IDRESPUESTA INTEGER PRIMARY KEY AUTO_INCREMENT,
	IDUSUARIO INTEGER NOT NULL,
	IDPOST INTEGER NOT NULL,
	CUERPO TEXT NOT NULL,
	FECHA_CREACION DATE NOT NULL,
	FOREIGN KEY (IDUSUARIO) REFERENCES USUARIO(IDUSUARIO),
	FOREIGN KEY (IDPOST) REFERENCES POST(IDPOST)
);
CREATE TABLE TAG
(
	TAG VARCHAR(20) PRIMARY KEY
);

CREATE TABLE TAGENPOST
(
	TAG VARCHAR(20),
	IDPOST INTEGER,
	FOREIGN KEY (IDPOST) REFERENCES POST(IDPOST),
	FOREIGN KEY (TAG) REFERENCES TAG(TAG),
	constraint PK_TAGENPOST primary key (IDPOST, TAG)
);