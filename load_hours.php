<?php
$hours = json_decode(file_get_contents('hours.json'), true);
foreach ($hours as $day => $hour) {
    echo "<tr><td>" . ucfirst($day) . "</td><td>" . $hour . "</td></tr>";
}
?>
