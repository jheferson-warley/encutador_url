<?php

// conexao.php

// Verifica se as constantes já foram definidas
if (!defined('HOST')) define('HOST', 'localhost');
if (!defined('USER')) define('USER', 'root');
if (!defined('PASSWORD')) define('PASSWORD', '');
if (!defined('DATABASE')) define('DATABASE', 'urls');

try {
  // Conexão usando PDO
  $conn = new PDO('mysql:host=' . HOST . ';dbname=' . DATABASE, USER, PASSWORD);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Erro na conexão: " . $e->getMessage();
  die();
}
