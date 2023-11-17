<?php
// Simulated user data (Replace this with a database connection)
$valid_username = 'user123';
$valid_password = 'password123';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    if ($input_username === $valid_username && $input_password === $valid_password) {
        // Authentication successful
        $_SESSION['username'] = $input_username;
        header('Location: disciplinas.php'); // Redirect to dashboard or another authenticated page
        exit();
    } else {
        // Authentication failed
        $_SESSION['error'] = 'Credenciais Inválidas.';
        header('Location: index.php');
        exit();
    }
}
?>
