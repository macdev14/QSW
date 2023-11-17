<!doctype html>
<html lang="en">

<head>
  <title>Inscricoes</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  <header>
    <!-- place navbar here -->
  </header>
  <main>
 <div class="container">
<h1>Seleção de Disciplinas por Turma</h1>

<form method="post" action="processar_selecao.php">
  <?php
  // Carrega o conteúdo do arquivo JSON
  $json_data = file_get_contents('dados_turmas.json');

  // Decodifica o JSON para um array associativo
  $data = json_decode($json_data, true);

  // Verifica se há dados e itera sobre as turmas e disciplinas
  if ($data && isset($data['turmas'])) {
      foreach ($data['turmas'] as $turma) {
          echo "<h2>Turma {$turma['nome']}</h2>";
          if (isset($turma['disciplinas'])) {
              echo "<select multiple name='disciplinas[]'>";
              foreach ($turma['disciplinas'] as $disciplina) {
                  echo "<option value='{$disciplina['nome']}'>{$disciplina['nome']} - Horário: {$disciplina['horario']}</option>";
              }
              echo "</select><br><br>";
          } else {
              echo "<p>Não há disciplinas nesta turma.</p>";
          }
      }
  } else {
      echo "<p>Não há dados disponíveis.</p>";
  }
  ?>

  <input type="submit" value="Enviar">
</form>
</div>
  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>
<script>
    const disciplina = document.getElementsByClassName('disciplina');
    disciplina.addEventListener('click', function (){

    })

</script>
</html>

