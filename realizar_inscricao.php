<?php
if (isset($_POST['data'])) {
    $turma = json_decode($_POST['data'], true); 
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($turma);
}
?>