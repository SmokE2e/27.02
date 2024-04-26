<?php
#Задание 1
if(isset($_GET['info'])){
    $info = $_GET['info'];
    echo $info;
}
#Задание 2
elseif (isset($_GET['num'])) {
    $num = $_GET['num'];
    if($num > 1000){
        echo 'Число должно быть меньше 1000';
        exit;
    }
    function isPrime($n) {
        if ($n <= 1) {
          return false;
        }
        for ($i = 2; $i <= sqrt($n); $i++) {
          if ($n % $i === 0) {
            return false;
          }
        }
        return true;
      }
    
      $primeNumbers = [];
      for ($i = 2; $i <= $num; $i++) {
        if (isPrime($i)) {
          $primeNumbers[] = $i;
        }
      }
    
      echo "Массив простых чисел: " . implode(", ", $primeNumbers);
    } else {
      echo "Не переданы параметры в URL.";
    }

?>