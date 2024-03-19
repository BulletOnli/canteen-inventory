<?php
echo "<h1>FOR LOOP</h1>";
echo "------------------------------- <br>";
echo "Sum of Squares Calculator <br>";
echo "------------------------------- <br>";

$sum = 0;

echo "Squares: <br>";
for ($i = 1; $i <= 10; $i++) {
  $square = $i * $i;
  $sum += $square;
  echo "$i^2 = $square <br>";
}

echo "<br> Sum of Squares: $sum";

echo "<h1>WHILE LOOP</h1>";
echo "------------------------------- <br>";
echo "Sum of Squares Calculator <br>";
echo "------------------------------- <br>";

$sum = 0;
$i = 1;

echo "Squares: <br>";

while ($i <= 10) {
  $square = $i * $i;
  $sum += $square;
  echo "$i^2 = $square <br>";

  $i++;
}

echo "<br> Sum of Squares: $sum";

echo "<h1>DO WHILE LOOP</h1>";
echo "------------------------------- <br>";
echo "Sum of Squares Calculator <br>";
echo "------------------------------- <br>";

$sum = 0;
$i = 1;

echo "Squares: <br>";

do {
  $square = $i * $i;
  $sum += $square;
  echo "$i^2 = $square <br>";

  $i++;
} while ($i <= 10);

echo "<br> Sum of Squares: $sum";
