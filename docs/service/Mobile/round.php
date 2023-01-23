echo round(10.5); // Round the number, this example would echo 11.
echo '<br />';
echo floor(10.5); // Round down, this would echo 10.
echo '<br />';
echo ceil(10.3); // Round up, this would be 11.



<?php

$number = 1234.56;

// english notation (default)
$english_format_number = number_format($number);
// 1,235

// French notation
$nombre_format_francais = number_format($number, 2, ',', ' ');
// 1 234,56

$number = 1234.5678;

// english notation without thousands separator
$english_format_number = number_format($number, 2, '.', '');
// 1234.57

?>