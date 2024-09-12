<?php
include_once('../conexao/conexao.php');
$url = false;
if (isset($_POST['url'])) {
  $hash = uniqid();
  $url = filter_var($_POST['url'], FILTER_SANITIZE_URL);
  $acessos = 0;
  $url_prefixada = 'http://localhost/url/src/r.php?h=';

  try {
    $stmt = $conn->prepare("INSERT INTO url_encurtada(id, url, acessos) VALUES(:id, :url, :acessos)");
    $stmt->bindParam(':id', $hash);
    $stmt->bindParam(':url', $url);
    $stmt->bindParam(':acessos', $acessos, PDO::PARAM_INT);
    $stmt->execute();
  } catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
  }
  $url = $url_prefixada . $hash;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="./styles/style.css">
  <title>Encurtador de URL</title>
</head>

<body>
  <div class="form-group container">
    <div class="urlStyle">
      <h1>Encurtador de Url</h1>
      <form method="POST" action="">
        <label for="url">Insira sua URL:</label><br>
        <input class="form-control" type="url" name="url" placeholder="Digite sua URL aqui">
        <button type="submit">Encurtar a URL</button>
      </form>
      <?php if ($url !== false) { ?>
        <div class="urlEncurtada">
          <p>
            <span>URL Encurtada:</span>
            <input class="form-control" type="text" id="texto" readonly value="<?php echo $url; ?>">
            <button id="botao">Copiar URL</button>

            <script>
              //Script para copiar a nova URL
              document.getElementById("botao").addEventListener("click", function() {
                var texto = document.getElementById("texto");
                texto.select();
                document.execCommand("copy");
                alert("Texto copiado: " + texto.value);
              });
            </script>

          </p>
        </div>
      <?php } ?>
    </div>
  </div>





  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>