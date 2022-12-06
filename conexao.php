<?php

$usuario = ''; // user of db
$senha = ''; // key 
$database = ''; // your db
$host = ''; // like localhost

$mysqli = new mysqli($host, $usuario, $senha, $database);

if($mysqli->error){
  die("Falha ao conectar ao banco de dados: " + $mysqli->$error);
}