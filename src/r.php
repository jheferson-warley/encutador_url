
<?php
include_once('../conexao/conexao.php');
if (!isset($_GET['h'])) {
  die('URL inválida');
}

// Utilizando filter_var para validar o hash
$hash = filter_var($_GET['h'], FILTER_SANITIZE_URL);

try {
  // Preparando a consulta para buscar a URL com o hash informado
  $stmt = $conn->prepare("SELECT * FROM url_encurtada WHERE id = :hash");
  $stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!$row) {
    die('URL inválida');
  }

  // Atualizando o contador de acessos
  $updateStmt = $conn->prepare("UPDATE url_encurtada SET acessos = acessos + 1 WHERE id = :hash");
  $updateStmt->bindParam(':hash', $hash, PDO::PARAM_STR);
  $updateStmt->execute();

  // Redirecionando para a URL original
  header('Location: ' . $row['url']);
} catch (PDOException $e) {
  die('Erro na consulta: ' . $e->getMessage());
}
?>