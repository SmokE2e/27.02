<form action="action.php" method="post">
    <label for="num1">Первое число:</label>
    <input name="num1" id="num1" type="number">

    <label for="num2">Второе число:</label>
    <input name="num2" id="num2" type="number">

    <button type="submit">Submit</button>
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $num1 = $_POST["num1"];
    $num2 = $_POST["num2"];

    echo "<h3>Процесс умножения:</h3>";
    echo "<pre>";

    // Вывод процесса умножения в столбик
    echo str_pad($num1, strlen($num2) + 2, " ", STR_PAD_LEFT) . "<br>";
    echo "×" . str_pad($num2, strlen($num1) + 1, " ", STR_PAD_LEFT) . "<br>";
    echo str_repeat("-", max(strlen($num1), strlen($num2)) + 2) . "<br>";

    $lines = [];
    $num2Digits = str_split(strrev((string) $num2));
    foreach ($num2Digits as $digit) {
        $line = $num1 * $digit;
        $lines[] = $line;
    }

    $maxLength = strlen((string) ($num1 * max($num2Digits)));
    foreach ($lines as $index => $line) {
        $padding = str_repeat(" ", $maxLength - strlen((string) $line));
        echo $padding . $line;
        if ($index !== count($lines) - 1) {
            echo "<br>";
        }
    }

    echo "<br>" . str_repeat("-", max(strlen($num1), strlen($num2)) + 2) . "<br>";
    echo "Результат: " . ($num1 * $num2);

    echo "</pre>";
}
?>