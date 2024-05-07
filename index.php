<?php
// Проверка наличия переданных параметров
if ($argc < 2) {
    echo "Ошибка: Необходимо передать параметры таймера." . PHP_EOL;
    echo "Пример использования: php timer.php 60" . PHP_EOL;
    exit(1);
}

// Получение параметра таймера из аргументов командной строки
$timerSeconds = intval($argv[1]);
$startTime = time();

echo "Таймер запущен на $timerSeconds секунд." . PHP_EOL;

while (true) {
    $elapsedTime = time() - $startTime;
    $remainingTime = $timerSeconds - $elapsedTime;

    if ($remainingTime <= 0) {
        echo "Таймер завершен." . PHP_EOL;
        break;
    }

    echo "Прошло времени: $elapsedTime секунд. Осталось времени: $remainingTime секунд." . PHP_EOL;

    // Задержка перед следующим выводом информации (например, каждую секунду)
    sleep(1);
}
?>