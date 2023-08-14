<?php
$total = 19.44; // The total value
$percentage = 5; // The percentage to cut

$cutAmount = $total * ($percentage / 100);
$finalTotal = $total - $cutAmount;

echo "Original Total: " . $total . "<br>";
echo "Cut Amount: " . $cutAmount . "<br>";
echo "Final Total: " . $cutAmount . "<br>";