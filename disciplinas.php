<!doctype html>
<html lang="en">

<head>
    <title>Inscricoes</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style>
        .selected_discipline {
            background-color: darkgray;
        }
    </style>
</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main>
        <h2 class="text-center mb-4">Disciplinas</h2>
        <div class="vstack gap-4 col-md-5 mx-auto mt-5">
            <?php
            $json_data = file_get_contents('disciplinas.json');
            $data = json_decode($json_data, true);

            // Array associativo para armazenar os pré-requisitos de cada disciplina
            $pre_requisitos = array();

            // Itera sobre as disciplinas para obter e armazenar os pré-requisitos
            foreach ($data['disciplinas'] as $disciplina) {
                $nome_disciplina = $disciplina['nome'];
                $pre_requisitos[$nome_disciplina] = $disciplina['pre_requisitos'];
            }

            // Exibe as disciplinas com seus pré-requisitos
            foreach ($data['disciplinas'] as $disciplina) {
                echo "<h2>{$disciplina['nome']}</h2>";
                echo "<p>Turmas:</p>";
                if (count($disciplina['turmas']) > 0) {
                    foreach ($disciplina['turmas'] as $turma) {
                        $id = htmlspecialchars($turma['id'] . '-' . $disciplina['nome']);

                        echo "<p id='{$id}' onclick='selecionar(this.id)'>{$turma['id']} - {$turma['horario_inicio']} - {$turma['horario_fim']} </p>";
                    }
                } else {
                    echo 'Não há turma disponivel';
                }

                $nome_disciplina = $disciplina['nome'];
                $prereq = $pre_requisitos[$nome_disciplina];

                if (count($prereq) > 0) {
                    echo "<p>Pré-requisitos: ";
                    foreach ($prereq as $req) {
                        echo "$req, ";
                    }
                    echo "</p>";
                } else {
                    echo "<p>Não há pré-requisitos para esta disciplina.</p>";
                }
                echo "<br>";
            }
            ?>
            <a href="logout.php"><button type="button" class="btn btn-outline-danger" style="width:20%;">Sair</button></a>
            <button type="button" class="btn btn-outline-success" id="realizar-inscricao" style="width:20%;display:block;float:right">Realizar Inscrição</button>
        </div>

    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
      </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">  </script>
  
</body>
<script type="text/javascript">
    function selecionar(id) {
        var element = document.getElementById(id);
        var selected_class = "selected_discipline";
        var [turma, disciplina] = id.split("-");
        var id_list = new Array().concat(JSON.parse(localStorage.getItem('user')) || []);
        const esta_selecionado = element.classList.contains(selected_class);
        if (esta_selecionado) {
            id_list = id_list.filter(item => item.turma !== turma && item.disciplina !== disciplina);
            element.classList.remove(selected_class)
        } else {
            element.classList.add(selected_class);
            id_list.push({
                turma: turma,
                disciplina: disciplina
            })
        }
        localStorage.setItem('user', JSON.stringify(id_list));
    }
    let realizar_inscricao = document.getElementById('realizar-inscricao');
    realizar_inscricao.addEventListener('click', function() {
        $.ajax({
            type : "POST",  //type of method
            url  : "realizar_inscricao.php",  //your page
            data : {'data': localStorage.getItem('user')},// passing the values
            success: function(res){  
                                console.log(res) //do what you want here...
                    }
        });
        localStorage.clear();
        Array.from(document.querySelectorAll('.selected_discipline')).forEach(
  (el) => el.classList.remove('selected_discipline')
);
    })
</script>

</html>