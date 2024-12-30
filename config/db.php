<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "saashm";

// Create connection
$con = new mysqli($servername, $username, $password, $database);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

/*

CREATE TABLE saashm.users (
	id INT auto_increment NOT NULL,
	email varchar(155) NOT NULL,
	password varchar(255) NULL,
	CONSTRAINT users_pk PRIMARY KEY (id)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;

CREATE TABLE saashm.Paciente (
	id INT auto_increment NOT NULL,
	`nombre y apellido` varchar(255) NOT NULL,
	correo varchar(155) NOT NULL,
	dni varchar(20) NOT NULL,
	CONSTRAINT Paciente_pk PRIMARY KEY (id)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;


ALTER TABLE saashm.paciente CHANGE `nombre y apellido` nombreyapellido varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;


CREATE TABLE saashm.historia (
	id INT auto_increment NOT NULL,
	antecedente TEXT NOT NULL,
	receta TEXT NOT NULL,
	dateCreated DATE NOT NULL,
	idPaciente INT NOT NULL,
	CONSTRAINT historia_pk PRIMARY KEY (id),
	CONSTRAINT historia_paciente_FK FOREIGN KEY (idPaciente) REFERENCES saashm.paciente(id)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;


*/
?>