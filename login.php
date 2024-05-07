<?php
// Проверка, если пользователь уже авторизован, перенаправить на приветственную страницу
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: welcome.php');
    exit;
}

// Подключение к базе данных
$host = 'localhost';
$db = 'app';
$user = 'app';
$password = 'secret';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die('Подключение не удалось: ' . $e->getMessage());
}

// Обработка данных формы авторизации
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Поиск пользователя по email
    $stmt = $conn->prepare('SELECT id, name, password FROM users WHERE email = :email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Успешная аутентификация
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header('Location: welcome.php');
        exit;
    } else {
        echo 'Ошибка: Неверный email или пароль.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Авторизация</title>
    <style>
        .container {
            max-width: 400px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Авторизация</h1>
        <form method="POST" action="login.php">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Войти">
        </form>
    </div>
</body>
</html>