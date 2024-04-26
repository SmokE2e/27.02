<?php 
$fd = fopen("titanic.csv", 'r') or die("не удалось открыть файл");

$titles = explode(',', fgets($fd));
$titles = array_map(fn(string $title) => "<th>$title</th>", $titles);
$tableHeader = implode('', $titles);

$tableBody = '';

while(!feof($fd))
{
    $tbody = explode(',', fgets($fd));
    [4 => $age, 2 => $name] = $tbody;
    if(isset($_GET['age'])) 
    {
        $ageReq = $_GET['age'];
        if ($age == $ageReq){
            $tbody = array_map(fn(string $tbody) => "<td>$tbody</td>", $tbody);
            $tableBody .= '<tr>' . implode('', $tbody) . '</tr>';
        }    
    }
    else if (isset($_GET['name'])){
        $nameReq = $_GET['name'];
        if(preg_match("/$nameReq/i", $name)){
          $tbody = array_map(fn(string $tbody) => "<td>$tbody</td>", $tbody);
          $tableBody .= '<tr>' . implode('', $tbody) . '</tr>';
        }
    }
    else {
        $tbody = array_map(fn(string $tbody) => "<td>$tbody</td>", $tbody);
        $tableBody .= '<tr>' . implode('', $tbody) . '</tr>';
    }
    
}

echo <<<THEAD
<table>
  <tr>
    $tableHeader
  </tr>
  
  $tableBody
  
</table>
THEAD;

fclose($fd); 

?>