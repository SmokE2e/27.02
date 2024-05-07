<?php
// Проверка, если пользователь не авторизован, перенаправить на страницу авторизации
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Добро пожаловать</title>
</head>
<body>
    <h1>Добро пожаловать, <?php echo $_SESSION['user_name']; ?>!</h1>
    <a href="logout.php">Выйти</a>
</body>
</html>