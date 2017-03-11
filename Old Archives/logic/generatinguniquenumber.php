<?php
function generateUniqueNumber($block,$floor,$apartment,$people) {
    $block = 0;
    $floor = 7;
    $apartment = 0;
    $people = 4;
    $randomnumber = rand(65,91);
    $uniquenumber = $block + $floor + $apartment + $people + $randomnumber;
    $uniqueletter = chr(($uniquenumber % 26) + 65);
    $uniqueid = "B".$block."F".$floor."A".$apartment."".$uniqueletter.$uniquenumber;
    return uniqueid;
}
 ?>
