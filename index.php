<?php
include_once(__DIR__ . '/class.init.php');
$parseConfig = ["type" => "xml", "additional" => 'simple']; //базовые конфигурации type - вид файла csv|xml , additional - дополнительные настройки для csv - разделитель, для xml -simple(теговый) или attribute(по атрибутам)
$parseString = "<?xml version=\"1.1\" encoding=\"UTF-8\" ?>
     <workers>
         <worker>
             <fname>Иван</fname>
             <lname>Иванов</lname>
             <mname>Иванович</mname>
             <birth_date>1980-01-01</birth_date>
             <comment>какой-то текст</comment>
         </worker>
         <worker>
             <fname>Петр</fname>
             <lname>Петров</lname>
             <mname>Иванович</mname>
             <birth_date>1982-05-01</birth_date>
             <comment>Какой-то текст</comment>
         </worker>
     </workers>
 </xml>";
$parse = new \parse\BaseParse($parseString, $parseConfig);
echo "<table>";
foreach ($parse->Parse()->Parser() as $column) {
    echo "<tr>";
    foreach ($column as $element) {
        echo "<td>" . $element . "</td>";
    }
    echo "</tr>";
}
echo "<table>";

?>