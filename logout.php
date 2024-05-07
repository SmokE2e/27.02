<?php
// Уничтожение данных сессии и перенаправление на страницу авторизации
session_start();
session_destroy();
header('Location: login.php');
exit;
?>