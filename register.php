<?php
// Подключение к базе данных
$host = 'localhost';
$db = 'app';
$user = 'app';
$password = 'secret';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Подключение не удалось: ' . $e->getMessage());
}

// Обработка данных формы регистрации
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Проверка наличия заполненных полей
    if (empty($name) || empty($email) || empty($password)) {
        echo 'Ошибка: Все поля должны быть заполнены.';
    } else {
        // Проверка уникальности email
        $stmt = $conn->prepare('SELECT COUNT(*) FROM users WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            echo 'Ошибка: Пользователь с таким email уже зарегистрирован.';
        } else {
            // Хеширование пароля
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Вставка данных в базу
            $stmt = $conn->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->execute();

            echo 'Регистрация успешно завершена.';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Регистрация</title>
    <style>
        .container {
            max-width: 400px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Регистрация</h1>
        <form method="POST" action="register.php">
            <label for="name">Имя:</label>
            <input type="text" id="name" name="name" required><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Зарегистрироваться">
        </form>
    </div>
</body>
</html>